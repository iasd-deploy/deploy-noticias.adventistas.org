<?php if(is_admin()): ?>
	<img class="img-preview" src="<?php echo e(get_stylesheet_directory_uri()); ?>/Blocks/PAContact/preview.png"  alt='<?php echo e(__('Illustrative image of the front end of the block.', 'iasd')); ?>'/>
<?php else: ?>
	<div class="pa-widget col mb-5 col-md-4">
		<div class="pa-w-contact rounded px-3 py-4">
			<div class="d-flex flex-column px-3 py-4">
				<i class="pa-w-contact__icon far fa-file-alt mb-4"></i>

				<?php if (! empty($title)) : ?>
					<h4 class="pa-w-contact__title fw-bold"><?php echo $title; ?></h4>
				<?php endif; ?>

				<?php if (! empty($description)) : ?>
					<p class="mb-<?php echo e(empty($email) && empty($phone) ? '0' : '3'); ?>"><?php echo $description; ?></p>
				<?php endif; ?>

				<?php if (! empty($email)) : ?>
					<div class="mt-2">
						<a class="d-inline-flex align-items-center" href="mailto:<?php echo e($email); ?>"><i class="far fa-envelope" aria-hidden="true"></i><?php echo e($email); ?></a>	
					</div>
				<?php endif; ?>

				<?php if (! empty($phone)) : ?>
					<div class="mt-2">
						<a class="d-inline-flex align-items-center" href="<?php echo e($phone->uri()); ?>"><i class="fas fa-phone-alt" aria-hidden="true"></i><?php echo e($phone->international()); ?></a>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php endif; ?><?php /**PATH /Users/eli/Dropbox (ComunicaDSA)/projects/deploy-noticias.adventistas.org/app/pt/wp-content/themes/pa-theme-noticias/Blocks/PAContact/views/frontend.blade.php ENDPATH**/ ?>