<?php
/**
 * Отключение базовых опций WordPress.
 *
 * @package __theme
 */

namespace THKKZ\Setup;

class Deregister
{
	/**
	 * Регистрация hooks и actions для WordPress.
   *
	 * @return
	 */
	public function register()
	{
    // add_action( 'admin_init', array( $this, 'hide_gutenberg_editor' ) );

    // add_action( 'wp_print_styles', array( $this, 'deregister_styles' ), 100 );
    // add_action( 'wp_footer', array( $this, 'deregister_scripts' ) );
    add_action( 'init', array( $this, 'deregister_emojis' ) );
    $this->deregister_meta();
	}

  /**
   * Удаление стандартных полей WordPress для заданых записей и страниц.
   *
   * @return
   */
  public function hide_gutenberg_editor()
  {
    if ( array_key_exists( 'post', $_GET ) || array_key_exists( 'post_ID', $_GET ) ) {
      $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;

      if ( ! isset( $post_id ) || empty( $post_id ) ) {
          return;
      }

      /**
       * Где скрываем, заголовок записи, страницы.
       *
       * Title => ID
       */
      $excludes = array(
        'Clients' => 123,
        'Partners' => 145,
      );

      if ( in_array( $post_id, $excludes ) ) {
        remove_post_type_support( 'page', 'editor' );
        remove_post_type_support( 'page', 'author' );
        remove_post_type_support( 'page', 'thumbnail' );
        remove_post_type_support( 'page', 'thumbnail' );
        remove_post_type_support( 'page', 'custom-fields' );
        remove_post_type_support( 'page', 'page-attributes' );
        remove_post_type_support( 'page', 'post-formats' );
      }
    }
  }

  /**
   * Отключение стилей Gutenberg.
   *
   * Отключаем стандартные стили редактора Gutenberg,
   * если не используем либо хотим переопределить их.
   *
   * Документация:
   * @link https://stackoverflow.com/questions/52277629/remove-gutenberg-css
   * @link https://wordpress.org/support/topic/block-editor-assets-still-enqueued/
   *
   * @return
   */
  public function deregister_styles()
  {
    wp_dequeue_style( 'wp-block-library' );
  }

  /**
   * Отключение embed (встраивыемое видео, аудио и прочие медиа данные).
   *
   * Отключаем встраиваемые через ссылки медиаданные на сайте.
   *
   * Документация:
   * @link https://wordpress.org/support/article/embeds/
   * @link https://__themetack.ru/wordpress/211701/what-does-wp-embed-min-js-do-in-wordpress-4-4
   *
   * @return
   */
  public function deregister_scripts()
  {
    wp_deregister_script( 'wp-embed' );
  }

  /**
   * Отключение emoji (смайлики и прочее).
   *
   * WordPress с версии 4.2 стал поддерживать эмодзи смайлы.
   * Данный функционал зачастую не нужен на сайтах и здесь мы его отключаем.
   *
   * Документация:
   * @link https://kinsta.com/knowledgebase/disable-emojis-wordpress/#disable-emojis-code
   *
   * @return
   */
  public function deregister_emojis()
  {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', array( $this, 'deregister_emojis_tinymce' ) );
    add_filter( 'wp_resource_hints', array( $this, 'deregister_emojis_dns_prefetch' ), 10, 2 );
  }

  /**
   * Удаление плагина tinymce emoji.
   *
   * @param array $plugins
   *
   * @return array
   */
  public function deregister_emojis_tinymce( $plugins )
  {
    if ( is_array( $plugins ) ) {
      return array_diff( $plugins, array( 'wpemoji' ) );
    }

    return array();
  }

  /**
   * Удаление хоста CDN для emoji.
   *
   * @param array $urls Ссылки на ресурсы
   * @param string $relation_type Типы отношений для ссылок
   *
   * @return array
   */
  public function deregister_emojis_dns_prefetch( $urls, $relation_type )
  {
    if ( 'dns-prefetch' == $relation_type ) {
      /** Этот фильтр задокументирован в wp-includes/formatting.php */
      $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

      $urls = array_diff( $urls, array( $emoji_svg_url ) );
    }

    return $urls;
  }

  /**
   * Отключение различных мета данных.
   *
   * WordPress, а так же некоторые плагины добавляют совершенно не нужную информацию.
   * Например WordPress добавляет meta тег с описание текущей версии WordPress, что не является безопасным.
   *
   * @package __theme
   */
  public function deregister_meta()
  {
    /**
     * Убираем мета тег с текущей версией WordPress.
     *
     * <meta name="generator" content="WordPress 5.5" />
     */
    remove_action( 'wp_head', 'wp_generator' );

    /**
     * Манифест для работы с записями и страницами сайта с помощью онлайн-сервиса Windows Live Writer.
     * Используется в больших изданиях где трудится множество авторов и редакторов.
     *
     * <link rel="wlwmanifest" type="application/wlwmanifest+xml" />
     *
     * @link https://wpschool.ru/udalyaem-wlwmanifest-xml/
     */
    remove_action( 'wp_head', 'wlwmanifest_link' );

    /**
     * Убираем ссылку RSD XML-RPC.
     *
     * <link rel="EditURI" type="application/rsd+xml" />
     *
     * @link https://crunchify.com/how-to-clean-up-wordpress-header-section-without-any-plugin/
     */
    remove_action( 'wp_head', 'rsd_link' );

    /**
     * Убираем ссылку на связь с api.w.org.
     *
     * <link rel="https://api.w.org/" href="/wp-json/">
     *
     * @link https://wordpress.org/support/topic/what-is-wp-json-and-api-w-org-seems-like-theyre-slowing-my-site-load/
     */
    remove_action('wp_head', 'rest_output_link_wp_head', 10); // Отключить тег ссылки REST API.
    remove_action('wp_head', 'wp_oembed_add_discovery_links', 10); // Отключить ссылки обнаружения oEmbed.
    remove_action('template_redirect', 'rest_output_link_header', 11, 0); // Отключить ссылку REST API в заголовках HTTP.

    /**
     * Убираем ссылку на связь с s.w.org.
     *
     * Используется в связке с emoji.
     *
     * <link rel='dns-prefetch' href='//s.w.org' />
     *
     * @link https://wp-kama.ru/question/ispolzovanie-dns-prefetch-v-wordpress
     */
    remove_action( 'wp_head', 'wp_resource_hints', 2);
  }
}
