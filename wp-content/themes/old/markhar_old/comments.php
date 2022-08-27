<?php
/**
 * Шаблон для отображения комментариев.
 *
 * Это шаблон, который отображает текущии комментарии
 * и форму добавления комментария.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package __theme
 */

/*
  * Если текущая запись защищена паролем и
  * посетитель еще не ввел пароль, то
  * не показывать комментарии.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="page-comment">

	<?php if ( have_comments() ) : ?>
		<h2 class="page-comment__title">
			<?php
        // $_themename_comment_count = get_comments_number();
        // if ( '1' === $_themename_comment_count ) {
        //   printf(
        //     /* translators: 1: заголовок. */
        //     esc_html__( 'Один комментарий к &ldquo;%1$s&rdquo;', '_themename' ),
        //     '<span>' . wp_kses_post( get_the_title() ) . '</span>'
        //   );
        // } else {
        //   printf(
        //     /* translators: 1: количество комментариев, 2: заголовок. */
        //     esc_html( _nx( '%1$s комментарий к &ldquo;%2$s&rdquo;', '%1$s комментария к &ldquo;%2$s&rdquo;', $_themename_comment_count, 'comments title', '_themename' ) ),
        //     number_format_i18n( $_themename_comment_count ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        //     '<span>' . wp_kses_post( get_the_title() ) . '</span>'
        //   );
        // }
			?>
      Comments
		</h2>

		<?php the_comments_navigation(); ?>

		<ol class="page-comment__list">
      <?php wp_list_comments('type=comment&callback=THKKZ\Setup\Comment::comment_form'); ?>
		</ol><!-- .comment-list -->

		<?php
      the_comments_navigation();

      // Если комментарии закрыты и есть комментарии, давайте оставим небольшую заметку
      if ( ! comments_open() ) :
        ?>
        <p class="page-comment__nocomments"><?php esc_html_e( 'Комментарии закрыты.', '_themename' ); ?></p>
        <?php
      endif;

    endif; // have_comments().

    comment_form( array(
      'class_container' => 'page-comment__form-wrapp',
      'class_form' => 'page-comment__form',
      'title_reply' => 'Leave a Reply',
      'title_reply_before'   => '<h3 id="reply-title" class="page-comment__reply-title">',
    ) );
	?>

</div><!-- #comments -->
