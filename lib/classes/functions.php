<?php

namespace CVP;
// add helper functions here
// call from other files like this PLUGIN_NAMESPACE/function_name()

// Key settigns option page

function cvp_key_settings_options_page() {
	add_options_page(
		'Key Settings', // page <title>Title</title>
		'Key Settings', // menu link text
		'manage_options', // capability to access the page
		'key-settings', // page URL slug
		'cvp_key_settings_page_content', // callback function with content
	);
}

add_action( 'admin_menu', 'cvp_key_settings_options_page');

function cvp_key_settings_page_content(){
	$fkey = get_option('aws_api_key');
    ?>
    <div class="row">
      <div class="col-md-6">
        <h2>AWS Key Settings</h2>
        <label for="key_val">Key</label>
        <input type="text" class="form-control" id="key_val" value="<?php  echo $key; ?>">
        <button type="submit" class="btn btn-primary mt-2 cb">Save</button>
      </div>
    </div>
  <?php

}

// end option page 

