<?php if ( !function_exists( 'zyx_Hixie_flash' ) ){
function zyx_Hixie_flash( $src , $width = '100%' , $height = '100%' , $args = NULL , $id = 'flash_movie' ){ /* add the tags for a hixie-method embedded flash
* params: any number. Required: width, height, src
* ToDo: Add the alternative content parameter
*/
/*
classid (outer object element only, value is always clsid:D27CDB6E-AE6D-11cf-96B8-444553540000) 
type (inner object element only, value is always application/x-shockwave-flash) 
data (inner object element only, defines the URL of a SWF) 
width (both object elements, defines the width of a SWF) 
height (both object elements, defines the height of a SWF)
*/
	$params = '';
	foreach( $args as $param => $param_val ){
		$params .= "\t" . '<param name="' . esc_attr( $param ) . '"';
		$params .= ' value="' . $param_val . '" />' . "\n";
	};
	$tag = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" ';
	$tag .= ' width="' . $width . '" height="' . $height . '"' . ' id="' . $id . '" >' . "\n";
	$tag .= "\t" . '<param name="movie" value="' . esc_url( $src ) .'" />'."\n";
	$tag .= $params;
	$tag .= "\t" . '<!--[if !IE]>-->' . "\n";
	$tag .= "\t" . '<object type="application/x-shockwave-flash" ';
	$tag .= ' id="' . $id . '"';
	$tag .= ' data="' . esc_url( $src ) . '" width="' . $width . '" height="' . $height . '" >' . "\n";
	$tag .= $params;
	$tag .= "\t" . '<!--<![endif]-->' . "\n";
	$tag .= "\t" . "Alternative content" . "\n";
	$tag .= "\t" . '<!--[if !IE]>-->' . "\n";
	$tag .= "\t" . '</object>' . "\n";
	$tag .= "\t" . '<!--<![endif]-->' . "\n";
	$tag .= "\t" . '</object>'."\n";
	return $tag;
};
}; ?>
<?php if ( !function_exists( 'zyx_join_flashvars' ) ){
function zyx_join_flashvars( $args ){
	list( $params ) = array( array() );
	foreach( $args as $param => $param_val ){
		$params[] = esc_attr( (string)$param ) . '=' . esc_attr( (string)$param_val );
	};
	$ret_val = implode( '&' , $params );
	$ret_val = apply_filters( 'zyx_join_flashvars' , implode( '&' , $params ) , $args );
	return $ret_val;
};
};?>