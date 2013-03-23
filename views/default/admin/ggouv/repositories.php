<?php 
echo elgg_view('output/url', array(
    'text' => elgg_echo('admin:ggouv:repositories:update'),
    'href' => 'action/ggouv/repositories',
    'is_action' => true,
    'class' => 'elgg-button elgg-button-submit'
));     
?>
