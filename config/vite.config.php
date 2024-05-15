<?php

add_action('wp_enqueue_scripts', function () {
 $manifestPath = get_theme_file_path('dist/manifest.json');

 if (is_array(wp_remote_get('http://localhost:5173/'))) {

  wp_enqueue_script('vite', 'http://localhost:5173/@vite/client', [], null);
  wp_enqueue_script('main-js', 'http://localhost:5173/wp-content/themes/twentytwentyfour/src/js/main.js', ['jquery'], null, true);
//   wp_enqueue_style('style-css', 'http://localhost:5173wp-content/themes/twentytwentyfour/src/scss/styles.scss', [], 'null');

 } elseif (file_exists($manifestPath)) {

  wp_enqueue_script('main-js', get_theme_file_uri('dist/main.js'), ['jquery'], null, true);
  wp_enqueue_style( 'main-style', get_stylesheet_directory_uri() . '/dist/styles.css', array(), rand(111,9999), 'all' );

 }
});

// Load scripts as modules.
add_filter('script_loader_tag', function (string $tag, string $handle, string $src) {
 if (in_array($handle, ['vite', 'main-js'])) {
  return '<script type="module" src="' . esc_url($src) . '" defer></script>';
 }

 return $tag;
}, 10, 3);
