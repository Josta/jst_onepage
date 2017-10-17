$ ->

	# make scrollreveal and bootstrap collapse/tabs work together
	$('.collapse').one 'show.bs.collapse', ->
		window.scrollBy(0, 1)
	$('.nav-tabs a').one 'shown.bs.tab', ->
		window.scrollBy(0, 1)

	# basic animations
	$('.animate-left').attr('data-sr': 'enter left')
	$('.animate-right').attr('data-sr': 'enter right')
	$('.animate-bottom').attr('data-sr': 'enter bottom')  
	$('.animate-blend').attr('data-sr': 'enter bottom, move 0px')
	
	# animate bootstrap columns
	$('.animate-auto > .row').each ->
		cols = $(@).children();
		cols.filter(':odd').attr('data-sr': 'enter bottom');
		cols.filter(':even').attr('data-sr': 'enter top');
		cols.first().attr('data-sr': 'enter left');
		cols.last().attr('data-sr': 'enter right');	

	# activate animations (with default values)
	sr = new scrollReveal({
		move: '70px',
		over: '1s',
		vFactor: '0.35'
	})
