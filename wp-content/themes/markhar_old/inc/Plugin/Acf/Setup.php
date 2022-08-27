<?php
/**
 * ACF PRO
 * 
 * Базовые настройки.
 *
 * @link https://www.advancedcustomfields.com/resources/local-json/
 *
 * @package __theme
 */

namespace THKKZ\Plugin\Acf;

class Setup
{
	/**
	 * Регистрация hooks и actions для WordPress.
   *
	 * @return
	 */
  public function register()
  {
    add_filter( 'acf/settings/save_json', array( &$this, 'acf_json_save_point' ) );
    add_filter( 'acf/settings/load_json', array( &$this, 'acf_json_load_point' ) );
  }

  public function acf_json_save_point( $path )
  {
    // update path
    $path = THEME_DIR . '/acf-json';

    // return
    return $path;
  }

  public function acf_json_load_point( $paths )
  {
    // remove original path (optional)
    unset( $paths[0] );

    // append path
    $paths[] = THEME_DIR . '/acf-json';

    // return
    return $paths;
  }
}
