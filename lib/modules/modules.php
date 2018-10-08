<?php
	/**
	 * @author			Matthias Reuter
	 * @package			sv_gravity_forms_enhancer
	 * @copyright		2017 Matthias Reuter
	 * @link			https://straightvisions.com/
	 * @since			1.0
	 * @license			This is no free software. See license.txt or https://straightvisions.com/
	 */

	namespace sv_gravity_forms_enhancer;

	class modules extends init{
		protected $sections														= array();
		private static $unique_id												= false;
		
		private static $form_count												= 999;
		private static $unique_id_mapping										= array();
		
		private static $form_count_footer										= 999;
		private static $unique_id_mapping_footer								= array();

		public function __construct(){

		}
		/**
		 * @desc			initialize module
		 * @return	void
		 * @author			Matthias Reuter
		 * @since			1.0
		 */
		protected function init(){
			add_filter('gform_get_form_filter', array($this,'form_start'), 9, 2);
			add_filter('gform_footer_init_scripts_filter', array($this,'form_end'), 10, 3);
		}
		public function form_start($form_string, $form){
			wp_enqueue_script($this->get_name(), $this->get_url_lib_section('frontend', 'js', 'frontend.js'), array('jquery', 'gform_gravityforms'), filemtime($this->get_path_lib_section('frontend', 'js', 'frontend.js')), true);

			if($this->generate_id($form)){
				$form_string													= $this->replace_form_id($form_string, $form);
				$form_string													= apply_filters($this->get_root()->get_prefix('form_start'), $form_string, static::$unique_id);
			}

			return $form_string;
		}
		public function form_end($form_string, $form, $current_page){
			if($this->generate_id($form, true)){
				$form_string													= $this->replace_form_id($form_string, $form);
				$form_string													= apply_filters($this->get_root()->get_prefix('form_end'), $form_string, static::$unique_id);
			}

			return $form_string;
		}
		private function generate_id($form=false, $footer=false){
			// if form has been submitted, use the submitted ID
			if(isset($_POST[$this->get_name().'_form_id'])){
				static::$unique_id												= absint($_POST[$this->get_name().'_form_id']); // Input var okay.
				// otherwise generate a new unique ID
			}elseif(isset($form['id'])){
				if($footer){
					// only get footer JS if forms are actually printed
					if(isset(static::$unique_id_mapping[($form['id'])])){
						static::$form_count_footer++;
						static::$unique_id_mapping_footer[$form['id']]			= static::$form_count_footer;
						static::$unique_id										= static::$form_count_footer;
					}else{
						return false;
					}
				}else{
					static::$form_count++;
					static::$unique_id_mapping[$form['id']]						= static::$form_count;
					static::$unique_id											= static::$form_count;
				}
				// otherwise false
			}else{
				return false;
			}

			return true;
		}
		private function replace_form_id($form_string, $form){
			// define all occurences of the original form ID that wont hurt the form input
			$strings															= array(
				' gform_wrapper '								 				=> ' gform_wrapper gform_wrapper_original_id_'.$form['id'].' ',
				"for='choice_".$form['id'].'_'									=> "for='choice_".static::$unique_id.'_',
				"id='choice_".$form['id'].'_'									=> "id='choice_".static::$unique_id.'_',
				"id='label_".$form['id'].'_'									=> "id='label_".static::$unique_id.'_',
				"'gform_wrapper_".$form['id']."'"								=> "'gform_wrapper_".static::$unique_id."'",
				"'gf_".$form['id']."'"											=> "'gf_".static::$unique_id."'",
				"'gform_".$form['id']."'"										=> "'gform_".static::$unique_id."'",
				"'gform_ajax_frame_".$form['id']."'"							=> "'gform_ajax_frame_".static::$unique_id."'",
				'#gf_'.$form['id']."'"											=> '#gf_'.static::$unique_id."'",
				"'gform_fields_".$form['id']."'"								=> "'gform_fields_".static::$unique_id."'",
				"id='field_".$form['id'].'_'									=> "id='field_".static::$unique_id.'_',
				"for='input_".$form['id'].'_'									=> "for='input_".static::$unique_id.'_',
				"id='input_".$form['id'].'_'									=> "id='input_".static::$unique_id.'_',
				"'gform_submit_button_".$form['id']."'"						=> "'gform_submit_button_".static::$unique_id."'",
				'"gf_submitting_'.$form['id'].'"'								=> '"gf_submitting_'.static::$unique_id.'"',
				"'gf_submitting_".$form['id']."'"								=> "'gf_submitting_".static::$unique_id."'",
				'#gform_ajax_frame_'.$form['id']								=> '#gform_ajax_frame_'.static::$unique_id,
				'#gform_wrapper_'.$form['id']									=> '#gform_wrapper_'.static::$unique_id,
				'#gform_'.$form['id']											=> '#gform_'.static::$unique_id,
				"trigger('gform_post_render', [".$form['id']					=> "trigger('gform_post_render', [".static::$unique_id,
				'gformInitSpinner( '.$form['id'].','							=> 'gformInitSpinner( '.static::$unique_id.',',
				"trigger('gform_page_loaded', [".$form['id']					=> "trigger('gform_page_loaded', [".static::$unique_id,
				"'gform_confirmation_loaded', [".$form['id'].']'				=> "'gform_confirmation_loaded', [".static::$unique_id.']',
				'gf_apply_rules('.$form['id'].','								=> 'gf_apply_rules('.static::$unique_id.',',
				'gform_confirmation_wrapper_'.$form['id']						=> 'gform_confirmation_wrapper_'.static::$unique_id,
				'gforms_confirmation_message_'.$form['id']						=> 'gforms_confirmation_message_'.static::$unique_id,
				'gform_confirmation_message_'.$form['id']						=> 'gform_confirmation_message_'.static::$unique_id,
				'if(formId == '.$form['id'].')'									=> 'if(formId == '.static::$unique_id.')',
				"window['gf_form_conditional_logic'][".$form['id'].']'			=> "window['gf_form_conditional_logic'][".static::$unique_id.']',
				"trigger('gform_post_conditional_logic', [".$form['id'].','	=> "trigger('gform_post_conditional_logic', [".static::$unique_id.',',
				'gformShowPasswordStrength("input_'.$form['id'].'_'			=> 'gformShowPasswordStrength("input_'.static::$unique_id.'_',
				"#input_".$form['id'].'_'										=> "#input_".static::$unique_id.'_',
				'gforms_calendar_icon_input_'.$form['id'].'_'					=> 'gforms_calendar_icon_input_'.static::$unique_id.'_',
				"id='ginput_base_price_".$form['id'].'_'						=> "id='ginput_base_price_".static::$unique_id.'_',
				"id='ginput_quantity_".$form['id'].'_'							=> "id='ginput_quantity_".static::$unique_id.'_',
				'gfield_price_'.$form['id'].'_'									=> 'gfield_price_'.static::$unique_id.'_',
				'gfield_quantity_'.$form['id'].'_'								=> 'gfield_quantity_'.static::$unique_id.'_',
				'gfield_product_'.$form['id'].'_'								=> 'gfield_product_'.static::$unique_id.'_',
				'ginput_total_'.$form['id']										=> 'ginput_total_'.static::$unique_id,
				'GFCalc('.$form['id'].','										=> 'GFCalc('.static::$unique_id.',',
				'gf_global["number_formats"]['.$form['id'].']'					=> 'gf_global["number_formats"]['.static::$unique_id.']',
				'gform_next_button_'.$form['id'].'_'							=> 'gform_next_button_'.static::$unique_id.'_',
				'</form>'														=> '<input type="hidden" name="'.$this->get_name().'_form_id" value="'.static::$unique_id.'" /></form>',
				'gf_progressbar_wrapper_'.$form['id']							=> 'gf_progressbar_wrapper_'.static::$unique_id,
				'gform_page_'.$form['id']										=> 'gform_page_'.static::$unique_id,
				'gform_fields_'.$form['id']										=> 'gform_fields_'.static::$unique_id,
				'gform_source_page_number_'.$form['id']						=> 'gform_source_page_number_'.static::$unique_id,
				'#gform_target_page_number_'.$form['id']						=> '#gform_target_page_number_'.static::$unique_id,
				'gform_previous_button_'.$form['id']							=> 'gform_previous_button_'.static::$unique_id,
				'id="wp-input_'.$form['id']										=> 'id="wp-input_'.static::$unique_id,
				"class='gchoice_".$form['id']									=> "class='gchoice_".static::$unique_id,
				"id='gform_source_page_number_".$form['id']."'"				=> "id='gform_source_page_number_".static::$unique_id."'",
				"id='gform_target_page_number_".$form['id']."'"				=> "id='gform_target_page_number_".static::$unique_id."'",
				'id="input_'.$form['id'].'_'									=> 'id="input_'.static::$unique_id.'_',
				'extensions_message_'.$form['id']								=> 'extensions_message_'.static::$unique_id,
				//"id='gform_uploaded_files_".$form['id']."'"					=> "id='gform_uploaded_files_".static::$unique_id."'",
				'if(formId == '.static::$unique_id.') {'						=> 'if(true) {',
				'gformInitChosenFields'											=> 'sv_gformInitChosenFields',
				"'#gform_'+form_id+'"											=> "'#gform_".static::$unique_id."'",
				//'gform_browse_button_'.$form['id']							=> 'gform_browse_button_'.static::$unique_id,
				//'gform_drag_drop_area_'.$form['id']							=> 'gform_drag_drop_area_'.static::$unique_id,
				//'gform_multifile_upload_'.$form['id']						=> 'gform_multifile_upload_'.static::$unique_id,
				//'gform_multifile_messages_'.$form['id']						=> 'gform_multifile_messages_'.static::$unique_id,
				//'gformDeleteUploadedFile('.$form['id']						=> 'gformDeleteUploadedFile('.static::$unique_id,
				//'&quot;form_id&quot;:'.$form['id'].',&quot;'					=> '&quot;form_id&quot;:'.static::$unique_id.',&quot;',

				// gfgeo support, not completed yet
				/*'gfgeo-advanced-address-'.$form['id']						=> 'gfgeo-advanced-address-'.static::$unique_id,
				'geocoder_id="'.$form['id']										=> 'geocoder_id="'.static::$unique_id,
				'gfgeo-advanced-address-geocoder-id-'.$form['id']				=> 'gfgeo-advanced-address-geocoder-id-'.static::$unique_id,
				'gfgeo-geocoded-hidden-fields-wrapper-'.$form['id']			=> 'gfgeo-geocoded-hidden-fields-wrapper-'.static::$unique_id,
				'gfgeo-geocoded-field-'.$form['id']								=> 'gfgeo-geocoded-field-'.static::$unique_id,
				'data-field_id="'.$form['id']									=> 'data-field_id="'.static::$unique_id,*/
			);

			// allow addons & plugins to add additional find & replace strings
			$strings															= apply_filters($this->get_root()->get_prefix('replace'), $strings, $form, static::$unique_id);

			// replace all occurences with the new unique ID
			$form_string														= str_replace(array_keys($strings), $strings, $form_string);

			return $form_string;
		}
		/**
		 * @desc			array of unique mapping IDs with form IDs
		 * @return	array	list of IDs
		 * @author			Matthias Reuter
		 * @since			1.0
		 */
		public function get_unique_id_mapping(){
			return static::$unique_id_mapping;
		}
	}
?>