<?php

// wp media regenerate 301423 --allow-root
// PARA EXECUTAR O SCRIPT, RODE NO TERMINAL (com wpcli instalado): 
// wp eval-file moveImg.php --skip-themes --skip-plugins --allow-root


moveImage();

//regenerateImage();

function moveImage()
{

    ob_start();

    $args = array(
        "posts_per_page"    => "-1",
        'post_status' => 'any',
        'post_type'   => 'attachment'
    );
    $posts = get_posts($args);

    $cont = 0;

    foreach ($posts as &$post) {

        $search = "/([-][a-z]+[x])|([-]+[x])/";

        $key = get_post_meta($post->ID, '_wp_attached_file', true);

        if (preg_match($search, $key)) {

            $info = get_post_meta($post->ID, 'amazonS3_info', true);

            if ($info == "") {

                global $wpdb;
                $value = $wpdb->get_var($wpdb->prepare(
                    " SELECT path FROM wp_as3cf_items WHERE source_id = {$post->ID}",
                    get_current_user_id()
                ));

                $url = explode("noticias/", $value);

                //echo $cont++ . " - " . $post->ID . " - " . $info;
                echo "s3cmd cp s3://files.adventistas.org/" . $value . " s3://files.adventistas.org/noticias_v2/" . $url[1];
                echo "\n";
            } else {

                $url = explode("noticias/", $info['key']);

                //echo $cont++ . " - " . $post->ID . " - " . $info['key'];
                echo "s3cmd cp s3://files.adventistas.org/noticias/" . $url[1] . " s3://files.adventistas.org/noticias_v2/" . $url[1];
                echo "\n";
            }
        }
    }

    ob_end_flush();
}

function regenerateImage()
{

    ob_start();

    $args = array(
        "posts_per_page"    => "-1",
        'post_status' => 'any',
        'post_type'   => 'attachment'
    );
    $posts = get_posts($args);

    $cont = 0;



    foreach ($posts as &$post) {

        $search = "/([-][a-z]+[x])|([-]+[x])/";

        $key = get_post_meta($post->ID, '_wp_attached_file', true);

        if (preg_match($search, $key)) {

            echo "wp media regenerate " . $post->ID . " --allow-root";
            echo "\n";
        }
    }

    ob_end_flush();
}
