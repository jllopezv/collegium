/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:

	// config.uiColor = '#AADC6E';


    config.language = 'es';
    config.extraPlugins = 'youtube';
	config.youtube_width = '640';
	config.youtube_height = '480';
	config.youtube_responsive = true;
    config.embed_provider = 'https://www.youtube.com/watch?v=H08tGjXNHO4';
    config.youtube_related = false;
    config.youtube_older = false;
    config.youtube_privacy = true;
    config.youtube_autoplay = false;
    config.youtube_controls = true;
    config.youtube_disabled_fields = ['chkNoEmbed', 'txtEmbed', 'chkAutoplay'];

    config.extraPlugins = 'image2'
    config.image2_alignClasses = [ 'image2-align-left', 'image2-align-center', 'image2-align-right' ];

    config.extraPlugins = 'widget';
    config.extraPlugins = 'lineutils';
    config.extraPlugins = 'dialogui';
    config.extraPlugins = 'dialog';
    config.extraPlugins = 'notification';
    config.extraPlugins = 'clipboard';
	config.extraPlugins = 'mathjax';
	config.mathJaxLib = '//cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML';


};
