<?php

// Register the custom post type
function entries_post_type() {
    $labels = array(
        'name'              => 'Entries',
        'singular_name'     => 'Entry',
        'menu_name'         => 'Entries',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Entries',
        'edit'               => 'Edit',
        'edit_item'          => 'Edit Entries',
        'new_item'           => 'New Entries',
        'view'               => 'View',
        'view_item'          => 'View Entries',
        'search_items'       => 'Search Entriess',
        'not_found'          => 'No Entriess found',
        'not_found_in_trash' => 'No Entriess found in Trash',
        'parent'             => 'Parent Entries'
    );
  
    $args = array(
      'labels'              => $labels,
      'public'              => true,
      'has_archive'         => true,
      'publicly_queryable'  => true,
      'query_var'           => true,
      'rewrite'             => array('slug' => 'Entries'),
      'capability_type'     => 'post',
      'hierarchical'        => false,
      'supports'            => array( 'title', 'thumbnail'),
      'menu_position'       => 5,
      'menu_icon'           => 'dashicons-awards', // You can choose an icon from the Dashicons library
    );

  
    register_post_type('Entries', $args);
  }
  add_action('init', 'entries_post_type');
  


  // Register meta box firstname and then callback will call the rest
  function add_first_name_meta_box() {
    add_meta_box(
        'first_name',       // Unique ID
        'Entry',       // Meta box title
        'render_meta', // Callback function to render the meta box content
        'entries',               // Custom post type name
        'normal',                // Context (normal, side, advanced)
        'default',                  // Priority (high, core, default, low)
    );
    
}
add_action('add_meta_boxes', 'add_first_name_meta_box');





//////////////////////////
/////  Last NAME
/////////////////////////
// Render meta box content
function render_meta($arg) {
    global $post; // Get the current post data
    $first_name     = get_post_meta($post->ID, 'first_name', true);
    $last_name      = get_post_meta($post->ID, 'last_name', true);
    $email          = get_post_meta($post->ID, 'email', true);
    $Phone          = get_post_meta($post->ID, 'Phone', true);
    $description    = get_post_meta($post->ID, 'description', true);
    $competition_id = get_post_meta($post->ID, 'competition_id', true);
    ?>

    
<label for="first_name"><?php echo esc_html('first_name','text-domain'); ?></label></br>
<input type="text" name="first_name" id="first_name" value="<?php echo esc_attr($first_name); ?>" /> </br></br>


<label for="last_name"><?php echo esc_html('last_name','text-domain'); ?></label></br>
<input type="text" name="last_name" id="last_name" value="<?php echo esc_attr($last_name); ?>" /></br></br>

<label for="email"><?php echo esc_html('email','text-domain'); ?></label></br>
<input type="email" name="email" id="email" value="<?php echo esc_attr($email); ?>" /></br></br>


<label for="Phone"><?php echo esc_html('Phone','text-domain'); ?></label></br>
<input type="number" name="Phone" id="Phone" value="<?php echo esc_attr($Phone); ?>" /></br></br>

<label for="description"><?php echo esc_html('description','text-domain'); ?></label></br>
<textarea id="description" name="description" rows="4" cols="50"  value="<?php echo esc_attr($description); ?>"><?php echo esc_attr($description); ?></textarea></br></br>

<label for="competition_id"><?php echo esc_html('competition_id','text-domain'); ?></label></br>
<input type="text" name="competition_id" id="competition_id" value="<?php echo esc_attr($competition_id); ?>" /></br></br>


    <?php
}





// Save meta box data
function save_data($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    //first_name
    if (!isset($_POST['first_name'])) { return; }
    $meta_value = sanitize_text_field($_POST['first_name']);
    update_post_meta($post_id, 'first_name', $meta_value);

    //last_name
    if (!isset($_POST['last_name'])) { return; }
    $meta_value = sanitize_text_field($_POST['last_name']);
    update_post_meta($post_id, 'last_name', $meta_value);

    //email
    if (!isset($_POST['email'])) { return; }
    $meta_value = sanitize_text_field($_POST['email']);
    update_post_meta($post_id, 'email', $meta_value);

    //Phone
    if (!isset($_POST['Phone'])) { return; }
    $meta_value = sanitize_text_field($_POST['Phone']);
    update_post_meta($post_id, 'Phone', $meta_value);


    //description
    if (!isset($_POST['description'])) { return; }
    $meta_value = sanitize_text_field($_POST['description']);
    update_post_meta($post_id, 'description', $meta_value);



    //competition_id
    if (!isset($_POST['competition_id'])) { return; }
    $meta_value = sanitize_text_field($_POST['competition_id']);
    update_post_meta($post_id, 'competition_id', $meta_value);


}
add_action('save_post', 'save_data');


