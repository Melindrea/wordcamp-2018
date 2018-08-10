/**
 * BLOCK: qala-test-block
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */

//  Import CSS.
import './frontend.scss';
import attributes from './attributes';

const { __ } = wp.i18n;
const {
	InspectorControls,
}            = wp.editor;
const {
	PanelBody,
	PanelRow,
	SelectControl,
	RangeControl,
	ServerSideRender,
}            = wp.components;

export const name = 'qala/cats';

export const settings = {
	title: __( 'Dynamic cats', 'qala' ),
	description: __( 'Cat images fetched from an API.', 'qala' ),
	icon: 'heart',
	category: 'widgets',

	attributes,
	/**
	 * The edit function describes the structure of your block in the context of the editor.
	 * This represents what the editor will render when the block is used.
	 *
	 * The "edit" property must be a valid function.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/
	 */
	edit: ( props ) => {
		const { attributes: { size, resultsPerPage, category }, setAttributes } = props;

		return [
			< InspectorControls >
				< PanelBody
					title            = { __( 'Cat images', 'qala' ) }
				>
					< PanelRow >
						< SelectControl
							label    = { __( 'Pick a size', 'qala' ) }
							value    = { size }
							options  = {[
								{ value: 'small', label: __( '250px wide', 'qala' ) },
								{ value: 'med', label: __( '500px wide', 'qala' ) },
								{ value: 'full', label: __( 'Original size', 'qala' ) },
							]}
							onChange = { size => setAttributes({ size }) }
						/ >
					< / PanelRow >

					< PanelRow >
						< RangeControl
							label    = { __( 'Choose how many to fetch', 'qala' ) }
							value    = { resultsPerPage }
							onChange = { resultsPerPage => setAttributes({ resultsPerPage }) }
							min      = { 1 }
							max      = { 20 }
						/ >
					< / PanelRow >

					< PanelRow >
						< SelectControl
							label    = { __( 'Choose category', 'qala' ) }
							value    = { category }
							options  = { [
								{ value: '', label: __( 'All categories', 'qala' ) },
								{ value: 'hats', label: __( 'Hats', 'qala' ) },
								{ value: 'space', label: __( 'Space', 'qala' ) },
								{ value: 'sunglasses', label: __( 'Sunglasses', 'qala' ) },
								{ value: 'boxes', label: __( 'Boxes', 'qala' ) },
								{ value: 'caturday', label: __( 'Caturday', 'qala' ) },
								{ value: 'ties', label: __( 'Ties', 'qala' ) },
								{ value: 'dream', label: __( 'Dream', 'qala' ) },
								{ value: 'kittens', label: __( 'Kittens', 'qala' ) },
								{ value: 'sinks', label: __( 'Sinks', 'qala' ) },
								{ value: 'clothes', label: __( 'Clothes', 'qala' ) },
							]}
							onChange = { category => setAttributes({ category }) }
						/ >
					< / PanelRow >
				< / PanelBody >
			< / InspectorControls > ,
			< ServerSideRender
				block                = "qala/cats"
				attributes           = {props.attributes}
			/ > ,
		];
	},
	/**
	 * The save function defines the way in which the different attributes should be combined
	 * into the final markup, which is then serialized by Gutenberg into post_content.
	 *
	 * The "save" property must be specified and must be a valid function.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/
	 */
	save: () => {
		// Rendering in PHP.
		return null;
	},
};
