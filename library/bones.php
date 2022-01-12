<?php
/* Welcome to Bones :)
This is the core Bones file where most of the
main functions & features reside. If you have
any custom functions, it's best to put them
in the functions.php file.

Developed by: Eddie Machado
URL: http://themble.com/bones/

  - head cleanup (remove rsd, uri links, junk css, ect)
  - enqueueing scripts & styles
  - theme support functions
  - custom menu output & fallbacks
  - related post function
  - page-navi function
  - removing <p> from around images
  - customizing the post excerpt

*/

/*********************
WP_HEAD GOODNESS
The default wordpress head is
a mess. Let's clean it up by
removing all the junk we don't
need.
*********************/

function bones_head_cleanup() {
	// category feeds
	// remove_action( 'wp_head', 'feed_links_extra', 3 );
	// post and comment feeds
	// remove_action( 'wp_head', 'feed_links', 2 );
	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	// WP version
	remove_action( 'wp_head', 'wp_generator' );
	// remove WP version from css
	add_filter( 'style_loader_src', 'bones_remove_wp_ver_css_js', 9999 );
	// remove Wp version from scripts
	add_filter( 'script_loader_src', 'bones_remove_wp_ver_css_js', 9999 );

} /* end bones head cleanup */

// A better title
// http://www.deluxeblogtips.com/2012/03/better-title-meta-tag.html
function rw_title( $title, $sep, $seplocation ) {
  global $page, $paged;

  // Don't affect in feeds.
  if ( is_feed() ) return $title;

  // Add the blog's name
  if ( 'right' == $seplocation ) {
    $title .= get_bloginfo( 'name' );
  } else {
    $title = get_bloginfo( 'name' ) . $title;
  }

  // Add the blog description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );

  if ( $site_description && ( is_home() || is_front_page() ) ) {
    $title .= " {$sep} {$site_description}";
  }

  // Add a page number if necessary:
  if ( $paged >= 2 || $page >= 2 ) {
    $title .= " {$sep} " . sprintf( __( 'Page %s', 'dbt' ), max( $paged, $page ) );
  }

  return $title;

} // end better title

// remove WP version from RSS
function bones_rss_version() { return ''; }

// remove WP version from scripts
function bones_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver='.get_bloginfo( 'version' ) ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}

// remove injected CSS for recent comments widget
function bones_remove_wp_widget_recent_comments_style() {
	if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
		remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	}
}

// remove injected CSS from recent comments widget
function bones_remove_recent_comments_style() {
	global $wp_widget_factory;
	if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
		remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
	}
}

// remove injected CSS from gallery
function bones_gallery_style($css) {
	return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}


/*********************
SCRIPTS & ENQUEUEING
*********************/

// loading modernizr and jquery, and reply script
function bones_scripts_and_styles(){

    global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

    if (!is_admin()) {

        // modernizr (without media query polyfill)
        wp_register_script('bones-modernizr', get_stylesheet_directory_uri() . '/library/js/libs/modernizr.custom.min.js', array(), '2.5.3', false);

        // register main stylesheet
        wp_register_style('bones-stylesheet', get_stylesheet_directory_uri() . '/library/css/style.css', array(), wp_get_theme()->get("Version"), 'all');

        // ie-only style sheet
        wp_register_style('bones-ie-only', get_stylesheet_directory_uri() . '/library/css/ie.css', array(), wp_get_theme()->get("Version"));

        // comment reply script for threaded comments,remove is_singular for pjax
        if (/*is_singular() AND */comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
        //adding library mdui
        wp_register_script('mdui', get_stylesheet_directory_uri() . '/library/mdui/js/mdui.min.js', array(), '0.4.1', true);
        wp_register_style('mdui', get_stylesheet_directory_uri() . '/library/mdui/css/mdui.min.css', array(), '0.4.1');

        //adding share library
        wp_register_script('social-sharer', get_stylesheet_directory_uri() . '/library/social-sharer/jquery.social-sharer.min.js', array(), '1.1.3', true);
        wp_register_style('social-sharer', get_stylesheet_directory_uri() . '/library/social-sharer/social-sharer.min.css', array(), '1.1.3');

        //add swiper library
        wp_register_script('swiper', get_stylesheet_directory_uri() . '/library/swiper/swiper-bundle.min.js', array(), '7.4.1', true);
        wp_register_style('swiper', get_stylesheet_directory_uri() . '/library/swiper/swiper-bundle.min.css', array(), '7.4.1');

        // register pjax lib
        if(of_get_option("pjax")) {
            wp_register_script('pjax', get_stylesheet_directory_uri() . '/library/js/libs/jquery.pjax.js', array(), '2.0.1', true);
            wp_register_script('toProgress', get_stylesheet_directory_uri() . '/library/js/libs/ToProgress.min.js', array(), '0.1.1', true);
        }

        //adding scripts file in the footer
        wp_register_script('bones-js', get_stylesheet_directory_uri() . '/library/js/scripts.js', array('jquery'), wp_get_theme()->get("Version"), true);


        //add swiper if set display=true
        if(of_get_option("swiper_display")){
            wp_enqueue_style('swiper');
            wp_enqueue_script('swiper');
        }
        // enqueue pjax
        if(of_get_option("pjax")) {
            wp_enqueue_script('pjax');
            wp_enqueue_script('toProgress');
        }

        wp_enqueue_script('bones-js');

        // enqueue mdui
        wp_enqueue_script('mdui');
        wp_enqueue_style('mdui');

        // enqueue share library
        wp_enqueue_script('social-sharer');
        wp_enqueue_style('social-sharer');

        // enqueue styles and scripts
        wp_enqueue_script('bones-modernizr');
        wp_enqueue_style('bones-stylesheet');
        wp_enqueue_style('bones-ie-only');

        // enqueue dashicons
        //wp_enqueue_style( 'dashicons' );

        $wp_styles->add_data('bones-ie-only', 'conditional', 'lt IE 9'); // add conditional wrapper around ie stylesheet

        /*
        I recommend using a plugin to call jQuery
        using the google cdn. That way it stays cached
        and your site will load faster.
        */
        wp_enqueue_script('jquery');
    }
}

/*********************
THEME SUPPORT
*********************/

// Adding WP 3+ Functions & Theme Support
function bones_theme_support() {

	// wp thumbnails (sizes handled in functions.php)
	add_theme_support( 'post-thumbnails' );

	// default thumb size
	set_post_thumbnail_size(125, 125, true);

	// wp custom background (thx to @bransonwerner for update)
	add_theme_support( 'custom-background',
	    array(
	    'default-image' => '',    // background image default
	    'default-color' => '',    // background color default (dont add the #)
	    'wp-head-callback' => '_custom_background_cb',
	    'admin-head-callback' => '',
	    'admin-preview-callback' => ''
	    )
	);

	// rss thingy
	add_theme_support('automatic-feed-links');

	// to add header image support go here: http://themble.com/support/adding-header-background-image-support/

	// adding post format support
//	add_theme_support( 'post-formats',
//		array(
//			'aside',             // title less blurb
//			'gallery',           // gallery of images
//			'link',              // quick link to other site
//			'image',             // an image
//			'quote',             // a quick quote
//			'status',            // a Facebook like status update
//			'video',             // video
//			'audio',             // audio
//			'chat'               // chat transcript
//		)
//	);

	// wp menus
	add_theme_support( 'menus' );

	// registering wp3+ menus
	register_nav_menus(
		array(
			'main-nav' => __( 'The Main Menu', 'bonestheme' ),   // main nav in header
			'footer-links' => __( 'The Mobile Menu', 'bonestheme' ) // secondary nav in footer
		)
	);

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form'
	) );

} /* end bones theme support */


/*********************
RELATED POSTS FUNCTION
*********************/

// Related Posts Function (call using bones_related_posts(); )
function bones_related_posts() {
	echo '<ul id="bones-related-posts">';
	global $post;
	$tags = wp_get_post_tags( $post->ID );
	if($tags) {
		foreach( $tags as $tag ) {
			$tag_arr .= $tag->slug . ',';
		}
		$args = array(
			'tag' => $tag_arr,
			'numberposts' => 5, /* you can change this to show more */
			'post__not_in' => array($post->ID)
		);
		$related_posts = get_posts( $args );
		if($related_posts) {
			foreach ( $related_posts as $post ) : setup_postdata( $post ); ?>
				<li class="related_post"><a class="entry-unrelated" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
			<?php endforeach; }
		else { ?>
			<?php echo '<li class="no_related_post">' . __( 'No Related Posts Yet!', 'bonestheme' ) . '</li>'; ?>
		<?php }
	}
	wp_reset_postdata();
	echo '</ul>';
} /* end bones related posts function */

/*********************
PAGE NAVI
*********************/

// Numeric Page Navi (built into the theme by default)
function bones_page_navi() {
    global $wp_query;
    if( $wp_query->max_num_pages <= 1 || is_single() ) return;
	echo '<nav class="pagination">';
	$pageArray = paginate_links( array(
        'prev_text' => '&larr;',
        'next_text' => '&rarr;',
        'echo' => false,
        'type' => 'array',
		'end_size'  => 3,
		'mid_size'  => 3
	) );
	$pageHtml  = "";
	$pageHtml .= "<ul class='page-numbers'>\n\t<li class='mdui-shadow-1 mdui-hoverable mdui-btn mdui-ripple'>";
	$pageHtml .= join( "</li>\n\t<li class='mdui-shadow-1 mdui-hoverable mdui-btn mdui-ripple'>", $pageArray );
	$pageHtml .= "</li>\n</ul>\n";

	echo $pageHtml;
	echo '</nav>';
} /* end page navi */

function yimik_comments_navi(){
    echo '<nav class="pagination">';
    $pageArray = paginate_comments_links(array(
        'prev_text' => '&larr;',
        'next_text' => '&rarr;',
        'echo' => false,
        'type' => 'array'
    ));
    $pageHtml  = "";
    $pageHtml .= "<ul class='page-numbers'>\n\t<li class='mdui-shadow-1 mdui-hoverable mdui-btn mdui-ripple'>";
    $pageHtml .= join( "</li>\n\t<li class='mdui-shadow-1 mdui-hoverable mdui-btn mdui-ripple'>", $pageArray );
    $pageHtml .= "</li>\n</ul>\n";
    echo $pageHtml;
    echo '</nav>';
}

/*********************
RANDOM CLEANUP ITEMS
*********************/

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function bones_filter_ptags_on_images($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

// This removes the annoying […] to a Read More link
function bones_excerpt_more($more) {
	global $post;
	//remove read more link
    return '...';
//	return '...  <a class="excerpt-read-more" href="'. get_permalink( $post->ID ) . '" title="'. __( 'Read ', 'bonestheme' ) . esc_attr( get_the_title( $post->ID ) ).'">'. __( 'Read more &raquo;', 'bonestheme' ) .'</a>';
}

//change excerpt length
function yimik_excerpt_length($length){
    return 150;
}
?>
