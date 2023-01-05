<?php if(is_admin()): ?>
	<img class="img-preview" src="<?php echo e(get_stylesheet_directory_uri()); ?>/Blocks/PAListColumnists/preview.png"  alt='<?php echo e(__('Illustrative image of the front end of the block.', 'iasd')); ?>'/>
<?php else: ?>
	<div class="pa-widget pa-w-list-columns col mb-5 col-md-4">
		<?php if (! empty($title)) : ?>
			<h2><?php echo $title; ?></h2>
		<?php endif; ?>

		<?php if (! empty($items)) : ?>
			<div class="mt-4">
				<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php
						$key         = "user_{$item}"; 
						$avatar      = get_field('user_avatar', $key);
						$column_name = get_field('column_name', $key);
						$data        = get_userdata($item);

						if(!empty($avatar))
            				$avatar = !empty($small = wp_get_attachment_image_src($avatar, 'full')) ? $small[0]   : '';
					?>

					<div class="pa-author-item pa-blog-item">
						<a href="<?php echo e(get_author_posts_url($item)); ?>" title="<?php echo e($data->display_name); ?>">
							<div class="row align-items-center">
								<div class="col-auto pe-3">
									<div class="ratio ratio-1x1">
										<figure class="figure m-0">
											<img src="<?php echo e(!empty($avatar) ? $avatar : 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNjAwIiBoZWlnaHQ9IjkwMCIgdmlld0JveD0iMCAwIDE2MDAgOTAwIj4KICA8cmVjdCBpZD0iUmV0w6JuZ3Vsb18xIiBkYXRhLW5hbWU9IlJldMOibmd1bG8gMSIgd2lkdGg9IjE2MDAiIGhlaWdodD0iOTAwIiBmaWxsPSIjOTA5MDkwIi8+Cjwvc3ZnPg=='); ?>" class="figure-img rounded-circle m-0 h-100 w-100" alt="<?php echo e($data->display_name); ?>" />
										</figure>	
									</div>
								</div>

								<div class="col ps-1">
									<div class="card-body p-0">
										<?php if (! empty($data->display_name)) : ?>
											<h3 class="fw-bold m-0"><?php echo $data->display_name; ?></h3>
										<?php endif; ?>

										<?php if (! empty($column_name)) : ?>
											<p class="pa-truncate-2 m-0"><?php echo $column_name; ?></p>
										<?php endif; ?>
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
<?php endif; ?><?php /**PATH /home/isaltino/git/deplay-noticias.adventistas.org/app/public/pt/wp-content/themes/pa-theme-noticias/Blocks/PAListColumnists/views/frontend.blade.php ENDPATH**/ ?>