<?php
/**
 * Created by PhpStorm.
 * User: mariehogebrandt
 * Date: 2018-07-03
 * Time: 09:07
 */
namespace Qala\Blocks;

use Qala\Gutenberg_Block;

class Qala_Cats extends Gutenberg_Block {
	/**
	 * Blockname.
	 *
	 * @var string
	 */
	protected $name = 'qala/cats';

	/**
	 * Plugin instance.
	 *
	 * @var null|self
	 */
	protected static $instance = null;

	/**
	 * Attribute definition for the block.
	 *
	 * @var array
	 */
	protected $attributes = [
		'size'           => [
			'type' => 'string',
		],
		'category'       => [
			'type' => 'string',
		],
		'resultsPerPage' => [
			'type' => 'integer',
		],
		'className'      => [
			'type' => 'string',
		],
	];

	/**
	 * API key to thecatapi.com.
	 *
	 * @var string
	 */
	protected $api_key = 'MzUwNjQ0';

	protected $api_url = 'http://thecatapi.com/api/images/get';

	/**
	 * Get class instance
	 *
	 * @return Qala_Cats
	 */
	public static function get_instance() : self {
		if ( null === self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function render( array $attributes = [] ) : string {
		$attributes = array_merge(
			[
				'format'  => 'xml',
				'type'    => 'jpg,png',
				'api_key' => $this->api_key,
			], $attributes
		);
		$arguments  = [];

		foreach ( $attributes as $key => $attribute ) {
			if ( ( 'className' !== $key ) && $attribute ) {
				$arguments[] = sprintf( '%s=%s', $this->decamelize( $key ), $attribute );
			}
		}

		$url = sprintf( '%s?%s', $this->api_url, join( '&', $arguments ) );

		$xml = simplexml_load_file( $url );

		if ( ! $xml ) {
			return '<p>No images found</p>';
		}
		$images = [];
		foreach ( $xml->data->images->image as $image ) {
			$images[] = sprintf( '<a href="%s"><img src="%s" alt="Random cat"></a>', $image->source_url, $image->url );
		}

		if ( 1 === count( $images ) ) {
			$html = $images[0];
		} elseif ( 0 === count( $images ) ) {
			$html = '<p>No images found</p>';
		} else {
			$images = array_map(
				function ( $image ) {
						return sprintf( '<li>%s</li>', $image );
				},
				$images
			);
			$html   = sprintf( '<ul>%s</ul>', join( PHP_EOL, $images ) );
		}

		return $html;
	}
}
