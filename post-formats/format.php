<?php
/*
 * This is the default post format.
 *
 * So basically this is a regular post. if you don't want to use post formats,
 * you can just copy ths stuff in here and replace the post format thing in
 * single.php.
 *
 * The other formats are SUPER basic so you can style them as you like.
 *
 * Again, If you want to remove post formats, just delete the post-formats
 * folder and replace the function below with the contents of the "format.php" file.
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('cf yimik-article mdui-shadow-1 mdui-hoverable'); ?>
         role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">

    <header class="article-header entry-header">

        <h1 class="entry-title single-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h1>

        <p class="byline entry-meta vcard">
            <a class="yimik-chip mdui-ripple mdui-hoverable">
                <span class="yimik-chip-icon"><i class="mdui-icon material-icons">&#xe0b9;</i></span>
                <span class="yimik-chip-title">
                        <?php comments_number(__('<span>No</span> Comments', 'bonestheme'), __('<span>One</span> Comment', 'bonestheme'), __('<span>%</span> Comments', 'bonestheme')); ?>
                    </span>
            </a>
            <a class="yimik-chip mdui-ripple mdui-hoverable">
                <span class="yimik-chip-icon"><i class="mdui-icon material-icons">&#xe916;</i></span>
                <span class="yimik-chip-title">
                        <?php printf(get_the_time(get_option('date_format'))); ?>
                    </span>
            </a>
            <a href="<?php printf(get_the_author_posts_link_yimik()); ?>" class="yimik-chip mdui-ripple mdui-hoverable">
                <span class="yimik-chip-icon"><i class="mdui-icon material-icons">&#xe853;</i></span>
                <span class="yimik-chip-title">
                        <?php printf(get_the_author()); ?>
                    </span>
            </a>
            <a class="yimik-chip mdui-ripple mdui-hoverable">
                <span class="yimik-chip-icon"><i class="mdui-icon material-icons">&#xe417;</i></span>
                <span class="yimik-chip-title">
                        <?php printf(get_post_view()); ?>
                    </span>
            </a>
        </p>

    </header> <?php // end article header ?>

    <section class="entry-content cf" itemprop="articleBody">
        <?php
        // the content (pretty self explanatory huh)
        the_content();

        /*
         * Link Pages is used in case you have posts that are set to break into
         * multiple pages. You can remove this if you don't plan on doing that.
         *
         * Also, breaking content up into multiple pages is a horrible experience,
         * so don't do it. While there are SOME edge cases where this is useful, it's
         * mostly used for people to get more ad views. It's up to you but if you want
         * to do it, you're wrong and I hate you. (Ok, I still love you but just not as much)
         *
         * http://gizmodo.com/5841121/google-wants-to-help-you-avoid-stupid-annoying-multiple-page-articles
         *
        */
        wp_link_pages(array(
            'before' => '<div class="page-links">',
            'after' => '</div>',
            'link_before' => '<span class="mdui-shadow-1 mdui-hoverable mdui-btn mdui-ripple">',
            'link_after' => '</span>',
        ));
        ?>
    </section> <?php // end article section ?>

    <footer class="article-footer">

        <?php printf(__('filed under:', 'bonestheme') . ' %1$s', get_the_category_list(', ')); ?>

        <?php the_tags('<p class="tags"><span class="tags-title">' . __('Tags:', 'bonestheme') . '</span> ', ', ', '</p>'); ?>

    </footer> <?php // end article footer ?>

</article> <?php // end article ?>
<?php comments_template(); ?>
