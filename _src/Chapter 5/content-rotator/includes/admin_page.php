<?php if ( ! defined('WP_CONTENT_DIR')) exit('No direct script access allowed'); ?>

<div class="wrap">
	<?php screen_icon(); ?>
	<h2>Content Rotator Administration</h2>
	
	<?php print $msg; ?>

	<form action="" method="post" id="content_rotation_admin_options_form">
		<h3><label for="separator">Separator</label></h3>
		<p>This separates units of content. It can be simple like a comma, or complex like &lt;!--SEPARATOR--&gt;<br/>
		<input type="text" id="separator" name="separator" value="<?php print esc_attr( get_option('content_rotation_content_separator') ); ?>" /></p>
		
		<h3><label for="content_block">Content Block</label></h3>
		<p>
			Use the separator above to separate blocks of content, e.g. <code>man, bear, pig</code><br/>
			or <code>&lt;a href="http://mysite.com/"&gt;MySite.com&lt;/a&gt;&lt;--SEPARATOR--&gt;
			&lt;a href="http://yoursite.com/"&gt;YourSite.com&lt;/a&gt;</code><br/>
			<textarea rows="5" cols="50" id="content_block" name="content_block"><?php print get_option('content_rotation_content_block'); ?></textarea>
		</p>
		<p class="submit"><input type="submit" name="submit" value="Update" /></p>
		<?php wp_nonce_field('content_rotation_admin_options_update'); ?>
	</form>	
</div>