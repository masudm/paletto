(function(window, $, undefined){
	'use strict';
	var plugin = {},
		$pluginSelect = $('#pluginSelect'),
		getQueryVariable = function(variable) {
			var query = window.location.search.substring(1),
				vars = query.split('&'),
				pair, i;

			for (i = vars.length; i--; ) {
				pair = vars[i].split('=');
				if(pair[0] === variable){
					return pair[1].replace(/^\s*|\s*$/, '');
				}
			}
			return(false);
		},
		type = getQueryVariable('type');


    plugin.desktop = {
		customBG: '#222',
		margin: '4px -2px 0',
		doRender: 'div div',
        opacity: false,
		cssAddon:'.cp-xy-slider:active {cursor:none;}'
	};
    
	$pluginSelect.val(type || 'desktop').
	on('change', function(e) {
		window.location = './?type=' + this.value + '#demo'
	});
	var isMobile = /webOS|iPhone|iPad|iPod|BlackBerry|Windows Phone/i.
			test(window.navigator.userAgent);

	type === 'mobile' && !isMobile && $('#qr').show();
	isMobile && $('.div-toggles').hide();

	window.myColorPicker = $('.color').colorPicker(
        
		plugin[type] || plugin.desktop
	);
	$('.trigger').colorPicker();
	$('pre').colorPicker({doRender: false});
})(window, jQuery);