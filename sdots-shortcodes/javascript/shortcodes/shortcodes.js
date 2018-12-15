/*global window */
(function (window) {
	'use strict';

	window.tinymce.create('tinymce.plugins.shortCodesPlugin', {
		init: function (ed, url) {
			var t = this;

			t.editor = ed;

			// Register commands
			ed.addCommand('insertShortCodes', function() {
				ed.windowManager.open({
                    file : '/shortcodes',
					width : 500,
					height : 400,
					inline : true
				}, {
					plugin_url : url
				});
			});

			// Register button
			ed.addButton('shortCodes', {
				title: 'Insert Shortcodes',
				image: url+'/shortcodes.gif',
				cmd: 'insertShortCodes'
			});
		},

		getInfo: function () {
			return {
				longname: 'ShortCodes',
				author: '7dots Limited',
				authorurl: 'http://www.7dots.co.uk',
				infourl: 'http://www.7dots.co.uk',
				version: '1.0.0'
			};
		}
	});

	// Register plugin
	window.tinymce.PluginManager.add('shortCodes', window.tinymce.plugins.shortCodesPlugin);
}(window));