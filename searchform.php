<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="uk-form" role="search">
	<fieldset>
		<label for="s2" class="assistive-text uk-hidden"><?php _e( 'Search' , 'cyon' ); ?></label>
		<input type="text" name="s" id="s2" autocomplete="off" x-webkit-speech x-webkit-gramar="builtin:search" placeholder="<?php _e( 'Search entire site...', 'cyon' ); ?>" />
		<button type="submit" class="uk-button uk-button-primary" name="submit" title="<?php esc_attr_e( 'Go', 'cyon' ); ?>"><i class="uk-icon-search"></i></button>
	</fieldset>
</form>
