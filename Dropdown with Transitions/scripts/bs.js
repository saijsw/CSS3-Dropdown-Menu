jQuery(document).ready(function($){
	var toggle	=	$("#toggle-class");
	if(toggle.hasClass("hidden"))
		return;
	showBounds(toggle[0].checked);
	
	function showBounds(value){
		return ((typeof(value) == "boolean") ? value : value[0].checked) ?
			$("body").addClass("showbounds")	:
			$("body").removeClass("showbounds");
	}
	
	toggle.change(function(e){
		showBounds(this.checked);
	});
	
	$(window).keydown(function(e){
		if(e.keyCode == 83){ // "S"
			toggle[0].checked	=	!(toggle[0].checked);
			showBounds(toggle);
		}
	});
});