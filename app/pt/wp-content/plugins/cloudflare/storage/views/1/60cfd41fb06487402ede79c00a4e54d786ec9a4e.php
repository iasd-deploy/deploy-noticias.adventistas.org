<?php $__env->startSection('content'); ?>

<?php echo $__env->make('template-parts.home', [
    'post_type' => 'press',
    'api_url'   => get_rest_url(null, 'wp/v2/press'),
    'sidebar'   => 'front-press',
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/eli/Dropbox (ComunicaDSA)/projects/deploy-noticias.adventistas.org/app/pt/wp-content/themes/pa-theme-noticias/page-press-room.blade.php ENDPATH**/ ?>