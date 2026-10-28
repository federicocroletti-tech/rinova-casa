<?php
/**
 * Theme setup and features.
 *
 * @package Rinova_Casa
 */

function rinova_casa_setup() {
	load_theme_textdomain( 'rinova-casa', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/editor.css' );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 80,
			'width'       => 240,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	register_nav_menus(
		array(
			'primary' => __( 'Menu principale', 'rinova-casa' ),
			'footer'  => __( 'Menu footer', 'rinova-casa' ),
		)
	);
}
add_action( 'after_setup_theme', 'rinova_casa_setup' );

function rinova_casa_assets() {
	$theme = wp_get_theme();

	wp_enqueue_style(
		'rinova-casa-style',
		get_stylesheet_uri(),
		array(),
		$theme->get( 'Version' )
	);
	wp_enqueue_style(
		'rinova-casa-layout',
		get_template_directory_uri() . '/assets/css/theme.css',
		array( 'rinova-casa-style' ),
		$theme->get( 'Version' )
	);
	wp_enqueue_script(
		'rinova-casa-navigation',
		get_template_directory_uri() . '/assets/js/navigation.js',
		array(),
		$theme->get( 'Version' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'rinova_casa_assets' );

function rinova_casa_register_project_type() {
	register_post_type(
		'rinova_progetto',
		array(
			'labels'       => array(
				'name'          => __( 'Lavori', 'rinova-casa' ),
				'singular_name' => __( 'Lavoro', 'rinova-casa' ),
				'add_new_item'  => __( 'Aggiungi un lavoro', 'rinova-casa' ),
				'edit_item'     => __( 'Modifica lavoro', 'rinova-casa' ),
				'view_item'     => __( 'Visualizza lavoro', 'rinova-casa' ),
				'not_found'     => __( 'Nessun lavoro pubblicato.', 'rinova-casa' ),
			),
			'public'       => true,
			'has_archive'  => false,
			'menu_icon'    => 'dashicons-hammer',
			'rewrite'      => array( 'slug' => 'lavori' ),
			'show_in_rest' => true,
			'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		)
	);
}
add_action( 'init', 'rinova_casa_register_project_type' );

function rinova_casa_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'rinova_home',
		array(
			'title'    => __( 'Rinova Casa: pagina iniziale', 'rinova-casa' ),
			'priority' => 30,
		)
	);

	$settings = array(
		'rinova_eyebrow' => array(
			'label'    => __( 'Testo introduttivo', 'rinova-casa' ),
			'default'  => __( 'Ristrutturazioni, senza sorprese', 'rinova-casa' ),
			'sanitize' => 'sanitize_text_field',
		),
		'rinova_headline' => array(
			'label'    => __( 'Titolo principale', 'rinova-casa' ),
			'default'  => __( 'La casa che immagini. Il percorso per arrivarci.', 'rinova-casa' ),
			'sanitize' => 'sanitize_text_field',
		),
		'rinova_intro' => array(
			'label'    => __( 'Descrizione iniziale', 'rinova-casa' ),
			'default'  => __( 'Ristrutturazioni curate, un referente presente e decisioni condivise, dall’idea alla consegna.', 'rinova-casa' ),
			'sanitize' => 'sanitize_textarea_field',
		),
		'rinova_meta_description' => array(
			'label'    => __( 'Descrizione SEO della home', 'rinova-casa' ),
			'default'  => __( 'Impresa dimostrativa di ristrutturazioni: servizi, lavori e richiesta di informazioni.', 'rinova-casa' ),
			'sanitize' => 'sanitize_textarea_field',
		),
		'rinova_cta_label' => array(
			'label'    => __( 'Testo del pulsante principale', 'rinova-casa' ),
			'default'  => __( 'Parliamo del tuo progetto', 'rinova-casa' ),
			'sanitize' => 'sanitize_text_field',
		),
		'rinova_legal_name' => array(
			'label'    => __( 'Privacy: ragione sociale del titolare (da completare)', 'rinova-casa' ),
			'default'  => __( 'DA COMPLETARE — inserisci il nome o la ragione sociale del titolare', 'rinova-casa' ),
			'sanitize' => 'sanitize_text_field',
		),
		'rinova_privacy_email' => array(
			'label'    => __( 'Privacy: email per richieste sui dati', 'rinova-casa' ),
			'default'  => '',
			'sanitize' => 'sanitize_email',
		),
		'rinova_retention' => array(
			'label'    => __( 'Privacy: tempi di conservazione da applicare', 'rinova-casa' ),
			'default'  => __( 'DA DEFINIRE — specifica il periodo effettivamente applicato dal titolare e ai messaggi email.', 'rinova-casa' ),
			'sanitize' => 'sanitize_textarea_field',
		),
		'rinova_phone' => array(
			'label'    => __( 'Telefono', 'rinova-casa' ),
			'default'  => '',
			'sanitize' => 'sanitize_text_field',
		),
		'rinova_service_area' => array(
			'label'    => __( 'Zona servita', 'rinova-casa' ),
			'default'  => __( 'La tua zona', 'rinova-casa' ),
			'sanitize' => 'sanitize_text_field',
		),
	);

	foreach ( $settings as $setting_id => $setting ) {
		$wp_customize->add_setting(
			$setting_id,
			array(
				'default'           => $setting['default'],
				'sanitize_callback' => $setting['sanitize'],
				'transport'         => 'refresh',
			)
		);
		$wp_customize->add_control(
			$setting_id,
			array(
				'label'   => $setting['label'],
				'section' => 'rinova_home',
				'type'    => in_array( $setting_id, array( 'rinova_intro', 'rinova_meta_description', 'rinova_retention' ), true ) ? 'textarea' : 'text',
			)
		);
	}
}
add_action( 'customize_register', 'rinova_casa_customize_register' );

function rinova_casa_privacy_url() {
	$privacy_page = get_page_by_path( 'privacy' );

	return $privacy_page ? get_permalink( $privacy_page ) : home_url( '/privacy/' );
}

function rinova_casa_seo_metadata() {
	if ( class_exists( 'WPSEO_Frontend' ) || defined( 'RANK_MATH_VERSION' ) ) {
		return;
	}

	if ( is_front_page() ) {
		$description = get_theme_mod( 'rinova_meta_description', __( 'Impresa dimostrativa di ristrutturazioni: servizi, lavori e richiesta di informazioni.', 'rinova-casa' ) );
	} elseif ( is_singular() && has_excerpt() ) {
		$description = get_the_excerpt();
	} elseif ( is_singular() ) {
		$description = get_post_field( 'post_content', get_queried_object_id() );
	} else {
		$description = get_bloginfo( 'description' );
	}

	$description = trim( preg_replace( '/\s+/', ' ', wp_strip_all_tags( strip_shortcodes( $description ) ) ) );
	$description = wp_trim_words( $description, 30, '' );
	$url         = is_singular() ? get_permalink() : home_url( '/' );
	$title       = wp_get_document_title();
	$image       = is_singular() && has_post_thumbnail() ? get_the_post_thumbnail_url( null, 'large' ) : '';
	?>
	<meta name="description" content="<?php echo esc_attr( $description ); ?>">
	<meta property="og:type" content="<?php echo is_singular( 'post' ) ? 'article' : 'website'; ?>">
	<meta property="og:site_name" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
	<meta property="og:title" content="<?php echo esc_attr( $title ); ?>">
	<meta property="og:description" content="<?php echo esc_attr( $description ); ?>">
	<meta property="og:url" content="<?php echo esc_url( $url ); ?>">
	<?php if ( $image ) : ?>
		<meta property="og:image" content="<?php echo esc_url( $image ); ?>">
		<meta name="twitter:card" content="summary_large_image">
	<?php else : ?>
		<meta name="twitter:card" content="summary">
	<?php endif; ?>
	<meta name="twitter:title" content="<?php echo esc_attr( $title ); ?>">
	<meta name="twitter:description" content="<?php echo esc_attr( $description ); ?>">
	<?php
}
add_action( 'wp_head', 'rinova_casa_seo_metadata', 2 );

function rinova_contact_form_shortcode() {
	$status       = isset( $_GET['richiesta'] ) ? sanitize_key( wp_unslash( $_GET['richiesta'] ) ) : '';
	$message      = '';
	$message_role = 'status';

	if ( 'inviata' === $status ) {
		$message = __( 'Grazie, la richiesta è stata inviata. Ti ricontatteremo appena possibile.', 'rinova-casa' );
	} elseif ( 'errore' === $status ) {
		$message      = __( 'Non è stato possibile inviare la richiesta. Riprova o contattaci telefonicamente.', 'rinova-casa' );
		$message_role = 'alert';
	} elseif ( 'dati' === $status ) {
		$message      = __( 'Controlla i campi obbligatori e inserisci un indirizzo email valido.', 'rinova-casa' );
		$message_role = 'alert';
	}

	ob_start();
	?>
	<?php if ( $message ) : ?>
		<p class="form-notice <?php echo 'status' === $message_role ? 'form-notice--success' : 'form-notice--error'; ?>" role="<?php echo esc_attr( $message_role ); ?>"><?php echo esc_html( $message ); ?></p>
	<?php endif; ?>
	<form class="contact-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
		<input type="hidden" name="action" value="rinova_contact">
		<?php wp_nonce_field( 'rinova_contact', 'rinova_contact_nonce' ); ?>
		<div class="form-row">
			<div class="form-field">
				<label for="rinova-name"><?php esc_html_e( 'Nome', 'rinova-casa' ); ?></label>
				<input id="rinova-name" name="rinova_name" type="text" maxlength="120" autocomplete="name" required>
			</div>
			<div class="form-field">
				<label for="rinova-email"><?php esc_html_e( 'Email', 'rinova-casa' ); ?></label>
				<input id="rinova-email" name="rinova_email" type="email" maxlength="254" autocomplete="email" required>
			</div>
		</div>
		<div class="form-field">
			<label for="rinova-message"><?php esc_html_e( 'Raccontaci brevemente il tuo progetto', 'rinova-casa' ); ?></label>
			<textarea id="rinova-message" name="rinova_message" rows="4" maxlength="5000" required></textarea>
		</div>
		<div class="form-field form-field--trap" aria-hidden="true">
			<label for="rinova-website"><?php esc_html_e( 'Lascia vuoto questo campo', 'rinova-casa' ); ?></label>
			<input id="rinova-website" name="rinova_website" type="text" tabindex="-1" autocomplete="off">
		</div>
		<p class="form-privacy"><?php esc_html_e( 'Useremo i dati per rispondere alla richiesta. Non li salviamo nel database WordPress: il messaggio viene trasmesso via email. Consulta', 'rinova-casa' ); ?> <a href="<?php echo esc_url( rinova_casa_privacy_url() ); ?>"><?php esc_html_e( 'l’informativa privacy', 'rinova-casa' ); ?></a> <?php esc_html_e( 'prima di inviare.', 'rinova-casa' ); ?></p>
		<button class="button button--dark" type="submit"><?php esc_html_e( 'Invia la richiesta', 'rinova-casa' ); ?> <span aria-hidden="true">→</span></button>
	</form>
	<?php
	return ob_get_clean();
}
add_shortcode( 'rinova_contact_form', 'rinova_contact_form_shortcode' );

function rinova_handle_contact_form() {
	if (
		! isset( $_POST['rinova_contact_nonce'] ) ||
		! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['rinova_contact_nonce'] ) ), 'rinova_contact' )
	) {
		wp_die( esc_html__( 'Sessione scaduta. Torna indietro e invia di nuovo il modulo.', 'rinova-casa' ), '', array( 'response' => 403 ) );
	}

	$referer = wp_get_referer();
	$redirect_url = $referer ? $referer : home_url( '/' );

	if ( ! empty( $_POST['rinova_website'] ) ) {
		wp_die( esc_html__( 'Invio non valido.', 'rinova-casa' ), '', array( 'response' => 400 ) );
	}

	$name    = isset( $_POST['rinova_name'] ) ? sanitize_text_field( wp_unslash( $_POST['rinova_name'] ) ) : '';
	$email   = isset( $_POST['rinova_email'] ) ? sanitize_email( wp_unslash( $_POST['rinova_email'] ) ) : '';
	$message = isset( $_POST['rinova_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['rinova_message'] ) ) : '';

	if ( '' === $name || strlen( $name ) > 120 || strlen( $email ) > 254 || ! is_email( $email ) || '' === $message || strlen( $message ) > 5000 ) {
		wp_safe_redirect( add_query_arg( 'richiesta', 'dati', $redirect_url ) . '#richiedi-preventivo' );
		exit;
	}

	$recipient = sanitize_email( get_option( 'admin_email' ) );
	$subject   = sprintf(
		/* translators: %s: name of the person requesting a quote. */
		__( 'Nuova richiesta dal sito di %s', 'rinova-casa' ),
		$name
	);
	$body = sprintf(
		/* translators: 1: sender name, 2: sender email, 3: message body. */
		__( "Nome: %1\$s\nEmail: %2\$s\n\nMessaggio:\n%3\$s", 'rinova-casa' ),
		$name,
		$email,
		$message
	);
	$headers = array( 'Reply-To: ' . $email );

	if ( ! $recipient || ! wp_mail( $recipient, $subject, $body, $headers ) ) {
		wp_safe_redirect( add_query_arg( 'richiesta', 'errore', $redirect_url ) . '#richiedi-preventivo' );
		exit;
	}

	wp_safe_redirect( add_query_arg( 'richiesta', 'inviata', $redirect_url ) . '#richiedi-preventivo' );
	exit;
}
add_action( 'admin_post_nopriv_rinova_contact', 'rinova_handle_contact_form' );
add_action( 'admin_post_rinova_contact', 'rinova_handle_contact_form' );
