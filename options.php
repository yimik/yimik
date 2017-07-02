<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 */
function optionsframework_option_name() {
	// Change this to use your theme slug
	return 'theme-options-yimik';
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'bonestheme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	$options = array();

	$options[] = array(
		'name' => __( 'Basic Settings', 'bonestheme' ),
		'type' => 'heading'
	);

    $options[] = array(
        'name' => __( 'Display Site Title and Tagline', 'bonestheme' ),
        'desc' => __( 'Display Site Title/Tagline or not, defaults to true.', 'bonestheme' ),
        'id' => 'blog_name_display',
        'std' => '1',
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => __( 'Display Logo', 'bonestheme' ),
        'desc' => __( 'Display Logo or not, defaults to true.', 'bonestheme' ),
        'id' => 'logo_display',
        'std' => '1',
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => __( 'Logo', 'bonestheme' ),
        'desc' => __( 'Upload the logo image if you want.', 'bonestheme' ),
        'id' => 'logo_uploader',
        'type' => 'upload'
    );

    $options[] = array(
        'name' => __( 'ICP Licensing', 'bonestheme' ),
        'placeholder' => __( 'input ICP Licensing here.', 'bonestheme' ),
        'id' => 'icp_licensing',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __( 'Keywords', 'bonestheme' ),
        'desc' => __( 'Site Keywords.', 'bonestheme' ),
        'id' => 'meta_keywords',
        'placeholder' => __( 'input site keywords here.', 'bonestheme' ),
        'type' => 'text'
    );

    $options[] = array(
        'name' => __( 'Description', 'bonestheme' ),
        'desc' => __( 'Site Description.', 'bonestheme' ),
        'id' => 'meta_description',
        'placeholder' => __( 'input site description here.', 'bonestheme' ),
        'type' => 'textarea'
    );

    $options[] = array(
        'name' => __( 'Enable slideshow', 'bonestheme' ),
        'desc' => __( 'Enable slideshow or not, defaults to false.', 'bonestheme' ),
        'id' => 'swiper_display',
        'std' => '0',
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => __( 'Slideshow', 'bonestheme' ),
        'desc' => __( 'JSON format,like {"title":"title","link":"url","image":"imageUrl"}, multiple pictures separated by commas.', 'bonestheme' ),
        'id' => 'sliders',
        'placeholder' => __( '{"title":"The Great Wall","link":"http://blog.yimik.com","image":"http://xxx.xxx.xxx/xxx.jpg"}', 'bonestheme' ),
        'type' => 'textarea'
    );

	$options[] = array(
		'name' => __( 'Advanced Settings', 'bonestheme' ),
		'type' => 'heading'
	);

    $options[] = array(
        'name' => __( 'Custom CSS', 'bonestheme' ),
        'desc' => __( 'you can input custom css code here.', 'bonestheme' ),
        'id' => 'custom_css',
        'type' => 'textarea'
    );

    $options[] = array(
        'name' => __( 'Custom Header Code', 'bonestheme' ),
        'desc' => __( 'you can input custom header code here.', 'bonestheme' ),
        'id' => 'custom_header_code',
        'type' => 'textarea'
    );

    $options[] = array(
        'name' => __( 'Custom Footer Code', 'bonestheme' ),
        'desc' => __( 'you can input custom footer code here.', 'bonestheme' ),
        'id' => 'custom_footer_code',
        'type' => 'textarea'
    );

	$options[] = array(
		'name' => __( 'Advertisement Settings', 'bonestheme' ),
		'type' => 'heading'
	);

    $options[] = array(
        'desc' => __('The function will be open later.', 'bonestheme'),
        'type' => 'info'
    );


	/*关于yimik，主题介绍*/
    $options[] = array(
        'name' => __( 'About Yimik', 'bonestheme' ),
        'type' => 'heading'
    );

    $options[] = array(
        'name' => __( 'Current Version', 'bonestheme' ),
        'desc' => wp_get_theme()->get("Version"),
        'type' => 'info'
    );

    $options[] = array(
        'name' => __( 'Author', 'bonestheme' ),
        'desc' => wp_get_theme()->get("Author"),
        'type' => 'info'
    );

    $options[] = array(
        'name' => __( 'Introduction', 'bonestheme' ),
        'desc' => '本来用各路大神的主题一直觉得挺好，但总觉得哪里不对劲儿，自己动手，丰衣足食吧。本主题基于<a href="https://github.com/eddiemachado/bones" target="_blank">bones主题</a>二次开发，感谢原作者详细的注释。',
        'type' => 'info'
    );

    $options[] = array(
        'name' => __( 'Donate', 'bonestheme' ),
        'desc' => '<table><tr><td><img width="200" height="200" src="'.get_template_directory_uri() . '/library/images/alipay_donate.png'.'"></td><td><img width="200" height="200" src="'.get_template_directory_uri() . '/library/images/wechat_donate.png'.'"></td></tr><tr><td align="center">支付宝</td><td align="center">微信</td></tr></table>',
        'type' => 'info'
    );

//    Test data
//    $test_array = array(
//        'one' => __( 'One', 'bonestheme' ),
//        'two' => __( 'Two', 'bonestheme' ),
//        'three' => __( 'Three', 'bonestheme' ),
//        'four' => __( 'Four', 'bonestheme' ),
//        'five' => __( 'Five', 'bonestheme' )
//    );
//
//    // Multicheck Array
//    $multicheck_array = array(
//        'one' => __( 'French Toast', 'bonestheme' ),
//        'two' => __( 'Pancake', 'bonestheme' ),
//        'three' => __( 'Omelette', 'bonestheme' ),
//        'four' => __( 'Crepe', 'bonestheme' ),
//        'five' => __( 'Waffle', 'bonestheme' )
//    );
//
//    // Multicheck Defaults
//    $multicheck_defaults = array(
//        'one' => '1',
//        'five' => '1'
//    );
//
//    // Background Defaults
//    $background_defaults = array(
//        'color' => '',
//        'image' => '',
//        'repeat' => 'repeat',
//        'position' => 'top center',
//        'attachment'=>'scroll' );
//
//    // Typography Defaults
//    $typography_defaults = array(
//        'size' => '15px',
//        'face' => 'georgia',
//        'style' => 'bold',
//        'color' => '#bada55' );
//
//    // Typography Options
//    $typography_options = array(
//        'sizes' => array( '6','12','14','16','20' ),
//        'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
//        'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
//        'color' => false
//    );
//
//    // Pull all the categories into an array
//    $options_categories = array();
//    $options_categories_obj = get_categories();
//    foreach ($options_categories_obj as $category) {
//        $options_categories[$category->cat_ID] = $category->cat_name;
//    }
//
//    // Pull all tags into an array
//    $options_tags = array();
//    $options_tags_obj = get_tags();
//    foreach ( $options_tags_obj as $tag ) {
//        $options_tags[$tag->term_id] = $tag->name;
//    }
//
//
//    // Pull all the pages into an array
//    $options_pages = array();
//    $options_pages_obj = get_pages( 'sort_column=post_parent,menu_order' );
//    $options_pages[''] = 'Select a page:';
//    foreach ($options_pages_obj as $page) {
//        $options_pages[$page->ID] = $page->post_title;
//    }
//
//    // If using image radio buttons, define a directory path
//    $imagepath =  get_template_directory_uri() . '/images/';
//    $options[] = array(
//        'name' => __( 'Input Text Mini', 'bonestheme' ),
//        'desc' => __( 'A mini text input field.', 'bonestheme' ),
//        'id' => 'example_text_mini',
//        'std' => 'Default',
//        'class' => 'mini',
//        'type' => 'text'
//    );
//
//    /**
//     * For $settings options see:
//     * http://codex.wordpress.org/Function_Reference/wp_editor
//     *
//     * 'media_buttons' are not supported as there is no post to attach items to
//     * 'textarea_name' is set by the 'id' you choose
//     */
//
//    $wp_editor_settings = array(
//        'wpautop' => true, // Default
//        'textarea_rows' => 5,
//        'tinymce' => array( 'plugins' => 'wordpress,wplink' )
//    );
//
//    $options[] = array(
//        'name' => __( 'Default Text Editor', 'bonestheme' ),
//        'desc' => sprintf( __( 'You can also pass settings to the editor.  Read more about wp_editor in <a href="%1$s" target="_blank">the WordPress codex</a>', 'bonestheme' ), 'http://codex.wordpress.org/Function_Reference/wp_editor' ),
//        'id' => 'example_editor',
//        'type' => 'editor',
//        'settings' => $wp_editor_settings
//    );
//
//    $options[] = array(
//        'name' => __( 'Input Text', 'bonestheme' ),
//        'desc' => __( 'A text input field.', 'bonestheme' ),
//        'id' => 'example_text',
//        'std' => 'Default Value',
//        'type' => 'text'
//    );
//
//    $options[] = array(
//        'name' => __( 'Input with Placeholder', 'bonestheme' ),
//        'desc' => __( 'A text input field with an HTML5 placeholder.', 'bonestheme' ),
//        'id' => 'example_placeholder',
//        'placeholder' => 'Placeholder',
//        'type' => 'text'
//    );
//
//    $options[] = array(
//        'name' => __( 'Input Select Small', 'bonestheme' ),
//        'desc' => __( 'Small Select Box.', 'bonestheme' ),
//        'id' => 'example_select',
//        'std' => 'three',
//        'type' => 'select',
//        'class' => 'mini', //mini, tiny, small
//        'options' => $test_array
//    );
//
//    $options[] = array(
//        'name' => __( 'Input Select Wide', 'bonestheme' ),
//        'desc' => __( 'A wider select box.', 'bonestheme' ),
//        'id' => 'example_select_wide',
//        'std' => 'two',
//        'type' => 'select',
//        'options' => $test_array
//    );
//
//    if ( $options_categories ) {
//        $options[] = array(
//            'name' => __( 'Select a Category', 'bonestheme' ),
//            'desc' => __( 'Passed an array of categories with cat_ID and cat_name', 'bonestheme' ),
//            'id' => 'example_select_categories',
//            'type' => 'select',
//            'options' => $options_categories
//        );
//    }
//
//    if ( $options_tags ) {
//        $options[] = array(
//            'name' => __( 'Select a Tag', 'options_check' ),
//            'desc' => __( 'Passed an array of tags with term_id and term_name', 'options_check' ),
//            'id' => 'example_select_tags',
//            'type' => 'select',
//            'options' => $options_tags
//        );
//    }
//
//    $options[] = array(
//        'name' => __( 'Select a Page', 'bonestheme' ),
//        'desc' => __( 'Passed an pages with ID and post_title', 'bonestheme' ),
//        'id' => 'example_select_pages',
//        'type' => 'select',
//        'options' => $options_pages
//    );
//
//    $options[] = array(
//        'name' => __( 'Input Radio (one)', 'bonestheme' ),
//        'desc' => __( 'Radio select with default options "one".', 'bonestheme' ),
//        'id' => 'example_radio',
//        'std' => 'one',
//        'type' => 'radio',
//        'options' => $test_array
//    );
//
//    $options[] = array(
//        'name' => __( 'Example Info', 'bonestheme' ),
//        'desc' => __( 'This is just some example information you can put in the panel.', 'bonestheme' ),
//        'type' => 'info'
//    );
//
//    $options[] = array(
//        'name' => __( 'Check to Show a Hidden Text Input', 'bonestheme' ),
//        'desc' => __( 'Click here and see what happens.', 'bonestheme' ),
//        'id' => 'example_showhidden',
//        'type' => 'checkbox'
//    );
//
//    $options[] = array(
//        'name' => __( 'Hidden Text Input', 'bonestheme' ),
//        'desc' => __( 'This option is hidden unless activated by a checkbox click.', 'bonestheme' ),
//        'id' => 'example_text_hidden',
//        'std' => 'Hello',
//        'class' => 'hidden',
//        'type' => 'text'
//    );
//
//    $options[] = array(
//        'name' => "Example Image Selector",
//        'desc' => "Images for layout.",
//        'id' => "example_images",
//        'std' => "2c-l-fixed",
//        'type' => "images",
//        'options' => array(
//            '1col-fixed' => $imagepath . '1col.png',
//            '2c-l-fixed' => $imagepath . '2cl.png',
//            '2c-r-fixed' => $imagepath . '2cr.png'
//        )
//    );
//
//    $options[] = array(
//        'name' =>  __( 'Example Background', 'bonestheme' ),
//        'desc' => __( 'Change the background CSS.', 'bonestheme' ),
//        'id' => 'example_background',
//        'std' => $background_defaults,
//        'type' => 'background'
//    );
//
//    $options[] = array(
//        'name' => __( 'Multicheck', 'bonestheme' ),
//        'desc' => __( 'Multicheck description.', 'bonestheme' ),
//        'id' => 'example_multicheck',
//        'std' => $multicheck_defaults, // These items get checked by default
//        'type' => 'multicheck',
//        'options' => $multicheck_array
//    );
//
//    $options[] = array(
//        'name' => __( 'Colorpicker', 'bonestheme' ),
//        'desc' => __( 'No color selected by default.', 'bonestheme' ),
//        'id' => 'example_colorpicker',
//        'std' => '',
//        'type' => 'color'
//    );
//
//    $options[] = array( 'name' => __( 'Typography', 'bonestheme' ),
//        'desc' => __( 'Example typography.', 'bonestheme' ),
//        'id' => "example_typography",
//        'std' => $typography_defaults,
//        'type' => 'typography'
//    );
//
//    $options[] = array(
//        'name' => __( 'Custom Typography', 'bonestheme' ),
//        'desc' => __( 'Custom typography options.', 'bonestheme' ),
//        'id' => "custom_typography",
//        'std' => $typography_defaults,
//        'type' => 'typography',
//        'options' => $typography_options
//    );

	return $options;
}