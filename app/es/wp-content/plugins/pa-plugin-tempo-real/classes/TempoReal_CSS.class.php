<?php class TempoReal_CSS {

	public static function init(){
		$post_id = get_the_ID();

		$bg_image = get_field('bg_image', $post_id);
		$bg_color = get_field('bg_color', $post_id);
		$text_color = get_field('text_color', $post_id);
		$bg_image_footer = get_field('bg_image_footer', $post_id);

		if($bg_image){ 
			$bg_image = "background-image: url(". $bg_image ."); \n";
		}

		if($bg_color){
			$bg_color = "background-color:". $bg_color ."; \n";
			$bg_color .= "background-image: none; \n";
		}

		if($text_color){
			$text_color = "color:". $text_color ."; \n";
		}

		if($bg_image_footer){
			$bg_image_footer = "body > footer { \n";
			$bg_image_footer .= "background-image: url(". get_field('bg_image_footer', $post_id) .") !important; \n";
			$bg_image_footer .= "} \n";
		}

		$custom_css = 
			"<style type=text/css>".
				"body{ \n". 
					$bg_image . 
					$bg_color .
					$text_color.
				"} \n".
					$bg_image_footer.
			"</style>";
		echo $custom_css;
	}
}

add_action( 'wp_head', array('TempoReal_CSS', 'init') );