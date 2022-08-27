<?php
/**
 * Виджет контактов.
 *
 * https://wordpress.stackexchange.com/questions/130001/elegantly-using-javascript-on-widget-admin-forms
 * https://stackoverflow.com/questions/13863087/wordpress-custom-widget-image-upload
 *
 * @package __theme
 */

namespace THKKZ\Custom\Widget;

class Contact extends \WP_Widget
{
  /**
   * Регистрация виджета в WordPress.
   */
  public function __construct()
  {
    parent::__construct(
      'header-contact', // Base ID
      __( 'Контакты', '__theme' ), // Name
      array('description' => __( 'Картинка, заголовок, телефон, email', '__theme' ),) // Args
    );

    add_action( 'admin_enqueue_scripts', array( $this, 'scripts' ) );
  }

  public function scripts()
  {
    wp_enqueue_script( 'media-upload' );
    wp_enqueue_media();
    wp_enqueue_script( '__theme-feature-widget', THEME_URI . '/assets/js/widget/feature-widget.js', array( 'jquery' ) );
  }

  /**
   * Разметка виджета в пользовательской части сайта.
   *
   * @see WP_Widget::widget()
   *
   * @param array $args     Аргументы.
   * @param array $instance Сохраненные значения из базы данных.
   */
  public function widget( $args, $instance )
  {
    // Переменные из настроек виджета
    $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Нет заголовка', '__theme' ) : $instance['title'] );
    $image_vector = ! empty( $instance['image-vector'] ) ? $instance['image-vector'] : '';
    $image_raster = ! empty( $instance['image-raster'] ) ? $instance['image-raster'] : '';
    $phone = ! empty( $instance['phone'] ) ? $instance['phone'] : '';
    $email = ! empty( $instance['email'] ) ? $instance['email'] : '';

    ob_start();
    echo $args['before_widget'];
  ?>

  <?php if ( ! empty( $instance['title'] ) ) : ?>
    <?php echo $args['before_title'] . esc_html( $title, '__theme') . $args['after_title']; ?>
  <?php endif; ?>

  <?php if ( ! empty( $image_raster ) || ! empty( $image_vector ) ) : ?>
    <p class="widget-img">
      <?php if ( $image_raster ) : ?>
        <img src="<?php echo esc_url( $image_raster ); ?>" alt="<?php esc_attr_e( 'Миниатюра', '__theme' ) ?>">
      <?php elseif( $image_vector ) : ?>
        <?php echo $image_vector; ?>
      <?php endif; ?>
    </p>
  <?php endif; ?>

  <?php if ( ! empty( $instance['phone'] ) ) : ?>
    <p class="widget-phone">
      <?php echo '<a href="tel:' . $phone . '">' . $phone . '</a>'; ?>
    </p>
  <?php endif; ?>

  <?php if ( ! empty( $instance['email'] ) ) : ?>
    <p class="widget-email">
      <?php echo '<a href="mailto:' . $email . '">' . $email . '</a>'; ?>
    </p>
  <?php endif; ?>

  <?php
    echo $args['after_widget'];
    ob_end_flush();
  }

  /**
   * Настройка виджета в админке.
   *
   * @see WP_Widget::form()
   *
   * @param array $instance Ранее сохраненные значения из базы данных.
   */
  public function form( $instance )
  {
    $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
    $image_vector = ! empty( $instance['image-vector'] ) ? $instance['image-vector'] : '';
    $image_raster = ! empty( $instance['image-raster'] ) ? $instance['image-raster'] : '';
    $phone = ! empty( $instance['phone'] ) ? $instance['phone'] : '';
    $email = ! empty( $instance['email'] ) ? $instance['email'] : '';
  ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Заголовок:', '__theme' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" placeholder="<?php esc_attr_e( 'Заголовок', '__theme' ); ?>">
    </p>

    <hr>
    <button class="button-vector button button-primary" type="button">Векторная картинка</button>
    <button class="button-raster button button-green" type="button">Растровая картинка</button>
    <hr>

    <p class="indicator-vector" style="display: block;">
      <label for="<?php echo $this->get_field_id( 'image-vector' ); ?>"><?php esc_html_e( 'Изображение векторное:', '__theme' ); ?></label>
      <textarea class="widefat" id="<?php echo $this->get_field_id( 'image-vector' ); ?>" name="<?php echo $this->get_field_name( 'image-vector' ); ?>" cols="30" rows="10" placeholder="<?php esc_html_e( 'SVG разметка', '__theme' ); ?>"><?php echo $image_vector; ?></textarea>
    </p>
    <div class="indicator-raster" style="display: none;">
      <label for="<?php echo $this->get_field_id( 'image-raster' ); ?>"><?php esc_html_e( 'Изображение растовое:', '__theme' ); ?></label><br>
      <input id="<?php echo $this->get_field_id( 'image-raster' ); ?>" name="<?php echo $this->get_field_name( 'image-raster' ); ?>" type="text" value="<?php echo esc_url( $image_raster ); ?>" />
      <button class="upload-button button button-primary"><?php esc_html_e( 'Загрузить изображение', '__theme' ); ?></button>
      <div class="upload-image">
        <?php if ($image_raster) : ?>
          <p><img src="<?php echo esc_url( $image_raster ); ?>" alt="" style="max-width: 100%; height: auto;"></p>
        <?php endif; ?>
      </div>
    </div>

    <hr>
    <p>
      <label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php esc_html_e( 'Телефон:', '__theme' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'phone' ); ?>" type="tel" name="<?php echo $this->get_field_name( 'phone' ); ?>" value="<?php echo esc_html( $phone ); ?>" placeholder="<?php esc_html_e( 'Введите телефон', '__theme' ); ?>">
      <!-- <textarea class="widefat" id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" placeholder="<?php esc_html_e( 'Введите телефон', '__theme' ); ?>" cols="20" rows="10"><?php echo $phone; ?></textarea> -->
    </p>
    <hr>
    <p>
      <label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php esc_html_e( 'Email:', '__theme' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'email' ); ?>" type="email" name="<?php echo $this->get_field_name( 'email' ); ?>" value="<?php echo esc_html( $email ); ?>" placeholder="<?php esc_html_e( 'Введите email', '__theme' ); ?>">
    </p>
  <?php
  }

  /**
   * Сохранение данных виджета в БД.
   *
   * @see WP_Widget::update()
   *
   * @param array $new_instance Значения только что отправлены для сохранения.
   * @param array $old_instance Ранее сохраненные значения из базы данных.
   *
   * @return array Обновленные безопасные значения для сохранения.
   */
  public function update($new_instance, $old_instance)
  {
    $instance = array();

    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    $instance['image-vector'] = ( ! empty( $new_instance['image-vector'] ) ) ? $new_instance['image-vector'] : '';
    $instance['image-raster'] = ( ! empty( $new_instance['image-raster'] ) ) ? $new_instance['image-raster'] : '';
    $instance['phone'] = ( ! empty( $new_instance['phone'] ) ) ? $new_instance['phone'] : '';
    $instance['email'] = ( ! empty( $new_instance['email'] ) ) ? $new_instance['email'] : '';

    return $instance;
  }
}
