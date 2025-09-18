<?php
/**
 * Rankola theme functions
 */

register_nav_menus(
    array(
        'primary-menu' => __( 'Primary Menu' ),
        // you can register more menu locations here
    )
);

add_theme_support('custom-logo', array(
    'height'      => 100,
    'width'       => 400,
    'flex-height' => true,
    'flex-width'  => true,
    'header-text' => array('site-title', 'site-description'),
));

add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
});

add_action('wp_enqueue_scripts', function () {
    // Tailwind via CDN
    wp_enqueue_script('tailwind', 'https://cdn.tailwindcss.com', [], null, false);
    // Google Fonts
    wp_enqueue_style('inter-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap', [], null);
    // Lucide icons
    wp_enqueue_script('lucide-icons', 'https://unpkg.com/lucide@latest', [], null, true);
    // Custom inline CSS
    wp_add_inline_style('inter-font',
        ":root{--font-inter:'Inter',sans-serif;} body{font-family:var(--font-inter);} .font-sans{font-family:var(--font-inter);}"
    );
});

// Customizer: Hero section settings
add_action('customize_register', function (WP_Customize_Manager $wp_customize) {
    // Panel/Section
    $wp_customize->add_section('rankola_hero', [
        'title'       => __('Hero Section', 'rankola'),
        'priority'    => 30,
        'description' => __('Edit homepage hero texts and image', 'rankola'),
    ]);

    // Kicker
    $wp_customize->add_setting('rankola_hero_kicker', [
        'default'           => 'AI-Powered SEO Revolution',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('rankola_hero_kicker', [
        'label'   => __('Kicker (small label)', 'rankola'),
        'section' => 'rankola_hero',
        'type'    => 'text',
    ]);

    // Title
    $wp_customize->add_setting('rankola_hero_title', [
        'default'           => 'Effortless SEO, Powered by AI',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('rankola_hero_title', [
        'label'   => __('Main Title', 'rankola'),
        'section' => 'rankola_hero',
        'type'    => 'text',
    ]);

    // Subtitle
    $wp_customize->add_setting('rankola_hero_subtitle', [
        'default'           => "Stop wrestling with complex SEO tasks. Let Rankola's intelligent platform generate fully optimized articles, images, and technical metadata automatically. Dominate Google with a single click.",
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('rankola_hero_subtitle', [
        'label'   => __('Subtitle', 'rankola'),
        'section' => 'rankola_hero',
        'type'    => 'textarea',
    ]);

    // Primary button label/link
    $wp_customize->add_setting('rankola_hero_primary_label', [
        'default'           => 'Start Your Free Trial',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('rankola_hero_primary_label', [
        'label'   => __('Primary Button Label', 'rankola'),
        'section' => 'rankola_hero',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('rankola_hero_primary_link', [
        'default'           => '#pricing',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('rankola_hero_primary_link', [
        'label'   => __('Primary Button Link', 'rankola'),
        'section' => 'rankola_hero',
        'type'    => 'url',
    ]);

    // Secondary button label/link
    $wp_customize->add_setting('rankola_hero_secondary_label', [
        'default'           => 'Watch Demo',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('rankola_hero_secondary_label', [
        'label'   => __('Secondary Button Label', 'rankola'),
        'section' => 'rankola_hero',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('rankola_hero_secondary_link', [
        'default'           => '#comparison',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('rankola_hero_secondary_link', [
        'label'   => __('Secondary Button Link', 'rankola'),
        'section' => 'rankola_hero',
        'type'    => 'url',
    ]);

    // Hero image
    $wp_customize->add_setting('rankola_hero_image', [
        'default'           => get_template_directory_uri() . '/images/hero.png',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'rankola_hero_image', [
        'label'    => __('Hero Image', 'rankola'),
        'section'  => 'rankola_hero',
        'settings' => 'rankola_hero_image',
    ]));
});

// Helper to output safe attribute
function rankola_attr($text) {
    echo esc_attr($text);
}

// Helper: fetch JSON array from theme_mod with default fallback
function rankola_get_json_mod(string $key, array $default) : array {
    $raw = get_theme_mod($key, wp_json_encode($default));
    if (!is_string($raw) || $raw === '') {
        return $default;
    }
    $decoded = json_decode($raw, true);
    if (json_last_error() !== JSON_ERROR_NONE || !is_array($decoded)) {
        return $default;
    }
    return $decoded;
}

// Sanitize JSON textarea: accept only valid JSON, else keep previous value
function rankola_sanitize_json($value, $setting) {
    if (is_array($value)) {
        return wp_json_encode($value);
    }
    if (!is_string($value)) {
        return $setting->default;
    }
    $decoded = json_decode($value, true);
    if (json_last_error() === JSON_ERROR_NONE) {
        return wp_json_encode($decoded);
    }
    return $setting->default;
}

// Customizer: Other sections via JSON blocks (fast, simple)
add_action('customize_register', function (WP_Customize_Manager $wp_customize) {
    // Features
    $wp_customize->add_section('rankola_features', [
        'title' => __('Features Section', 'rankola'),
        'priority' => 31,
    ]);
    $features_default = [
        [ 'title' => 'AI-Generated Articles', 'image' => get_template_directory_uri() . '/images/ai-generate.png', 'desc' => 'Generate complete, SEO-optimized articles based on your keywords, tone, and user intent.' ],
        [ 'title' => 'Automatic Schema Markup', 'image' => get_template_directory_uri() . '/images/schema.png', 'desc' => 'Automatically inserts the correct structured data (JSON-LD) for your content, including Article, Product, and FAQ schemas.' ],
        [ 'title' => 'Full WooCommerce Support', 'image' => get_template_directory_uri() . '/images/full-ecommerce.png', 'desc' => 'Supercharge your e-commerce store by automatically generating SEO-friendly product descriptions and meta tags.' ],
        [ 'title' => 'Smart Metadata Generation', 'image' => get_template_directory_uri() . '/images/smart-meta.png', 'desc' => 'Our AI analyzes your content and generates compelling metadata designed to maximize your click-through rate (CTR).' ],
        [ 'title' => 'AI Image Generation & SEO', 'image' => get_template_directory_uri() . '/images/image-ai.png', 'desc' => "Automatically create relevant images that match your content's intent and generates optimized alt text for every image." ],
        [ 'title' => 'Multi-Language Engine', 'image' => get_template_directory_uri() . '/images/multi-lang.png', 'desc' => 'Built-in, native support for both English and Persian (Farsi), a unique tool for global and local markets.' ],
    ];
    $wp_customize->add_setting('rankola_features_json', [
        'default' => wp_json_encode($features_default),
        'sanitize_callback' => 'rankola_sanitize_json',
    ]);
    $wp_customize->add_control('rankola_features_json', [
        'label' => __('Features JSON (array of {title, image, desc})', 'rankola'),
        'type' => 'textarea',
        'section' => 'rankola_features',
    ]);

    // Problems
    $wp_customize->add_section('rankola_problems', [
        'title' => __('Problems Section', 'rankola'),
        'priority' => 32,
    ]);
    $problems_default = [
        [
            'text' => 'Manual content creation is slow and expensive.',
            'icon' => '⌛',
        ],
        [
            'text' => 'Technical SEO, like schema markup, is complex and easy to get wrong.',
            'icon' => '⚙️',
        ],
        [
            'text' => "Keeping up with Google\'s E-E-A-T standards requires constant effort.",
            'icon' => '📉',
        ],
    ];

    $wp_customize->add_setting('rankola_problems_json', [
        'default'           => wp_json_encode($problems_default),
        'sanitize_callback' => 'rankola_sanitize_json',
    ]);

    $wp_customize->add_control('rankola_problems_json', [
        'label'   => __('Problems JSON (array of {text, icon})', 'rankola'),
        'type'    => 'textarea',
        'section' => 'rankola_problems',
    ]);


    // Solutions
    $wp_customize->add_section('rankola_solutions', [
        'title' => __('Solutions Section', 'rankola'),
        'priority' => 33,
    ]);
    $solutions_default = [
        ['title' => 'AI that Writes and Optimizes', 'desc' => 'Generate long-form, E-E-A-T-friendly content and technical metadata with one click.'],
        ['title' => 'Automate Your Workflow', 'desc' => 'From keyword to published post with schema, images, and internal links—automatically.'],
        ['title' => 'Built for WordPress', 'desc' => 'Native plugin support, schema, WooCommerce integration, and multi-language content.'],
    ];
    $wp_customize->add_setting('rankola_solutions_json', [
        'default' => wp_json_encode($solutions_default),
        'sanitize_callback' => 'rankola_sanitize_json',
    ]);
    $wp_customize->add_control('rankola_solutions_json', [
        'label' => __('Solutions JSON (array of {title, desc})', 'rankola'),
        'type' => 'textarea',
        'section' => 'rankola_solutions',
    ]);

    // Audience
    $wp_customize->add_section('rankola_audience', [
        'title' => __('Target Audience Section', 'rankola'),
        'priority' => 34,
    ]);
    $audience_default = [
        [
            'title' => 'Digital Marketing Agencies',
            'desc'  => 'Manage dozens of client websites efficiently. Automate content production and technical SEO to deliver faster results.',
            'icon'  => '📈',
        ],
        [
            'title' => 'E-commerce Store Owners',
            'desc'  => 'Bring your products to the first page of Google with automatically generated unique descriptions and technical SEO.',
            'icon'  => '🛒',
        ],
        [
            'title' => 'SEO Freelancers & Content Creators',
            'desc'  => 'Deliver high-quality, optimized content to your clients 10x faster. Free up your time from repetitive tasks.',
            'icon'  => '✍️',
        ],
        [
            'title' => 'Small Business Owners & Bloggers',
            'desc'  => 'Grow your organic traffic without a dedicated marketing team. Consistently publish high-quality content that ranks.',
            'icon'  => '🚀',
        ],
    ];

    $wp_customize->add_setting('rankola_audience_json', [
        'default' => wp_json_encode($audience_default),
        'sanitize_callback' => 'rankola_sanitize_json',
    ]);
    $wp_customize->add_control('rankola_audience_json', [
        'label' => __('Audience JSON (array of {title, desc})', 'rankola'),
        'type' => 'textarea',
        'section' => 'rankola_audience',
    ]);

    // Pricing
    $wp_customize->add_section('rankola_pricing', [
        'title' => __('Pricing Section', 'rankola'),
        'priority' => 35,
    ]);
    $pricing_default = [
        [
            'name' => 'Free', 'price' => '$0', 'popular' => false,
            'cta' => 'Get Started Free',
            'features' => [
                '1 AI Articles / month',
                '3 AI Images / month',
                'Unlimited Suggest title',
                'Basic WordPress Plugin',
                "Experience Rankola power"
            ]
        ],
        [
            'name' => 'Starter', 'price' => '$19', 'popular' => true,
            'cta' => 'Choose Starter',
            'features' => [
                '10 AI Articles / month',
                '30 AI Images / month',
                'Full WordPress Plugin Access',
                'Advanced SEO Features',
                'Email Support',
                'Schema Markup'
            ]
        ],
        [
            'name' => 'Pro', 'price' => '$49', 'popular' => false,
            'cta' => 'Choose Pro',
            'features' => [
                '100 AI Articles / month',
                '300 AI Images / month',
                'Everything in Starter +',
                'Advanced Schema Support',
                'WooCommerce Integration',
                'Priority Support'
            ]
        ],
        [
            'name' => 'Agency', 'price' => 'Contact Us', 'popular' => false,
            'cta' => 'Contact Sales',
            'features' => [
                'Unlimited Articles & Images',
                'Unlimited Team Members',
                'Full API Access',
                'Dedicated Account Manager',
                'White-label Options',
                'Custom Integrations'
            ]
        ],
    ];
    $wp_customize->add_setting('rankola_pricing_json', [
        'default' => wp_json_encode($pricing_default),
        'sanitize_callback' => 'rankola_sanitize_json',
    ]);
    $wp_customize->add_control('rankola_pricing_json', [
        'label' => __('Pricing JSON (array of {name, price, popular, cta, features[]})', 'rankola'),
        'type' => 'textarea',
        'section' => 'rankola_pricing',
    ]);

    // CTA
    $wp_customize->add_section('rankola_cta', [
        'title' => __('CTA Section', 'rankola'),
        'priority' => 36,
    ]);
    $wp_customize->add_setting('rankola_cta_title', [
        'default' => 'Ready to Revolutionize Your SEO?',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('rankola_cta_title', [
        'label' => __('CTA Title', 'rankola'), 'type' => 'text', 'section' => 'rankola_cta'
    ]);
    $wp_customize->add_setting('rankola_cta_subtitle', [
        'default' => 'Join thousands of smart marketers, agencies, and business owners who are automating their growth. Let AI handle your SEO while you focus on what matters most.',
        'sanitize_callback' => 'wp_kses_post',
    ]);
    $wp_customize->add_control('rankola_cta_subtitle', [
        'label' => __('CTA Subtitle', 'rankola'), 'type' => 'textarea', 'section' => 'rankola_cta'
    ]);
    $wp_customize->add_setting('rankola_cta_primary_label', [ 'default' => 'Start Generating Content for Free', 'sanitize_callback' => 'sanitize_text_field' ]);
    $wp_customize->add_control('rankola_cta_primary_label', [ 'label' => __('CTA Primary Label', 'rankola'), 'type' => 'text', 'section' => 'rankola_cta' ]);
    $wp_customize->add_setting('rankola_cta_primary_link', [ 'default' => '#pricing', 'sanitize_callback' => 'esc_url_raw' ]);
    $wp_customize->add_control('rankola_cta_primary_link', [ 'label' => __('CTA Primary Link', 'rankola'), 'type' => 'url', 'section' => 'rankola_cta' ]);
    $wp_customize->add_setting('rankola_cta_secondary_label', [ 'default' => 'Schedule Demo', 'sanitize_callback' => 'sanitize_text_field' ]);
    $wp_customize->add_control('rankola_cta_secondary_label', [ 'label' => __('CTA Secondary Label', 'rankola'), 'type' => 'text', 'section' => 'rankola_cta' ]);
    $wp_customize->add_setting('rankola_cta_secondary_link', [ 'default' => '#comparison', 'sanitize_callback' => 'esc_url_raw' ]);
    $wp_customize->add_control('rankola_cta_secondary_link', [ 'label' => __('CTA Secondary Link', 'rankola'), 'type' => 'url', 'section' => 'rankola_cta' ]);
    $wp_customize->add_setting('rankola_cta_image', [ 'default' => get_template_directory_uri() . '/images/hero.png', 'sanitize_callback' => 'esc_url_raw' ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'rankola_cta_image', [ 'label' => __('CTA Image', 'rankola'), 'section' => 'rankola_cta', 'settings' => 'rankola_cta_image' ]));

    // Comparison
    $wp_customize->add_section('rankola_comparison', [
        'title' => __('Comparison Section', 'rankola'),
        'priority' => 37,
    ]);
    $comparison_default = [
        ['feature' => 'AI Content Generation', 'others' => false],
        ['feature' => 'Full Automation', 'others' => false],
        ['feature' => 'Auto Schema Generation', 'others' => 'Limited'],
        ['feature' => 'Custom Tone Control', 'others' => false],
        ['feature' => 'AI-Powered Readability Editing', 'others' => false],
        ['feature' => 'Integrated AI Image Generation', 'others' => false],
    ];
    $wp_customize->add_setting('rankola_comparison_json', [
        'default' => wp_json_encode($comparison_default),
        'sanitize_callback' => 'rankola_sanitize_json',
    ]);
    $wp_customize->add_control('rankola_comparison_json', [
        'label' => __('Comparison JSON (array of {feature, others})', 'rankola'),
        'type' => 'textarea',
        'section' => 'rankola_comparison',
    ]);
});

function rankola_customize_register_footer(WP_Customize_Manager $wp_customize) {
    $footer_links_default = [
        ["label" => "Features", "url" => "#features"],
        ["label" => "Pricing", "url" => "#pricing"],
    ];

    $wp_customize->add_section('rankola_footer', [
        'title'    => __('Footer Settings', 'rankola'),
        'priority' => 130,
    ]);

    $wp_customize->add_setting('rankola_footer_links', [
        'default'           => wp_json_encode($footer_links_default),
        'sanitize_callback' => 'rankola_sanitize_json',
    ]);

    $wp_customize->add_control('rankola_footer_links', [
        'label'   => __('Footer Links (JSON)', 'rankola'),
        'type'    => 'textarea',
        'section' => 'rankola_footer',
    ]);
}

add_action('customize_register', 'rankola_customize_register_footer');

