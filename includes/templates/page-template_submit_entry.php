<?php
    /*
    Template Name: page-template_submit_entry
    */


    get_header(  );


 
    add_action("wp_ajax_ibvote", "ibvote");
    add_action("wp_ajax_nopriv_ibvote", "ibvote");
    
    function ibvote(){
        echo "DONE";
        wp_die();
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

       <form id="myForm" class='m-auto col-6'>

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
    <div id="responseMessage"></div>    

<script>


var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
console.log(ajaxurl);
console.log(PHPVARS.ajaxurl, ' PHPVARS.ajaxurl');

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('myForm');
    const responseMessage = document.getElementById('responseMessage');

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        console.log(responseMessage, 'responseMessage')
        const first_name = form.querySelector('input[name="first_name"]').value;
        const last_name = form.querySelector('input[name="last_name"]').value;
        const email = form.querySelector('input[name="email"]').value;
        const Phone = form.querySelector('input[name="Phone"]').value;
        
        const formData = new FormData(form);
        formData.append('action', 'ibvote');
        formData.append('first_name', first_name);
        formData.append('last_name', last_name);
        formData.append('email', email);
        formData.append('Phone', Phone);
        console.log(formData, ' formData')

        fetch(ajaxurl, {
            method: 'POST',
            body: formData,
            data: {
        'action' : 'ibvote'
    },
        })
        .then(function(response) {
            if (response.ok) {
              console.log(response, '1xxxx');
              responseMessage.innerHTML = 'Title already exists. Please choose a different title.';
              form.reset();
                return response.text();
            } else {
              console.log(response, 'Exxxx');
              responseMessage.innerHTML = 'Error already exists.';
                throw new Error('Error: ' + response.status);
            }
        })
        .catch(function(error) {
          console.log(error.message, 'Exxxx');
            responseMessage.innerHTML = error.message;
        });
    });
});
</script>



        <?php
    
        get_footer( );
     
     