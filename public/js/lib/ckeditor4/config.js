/**
 * @license Copyright (c) 2003-2020, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	config.uiColor = '#D2D6DC';

	config.extraPlugins = 'youtube';
	config.youtube_width = '640';
	config.youtube_height = '480';
	config.youtube_responsive = true;

 	config.extraPlugins = 'widget';
    config.extraPlugins = 'lineutils';
    config.extraPlugins = 'dialogui';
    config.extraPlugins = 'dialog';
    config.extraPlugins = 'notification';
    config.extraPlugins = 'clipboard';
	config.extraPlugins = 'mathjax';
	config.mathJaxLib = '//cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML';
};
