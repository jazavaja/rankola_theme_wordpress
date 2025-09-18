<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php wp_head(); ?>
    <style>
        .animate-blob{animation:blob 8s infinite}.animation-delay-2000{animation-delay:-2s}.animation-delay-4000{animation-delay:-4s}
        @keyframes blob{0%{transform:translate(0,0) scale(1)}33%{transform:translate(30px,-50px) scale(1.1)}66%{transform:translate(-20px,20px) scale(.9)}100%{transform:translate(0,0) scale(1)}}
    </style>
</head>
<body <?php body_class('bg-slate-950 text-slate-300 font-sans antialiased'); ?>>
<div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
    <div class="absolute top-[10%] left-[10%] w-[500px] h-[500px] bg-purple-500/10 rounded-full filter blur-3xl animate-blob"></div>
    <div class="absolute top-[30%] right-[10%] w-[600px] h-[600px] bg-blue-500/10 rounded-full filter blur-3xl animate-blob animation-delay-2000"></div>
    <div class="absolute bottom-[10%] left-[20%] w-[400px] h-[400px] bg-pink-500/10 rounded-full filter blur-3xl animate-blob animation-delay-4000"></div>
</div>
<div class="relative z-10">
    <header class="sticky top-0 z-50 w-full border-b border-white/10 bg-slate-950/80 backdrop-blur-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <div class="h-12 w-auto" style="height: 10% !important;width: 70px !important;">
                            <?php the_custom_logo(); ?>
                        </div>
                    </div>

                </div>
                <nav class="hidden md:flex items-center space-x-8">
                    <?php
                    $menu_name = 'primary-menu';
                    if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])) {
                        $menu = wp_get_nav_menu_object($locations[$menu_name]);
                        $menu_items = wp_get_nav_menu_items($menu->term_id);

                        $menu_list = '<ul class="flex items-center space-x-8">';
                        foreach ((array) $menu_items as $key => $menu_item) {
                            $title = $menu_item->title;
                            $url = $menu_item->url;
                            $menu_list .= '<li class="inline-block"><a class="text-sm font-medium text-slate-300 hover:text-white transition-colors" href="' . $url . '">'. $title .'</a></li>';
                        }
                        $menu_list .= '</ul>';
                        echo $menu_list;
                    } else {
                        //Display nothing or put your own error message
                    }
                    ?>
                </nav>
                <div class="flex items-center">
                    <a href="#pricing" class="hidden md:inline-flex items-center justify-center px-4 py-2 text-sm font-medium
                    text-white bg-gradient-to-r from-purple-500 to-blue-500 rounded-md hover:opacity-90 transition-opacity">
                        Start Your Free Trial
                    </a>
                </div>
            </div>
        </div>
    </header>