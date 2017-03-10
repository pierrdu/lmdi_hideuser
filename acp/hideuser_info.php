<?php
/**
*
* @package phpBB Extension - LMDI Hideuser
* @copyright (c) 2017 Pierre Duhem - LMDI
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace lmdi\hideuser\acp;

class hideuser_info
{
	function module()
	{
		return array(
			'filename'	=> '\lmdi\hideuser\acp\hideuser_module',
			'title'		=> 'ACP_HIDEUSER_TITLE',
			'version'		=> '1.0.0',
			'modes'		=> array (
				'settings' => array('title' => 'ACP_HIDEUSER_CONFIG',
					'auth' => 'ext_lmdi/hideuser && acl_a_board',
					'cat' => array('ACP_HIDEUSER_TITLE')),
			),
		);
	}
}
