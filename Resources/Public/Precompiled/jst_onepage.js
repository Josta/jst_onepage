

$(function() {
	/*
		# Finds static [.alert] elements and moves them to the [#alert] overlay.
		# The alerts will disappear automatically after some time, or by pressing the "close" link.
	*/

	var extractAlerts;
	extractAlerts = function() {
		return $('.alert').each(function() {
			var alert;
			alert = $(this);
			alert.appendTo('#alerts');
			setTimeout(function() {
				return alert.fadeOut('slow');
			}, 5000);
			return alert.find('*[data-dismiss="alert"]').click(function() {
				return alert.fadeOut('slow');
			});
		});
	};
	return extractAlerts();
});



$(function() {
	/* 
		# Makes a menu always stick to the position on the screen
		# that is closest to the original (static) position.
		# The menu must be in a fixed-height static container.
	*/

	var addScrollmenu, onePageNavSettings, sn;
	addScrollmenu = function(container, menu) {
		var handler, win;
		if (container.length === 0) {
			return;
		}
		win = $(window);
		container.height(menu.height());
		handler = function() {
			var ch, cy, newClass, wh, wy;
			wy = win.scrollTop();
			cy = container.offset().top;
			wh = win.height();
			ch = container.height();
			newClass = (function() {
				switch (false) {
					case !(wy + wh < cy + ch):
						return 'menu-bottom';
					case !(wy > cy):
						return 'menu-top';
					default:
						return 'menu-static';
				}
			})();
			if (!menu.hasClass(newClass)) {
				menu.removeClass('menu-top menu-bottom menu-static').addClass(newClass);
				if (newClass === 'menu-bottom') {
					return $('#nb-menu-dropdown').removeClass('dropdown').addClass('dropup');
				} else {
					return $('#nb-menu-dropdown').removeClass('dropup').addClass('dropdown');
				}
			}
		};
		$(window).scroll(handler);
		handler();
		if (menu.hasClass('menu-bottom')) {
			return $('#nb-menu-dropdown').removeClass('dropdown').addClass('dropup');
		}
	};
	addScrollmenu($('#menu-container'), $('#navbar'));
	onePageNavSettings = {
		currentClass: 'active',
		changeHash: false,
		scrollSpeed: 750,
		scrollThreshold: 0.25,
		easing: 'swing',
		end: function() {
			return window.setTimeout(function() {
				return $('#nb-section-title').text($('.current-section-list .active a').text());
			}, 200);
		},
		scrollChange: function($parent) {
			return $('#nb-section-title').text($parent.find('a').text());
		}
	};
	$('.current-section-list').onePageNav(onePageNavSettings);
	if (!window.isMobile) {
		$('#nb-sections').onePageNav(onePageNavSettings);
	}
	/* SIDENAV
	*/

	sn = $("#sidenav");
	$('a', sn).attr({
		tabindex: -1
	});
	sn.css({
		display: "block"
	});
	$("[href='#sidenav']").click(function(e) {
		e.preventDefault();
		sn.addClass("open");
		return $('a', sn).removeAttr('tabindex');
	});
	return $("#sidenav-eclipse, a", sn).click(function() {
		sn.removeClass("open");
		return $('a', sn).attr({
			tabindex: -1
		});
	});
});



$(function() {
	var sr;
	$('.collapse').one('show.bs.collapse', function() {
		return window.scrollBy(0, 1);
	});
	$('.nav-tabs a').one('shown.bs.tab', function() {
		return window.scrollBy(0, 1);
	});
	$('.animate-left').attr({
		'data-sr': 'enter left'
	});
	$('.animate-right').attr({
		'data-sr': 'enter right'
	});
	$('.animate-bottom').attr({
		'data-sr': 'enter bottom'
	});
	$('.animate-blend').attr({
		'data-sr': 'enter bottom, move 0px'
	});
	$('.animate-auto > .row').each(function() {
		var cols;
		cols = $(this).children();
		cols.filter(':odd').attr({
			'data-sr': 'enter bottom'
		});
		cols.filter(':even').attr({
			'data-sr': 'enter top'
		});
		cols.first().attr({
			'data-sr': 'enter left'
		});
		return cols.last().attr({
			'data-sr': 'enter right'
		});
	});
	return sr = new scrollReveal({
		move: '70px',
		over: '1s',
		vFactor: '0.35'
	});
});

