<?php /* The Analog clock widget — Class & registering */

class zyx_analog_clock extends WP_Widget {

	function zyx_analog_clock(){
		$widget_ops = array( 'classname' => 'zyx_analog_clock' , 'description' => __( 'Simple and configurable Flash clock' , 'zyx-analog-clock' ) ,
			'title'=>__( 'Clock' , 'zyx-analog-clock' ) , 'width' => 100 , 'height' => 100
			, 'hColor' => '000000' , 'hAlpha' => 100 , 'hLength'=>60 , 'hWidth'=> 12.5 , 'hType' => 1
			, 'mColor' => '000000', 'mAlpha' => 100 , 'mLength' => 100 , 'mWidth' => 100 , 'mType' => 1
			, 'sColor' => '000000', 'sAlpha'=> 100 , 'sLength'=> 100 , 'sWidth'=> 100 , 'sType' => 2
			, 'mpNumber' => 12 , 'mpColor' => '000000' , 'mpLength' => 15 , 'mpWidth' => 0.5 , 'mpAlpha' => 100 ,
			'msNumber' => 60 , 'msColor' => '000000' , 'msLength' => 5 , 'msWidth' => 0.5 , 'msAlpha' => 100 ,
			'eColor' => 'FFFFFF' , 'eAlpha' => 100 , 'hCycle' => 12 ,
			'oColor' => '000000' , 'oAlpha' => 100 , 'oWidth' => 1
		);
		$control_ops=array('width'=>'450');
		$this->WP_Widget( 'zyx_analog_clock' , __( 'ZYX Analog Clock' , 'zyx-analog-clock' ), $widget_ops, $control_ops);
	}

	function widget( $args , $instance ){
		extract( $args );
		$title = apply_filters( 'widget_title' , empty($instance['title']) ? '' : $instance['title'] );
		if ($before_widget) {echo $before_widget;};
			if($title){ echo $before_title.$title.$after_title;};
		$the_tag = zyx_Hixie_flash( WP_PLUGIN_URL . '/' . dirname( plugin_basename( __FILE__ ) ) . '/analog_clock.swf'
			, $instance['width'] . 'px' , $instance['height'] . 'px'
			, array( 'flashvars' => $this->get_flashvars( $instance ) , 'wmode' => 'transparent' , 'align' => 'center' , 'scale' => 'exactfit'
		) );
		echo '<div class="widget_content wrap">';
		echo $the_tag;
		echo "</div>";
		echo $after_widget;
	}

	function get_flashvars( $args ){
		$str_vars = array();
		$var_list = array( 'hColor' , 'hAlpha' , 'hLength' , 'hWidth' , 'hType' ,
			'mColor' , 'mAlpha' , 'mLength' , 'mWidth' , 'mType' ,
			'sColor' , 'sAlpha' , 'sLength' , 'sWidth' , 'sType' ,
			'mpNumber' , 'mpColor' , 'mpAlpha' , 'mpLength' , 'mpWidth' ,
			'msNumber' , 'msColor' , 'msAlpha' , 'msLength' , 'msWidth' ,
			'eColor' , 'eAlpha' , 'hCycle' ,
			'oColor' , 'oAlpha' , 'oWidth'
		);
		foreach( $var_list as $var ){
			$str_vars[] = esc_attr( (string)$var ) . '=' . esc_attr( (string)$args[$var] );
		};
		return implode( '&' , $str_vars );
	}

	function update( $new_instance , $old_instance ){
		$instance = $old_instance;
		$instance['title'] = strip_tags( stripslashes( $new_instance['title'] ) );
		list( $instance['width'] , $instance['height'] ) = array( (int)$new_instance['width'] , (int)$new_instance['height'] );
		list( $instance['hColor'] , $instance['hAlpha'] , $instance['hLength'] , $instance['hWidth'] , $instance['hType'] ) =
			array( strip_tags( stripslashes( $new_instance['hColor'] ) ) , (double)$new_instance['hAlpha'] ,
			(double)$new_instance['hLength'] , (double)$new_instance['hWidth'] , (int)$new_instance['hType'] );
		list( $instance['mColor'] , $instance['mAlpha'] , $instance['mLength'] , $instance['mWidth'] , $instance['mType'] ) =
			array( strip_tags( stripslashes( $new_instance['mColor'] ) ) , (double)$new_instance['mAlpha'] ,
			(double)$new_instance['mLength'] , (double)$new_instance['mWidth'] , (int)$new_instance['mType'] );
		list( $instance['sColor'] , $instance['sAlpha'] , $instance['sLength'] , $instance['sWidth'] , $instance['sType'] ) = 
			array( strip_tags( stripslashes( $new_instance['sColor'] ) ) , (double)$new_instance['sAlpha'] ,
			(double)$new_instance['sLength'] , (double)$new_instance['sWidth'] , (int)$new_instance['sType'] ); 
		list( $instance['mpColor'] , $instance['mpAlpha'] , $instance['mpLength'] , $instance['mpWidth'] , $instance['mpNumber'] ) = 
			array( strip_tags( stripslashes( $new_instance['mpColor'] ) ) , (double)$new_instance['mpAlpha'] ,
			(double)$new_instance['mpLength'] , (double)$new_instance['mpWidth'] , (int)$new_instance['mpNumber'] );
		list( $instance['msColor'] , $instance['msAlpha'] , $instance['msLength'] , $instance['msWidth'] , $instance['msNumber'] ) =
			array( strip_tags( stripslashes( $new_instance['msColor'] ) ) , (double)$new_instance['msAlpha'] ,
			(double)$new_instance['msLength'] , (double)$new_instance['msWidth'] , (int)$new_instance['msNumber'] );
		list( $instance['eColor'] , $instance['eAlpha'] , $instance['hCycle'] ) = 
			array( strip_tags(stripslashes( $new_instance['eColor'] ) ) , (double)$new_instance['eAlpha'] ,
			(int)$new_instance['hCycle'] );
		list( $instance['oColor'] , $instance['oAlpha'] , $instance['oWidth'] ) = 
			array( strip_tags( stripslashes( $new_instance['oColor'] ) ) , (double)$new_instance['oAlpha'] ,
			(double)$new_instance['oWidth'] );
		return $instance;
	}

	function form( $instance ){
	$instance = wp_parse_args( (array)$instance , array( 'title' => '' ,
		'width' => '100%' , 'height' => '100%' ,
		'hColor' => '000000' , 'hAlpha' => '100' , 'hLength' => '60' , 'hWidth' => '12.5' , 'hType' => '1' ,
		'mColor' => '000000' , 'mAlpha' => '100' , 'mLength' => '100' , 'mWidth' => '12.5' , 'mType' => '1' ,
		'sColor' => '000000' , 'sAlpha' => '100' , 'sLength' => '100' , 'sWidth' => '12.5' , 'sType' => '2' ,
		'mpNumber' => '12' , 'mpColor' => '000000' , 'mpLength' => '15' , 'mpWidth' => '0.5' , 'mpAlpha' => '100' ,
		'msNumber' => '60' , 'msColor' => '000000' , 'msLength' => '5' , 'msWidth' => '0.5' , 'msAlpha' => '100' ,
		'eColor' => 'FFFFFF' , 'eAlpha' => '100' , 'hCycle' => 12 ,
		'oColor' => '000000' , 'oAlpha' => '100' , 'oWidth' => '1'
	) );
	$title = htmlspecialchars( $instance['title'] );
	$flashvars = zyx_join_flashvars( $instance );
?>
	<div style="clear:both; margin-bottom:1ex;">
		<div style="width:100px; float:left;">
<?php	echo zyx_Hixie_flash( WP_PLUGIN_URL . '/' . dirname( plugin_basename(__FILE__) ) . '/analog_clock.swf' ,
	'100px', '100px' ,
	array( 'flashvars' => $flashvars , 'wmode' => 'transparent' , 'align' => 'center' , 'scale' => 'exactfit' 
	) );
?>
		</div>
	<div style="float:right;"><!-- Main settings -->
		<strong><?php _e( 'Main settings' , 'zyx-analog-clock') ; ?></strong><br />
			<label for="<?php echo $this->get_field_id('title'); ?>" title="<?php _e( 'Title for the widget' , 'zyx-analog-clock' ); ?>" >
				<?php _e( 'Title' , 'zyx-analog-clock' ); ?>: <input style="width:250px;" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
			</label>
			<br />
			<label for="<?php echo $this->get_field_id( 'width' ); ?>" title="<?php _e( 'Width of the widget' , 'zyx-analog-clock' ); ?>" >
				<?php _e( 'Width' , 'zyx-analog-clock' ); ?>: <input size="6" maxlength="6" id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" type="text" value="<?php echo $instance['width']; ?>" />
			</label>
			<label for="<?php echo $this->get_field_id( 'height' ); ?>" title="<?php _e( 'Height of the widget' , 'zyx-analog-clock' ); ?>" >
				<?php _e( 'Height' , 'zyx-analog-clock' ); ?>: <input size="6" maxlength="6" id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" type="text" value="<?php echo $instance['height']; ?>" />
			</label>
			<br />
			<label for="<?php echo $this->get_field_id( 'hCycle' ); ?>" title="<?php _e( 'Number of hours for complete round of the main dial (normally 12)' , 'zyx-analog-clock' ); ?>" >
				<?php _e( 'Hours/cycle' , 'zyx-analog-clock' ); ?>: <input size="6" id="<?php echo $this->get_field_id( 'hCycle' ); ?>" name="<?php echo $this->get_field_name( 'hCycle' ); ?>" type="text" value="<?php echo $instance['hCycle']; ?>" />
			</label>
	</div>
	</div>
	<br style="clear:both;" />
	<hr style="clear:both;"/>
	<div><!-- Hour dial settings -->
		<strong><?php _e( 'Hour dial settings' , 'zyx-analog-clock' ) ?></strong><br />
		<label for="<?php echo $this->get_field_id('hColor'); ?>"><?php _e( 'Color (hex)' , 'zyx-analog-clock' ); ?>:&nbsp;
		<input size="6" maxlength="6" id="<?php echo $this->get_field_id('hColor') ;?>" name="<?php echo $this->get_field_name('hColor'); ?>" type="text" value="<?php echo $instance['hColor']; ?>" />
	</label>
		<label for="<?php echo $this->get_field_id('hAlpha'); ?>"><?php _e( 'Opacity (0-100)' , 'zyx-analog-clock' ); ?>:&nbsp;
		<input size="4" maxlength="4" id="<?php echo $this->get_field_id('hAlpha'); ?>" name="<?php echo $this->get_field_name('hAlpha'); ?>" type="text" value="<?php echo $instance['hAlpha']; ?>" />
	</label>
		<br />
		<label for="<?php echo $this->get_field_id( 'hLength' ); ?>"><?php _e( 'Length' , 'zyx-analog-clock' ); ?> (%):&nbsp;
			<input size="6" maxlength="6" id="<?php echo $this->get_field_id('hLength' ); ?>" name="<?php echo $this->get_field_name('hLength'); ?>" type="text" value="<?php echo $instance['hLength']; ?>" />
		</label>
		<label for="<?php echo $this->get_field_id( 'hWidth' ); ?>"><?php _e( 'Width' , 'zyx-analog-clock' ); ?> (%):&nbsp;
			<input size="6" maxlength="6" id="<?php echo $this->get_field_id('hWidth'); ?>" name="<?php echo $this->get_field_name('hWidth'); ?>" type="text" value="<?php echo $instance['hWidth']; ?>" />
		</label>
		<br />
		<label for="<?php echo $this->get_field_id( 'hType' ); ?>"><?php _e( 'Type' , 'zyx-analog-clock' ); ?>:&nbsp;
			<select id="<?php echo $this->get_field_id('hType'); ?>" name="<?php echo $this->get_field_name('hType'); ?>" >
				<option value="1"<?php if( $instance['hType'] == 1 ) echo ' selected="selected"'; ?>><?php _e( 'Triangular' , 'zyx-analog-clock' ); ?></option>
				<option value="2"<?php if( $instance['hType'] == 2 ) echo ' selected="selected"'; ?>> <?php _e('Straight' , 'zyx-analog-clock' ); ?></option>
			</select>
		</label>
	</div>
	<hr />
	<div><!-- Minute dial settings -->
		<strong><?php _e( 'Minute dial settings' , 'zyx-analog-clock' ); ?></strong><br />
		<label for="<?php echo $this->get_field_id('mColor'); ?>"><?php  _e( 'Color (hex)'); ?>:&nbsp;
			<input size="6" maxlength="6" id="<?php echo $this->get_field_id('mColor'); ?>" name="<?php echo $this->get_field_name('mColor'); ?>" type="text" value="<?php echo $instance['mColor'] ?>" />
		</label>
		<label for="<?php echo $this->get_field_id('mAlpha'); ?>"><?php _e( 'Opacity (0-100)' , 'zyx-analog-clock'); ?>:&nbsp;
			<input size="4" maxlength="4" id="<?php echo $this->get_field_id('mAlpha'); ?>" name="<?php echo $this->get_field_name('mAlpha'); ?>" type="text" value="<?php echo $instance['mAlpha']; ?>" />
		</label><br />
		<label for="<?php echo $this->get_field_id('mLength'); ?>"><?php _e('Length' , 'zyx-analog-clock' ); ?> (%):&nbsp;
			<input size="6" maxlength="6" id="<?php echo $this->get_field_id('mLength'); ?>" name="<?php echo $this->get_field_name('mLength'); ?>" type="text" value="<?php echo $instance['mLength']; ?>" />
		</label>
		<label for="<?php echo $this->get_field_id('mWidth'); ?>"><?php _e('Width' , 'zyx-analog-clock' ); ?> (%):&nbsp;
			<input size="6" maxlength="6" id="<?php echo $this->get_field_id('mWidth'); ?>" name="<?php echo $this->get_field_name('mWidth'); ?>" type="text" value="<?php echo $instance['mWidth']; ?>" />
		</label>
		<br />
		<label for="<?php echo $this->get_field_id('mType'); ?>"><?php _e( 'Type' , 'zyx-analog-clock' ); ?>:&nbsp;
			<select id="<?php echo $this->get_field_id('mType'); ?>" name="<?php echo $this->get_field_name('mType'); ?>" >
				<option value="1" <?php if( 1 == $instance['mType'] ) echo 'selected="selected"'; ?>><?php _e( 'Triangular' , 'zyx-analog-clock' ); ?></option>
				<option value="2" <?php if( 2 == $instance['mType'] ) echo 'selected="selected"'; ?>><?php _e( 'Straight' , 'zyx-analog-clock' ); ?></option>
			</select>
		</label>
	</div>
	<hr />
	<div><!-- Second dial settings -->
		<strong><?php _e( 'Second dial settings' , 'zyx-analog-clock' ); ?></strong><br />
		<label for="<?php echo $this->get_field_id('sColor'); ?>"><?php _e( 'Color (hex)' , 'zyx-analog-clock' ); ?>:&nbsp;
			<input size="6" maxlength="6" id="<?php echo $this->get_field_id( 'sColor' ); ?>" name="<?php echo $this->get_field_name('sColor'); ?>" type="text" value="<?php echo $instance['sColor']; ?>" />
		</label>
		<label for="<?php echo $this->get_field_id( 'sAlpha' ); ?>"><?php _e( 'Opacity (0-100)' , 'zyx-analog-clock' ); ?>:&nbsp;
			<input size="4" maxlength="4" id="<?php echo $this->get_field_id('sAlpha'); ?>" name="<?php echo $this->get_field_name('sAlpha'); ?>" type="text" value="<?php echo $instance['sAlpha']; ?>" />
		</label><br />
		<label for="<?php echo $this->get_field_id( 'sLength' ); ?>"><?php _e( 'Length' , 'zyx-analog-clock' ); ?> (%):&nbsp;
			<input size="6" maxlength="6" id="<?php echo $this->get_field_id( 'sLength' ); ?>" name="<?php echo $this->get_field_name( 'sLength' ); ?>" type="text" value="<?php echo $instance['sLength']; ?>" />
		</label>
		<label for="<?php echo $this->get_field_id( 'sWidth' ); ?>"><?php _e( 'Width' , 'zyx-analog-clock' ); ?> (%):&nbsp;
			<input size="6" maxlength="6" id="<?php echo $this->get_field_id( 'sWidth' ); ?>" name="<?php echo $this->get_field_name('sWidth'); ?>" type="text" value="<?php echo $instance['sWidth']; ?>" />
		</label>
		<br />
		<label for="<?php echo $this->get_field_id( 'sType' ); ?>"><?php _e( 'Type' , 'zyx-analog-clock' ); ?>:&nbsp;
			<select id="<?php echo $this->get_field_id( 'sType' ); ?>" name="<?php echo $this->get_field_name('sType'); ?>" >
				<option value="1" <?php if( 1 == $instance['sType'] ) echo 'selected="selected"'; ?>><?php _e( 'Triangular' , 'zyx-analog-clock' ); ?></option>
				<option value="2" <?php if( 2 == $instance['sType'] ) echo 'selected="selected"'; ?>><?php _e( 'Straight' , 'zyx-analog-clock' ); ?></option>
			</select>
		</label>
	</div>
	<hr />
	<div><!-- Primary mark settings -->
		<strong><?php _e( 'Primary Mark settings' , 'zyx-analog-clock'); ?></strong><br />
		<label for="<?php echo $this->get_field_id( 'mpColor' ); ?>"><?php _e( 'Color (hex)' , 'zyx-analog-clock' ); ?>:&nbsp;
			<input size="6" maxlength="6" id="<?php echo $this->get_field_id( 'mpColor' ); ?>" name="<?php echo $this->get_field_name( 'mpColor' ); ?>" type="text" value="<?php echo $instance['mpColor']; ?>" />
		</label>
		<label for="<?php echo $this->get_field_id( 'mpAlpha' ); ?>"><?php _e( 'Opacity (0-100)' , 'zyx-analog-clock' ); ?>:&nbsp;
			<input size="4" maxlength="4" id="<?php echo $this->get_field_id( 'mpAlpha' ); ?>" name="<?php echo $this->get_field_name('mpAlpha'); ?>" type="text" value="<?php echo $instance['mpAlpha']; ?>" />
		</label>
		<br />
		<label for="<?php echo $this->get_field_id( 'mpLength' ); ?>"><?php _e( 'Length' , 'zyx-analog-clock' ); ?> (%):&nbsp;
			<input size="6" maxlength="6" id="<?php echo $this->get_field_id( 'mpLength' ); ?>" name="<?php echo $this->get_field_name( 'mpLength' ); ?>" type="text" value="<?php echo $instance['mpLength']; ?>" />
		</label>
		<label for="<?php echo $this->get_field_id( 'mpWidth' ); ?>"><?php _e( 'Width' , 'zyx-analog-clock' ); ?> (%):&nbsp;
			<input size="6" maxlength="6" id="<?php echo $this->get_field_id( 'mpWidth' ); ?>" name="<?php echo $this->get_field_name( 'mpWidth' ); ?>" type="text" value="<?php echo $instance['mpWidth']; ?>" />
		</label>
		<label for="<?php echo $this->get_field_id( 'mpNumber' ); ?>"><?php _e( 'Number' , 'zyx-analog-clock' ); ?>:&nbsp;
			<input size="6" maxlength="6" id="<?php echo $this->get_field_id( 'mpNumber' ); ?>" name="<?php echo $this->get_field_name( 'mpNumber' ); ?>" type="text" value="<?php echo $instance['mpNumber']; ?>" />
		</label>
	</div>
	<hr />
	<div><!-- Secondary mark settings -->
		<strong><?php _e( 'Secondary Mark settings' , 'zyx-analog-clock' ); ?></strong><br />
		<label for="<?php echo $this->get_field_id( 'msColor' ); ?>"><?php _e( 'Color (hex)' , 'zyx-analog-clock' ); ?>:&nbsp;
			<input size="6" maxlength="6" id="<?php echo $this->get_field_id( 'msColor' ); ?>" name="<?php echo $this->get_field_name( 'msColor' ); ?>" type="text" value="<?php echo $instance['msColor']; ?>" />
		</label>
		<label for="<?php echo $this->get_field_id( 'msAlpha' ); ?>"><?php _e( 'Opacity (0-100)' , 'zyx-analog-clock' ); ?>:&nbsp;
			<input size="4" maxlength="4" id="<?php echo $this->get_field_id( 'msAlpha' ); ?>" name="<?php echo $this->get_field_name( 'msAlpha' ); ?>" type="text" value="<?php echo $instance['msAlpha']; ?>" />
		</label>
		<br />
		<label for="<?php echo $this->get_field_id( 'msLength' ); ?>"><?php _e( 'Length' , 'zyx-analog-clock' ); ?> (%):&nbsp;
			<input size="6" maxlength="6" id="<?php echo $this->get_field_id( 'msLength' ); ?>" name="<?php echo $this->get_field_name( 'msLength' ); ?>" type="text" value="<?php echo $instance['msLength']; ?>" />
		</label>
		<label for="<?php echo $this->get_field_id( 'msWidth' ); ?>"><?php _e( 'Width' , 'zyx-analog-clock' ); ?> (%):&nbsp;
			<input size="6" maxlength="6" id="<?php echo $this->get_field_id( 'msWidth' ); ?>" name="<?php echo $this->get_field_name( 'msWidth' ); ?>" type="text" value="<?php echo $instance['msWidth']; ?>" />
		</label>
		<label for="<?php echo $this->get_field_id( 'msNumber' ); ?>"><?php _e( 'Number' , 'zyx-analog-clock' ); ?>:&nbsp;
			<input size="6" maxlength="6" id="<?php echo $this->get_field_id( 'msNumber' ); ?>" name="<?php echo $this->get_field_name( 'msNumber' ); ?>" type="text" value="<?php echo $instance['msNumber']; ?>" />
		</label>
	</div>
	<hr />
	<div><!-- Sphere settings -->
		<strong><?php _e( 'Sphere settings' , 'zyx-analog-clock' ); ?></strong><br />
		<label for="<?php echo $this->get_field_id( 'eColor' , 'zyx-analog-clock' ); ?>"><?php _e( 'Color (hex)' , 'zyx-analog-clock' ); ?>:&nbsp;
			<input size="6" maxlength="6" id="<?php echo $this->get_field_id( 'eColor' ); ?>" name="<?php echo $this->get_field_name('eColor'); ?>" type="text" value="<?php echo $instance['eColor']; ?>" />
		</label>
		<label for="<?php echo $this->get_field_id( 'eAlpha' ); ?>"><?php _e( 'Opacity (0-100)' , 'zyx-analog-clock' ); ?>:&nbsp;
			<input size="4" maxlength="4" id="<?php echo $this->get_field_id( 'eAlpha' ); ?>" name="<?php echo $this->get_field_name( 'eAlpha' ); ?>" type="text" value="<?php echo $instance['eAlpha']; ?>" />
		</label>
	</div>
	<hr />
	<div><!-- Outline settings -->
		<strong><?php _e( 'Outline settings' , 'zyx-analog-clock' ); ?></strong><br />
		<label for="<?php echo $this->get_field_id( 'oColor' ); ?>"><?php _e( 'Color (hex)' , 'zyx-analog-clock' ); ?>:&nbsp;
			<input size="6" maxlength="6" id="<?php echo $this->get_field_id('oColor'); ?>" name="<?php echo $this->get_field_name('oColor'); ?>" type="text" value="<?php echo $instance['oColor']; ?>" />
		</label>
		<label for="<?php echo $this->get_field_id( 'oAlpha' ); ?>"><?php _e( 'Opacity (0-100)' , 'zyx-analog-clock' ); ?>:&nbsp;
			<input size="4" maxlength="4" id="<?php echo $this->get_field_id( 'oAlpha' ); ?>" name="<?php echo $this->get_field_name( 'oAlpha' ); ?>" type="text" value="<?php echo $instance['oAlpha']; ?>" />
		</label>
		<br />
		<label for="<?php echo $this->get_field_id( 'oWidth' ); ?>"><?php _e( 'Width' , 'zyx-analog-clock' ); ?> (%):&nbsp;
			<input size="6" maxlength="6" id="<?php echo $this->get_field_id( 'oWidth' ); ?>" name="<?php echo $this->get_field_name('oWidth'); ?>" type="text" value="<?php echo $instance['oWidth']; ?>" />
		</label>
	</div>
<?php }

};

function zyx_analog_clock_widget_init(){
	register_widget('zyx_analog_clock');
}
add_action('widgets_init', 'zyx_analog_clock_widget_init'); ?>