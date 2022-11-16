<?php
    $video_url = get_field('embed_url', $post_id, true);
?>


<?php if(!empty($video_url)): ?>
    <div class="floating-video position-relative" id="embed-video">
        <picture class="d-inline-block mw-100 floating-video__thumbnail w-100 overflow-hidden">
            <?php echo $video_url; ?>

        </picture>
        <div class="card__play position-absolute">
            <div class="icon rounded-circle d-flex align-items-center">
                <em class="uil uil-play mx-auto"></em>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="row d-flex align dark-content-bg meta-video pt-4 pb-3 mb-4">
    <div class="col-md-6 col-12">
        <?php echo $__env->make('components.metas.author', get_the_ID(), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <div class="col-md-6 col-12 post-meta-date">
        <?php echo $__env->make('components.metas.meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div>
<div class="col-12">
    <?php echo $__env->make('components.metas.share', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php /**PATH /var/www/html/pt/wp-content/themes/pa-theme-noticias/template-parts/single/video-format.blade.php ENDPATH**/ ?>