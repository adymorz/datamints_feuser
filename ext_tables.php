<?php

if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

if (TYPO3_MODE == 'BE') {
	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['tx_datamintsfeuser_pi1_wizicon'] = ExtensionManagementUtility::extPath($_EXTKEY) . 'pi1/class.tx_datamintsfeuser_pi1_wizicon.php';
}

ExtensionManagementUtility::addPlugin(array('LLL:EXT:' . $_EXTKEY . '/locallang_db.xml:tt_content.list_type_pi1', $_EXTKEY . '_pi1', ExtensionManagementUtility::extRelPath($_EXTKEY) . 'ext_icon.gif'), 'list_type');
ExtensionManagementUtility::addStaticFile($_EXTKEY, 'pi1/static/', 'Frontend User Management');

// Salesforce.
ExtensionManagementUtility::addStaticFile($_EXTKEY, 'static/salesforce/', 'Frontend User Management (Salesforce)');

// Flexform anzeigen und die Felder layout, select_key, pages und recursive ausblenden.
$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY . '_pi1'] = 'pi_flexform';
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY . '_pi1'] = 'layout, select_key, pages, recursive';

// Extension Konfiguration auslesen.
$confArray = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]);

// Flexformfunktionen einbinden.
include_once(ExtensionManagementUtility::extPath($_EXTKEY) . 'lib/class.tx_datamintsfeuser_flexform.php');

if ($confArray['enableIrre']) {
	ExtensionManagementUtility::addPiFlexFormValue($_EXTKEY . '_pi1', 'FILE:EXT:' . $_EXTKEY . '/flexform/data_pi1_irre.xml');
} else {
	ExtensionManagementUtility::addPiFlexFormValue($_EXTKEY . '_pi1', 'FILE:EXT:' . $_EXTKEY . '/flexform/data_pi1.xml');
}

// Wenn gewünscht Salesforce verwenden.
if ($confArray['enableSalesforce']) {
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][$_EXTKEY]['sendMail']['salesforce'] = 'EXT:' . $_EXTKEY . '/lib/class.tx_datamintsfeuser_salesforce.php:tx_datamintsfeuser_salesforce->main';
}

$tempColumns = array (
	'gender' => array (
		'exclude' => '1',
		'label' => 'LLL:EXT:datamints_feuser/locallang_db.xml:fe_users.gender',
		'config' => array (
			'type' => 'radio',
			'items' => array (
				array('LLL:EXT:datamints_feuser/locallang_db.xml:fe_users.gender.I.0', '0'),
				array('LLL:EXT:datamints_feuser/locallang_db.xml:fe_users.gender.I.1', '1')
			),
		)
	),
	'tx_datamintsfeuser_approval_level' => array (
		'exclude' => '1',
		'label' => 'LLL:EXT:datamints_feuser/locallang_db.xml:fe_users.tx_datamintsfeuser_approval_level',
		'config' => array (
			'type' => 'input',
			'size' => '2',
			'eval' => 'int',
			'range' => array (
				'upper' => '2',
				'lower' => '0'
			),
			'default' => '0'
		)
	),
);

ExtensionManagementUtility::addTCAcolumns('fe_users', $tempColumns, 1);

ExtensionManagementUtility::addToAllTCAtypes('fe_users', 'gender', '', 'before:name');
ExtensionManagementUtility::addToAllTCAtypes('fe_users', '--div--;LLL:EXT:' . $_EXTKEY . '/locallang_db.xml:tt_content.list_type_pi1, tx_datamintsfeuser_approval_level;;;;1-1-1');
