/*
 * Bones Scripts File
 * Author: Eddie Machado
 *
 * This file should contain any js scripts you want to add to the site.
 * Instead of calling it in the header or throwing it inside wp_head()
 * this file will be called automatically in the footer so as not to
 * slow the page load.
 *
 * There are a lot of example functions and tools in here. If you don't
 * need any of it, just remove it. They are meant to be helpers and are
 * not required. It's your world baby, you can do whatever you want.
 */


/*
 * Get Viewport Dimensions
 * returns object with viewport dimensions to match css in width and height properties
 * ( source: http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript )
 */
function updateViewportDimensions() {
    var w = window, d = document, e = d.documentElement, g = d.getElementsByTagName('body')[0], x = w.innerWidth || e.clientWidth || g.clientWidth, y = w.innerHeight || e.clientHeight || g.clientHeight;
    return {width: x, height: y};
}
// setting the viewport width
var viewport = updateViewportDimensions();


/*
 * Throttle Resize-triggered Events
 * Wrap your actions in this function to throttle the frequency of firing them off, for better performance, esp. on mobile.
 * ( source: http://stackoverflow.com/questions/2854407/javascript-jquery-window-resize-how-to-fire-after-the-resize-is-completed )
 */
var waitForFinalEvent = (function () {
    var timers = {};
    return function (callback, ms, uniqueId) {
        if (!uniqueId) {
            uniqueId = "Don't call this twice without a uniqueId";
        }
        if (timers[uniqueId]) {
            clearTimeout(timers[uniqueId]);
        }
        timers[uniqueId] = setTimeout(callback, ms);
    };
})();

// how long to wait before deciding the resize has stopped, in ms. Around 50-100 should work ok.
var timeToWaitForLast = 100;


/*
 * Here's an example so you can see how we're using the above function
 *
 * This is commented out so it won't work, but you can copy it and
 * remove the comments.
 *
 *
 *
 * If we want to only do it on a certain page, we can setup checks so we do it
 * as efficient as possible.
 *
 * if( typeof is_home === "undefined" ) var is_home = $('body').hasClass('home');
 *
 * This once checks to see if you're on the home page based on the body class
 * We can then use that check to perform actions on the home page only
 *
 * When the window is resized, we perform this function
 * $(window).resize(function () {
 *
 *    // if we're on the home page, we wait the set amount (in function above) then fire the function
 *    if( is_home ) { waitForFinalEvent( function() {
 *
 *	// update the viewport, in case the window size has changed
 *	viewport = updateViewportDimensions();
 *
 *      // if we're above or equal to 768 fire this off
 *      if( viewport.width >= 768 ) {
 *        console.log('On home page and window sized to 768 width or more.');
 *      } else {
 *        // otherwise, let's do this instead
 *        console.log('Not on home page, or window sized to less than 768.');
 *      }
 *
 *    }, timeToWaitForLast, "your-function-identifier-string"); }
 * });
 *
 * Pretty cool huh? You can create functions like this to conditionally load
 * content and other stuff dependent on the viewport.
 * Remember that mobile devices and javascript aren't the best of friends.
 * Keep it light and always make sure the larger viewports are doing the heavy lifting.
 *
 */

/*
 * We're going to swap out the gravatars.
 * In the functions.php file, you can see we're not loading the gravatar
 * images on mobile to save bandwidth. Once we hit an acceptable viewport
 * then we can swap out those images since they are located in a data attribute.
 */
function loadGravatars() {
    // set the viewport using the function above
    viewport = updateViewportDimensions();
    // if the viewport is tablet or larger, we load in the gravatars
    if (viewport.width >= 768) {
        jQuery('.comment img[data-gravatar]').each(function () {
            jQuery(this).attr('src', jQuery(this).attr('data-gravatar'));
        });
    }
} // end function

/*
 * Put all your regular jQuery in here.
 */
jQuery(document).ready(function ($) {
    //判断移动端
    function is_mobile(){
        return $('header .nav').is(':hidden');
    }

    /*
     * Let's fire off the gravatar function
     * You can remove this if you don't need it
     */
    loadGravatars();

    var $returnTop = $('#return-top');
    var $mobileMenuBar = $('#mobile-menu-bar');
    var yimikMobileMenu = new mdui.Drawer('#yimik-mobile-menu');


    //返回顶部
    $(window).scroll(function () {
        $(window).scrollTop() > 150 ? $returnTop.removeClass('mdui-fab-hide') : $returnTop.addClass('mdui-fab-hide');
    });
    $(document).on('click', '#return-top', function () {
        $('html, body').animate({scrollTop: 0}, 300);
        return false;
    });

    //移动端菜单
    function rendMobileNavBtn() {
        is_mobile()?$mobileMenuBar.removeClass('mdui-fab-hide'):$mobileMenuBar.addClass('mdui-fab-hide');
    }
    rendMobileNavBtn();
    $(window).resize(function () {
        rendMobileNavBtn();
    });
    $mobileMenuBar.click(function () {
        yimikMobileMenu.toggle();
    });

    //slider
    var renderSlider = function () {
        if($('.swiper-container').length){
            var gallery = new Swiper('.swiper-container', {
                autoHeight: true,
                autoplay : 4000,
                nextButton: '.swiper-button-next',
                prevButton: '.swiper-button-prev',
                pagination: '.swiper-pagination',
                paginationType: 'progress',
                loop:true,
                mousewheelControl: true,
                parallax: true
            });
        }
    };
    renderSlider();

    // pjax
    if($.fn.pjax){
        var progressBar = new ToProgress({
            color: '#FF6A00',
            height: '4px',
            duration: 0.2,
            id:'yimik-loading-bar'
        });
        $(document).pjax('a', '#content',{fragment:'#content', timeout:8000});
        //pjax评论、搜索
        $(document).on('submit', 'form', function(event) {
            $.pjax.submit(event,'#content',{fragment:'#content', timeout:8000})
        });
        var progressInterval;
        $(document).on('pjax:send', function() { //loading start
            $('#yimik-loading-bar').css('z-index',99999);
            $('#main').fadeTo(500,0.3);
            progressInterval = setInterval(function () {
                if(progressBar.getProgress()<=80){
                    progressBar.increase(10);
                }
            },200);
        });
        $(document).on('pjax:complete', function() { //loading end
            $('#main').fadeTo(500,1);
            if(progressInterval){
                clearInterval(progressInterval);
            }
            progressBar.finish();
        });
        //禁止hash走ajax
        $(document).on('pjax:click', function(event,options) { //loading end
            if(options.url.indexOf('/wp-admin')>0){
                event.preventDefault();
            }
            if(options.url.indexOf('#')>0 && options.url.split('#')[0] == window.location.href.split('#')[0]){
                event.preventDefault();
            }
            //移动端收回菜单
            if($(event.target).closest('#yimik-mobile-menu').length>0){
                yimikMobileMenu.toggle();
            }
        });
        //init plugins
        $(document).on('ready pjax:end', function(event) {
            // 兼容 SyntaxHighlighter 插件
            if ( window.SyntaxHighlighter )
                SyntaxHighlighter.highlight();
            // 兼容 Crayon Syntax Highlighter 插件
            if ( window.CrayonSyntax )
                CrayonSyntax.init();
            // 兼容 Hermit 音乐播放器
            if ( window.hermitjs )
                hermitjs.reload( 0 );
            //首页轮播图
            renderSlider();
        });
    }
});
/* end of as page load scripts */
