<?php
/**
 * Created by PhpStorm.
 * User: mariehogebrandt
 * Date: 2018-07-02
 * Time: 13:25
 */

namespace Qala;

abstract class Gutenberg_Block {
	/**
	 * Blockname.
	 *
	 * @var string
	 */
	protected $name = '';

	/**
	 * Attribute definition for the block.
	 *
	 * @var array
	 */
	protected $attributes = [];

	/**
	 * Plugin instance.
	 *
	 * @var null|self
	 */
	protected static $instance = null;

	protected function __construct() {
		add_action( 'init', [ $this, 'register_block' ] );
	}

	/**
	 * Register the block for the block class.
	 */
	public function register_block() {
		$settings = [
			'render_callback' => [ $this, 'render' ],
		];

		if ( ! empty( $this->attributes ) ) {
			$settings['attributes'] = $this->attributes;
		}

		register_block_type( $this->name, $settings );
	}

	/**
	 * Class wakeup.
	 */
	private function __wakeup() {}

	/**
	 * Class clone.
	 */
	private function __clone() {}

	/**
	 * Render the PHP, implement in block class.
	 *
	 * @param array $attributes
	 *
	 * @return string
	 */
	public abstract function render( array $attributes = [] ) : string;

	public function decamelize( $string ) : string {
		return strtolower( preg_replace( [ '/([a-z\d])([A-Z])/', '/([^_])([A-Z][a-z])/' ], '$1_$2', $string ) );
	}
}
