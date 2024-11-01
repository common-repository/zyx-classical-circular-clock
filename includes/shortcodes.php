<?php /* Shortcodes — Analog to the template tag */ ?>
<?php function the_clocked_time_shortcode( $atts ){
	$args = shortcode_atts( array( 'id' => 'clock' ,
		'width' => '24' , 'height' => '24' ,
		'local' => '0' ,  'hour' => get_the_time('H') , 'minute' => get_the_time('i') , 'second' => get_the_time('s'), 'autoplay'=>'0' ,'hour_cycle' => '12' ,
		'hour_color' => '000000' , 'hour_length' => '60' , 'hour_alpha' => '100' , 'hour_width' => '100' , 'hour_type' => '2' ,
		'minute_color' => '000000' , 'minute_length' => '100' , 'minute_alpha' => '100' , 'minute_width' => '80' , 'minute_type' => '2' ,
		'second_color' => 'FF0000' , 'second_length' => '100' , 'second_alpha' => '100' , 'second_width' => '1' , 'second_type' => '1' ,
		'mark_a_number' => '4' , 'mark_a_color' => '000000' , 'mark_a_length' => '20' , 'mark_a_width' => '4' , 'mark_a_alpha' => '100' ,
		'mark_b_number' => '12' , 'mark_b_color' => '000000' , 'mark_b_length' => '10' , 'mark_b_width' => '2' , 'mark_b_alpha' => '100' ,
		'outline_color' => '000000' , 'outline_alpha' => '100' , 'outline_width' => '1' ,
		'sphere_color' => 'FFFFFF' , 'sphere_alpha' => '100' 
	) , $atts );
	list( $width , $height ) = array( (int)$args['width'] , (int)$args['height'] );
	unset( $args['width'] , $args['height'] );
	$return = the_clocked_time( $width , $height , false , $args );
	return $return;
};
add_shortcode( 'analog_clock' , 'the_clocked_time_shortcode' ); ?>