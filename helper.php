<?php
/**
 * @package    mod_sobipro_latest_reviews
 * @author     F.Yousefi - https://www.asiasun.ir
 * @copyright  (C) 2026 AsiaSun.ir, Pvt. Ltd. All rights reserved
 * @license    GNU/GPL http://www.gnu.org/copyleft/gpl.html
 * @version    2.0.0
 */

defined('_JEXEC') or die;

class ModSobiproLatestReviewsHelper
{
	public static function getReviews($params)
	{
		$db = JFactory::getDbo();
		$reviewWords = max(1, (int) $params->get('reviewWordsCount', 20));
		$titleWords = max(1, (int) $params->get('articleTitleWordsCount', 5));
		$limit = max(1, (int) $params->get('reviewsCount', 3));
		$titleFieldId = max(1, (int) $params->get('title_field_id', 1));

		$query = $db->getQuery(true)
			->select(array(
				'a.rid',
				'a.sid',
				'a.rDate',
				'a.uid',
				'a.uName',
				'a.oar',
				'b.baseData',
				'SUBSTRING_INDEX(a.rReview, ' . $db->quote(' ') . ', ' . $reviewWords . ') AS review',
				'SUBSTRING_INDEX(b.baseData, ' . $db->quote(' ') . ', ' . $titleWords . ') AS title',
				'(LENGTH(b.baseData) - LENGTH(REPLACE(b.baseData, ' . $db->quote(' ') . ', ' . $db->quote('') . ')) + 1) AS titleCount',
				'(LENGTH(a.rReview) - LENGTH(REPLACE(a.rReview, ' . $db->quote(' ') . ', ' . $db->quote('') . ')) + 1) AS reviewCount',
			))
			->from($db->quoteName('#__sobipro_sprr_review', 'a'))
			->join('INNER', $db->quoteName('#__sobipro_field_data', 'b') . ' ON a.sid = b.sid')
			->where('a.state = 1')
			->where('b.fid = ' . $titleFieldId)
			->group('a.rid')
			->order('a.rid DESC');

		$db->setQuery($query, 0, $limit);

		$items = $db->loadObjectList();

		return is_array($items) ? $items : array();
	}

	public static function getAvatar($userId)
	{
		$userId = (int) $userId;

		if ($userId <= 0) {
			return null;
		}

		$db = JFactory::getDbo();
		$query = $db->getQuery(true)
			->select($db->quoteName('avatar'))
			->from($db->quoteName('#__comprofiler'))
			->where($db->quoteName('user_id') . ' = ' . $userId);
		$db->setQuery($query);

		return $db->loadResult();
	}

	public static function getAvatarUrl($userId)
	{
		$default = JUri::root() . 'components/com_comprofiler/plugin/templates/dark/images/avatar/tnnophoto_n.png';

		if ((int) $userId <= 0) {
			return $default;
		}

		$img = self::getAvatar($userId);

		if ($img === null || $img === '') {
			return $default;
		}

		if (strpos($img, 'gallery/') === false) {
			$img = 'tn' . $img;
		}

		return JUri::root() . 'images/comprofiler/' . $img;
	}

	public static function getUsername($userId)
	{
		$userId = (int) $userId;

		if ($userId <= 0) {
			return '';
		}

		$db = JFactory::getDbo();
		$query = $db->getQuery(true)
			->select($db->quoteName('username'))
			->from($db->quoteName('#__users'))
			->where($db->quoteName('id') . ' = ' . $userId);
		$db->setQuery($query);

		return (string) $db->loadResult();
	}

	public static function getEntryAlias($sid)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true)
			->select($db->quoteName('nid'))
			->from($db->quoteName('#__sobipro_object'))
			->where($db->quoteName('id') . ' = ' . (int) $sid);
		$db->setQuery($query);

		return (string) $db->loadResult();
	}

	public static function getGameUrl($sid)
	{
		$alias = self::getEntryAlias($sid);

		return JUri::root() . 'game-profile/' . (int) $sid . '-' . $alias;
	}

	public static function getProfileUrl($userId)
	{
		return JUri::root() . 'profile/userprofile/' . (int) $userId;
	}

	public static function fontSize($value)
	{
		$map = array(0 => 10.5, 1 => 11.5, 2 => 12.5, 3 => 14.5);

		return isset($map[(int) $value]) ? $map[(int) $value] : 10.5;
	}

	public static function avatarWidth($value)
	{
		$map = array(0 => 20, 1 => 30, 2 => 40, 3 => 50);

		return isset($map[(int) $value]) ? $map[(int) $value] : 20;
	}
}
