$(document).ready(function(){
	$("#close").click(function(){
		$("#blank_screen").fadeOut(2000);
		$("#content_frame").attr('src','');
		$("#content_open_block").hide();
	});
	
});