$.ajaxSetup ({
	headers: {'X-CSRF-Token' : $('meta[name=_token]').attr('content')}
});
function requestFullScreen(element) {
	var requestMethod = element.requestFullScreen || element.webkitRequestFullScreen || element.mozRequestFullScreen || element.msRequestFullScreen;
	if (requestMethod) {
		requestMethod.call(element);
	} else if (typeof window.ActiveXObject !== "undefined") {
		var wscript = new ActiveXObject("WScript.Shell");
		if (wscript !== null) {
			wscript.SendKeys("{F11}");
		}
	}
}
function getSite(siteId){
	$.ajax({
		url: "/objectives/ajax/site/get/" + siteId ,
		cache: false,
		type: "GET",
		success:function (site) {
			//var site = JSON.stringify(data);
			$('#website_info').show();
			$('#site_name').attr('value',site.name);
			$('#site_root_url').attr('value',site.root_url);
			$('#site_desc').attr('value',site.desc);
		},
		error:function (xhr, status){
			$('#website_info').hide();
		}
	});
}
