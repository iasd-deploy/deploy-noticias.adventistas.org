<div class="d-flex justify-content-between">
    <?php require(get_template_directory() . '/components/parts/share.php') ?>

    <div class="pa-accessibility">
        <ul class="list-inline">
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
<?php /**PATH /home/isaltino/git/deplay-noticias.adventistas.org/app/public/pt/wp-content/themes/pa-theme-noticias/components/metas/share.blade.php ENDPATH**/ ?>