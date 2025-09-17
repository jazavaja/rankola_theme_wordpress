<?php
// Fallback if no specific template matches
get_header(); ?>
<main class="max-w-3xl mx-auto px-4 py-20">
  <h1 class="text-3xl font-bold text-white">Blog</h1>
  <?php if (have_posts()): while (have_posts()): the_post(); ?>
    <article class="mt-8 border-b border-slate-800 pb-8">
      <h2 class="text-xl font-semibold text-white"><a href="<?php the_permalink(); ?>" class="hover:underline"><?php the_title(); ?></a></h2>
      <div class="text-slate-400 mt-2"><?php the_excerpt(); ?></div>
    </article>
  <?php endwhile; else: ?>
    <p class="text-slate-400 mt-8">No posts found.</p>
  <?php endif; ?>
</main>
<?php get_footer(); ?>


