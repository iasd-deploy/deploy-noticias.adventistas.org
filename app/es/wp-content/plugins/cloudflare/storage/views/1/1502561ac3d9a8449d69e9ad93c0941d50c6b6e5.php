<?php
    $sidebar = isset($sidebar) && !empty($sidebar) ? $sidebar : 'front-page';
    $sede = get_field('context');
?>

<div class="pa-content py-3 mt-1 mt-md-4">
	<div class="container">
        <?php echo $__env->make('template-parts.featured-posts', [
            'post_type' => isset($post_type) && !empty($post_type) ? $post_type : 'post',
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="row">
            <div class="pa-news-content col-12<?php echo e(is_active_sidebar($sidebar) ? ' col-md-8' : ''); ?>">
                <?php 
                    global $exclude; 
                    $args = '_fields=featured_media_url.pa-block-render,title,excerpt,link,terms&exclude=' . implode(',', $exclude);
                    if (!empty($sede)){
                        $args .= "&xtt-pa-sedes-tax=". $sede->slug;
                    }
                ?>

                <load-more 
                    template="card-post" 
                    url="<?php echo e(isset($api_url) && !empty($api_url) ? $api_url : get_rest_url(null, 'wp/v2/posts')); ?>"
                    args="<?php echo e($args); ?>"
                    nonce="<?php echo e(wp_create_nonce('wp_rest')); ?>"
                >
                    <template id="card-post">
                        <card-post *foreach="{{this.items}}" .post="{{item}}"></card-post>
                    </template>
                </load-more>
                <div class="d-flex justify-content-center mt-5">
                    <div class="spinner-border text-success" role="status">
                        <span class="visually-hidden"><?php echo e(__('Loading...', 'iasd')); ?></span>
                    </div>
                  </div>
            </div>

            <?php if(is_active_sidebar($sidebar)): ?>
                <aside class="col-md-4 d-none d-xl-block">
                    <?php (dynamic_sidebar($sidebar)); ?>
                </aside>
            <?php endif; ?>
        </div>
    </div>
</div><?php /**PATH /Users/isaltino/Git/deploy-noticias.adventistas.org/app/es/wp-content/themes/pa-theme-noticias/template-parts/home.blade.php ENDPATH**/ ?>