<?php echo get_header(); ?>


<?php echo $__env->make('components.header.title', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldContent('content'); ?>

<?php echo get_footer(); ?><?php /**PATH /home/isaltino/git/deplay-noticias.adventistas.org/app/public/pt/wp-content/themes/pa-theme-noticias/layouts/app.blade.php ENDPATH**/ ?>