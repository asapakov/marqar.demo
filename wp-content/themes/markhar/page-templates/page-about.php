<?php
/**
 * Template Name: About us
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package __theme
 */

  get_header();
?>

<section class="page-about">
  <div class="page-about__container container">
    <div class="page-about__row">

      <h2 class="page-about__title"><?php the_title(); ?></h2>

      <div class="page-about__desc">
        <?php the_content( '' ); ?>
      </div>

      <div class="page-about__img">
        <?php the_post_thumbnail( 'full' ); ?>
      </div>

      <?php if ( have_rows('about_feature') ): ?>
      <ul class="page-about__list">
        <?php while( have_rows('about_feature') ) : the_row(); ?>
        <li class="page-about__item">
          <div class="page-about__icon">
            <img src="<?php echo get_sub_field('about_feature_img')['url']; ?>" width="65" height="65" alt="<?php echo get_sub_field('about_feature_title'); ?>">
          </div>

          <h3 class="page-about__title"><?php echo get_sub_field('about_feature_title'); ?></h3>

          <div class="page-about__desc">
            <?php echo get_sub_field('about_feature_desc'); ?>
          </div>
        </li>
        <?php endwhile; ?>
      </ul>
      <?php endif; ?>

    </div>
  </div>
</section>

<?php get_footer(); ?>
