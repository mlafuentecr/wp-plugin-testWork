<?php
    /*
    Template Name: page-template_submit_entry
    */

   

    get_header(  );


    


// Process the form data
function process_form_data() {
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);

    // Generate a random ID
    $random_id = uniqid();

    // Perform additional operations with the form data (e.g., save to database)

    // Return a response
    $response = array(
        'status' => 'success',
        'message' => 'Form submitted successfully',
        'random_id' => $random_id,
    );
    wp_send_json($response);
}
add_action('wp_ajax_process_form', 'process_form_data');
add_action('wp_ajax_nopriv_process_form', 'process_form_data');

function get_data() {
    echo  "test";
    wp_die();  //die();
}

add_action( 'wp_ajax_nopriv_get_data', 'get_data' );
add_action( 'wp_ajax_get_data', 'get_data' );


function check_post_type_by_title($post_title, $post_type) {
    $args = array(
        'post_status' => 'publish',
        'post_type' => 'page',
        'posts_per_page' => 1,
        'title' => $post_title,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        // Post with the specific title exists
        wp_die('true');
        return true;
    } else {
        wp_die('false');
        return false;
    }
}






// Update post type fields
function new_post_type($post_id, $first_name, $last_name, $email, $phone, $description) {
    // Update post type fields using the given data

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


        ?>

       <form id="my-form" class='m-auto col-6'>

            <div class='row my-3'>
                <label for="first-name" class='col-4'>First Name:</label>
                <input class='col-6' type="text" name="first_name" id="first_name" required>
            </div>
            <div class='row my-3'>
                <label class='col-4'  for="last-name">Last Name:</label>
                <input  class='col-6' type="text" name="last_name" id="last_name" required>
            </div>
            <div class='row my-3'>
                <label class='col-4'  for="email">Email:</label>
                <input  class='col-6' type="email" name="email" id="email" required>
            </div>
            <div class='row my-3'>
                <label class='col-4'  for="Phone">Phone:</label>
                <input  class='col-6' type="tel" name="Phone" id="Phone" required>
            </div>
            <div class='row my-3'>
                <input  class='col-3 ms-auto ' type="submit" value="Submit">
                <div  class='col-2' ></div>
            </div>

    </form>
        

<script>



document.addEventListener('DOMContentLoaded', function() {
  var myForm = document.getElementById('my-form');
  console.log('url ',ajax_object.ajax_url);  // Outputs the AJAX URL
  // Form submission using AJAX
  myForm.addEventListener('submit', function(event) {
    event.preventDefault();

    // Collect form data
    var formData = new FormData(myForm);

   // Create payload object
  var payload = {
    first_name: first_name,
    last_name: last_name,
    action: 'process_form'
  };


    console.log('xxxxxxxxx',formData)
    // Construct the request payload
    formData.append('action', 'process_form');




        // Send the AJAX request
        //  fetch(ajax_object.ajax_url, {
        // fetch('<?php //echo esc_url(admin_url('admin-ajax.php')); ?>', {

  // Send the AJAX request
  fetch(ajax_object.ajax_url, {
    method: 'POST',
    body: JSON.stringify(payload),
    headers: {
      'Content-Type': 'application/json'
    }
  })
    .then(function(response) {
      return response.json();
    })
    .then(function(response) {
      if (response.status === 'success') {
        // Display success message
        console.log('Form submitted successfully');
      } else {
        // Display error message
        console.log('Error submitting form');
      }
    })
    .catch(function(error) {
      console.log(error);
    });

  });

  // Update post type fields using AJAX
function updatePostTypeFields(postID, formData) {
    fetch('<?php echo esc_url(admin_url('admin-ajax.php')); ?>', {
    method: 'POST',
    body: JSON.stringify({
      action: 'update_post_type_fields',
      post_id: postID,
      form_data: formData
    }),
    headers: {
      'Content-Type': 'application/json'
    }
  })
    .then(function(response) {
        console.log( response.json() );
      return response.json();
    })
    .then(function(response) {
      if (response.status === 'success') {
        console.log('Post type fields updated successfully');
      } else {
        console.log('Error updating post type fields');
      }
    })
    .catch(function(error) {
      console.log(error);
    });
}


});


</script>



        <?php
    
        get_footer( );
     
     