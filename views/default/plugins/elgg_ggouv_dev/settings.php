<?php 

// restrict to admins
admin_gatekeeper();

if (!isset($vars['entity']->firebug_to_apply)) {
	$vars['entity']->firebug_to_apply = '';
}

if (!isset($vars['entity']->code_to_apply)) {
	$vars['entity']->code_to_apply = '';
}

$firebug = $vars['entity']->firebug_to_apply;
$code = $vars['entity']->code_to_apply;
$container_guid = elgg_extract('container_guid', $vars);

$set = str_replace("&gt;", ">", $firebug);
eval("\$fire = $set;");
global $fb; $fb->info($fire, 'result');

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

