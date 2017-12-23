<?php
/**
 * affiliates-current-url.php
 *
 * This code is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * This header and all notices must be kept intact.
 *
 * @author gtsiokos
 * @package affiliates-current-url
 * @since 1.0.0
 *
 * Plugin Name: Affiliates Current URL
 * Plugin URI: https://github.com/geotsiokos/affiliates-current-url-shortcode
 * Description: Displays the current affiliate URL of the logged in affiliate.
 * Author: gtsiokos
 * Author URI: http://www.netpad.gr/
 * Version: 1.0.0
 */

if ( !defined('ABSPATH' ) ) {
	exit;
}

add_action( 'init', 'gt_current_affiliate_url' );

/**
 * Initializes the shortcode
 */
function gt_current_affiliate_url() {
    if ( defined( 'AFFILIATES_CORE_VERSION' ) ) {
        add_shortcode ( 'affiliates_current_url', 'affiliates_current_url' );
    } 
}

/**
 * Displays the current affiliate URL
 *
 * @param array $atts
 * @return string
 */
function affiliates_current_url( $atts ) {
    $output = '';
    $current_url = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    if ( class_exists( 'Affiliates_Shortcodes' ) ) {
    	if ( Affiliates_Shortcodes::affiliates_id( array() ) != '' ) {
    		$output .= affiliates_get_affiliate_url( $current_url, Affiliates_Shortcodes::affiliates_id( array() ) );
    	}
    }
    return $output;
}
