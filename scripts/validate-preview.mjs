import assert from 'node:assert/strict';
import { readFile } from 'node:fs/promises';
import { dirname, resolve } from 'node:path';
import { fileURLToPath } from 'node:url';

const root = resolve(dirname(fileURLToPath(import.meta.url)), '..');
const html = await readFile(resolve(root, 'preview-build/index.html'), 'utf8');
const requiredFiles = [
  'assets/css/theme.css',
  'assets/css/preview.css',
  'assets/js/navigation.js',
  'assets/images/preview.svg',
];
const elementIds = [...html.matchAll(/\bid="([^"]+)"/g)].map((match) => match[1]);
const fragments = [...html.matchAll(/\bhref="#([^"]+)"/g)].map((match) => match[1]);

assert.match(html, /<html lang="it">/);
assert.match(html, /<meta name="robots" content="noindex, nofollow">/);
assert.match(html, /<meta name="description" content="[^"]+">/);
assert.match(html, /<meta property="og:image" content="https:\/\/federicocroletti-tech\.github\.io\/rinova-casa\/assets\/images\/preview\.svg">/);
assert.match(html, /id="privacy-preview"/);
assert.match(html, /non raccoglie dati/i);
assert.match(html, /disabled/);
assert.doesNotMatch(html, /<form\b/i, 'The static preview must not collect or submit form data.');
assert.doesNotMatch(html, /<iframe\b|<script\b[^>]+src="https?:/i, 'The preview must not load third-party embeds or scripts.');
assert.doesNotMatch(html, /fonts\.googleapis\.com|googletagmanager|google-analytics|plausible\.io/i);
assert.equal(elementIds.length, new Set(elementIds).size, 'HTML IDs must be unique.');
assert.ok(fragments.length > 0, 'The preview should contain internal navigation links.');
assert.ok(
  fragments.every((fragment) => elementIds.includes(fragment)),
  'Every in-page link must point to an existing section.',
);
assert.match(html, /<h1\b/);
assert.match(html, /aria-label="Menu principale"/);

for (const path of requiredFiles) {
  await readFile(resolve(root, 'preview-build', path));
}

console.log('Verified preview assets, SEO metadata, accessible navigation, in-page links and no-data-collection safeguards.');
