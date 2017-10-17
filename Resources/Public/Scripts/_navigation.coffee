$ ->

	### 
	# Makes a menu always stick to the position on the screen
	# that is closest to the original (static) position.
	# The menu must be in a fixed-height static container.
	### 
	addScrollmenu = (container, menu) ->
		if (container.length == 0)
			return
		win = $(window)
		container.height(menu.height())
		handler = () ->
			wy = win.scrollTop()
			cy = container.offset().top
			wh = win.height()
			ch = container.height()		
			newClass = switch
				when (wy + wh < cy + ch) then 'menu-bottom' 
				when (wy > cy) then 'menu-top'
				else 'menu-static'
			if (!menu.hasClass(newClass))
				menu.removeClass('menu-top menu-bottom menu-static').addClass(newClass)
				if (newClass == 'menu-bottom')
					$('#nb-menu-dropdown').removeClass('dropdown').addClass('dropup')
				else
					$('#nb-menu-dropdown').removeClass('dropup').addClass('dropdown')
		$(window).scroll handler
		handler()
		if (menu.hasClass('menu-bottom'))
			$('#nb-menu-dropdown').removeClass('dropdown').addClass('dropup')

	# make navigation sticky
	#if !window.isMobile
	addScrollmenu($('#menu-container'), $('#navbar'))
		
	# always remove hashes after pageload
	#setTimeout ->
	#	history.replaceState({}, '', window.location.href.split("#")[0])
	#, 2000
	
	# create scroll navigation
	onePageNavSettings = {
		currentClass: 'active',
		changeHash: false,
		scrollSpeed: 750,
		scrollThreshold: 0.25,
		easing: 'swing',
		end: ->
			window.setTimeout ->
				$('#nb-section-title').text($('.current-section-list .active a').text())
			, 200
		scrollChange: ($parent) ->
			$('#nb-section-title').text($parent.find('a').text())
	}

	$('.current-section-list').onePageNav(onePageNavSettings)
	if !window.isMobile
		$('#nb-sections').onePageNav(onePageNavSettings)


	### SIDENAV ###

	sn = $("#sidenav")
	$('a', sn).attr(tabindex: -1)
		
	# Enable sidebar (disabled to avoid unstyled flashing of content)
	sn.css(display: "block")
			
	# Open sidebar when clicking on #sidenav links
	$("[href='#sidenav']").click (e) ->
		e.preventDefault();
		sn.addClass("open");
		$('a', sn).removeAttr('tabindex')	
			
	# Close sidebar when clicking on the page or any entry.
	$("#sidenav-eclipse, a", sn).click ->
		sn.removeClass("open")
		$('a', sn).attr(tabindex: -1)
	
	# Show waiting animation
	#waitingAnimation = true
	#$('a.download, a.mail').click ->
	#	waitingAnimation = false
	#	return
	#$(window).bind 'beforeunload', ->
	#	if waitingAnimation
	#		sn.addClass("wait")
	#	waitingAnimation = true
	#	return
	#$(window).bind 'unload', ->
	#	sn.removeClass("wait")
