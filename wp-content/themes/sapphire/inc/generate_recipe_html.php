<?php

function generate_recipe_html($id) {
  $recipe_post = new WP_Query(array(
    'post_type' => 'recipe',
    'p' => $id
  ));

  while($recipe_post->have_posts()) {
    $recipe_post->the_post();
    ob_start(); ?>
    <div class="professor-callout">
      <div class="professor-callout__photo" style="background-image: url(<?php the_post_thumbnail_url('professorPortrait') ?>)"></div>
      <div class="professor-callout__text">
        <h5><?php the_title(); ?></h5>
        <p><?php echo wp_trim_words(get_the_content(), 30); ?></p>


        <p><strong><a href="<?php the_permalink() ?>">Learn more about <?php the_title() ?> &raquo;</a></strong></p>

      </div>
    </div>
    <?php
    wp_reset_postdata();
    return ob_get_clean();
  }
}