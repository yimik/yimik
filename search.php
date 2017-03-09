<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

					<main id="main" class="m-all t-2of3 d-5of7 cf" role="main">
						<!--<h1 class="archive-title">
                            <span><?php /*_e( 'Search Results for:', 'bonestheme' ); */?></span>
                            <?php /*echo esc_attr(get_search_query()); */?>
                        </h1>-->
                        <?php breadcrumbs(); ?>

						<?php yimik_post_list()?>

						</main>

							<?php get_sidebar(); ?>

					</div>

			</div>

<?php get_footer(); ?>
