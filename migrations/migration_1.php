<?php
/**
*
* @package phpBB Extension - LMDI hideuser
* @copyright (c) 2016 Pierre Duhem - LMDI
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace lmdi\hideuser\migrations;

// use \phpbb\db\migration\container_aware_migration;


class migration_1 extends \phpbb\db\migration\migration
{

	public function effectively_installed()
	{
		return isset($this->config['lmdi_hideuser']);
	}

	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v310\alpha2');
	}

		public function update_schema()
	{
		return array(
			'add_columns'	=> array(
				$this->table_prefix . 'users' => array(
					'lmdi_hideuser' => array('BOOL', 0),
				),
			),
		);
	}

	public function update_data()
	{
		return array(
			// ACP modules
			array('module.add', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_HIDEUSER_TITLE'
			)),
			array('module.add', array(
				'acp',
				'ACP_HIDEUSER_TITLE',
				array(
					'module_basename'	=> '\lmdi\hideuser\acp\hideuser_module',
					'auth'			=> 'ext_lmdi/hideuser && acl_a_board',
					'modes'			=> array('settings'),
				),
			)),

			// Configuration entries
			array('config.add', array('lmdi_hideuser', 1)),
		);
	}

	public function revert_data()
	{

		return array(
			array('config.remove', array('lmdi_hideuser')),

			array('module.remove', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_HIDEUSER_TITLE'
			)),

		);
	}

	public function revert_schema()
	{
		return array(
			'drop_columns' => array(
				$this->table_prefix . 'users' => array(
					'lmdi_hideuser',
				),
			),
		);
	}

}
