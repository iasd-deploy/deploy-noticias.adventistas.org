<?php setup_postdata(get_post()); ?>

<?php
    $terms = get_the_terms( $post->ID, 'xtt-pa-format' );
    $format_slug = null;
    if( !empty($terms) ) {
        $term = array_shift( $terms );
        $format_slug = $term->slug;
    }
?>

<?php $__env->startSection('content'); ?>
    <div class="<?php echo e($format_slug == 'audio' || $format_slug == 'video' ? 'pa-content-container' : 'pa-content-container pt-5 mt-3'); ?>">
        <div class="container">
            <div class="row justify-content-center">
                
                <article class="col-12 col-md-8">
                    
                    <?php echo $__env->make('template-parts.single.header', array('format_slug' => $format_slug), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    
                    <div class="pa-content">
                        <?php if(!empty($format_slug)): ?>

                            
                            <?php switch($format_slug):
                                case ('video'): ?>
                                    <?php echo $__env->make('template-parts.single.video-format', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php break; ?>

                                <?php case ('audio'): ?>
                                    <?php echo $__env->make('template-parts.single.audio-format', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php break; ?>

                                <?php default: ?>
                                    <?php break; ?>
                            <?php endswitch; ?>
                            

                        <?php endif; ?>

                        <?php echo the_content(); ?>

                    </div>

                    <div class="pa-break d-block my-5 py-2"></div>

                    
                    <?php echo $__env->make('template-parts.single.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </article>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/isaltino/git/deplay-noticias.adventistas.org/app/public/pt/wp-content/themes/pa-theme-noticias/single.blade.php ENDPATH**/ ?>