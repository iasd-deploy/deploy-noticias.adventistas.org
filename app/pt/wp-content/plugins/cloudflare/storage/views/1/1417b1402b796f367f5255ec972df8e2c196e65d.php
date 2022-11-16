<?php
    $audio_url = get_field('embed_url');
?>


<?php if(!empty($audio_url)): ?>
    <div class="audio-container pt-4">
        <?php echo $audio_url; ?>

    </div>
<?php endif; ?>

<div class="row d-flex dark-content-bg pb-3 mb-4">
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
<?php /**PATH /var/www/html/pt/wp-content/themes/pa-theme-noticias/template-parts/single/audio-format.blade.php ENDPATH**/ ?>