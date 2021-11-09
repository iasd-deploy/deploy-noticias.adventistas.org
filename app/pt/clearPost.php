<?php

// PARA EXECUTAR O SCRIPT, RODE NO TERMINAL (com wpcli instalado): 
// wp eval-file clearPost.php

clearImages();

function clearImages() {
	ob_start();

	$log = fopen('log.txt', 'a');

	$args = array(
		"posts_per_page"    => "-1",
		"post_status"       => "publish",
		'meta_query' => array(
			'relation' => 'OR',
			array( 
				'key'=> 'img_processed',
				'value' => false
			),
			array( 
				'key'=> 'img_processed',
				'compare' => 'NOT EXISTS'
			)
		  ),
	);
	$posts = get_posts($args);
	
	echo "\n\n";
	echo "POSTS A PROCESSAR: ". count($posts);
	fwrite($log, "\n\nPOSTS A PROCESSAR: ". count($posts) ."\n");
	echo "\n\n";
	
	foreach ($posts as &$post){
		sleep(0.5);
		$count++;
		
		add_post_meta($post->ID, "img_processed", false, true);

		//pega todas as midias anexadas ao post
		$medias = get_attached_media( '', $post->ID );

		foreach($medias as &$media){

			switch (true) {
				case (strpos($post->post_content, strval($media->ID))):
					$msg = "\e[39m P - ". $count ." - ". $post->ID ." - ". $media->ID ." - ". $media->guid ."\n";
					echo $msg;
					fwrite($log, $msg);
					break;
				case (get_post_thumbnail_id($post->ID) == $media->ID):
					$msg = "\e[33m T - ". $count ." - ". $post->ID ." - ". $media->ID ." - ". $media->guid ."\n";
					echo $msg;
					fwrite($log, $msg);
					break;
				default:
					$msg = "\e[31m X - ". $count ." - ". $post->ID ." - ". $media->ID ." - ". $media->guid ."\n";
					echo $msg;
					fwrite($log, $msg);
					// wp_delete_attachment( $media->ID, true );
			}
			ob_flush();
			flush();
		}

		update_post_meta($post->ID, "img_processed", true);
	}
	fclose($log);
	echo "\n";
	ob_end_flush();
}