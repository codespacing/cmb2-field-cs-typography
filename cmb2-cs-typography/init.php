<?php

/**
 * Plugin Name: CMB2 CS Typography Field
 * Plugin URI: 
 * Description: Typography field type for CMB2
 * Version: 1.0
 * Author: Hicham Radi (CodeSpacing)
 * Author URI: https://www.codespacing.com/
 */

function cmb2_init_cs_typography_field() {
	
	require_once dirname( __FILE__ ) . '/cmb2-cs-typography.php';

}

add_action('cmb2_init', 'cmb2_init_cs_typography_field');
