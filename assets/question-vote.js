import $ from 'jquery';

$('.vote-arrows').find('a').on("click", function(e) {
	e.preventDefault();
	var $container = $(this).parent();
	
	$.ajax({
		url: '/answers/1/vote/'+$(e.currentTarget).data('direction'),
		method: 'POST'
	}).then( function( response ) {
		$container.find('span').text(response.votes);
	})
})