jQuery(document).bind('gform_post_render', function(event, form_id, current_page){
	jQuery('#gform_'+form_id+' .wp-editor-area').each(function(){
		if(typeof jQuery(this).attr('id') != 'undefined'){
			var sv_mce_id = jQuery(this).attr('id');
			setTimeout(function(){
                tinymce.execCommand('mceRemoveEditor', false, sv_mce_id);
                tinymce.execCommand('mceAddEditor', false, sv_mce_id);}, 100);
		}
	});
});

// this fixes that enhanced UI feature is normally not initiated on invisible elements.
//var sv_gravity_forms_enhancer_chosen_fields;
function sv_gformInitChosenFields(fieldList, noResultsText){
	if(typeof sv_gformInitChosenFields[jQuery(fieldList).attr('id')] === "undefined"){
		sv_gformInitChosenFields[jQuery(fieldList).attr('id')] = jQuery(fieldList).attr('id');
		
		return jQuery(fieldList).each(function(){
			var element = jQuery( this );

			// RTL support
			if( jQuery( 'html' ).attr( 'dir' ) == 'rtl' ) {
				element.addClass( 'chosen-rtl chzn-rtl' );
			}

			// only initialize once
			if( /*element.is(":visible") && */element.siblings(".chosen-container").length == 0 ){
				var options = gform.applyFilters( 'gform_chosen_options', { no_results_text: noResultsText }, element );
				element.chosen( options );
			}

		});
	}
}

// we will give the chosen a fallback width of 100%
gform.addFilter('gform_chosen_options', 'sv_gform_chosen_options');
function sv_gform_chosen_options(options, element){
	options.width		= '100%';
	return options;
}