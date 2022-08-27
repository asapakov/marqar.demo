<?php
/**
 * Block Styles
 *
 * @link https://developer.wordpress.org/reference/functions/register_block_style/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

if ( function_exists( 'register_block_style' ) ) {
	/**
	 * Register block styles.
	 *
	 * @since Twenty Twenty-One 1.0
	 *
	 * @return void
	 */
	function twenty_twenty_one_register_block_styles() {
		// Columns: Overlap.
		register_block_style(
			'core/columns',
			array(
				'name'  => 'marqar_theme-columns-overlap',
				'label' => esc_html__( 'Overlap', 'marqar_theme' ),
			)
		);

		// Cover: Borders.
		register_block_style(
			'core/cover',
			array(
				'name'  => 'marqar_theme-border',
				'label' => esc_html__( 'Borders', 'marqar_theme' ),
			)
		);

		// Group: Borders.
		register_block_style(
			'core/group',
			array(
				'name'  => 'marqar_theme-border',
				'label' => esc_html__( 'Borders', 'marqar_theme' ),
			)
		);

		// Image: Borders.
		register_block_style(
			'core/image',
			array(
				'name'  => 'marqar_theme-border',
				'label' => esc_html__( 'Borders', 'marqar_theme' ),
			)
		);

		// Image: Frame.
		register_block_style(
			'core/image',
			array(
				'name'  => 'marqar_theme-image-frame',
				'label' => esc_html__( 'Frame', 'marqar_theme' ),
			)
		);

		// Latest Posts: Dividers.
		register_block_style(
			'core/latest-posts',
			array(
				'name'  => 'marqar_theme-latest-posts-dividers',
				'label' => esc_html__( 'Dividers', 'marqar_theme' ),
			)
		);

		// Latest Posts: Borders.
		register_block_style(
			'core/latest-posts',
			array(
				'name'  => 'marqar_theme-latest-posts-borders',
				'label' => esc_html__( 'Borders', 'marqar_theme' ),
			)
		);

		// Media & Text: Borders.
		register_block_style(
			'core/media-text',
			array(
				'name'  => 'marqar_theme-border',
				'label' => esc_html__( 'Borders', 'marqar_theme' ),
			)
		);

		// Separator: Thick.
		register_block_style(
			'core/separator',
			array(
				'name'  => 'marqar_theme-separator-thick',
				'label' => esc_html__( 'Thick', 'marqar_theme' ),
			)
		);

		// Social icons: Dark gray color.
		register_block_style(
			'core/social-links',
			array(
				'name'  => 'marqar_theme-social-icons-color',
				'label' => esc_html__( 'Dark gray', 'marqar_theme' ),
			)
		);
	}
	add_action( 'init', 'twenty_twenty_one_register_block_styles' );
}
