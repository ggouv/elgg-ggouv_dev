<?php

elgg_register_event_handler('init','system','elgg_ggouv_dev_init');

function elgg_ggouv_dev_init() {
	global $CONFIG;

	//require_once dirname(__FILE__) . '/vendors/firelogger/firelogger.php';
	require_once dirname(__FILE__) . '/vendors/chromephp/ChromePhp.php';
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
	
	$fb->setObjectFilter('stdClass', array('classes',
										'language_paths',
										'translations',
										'site',
										//'views',
										'actions',
										'externals',
										'externals_map',
										'independents',
										'widgets',
										'menus',
										'wordblacklist'));

	global $trace;
	$trace  = new Trace("Test");
	
	$action_path = elgg_get_plugins_path() . 'elgg-ggouv_dev/actions';
	elgg_register_action('elgg-ggouv_dev/apply_code', "$action_path/action_apply_code.php");
    elgg_register_action('ggouv/repositories', "$action_path/repositories.php", 'admin');
         
    elgg_register_admin_menu_item('configure', 'repositories', 'ggouv');
}

/**
 * Given a message shortcode, returns an appropriately translated full-text string
 *
 * @param string $message_key The short message code
 * @param array  $args        An array of arguments to pass through vsprintf().
 * @param string $language    Optionally, the standard language code
 *                            (defaults to site/user default, then English)
 *
 * @return string Either the translated string, the English string,
 * or the original language string.
 */
function HACK_elgg_echo($message_key, $args = array(), $language = "") { //Be carefull ! Delete « HACK_ » and change name or comment elgg_echo function on engine/lib/languages.php line 96
	global $CONFIG;

	static $CURRENT_LANGUAGE;

	// old param order is deprecated
	if (!is_array($args)) {
		elgg_deprecated_notice(
			'As of Elgg 1.8, the 2nd arg to elgg_echo() is an array of string replacements and the 3rd arg is the language.',
			1.8
		);

		$language = $args;
		$args = array();
	}

	if (!$CURRENT_LANGUAGE) {
		$CURRENT_LANGUAGE = get_language();
	}
	if (!$language) {
		$language = $CURRENT_LANGUAGE;
	}

	if (isset($CONFIG->translations[$language][$message_key])) {
		$string = $CONFIG->translations[$language][$message_key];
	} else if (isset($CONFIG->translations["en"][$message_key])) {
		$string = $CONFIG->translations["en"][$message_key];
	} else {
		$string = $message_key;
	}

	// only pass through if we have arguments to allow backward compatibility
	// with manual sprintf() calls.
	if ($args) {
		$string = vsprintf($string, $args);
	}
if (elgg_get_plugin_setting('comment_translation_key')) $translate = "<!-- translation=$message_key -->";
	return $translate . $string;
}
