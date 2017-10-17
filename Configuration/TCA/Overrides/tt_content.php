<?php
defined('TYPO3_MODE') || die ();

$conf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['jst_onepage']);

if ($conf['add_content_fields']) {

	// define new content element fields
	$ll = 'LLL:EXT:jst_onepage/Resources/Private/Language/locallang.xlf:tt_content.fields.';
	$fields = [
		'jst_onepage_alignment' => [
			'exclude' => 0,
			'label' => $ll.'alignment',
			'config' => [
					'type' => 'select',
					'renderType' => 'selectSingle',
					'items' => [
							[$ll.'alignment.opt.left', 'left'],
							[$ll.'alignment.opt.center', 'center'],
							[$ll.'alignment.opt.right', 'right'],
							[$ll.'alignment.opt.justify', 'justify'],
					],
					'maxitems' => 1,
			]
		],
		'jst_onepage_size' => [
			'exclude' => 0,
			'label' => $ll.'size',
			'config' => [
					'type' => 'select',
					'renderType' => 'selectSingle',
					'items' => [
							[$ll.'size.opt.xs', 'xs'],
							[$ll.'size.opt.s', 's'],
							[$ll.'size.opt.m', 'm'],
							[$ll.'size.opt.l', 'l'],
							[$ll.'size.opt.xl', 'xl'],
							[$ll.'size.opt.xxl', 'xxl'],
							[$ll.'size.opt.full', 'full']
					],
					'maxitems' => 1,
			]
		],
		'jst_onepage_animate' => [
			'exclude' => 0,
			'label' => $ll.'animate',
			'config' => [
					'type' => 'select',
					'renderType' => 'selectSingle',
					'items' => [
							[$ll.'animate.opt.none', 'none'],
							[$ll.'animate.opt.left', 'left'],
							[$ll.'animate.opt.right', 'right'],
							[$ll.'animate.opt.bottom', 'bottom'],
							[$ll.'animate.opt.blend', 'blend'],
							[$ll.'animate.opt.auto', 'auto']
					],
					'maxitems' => 1,
			]
		],
	];

	// register fields
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $fields);

	// add the fields to frames palette
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
		'tt_content', 'frames', 'jst_onepage_size,jst_onepage_alignment, jst_onepage_animate');
	
}