<?php
function oc_enqueue_assets() {
    $vite_server = 'http://localhost:5173';
    $is_vite     = @file_get_contents($vite_server . '/@vite/client') ? true : false;

    if ( $is_vite ) {
        wp_enqueue_script_module( 'oc-vite-client', $vite_server . '/@vite/client', [], null, false );
        wp_enqueue_script_module( 'oc-main', $vite_server . '/src/main.tsx', [], null, true );
    } else {
        // build mode
        $theme_dir   = get_stylesheet_directory();
        $theme_uri   = get_stylesheet_directory_uri();
        $manifest    = $theme_dir . '/dist/.vite/manifest.json';

        if ( file_exists( $manifest ) ) {
            $data  = json_decode( file_get_contents( $manifest ), true );
            $entry = $data['src/main.tsx'];

            if ( ! empty( $entry['css'] ) ) {
                foreach ( $entry['css'] as $css ) {
                    wp_enqueue_style( 'oc-style', $theme_uri . '/dist/' . $css, [], null );
                }
            }

            wp_enqueue_script_module( 'oc-main', $theme_uri . '/dist/' . $entry['file'], [], null, true );
        }
    }
    wp_localize_script('oc-main', 'OC_THEME', [
        'ajaxUrl'  => admin_url('admin-ajax.php'),
        'storeApi' => get_rest_url(null, 'wc/store/v1/'),
        'nonce'    => wp_create_nonce('oc_theme'),
    ]);
}
add_action( 'wp_enqueue_scripts', 'oc_enqueue_assets', 20 );
