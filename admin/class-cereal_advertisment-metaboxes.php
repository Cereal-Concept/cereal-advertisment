<?php

/**
 * The registering of the Meta Boxes
 *
 * @link       http://www.cerealconcept.com
 * @since      1.0.0
 *
 * @package    Cereal_advertisment
 * @subpackage Cereal_advertisment/metaboxes
 */

/**
 * Dependant of Meta Box plugin
 *
 *
 * @package    Cereal_advertisment
 * @subpackage Cereal_advertisment/metaboxes
 * @author     Cereal Concept <contact@cerealconcept.com>
 */
class Cereal_advertisment_Metaboxes {

	/**
	 * Register metaboxes
	 * @return $meta_boxes
	 * @since  1.0
	 */
	public function register_metaboxes( $meta_boxes ) {

		$prefix = 'cc_';

		$meta_boxes[] = array(
			'id'         => 'informations',
			'title'      => __( 'Détails de la campange', 'meta-box' ),
			'post_types' => array( 'campagnes' ),
			'context'    => 'normal',
			'priority'   => 'high',
			'autosave'   => true,

			'fields'     => array(
				// Image Campagne
				array(
					'name'             => esc_html__( 'Bannière campagne 1', 'esquisse' ),
					'id'               => "{$prefix}img-campagne-728",
					'desc'			   => "Format : 728x90",
					'type'             => 'image_advanced',
					'max_file_uploads' => 1,
				),
				array(
					'name'             => esc_html__( 'Bannière campagne 2', 'esquisse' ),
					'id'               => "{$prefix}img-campagne-468",
					'desc'			   => "Format : 468x60",
					'type'             => 'image_advanced',
					'max_file_uploads' => 1,
				),
				array(
					'name'             => esc_html__( 'Bannière campagne 3', 'esquisse' ),
					'id'               => "{$prefix}img-campagne-250",
					'desc'			   => "Format : 250x300",
					'type'             => 'image_advanced',
					'max_file_uploads' => 1,
				),
				array(
					'type' => 'divider',
				),
				array(
					'name' => esc_html__( 'URL', 'esquisse' ),
					'id'   => "{$prefix}url-campagne",
					'type' => 'url',
				),
				array(
					'name' => esc_html__( 'Durée de l\'animation (millisecondes)', 'esquisse' ),
					'id'   => "{$prefix}number-duree-animation",
					'type' => 'number',
					'min'  => 0,
					'step' => 1,
				),
				// DATE
				array(
					'name'       => esc_html__( 'Date de début de la campagne', 'esquisse' ),
					'id'         => "{$prefix}date-debut",
					'type'       => 'date',
					'timestamp'  => true,
					// jQuery date picker options. See here http://api.jqueryui.com/datepicker
					'js_options' => array(
						'appendText'      => esc_html__( '(dd-mm-yyyy)', 'esquisse' ),
						'dateFormat'      => esc_html__( 'dd-mm-yy', 'esquisse' ),
						'changeMonth'     => true,
						'changeYear'      => true,
						'showButtonPanel' => true,
					),
				),
				// DATE
				array(
					'name'       => esc_html__( 'Date de fin de la campagne', 'esquisse' ),
					'id'         => "{$prefix}date-fin",
					'type'       => 'date',
					'timestamp'  => true,
					// jQuery date picker options. See here http://api.jqueryui.com/datepicker
					'js_options' => array(
						'appendText'      => esc_html__( '(dd-mm-yyyy)', 'esquisse' ),
						'dateFormat'      => esc_html__( 'dd-mm-yy', 'esquisse' ),
						'changeMonth'     => true,
						'changeYear'      => true,
						'showButtonPanel' => true,
					),
				),
	        ),
	    );

	return $meta_boxes;
	
	}
}
