<?php
	/*
	Plugin Name: SV Gravity Forms Enhancer
	Plugin URI: https://straightvisions.com/
	Description: Improves Gravity Forms in various ways.
	Version: 1.0.8
	Author: Matthias Reuter
	Author URI: https://straightvisions.com
	Text Domain: sv_gravity_forms_enhancer
	License: GPL3
	License URI: https://www.gnu.org/licenses/gpl-3.0.html
	*/

	namespace sv_gravity_forms_enhancer;

	require_once('lib/core/core.php');

	class init extends \sv_core\core{
		const version							= 1008;
		const version_core_match				= 1005;

		public function __construct(){
			$this->setup(__NAMESPACE__,__FILE__);
			$this->set_section_title('SV Gravity Forms Enhancer');
			$this->set_section_desc('Improves Gravity Forms in various ways');
		}
	}

	$GLOBALS[__NAMESPACE__]			= new init();