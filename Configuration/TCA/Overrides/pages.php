<?php
defined('TYPO3_MODE') || die();

$conf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['jst_onepage']);

if ($conf['use_pagetree_icons']) {
	
	// Inject new page icons
	\TYPO3\CMS\Core\Utility\ArrayUtility::mergeRecursiveWithOverrule(
		$GLOBALS['TCA']['pages'], ['ctrl' => ['typeicon_classes' => [
			'userFunc' => \Josta\JstOnepage\Hook\OnepageHooks::class . '->getPageIcon'
		]]]
	);
	
}

