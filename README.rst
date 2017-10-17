
====================================
JST Onepage: Easy Onepage Management
====================================

.. default-role:: code


:Project:
      ``TYPO3`` extension ``ext:jst_onepage``

:Author:
      `Josua Stabenow <josua.stabenow@gmx.de>`__

:Repository:
      Github `josta/jst_onepage <https://github.com/josta/jst_onepage>`__

:Tags: TYPO3, Extension, Onepage, Themes

**Overview:**

.. contents::
   :local:
   :depth: 2
   :backlinks: none


What does it do?
================

``JST Onepage`` introduces 4 page layouts, complete with backend layouts, BE pagetree icons and frontend templates:
	
- **Onepage**: no content, just children
- **Section**: single column, will be rendered as a section of the parent page
- **Standard Page**: single column, behaves normally
- **Container**: no content, no rendering, just child pages

The included base template

- has a navbar with a section menu, a page menu, and a mobile menu
- can be controlled with TypoScript in many aspects:
	- header/footer content
	- logo & favicon
	- navbar layout and behavior
	- page category and title
- is easy to override or extend using ``extbase`` methods

Further, ``JST Onepage`` adds three fields to content elements which make managing content in modern designs a lot easier:

- **Size**: ``XS`` to ``XXL``, the maximum width of the element (esp. useful for column elements)
- **Alignment**: text alignment (header + body), but behaves smart on small screens and columns
- **Animation**: entry animation with ``scrollreveal.js``


Requirements
============

- ``TYPO3 8.7.4`` or newer
- one of ``fluid_styled_content`` or ``bootstrap_package``
- ``ext:vhs``
- ``ext:realurl``
- ``jQuery`` (not included)
- ``Twitter Bootstrap`` (not included)

Consider installing ``JST Assets``. If available, this extension will use its SASS and CoffeeScript compilers as well as its Icon API. Otherwise you will only get precompiled assets with fixed media breakpoints and no icon sprites.

This extension is a basic layout extension and likely is incompatible with many other extensions that also offer page layouts (i.e. redefine the toplevel TypoScript object ``page``).


Installation
============

1. Install the extension from TER or Github
2. Include the static template on the root page
3. If you already have code defining the top-level TypoScript key ``page`` or a numeric subkey, you should probably remove that. Adding entries to other subkeys like ``includeCSS`` or ``meta`` is fine though.
4. In TypoScript constants, set the paths to the logo, favicon, header and footer content as detailed below


Customizing the layout
======================

There are a number of ways to customize the theme:

- some design options are available as TypoScript constants
- some page parts (header, footer, page title, page category, HTML title) can be redefined as TypoScript cObjects
- if you're using ``JST Assets``, you can change a lot of the SASS variables that are used for creating the CSS
- you always can replace or overrule the style with your own stylesheet
- you can override full templates, the layout or just partials (e.g. navbar, sidenav) by adding your custom root paths

Setting TypoScript constants
----------------------------

Refer to the Configuration section of this manual to get a list of all constants that can be set.


Redefining TypoScript cObjects
------------------------------

``JST Onepage`` uses the key ``lib.page`` to store various cObjects that will be used in the layout. They usually come with a sensible standard configuration, but you can completely replace them if you want things done differently.

The available cObjects are:

- ``header``: content for the header area that is included before the main content. Per default it fetches the content that is specified by the constant ``page.sections.header.content_uid``.
- ``footer``: content for the footer area that is included after the main content. Per default it fetches the content that is specified by the constant ``page.sections.footer.content_uid``.
- ``title``: the page title as it is used in the navbar. Per default this is the page record title
- ``category``: a page category that is shown above the title in the navbar. Empty by default.
- ``fullTitle``: used as HTML title. Per default the ``title`` cObject, the ``category`` cObject and the site title (as defined in the TypoScript root template) are concatenated with dashes inbetween.

To give an example: you have a tt_news installation with many different articles. Unfortunately the HTML title always shows "News" for every article, which is the page record name in the backend. On the tt_news page, you can override this behaviour by adding the following TypoScript:

::
	lib.page {
		category >
		category = TEXT
		category.value = News
		title >
		title = TEXT
		title.dataWrap = {GP:tx_ttnews|tt_news}
		title.outerWrap = {DB:tt_news:|:title}
		title.insertData = 1
	}

Setting SASS variables
----------------------

You can set SASS variables either in TypoScript or in an external include file. Have a look at the ``JST Assets`` manual to read more on how this is done.

The ``JST Onepage`` style can be affected through the following variables (given with their default value):

::

	$screen-sm-min: 		768px 	!default;
	$screen-md-min: 		992px 	!default;
	$screen-lg-min: 		1200px 	!default;
	$grid-float-breakpoint: 825px 	!default;
	
	$theme-content-bg: 			#fff 	!default;
	$theme-section-title-show: 	0 		!default;
	$theme-footer: 				#444 	!default;
	$theme-footer-bg: 			#888 	!default;
	
	$theme-nav:							#fff						!default;
	$theme-nav-bg:						#2a3968						!default;
	$theme-nav-link:					$theme-nav					!default;
	$theme-nav-link-bg:					transparent					!default;
	$theme-nav-link-hover:				#61bbe0						!default;
	$theme-nav-link-hover-bg:			$theme-nav-link-bg			!default;
	$theme-nav-link-active:				$theme-nav-bg				!default;
	$theme-nav-link-active-bg:			$theme-nav-link-hover		!default;
	$theme-nav-dropdown:				$theme-nav					!default;
	$theme-nav-dropdown-bg:				$theme-nav-bg				!default;
	$theme-nav-dropdown-link:			$theme-nav-dropdown			!default;
	$theme-nav-dropdown-link-bg:		$theme-nav-link-bg			!default;
	$theme-nav-dropdown-link-active:	$theme-nav-link-active		!default;
	$theme-nav-dropdown-link-active-bg:	$theme-nav-link-active-bg	!default;
	
	$theme-side:						rgba(0,0,0,.75)				!default;
	$theme-side-bg:						#f3f3f3						!default;
	$theme-side-header:					$theme-nav					!default;
	$theme-side-header-bg:				$theme-nav-bg				!default;
	$theme-side-link:					$theme-nav-link				!default;
	$theme-side-link-bg:				$theme-nav-link-bg			!default;
	$theme-side-link-active:			$theme-nav-link-active		!default;
	$theme-side-link-active-bg:			$theme-nav-link-active-bg	!default;
	$theme-side-section-link:			$theme-nav-link				!default;
	$theme-side-section-link-bg:		$theme-nav-link-bg			!default;
	$theme-side-section-link-active:	$theme-nav-link-active-bg	!default;
	$theme-side-section-link-active-bg:	transparent					!default;
	
As you can see, there are variables that indicate the media breakpoints. Those should only be changed if you also compile Bootstrap with those same values. All other variables however mostly set colors. Many variables copy the values of other variables, so you only have to override those that have actual color values.

There is one variable that does not set a color: ``$theme-section-title-show``. To write valid HTML, sections must have ``h1`` tags at the beginning. For that reason as well as accessibility, the section titles are always included. However sometimes you don't want automatic titles to destroy your design. For this reason, you can toggle the visiblity of those titles with this variable.


Overruling stylesheets
----------------------

This is something that I won't have to tell you how to do, hopefully...


Overriding templates
--------------------

The template, layout and partial rootpaths are defined in the TypoScript key ``page.10``, which is of type ``FLUIDTEMPLATE``. Just add your template path to the array in subkey ``templateRootPaths`` (or ``layoutRootPaths/partialRootPaths``). Array key ``5`` is used by ``JST Onepage``, so yours should be higher.



The new content element fields
==============================

Size
----

Use this option to assign your content element a maximum width. Have a look at the CSS to get a feel for them:

::

	.size-xs 	{max-width: 600px}
	.size-s 	{max-width: 750px}
	.size-m 	{max-width: 900px}
	.size-l 	{max-width: 1000px}
	.size-xl 	{max-width: 1300px}
	.size-xxl 	{max-width: 1400px}
	.size-full 	{max-width: none; width: 100%}
	
If the available space is larger than the size permits, the content element is centered horizonally within the available space. The size default is ``m``.

Alignment
---------

While you can set the alignment separately for the header, bodytext and images of regular content elements, this is a lot of work on the one hand, and quite inflexible on the other: Your alignment will always stay the same, no matter the screen size. Now with the new alignment option, you can set the alignment for a specific media breakpoint only. That way, you can have content right aligned in a two-column layout, but centered in the collapsed mobile view.

The alignment field is still WIP, so the available options will likely change soon.

Animation
---------

With the animation field you can tell the included Javascript library ``scrollreveal.js`` to animate the content element when it is first scolled into view.

There are four basic options (left, right, bottom, blend) which apply a specific simple animation. Furthermore, there is the auto option which detects some HTML structures like Bootstrap columns and animates them automatically. One caveat though: the auto option cannot detect a changed visual order of columns if you're using Bootstrap 3.

Other fields
------------

Beyond defining those new fields, ``JST Onepage`` also replaces the CSS for the fields ``Space Before`` and ``Space After``. Also the defaults of those fields is set to ``m``, which makes more sense to me than ``none``.

In order to add all the new CSS classes, I had to override the ``fluid_styled_content`` layout. It has been altered to include the TypoScript array ``lib.content.class``, which defines all the CSS classes that should be added to content element frames.


TypoScript Configuration
========================

Constants
---------

``page.logo``
~~~~~~~~~~~~~
	Has four subkeys:
	
	- ``file``: path to the original logo image, preferably an SVG. Used in the Sidebar/Mobile menu
	- ``fileNav``: path to the navigation logo, preferably an SVG, possibly monochrome. Used in the Navbar.
	- ``fileMicro``: path to the micro logo version. Used like the navigation logo, but for maobile devices where there's less space available
	- ``linktitle``: title of the link to that start page that is put on every logo instance
	
``page.favicon``
~~~~~~~~~~~~~~~~
	Has five subkeys:
	
	- ``file``: path to the standard favicon
	- ``version``: a unique string that is appended to favicon URLs to force a refresh when the version string changes
	- ``maskColor``: a color that is applied to the favicon in some settings. Must be a hexadecimal rgb color without the # sign
	- ``themeColor``: a color that is applied to the favicon in some settings. Must be a hexadecimal rgb color without the # sign
	- ``extendedFaviconPath``: a path to a directory that contains different versions of the favicon for various systems
	
``page.navbar``
~~~~~~~~~~~~~~~
	Has five subkeys:
	
	- ``title``: boolean, whether the page title should be shown in the navbar
	- ``section_nav``: boolean, whether the section (scroll) navigation should be shown in the navbar
	- ``section_title``: boolean, whether the current section title should be shown in the navbar. Only affects the mobile view.
	- ``login_link.page_uid``: When there is a special login link in the navbar, this is its target page.
	- ``mode``: can be ``fixed-top``, ``fixed-bottom``, ``static-top``, or ``flip``. In ``flip`` mode, the navbar is inserted after the header and behaves statically, but clips to the respective edge instead of scrolling out of view.
	
``page.sections``
~~~~~~~~~~~~~~~~~
	Has the following subkeys:
	
	- ``header``: boolean, whether a header should be included
	- ``header.content_uid: id of a content element that should be included as header
	- ``footer``, boolean, whether a footer should be included
	- ``footer.content_uid: id of a content element that should be included as footer
	
Setup
-----

``page.10``
~~~~~~~~~~~
	Layout rendering definition. Here you can register new layouts, add new root paths, or add/modify settings or variables for use in the templates.
	
	-``templateName``: cObject that maps backend layout names to fluid templates.
	-``templateRootPaths``, ``layoutRootPaths```, ``partialRootPaths``: arrays of paths that are search for page templates, and layouts/partials referenced therein
	- ``settings``: mostly copies the constants for use in the template. Additionally defines the setting ``robotAccess``, which indicates that the page is currently accessed by a robot.
	- ``variables``: mostly copies the ``lib.page`` cObjects for easy use in the template. Additionally defines the cObjects ``rootPage`` and ``pageLayout`` which are filled automatically
	
	
``lib.page``
~~~~~~~~~~~~
	A key with cObjects that are used in the standard template. Usually they are linked into ``page.10.variables``.
	
	Some available cObjects are: ``header``, ``footer``, ``title``, ``category``, ``fullTitle``
	
``lib.content.class``
~~~~~~~~~~~~~~~~~~~~~
	cObject (COA) that is included into the content element frame classes attribute.
	
	Per default, ``JST Onepage`` includes the following classes:
	
	- the content type (CType, list_type or gridelements type, whichever is most appropriate)
	- the top space and bottom space classes
	- the size, alignment and animation classes for the new content element fields
	