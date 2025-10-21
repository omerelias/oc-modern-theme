<?php
// add_action('wp_head', function () {
//     if (defined('WP_DEBUG') && WP_DEBUG) {
//         $vite_dev_url = 'http://localhost:5173';
//         ?>
//         <script type="module" src="<?php echo esc_url($vite_dev_url); ?>/@vite/client"></script>
//         <script type="module">
//             import RefreshRuntime from '<?php echo esc_url($vite_dev_url); ?>/@react-refresh'
//             RefreshRuntime.injectIntoGlobalHook(window)
//             window.$RefreshReg$ = () => {}
//             window.$RefreshSig$ = () => (type) => type
//             window.__vite_plugin_react_preamble_installed__ = true
//         </script>
//         <script type="module" src="<?php echo esc_url($vite_dev_url); ?>/src/main.tsx"></script>
//         <?php
//     }
// });

require_once get_template_directory() . '/inc/enqueue.php';
