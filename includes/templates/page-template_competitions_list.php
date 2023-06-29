<?php
    /*
    Template Name: page-template_competitions_list
    */
  
        get_header(); // Include the header template
        $args = array(
         'post_type'   => 'competition',
         'post_status' => 'publish',
          'posts_per_page' => -1,        // Retrieve all posts
        );
        $competitions = new WP_Query($args);
     
        if ($competitions->have_posts()) :
             echo ' <div class="main mt-5 mx-4">';
            while ($competitions->have_posts()) :
                $competitions->the_post();
                $post_id = get_the_ID(); // Get the current post ID
                $slug = get_post_field('post_name', $post_id);
        ?>
       
                <article class='mx-3'>
                    <h2 class='mx-3 my-4'><?php the_title(); ?></h2>
                     <div class="d-flex mx-3">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="thumbnail">
                            <?php the_post_thumbnail('thumbnail'); ?>
                        </div>
                    <?php endif; ?>
        
                    <div class="content ms-2">
                        <?php the_content(); ?>
                    </div>
                    </div>
                    <?php 
                
             
                 ?>
                    <a href="<?php echo site_url() . '/competition-' . $slug.'/submit-entry'; ?>" class="btn"> Submit Entry </a>
                </article>
        
      
        <?php
            endwhile;
            wp_reset_postdata();
            echo '</div>';
        else :
            echo 'No competitions found.';
        endif;
        get_footer( );
     
     