			<footer class="footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">

				<div id="inner-footer" class="wrap cf">

					<p class="source-org copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>.</p>

				</div>
                <button id="return-top" class="mdui-fab-hide mdui-fab mdui-fab-mini mdui-fab-fixed mdui-ripple mdui-color-blue"><i class="mdui-icon material-icons">&#xe5d8;</i></button>
                <button id="mobile-menu-bar" class="mdui-fab-hide mdui-fab mdui-fab-mini mdui-fab-fixed mdui-ripple mdui-color-blue"><i class="mdui-icon material-icons">&#xe5d2;</i></button>
			</footer>

		</div>

        <div id="yimik-mobile-menu" class="mdui-drawer mdui-drawer-close">
            <h1 class="mobile-menu-head"><?php bloginfo('name'); ?></h1>
            <?php wp_nav_menu(array(
                'container' => 'div',                           // enter '' to remove nav container (just make sure .footer-links in _base.scss isn't wrapping)
                'container_class' => 'footer-links cf',         // class of container (should you choose to use it)
                'menu' => __( 'The Mobile Menu', 'bonestheme' ),   // nav name
                'menu_class' => 'nav footer-nav cf',            // adding custom nav class
                'theme_location' => 'footer-links',             // where it's located in the theme
                'before' => '<div class="mdui-ripple">',                                 // before the menu
                'after' => '</div>',                                  // after the menu
                'link_before' => '',                            // before each link
                'link_after' => '',                             // after each link
                'depth' => 0,                                   // limit the depth of the nav
            )); ?>
        </div>

		<?php // all js scripts are loaded in library/bones.php ?>
		<?php wp_footer(); ?>

	</body>

</html> <!-- end of site. what a ride! -->
