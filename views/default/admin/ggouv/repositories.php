<?php 
echo elgg_view('output/url', array(
    'text' => elgg_echo('Mettre à jour tous les dépots'),
    'href' => 'action/ggouv/repositories',
    'is_action' => true,
    'class' => 'elgg-button elgg-button-submit'
));     
?>
