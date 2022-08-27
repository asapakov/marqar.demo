<?php
/**
 * Таксономия брэндов для продуктов WooCommerce.
 *
 * @package __theme
 */

namespace THKKZ\Custom\Taxonomy;

class BrandProduct
{

	/**
	 * @return
	 */
  public function __construct()
  {
    if ( ! class_exists( 'WooCommerce' ) ) return;
  }

	/**
	 * Регистрация hooks и actions для WordPress.
   *
	 * @return
	 */
  public function register()
  {
    if ( ! class_exists( 'WooCommerce' ) ) return;

    add_action( 'init', array( $this, 'init' ), 0 );
    add_action( 'save_post', array( $this, 'set_default_object_terms' ), 100, 2 );
    add_action( 'after_switch_theme', array( $this, 'rewrite_flush') );
  }

  /**
   * Создание пользовательской таксономии
   */
  public function init()
  {
    $labels = array(
      'name'                       => _x( 'Производители', 'Производители', '__theme' ),
      'singular_name'              => _x( 'Производители', 'Производители', '__theme' ),
      'menu_name'                  => __( 'Производители', '__theme' ),
      'all_items'                  => __( 'Все', '__theme' ),
      'parent_item'                => __( 'Родительский производитель', '__theme' ),
      'parent_item_colon'          => __( 'Родительский производитель:', '__theme' ),
      'new_item_name'              => __( 'New Item Name', '__theme' ),
      'add_new_item'               => __( 'Добавить производителя', '__theme' ),
      'edit_item'                  => __( 'Редактировать производителя', '__theme' ),
      'update_item'                => __( 'Update Item', '__theme' ),
      'view_item'                  => __( 'Посмотреть производителя', '__theme' ),
      'separate_items_with_commas' => __( 'Separate items with commas', '__theme' ),
      'add_or_remove_items'        => __( 'Add or remove items', '__theme' ),
      'choose_from_most_used'      => __( 'Choose from the most used', '__theme' ),
      'popular_items'              => __( 'Popular Items', '__theme' ),
      'search_items'               => __( 'Search Items', '__theme' ),
      'not_found'                  => __( 'Производителей нет', '__theme' ),
      'no_terms'                   => __( 'No items', '__theme' ),
      'items_list'                 => __( 'Items list', '__theme' ),
      'items_list_navigation'      => __( 'Items list navigation', '__theme' ),
    );

    $args = array(
      'labels'                     => $labels,
      'hierarchical'               => true,
      'public'                     => true,
      'show_ui'                    => true,
      'show_admin_column'          => false,
      'show_in_nav_menus'          => true,
          'show_tagcloud'              => true,
          'query_var'                  => true,
          'rewrite'                    => array( 'slug' => 'brand' ),
          // 'default_term'               => __( 'Без производителя', '__theme' ),
    );

    register_taxonomy( '__theme_product_brand', array( 'product' ), $args );

    /**
     * Добавление термина по умолчанию
     */
    wp_insert_term(
      'Без производителя', // the term
      '__theme_product_brand', // the taxonomy
      array(
        'description'=> '',
        'slug' => 'default_brand'
      )
    );

  }

  /**
   * Задает категорию производителя по умолчанию, если не задан производитель у продукта.
   */
  public function set_default_object_terms( $post_id, $post )
  {
    if ( 'publish' === $post->post_status ) {
      $defaults = array(
        '__theme_product_brand' => array( 'default_brand' ),
      );

      $taxonomies = get_object_taxonomies( $post->post_type );

      foreach ( (array) $taxonomies as $taxonomy ) {
        $terms = wp_get_post_terms( $post_id, $taxonomy );

        if ( empty( $terms ) && array_key_exists( $taxonomy, $defaults ) ) {
            wp_set_object_terms( $post_id, $defaults[$taxonomy], $taxonomy );
        }
      }
    }
  }

  /**
    * Сброс ЧПУ при активации темы
    *
    * @return empty
    */
  public function rewrite_flush()
  {
    flush_rewrite_rules();
  }
}
