<?php $__env->startSection('content'); ?>

<div class="pa-content py-5">
	<div class="container">
        <div class="row justify-content-<?php echo e(is_active_sidebar('archive-authors') ? 'between' : 'center'); ?>">
            <div class="col-12 col-xl-7<?php echo e(is_active_sidebar('archive-authors') ? ' pe-xl-4' : ''); ?>">
                <load-more 
                    template="card-post" 
                    url="<?php echo e(get_rest_url(null, 'wp/v2/columnists')); ?>"
                    args="<?php echo e('_fields=name,link,column,avatar.full&per_page=70&orderby=name'); ?>"
                    nonce="<?php echo e(wp_create_nonce('wp_rest')); ?>"
                >
                    <template id="card-post">
                        <card-author *foreach="{{this.items}}" .author="{{item}}"></card-author>
                    </template>
                </load-more>
            </div>

            <?php if(is_active_sidebar('archive-authors')): ?>
                <aside class="col-md-4 d-none d-xl-block">
                    <?php (dynamic_sidebar('archive-authors')); ?>
                </aside>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/pt/wp-content/themes/pa-theme-noticias/page-authors.blade.php ENDPATH**/ ?>