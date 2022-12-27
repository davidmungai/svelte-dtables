import { sveltekit } from '@sveltejs/kit/vite';
import AutoImport from 'unplugin-auto-import/vite';
/** @type {import('vite').UserConfig} */
const config = {
	plugins: [
		sveltekit(),
		AutoImport({
			imports: ['vitest'],
			dts: true // generate TypeScript declaration
		})
	],
	test: {
		include: ['src/**/*.{test,spec}.{js,ts}']
	},
	server: {
		fs: {
			// Allow serving files from one level up to the project root
			allow: ['..']
		}
	}
};

export default config;
