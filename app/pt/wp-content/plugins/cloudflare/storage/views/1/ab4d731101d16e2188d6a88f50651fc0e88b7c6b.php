<?php setup_postdata(get_post()); ?>

<?php $__env->startSection('content'); ?>
    <div class="pa-content-container pt-5 mt-3">
        <div class="container">
            <div class="row justify-content-center">
                
                <article class="col-12 col-md-8">          
                    
                    <?php echo $__env->make('template-parts.single.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    
                    <div class="pa-content">
                        <?php echo the_content(); ?>

                    </div>

                    <div class="pa-break d-block my-5 py-2"></div>

                    
                    <?php echo $__env->make('template-parts.single.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </article>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/eli/Dropbox (ComunicaDSA)/projects/deploy-noticias.adventistas.org/app/pt/wp-content/themes/pa-theme-noticias/single.blade.php ENDPATH**/ ?>