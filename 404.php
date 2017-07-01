<?php get_header(); ?>

<div id="content">

    <div id="inner-content" class="wrap cf">

        <main id="main" class="m-all t-2of3 d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
            <article id="post-not-found" class="hentry cf mdui-shadow-1 mdui-hoverable">
                <header class="article-header">
                    <b>4</b><b>0</b><b>4</b>
                </header>
                <section class="entry-content">
                    <p><?php _e( 'The article you were looking for was not found, but maybe try looking again!', 'bonestheme' ); ?></p>
                </section>
                <section class="search">
                    <p><?php get_search_form(); ?></p>
                </section>
                <footer class="article-footer">
                    <p><?php _e( 'This is the 404 page.', 'bonestheme' ); ?></p>
                </footer>
        </main>
    </div>
</div>
<?php get_footer(); ?>
