(function() {
	tinymce.create('tinymce.plugins.prth_shortcodesPlugin', {
		init : function(ed, url) {
			// Register commands
			ed.addCommand('mceprth_shortcodes', function() {
				ed.windowManager.open({
					file : url + '/content.php', // file that contains HTML for our modal window
					width : 600 + parseInt(ed.getLang('prth_shortcodes.delta_width', 0)), // size of our window
					height : 700 + parseInt(ed.getLang('prth_shortcodes.delta_height', 0)), // size of our window
					inline : 1
				}, {
					plugin_url : url
				});
			});
			 
			// Register prth_shortcodess
			ed.addButton('prth_shortcodes', {title : 'Insert Shortcode', cmd : 'mceprth_shortcodes', image: url + '/css/images/shortcodes.png' });
		},
		 
		getInfo : function() {
			return {
				longname : 'Insert Shortcode',
				author : 'Icarus Creative',
				authorurl : 'http://themeforest.net/user/icaruscreativeorg/',
				version : tinymce.majorVersion + "." + tinymce.minorVersion
			};
		}
	});
	 
	// Register plugin
	tinymce.PluginManager.add('prth_shortcodes', tinymce.plugins.prth_shortcodesPlugin);

})();