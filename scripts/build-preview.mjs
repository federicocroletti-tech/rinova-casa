import { cp, mkdir, readFile, writeFile } from 'node:fs/promises';
import { dirname, resolve } from 'node:path';
import { fileURLToPath } from 'node:url';

const root = resolve(dirname(fileURLToPath(import.meta.url)), '..');
const output = resolve(root, 'preview-build');

await mkdir(output, { recursive: true });
await mkdir(resolve(output, 'assets/css'), { recursive: true });
await mkdir(resolve(output, 'assets/js'), { recursive: true });
await mkdir(resolve(output, 'assets/images'), { recursive: true });
await writeFile(
  resolve(output, 'index.html'),
  await readFile(resolve(root, 'preview/index.html'), 'utf8'),
);
await cp(resolve(root, 'assets/css/theme.css'), resolve(output, 'assets/css/theme.css'));
await cp(resolve(root, 'assets/css/preview.css'), resolve(output, 'assets/css/preview.css'));
await cp(resolve(root, 'assets/js/navigation.js'), resolve(output, 'assets/js/navigation.js'));
await cp(resolve(root, 'assets/images/preview.svg'), resolve(output, 'assets/images/preview.svg'));

console.log(`Built standalone theme preview in ${output}`);
