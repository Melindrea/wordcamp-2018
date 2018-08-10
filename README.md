# Wordcamp Norrköping 2018  (Dynamic Gutenberg blocks)

## Resources
* https://github.com/zgordon/gutenberg-course/ -- While this course only gives the barest minimum of setting up a dynamic block  (it, for instance, does not show how to export attributes), it's overall a good one
​* https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/ -- The guide in the official handbook
* https://jasonyingling.me/building-dynamic-blocks-for-the-gutenberg-editor-in-wordpress/ -- Good post that builds well on  the official guide
* https://github.com/WordPress/gutenberg/issues/7390 -- Talks about the now-deprecated `withAPIData` and it's replacements
​* registerBlockType( name,  settings) -- https://github.com/WordPress/gutenberg/blob/4f0a6439873ac68187bfa42e8a7061f0e06ca4e3/packages/blocks/src/api/registration.js#L80
* register_block_type( string $name, array $settings ) -- https://github.com/WordPress/gutenberg/blob/d45a92a41a51a8aec5ef380bea5955ad811d31cf/lib/blocks.php#L29
