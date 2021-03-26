/**
 * @license Copyright (c) 2003-2020, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
    config.skin = 'n1theme';

	//config.uiColor = '#D2D6DC';


    config.extraPlugins = 'image2';
    config.image2_alignClasses = [ 'image2-align-left', 'image2-align-center', 'image2-align-right' ];

	config.extraPlugins = 'youtube';
	config.youtube_width = '640';
	config.youtube_height = '480';
	config.youtube_responsive = true;

    config.extraPlugins = 'notificationaggregator';
    config.extraPlugins = 'embedbase';
    config.extraPlugins = 'embedsemantic';
    config.extraPlugins = 'embed';
    config.extraPlugins = 'fakeobjects';
    config.extraPlugins = 'autolink';
    config.extraPlugins = 'link';
    config.extraPlugins = 'autolink';
    config.extraPlugins = 'textmatch';
    config.extraPlugins = 'undo';


 	config.extraPlugins = 'widget';
    config.extraPlugins = 'lineutils';
    config.extraPlugins = 'dialogui';
    config.extraPlugins = 'dialog';
    config.extraPlugins = 'notification';
    config.extraPlugins = 'clipboard';
	config.extraPlugins = 'mathjax';
	config.mathJaxLib = '//cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML';

    // Fontawesome
    config.extraPlugins = 'ckeditorfa';
    config.allowedContent = true;
    config.contentsCss = '/css/fontawesome/all.min.css';

    // Default Font
    config.font_style =
    {
        element : 'span',
        styles : { 'font-family' : 'Nunito' },
        overrides : [ { element : 'font', attributes : { 'face' : null } } ]
    };


};
