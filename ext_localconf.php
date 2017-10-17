<?php
defined('TYPO3_MODE') || die ();

// Hook into RealURL (remove trailing slashes and convert section links to anchors)
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']['encodeSpURL_postProc']['jst_onepage'] =
	\Josta\JstOnepage\Hook\OnepageHooks::class . '->postProcessLinks';
	
// Register Frontend icons
if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('jst_assets')) {
	\Josta\JstAssets\Utility\IconUtility::addIconPath('EXT:jst_onepage/Resources/Public/Icons/Frontend');
}