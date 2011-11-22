<?php

elgg_register_event_handler('init','system','elgg_ggouv_dev_init');

function elgg_ggouv_dev_init() {
	global $CONFIG;

	require_once dirname(__FILE__) . '/vendors/firephp/FirePHP.class.php';
	require_once dirname(__FILE__) . '/vendors/firephp/fb.php';
	class trace {
		private $nom;
		private $tick;
		private $firephp;
		public function __construct($nom) {
				$this->nom = $nom;
				$this->tick = microtime(true);
				$this->firephp = FirePHP::getInstance(true);
		}
		public function trace($libelle = "") {				
				$duree = round(microtime(true) - $this->tick,3);
				$this->tick = microtime(true);				
				$this->firephp->log("[".$this->nom."] ".$libelle." : ".$duree."s");
		}
	}
	//ob_start();
	global $fb;
	$fb = FirePHP::getInstance(true);
	global $trace;
	$trace  = new Trace("Test");
	
}