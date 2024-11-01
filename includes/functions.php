<?php /* Some overall functions — Template tag & so */ ?>
<?php function the_clocked_time( $width = '16' , $height = '16' , $echo = true , $args = NULL ){
	global $post;
	$args = wp_parse_args( $args , array( 'id' => 'flash_clock' ,/**/
		'hour' => get_the_time( 'H' ) , 'minute' => get_the_time( 'i' ) , 'second' => get_the_time('s') , 'hour_cycle' => '12' ,
		'hour_color' => 'FF0000' , 'hour_alpha' => '100' , 'hour_length' => '60' , 'hour_width' => '100' , 'hour_type' => '2' ,
		'minute_color' => 'CC0000' , 'minute_alpha' => '100' , 'minute_length' => '100' , 'minute_width' => '80' , 'minute_type' => '2' ,
		'second_color' => '000000' , 'second_alpha' => '050' , 'second_length' => '100' , 'second_width' => '10' , 'second_type' => '2' ,
		'mark_a_number' => '4' , 'mark_a_color' => 'FF0000' , 'mark_a_length' => '15' , 'mark_a_width' => '3' , 'mark_a_alpha' => '100' ,
		'mark_b_number' => '12' , 'mark_b_color' => 'C00000' , 'mark_b_length' => '5' , 'mark_b_width' => '1' , 'mark_b_alpha' => '100' ,
		'outline_color' => '000000' , 'outline_alpha' => '100' , 'outline_width' => '1' ,
		'sphere_color' => 'FFFFFF' , 'sphere_alpha' => '100' 
		, 'local' => '0' , 'autoplay'=> '0'
	) );
	$flash_args = array(
		'hOff' =>  $args['hour'] , 'mOff' => $args['minute'] , 'sOff' => $args['second'] ,
		'hColor' => $args['hour_color'] , 'hAlpha' => $args['hour_alpha'] , 'hLength' => $args['hour_length'] , 'hWidth' => $args['hour_width'] , 'hType' => $args['hour_type'] ,
		'mColor' => $args['minute_color'] , 'mAlpha' => $args['minute_alpha'] , 'mLength' => $args['minute_length'] , 'mWidth' => $args['minute_width'] , 'mType' => $args['minute_type'] ,
		'sColor' => $args['second_color'] , 'sAlpha' => $args['second_alpha'] , 'sLength' => $args['second_length'] , 'sWidth' => $args['second_width'] , 'sType' => $args['second_type'] ,
		'mpNumber' => $args['mark_a_number'] , 'mpColor' => $args['mark_a_color'] , 'mpAlpha' => $args['mark_a_alpha'] ,
		'mpLength' => $args['mark_a_length'] , 'mpWidth' => $args['mark_a_width'] ,
		'msNumber' => $args['mark_b_number'] , 'msColor' => $args['mark_b_color'] , 'msAlpha' => $args['mark_b_alpha'] ,
		'msLength' => $args['mark_b_length'] , 'msWidth' => $args['mark_b_width'] ,
		'eColor' => $args['sphere_color'] , 'eAlpha' => $args['sphere_alpha'] , 'hCycle' => $args['hour_cycle'] ,
		'oColor' => $args['outline_color'] , 'oAlpha' => $args['outline_alpha'] , 'oWidth' => $args['outline_width']
		, 'local' => $args['local'] , 'autoplay' => $args['autoplay'] 
	);
	$f_vars = zyx_join_flashvars( $flash_args );
	$the_tag = zyx_Hixie_flash( WP_PLUGIN_URL . '/' . dirname( plugin_basename( __FILE__ ) ) . '/analog_clock.swf' ,
		$width , $height , 
		array( 'flashvars' => $f_vars , 'wmode' => 'transparent' , 'align' => 'center' , 'scale' => 'exactfit' ) ,
		$args['id']
	);
	
	$the_tag = '<div class="zyx_analog_clock_tag">' . $the_tag . '</div>';
	if( $echo ) echo $the_tag;
	return $the_tag;
}; ?>