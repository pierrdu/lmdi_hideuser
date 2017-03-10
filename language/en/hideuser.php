<?php
/**
 *
 * @package	Extension hideuser [English]
 * @author	Pierre Duhem <pierre@duhem.com>
 * (c) 2016-2017 - LMDI Pierre duhem
 *
 **/

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}
$lang = array_merge($lang, array(

	'AUTOLINK_MOD_MENU_NAME'			=> 'Extension hideuser',
	'ACP_hideuser_TITLE'			=> 'Alphabetical sort of topics',
	'hideuser_LEGEND3'				=> 'Selection of forums with topic sorting',
	'hideuser_NOSHOW_LIST'			=> 'Enable sort',

	'ACP_hideuser_CONFIG'			=> 'Extension configuration',
	'hideuser' 					=> 'Sort topics',
	'ALL_TOPICS' 					=> 'No sorting',
	'LOG_hideuser_CONFIG_UPDATED'	=> 'The configuration was successfully updated.',
	)
);
