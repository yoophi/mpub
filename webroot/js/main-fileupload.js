/*
 * jQuery File Upload Plugin JS Example 6.10
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/*jslint nomen: true, unparam: true, regexp: true */
/*global $, window, document */

$(function () {
    'use strict';

    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
        url: 'http://172.16.97.138/blueimp_file_handler/attachments'
		, forceIframeTransport: true
    }
    );

    // Enable iframe cross-domain access via redirect option:
    $('#fileupload').fileupload(
        'option',
        'redirect',
        //window.location.href.replace(
        //    /\/[^\/]*$/,
        //    '/kk_epub2/result.html?%s'
        //)
        'http://npub2.vm/kk_epub2/result.html?%s'
    );

	// Load existing files:
	$('#fileupload').each(function () {
		var that = this;
		$.getJSON(
			$(this).fileupload('option', 'url'),
			function (result) {
				if (result && result.length) {
					$(that).fileupload('option', 'done')
						.call(that, null, {result: result});
				}
			}
		);
	});

});
