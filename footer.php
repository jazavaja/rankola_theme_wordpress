<footer class="border-t border-white/10">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
            <!-- Logo -->
            <div class="h-12 w-auto" style="height: 10% !important;width: 70px !important;">
                <?php the_custom_logo(); ?>
            </div>

            <!-- Footer links -->
            <div class="flex flex-wrap justify-center md:justify-start gap-6">
                <?php
                $footer_links = get_theme_mod('rankola_footer_links');
                $footer_links = json_decode($footer_links, true);

                if (!empty($footer_links)) :
                    foreach ($footer_links as $link) : ?>
                        <a href="<?php echo esc_url($link['url']); ?>"
                           class="text-sm text-slate-400 hover:text-white transition-colors whitespace-nowrap">
                            <?php echo esc_html($link['label']); ?>
                        </a>
                    <?php endforeach;
                endif;
                ?>
            </div>
        </div>

        <!-- Bottom row: copyright -->
        <p class="text-center text-sm text-slate-400">
            © <?php echo esc_html(date('Y')); ?> Rankola. All rights reserved.
        </p>
    </div>

    <?php wp_footer(); ?>
</footer>

