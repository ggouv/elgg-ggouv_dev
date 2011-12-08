<?php 

// restrict to admins
admin_gatekeeper();

if (!elgg_get_plugin_setting('firebug_to_apply', 'elgg_ggouv_dev')) {
	elgg_set_plugin_setting('firebug_to_apply', '', 'elgg_ggouv_dev');
}

if (!elgg_get_plugin_setting('code_to_apply', 'elgg_ggouv_dev')) {
	elgg_set_plugin_setting('code_to_apply', '', 'elgg_ggouv_dev');
}

if (!elgg_get_plugin_setting('comment_translation_key', 'elgg_ggouv_dev')) {
	elgg_set_plugin_setting('comment_translation_key', 0, 'elgg_ggouv_dev');
}

$firebug = elgg_get_plugin_setting('firebug_to_apply', 'elgg_ggouv_dev');
$code = elgg_get_plugin_setting('code_to_apply', 'elgg_ggouv_dev');

$set = str_replace("&gt;", ">", $firebug);
eval("\$fire = $set;");
global $fb; $fb->info($fire, 'result ');

$set = str_replace("&gt;", ">", $code);
eval("$set;");

?>

<div>
	<label><?php echo elgg_echo('firebug'); ?></label><br />
	<?php echo elgg_view('input/text', array('name' => 'params[firebug_to_apply]', 'value' => $firebug)); ?>
</div>

<div>
	<label><?php echo elgg_echo('Code php à appliquer'); ?></label><br />
	<?php echo elgg_view('input/plaintext', array('name' => 'params[code_to_apply]', 'value' => $code)); ?>
</div>

<div>
	<?php 
	$data = array('name' => 'params[comment_translation_key]', 'value' => 1, 'checked' => elgg_get_plugin_setting('comment_translation_key', 'elgg_ggouv_dev') == 1);
	echo elgg_view('input/checkbox', $data); ?>
	<label><?php echo elgg_echo('Add translation key in html comment'); ?></label>
</div>
