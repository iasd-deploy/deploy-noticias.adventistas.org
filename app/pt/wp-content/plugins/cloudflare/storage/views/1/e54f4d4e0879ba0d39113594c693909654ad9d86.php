<?php
    $format_slug = !empty($format = getPostFormat($id)) ? $format->slug : 'noticia';
?>

<?php if(is_singular('post')): ?>
    <div class="pa-post-meta mb-2"><?php echo e(__('By', 'iasd')); ?>

        <span><?php echo e(getCurrentAuthor($id)); ?></span>
        <?php if($region = getPostRegion($id)): ?>
            <em class="pa-pipe">|</em>
            <span class=""><i class="fas fa-map-marker-alt me-2" aria-hidden="true"></i> <?php echo e($region->name); ?></span>
        <?php endif; ?>
    </div>
<?php endif; ?>
<?php /**PATH /var/www/html/pt/wp-content/themes/pa-theme-noticias/components/metas/author.blade.php ENDPATH**/ ?>