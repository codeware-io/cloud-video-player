<?php 

// add helper functions here
// call from other files like this PLUGIN_NAMESPACE/function_name()

namespace SUP;


// Key settigns option page


function key_settigns_options_page() {
	add_options_page(
		'Key Settigns', // page <title>Title</title>
		'Key Settings', // menu link text
		'manage_options', // capability to access the page
		'key-settigns', // page URL slug
		'key_settigns_page_content', // callback function with content
	);
}

add_action( 'admin_menu', 'key_settigns_options_page');

function key_settigns_page_content(){
	$fkey = get_option('aws_api_key');
    ?>
    <div class="row">
      <div class="col-md-6">
        <h2>AWS Key Settigns</h2>
        <label for="key_val">Key</label>
        <input type="text" class="form-control" id="key_val" value="<?php  echo $key; ?>">
        <button type="submit" class="btn btn-primary mt-2 cb">Save</button>
      </div>
    </div>
  <?php

}

// end option page 