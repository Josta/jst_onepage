<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'JST Onepage',
    'description' => 'Onepage themes made easy in TYPO3.',
    'category' => 'templates',
    'author' => 'Josua Stabenow',
    'author_email' => 'josua.stabenow@gmx.de',
    'author_company' => 'private',
    'shy' => '',
    'dependencies' => 'vhs,realurl',
    'conflicts' => '',
    'priority' => '',
    'module' => '',
    'state' => 'stable',
    'internal' => '',
    'uploadfolder' => 0,
    'createDirs' => '',
    'modify_tables' => '',
    'clearCacheOnLoad' => 1,
    'lockType' => '',
    'version' => '1.0',
    'constraints' => [
        'depends' => [
            'typo3' => '8.7.4-8.7.99',
            'vhs' => '',
			'realurl' => ''
        ],
        'conflicts' => [],
        'suggests' => [
			'bootstrap_package' => '',
			'fluid_styled_content' => '',
			'jst_assets' => '',
		]
    ]
];
