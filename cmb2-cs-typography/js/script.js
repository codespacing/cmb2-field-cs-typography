(function($){
	
	'use strict';
	
	var cs_preview_style_fields = function(field_id){
		
		$('div.cs-typography-preview[data-field-id="' + field_id + '"]').attr('style', '');
		
		$('div.cs-typography-fields-container[data-field-id="' + field_id + '"] :input[type!=hidden]').each(function(){
			
			var preview_css = '';
			
			var field_name = $(this).attr('name');
			
			if(typeof field_id === 'undefined' || typeof field_name === 'undefined')
				return;

			var css_property = $(this).attr('data-css-property').replace('backup-font', 'font-family');
			var css_property_val = $(this).val();
			
			if(typeof $(this).attr('data-is-unit') === 'undefined' 				
				&& css_property_val != '' 
				&& css_property != 'google-font'
			){

				if(typeof $(this).attr('data-has-unit') !== 'undefined')				
					css_property_val += $('select.cs-typography-select[data-field-id="' + field_id + '"][data-css-property="' + css_property + '"]').val();
				
				$('div.cs-typography-preview[data-field-id="' + field_id + '"]').css(css_property, css_property_val);
							
			}
			
		});
		
	}
	
	$('select.cs-typography-select').on('change', function(){
			
		var field_id = $(this).attr('data-field-id');
		
		if(typeof field_id === 'undefined')
			return;			
			
		/**
		 * Preview style */
		 
		cs_preview_style_fields(field_id);
		
		/**
		 * Note: Each unit field (font-size, etc...) has a related "hidden" input.
		 * Build & add the "Hidden" input value */
		
		if($(this).attr('data-is-unit') !== 'undefined'){
			
			var field_name = $(this).attr('name');
			var css_property = $(this).attr('data-css-property');
			
			var css_property_val = $('input.cs-typography-text[data-field-id="' + field_id + '"][data-css-property=' + css_property + '][data-has-unit=1]').val();	
			
			if(typeof field_name === 'undefined' || typeof css_property_val === 'undefined')
				return;
			
			var hidden_field_name = field_id + '[' + css_property.replace('-', '_') + ']';	
			var hidden_val = css_property_val + $(this).val();
			
			$('input[type=hidden][data-field-id="' + field_id + '"][name="' + hidden_field_name + '"][data-css-property=' + css_property + ']').val(hidden_val);
		
		}
		
	});
	
	$('input.cs-typography-text, input[data-css-property=color]').on('input propertychange paste', function(){
			
		var field_id = $(this).attr('data-field-id');

		if(typeof field_id === 'undefined')
			return;			
			
		/**
		 * Preview style */
		 
		cs_preview_style_fields(field_id);
		
		/**
		 * Note: Each unit field (font-size, etc...) has a related "hidden" input.
		 * Build & add the "Hidden" input value */
		
		if($(this).attr('data-has-unit') !== 'undefined'){
			
			var field_name = $(this).attr('name');
			var css_property = $(this).attr('data-css-property');
			
			var css_property_unit = $('select.cs-typography-select[data-field-id="' + field_id + '"][data-css-property=' + css_property+  '][data-is-unit=1]').val();	
			
			if(typeof field_name === 'undefined' || typeof css_property_unit === 'undefined')
				return;
			
			var hidden_field_name = field_id + '[' + css_property.replace('-', '_') + ']';	
			var hidden_val = $(this).val() + css_property_unit;
			
			$('input[type=hidden][data-field-id="' + field_id + '"][name="' + hidden_field_name + '"][data-css-property=' + css_property + ']').val(hidden_val);
		
		}
		
	});
			
})( jQuery );
