<?php
function oc_enqueue_assets() {
    // Use theme constants for clean control
    $is_vite = defined('OC_THEME_DEV_MODE') && OC_THEME_DEV_MODE;
    // Fallback: Check environment variables/constants
    if (!$is_vite && defined('WP_DEBUG') && WP_DEBUG && 
        (isset($_GET['vite']) || 
         (defined('WP_ENV') && WP_ENV === 'development') ||
         (defined('WP_ENVIRONMENT_TYPE') && WP_ENVIRONMENT_TYPE === 'local'))) {
        $is_vite = true;
    }
    
    // Method 2: Check if dist folder doesn't exist (development mode)
    if (!$is_vite) {
        $theme_dir = get_stylesheet_directory();
        $manifest_path = $theme_dir . '/dist/.vite/manifest.json';
        if (!file_exists($manifest_path)) {
            $is_vite = true;
        }
    }
    
    // Method 3: Fast port check (only if needed)
    if (!$is_vite) {
        static $port_check = null;
        if ($port_check === null) {
            $vite_server = 'http://localhost:5173';
            $context = stream_context_create([
                'http' => [
                    'timeout' => 0.3, // Very fast timeout
                    'method' => 'HEAD'
                ]
            ]);
            $port_check = @file_get_contents($vite_server . '/@vite/client', false, $context) ? true : false;
        }
        $is_vite = $port_check;
    }

    if ( $is_vite ) {
        $vite_port = defined('OC_THEME_VITE_PORT') ? OC_THEME_VITE_PORT : 5173;
        $vite_server = 'http://localhost:' . $vite_port;
        wp_enqueue_script_module( 'oc-vite-client', $vite_server . '/@vite/client', [], null, [] );
        wp_enqueue_script_module( 'oc-main', $vite_server . '/src/main.tsx', [], null, ['in_footer' => true] );
        add_action('wp_head', function () {
            // רק במצב פיתוח (אם צריך)
            if (defined('WP_DEBUG') && WP_DEBUG) {
                $vite_dev_url = 'http://localhost:5173';
                ?>
                <!-- Vite HMR -->
                <script type="module" src="<?php echo esc_url($vite_dev_url); ?>/@vite/client"></script>
        
                <!-- React preamble -->
                <script type="module">
                    import RefreshRuntime from '<?php echo esc_url($vite_dev_url); ?>/@react-refresh'
                    RefreshRuntime.injectIntoGlobalHook(window)
                    window.$RefreshReg$ = () => {}
                    window.$RefreshSig$ = () => (type) => type
                    window.__vite_plugin_react_preamble_installed__ = true
                </script>
        
                <!-- Scripts -->
                <script type="module" src="<?php echo esc_url($vite_dev_url); ?>/src/main.tsx"></script>
                <?php
            }
        });
        
    } else {
        // build mode - cache manifest data
        static $manifest_data = null;
        if ($manifest_data === null) {
            $theme_dir   = get_stylesheet_directory();
            $theme_uri   = get_stylesheet_directory_uri();
            $manifest    = $theme_dir . '/dist/.vite/manifest.json';

            if ( file_exists( $manifest ) ) {
                $manifest_data = [
                    'data' => json_decode( file_get_contents( $manifest ), true ),
                    'theme_uri' => $theme_uri
                ];
            }
        }

        if ( $manifest_data && isset($manifest_data['data']['src/main.tsx']) ) {
            $entry = $manifest_data['data']['src/main.tsx'];
            $theme_uri = $manifest_data['theme_uri'];

            if ( ! empty( $entry['css'] ) ) {
                foreach ( $entry['css'] as $css ) {
                    wp_enqueue_style( 'oc-style', $theme_uri . '/dist/' . $css, [], null );
                }
            }

            wp_enqueue_script_module( 'oc-main', $theme_uri . '/dist/' . $entry['file'], [], null, [] );
        }
    }
    
    // Only localize if we have a script to localize
    if ( wp_script_is( 'oc-main', 'enqueued' ) ) {
        wp_localize_script('oc-main', 'OC_THEME', [
            'ajaxUrl'  => admin_url('admin-ajax.php'),
            'storeApi' => get_rest_url(null, 'wc/store/v1/'),
            'nonce'    => wp_create_nonce('oc_theme'),
        ]);
    }
}
add_action( 'wp_enqueue_scripts', 'oc_enqueue_assets', 20 );
