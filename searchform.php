       <form class='p-search-form' id='searchform' method='get' action='<?php echo esc_url(home_url('/')); ?>'>
           <label class="screen-reader-text" for="s"><?php echo __('search', 'wpbeg'); ?></label>
           <input class="p-search-form__keyword" placeholder="キーワード" name="s" id="s">
           <input class="p-search-form__submit" id="searchsubmit" type="submit" value="検索">
       </form>