<?php

define( 'pg_template_entry',      'page-template_submit_entry.php' );


add_filter( 'template_include', 'portfolio_page_template', 99 );
function portfolio_page_template( $templateEntry ) {
    if( strpos( $_SERVER["REQUEST_URI"], "/submit-entry" ) !== false ){ 
        $templateEntry =  MY_PLUGIN_PATH . pg_template_entry;
        return $templateEntry;
    }
 
}