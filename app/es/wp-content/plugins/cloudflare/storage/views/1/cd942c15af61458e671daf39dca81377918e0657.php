<?php
    global $exclude;
    $count = get_field('featured_layout');
    $count = !empty($count) ? $count : 1;
    $items = array_slice(get_field("featured_items")['data'], 0, $count);

    $items = array_column($items, 'id');

    $exclude = $items;
?>

<?php if (! empty($items)) : ?>
    <div class="row pa-widget pa-w-featured-post position-relative pb-0 mb-md-5 pb-md-2">
        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(count($items) == 3): ?>
                <?php if($loop->index == 0): ?>
                    <div class="col-md-8 pe-md-2">
                <?php elseif($loop->index == 1): ?>
                    <div class="col-md-4">
                <?php endif; ?>
            <?php endif; ?>

            <div class="col-md-<?php echo e(count($items) == 1 || count($items) == 3 ? '12' : '6'); ?>">
                <?php
                    $class = '';

                    if((count($items) == 3 && $loop->index == 1) || count($items) == 1)
                        $class = ' mb-3 pb-1 pb-md-0';
                    elseif(count($items) > 1)
                        $class = ' mb-3 mb-md-0 pb-1 pb-md-0';
                    else
                        $class = ' mb-3 pb-md-3 mb-md-4';
                ?>

                <div class="pa-blog-itens<?php echo e($class); ?>">
                    <div class="pa-blog-feature">
                        <a href="<?php echo e(get_the_permalink($item)); ?>" title="<?php echo e(get_the_title($item)); ?>">
                            <div class="ratio <?php echo e(count($items) == 1 ? 'ratio-591x244' : 'ratio-16x9'); ?>">
                                <figure class="figure m-xl-0 w-100">
                                    <img src="<?php echo e(check_immg($item, 'full')); ?>" class="figure-img img-fluid m-0 rounded w-100 h-100 object-cover" alt="<?php echo e(get_the_title($item)); ?>" />

                                    <figcaption class="figure-caption position-absolute w-100 p-3 rounded-bottom">
                                        <?php if (! empty(getPostFormat($item))) : ?>

                                            <?php if(sanitize_title(getPostFormat($item)->name) == 'video'): ?>
                                                <span class="pa-tag-icon d-inline-block pag-tag-icon-video"><i class="fas fa-play"></i></span>
                                            <?php endif; ?>

                                            <?php if(sanitize_title(getPostFormat($item)->name) == 'audio'): ?>
                                                <span class="pa-tag-icon d-inline-block pag-tag-icon-audio"><i class="fas fa-headphones-alt"></i></span>
                                            <?php endif; ?>

                                            <span class="pa-tag rounded-1 text-uppercase mb-2 d-inline-block px-2"><?php echo e(getPostFormat($item)->name); ?></span>
                                        <?php endif; ?>

                                        <h3 class="h5 pt-2 pa-truncate-2"><?php echo get_the_title($item); ?></h3>
                                    </figcaption>
                                </figure>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <?php if(count($items) == 3 && $loop->index == 0 || count($items) == 3 && $loop->index == 2): ?>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>
<?php /**PATH /var/www/html/es/wp-content/themes/pa-theme-noticias/template-parts/featured-posts.blade.php ENDPATH**/ ?>