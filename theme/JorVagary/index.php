<?php
/*
 Template Name: JOR Vagary Accueil
 */

 get_header(); ?>

<?php

  if ( have_posts() ) : while ( have_posts() ) : the_post();
    get_template_part( 'content-home', get_post_format() );

  endwhile; endif;
?>

<hr>

<div class="fil-dactu">

<h2>Les derniers mouvements de plumes</h2>
           
  <?php
    $cats = get_categories();
    foreach ($cats as $cat) {
      query_posts('showposts=2&cat='.$cat->cat_ID);
  ?>

  <div class="row" style="margin:10px 0 10px 0;">
    <h4 style="border-bottom:1px solid black;padding-right: 50px;padding-bottom:8px;"><?php echo $cat->cat_name; ?></h4>
            
    <?php while (have_posts()) : the_post(); ?>

    <a href="<?php the_permalink() ?>" style="margin: 20px;">

      <div class="" style="margin:0 1em 0 0;float:left;">
        <?php the_post_thumbnail('thumbnail'); ?>
      </div>

      <div class="" style="max-width:100%;">

        <div style="font-weight:bold;">
          <?php the_title(); ?>
        </div>

        <div>
          <?php the_excerpt(); ?>
        </div>
      </div>
    </a>
  
    <?php endwhile;  ?>
    
  </div>
<?php } ?>
</div>

<?php get_footer(); ?>