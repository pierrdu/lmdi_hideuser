<?php
/**
*
* @package phpBB Extension - LMDI Hideuser extension
* @copyright (c) 2017 LMDI - Pierre Duhem
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace lmdi\hideuser\event;

/**
* @ignore
*/
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
	protected $user;
	protected $auth;
	protected $request;


	public function __construct(
		\phpbb\user $user,
		\phpbb\auth\auth $auth,
		\phpbb\request\request $request
		)
	{
		$this->user = $user;
		$this->auth = $auth;
		$this->request = $request;
	}


	static public function getSubscribedEvents ()
	{
	return array(
		'core.user_setup'					=> 'load_language_on_setup',
		'core.viewforum_modify_topics_data'	=> 'modify_topics_data',
		'core.viewtopic_modify_post_data'		=> 'modify_post_data',
		);
	}


	public function load_language_on_setup($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'lmdi/hideuser',
			'lang_set' => 'hideuser',
			);
		$event['lang_set_ext'] = $lang_set_ext;
	}

	/**
	* Modify topics data before we display the viewforum page
	*
	* @event core.viewforum_modify_topics_data
	* @var	array	topic_list		Array with current viewforum page topic ids
	* @var	array	rowset			Array with topics data (in topic_id => topic_data format)
	* @var	int		total_topic_count	Forum's total topic count
	* @var	int		forum_id			Forum identifier
	* @since 3.1.0-b3
	* @changed 3.1.11-RC1 Added forum_id
	*/
	public function modify_topics_data ($event)
	{
		$fid = $this->request->variable ('f', 0);
		$auto = $this->test_auth ($fid);
		if (!$auto)
		{
			$topic_list = $event['topic_list'];
			$total_topic_count = $event['total_topic_count'];
			$rowset = $event['rowset'];
			$nb = count ($topic_list);
			for ($i = 0; $i < $nb; $i++)
			{
				$topic = $topic_list[$i];
				$row = $rowset[$topic];
				$titre  = $row['topic_title'];
				$numaut = $row['topic_poster'];
				$auteur = $row['topic_first_poster_name'];
				if ($numaut == 4198)
				{
					unset ($rowset[$topic]);
					unset ($topic_list[$i]);
					$total_topic_count--;
				}
			}
			$event['topic_list'] = $topic_list;
			$event['rowset'] = $rowset;
			$event['total_topic_count'] = $total_topic_count;
		}
	}


	/**
	* Event to modify the post, poster and attachment data before assigning the posts
	*
	* @event core.viewtopic_modify_post_data
	* @var	int		forum_id	Forum ID
	* @var	int		topic_id	Topic ID
	* @var	array	topic_data	Array with topic data
	* @var	array	post_list	Array with post_ids we are going to display
	* @var	array	rowset		Array with post_id => post data
	* @var	array	user_cache	Array with prepared user data
	* @var	int		start		Pagination information
	* @var	int		sort_days	Display posts of previous x days
	* @var	string	sort_key	Key the posts are sorted by
	* @var	string	sort_dir	Direction the posts are sorted by
	* @var	bool	display_notice		Shall we display a notice instead of attachments
	* @var	bool	has_approved_attachments	Does the topic have approved attachments
	* @var	array	attachments	List of attachments post_id => array of attachments
	* @var	array	permanently_banned_users	List of permanently banned users
	* @var	array	can_receive_pm_list		Array with posters that can receive pms
	* @since 3.1.0-RC3
	*/
	public function modify_post_data ($event)
	{
		$fid = $this->request->variable ('f', 0);
		$auto = $this->test_auth ($fid);
		if (!$auto)
		{
			$post_list = $event['post_list'];
			$rowset = $event['rowset'];
			$nb = count ($post_list);
			for ($i = 0; $i < $nb; $i++)
			{
				$post = $post_list[$i];
				$row = $rowset[$post];
				$hide_post  = $row['hide_post'];
				$numaut = $row['user_id'];
				$auteur = $row['username'];
				if ($numaut == 4198)
				{
					$row['hide_post'] = true;
					unset ($post_list[$i]);
					$rowset[$post] = $row;
				}
			}
			$event['rowset'] = $rowset;
		}
	}


	private function test_auth ($fid)
	{
		$auto = $this->auth->acl_get('m_', $fid);
		$auto += $this->auth->acl_get('a_', $fid);
		return ($auto);
	}
}
