#!/usr/bin/env bash
set -euo pipefail

root="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
wordpress="${RUNNER_TEMP:-/tmp}/rinova-wordpress"
base_url="http://127.0.0.1:8080"
mail_capture="${RUNNER_TEMP:-/tmp}/rinova-mail-capture.json"
cookie_jar="${RUNNER_TEMP:-/tmp}/rinova-cookies.txt"
server_log="${RUNNER_TEMP:-/tmp}/rinova-wordpress-server.log"

php_lint() {
  while IFS= read -r -d '' file; do
    php -l "$file"
  done < <(find "$root" -path "$root/.git" -prune -o -path "$root/preview-build" -prune -o -type f -name '*.php' -print0)
}

php_lint
wp core download --path="$wordpress" --quiet
mkdir -p "$wordpress/wp-content/themes/rinova-casa" "$wordpress/wp-content/mu-plugins"
cp -R "$root/." "$wordpress/wp-content/themes/rinova-casa/"
cp "$root/tests/ci-mail-capture.php" "$wordpress/wp-content/mu-plugins/rinova-mail-capture.php"

wp config create \
  --path="$wordpress" \
  --dbname=wordpress \
  --dbuser=wp \
  --dbpass=wp \
  --dbhost=127.0.0.1 \
  --skip-check \
  --quiet

wp core install \
  --path="$wordpress" \
  --url="$base_url" \
  --title="Rinova Casa Test" \
  --admin_user=ci-admin \
  --admin_password='ci-only-test-password' \
  --admin_email=ci@example.invalid \
  --skip-email \
  --quiet

wp theme activate rinova-casa --path="$wordpress" --quiet
front_page_id="$(wp post create --path="$wordpress" --post_type=page --post_title='Home' --post_name='home' --post_status=publish --porcelain)"
privacy_page_id="$(wp post create --path="$wordpress" --post_type=page --post_title='Privacy' --post_name='privacy' --post_status=publish --porcelain)"
wp option update show_on_front page --path="$wordpress" --quiet
wp option update page_on_front "$front_page_id" --path="$wordpress" --quiet
wp post create --path="$wordpress" --post_type=rinova_progetto --post_title='Lavoro di prova' --post_excerpt='Descrizione di prova.' --post_status=publish --porcelain > /dev/null
wp eval 'set_theme_mod("rinova_legal_name", "Impresa Test"); set_theme_mod("rinova_privacy_email", "privacy@example.invalid"); set_theme_mod("rinova_retention", "Periodo di prova configurato per CI.");' --path="$wordpress"

RINOVA_TEST_MAIL_CAPTURE="$mail_capture" php -S 127.0.0.1:8080 -t "$wordpress" >"$server_log" 2>&1 &
server_pid=$!
trap 'kill "$server_pid" 2>/dev/null || true' EXIT

ready=false
for _ in $(seq 1 40); do
  if curl --silent --fail "$base_url/" >/dev/null; then
    ready=true
    break
  fi
  sleep 1
done
if [[ "$ready" != true ]]; then
  cat "$server_log"
  echo "WordPress did not become ready." >&2
  exit 1
fi

home_html="$(curl --silent --show-error --fail "$base_url/")"
grep -q 'name="description"' <<< "$home_html"
grep -q 'property="og:title"' <<< "$home_html"
grep -q 'name="rinova_name"' <<< "$home_html"
grep -q 'l’informativa privacy' <<< "$home_html"
grep -q "?page_id=$privacy_page_id" <<< "$home_html"
grep -q 'Lavoro di prova' <<< "$home_html"

privacy_html="$(curl --silent --show-error --fail "$base_url/?page_id=$privacy_page_id")"
grep -q 'Impresa Test' <<< "$privacy_html"
grep -q 'Periodo di prova configurato per CI.' <<< "$privacy_html"
if grep -q 'Informativa dimostrativa da completare' <<< "$privacy_html"; then
  echo "Privacy page remained in the incomplete state despite configured CI values." >&2
  exit 1
fi

nonce="$(grep -oE 'name="rinova_contact_nonce" value="[^"]+"' <<< "$home_html" | head -n 1 | sed -E 's/.*value="([^"]+)"/\1/')"
if [[ -z "$nonce" ]]; then
  echo "The request form did not render its security nonce." >&2
  exit 1
fi

curl --silent --show-error --fail \
  --cookie-jar "$cookie_jar" \
  --cookie "$cookie_jar" \
  --data-urlencode "action=rinova_contact" \
  --data-urlencode "rinova_contact_nonce=$nonce" \
  --data-urlencode "rinova_name=CI Test" \
  --data-urlencode "rinova_email=ci-sender@example.invalid" \
  --data-urlencode "rinova_message=Smoke test message" \
  --location \
  "$base_url/wp-admin/admin-post.php" > "${RUNNER_TEMP:-/tmp}/rinova-form-response.html"
grep -q 'richiesta è stata inviata' "${RUNNER_TEMP:-/tmp}/rinova-form-response.html"
grep -q 'ci-sender@example.invalid' "$mail_capture"
grep -q 'Smoke test message' "$mail_capture"

rm -f "$mail_capture"
invalid_response="$(curl --silent --show-error --output "${RUNNER_TEMP:-/tmp}/rinova-invalid-response.html" --write-out '%{http_code}' \
  --data-urlencode "action=rinova_contact" \
  --data-urlencode "rinova_contact_nonce=$nonce" \
  --data-urlencode "rinova_name=CI Test" \
  --data-urlencode "rinova_email=invalid" \
  --data-urlencode "rinova_message=Invalid email test" \
  --location \
  "$base_url/wp-admin/admin-post.php")"
[[ "$invalid_response" == "200" ]]
grep -q 'Controlla i campi obbligatori' "${RUNNER_TEMP:-/tmp}/rinova-invalid-response.html"
if [[ -e "$mail_capture" ]]; then
  echo "The invalid address unexpectedly triggered an email." >&2
  exit 1
fi

honeypot_response="$(curl --silent --show-error --output /dev/null --write-out '%{http_code}' \
  --data-urlencode "action=rinova_contact" \
  --data-urlencode "rinova_contact_nonce=$nonce" \
  --data-urlencode "rinova_name=CI Test" \
  --data-urlencode "rinova_email=ci-sender@example.invalid" \
  --data-urlencode "rinova_message=Spam test" \
  --data-urlencode "rinova_website=https://spam.example.invalid" \
  "$base_url/wp-admin/admin-post.php")"
[[ "$honeypot_response" == "400" ]]

bad_nonce_response="$(curl --silent --show-error --output /dev/null --write-out '%{http_code}' \
  --data-urlencode "action=rinova_contact" \
  --data-urlencode "rinova_contact_nonce=invalid" \
  "$base_url/wp-admin/admin-post.php")"
[[ "$bad_nonce_response" == "403" ]]
if [[ -e "$mail_capture" ]]; then
  echo "An invalid submission unexpectedly triggered an email." >&2
  exit 1
fi

echo "WordPress smoke tests passed: theme rendering, SEO metadata, privacy template, project cards, email routing, invalid-input rejection, honeypot and nonce checks."
