<?php
/**
 *
 * @package	Extension hideuser [English]
 * @author	Pierre Duhem <pierre@duhem.com>
 * (c) 2017 - LMDI Pierre duhem
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

	'ACP_HIDEUSER_TITLE'			=> 'User hide',
	'HIDEUSER_LEGEND'				=> 'Management of hidden users',

	'ACP_HIDEUSER_CONFIG'			=> 'Extension configuration',
	'HIDEUSER' 					=> 'User hide',
	'HIDEUSER_CONFIG_UPDATED'		=> 'The configuration was successfully updated.',
	'HU_USERS'					=> 'User',
	'HU_ACTIONS'					=> 'Actions',
	'HU_NUMBER'					=> 'Id',
	'HU_ADDUSER'					=> 'Add an user',
	'HU_ADDUSER_LEGEND'				=> 'Hiding of a new user',
	'HU_EDITUSER_LEGEND'			=> 'Edition of an user',
	'HU_ENTER_USER'				=> 'Type the user name',
	'HU_SEARCH_USER'				=> 'Search for an user',

	)
);
