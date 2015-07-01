/**
 * @author Antonov Andrey http://dustweb.ru/
 * @copyright Copyright � 2008-2009, Antonov A Andrey, All rights reserved.
 */

(function() {
	// Load plugin specific language pack
	//tinymce.PluginManager.requireLangPack('example');
	tinymce.create('tinymce.plugins.PdfPlugin', {
		init : function(ed, url) {
			// Register commands
			ed.addCommand('fileManager', function() {
				ed.windowManager.open({
					file : '/cms/files',
					width : 700 + parseInt(ed.getLang('images.delta_width', 0)),
					height : 550 + parseInt(ed.getLang('images.delta_height', 0)),
					inline: true,
					popup_css : false
				}, {
					plugin_url : '/cms/files'
				});
			});

			// Register buttons
			ed.addButton('pdfupload', {
				title : 'File Manager',
				cmd : 'fileManager',
				image : url + '/img/up.png'
			});
		},

		getInfo : function() {
			return {
				longname : 'File Manager',
				author : 'Ya',
				authorurl : '',
				infourl : '',
				version : '1'
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('pdfupload', tinymce.plugins.PdfPlugin);
})();