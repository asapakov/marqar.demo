<?php if ( ! defined( 'ABSPATH' ) ) return; ?>

<form class="search-form" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
  <label class="screen-reader-text" for="s"><?php esc_attr_e( 'Поиск: ' , '__theme' ); ?></label>
	<input class="search-form__field" type="search" value="<?php echo get_search_query() ?>" name="s" placeholder="<?php esc_attr_e( 'Поиск' , '__theme' ); ?>">
  <button class="search-form__submit" type="submit" aria-label="<?php esc_attr_e( 'Поиск' , '__theme' ); ?>">
    <svg class="search-form__icon" width="16" height="16" aria-hidden="true">
      <use xlink:href="#icon-search-2"></use>
    </svg>
  </button>
</form>
