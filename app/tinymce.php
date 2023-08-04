<?php

namespace App;

// Editor fonts
add_editor_style(get_stylesheet_directory_uri() . '/assets/fonts/icomoon/style.css');
add_editor_style('//fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;1,700&display=swap');

function init_tinymce_autoresize($initArray){
	$initArray['plugins'] = str_replace('wpautoresize', '', $initArray['plugins']);
	$initArray['plugins'] = str_replace(',,', ',', $initArray['plugins']);

	return $initArray;
}
add_filter('tiny_mce_before_init', 'App\init_tinymce_autoresize');

// Callback function to insert 'styleselect' into the $buttons array
function mce_buttons( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}
// Register our callback to the appropriate filter
add_filter( 'mce_buttons', '\App\mce_buttons' );

// Callback function to filter the MCE settings
function mce_before_init( $init_array ) {
	// Define the style_formats array
	$style_formats = array(
		// Each array child is a format with it's own settings
		array(
			'title' => 'CTA',
			'selector' => 'a',
			'classes' => 'cta-button',
			'wrapper' => false,
		),
		array(
			'title' => 'CTA Small',
			'selector' => 'a',
			'classes' => 'cta-small',
			'wrapper' => false,
		),
		array(
      'title' => 'Small Body Text',
      'selector' => 'p',
      'classes' => 'text-body-small'
    ),
		array(
			'title' => 'Small Content Heading',
      'selector' => 'h2',
      'classes' => 'text-content-main-heading'
		),
    array(
      'title' => 'Overline',
      'selector' => 'h1, h2, h3, h4, h5, h6',
      'classes' => 'overline-medium'
    ),
    array(
      'title' => 'Overline Centered',
      'selector' => 'h1, h2, h3, h4, h5, h6',
      'classes' => 'overline-medium overline-center'
    ),
		array(
			'title' => 'Small Separator',
			'block' => 'hr',
			'classes' => 'separator-small',
		)
	);
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = wp_json_encode( $style_formats );
  $init_array['block_formats'] = "Paragraph=p; Heading 2=h2; Heading 3=h3; Heading 4=h4;";

	return $init_array;

}

// Attach callback to 'tiny_mce_before_init'
add_filter( 'tiny_mce_before_init', '\App\mce_before_init' );
