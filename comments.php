<?php
/*
The comments page for Bones
*/

// don't load it if you can't comment
if (post_password_required()) {
    return;
}

?>

<?php // You can start editing here. ?>

<div id="comments" class="yimik-comment-panel">

    <?php if (have_comments()) : ?>

        <h3 id="comments-title"><?php comments_number(__('<span>No</span> Comments', 'bonestheme'), __('<span>One</span> Comment', 'bonestheme'), __('<span>%</span> Comments', 'bonestheme')); ?></h3>

        <section class="commentlist">
            <?php
            wp_list_comments(array(
                'style' => 'div',
                'short_ping' => true,
                'avatar_size' => 40,
                'callback' => 'bones_comments',
                'type' => 'all',
                'reply_text' => __('Reply', 'bonestheme'),
                'page' => '',
                'per_page' => '',
                'reverse_top_level' => null,
                'reverse_children' => '',
                'before' => '<span class="yimik-reply-btn mdui-btn mdui-ripple">',
                'after' => '</span>'
            ));
            ?>
        </section>

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
            <?php yimik_comments_navi()?>
        <?php endif; ?>

        <?php if (!comments_open()) : ?>
            <p class="no-comments"><?php _e('Comments are closed.', 'bonestheme'); ?></p>
        <?php endif; ?>

    <?php endif; ?>

    <?php if ( comments_open( $post_id ) ) : ?>
    <div id="yimik-respond" class="yimik-comment-panel-respond mdui-shadow-1 mdui-hoverable">
        <?php comment_form(); ?>
    </div>
    <?php endif;?>
</div>
