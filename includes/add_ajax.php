<?php
/*
 Description: A simplified ajax front end
 */
 // enqueue and localise scripts
 function register_js_files() {
    wp_enqueue_script("my_ajax_script", get_template_directory_uri() . "/dist/js/other.js");
    wp_add_inline_script(
      "my_ajax_script",
      "const PHPVARS = " . json_encode(array(
          "ajaxurl" => admin_url("admin-ajax.php"),
          "another_var" => get_bloginfo("name")
      )),
      "before"
    );
  }
  add_action("wp_enqueue_scripts", "register_js_files");
  

  
    function checkTitleExist( $pg_title ){
        $posts = get_posts( array('post_type' => 'page','post_title' =>  $pg_title, ) );
        $title =  $posts[0]->post_title;
        return $title === $pg_title  ? true : false;
    }
 
    


    function submit_new_entry() {
        $first_name = sanitize_text_field($_POST['first_name']);
        echo "DONE";
        wp_die();

        if (checkTitleExist( $first_name )) {
            $response = array(
                'exists' => true
            );
        } else {
            // Create a new post
            $post_args = array(
                'post_title' => $first_name,
                'post_content' => '',
                'post_status' => 'publish',
                'post_type' => 'competition'
            );
            $post_id = wp_insert_post($post_args);
    
            if ($post_id) {
                $response = array(
                    'exists' => false
                );
            } else {
                $response = array(
                    'error' => 'Failed to create the post.'
                );
            }
        }
    
        wp_send_json($response);
    }
    add_action('wp_ajax_submit_new_post', 'submit_new_post_callback');
    add_action('wp_ajax_submit_new_post', 'submit_new_post_callback');
    