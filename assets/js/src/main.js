$(()=> {

	
$(document).on('click', ".wine-btn", function(e) {
	e.preventDefault();
	$(this).next('.more-infos').slideToggle();
})

})