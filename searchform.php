<form role="search" method="get" id="searchform" class="searchform" action="<?php echo home_url( '/' ); ?>">
    <div>
        <!--<label for="s" class="screen-reader-text"><?php /*_e('Search for:','bonestheme'); */?></label>-->
        <input type="search" placeholder="<?php _e('Search &hellip;','bonestheme'); ?>" class="search-field" id="s" name="s" value="" />
        <button type="submit" class="search-submit" id="searchsubmit" ></button>
    </div>
</form>