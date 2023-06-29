<?php
//plugin_dir_path( __FILE__ ) .'/includes/
//MY_PLUGIN_PATH . '/includes/
define( 'MY_PLUGIN_PATH', plugins_url().'/Competitions_client');
define( 'pg_template',      '/page-template_competitions_list.php' );
define( 'pg_title',         'competitions list' );
define( 'pg_id',           getId() );



  
// Create the Competition Page
function create_competition_page( ) {

    // Create the page if it doesn't exist
    if ( !checkTitle() ) {
      wp_insert_post(array(
            'post_title' => pg_title,
            'post_content' => '',
            'post_status' => 'publish',
            'post_type' => 'page',
            'page_template' => pg_template
        ));
    }

}
add_action( 'activated_plugin', 'create_competition_page'  );




/* register_basic_page_template parent theme page templates */
function register_basic_page_template( $page_templates ) {
    global $post;
    if (checkTitle()) {
          $page_templates[pg_template] = 'page-template_competitions_list.php';
          return $page_templates;

    }else{  return false; }
  }
  add_filter( 'theme_page_templates', 'register_basic_page_template' );



  /* redirect_page_template parent theme page templates */
  function redirect_page_template ($template) {
        if (checkTitle()) {
            $template =  MY_PLUGIN_PATH . '/templates' . pg_template;
            //wp_die($template);
            return $template;
        }
    }
add_filter ('page_template', 'redirect_page_template');



 /* UTILS*/
function getId(){
    $posts = get_posts( array('post_type' => 'page','post_title' =>  pg_title ,) );
    $id =  $posts[0]->ID;
    return  $id;
}

function checkTitle(){
    $posts = get_posts( array('post_type' => 'page','post_title' =>  pg_title ,) );
    $title =  $posts[0]->post_title;
    return $title === pg_title  ? true : false;
}
 
