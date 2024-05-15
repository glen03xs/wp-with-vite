import { defineConfig, loadEnv } from 'vite'

export default ({ mode }) => {
	process.env = { ...process.env, ...loadEnv(mode, process.cwd()) }

	return defineConfig({
		base: `/wp-content/themes/${process.env.VITE_THEME_FOLDER}`,
		// publicDir: 'public',
		server: {
			watch: {
				usePolling: true,
			  },
			host: 'localhost',
			open: process.env.VITE_SITE_URL,
		},
		css: {
			devSourcemap: true 
		  },
		build: {
			outDir: 'dist',
			assetsDir: '.',
			emptyOutDir: true,
			copyPublicDir: false,
			manifest: true,
			rollupOptions: {
				input: ['src/js/main.js', 'src/scss/styles.scss'],
				output: {
					entryFileNames: '[name].js',
					assetFileNames: '[name].[ext]',
				  },
			},
		},
		// plugins: [
		// 	{
		// 		name: 'twig-reload',
		// 		handleHotUpdate({ file, server }) {
		// 			if (file.endsWith('.twig')) {
		// 				server.ws.send({ type: 'full-reload', path: '*' })
		// 			}
		// 		},
		// 	},
		// ],
	})
}
