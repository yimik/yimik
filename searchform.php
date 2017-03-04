<form role="search" method="get" id="searchform" class="searchform" action="<?php echo home_url( '/' ); ?>">
    <div>
        <!--<label for="s" class="screen-reader-text"><?php /*_e('Search for:','bonestheme'); */?></label>-->
        <input type="search" placeholder="<?php _e('Search &hellip;','bonestheme'); ?>" class="search-field" id="s" name="s" value="" />
        <button type="submit" class="search-submit mdui-btn mdui-ripple" id="searchsubmit" ><i class="mdui-icon material-icons">&#xe8b6;</i></button>
    </div>
</form>