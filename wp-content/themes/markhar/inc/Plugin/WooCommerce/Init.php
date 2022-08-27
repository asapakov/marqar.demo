<?php
/**
 *
 * Инициализация WooCommerce.
 *
 * @package __theme
 */

namespace THKKZ\Plugin\WooCommerce;

class Init
{
  /**
   * 
   */
  public function __construct()
  {
    if ( ! class_exists( 'WooCommerce') ) return;

    $this->register_services();
  }

	/**
	 * Храните все классы внутри массива
   *
	 * @return array Полный список классов
	 */
	public static function get_services()
	{
		return [
			Setup::class,
			Extra::class,
			Tag\Cart::class,
		];
	}

	/**
	 * Инициализация всех заданных классов темы.
   *
	 * @return
	 */
	public function register_services()
	{
		foreach ( self::get_services() as $class ) {
			$service = self::instantiate( $class );

			if ( method_exists( $service, 'register') ) {
				$service->register();
			}
		}
	}

	/**
	 * Инициализация класса.
   * 
	 * @param  class $class
   * 
	 * @return class instance
	 */
	private static function instantiate( $class )
	{;
		return new $class();
	}

}
