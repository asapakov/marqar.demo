<?php
/**
 * Регистрация размеров изображений.
 *
 * @package __theme
 */

namespace THKKZ\Setup;

class Image
{
  /**
   * Регистрация hooks и actions для WordPress.
   *
   * @return
   */
  public function register()
  {
    add_action( 'after_setup_theme', array( $this, 'images' ) );
    add_filter( 'image_size_names_choose', array( $this, 'admin_sizes' ) );
  }

  /**
   * Изображения.
   *
   * Для отмены регистрации виджета используйте unregister_sidebar( 'name' );
   *
   * @return
   */
  public function images()
  {
    // Добавить дополнительный размер изображения.
    // Дополнение: смотрите фильтр image_size_names_choose и метод admin_sizes
    // add_image_size( 'homepage-thumb', 768, 300, array( 'center', 'top') );
    // add_image_size( 'homepage-thumb', 333, 302, true );

    // Удалить дополнительный размер изображения.
    // remove_image_size( 'homepage-thumb' );

    // После удаления можно заного добавить изображение с таким же id, переопределив его размеры.
    // add_image_size( 'homepage-thumb', 300, 150 );
  }

  /**
   * Добавляет новый размер изображения в меню выбора при вставке картинки (админ-панель)
   *
   * При регистрации своего размера изображения, укажите его имя здесь
   * для того, чтобы можно было выбрать его в меню вабора размера.
   *
   * @param array $sizes Размеры картинок
   *
   * @link https://wp-kama.ru/function/add_image_size
   *
   * @return array sizes Slug => описание картинок
   */
  public function admin_sizes( $sizes )
  {
    return array_merge( $sizes, array(
      // 'homepage-thumb' => 'Изображение на главной',
    ) );
  }
}
