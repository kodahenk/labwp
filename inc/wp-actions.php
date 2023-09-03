<?php

if (!defined('ABSPATH')) {
  die('are you bad boy/girl :(');
}

/**
 * Sitede kullanılacak add_action fonksiyonları
 */

/**
 * Undocumented function
 *
 * @return void
 */
function _do_setup()
{
  load_theme_textdomain('devorhan', _DO_DIR . '/languages');

  add_theme_support('title-tag');

  add_theme_support('post-thumbnails');

  register_nav_menus(
    array(
      'menu-1' => esc_html__('Primary', '_s'),
    )
  );

  add_theme_support(
    'html5',
    array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
      'style',
      'script',
    )
  );

  add_theme_support(
    'custom-background',
    apply_filters(
      '_s_custom_background_args',
      array(
        'default-color' => 'ffffff',
        'default-image' => '',
      )
    )
  );

  add_theme_support('customize-selective-refresh-widgets');

  add_theme_support(
    'custom-logo',
    array(
      'height'      => 250,
      'width'       => 250,
      'flex-width'  => true,
      'flex-height' => true,
    )
  );
}
add_action('after_setup_theme', '_do_setup');

function _do_scripts()
{
  wp_enqueue_style('devorhan', get_stylesheet_uri(), array(), _DO);
  // wp_enqueue_style('devorhan', get_stylesheet_uri(), array(), _DO);
  // wp_enqueue_script('_s-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _DO, true);
}
add_action('wp_enqueue_scripts', '_do_scripts');


/**
 * Özel bir WordPress teması veya eklentisi tarafından kullanılabilecek permalink (kalıcı bağlantı) yapısını ayarlayan fonksiyon.
 *
 * Bu fonksiyon, yeni permalink yapısını belirler ve `permalink_structure` ayarını günceller.
 * Ayrıca, yeni yapının etkili olması için rewrite kurallarını yeniden yükler (isteğe bağlı).
 *
 * Bu fonksiyon, tema etkinleştirildiğinde veya yeniden etkinleştirildiğinde çağrılabilir.
 * Ancak, dikkatli olunmalıdır çünkü permalink yapısının değiştirilmesi mevcut bağlantıları etkileyebilir.
 *
 * @link https://developer.wordpress.org/reference/functions/update_option/
 * @link https://developer.wordpress.org/reference/functions/flush_rewrite_rules/
 */
function custom_set_permalink_structure() {
  // Yeni permalink yapısını belirleyin
  $permalink_structure = '/%category%/%postname%/'; // Örnek bir yapı
  
  // permalink_structure ayarını güncelleyin
  update_option('permalink_structure', $permalink_structure);
  
  // Rewrite kuralını yeniden yükle (isteğe bağlı)
  flush_rewrite_rules();
}

// Tema etkinleştirildiğinde veya yeniden etkinleştirildiğinde çağrılmasını isterseniz aşağıdaki satırı ekleyebilirsiniz.
add_action('after_switch_theme', 'custom_set_permalink_structure');
