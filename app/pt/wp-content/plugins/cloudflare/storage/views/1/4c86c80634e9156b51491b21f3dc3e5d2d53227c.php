<footer class="mb-5">
    <?php if(!empty($format = getPostFormat(get_the_ID())) && $format->slug == 'coluna' || $format->slug == 'columna' && is_singular('post')): ?>
        <?php
            $previous = get_previous_post(true, '', 'xtt-pa-format');   
            $next = get_next_post(true, '', 'xtt-pa-format');
        ?>

        <div class="row align-items-center">
            <div class="col col-xl-4 order-2 order-xl-1">
                <?php if (! empty($previous)) : ?>
                    <a class="pa-post-link text-decoration-none" href="<?php echo e(get_permalink($previous)); ?>"><i class="fas fa-arrow-left me-3"></i><?php echo e(__('Past article', 'iasd')); ?></a>
                <?php endif; ?>
            </div>
            
            <div class="col-12 col-xl-4 pa-share pa-share-footer text-center order-1 order-xl-2 mb-4 mb-xl-0">
                <?php require(get_template_directory() . '/components/parts/share.php') ?>
            </div>

            <div class="col col-xl-4 text-end order-3">
                
                    <a class="pa-post-link text-decoration-none" href="<?php echo e(get_permalink($next)); ?>"><?php echo e(__('Next article', 'iasd')); ?><i class="fas fa-arrow-right ms-3"></i></a>
                
            </div>
        </div>

        <div class="row mt-4 mt-xl-5 pt-xl-2">
            <div class="col-12 mt-xl-1">
                <?php echo $__env->make('components.cards.card-author', ['id' => get_the_author_meta('ID')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if(comments_open()): ?> 
        <?php echo comments_template(); ?>

    <?php endif; ?>
</footer><?php /**PATH /Users/eli/Dropbox (ComunicaDSA)/projects/deploy-noticias.adventistas.org/app/pt/wp-content/themes/pa-theme-noticias/template-parts/single/footer.blade.php ENDPATH**/ ?>