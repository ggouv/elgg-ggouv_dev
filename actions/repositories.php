<?php
admin_gatekeeper();

foreach(elgg_get_plugins(false) as $plugin)
{
    $plugin_path =  $plugin->getPath();
    
    if(preg_match('`elgg-`',$plugin_path))
    {
            if(in_array('.git', scandir($plugin->getPath())))
            {
                $answer = shell_exec('cd ".$plugin->getPath()." && pwd');
                var_dump($answer);
            }
    }
}
die();
// forward(REFERER); 