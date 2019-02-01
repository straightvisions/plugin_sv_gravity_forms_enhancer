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

	class settings_fields_address extends modules{
		public function __construct(){
			$this->set_section_title('Address Fields');
			$this->set_section_desc('Adjust field behavior here');
			$this->set_section_type('settings');
		}

		/**
		 * @desc            initialize module
		 * @return    void
		 * @author            straightvisions GmbH
		 * @since            1.0
		 */
		public function init(){
			add_action('admin_init', array($this, 'admin_init'));
			
			if(!is_admin()) {
				$this->load_settings();
				$this->run();
			}
		}
		public function admin_init(){
			$this->get_root()->add_section($this);
			$this->load_settings();
		}
		public function load_settings(){
			$this->s['zip_before_city'] = static::$settings->create($this)
				->set_ID('zip_before_city')
				->set_title('Address: Show ZIP before City')
				->set_description(__('Display ZIP in address field before City', $this->get_module_name()))
				->load_type('checkbox');
			$this->s['company_optional'] = static::$settings->create($this)
				->set_ID('company_optional')
				->set_title('Address Form: Make Company optional')
				->set_description(__('Allow company field in address field to be optional', $this->get_module_name()))
				->load_type('checkbox');
		}
		public function run(){
			if($this->s['zip_before_city']->run_type()->get_data()){
				add_filter('gform_address_display_format', function(){ return 'zip_before_city'; });
			}
			if($this->s['company_optional']->run_type()->get_data()){
				add_filter('gform_field_validation', array($this,'gform_field_validation_make_company_in_address_optional'), 10, 4);
			}
		}
		public function gform_field_validation_make_company_in_address_optional($result, $value, $form, $field){
			if($field->type == 'address'){
				//address field will pass $value as an array with each of the elements as an item within the array, the key is the field id
				if ( ! $result['is_valid'] &&
					(
						$result['message'] == 'Dieses Feld ist erforderlich. Bitte gib eine vollständige Anschrift ein.' ||
						$result['message'] == 'Bitte Rechnungsadresse eingeben!' ||
						$result['message'] == 'Bitte abweichende Rechnungsadresse eingeben!'
					)) {
					//address failed validation because of a required item not being filled out
					//do custom validation
					$street  = rgar( $value, $field->id . '.1' );
					$street2 = rgar( $value, $field->id . '.2' );
					$city	 = rgar( $value, $field->id . '.3' );
					$state   = rgar( $value, $field->id . '.4' );
					$zip	 = rgar( $value, $field->id . '.5' );
					$country = rgar( $value, $field->id . '.6' );
					//check toSee if the values you care about are filled out
					if ( empty( $street2 ) && empty( $city ) && empty( $zip ) && empty( $country ) ) {
						$result['is_valid'] = false;
						$result['message']  = 'This field is required. Please enter at least a street, city, and state.';
					} else {
						$result['is_valid'] = true;
						$result['message']  = '';
					}
				}
			}
			return $result;
		}
	}