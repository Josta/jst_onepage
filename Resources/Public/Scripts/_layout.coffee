$ ->

	###
	# Finds static [.alert] elements and moves them to the [#alert] overlay.
	# The alerts will disappear automatically after some time, or by pressing the "close" link.
	###
	extractAlerts = ->
		$('.alert').each ->
			alert = $(@)
			alert.appendTo('#alerts')
			setTimeout ->
				alert.fadeOut('slow')
			, 5000
			alert.find('*[data-dismiss="alert"]').click ->
				alert.fadeOut('slow')	
	
	# dynamically attach alerts
	extractAlerts()

	