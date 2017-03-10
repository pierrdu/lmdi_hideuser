<?php
/**
* @package phpBB Extension - LMDI Hideuser
* @copyright (c) 2017 Pierre Duhem - LMDI
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace lmdi\hideuser\acp;

class hideuser_module {

	public $u_action;
	protected $action;
	protected $table;

	public function main ($id, $mode)
	{
		global $db, $user, $template, $request;

		$user->add_lang_ext ('lmdi/hideuser', 'hideuser');
		$this->tpl_name = 'acp_hideuser_body';
		$this->page_title = $user->lang('ACP_HIDEUSER_TITLE');
		$formkey = 'acp_hideuser';
		add_form_key ($formkey);

		$action = $request->variable ('action', '');

		// Deletion cancelled => plain display of data
		if ($action == 'delete' && $request->is_set_post('cancel'))
		{
			$action = 'display';
		}
		// var_dump ($action);

		switch ($action)
		{
			case 'submituser' :
				if (!check_form_key($formkey))
				{
					trigger_error('FORM_INVALID');
				}
				$username = $request->variable ('username', '');
				$sql = "UPDATE " . USERS_TABLE . " 
						SET lmdi_hideuser = true 
						WHERE username = '$username'";
					$db->sql_query($sql);
				trigger_error($user->lang['HIDEUSER_CONFIG_UPDATED'] . adm_back_link($this->u_action));
			break;
			case 'adduser' :
				$template->assign_vars(array(
					'S_EDIT_PAGE'		=> true,
					'HU_LEGEND'		=> $user->lang('HU_ADDUSER_LEGEND'),
					'U_HU_ADDUSER'		=> $this->u_action . '&amp;action=submituser',
					'U_SEARCH_USER'	=> append_sid ("./../memberlist.php?mode=searchuser&amp;form=select_user&amp;field=username&amp;select_single=true"),
					));
			break;
			/*
			case 'edit' :
				$uid = $request->variable ('id', -1);
				$template->assign_vars(array(
					'S_EDIT_PAGE'		=> true,
					'HU_LEGEND'		=> $user->lang('HU_EDITUSER_LEGEND'),
					));
			break;
			*/
			case 'delete' :
				if (confirm_box(true))
				{
					$uid = $request->variable('uid', -1);
					$sql = 'UPDATE ' . USERS_TABLE . ' 
						SET lmdi_hideuser = false 
						WHERE user_id = ' . $uid;
					$db->sql_query($sql);
					trigger_error($user->lang['HIDEUSER_CONFIG_UPDATED'] . adm_back_link($this->u_action));
				}
				else
				{
					$uid = $request->variable('uid', -1);
					confirm_box(false, $user->lang['CONFIRM_OPERATION'], build_hidden_fields(array(
						'i' => $id,
						'mode' => $mode,
						'action' => $action,
						'uid' => $uid,
						))
					);
				break;
				}
			// break;
			case 'display' :
			default :
				/*
				if (!check_form_key($formkey))
				{
					trigger_error('FORM_INVALID');
				}
				*/
				add_form_key ($formkey);

				$sql = 'SELECT username, user_id FROM ' . USERS_TABLE . ' WHERE lmdi_hideuser = TRUE';
				$result = $db->sql_query($sql);
				$user_list = $db->sql_fetchrowset($result);
				$db->sql_freeresult($result);
				foreach ($user_list as $row)
				{
					$uid = $row['user_id'];
					$template->assign_block_vars('users', array(
						'NAME'		=> $row['username'],
						'ID'			=> $uid,
						'U_MOVE_UP'	=> $this->u_action . '&amp;action=moveup&amp;uid=' . $uid,
						'U_MOVE_DOWN'	=> $this->u_action . '&amp;action=movedn&amp;uid=' . $uid,
						'U_EDIT'		=> $this->u_action . '&amp;action=edit&amp;uid=' . $uid,
						'U_DELETE'	=> $this->u_action . '&amp;action=delete&amp;uid=' . $uid,
					));
				}

				$template->assign_vars(array(
					'F_ACTION'		=> $this->u_action . '&amp;action=display',
					'U_HU_ADDUSER'		=> $this->u_action . '&amp;action=adduser',
					'S_CONFIG_PAGE'	=> true,
					));

				// trigger_error($user->lang['LOG_HIDEUSER_CONFIG_UPDATED'] . adm_back_link($this->u_action));
			break;
		}

	}

}
