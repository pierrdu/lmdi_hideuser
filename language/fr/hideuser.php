<?php
/**
 *
 * @package	Extension Hideuser [Français]
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
	'HIDEUSER_MOD_MENU_NAME'			=> 'Masquage d’utilisateurs',
	'ACP_HIDEUSER_TITLE'			=> 'Masquage d’utilisateurs',
	'HIDEUSER_LEGEND'				=> 'Gestion du masquage',

	'ACP_HIDEUSER_CONFIG'			=> 'Configuration de l’extension',
	'HIDEUSER' 					=> 'Masquage d’utilisateurs',
	'HIDEUSER_CONFIG_UPDATED'		=> 'La configuration a été mise à jour.',
	'HU_USERS'					=> 'Utilisateur',
	'HU_ACTIONS'					=> 'Actions',
	'HU_NUMBER'					=> 'Numéro',
	'HU_ADDUSER'					=> 'Ajouter un utilisateur',
	'HU_ADDUSER_LEGEND'				=> 'Addition d’un utilisateur',
	'HU_EDITUSER_LEGEND'			=> 'Édition d’un utilisateur',
	'HU_ENTER_USER'				=> 'Saisissez le nom d’utilisateur',
	'HU_SEARCH_USER'				=> 'Rechercher un utilisateur',
	)
);
