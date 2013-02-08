<?php
admin_gatekeeper();
include_once(dirname(__FILE__).'/../vendors/Git.php');
ini_set('display_errors',1);
error_reporting(255);

foreach(elgg_get_plugins(false) as $plugin)
{
    $plugin_path =  $plugin->getPath();
    
    if(preg_match('`elgg-`',$plugin_path))
    {
            if(in_array('.git', scandir($plugin->getPath())))
            {
                $repo = Git::open($plugin->getPath());
                $repo->pull('origin', 'master');
            }
    }
}
die();
// forward(REFERER); 