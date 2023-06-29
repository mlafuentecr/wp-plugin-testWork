<?php

// Register the custom post type
function competitions_post_type() {
    $labels = array(
        'name'              => 'competition',
        'singular_name'     => 'competition',
        'menu_name'         => 'Competition',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New competition',
        'edit'               => 'Edit',
        'edit_item'          => 'Edit competition',
        'new_item'           => 'New competition',
        'view'               => 'View',
        'view_item'          => 'View competition',
        'search_items'       => 'Search competition',
        'not_found'          => 'No competition found',
        'not_found_in_trash' => 'No competition found in Trash',
        'parent'             => 'Parent competition'
    );
  
    $args = array(
      'labels'              => $labels,
      'public'              => true,
      'has_archive'         => true,
      'publicly_queryable'  => true,
      'query_var'           => true,
      'rewrite'             => array('slug' => 'competition'),
      'capability_type'     => 'post',
      'hierarchical'        => false,
      'supports'            => array( 'title', 'thumbnail', 'editor'),
      'menu_position'       => 5,
      'menu_icon'           => 'dashicons-awards', // You can choose an icon from the Dashicons library
    );

  
    register_post_type('competition', $args);
  }
  add_action('init', 'competitions_post_type');
  


