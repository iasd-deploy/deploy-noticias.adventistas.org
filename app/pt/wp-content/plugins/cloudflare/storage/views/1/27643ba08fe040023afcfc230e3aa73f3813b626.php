<?php
    $format_slug = !empty($format = getPostFormat(get_the_ID())) ? $format->slug : 'noticia';
?>

<header class="<?php echo e($format_slug == 'audio' || $format_slug == 'video' ? 'post-header pt-5 pb-4 post-header-'.$format_slug : 'post-header mb-4'); ?>">

    <h1 class="fw-bold mb-3 <?php echo e($format_slug ? 'title-'.$format_slug : ''); ?>"><?php echo single_post_title(); ?></h1>

    <?php if($format_slug != 'audio' && $format_slug != 'video'): ?>

        <h2 class="mb-3 pb-3"><?php echo \Illuminate\Support\Str::of(get_the_excerpt())->limit(250); ?></h2>

        <div class="d-md-flex justify-content-between">
            <?php echo $__env->make('components.metas.author', get_the_ID(), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('components.metas.meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        <hr class="my-45">

        <?php echo $__env->make('components.metas.share', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php endif; ?>
</header><?php /**PATH /var/www/html/pt/wp-content/themes/pa-theme-noticias/template-parts/single/header.blade.php ENDPATH**/ ?>