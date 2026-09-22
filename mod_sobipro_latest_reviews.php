<?php
/**
 * @package    mod_sobipro_latest_reviews
 * @author     F.Yousefi - https://www.asiasun.ir
 * @copyright  (C) 2026 AsiaSun.ir, Pvt. Ltd. All rights reserved
 * @license    GNU/GPL http://www.gnu.org/copyleft/gpl.html
 * @version    2.0.0
 */

defined('_JEXEC') or die;

require_once __DIR__ . '/helper.php';

$reviews = ModSobiproLatestReviewsHelper::getReviews($params);
$moduleclass_sfx = htmlspecialchars((string) $params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');

$document = JFactory::getDocument();
$root = JUri::root();

if (is_file(JPATH_ROOT . '/components/com_komento/themes/kuro/css/style-rtl.css')) {
	$document->addStyleSheet($root . 'components/com_komento/themes/kuro/css/style-rtl.css');
}

if (is_file(JPATH_ROOT . '/media/sobipro/css/review.css')) {
	$document->addStyleSheet($root . 'media/sobipro/css/review.css');
}

$document->addStyleSheet($root . 'modules/mod_sobipro_latest_reviews/asset/css/style.css');

require JModuleHelper::getLayoutPath('mod_sobipro_latest_reviews', $params->get('layout', 'default'));
