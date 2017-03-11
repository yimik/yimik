<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

						<main id="main" class="m-all t-2of3 d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
                            <!--面包屑导航-->
                            <?php breadcrumbs();?>
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                                <article id="post-<?php the_ID(); ?>" <?php post_class('cf yimik-article mdui-shadow-1 mdui-hoverable'); ?>
                                         role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">

                                    <header class="article-header entry-header">

                                        <h1 class="entry-title single-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h1>

                                        <p class="byline entry-meta vcard">
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


                                    </footer> <?php // end article footer ?>

                                </article> <?php // end article ?>

							<?php endwhile; endif; ?>

						</main>

						<?php get_sidebar(); ?>

				</div>

			</div>

<?php get_footer(); ?>
