<?php get_header(); ?>

<main>
    <!-- Hero -->
    <section class="relative py-20 md:py-32 lg:py-40 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10 relative">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <?php $rk_kicker = get_theme_mod('rankola_hero_kicker', 'AI-Powered SEO Revolution'); ?>
                    <div class="inline-flex items-center px-4 py-2 rounded-full bg-purple-500/10 border border-purple-500/20 mb-6">
                        <span class="w-4 h-4 text-purple-400 mr-2">✦</span>
                        <span class="text-sm font-medium text-purple-300"><?php echo esc_html($rk_kicker); ?></span>
                    </div>
                    <?php $rk_title = get_theme_mod('rankola_hero_title', 'Effortless SEO, Powered by AI'); ?>
                    <?php $rk_sub = get_theme_mod('rankola_hero_subtitle', "Stop wrestling with complex SEO tasks. Let Rankola's intelligent platform generate fully optimized articles, images, and technical metadata automatically. Dominate Google with a single click."); ?>
                    <h1 class="text-4xl md:text-6xl font-bold tracking-tight text-white leading-tight"><?php echo esc_html($rk_title); ?></h1>
                    <p class="mt-6 text-xl text-slate-400 leading-relaxed"><?php echo wp_kses_post($rk_sub); ?></p>
                    <?php
                    $rk_p_lbl = get_theme_mod('rankola_hero_primary_label', 'Start Your Free Trial');
                    $rk_p_url = get_theme_mod('rankola_hero_primary_link', '#pricing');
                    $rk_s_lbl = get_theme_mod('rankola_hero_secondary_label', 'Watch Demo');
                    $rk_s_url = get_theme_mod('rankola_hero_secondary_link', '#comparison');
                    ?>
                    <div class="mt-8 flex flex-col sm:flex-row items-start gap-4">
                        <a href="<?php echo esc_url($rk_p_url); ?>"
                           class="inline-flex items-center justify-center h-11 px-8 rounded-md bg-gradient-to-r from-purple-500 via-pink-500 to-blue-500 text-white font-semibold text-base hover:opacity-90 transition-all duration-300 transform hover:scale-105"><?php echo esc_html($rk_p_lbl); ?>
                            →</a>
                        <a href="<?php echo esc_url($rk_s_url); ?>"
                           class="inline-flex items-center justify-center h-11 px-8 rounded-md border border-slate-600 bg-transparent text-white hover:bg-slate-800"><?php echo esc_html($rk_s_lbl); ?></a>
                    </div>
                    <div class="mt-8 flex items-center space-x-6 text-sm text-slate-500">
                        <span>✓ No credit card required</span>
                        <span>✓ 7-day money-back guarantee</span>
                    </div>
                </div>
                <div class="relative">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-tr from-purple-500/20 to-blue-500/20 rounded-2xl blur-2xl"></div>
                        <?php $rk_img = get_theme_mod('rankola_hero_image', get_template_directory_uri() . '/images/hero.png'); ?>
                        <img src="<?php echo esc_url($rk_img); ?>" alt="SEO Dashboard Analytics"
                             class="relative rounded-2xl shadow-2xl border border-slate-800"/>
                        <div class="absolute -bottom-6 -left-6 bg-gradient-to-br from-slate-900 to-slate-800 p-4 rounded-xl border border-slate-700 shadow-xl">
                            <div class="text-2xl font-bold text-white">80%</div>
                            <div class="text-sm text-slate-400">SEO Tasks Automated</div>
                        </div>
                        <div class="absolute -top-6 -right-6 bg-gradient-to-br from-purple-600 to-blue-600 p-4 rounded-xl shadow-xl">
                            <div class="text-2xl font-bold text-white">10x</div>
                            <div class="text-sm text-purple-100">Faster Content</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="py-20 sm:py-32 bg-slate-950/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl md:text-5xl font-bold text-white tracking-tight">Everything You Need for <span
                            class="bg-clip-text text-transparent bg-gradient-to-r from-purple-400 to-blue-400">Automated SEO Success</span>
                </h2>
                <p class="mt-4 text-lg text-slate-400">Powerful AI-driven features that work together to dominate search
                    rankings</p>
            </div>
            <?php
            // Get the features setting from the Customize Manager
            $features = get_theme_mod('rankola_features_json');
            $features = json_decode($features, true);

            // Use the features data in your front-page.php template
            if (!empty($features)) : ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php foreach ($features as $feature) : ?>
                        <div class="group relative bg-slate-900/50 rounded-2xl border border-slate-800 overflow-hidden hover:border-purple-500/50 transition-all duration-500 hover:transform hover:scale-105">
                            <div class="aspect-video relative overflow-hidden">
                                <img src="<?php echo esc_url($feature['image']); ?>"
                                     alt="<?php echo esc_attr($feature['title']); ?>"
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"/>
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/50 to-transparent"></div>
                                <!--                            <div class="absolute bottom-4 left-4 w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500/20 to-blue-500/20 backdrop-blur-sm border border-white/10 flex items-center justify-center">-->
                                <!--                                <span class="w-6 h-6 text-purple-300">?</span>-->
                                <!--                            </div>-->
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-white mb-3"><?php echo esc_html($feature['title']); ?></h3>
                                <p class="text-slate-400 leading-relaxed"><?php echo esc_html($feature['desc']); ?></p>
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-br from-purple-600/5 to-blue-600/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Problem -->
    <section class="py-20 sm:py-28 bg-slate-950/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-white tracking-tight">Tired of the SEO Grind?</h2>
                <p class="mt-4 text-lg text-slate-400">For millions of website owners, SEO is a constant battle. It's
                    time-consuming, highly technical, and often delivers inconsistent results. You're either spending a
                    fortune on experts or struggling to keep up with endless algorithm changes.</p>
            </div>
            <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php
                $problems = get_theme_mod('rankola_problems_json');
                $problems = json_decode($problems, true);

                if (!empty($problems)) :
                    foreach ($problems as $p) :
                        ?>
                        <div class="bg-slate-900 border border-slate-800 rounded-2xl h-full p-6 text-center">
                            <div class="inline-block p-3 bg-gradient-to-br from-purple-500/20 to-blue-500/20 rounded-full mb-4 text-2xl">
                                <?php echo isset($p['icon']) ? esc_html($p['icon']) : '⚠️'; ?>
                            </div>
                            <p class="text-base font-medium text-slate-300">
                                <?php echo esc_html($p['text']); ?>
                            </p>
                        </div>
                    <?php endforeach; endif; ?>
            </div>
        </div>
        <p class="mt-8 text-center text-slate-500">Existing plugins like Yoast or Rank Math provide static suggestions,
            but they don't do the work for you.</p>
        </div>
    </section>

    <!-- Solution -->
    <section class="py-20 sm:py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-white tracking-tight">Meet Rankola: Your AI SEO Team</h2>
                <p class="mt-4 text-lg text-slate-400">Stop guessing. Start automating. Rankola turns your ideas into
                    ranking-ready content and technical SEO—instantly.</p>
            </div>
            <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php
                // Get the features setting from the Customize Manager
                $solutions = get_theme_mod('rankola_solutions_json');
                $solutions = json_decode($solutions, true);

                // Use the features data in your front-page.php template
                if (!empty($solutions)) : ?>
                <?php foreach ($solutions as $s) : ?>
                    <div class="p-6 rounded-2xl border border-slate-800 bg-slate-900/50">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500/20 to-blue-500/20 flex items-center justify-center mb-4">
                            ✨
                        </div>
                        <h3 class="text-xl font-semibold text-white"><?php echo esc_html($s['title']); ?></h3>
                        <p class="mt-2 text-slate-400"><?php echo esc_html($s['desc']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

        </div>
    </section>

    <!-- Target Audience -->
    <section id="audience" class="py-20 sm:py-28 bg-slate-950/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-white tracking-tight">The Perfect SEO Tool for Every
                    WordPress User</h2>
            </div>
            <div class="mt-16 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php
                $aud = get_theme_mod('rankola_audience_json');
                $aud = json_decode($aud, true);

                if (!empty($aud)) :
                    foreach ($aud as $a) :
                        ?>
                        <div class="flex flex-col items-center text-center">
                            <div class="flex items-center justify-center w-16 h-16 rounded-full bg-slate-800 mb-5 text-2xl">
                                <?php echo isset($a['icon']) ? esc_html($a['icon']) : '🔹'; ?>
                            </div>
                            <h3 class="text-xl font-semibold text-white">
                                <?php echo esc_html($a['title']); ?>
                            </h3>
                            <p class="mt-2 text-slate-400 text-sm">
                                <?php echo esc_html($a['desc']); ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                <?php endif ?>

            </div>
    </section>

    <!-- Comparison (simplified) -->
    <section id="comparison" class="py-20 sm:py-28 bg-slate-950/50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-white tracking-tight">More Than a Plugin. A True
                    Automation Partner.</h2>
                <p class="mt-4 text-lg text-slate-400">While other tools stop at suggestions, Rankola takes action. We
                    are fundamentally different from traditional SEO plugins.</p>
            </div>
            <div class="mt-12 overflow-hidden border border-slate-800 rounded-lg">
                <table class="w-full divide-y divide-slate-800">
                    <thead class="bg-slate-900">
                    <tr>
                        <th class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-white sm:pl-6">Feature</th>
                        <th class="px-3 py-3.5 text-center text-sm font-semibold text-white">Yoast / Rank Math</th>
                        <th class="px-3 py-3.5 text-center text-sm font-semibold text-white bg-purple-500/10">Rankola
                        </th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800 bg-slate-900/50">
                    <?php $rows = [
                        ['AI Content Generation', false],
                        ['Full Automation', false],
                        ['Auto Schema Generation', 'Limited'],
                        ['Custom Tone Control', false],
                        ['AI-Powered Readability Editing', false],
                        ['Integrated AI Image Generation', false],
                    ];
                    foreach ($rows as $r): ?>
                        <tr>
                            <td class="w-full max-w-0 py-4 pl-4 pr-3 text-sm font-medium text-white sm:w-auto sm:max-w-none sm:pl-6"><?php echo esc_html($r[0]); ?></td>
                            <td class="px-3 py-4 text-sm text-slate-400 text-center"><?php echo $r[1] === 'Limited' ? '<span class="text-yellow-400">Limited</span>' : ($r[1] ? '✔︎' : '✖︎'); ?></td>
                            <td class="px-3 py-4 text-sm text-slate-400 text-center bg-purple-500/10">✔︎</td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-20 sm:py-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative overflow-hidden bg-gradient-to-br from-purple-600 via-blue-600 to-cyan-600 rounded-3xl p-8 md:p-16">
                <div class="absolute inset-0 bg-black/20"></div>
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-32 translate-x-32"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full translate-y-24 -translate-x-24"></div>
                <div class="relative grid lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <div class="inline-flex items-center px-4 py-2 bg-white/10 rounded-full mb-6">
                            <span class="w-4 h-4 text-white mr-2">👥</span>
                            <span class="text-sm font-medium text-white">Join 10,000+ Users</span>
                        </div>
                        <h2 class="text-3xl md:text-5xl font-bold text-white tracking-tight leading-tight">Ready to
                            Revolutionize Your SEO?</h2>
                        <p class="mt-6 text-xl text-blue-100 leading-relaxed">Join thousands of smart marketers,
                            agencies, and business owners who are automating their growth. Let AI handle your SEO while
                            you focus on what matters most.</p>
                        <div class="mt-8 flex flex-col sm:flex-row gap-4 px-4">
                            <a href="#pricing"
                               class="h-12 px-6 whitespace-nowrap inline-flex items-center justify-center
            rounded-lg border border-slate-300 bg-white text-slate-800
            font-medium text-base hover:bg-slate-50 transition-all duration-300">
                                Start Free Trial
                            </a>
                        </div>


                        <div class="mt-8 flex items-center space-x-8 text-blue-100">
                            <div class="flex items-center"><span class="w-5 h-5 mr-2">📈</span><span class="text-sm">10x Faster Results</span>
                            </div>
                            <div class="flex items-center"><span class="text-sm">✓ No Credit Card Required</span></div>
                        </div>
                    </div>
                    <div class="relative">
                        <div class="relative">
                            <img src="<?php echo get_template_directory_uri() . '/images/hero.png' ?>"
                                 alt="SEO Success Dashboard" class="rounded-2xl shadow-2xl border border-white/10"/>
                            <div class="absolute inset-0 bg-gradient-to-tr from-purple-600/20 to-cyan-600/20 rounded-2xl"></div>
                            <div class="absolute -top-4 -right-4 bg-white/90 backdrop-blur-sm p-4 rounded-xl shadow-xl">
                                <div class="text-2xl font-bold text-gray-800">+150%</div>
                                <div class="text-sm text-gray-600">Traffic Increase</div>
                            </div>
                            <div class="absolute -bottom-4 -left-4 bg-gradient-to-r from-green-500 to-emerald-500 p-4 rounded-xl shadow-xl">
                                <div class="text-2xl font-bold text-white">#1</div>
                                <div class="text-sm text-green-100">Google Ranking</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing (simplified) -->
    <section id="pricing" class="py-20 sm:py-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl md:text-5xl font-bold text-white tracking-tight">Choose the Plan That's <span
                            class="bg-clip-text text-transparent bg-gradient-to-r from-purple-400 to-blue-400">Right for You</span>
                </h2>
                <p class="mt-4 text-lg text-slate-400">Start for free and upgrade as you grow. Get 2 months free with
                    annual plans!</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php
                $plans = get_theme_mod('rankola_pricing_json');
                $plans = json_decode($plans, true);
                foreach ($plans as $i => $plan) : $popular = !empty($plan['popular']); ?>
                    <div class="relative flex flex-col p-8 rounded-2xl border backdrop-blur-sm <?php echo $popular ? 'border-purple-500 bg-slate-900/80 shadow-2xl shadow-purple-500/20' : 'border-slate-800 bg-slate-900/50 hover:bg-slate-900/80'; ?> transition-all duration-300 hover:transform hover:scale-105">
                        <?php if ($popular): ?>
                            <div class="absolute -top-4 left-1/2 -translate-x-1/2 px-4 py-2 text-sm text-white bg-gradient-to-r from-purple-500 to-blue-500 rounded-full font-semibold shadow-lg">
                                Most Popular
                            </div><?php endif; ?>
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-2xl font-bold text-white"><?php echo esc_html(isset($plan['name']) ? $plan['name'] : ''); ?></h3>
                            <!--                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500 to-blue-500"></div>-->
                        </div>
                        <div class="mb-6">
                            <div class="flex items-baseline">
                                <span class="text-4xl font-bold text-white"><?php echo esc_html(isset($plan['price']) ? $plan['price'] : ''); ?></span>
                                <?php if ((isset($plan['name']) ? $plan['name'] : '') !== 'Agency'): ?><span
                                        class="text-slate-400 ml-2">/month</span><?php endif; ?>
                            </div>
                        </div>
                        <?php if (!empty($plan['features']) && is_array($plan['features'])): ?>
                            <ul class="space-y-3 text-sm text-slate-300 flex-grow mb-8">
                                <?php foreach ($plan['features'] as $feat): ?>
                                    <li class="flex items-start"><span class="w-4 h-4 text-green-400 mr-3 mt-1">✔</span><span><?php echo esc_html($feat); ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        <?php $cta = isset($plan['cta']) ? $plan['cta'] : 'Select'; ?>
                        <a href="#"
                           class="w-full inline-flex items-center justify-center font-semibold text-base py-3 transition-all duration-300 <?php echo $popular ? 'bg-gradient-to-r from-purple-500 to-blue-500 text-white hover:opacity-90 transform hover:scale-105' : 'bg-slate-800 text-white hover:bg-slate-700 border border-slate-700'; ?>"><?php echo esc_html($cta); ?></a>
                    </div>
                <?php endforeach;
                ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>


