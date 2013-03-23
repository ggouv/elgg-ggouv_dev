<h4>Mettre à jour les dépôts Ggouv</h4>
<p>Ouvrez votre terminal favori et copier cette ligne de commande :</p>
<pre><?php 

	foreach(elgg_get_plugins(false) as $plugin)
	{
	    $plugin_path =  $plugin->getPath();
	    
	    if(preg_match('`elgg-`',$plugin_path))
	    {
	            if(in_array('.git', scandir($plugin->getPath())))
	            {
	            	$commands[] = ' cd '.$plugin->getPath().' && git pull ';
	            }
	    }
	}

	echo implode ($commands, ' && ');
?></pre>