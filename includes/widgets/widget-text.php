<?php

class CYON_Widget_Text extends WP_Widget {

	// Creating your widget
	function CYON_Widget_Text(){
		$widget_ops = array( 
			'classname' 	=> 'cyon-text',
			'description' 	=> __( 'Alternative arbitrary text or HTML' , 'cyon' )
		);
		$control_ops = array(
			'width'			=> 400,
			'height' 		=> 350
		);
		$this->WP_Widget( 'CYON_Widget_Text' , __( 'THEME Text' , 'cyon' ), $widget_ops, $control_ops );
	}

 	// Widget form in WP Admin
	function form( $instance ){
		// Start adding your fields here
		$instance = wp_parse_args( (array) $instance, array(
			'title' 		=> '',
			'text' 			=> '',
			'icon'			=> ''
		) );
		$title = strip_tags($instance['title']);
		$text = esc_textarea($instance['text']);
		$icon = strip_tags($instance['icon']);

		add_thickbox();

		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title' , 'cyon' ) ?>: <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></label></p>
		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $text; ?></textarea>
		<p><label for="<?php echo $this->get_field_id( 'filter' ); ?>"><input id="<?php echo $this->get_field_id( 'filter' ); ?>" name="<?php echo $this->get_field_name( 'filter' ); ?>" type="checkbox" <?php checked(isset($instance[ 'filter' ]) ? $instance[ 'filter' ] : 0); ?> />&nbsp;<?php _e( 'Automatically add paragraphs' , 'cyon' ); ?></label></p>
		<p><label for="<?php echo $this->get_field_id( 'icon' ); ?>"><?php _e( 'Icon' , 'cyon' ) ?>: <input id="<?php echo $this->get_field_id( 'icon' ); ?>" name="<?php echo $this->get_field_name( 'icon' ); ?>" type="text" value="<?php echo esc_attr( $icon ); ?>" /></label> <a href="<?php echo CYON_PATH; ?>add-editor.php/?id=<?php echo $this->get_field_id( 'icon' ); ?>&amp;includes=icons&amp;TB_iframe" class="thickbox">Select an icon</a></p>
		<?php
	}

	// Saving your widget form
	function update( $new_instance, $old_instance ){
		$instance = $old_instance;
		
		// Override new values of each fields
		$instance['title'] = strip_tags($new_instance['title']);
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
		$instance['filter'] = isset($new_instance['filter']);
		$instance['icon'] = $new_instance['icon'];
		
		return $instance;
	}

	// Displays your widget on the front-end
	function widget($args, $instance){
		extract($args, EXTR_SKIP);
		global $data;
		
		// Start widget
		$title = empty($instance['title']) ? '' : $instance['title'];
		$text = empty($instance['text']) ? '' : shortcode_unautop( do_shortcode( $instance['text'] ) );

		echo $before_widget;
		
		// Show icon if found
		echo empty($instance['icon']) ? '' : '<div class="icon-header" data-uk-scrollspy="{cls:\'uk-animation-fade\'}"><i class="uk-icon-' . $instance['icon'] . '"></i></div>';
		
		if (!empty($title)){
			echo $before_title .  $title . $after_title;
		}
		echo '<div class="widget-content">';
		
		// Display what's the content
		?>
		
		<div class="textwidget"><?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?></div>
		
		<?php
		// End widget
		echo '</div>';
		echo $after_widget;
	}
	
}

// Adding your widget to WordPress
add_action( 'widgets_init', create_function('', 'return register_widget("CYON_Widget_Text");') );
