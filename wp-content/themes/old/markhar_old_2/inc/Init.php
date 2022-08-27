<?php
/**
 *
 * Инициализация темы.
 *
 * @package __theme
 */

namespace THKKZ;

class Init
{
  private static $instance;

  protected function __construct() {}
  protected function __clone() {}
  public function __wakeup()
  {
    throw new \Exception("Cannot unserialize a singleton.");
  }

  public static function get_instance()
  {
    if ( ! ( self::$instance instanceof self ) ) {
      self::$instance = new self;
    }

    return self::$instance;
  }

	/**
	 * Храните все классы внутри массива
   *
	 * @return array Полный список классов
	 */
	public static function get_services()
	{
		return [
      Setup\Deregister::class,
      Setup\Fix::class,
      Setup\Setup::class,
      Setup\Enqueue::class,
      Setup\Image::class,
      Setup\Menu::class,
      Setup\Widget::class,

      Core\Customizer\HeaderImage::class,

      Custom\Extra\Extra::class,
      Custom\Extra\Comment::class,
      Custom\Extra\Pagination::class,
      Custom\Extra\Image::class,
      Custom\Menu\MainNavMenu::class,
      Custom\Widget\Contact::class,

			Tag\Article::class,

			Plugin\Acf\Setup::class,
			Plugin\Acf\Extra::class,
			Plugin\WooCommerce\Init::class,
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
	{
		return new $class();
	}

}
