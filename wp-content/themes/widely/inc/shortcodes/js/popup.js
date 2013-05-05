jQuery(document).ready(function($) {
    var shortcodes = {
    	loadVals: function()
    	{
    		var shortcode = $('#old-shortcode').text(),
    			transform_shortcode = shortcode;
    		
    		$('.popup-input').each(function() {
    			var input = $(this),
    				id = input.attr('id'),
    				id = id.replace('shortcode_', ''),
    				re = new RegExp("{{"+id+"}}","g");
    				
    			transform_shortcode = transform_shortcode.replace(re, input.val());
    		});
    		$('#new-shortcode').remove();
    		$('#popup-table').prepend('<div id="new-shortcode" class="hidden">' + transform_shortcode + '</div>');
    		
    		shortcodes.updatePreview();
    	},
    	updatePreview: function()
    	{
    		if( $('#sk-preview').size() > 0 )
    		{
                                var shortcode = $('#new-shortcode').html()
	    			var iframe = $('#sk-preview')
	    			var iframeSrc = iframe.attr('src')
	    			var iframeSrc = iframeSrc.split('preview.php')
	    			var iframeSrc = iframeSrc[0] + 'preview.php'
    			
	    		iframe.attr( 'src', iframeSrc + '?sc=' + base64_encode( shortcode ) );
	    		
	    		$('#sk-preview').height( $('#popup-window').outerHeight()-42 );
    		}
    	},
    	resizeTB: function()
    	{
			var tiny_ajax = $('#TB_ajaxContent')
			var tiny_window = $('#TB_window')
			var popup = $('#popup-window')

				tiny_ajax.css({
					padding: 0,
					height: popup.outerHeight()-15,
					overflow: 'hidden' 
				});
				
				tiny_window.css({
					width: tiny_ajax.outerWidth(),
					height: (tiny_ajax.outerHeight() + 30),
					marginLeft: -(tiny_ajax.outerWidth()/2),
					marginTop: -((tiny_ajax.outerHeight() + 47)/2),
					top: '50%'
				});

    	},
    	load: function()
    	{
    		var shortcodes = this
    		var popup = $('#popup-window')
    		var form = $('#popup-form', popup)
    		var shortcode = $('#old-shortcode', form).text()
    		var popupType = $('#shortcode-popup', form).text()
    		var transform_shortcode = ''
    		
    		shortcodes.resizeTB();
    		$(window).resize(function() { shortcodes.resizeTB() });
    		
    		shortcodes.loadVals();
    		
    		$('.popup-input', form).change(function() {
    			shortcodes.loadVals();
    		});
    		
    		$('.insert', form).click(function() {    		 			
    			if(window.tinyMCE)
				{
					window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, $('#new-shortcode', form).html());
					tb_remove();
				}
    		});
    	}
	}
    
    $('#popup-window').livequery( function() { shortcodes.load(); } );
});