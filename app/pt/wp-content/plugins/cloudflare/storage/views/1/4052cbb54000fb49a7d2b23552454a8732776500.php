<header class="mb-4">
    <h1 class="fw-bold mb-3"><?php echo single_post_title(); ?></h1>

    <h2 class="mb-3 pb-3"><?php echo \Illuminate\Support\Str::of(get_the_excerpt())->limit(250); ?></h3>

    <?php if(!empty($format = getPostFormat(get_the_ID())) && $format->slug != 'artigo' && is_singular('post')): ?>        
        <div class="pa-post-meta mb-2"><?php echo e(__('By', 'iasd')); ?> 
            <span><?php echo !empty($custom_author = get_field('custom_author')) ? $custom_author : get_the_author(); ?></span><?php if($region = getPostRegion(get_the_ID())): ?><em class="pa-pipe">|</em><span class="ms-2"><i class="fas fa-map-marker-alt me-2" aria-hidden="true"></i> <?php echo e($region->name); ?></span><?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="pa-post-meta"><?php echo the_date(); ?></div>

    <hr class="my-45">

    <div class="d-flex justify-content-between">
        <div class="pa-share d-none d-xl-block">
            <?php require(get_template_directory() . '/components/parts/share.php') ?>
        </div>

        <div class="">
            <ul class="pa-accessibility list-inline">
                <li class="pa-text-dec list-inline-item"><a href="#" class="rounded p-2" onclick="window.TextSize.pa_diminui_texto(event)">-A</a></li>
                <li class="pa-text-inc list-inline-item"><a href="#" class="rounded p-2" onclick="window.TextSize.pa_aumenta_texto(event)">+A</a></li>

                <?php if(get_post_meta(get_the_ID(), 'amazon_polly_enable', true)): ?>
                    <li class="pa-text-listen list-inline-item">
                        <a href="#" class="rounded p-2" onclick="pa_play(event, this)">
                            <i class="fas fa-volume-up"></i> <?php echo e(__('Hear text', 'iasd')); ?>

                        </a>
                        
                        <audio id="pa-accessibility-player" src="<?php echo e(get_post_meta(get_the_ID(), 'amazon_polly_audio_link_location', true)); ?>" controls></audio>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</header>
<?php /**PATH /Users/eli/Dropbox (ComunicaDSA)/projects/deploy-noticias.adventistas.org/app/pt/wp-content/themes/pa-theme-noticias/template-parts/single/header.blade.php ENDPATH**/ ?>