<?php
/**
 * Настройка загрузки изображений.
 *
 * @package __theme
 */

namespace THKKZ\Custom\Extra;

class Image
{
	/**
	 * Регистрация hooks и actions для WordPress.
   *
	 * @return
	 */
	public function register()
	{
		add_filter( 'upload_mimes', array( $this, 'upload_allow_types' ) );
    add_filter( 'wp_check_filetype_and_ext', array( $this, 'svg_mime_type' ), 10, 5 );
    add_filter( 'wp_prepare_attachment_for_js', array( $this, 'show_svg_in_media_library' ) );
    add_filter( 'image_downsize', array( $this, 'fix_svg_size_attributes' ), 10, 2 );
	}

  /**
   * Допустимые MIME-типы загружаемых на сайт файлов.
   *
   * @param $mimes поддерживаемы MIME типы
   *
   * @return mixed|string
   */
  public function upload_allow_types( $mimes )
  {
    // разрешаем новые типы
    if( current_user_can('manage_options') ) {
      $mimes['svg']  = 'image/svg+xml';
    }

    // запрещаем (отключаем) имеющиеся
    // unset( $mimes['mp4a'] );

    return $mimes;
  }

  /**
   * Разрешаем загрузку svg файлов.
   *
   * @return array $data
   */
  public function svg_mime_type( $data, $file, $filename, $mimes, $real_mime = '' )
  {
    // WP 5.1 +
    if( version_compare( $GLOBALS['wp_version'], '5.1.0', '>=' ) )
      $svg = in_array( $real_mime, [ 'image/svg', 'image/svg+xml' ] );
    else
      $svg = ( '.svg' === strtolower( substr($filename, -4) ) );

    // mime тип был обнулен, поправим его
    // а также проверим право пользователя
    if( $svg ){

      // разрешим
      if( current_user_can('manage_options') ) {
        $data['ext']  = 'svg';
        $data['type'] = 'image/svg+xml';
      }
      // запретим
      else {
        $data['ext'] = $type_and_ext['type'] = false;
      }
    }

    return $data;
  }

  /**
   * Отображаем миниатюру svg в медиатеке.
   *
   * @param $mime Тип файлы
   *
   * @return array $mime
   */
  public function show_svg_in_media_library( $mime )
  {
    // Если svg
    if ( $mime['mime'] === 'image/svg+xml' ) {
      // С выводом названия файла
      $mime['image'] = [
        'src' => $mime['url'],
      ];
    }

    return $mime;
  }

  /**
    * Удаляет атрибуты ширины и высоты тегов <img> для SVG
    *
    * Без этого фильтра ширина и высота устанавливаются на "1", поскольку
    * Ядро WordPress не может определить размеры файла SVG.
    *
    * Для SVG: s возвращает массив с установленными URL-адресом файла, шириной и высотой.
    * на null и false для is_intermediate.
   *
   * @wp-hook image_downsize
   * @param mixed $out Value to be filtered
   * @param int $id Attachment ID for image.
   * @return bool|array False if not in admin or not SVG. Array otherwise.
   */
  public function fix_svg_size_attributes( $out, $id )
  {
    $image_url  = wp_get_attachment_url( $id );
    $file_ext   = pathinfo( $image_url, PATHINFO_EXTENSION );

    if ( is_admin() || 'svg' !== $file_ext ) {
        return false;
    }

    return array( $image_url, null, null, false );
  }

}
