import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [react()],
  server: {
    origin: 'http://localhost:5173',
    cors: true,
    strictPort: true,
    port: 5173,
  },
  build: {
    manifest: true,
    outDir: 'dist',
    emptyOutDir: true,
    // Optimize build
    minify: 'terser',
    terserOptions: {
      compress: {
        drop_console: true,
        drop_debugger: true,
      },
    },
    rollupOptions: {
      input: '/src/main.tsx', // Fixed: now points to .tsx
      output: {
        manualChunks: {
          vendor: ['react', 'react-dom'],
        },
      },
    },
    // Optimize assets
    assetsInlineLimit: 4096,
    cssCodeSplit: true,
    sourcemap: false, // Disable sourcemaps for production
  },
})
