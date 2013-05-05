<form method="get" id="searchform" class="submit-search-form" action="<?php echo home_url()  ?>/">
        <div class="search-button-holder">
            <div class="search-button-left"></div>
            <div class="search-button-center">
                <div>
                    <input type="text" name="s" class="search-input" id="s" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" value="<?php _e('Search' , tk_theme_name);?>"/>
                </div>
            </div>
            <div class="search-button-right">
                <input type="submit" id="searchsubmit" class="search-submit-button"value="" />
            </div>
        </div>       
</form>
