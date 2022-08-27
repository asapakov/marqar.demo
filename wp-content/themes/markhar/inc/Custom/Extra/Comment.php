<?php
/**
 * Форма комментариев.
 *
 * @package __theme
 */

namespace THKKZ\Custom\Extra;

class Comment
{
  /**
   * Регистрация hooks и actions для WordPress.
   *
   * @return
   */
  public function register()
  {
    add_filter( 'comment_form_fields', array( $this, 'order_fields') );
    add_filter( 'comment_form_default_fields', array( $this, 'update_fields') );
    add_filter( 'comment_form_field_comment', array( $this, 'update_textarea') );
    add_filter( 'comment_form_defaults', array( $this, 'comment_form_before') );
    add_filter( 'edit_comment_link', array( $this, 'comment_link'), 10, 3 );
  }

  /**
   * Порядок полей в форме комментариев.
   *
   * @return $fields
   */
  public function order_fields( $fields )
  {
    // Сохраняем значение всех полей формы
    $mycomment_field = $fields['comment'];
    $myauthor_field = $fields['author'];
    $myemail_field = $fields['email'];
    $myurl_field = $fields['url'];

    // Удаляем порядок по умолчанию
    unset( $fields['comment'], $fields['author'], $fields['email'], $fields['url'], $fields['cookies'] );

    // Заново добавляем поля в форму в нужном порядке
    //$fields['url'] = $myurl_field;
    $fields['author'] = $myauthor_field;
    $fields['email'] = $myemail_field;
    $fields['comment'] = $mycomment_field;

    return $fields;
  }

  /**
   * Разметка полей формы.
   *
   * @return $fields
   */
  public function update_fields( $fields ) {
    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );

    $fields['author'] =
        '<p class="page-comment__input-author">
            <input required minlength="3" maxlength="30" placeholder="' . esc_attr__( 'Enter your name', '_themename') . '*" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
    '" size="30"' . $aria_req . ' />
        </p>';

    $fields['email'] =
        '<p class="page-comment__input-email">
            <input required placeholder="' . esc_attr__( 'Enter your email', '_themename') . '*" id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) .
    '" size="30"' . $aria_req . ' />
        </p>';

    // $fields['url'] =
    //     '<p class="page-comment__url">
    //         <input placeholder="Ваш сайт (если есть)" id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) .
    // '" size="30" />
    //     </p>';

    return $fields;
  }

  /**
   * Разметка поля формы добавления сообщения.
   *
   * @return $comment_field
   */
  public function update_textarea( $comment_field ) {
    $comment_field =
        '<p class="page-comment__input-text">
            <textarea required placeholder="' . esc_attr__( 'Enter your comment', '_themename') . '*" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
        </p>';

    return $comment_field;
  }

  /**
   * Разметка списка комментариев.
   *
   * @return
   */
  public static function comment_form( $comment, $args, $depth )
  {
    if ( 'div' === $args['style'] ) {
      $tag       = 'div';
      $add_below = 'comment';
    } else {
      $tag       = 'li';
      $add_below = 'div-comment';
    }

    $classes = ' ' . comment_class( empty( $args['has_children'] ) ? '' : 'parent', null, null, false );
    ?>

    <<?php echo $tag, $classes; ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) { ?>
      <div id="div-comment-<?php comment_ID() ?>" class="page-comment__body"><?php
    } ?>

    <div class="page-comment__author vcard">
      <?php
      if ( $args['avatar_size'] != 0 ) {
        echo get_avatar( $comment, 70 );
      }
      ?>
    </div>

    <?php if ( $comment->comment_approved == '0' ) { ?>
      <em class="page-comment__moderation">
        <?php esc_html_e( 'Ваш комментарий находится на модерировании.', '_themename' ); ?>
      </em><br/>
    <?php } ?>

    <div class="page-comment__meta commentmetadata">
      <?php
        printf(
          __( '<cite class="page-comment__login fn">%s</cite>' ),
          get_comment_author()
        );
      ?>

      <time class="page-comment__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
        <?php
        printf(
          __( '%1$s at %2$s' ),
          get_comment_date( 'F j, Y' ),
          get_comment_time()
        ); ?>
      </time>

      <?php edit_comment_link( __( '(Edit)' ), '  ', '' ); ?>
    </div>

    <div class="page-comment__text"><?php comment_text(); ?></div>

    <div class="reply">
      <?php
      comment_reply_link(
        array_merge(
          $args,
          array(
            'add_below' => $add_below,
            'depth'     => $depth,
            'max_depth' => $args['max_depth'],
            // 'reply_text' => '',
          )
        )
      ); ?>
    </div>

    <?php if ( 'div' != $args['style'] ) { ?>
      </div>
    <?php }
  }

  public function comment_form_before( $defaults )
  {
    $defaults['comment_notes_before'] = '<p class="page-comment__notes">Your email address will not be published. Required fields are marked <span class="required">*</span></p>';
    return $defaults;
  }

  public function comment_link( $link, $comment_id, $text ){
    $link = str_replace( 'comment-edit-link', 'page-comment__edit', $link);

    return $link;
  }
}
