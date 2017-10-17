<?php 
defined('TYPO3_MODE') || die ();

$conf = unserialize($_EXTCONF);
$extpath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('jst_onepage');

if ($conf['use_pagetree_icons']) {
	// Provide customized page type icons for onepage template pages
	$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
	$svgProvider = TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class;
	$path = 'EXT:jst_onepage/Resources/Public/Icons/PageTree/';
	$iconRegistry->registerIcon('apps-pagetree-jst-onepage', $svgProvider,
		['source' => $path.'icon-onepage.svg']);
	$iconRegistry->registerIcon('apps-pagetree-jst-onepage-hideinmenu', $svgProvider,
		['source' => $path.'icon-onepage-hideinmenu.svg']);
	$iconRegistry->registerIcon('apps-pagetree-jst-onepage-section', $svgProvider,
		['source' => $path.'icon-section.svg']);
	$iconRegistry->registerIcon('apps-pagetree-jst-onepage-section-hideinmenu', $svgProvider,
		['source' => $path.'icon-section-hideinmenu.svg']);
	$iconRegistry->registerIcon('apps-pagetree-jst-onepage-page', $svgProvider,
		['source' => $path.'icon-page.svg']);
	$iconRegistry->registerIcon('apps-pagetree-jst-onepage-page-hideinmenu', $svgProvider,
		['source' => $path.'icon-page-hideinmenu.svg']);
}

//add width and alignment fields
if ($conf['add_content_fields']) {
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
		file_get_contents($extpath.'Configuration/TSconfig/Page/ContentFields.txt'));
}

// add layouts
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
	file_get_contents($extpath.'Configuration/TSconfig/Page/PageLayouts.txt'));