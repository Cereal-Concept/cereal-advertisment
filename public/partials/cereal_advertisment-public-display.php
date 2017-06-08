<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://www.cerealconcept.com
 * @since      1.0.0
 *
 * @package    Cereal_advertisment
 * @subpackage Cereal_advertisment/public/partials
 */
?>

<?php 
/* Campagnes pub */
$today = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
$args_campagnes = array(
	'post_type' => 'campagnes',
	'posts_per_page' => -1,
	// 'meta_query' => array(
	// 	array(
	// 		'key' => 'cc_date-debut',
	// 		'value' => $today,
	// 		'compare' => '<=',
	// 	),
	// 	array(
	// 		'key' => 'cc_date-fin',
	// 		'value' => $today,
	// 		'compare' => '>=',
	// 	),
	// ),
);
$campagnes = get_posts($args_campagnes);

if (isset($campagnes) && is_array($campagnes)) { ?>

<section class="zone-pub">
	<div class="slider-pub" id="slider1">
		<?php
		// var_dump($campagnes);
		foreach ($campagnes as $campagne) {
			$meta_campagne = get_post_meta($campagne->ID);

			$img728ID = !empty($meta_campagne['cc_img-campagne-728']) ? maybe_unserialize($meta_campagne['cc_img-campagne-728'][0]) : '';
			$img728URL = "";
			$img728SRC = "";
			if (!empty($img728ID)) {
				$img728SRC = wp_get_attachment_image_src($img728ID, "large");
				if (!empty($img728SRC)) {
					$img728URL = $img728SRC[0];
				}
			}

			$img468ID = !empty($meta_campagne['cc_img-campagne-468']) ? maybe_unserialize($meta_campagne['cc_img-campagne-468'][0]) : '';
			$img468URL = "";
			$img468SRC = "";
			if (!empty($img468ID)) {
				$img468SRC = wp_get_attachment_image_src($img468ID, "large");
				if (!empty($img468SRC)) {
					$img468URL = $img468SRC[0];
				}
			}

			$img250ID = !empty($meta_campagne['cc_img-campagne-250']) ? maybe_unserialize($meta_campagne['cc_img-campagne-250'][0]) : '';
			$img250URL = "";
			$img250SRC = "";
			if (!empty($img250ID)) {
				$img250SRC = wp_get_attachment_image_src($img250ID, "large");
				if (!empty($img250SRC)) {
					$img250URL = $img250SRC[0];
				}
			}
			
			$url = !empty($meta_campagne['cc_url-campagne']) ? maybe_unserialize($meta_campagne['cc_url-campagne'][0]) : '#';
			$duree = !empty($meta_campagne['cc_number-duree-animation']) ? maybe_unserialize($meta_campagne['cc_number-duree-animation'][0]) : '';

			/* FLAGS */
			$FLAG_728 = false;
			$FLAG_468 = false;
			$FLAG_250 = false;

			if (!empty($img728URL)) {
				$FLAG_728 = true;
			}
			if (!empty($img468URL)) {
				$FLAG_468 = true;
			}
			if (!empty($img250URL)) {
				$FLAG_250 = true;
			}
			?>
			<div class="slider-pub-slide" data-duree="<?php echo $duree; ?>">
				<a href="<?php echo $url; ?>" class="no-link" target="_blank">
					<picture>
						<?php if ($FLAG_250) { ?><source srcset="<?php echo $img250URL; ?>" media="(max-width: 500px)"><?php } ?>
						<?php if ($FLAG_468) { ?><source srcset="<?php echo $img468URL; ?>" media="(max-width: 767px)"><?php } ?>
						<?php if ($FLAG_728) { ?><source srcset="<?php echo $img728URL; ?>" media="(min-width: 768px)"><?php } ?>
					    <img src="<?php if ($FLAG_728) { echo $img728URL; } elseif($FLAG_468) { echo $img468URL; } else { echo $img250URL; } ?>" alt="<?php bloginfo("description"); ?>">
					</picture>
				</a>
			</div>
			<?php
		}
		?>
	</div>
</section>

<?php } ?>