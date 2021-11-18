<?php $__env->startSection('content'); ?>

<div class="pa-content py-5">
	<div class="container">
        <div class="row mb-4 mb-xl-5 pb-xl-3">
            <div class="col-12 mb-xl-3">
                <?php echo $__env->make('components.cards.card-author', ['id' => get_queried_object()->ID], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-12<?php echo e(is_active_sidebar('author') ? ' col-md-8' : ''); ?>">
                <load-more 
                    template="card-post" 
                    url="<?php echo e(get_rest_url(null, 'wp/v2/posts')); ?>"
                    args="<?php echo e('_fields=featured_media_url.pa-block-render,title,excerpt,link,terms&author=' . get_queried_object()->ID); ?>"
                    nonce="<?php echo e(wp_create_nonce('wp_rest')); ?>"
                >
                    <template id="card-post">
                        <card-post *foreach="{{this.items}}" .post="{{item}}"></card-post>
                    </template>
                </load-more>
            </div>

            <?php if(is_active_sidebar('author')): ?>
                <aside class="col-md-4 d-none d-xl-block">
                    <?php (dynamic_sidebar('author')); ?>
                </aside>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/eli/Dropbox (ComunicaDSA)/projects/deploy-noticias.adventistas.org/app/pt/wp-content/themes/pa-theme-noticias/author.blade.php ENDPATH**/ ?>