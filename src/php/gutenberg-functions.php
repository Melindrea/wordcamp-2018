<?php

/**
 * Checks if a specified block is active in the content.
 *
 * @param string $block_name
 * @param string|null $namespace
 *
 * @return bool
 */
function qala_gutenberg_block_active( string $block_name, string $namespace = null ) : bool {
	$subject = get_the_content();
	if ( $namespace ) {
		$block_name = $namespace . '\/' . $block_name;
	}

	$pattern = '/<!-- wp:' . $block_name . '\b/i';
	$matches = [];
	$result  = preg_match( $pattern, $subject, $matches );

	return boolval( $result );
}

/**
 * Add support for custom color palettes in Gutenberg.
 */
function qala_gutenberg_color_palette() {
	add_theme_support( 'disable-custom-colors' );
	add_theme_support(
		'editor-color-palette',
		[
			'name'  => esc_html__( 'Navy', 'qala' ),
			'color' => '#163141',
		],
		[
			'name'  => esc_html__( 'Sky', 'qala' ),
			'color' => '#3891a1',
		],
		[
			'name'  => esc_html__( 'Leather', 'qala' ),
			'color' => '#989284',
		],
		[
			'name'  => esc_html__( 'Zest', 'qala' ),
			'color' => '#d7e516',
		],
		[
			'name'  => esc_html__( 'Poppy', 'qala' ),
			'color' => '#de5226',
		],
		[
			'name'  => esc_html__( 'Berry', 'qala' ),
			'color' => '#73365d',
		],
		[
			'name'  => esc_html__( 'Grape', 'qala' ),
			'color' => '#38375e',
		],
		[
			'name'  => esc_html__( 'White', 'qala' ),
			'color' => '#FFFFFF',
		],
		[
			'name'  => esc_html__( 'Black', 'qala' ),
			'color' => '#000000',
		],
		[
			'name'  => esc_html__( 'Stone', 'qala' ),
			'color' => '#4a494a',
		],
		[
			'name'  => esc_html__( 'Steel', 'qala' ),
			'color' => '#8d8d8d',
		],
		[
			'name'  => esc_html__( 'Iron', 'qala' ),
			'color' => '#c2c2c2',
		],
		[
			'name'  => esc_html__( 'Smoke', 'qala' ),
			'color' => '#e5e5e5',
		],
		[
			'name'  => esc_html__( 'Cloud', 'qala' ),
			'color' => '#f5f5f5',
		]
	);
}
add_action( 'after_setup_theme', 'qala_gutenberg_color_palette' );

/**
 * Require the Gutenberg block classes.
 *
 * @package qala
 * @since 2.0.0
 */
require_once get_template_directory() . '/inc/class-gutenberg-block.php';

foreach ( glob( get_template_directory() . '/inc/blocks/' . 'class-*.php' ) as $filename ) {
	$classname_bits = array_map(
		function ( $name ) {
				return ucfirst( $name );
		},
		explode( '-', substr( basename( $filename, '.php' ), strlen( 'class-' ) ) )
	);

	$classname = 'Qala\\Blocks\\' . join( '_', $classname_bits );

	require_once $filename;
	$classname::get_instance();
}
