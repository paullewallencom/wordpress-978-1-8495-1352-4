<div class="wrap">
	<?php screen_icon(); ?>
	<h2>Content Chunks Administration</h2>
	
	<?php print $msg; ?>

	<form action="" method="post" id="content_chunks_form">
		<h3><label for="shortcode_name">Shortcode Name</label></h3>
		<p>Define the shortcode that will be used to trigger the retrieval of a Chunk, e.g. [get-chunk title="My Title"]<br/>
		<input type="text" id="shortcode_name" name="shortcode_name" value="<?php print $shortcode_name ?>" /></p>
		
		<p class="submit"><input type="submit" name="submit" value="Update" /></p>
		<?php wp_nonce_field('content_chunks_options_update','content_chunks_admin_nonce'); ?>
		
	</form>	
</div>