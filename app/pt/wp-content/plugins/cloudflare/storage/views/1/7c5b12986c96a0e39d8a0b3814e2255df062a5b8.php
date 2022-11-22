<?php if(is_admin()): ?>
	<img class="img-preview" src="<?php echo e(get_stylesheet_directory_uri()); ?>/Blocks/PAListPosts/preview-<?php echo e($block['slug']); ?>.png"  alt='<?php echo e(__('Illustrative image of the front end of the block.', 'iasd')); ?>'/>
<?php else: ?>
	<div class="pa-widget pa-w-list-posts col mb-5 col-md-4">
		<?php if (! empty($title)) : ?>
			<h2><?php echo $title; ?></h2>
		<?php endif; ?>

		<?php if (! empty($items)) : ?>
			<div class="mt-4">
				<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php $format = getPostFormat($item); ?>

					<div class="card mb-5 mb-xl-4 border-0">
						<a href="<?php echo e(get_permalink($item)); ?>" title="<?php echo wp_strip_all_tags(get_the_title($item)); ?>">
							<div class="row">
								<?php if(has_post_thumbnail($item)): ?>
									<div class="img-container">
										<div class="ratio ratio-21x13">
											<figure class="figure m-xl-0">
												<img 
													class="figure-img img-fluid rounded m-0"
													src="<?php echo e(get_the_post_thumbnail_url($item, 'medium')); ?>"
													alt="<?php echo e(get_the_title($item)); ?>" 
												/>
											</figure>
										</div>
									</div>
								<?php endif; ?>
								
								<div class="col">
									<div class="card-body<?php echo e(has_post_thumbnail($item) ? ' p-0' : ' ps-4 pe-0 border-start border-5 pa-border'); ?>">
										<?php if (! empty($format)) : ?>
											<span class="pa-tag text-uppercase d-none d-xl-table-cell rounded"><?php echo e($format->name); ?></span>
										<?php endif; ?>

										<h3 class="card-title mt-xl-2 mb-0 h6 fw-bold pa-truncate-2"><?php echo wp_strip_all_tags(get_the_title($item)); ?></h3>
									</div>
								</div>
							</div>
						</a>
					</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
		<?php endif; ?>

		<?php if (! empty($enable_link)) : ?>
			<a 
				href="<?php echo e($link['url'] ?? '#'); ?>" 
				target="<?php echo e($link['target'] ?? '_self'); ?>"
				class="pa-all-content"
			>
				<?php echo $link['title']; ?>

			</a>
		<?php endif; ?>
	</div>
<?php endif; ?><?php /**PATH /var/www/html/pt/wp-content/themes/pa-theme-noticias/Blocks/PAListPosts/views/frontend.blade.php ENDPATH**/ ?>