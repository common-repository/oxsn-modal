(function($) {

	$('a[href*=".png"], a[href*=".gif"], a[href*=".jpg"]').not('.oxsn_no_modal').each(function() {
		if (this.href.indexOf('?') < 0) {
			$(this).addClass('oxsn_fancybox_img').attr('rel', 'group');
		}
	});

	$(".oxsn_fancybox_img").fancybox({
		helpers : {
			title : {
				type : 'inside'
			}
		}
	});

	$('a[href*="youtube.com/watch?v="], a[href*="youtu.be/"]').each(function(){

		function vidId(url) {
			var p = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
			return (url.match(p)) ? RegExp.$1 : false;
		}

		var url = $(this).attr('href');
		var videoid = vidId(url);

		$(this).attr('href', 'https://www.youtube.com/embed/' + videoid);

	});

	$('a[href*="vimeo.com/"]').each(function(){

		vimeo_Reg = /https?:\/\/(?:www\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|)(\d+)(?:$|\/|\?)/;

		function vidId(url) {
			var match = url.match(vimeo_Reg);
			return match[3];
		}

		var url = $(this).attr('href');
		var videoid = vidId(url);

		$(this).attr('href', 'https://player.vimeo.com/video/' + videoid);

	});

	$('a[href*="youtube.com/embed"], a[href*="vimeo.com/video"], a[href*="google.com/maps"]').not('.oxsn_no_modal').each(function() {

		$(this).addClass('oxsn_fancybox_emb').addClass('iframe');

	});

	$(".oxsn_fancybox_emb").fancybox({
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: false,
		width		: '70%',
		height		: '70%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	});

	$(".oxsn_fancybox_form").fancybox({
		maxWidth	: 300,
		fitToView	: false,
		width		: '70%',
		autoHeight 	: true,
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	});

	$(".oxsn_fancybox_inline").fancybox({
		'padding': 0,
		'titlePosition': 'inside',
	    'autoScale': true,
	    'autoDimensions': true,
	    'width': 'auto',
	    'height': 'auto',
	    'transitionIn': 'none',
	    'transitionOut': 'none',
	    'onCleanup': function () {
	        var myContent = this.href;
	        if (myContent.charAt(0)=="#") $(".fancybox-inline-tmp").replaceWith($(myContent)[0].outerHTML);
	    }
	});
	
})(jQuery);