<?php
	/**
	 * @author			straightvisions GmbH
	 * @package			sv_gravity_forms_enhancer
	 * @copyright		2017 straightvisions GmbH
	 * @link			https://straightvisions.com/
	 * @since			1.0
	 * @license			See license.txt or https://straightvisions.com/
	 */

	namespace sv_gravity_forms_enhancer;

	class modules extends init{
		public function __construct(){

		}
		/**
		 * @desc			initialize module
		 * @return	void
		 * @author			straightvisions GmbH
		 * @since			1.0
		 */
		protected function init(){
			add_filter('gform_enable_field_label_visibility_settings', '__return_true');

			$this->settings_multi_instances->init();
			$this->user_update->init();
			$this->post_update->init();

			$this->settings_fields_address->init();
			$this->settings_scripts_handling->init();
			$this->settings_user_form->init();
			$this->settings_disable_entries->init();
			$this->settings_slugs->init();

		}
	}