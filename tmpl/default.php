<?php
/**
 * @package    mod_sobipro_latest_reviews
 * @author     F.Yousefi - https://www.asiasun.ir
 * @copyright  (C) 2026 AsiaSun.ir, Pvt. Ltd. All rights reserved
 * @license    GNU/GPL http://www.gnu.org/copyleft/gpl.html
 * @version    2.0.0
 */

defined('_JEXEC') or die;

$showUser = (string) $params->get('userName', '1') === '1';
$showTitle = (string) $params->get('articleTitle', '1') === '1';
$showAvatar = (string) $params->get('avatar', '1') === '1';
$showStars = (string) $params->get('starsShow', '1') === '1';
$showTime = (string) $params->get('showTime', '1') === '1';
$useUsername = (string) $params->get('userWhat', '0') === '0';
$reviewLimit = (int) $params->get('reviewWordsCount', 20);
$titleLimit = (int) $params->get('articleTitleWordsCount', 5);
$fontSize = ModSobiproLatestReviewsHelper::fontSize($params->get('userFontSize', 0));
$avatarWidth = ModSobiproLatestReviewsHelper::avatarWidth($params->get('avatarSize', 0));
?>
<div id="section-kmt" class="mod-sobipro-latest-reviews<?php echo $moduleclass_sfx ? ' ' . $moduleclass_sfx : ''; ?>">
	<?php foreach ($reviews as $info) : ?>
		<div class="splr-item">
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<?php if ($showAvatar) : ?>
					<div style="float: left;">
						<img src="<?php echo htmlspecialchars(ModSobiproLatestReviewsHelper::getAvatarUrl($info->uid), ENT_COMPAT, 'UTF-8'); ?>" alt="" style="width: <?php echo (int) $avatarWidth; ?>px" />
					</div>
				<?php endif; ?>

				<?php if ($showUser) : ?>
					<div style="float: right;">
						<p class="kmt-author">
							<?php if ((int) $info->uid !== 0) : ?>
								<a href="<?php echo htmlspecialchars(ModSobiproLatestReviewsHelper::getProfileUrl($info->uid), ENT_COMPAT, 'UTF-8'); ?>" title="">
							<?php endif; ?>
							<span style="font-size: <?php echo (float) $fontSize; ?>px">
								<?php
								if ((int) $info->uid === 0) {
									echo 'مهمان - ';
								}
								if ((int) $info->uid !== 0 && $useUsername) {
									echo htmlspecialchars(ModSobiproLatestReviewsHelper::getUsername($info->uid), ENT_COMPAT, 'UTF-8');
								} else {
									echo htmlspecialchars((string) $info->uName, ENT_COMPAT, 'UTF-8');
								}
								?>
							</span>
							<?php if ((int) $info->uid !== 0) : ?>
								</a>
							<?php endif; ?>
						</p>
					</div>
				<?php endif; ?>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<?php if ($showStars) : ?>
					<div class="SobiPro" style="float: left; margin-top: 4px;">
						<div style="margin-right: 0;" class="rating-stars-<?php echo (int) round($info->oar); ?>"></div>
					</div>
				<?php endif; ?>
			</div>

			<div class="clearfix"></div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="review-text">
					<?php echo nl2br(htmlspecialchars((string) $info->review, ENT_COMPAT, 'UTF-8')); ?>
					<?php if ((int) $info->reviewCount > $reviewLimit) : ?>
						...
					<?php endif; ?>
				</div>
			</div>

			<div class="clearfix"></div>

			<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
				<?php if ($showTitle) : ?>
					<h5>
						<a class="article-title" href="<?php echo htmlspecialchars(ModSobiproLatestReviewsHelper::getGameUrl($info->sid), ENT_COMPAT, 'UTF-8'); ?>">
							<?php echo htmlspecialchars((string) $info->title, ENT_COMPAT, 'UTF-8'); ?>
							<?php if ((int) $info->titleCount > $titleLimit) : ?>
								...
							<?php endif; ?>
						</a>
					</h5>
				<?php endif; ?>
			</div>

			<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
				<?php if ($showTime) : ?>
					<div class="datetime">
						<span class="kmt-time" style="direction: ltr; display: inline;">
							<?php echo JHtml::_('date', $info->rDate, 'Y-m-d H:i:s'); ?>
						</span>
					</div>
				<?php endif; ?>
			</div>
		</div>
	<?php endforeach; ?>
</div>
