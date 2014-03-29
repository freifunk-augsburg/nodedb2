<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Comuno.' . $_EXTKEY,
	'Nodedb2',
	array(
		'Node' => 'list, show, new, create, edit, update, delete',
		
	),
	// non-cacheable actions
	array(
		'Node' => 'create, update, delete, edit',
		
	)
);

?>
