<?php
/**
 * Изображение заголовка в кастомайзере
 *
 * Чаще используется для внутренних страниц.
 * Сразу после шапки сайта идет секция с названием страницы и ее описанием.
 * На заднем фоне этой секции располагается изображение, которое задается с помощью данных настроек.
 *
 * Пример вывода изображения заголовка
 * <?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package __theme
 */

namespace THKKZ\Core\Customizer;

class HeaderImage
{
	/**
	 * Регистрация hooks и actions для WordPress.
   *
	 * @return
	 */
	public function register()
	{
    add_action( 'after_setup_theme', array( $this, 'setup' ) );
    $this->register_default_headers();
	}

  /**
   * Добавляем в кастомайзер изображение заголовка
   *
   * Данная функция добавит в кастомайзер (настройщик) пункт с настройками заголовка.
   *
   * @uses style()
   */
  public function setup()
  {
    $args = array(
      // Изображение по умолчанию.
      'default-image'      => get_theme_file_uri() . '/assets/images/default-header-image.jpg',
      // Отображать текст заголовка вместе с изображением.
      'header-text'        => true,
      // Цвет текста заголовка по умолчанию.
      'default-text-color' => '000',
      // Ширина изображения в px.
      'width'              => 1200,
      // Высота изображения в px.
      'height'             => 530,
      // Гибкая ширина изображения.
      'flex-width'         => true,
      // Гибкая высота изображения.
      'flex-height'        => true,
      // Случайное изображение по умолчанию.
      'random-default'     => true,
      // Разрешить загрузку файла изображения в админке.
      'uploads'            => false,
      // Callback функция, которая будет вызываться в разделе заголовка темы.
      'wp-head-callback'   => array( $this, 'style' ),
      // Callback функция, которая будет вызываться в разделе заголовка страницы предварительного просмотра.
      'admin-head-callback' => '',
      // Callback функция для создания разметки предварительного просмотра на экране администратора.
      'admin-preview-callback' => '',
    );

    // В дальнейшем можно переопределить параметры через фильтр.
    $custom_header = apply_filters( '__theme_custom_header_args', $args );

    add_theme_support( 'custom-header', $custom_header );
  }

  /**
   * Стили изображения заголовка и текста
   *
   * Функция обратного вызова для настраиваемой шапки.
   *
   * @see setup()
   */
	public function style()
  {
    // Получаем цвет текста для шапки (заголовка).
    // Цвет устанавливается в настройках темы, если в теме включена опция 'default-text-color'.
		$header_text_color = get_header_textcolor();

    // Если пользовательские параметры для текста не заданы или 'header-text' = false завершаем функцию.
    // get_header_textcolor() содержит: Любое hex значение, 'blank' скроет текст. Поумолчанию: add_theme_support( 'custom-header' ).
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

    // Динамические стили для заголовка.
    // Измените название классов, соответствующих вашей разметке.
		?>
		<style type="text/css">
		<?php
		// Скрываем текст если параметр 'header-text' = false.
		if ( ! display_header_text() ) :
			?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
				}
			<?php
			// Показываем текст если параметр 'header-text' = true.
		else :
			?>
			.site-title a,
			.site-description {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
      }
		<?php endif; ?>
		</style>
		<?php
	}

  /**
   * Регистрируем множественные изображения по умолчанию для изображений заголовка.
   *
   * Данные изображения добавятся к изображению 'default-image'.
   */
  protected function register_default_headers()
  {
    register_default_headers( array(
      'one' => array(
              'url'           => THEME_URI . '/assets/images/one-header-image.jpg',
              'thumbnail_url' => THEME_URI . '/assets/images/one-header-image.jpg',
              'description'   => esc_attr__( 'Первое изображение', '__theme' ),
      ),
      'two' => array(
              'url'           => THEME_URI . '/assets/images/two-header-image.jpg',
              'thumbnail_url' => THEME_URI . '/assets/images/two-header-image.jpg',
              'description'   => esc_attr__( 'Второе изображение', '__theme' ),
      ),
    ) );
  }
}
