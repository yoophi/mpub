require(["jquery", "underscore", "json2", "jquery.tmpl", "backbone",
		 "jquery.ui.widget", "jquery.iframe-transport", "jquery.fileupload", 
		 "app-photo", "tiny_mce/jquery.tinymce"
		 ], function($, _) {

    $(function() {
        $('textarea.tinymce').tinymce({
            // Location of TinyMCE script
            script_url : '/kk_epub2/js/tiny_mce/tiny_mce.js',

            // General options
            // theme : "simple",
            theme : "advanced",
            plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

            // Theme options
            theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
            theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
            theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
            theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
            theme_advanced_toolbar_location : "top",
            theme_advanced_toolbar_align : "left",
            theme_advanced_statusbar_location : "bottom",
            theme_advanced_resizing : true,

            // Example content CSS (should be your site CSS)
            content_css : "/kk_epub2/css/tiny_mce/content.css",

            // Drop lists for link/image/media/template dialogs
            template_external_list_url : "lists/template_list.js",
            external_link_list_url : "lists/link_list.js",
            external_image_list_url : "lists/image_list.js",
            media_external_list_url : "lists/media_list.js",

            // Replace values for the template plugin
            template_replace_values : {
                username : "Some User",
                staffid : "991234"
            }
        });

        $('.photo-item').live("click", function() {
        	// alert($(this).attr('data-url'));
        	var url = $(this).attr('data-url');
        	$('textarea.tinymce').tinymce().execCommand('mceInsertContent',false,'<div><img src="' + url + '" width="100%"></div>');
        });
    });

});

require(["jquery", "jquery.ui.widget", "jquery.iframe-transport", "jquery.fileupload", "app-photo" ], function($, _) {

	$(function() {
		$('#fileupload').fileupload({
			url: 'http://172.16.97.138/blueimp_file_handler/attachments'
			, forceIframeTransport: true
		});

		$('#fileupload').fileupload(
			'option',
			'redirect',
			'http://npub2.vm/kk_epub2/result.html?%s'
		);

		$('#fileupload').fileupload({
			dataType: 'json',
			add: function (e, data) {
				console.log('- add -');
				data.context = $('<p />').text('uploading...').appendTo(document.body);
				data.formData = { 'hello': 'Hello, world!' };
				console.log(data);
				data.submit();
			},
			done: function (e, data) {
				console.log('- done -');
				data.context.text('Upload finished.');
				$.each(data.result, function(index, file) {
					$('<p/>').text(file.name).appendTo(document.body);
					console.log({ 'xx': file});

					Photos.create({ filename: file.name, url: file.url, thumb_url: file.thumbnail_url });
				});
			}
		});
	});

});
