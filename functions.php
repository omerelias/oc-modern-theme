<?php
// Development mode control
define('OC_THEME_DEV_MODE', false); // Set to false for production
define('OC_THEME_VITE_PORT', 5173); // Vite dev server port

// Clean functions.php - all asset loading is handled in enqueue.php
require_once get_template_directory() . '/inc/enqueue.php';
