<?php
/*
Author: Eddie Machado
URL: http://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, etc.
*/

// LOAD BONES CORE (if you remove this, the theme will break)
require_once( 'library/bones.php' );

// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
// require_once( 'library/admin.php' );

// 引入主题设置面板
define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
require_once('inc/options-framework.php');

/*********************
LAUNCH BONES
Let's get everything up and running.
*********************/

function bones_ahoy() {

  //Allow editor style.
  add_editor_style( get_stylesheet_directory_uri() . '/library/css/editor-style.css' );

  // let's get language support going, if you need it
  load_theme_textdomain( 'bonestheme', get_template_directory() . '/library/translation' );

  // USE THIS TEMPLATE TO CREATE CUSTOM POST TYPES EASILY
  require_once( 'library/custom-post-type.php' );

  // launching operation cleanup
  add_action( 'init', 'bones_head_cleanup' );
  // A better title
  add_filter( 'wp_title', 'rw_title', 10, 3 );
  // remove WP version from RSS
  add_filter( 'the_generator', 'bones_rss_version' );
  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'bones_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'bones_remove_recent_comments_style', 1 );
  // clean up gallery output in wp
  add_filter( 'gallery_style', 'bones_gallery_style' );

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'bones_scripts_and_styles', 999 );
  // ie conditional wrapper

  // launching this stuff after theme setup
  bones_theme_support();

  // adding sidebars to Wordpress (these are created in functions.php)
  add_action( 'widgets_init', 'bones_register_sidebars' );

  // cleaning up random code around images
  add_filter( 'the_content', 'bones_filter_ptags_on_images' );
  // cleaning up excerpt
  add_filter( 'excerpt_more', 'bones_excerpt_more' );

} /* end bones ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'bones_ahoy' );

/*************** 主题选项功能配置 ****************/
function prefix_options_menu_filter( $menu ) {
    $menu['mode'] = 'menu';
    $menu['page_title'] = __( 'Theme Options', 'bonestheme');
    $menu['menu_title'] = __( 'Theme Options', 'bonestheme');
    $menu['menu_slug'] = 'theme-options-yimik';
    return $menu;
}
add_filter( 'optionsframework_menu', 'prefix_options_menu_filter' );
/*end 主题选项功能配置*/


/************* OEMBED SIZE OPTIONS *************/

if ( ! isset( $content_width ) ) {
	$content_width = 680;
}

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'yimik-thumb-600', 600, 150, true );
add_image_size( 'yimik-thumb-300', 300, 100, true );
add_image_size( 'yimik-thumb-140', 140, 100, true );

/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 100 sized image,
we would use the function:
<?php the_post_thumbnail( 'yimik-thumb-300' ); ?>
for the 600 x 150 image:
<?php the_post_thumbnail( 'yimik-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

add_filter( 'image_size_names_choose', 'bones_custom_image_sizes' );

function bones_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'yimik-thumb-600' => __('600px by 150px'),
        'yimik-thumb-300' => __('300px by 100px'),
        'yimik-thumb-140' => __('140px by 100px'),
    ) );
}

/*
The function above adds the ability to use the dropdown menu to select
the new images sizes you have just created from within the media manager
when you add media to your content blocks. If you add more image sizes,
duplicate one of the lines in the array and name it according to your
new image size.
*/

/************* THEME CUSTOMIZE *********************/

/* 
  A good tutorial for creating your own Sections, Controls and Settings:
  http://code.tutsplus.com/series/a-guide-to-the-wordpress-theme-customizer--wp-33722
  
  Good articles on modifying the default options:
  http://natko.com/changing-default-wordpress-theme-customization-api-sections/
  http://code.tutsplus.com/tutorials/digging-into-the-theme-customizer-components--wp-27162
  
  To do:
  - Create a js for the postmessage transport method
  - Create some sanitize functions to sanitize inputs
  - Create some boilerplate Sections, Controls and Settings
*/

function bones_theme_customizer($wp_customize) {
  // $wp_customize calls go here.
  //
  // Uncomment the below lines to remove the default customize sections 

  // $wp_customize->remove_section('title_tagline');
  // $wp_customize->remove_section('colors');
  // $wp_customize->remove_section('background_image');
  // $wp_customize->remove_section('static_front_page');
  // $wp_customize->remove_section('nav');

  // Uncomment the below lines to remove the default controls
  // $wp_customize->remove_control('blogdescription');
  
  // Uncomment the following to change the default section titles
  // $wp_customize->get_section('colors')->title = __( 'Theme Colors' );
  // $wp_customize->get_section('background_image')->title = __( 'Images' );
}

add_action( 'customize_register', 'bones_theme_customizer' );

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar 1', 'bonestheme' ),
		'description' => __( 'The first (primary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget mdui-shadow-3 mdui-hoverable %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	/*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'Sidebar 2', 'bonestheme' ),
		'description' => __( 'The second (secondary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!

//custom widget tag cloud
add_filter( 'widget_tag_cloud_args', 'theme_tag_cloud_args' );
function theme_tag_cloud_args( $args ){
    $newargs = array(
        'smallest'    => 8,  //最小字号
        'largest'     => 22, //最大字号
        'unit'        => 'pt',   //字号单位，可以是pt、px、em或%
        'number'      => 45,     //显示个数
        'format'      => 'flat',//列表格式，可以是flat、list或array
        'separator'   => "\n",   //分隔每一项的分隔符
        'orderby'     => 'name',//排序字段，可以是name或count
        'order'       => 'ASC', //升序或降序，ASC或DESC
        'exclude'     => null,   //结果中排除某些标签
        'include'     => null,  //结果中只包含这些标签
        'link'        => 'view', //taxonomy链接，view或edit
        'taxonomy'    => 'post_tag' //调用哪些分类法作为标签云
    );
    $return = array_merge( $args, $newargs);
    return $return;
}
function color_cloud($text) {
    $text = preg_replace_callback('|<a (.+?)>|i','color_cloud_callback', $text);
    return $text;
}
function color_cloud_callback($matches) {
    $text = $matches[1];
    $color = dechex(rand(0,16777215));
    $pattern = '/style=(\'|")([^\'^"]*)(\'|")/i';
    $class_pattern = '/class=(\'|")([^\'^"]*)(\'|")/i';
    $text = preg_replace($pattern, "style=\"color:#{$color};$2\"", $text);
    $text = preg_replace($class_pattern, "class=\"mdui-ripple mdui-hoverable $2\"", $text);
    return "<a $text>";
}
add_filter('wp_tag_cloud', 'color_cloud', 1);


/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
    <article  class="cf">
      <header class="comment-author vcard">
        <?php
        /*
          this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
          echo get_avatar($comment,$size='32',$default='<path_to_url>' );
        */
        ?>
        <?php // custom gravatar call ?>
        <?php
          // create variable
          $bgauthemail = get_comment_author_email();
        ?>
        <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=40" class="load-gravatar avatar avatar-48 photo" height="40" width="40" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
        <?php // end custom gravatar call ?>
        <?php printf(__( '<cite class="fn">%1$s</cite> %2$s', 'bonestheme' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ) ?>
        <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'bonestheme' )); ?> </a></time>

      </header>
      <?php if ($comment->comment_approved == '0') : ?>
        <div class="alert alert-info">
          <p><?php _e( 'Your comment is awaiting moderation.', 'bonestheme' ) ?></p>
        </div>
      <?php endif; ?>
      <section class="comment_content cf">
        <?php comment_text() ?>
      </section>
      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </article>
  <?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!


//*******************post list*************************//

function yimik_post_list(){
    if (have_posts()) : while (have_posts()) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class( 'cf mdui-shadow-3 mdui-hoverable' ); ?> role="article">
            <header class="article-header mdui-ripple">
                <h1 class="h2 entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php if(is_sticky()){printf("<i class='stickys'>".__("sticky","bonestheme")."</i>");} the_title(); ?></a></h1>
            </header>
            <section class="entry-content cf">
                <div class="entry-content-thumb">
                    <?php the_post_thumbnail( 'yimik-thumb-140' ); ?>
                </div>
                <div class="entry-content-text">
                    <?php
                    if (is_single() or is_page())
                    {the_content();}
                    else
                    {the_excerpt();}
                    ?>
                </div>
            </section>
            <footer class="article-footer cf">
                <a class="yimik-chip mdui-ripple mdui-hoverable">
                    <span class="yimik-chip-icon"><i class="mdui-icon material-icons">&#xe0b9;</i></span>
                    <span class="yimik-chip-title">
                        <?php comments_number( __( '<span>No</span> Comments', 'bonestheme' ), __( '<span>One</span> Comment', 'bonestheme' ), __( '<span>%</span> Comments', 'bonestheme' ) );?>
                    </span>
                </a>
                <a class="yimik-chip mdui-ripple mdui-hoverable">
                    <span class="yimik-chip-icon"><i class="mdui-icon material-icons">&#xe916;</i></span>
                    <span class="yimik-chip-title">
                        <?php printf(get_the_time(get_option('date_format'))); ?>
                    </span>
                </a>
                <a class="yimik-chip mdui-ripple mdui-hoverable">
                    <span class="yimik-chip-icon"><i class="mdui-icon material-icons">&#xe853;</i></span>
                    <span class="yimik-chip-title">
                        <?php printf(get_the_author());?>
                    </span>
                </a>
                <a class="yimik-chip mdui-ripple mdui-hoverable">
                    <span class="yimik-chip-icon"><i class="mdui-icon material-icons">&#xe417;</i></span>
                    <span class="yimik-chip-title">
                        <?php printf(get_post_meta( get_the_ID(), 'views', true ));?>
                    </span>
                </a>
                <?php /*printf( '<p class="footer-category">' . __('filed under:', 'bonestheme' ) . ' %1$s</p>' , get_the_category_list(', ') ); */?>
                <?php /*the_tags( '<p class="footer-tags tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); */?>
                <!--<p class="footer-meta">
                    <?php /*printf( __( 'Posted', 'bonestheme' ).' %1$s %2$s',
                        '<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>',
                        '<span class="by">'.__( 'by', 'bonestheme').'</span> <span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_link( get_the_author_meta( 'ID' ) ) . '</span>'
                    ); */?>
                </p>-->
            </footer>
        </article>
    <?php endwhile; ?>
    <?php bones_page_navi(); ?>
    <?php else : ?>

        <article id="post-not-found" class="hentry cf">
            <header class="article-header">
                <h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
            </header>
            <section class="entry-content">
                <p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
            </section>
            <footer class="article-footer">
                <p><?php _e( 'This is the error message in the index.php template.', 'bonestheme' ); ?></p>
            </footer>
        </article>

    <?php endif;
}

/*
This is a modification of a function found in the
twentythirteen theme where we can declare some
external fonts. If you're using Google Fonts, you
can replace these fonts, change it in your scss files
and be up and running in seconds.
*/
function bones_fonts() {
//  wp_enqueue_style('googleFonts', '//fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic');
    //replace the google font and fuck the gfw ----by yimik at 2017.3.2
    wp_enqueue_style('googleFonts', '//fonts.css.network/css?family=Lato:400,700,400italic,700italic');
}

add_action('wp_enqueue_scripts', 'bones_fonts');

/* DON'T DELETE THIS CLOSING TAG */ ?>
