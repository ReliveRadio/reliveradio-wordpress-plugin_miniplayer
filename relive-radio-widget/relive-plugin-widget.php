<?php
/*
Plugin Name:  Relive Radio Widget Plugin
Description:  Ermöglicht das Einbinden des ReliveRadio Miniplayers über die Widgets in die Sidebar
Plugin URI:   http://labs.wikibyte.org
Version:      2.2.4
Author:       Michael McCouman jr.
Author URI:   http://wikibyte.org/
Props:        Michael McCouman jr.

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

*/


add_action('admin_print_styles-widgets.php', 'relive_widgets_style');
function relive_widgets_style(){

    echo '
<style type="text/css">
div#widget-list div.ui-draggable[id*=_relive_radio_widget] .widget-top {
	border: none !important;
    background: #000;
	-webkit-box-shadow: none;
	box-shadow: none;
	-webkit-border-radius: 3px;
	border-radius: 4px;
	text-shadow: #222 0 0 0;
}
div.widget[id*=_relive_radio_widget] {
	border: none !important;
    background: #000;
	-webkit-box-shadow: none;
	box-shadow: none;
	-webkit-border-radius: 3px;
	border-radius: 4px;
	text-shadow: #222 0 0 0;
}
div.widget[id*=_relive_radio_widget] .widget-top{
    color: #eee;
    text-shadow: #222 0 0 0;
    border: none !important;
    background: #000;
}
div.widget[id*=_relive_radio_widget] .widget-control-actions {
	background: url(
'; 
?>
	<?php echo plugins_url('/inc/patter.png', __FILE__ ); ?>
<?php echo '
	) #333 !important;
	padding: 12px;
	margin-left: -12px;
	margin-right: -12px;
	margin-bottom: -12px;
	border-top: 1px solid #555;
}
div.widget[id*=_relive_radio_widget] .widget-inside{
    background: url(
';
?>
	<?php echo plugins_url('/inc/bg', __FILE__ ); ?>
<?php echo '
	) #000 !important;
	border: 2px solid #000;
}
div.widget[id*=_relive_radio_widget] .cw-color-picker { 
	background: #002A2B;
	border: 1px solid #00455F;
	width: 197px; 
}
div.widget[id*=_relive_radio_widget] .alignleft a { color:#eee; }
div.widget[id*=_relive_radio_widget] .alignleft { color:#aaa; }
div.widget[id*=_relive_radio_widget] .in-widget-title {
	color: #999;
	text-shadow: #222 0 0 0;
}
</style>
';
}


/**
 * Adds Relive_Radio_Widget widget.
 */
class relive_radio_i_widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'Relive_Radio_Widget', // Base ID
			'ReliveRadio Miniplayer', // Name
			array( 
			
			'description' => __( 'Relive Radio Widget zum Einbinden des Miniplayers', 'text_domain' ),  ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 * @see WP_Widget::widget()
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		//args:
		$title = apply_filters( 'widget_title', $instance['title'] );
		$stream = apply_filters( 'widget_stream', $instance['stream'] );
		$css = apply_filters( 'widget_stream', $instance['css'] );
		$color = apply_filters( 'widget_stream', $instance['color'] );
		
		//Start out-----------------------
		echo $before_widget;
		
			//Widget title
			if ( ! empty( $title ) )
				echo $before_title . $title . $after_title;

			//Stream out
			if ( ! empty( $stream ) )
			
			echo '<iframe style="border: none; margin-top: -30px; margin-left: -9px;" name="ReliveRadio Miniplayer" 
			src="http://cm.wikibyte.org/testcodes/neu-chapters/standalone-mini.php?stream='. $stream . '&css='.$css.'&color='.$color.'" height="100" width="100%" 
			marginwidth="10" marginheight="10" scrolling="no" border="0">
			</iframe>';

		
		//End out-------------------------
		echo $after_widget;
	}

	/**
	 * Back-end widget form.
	 * @see WP_Widget::form()
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		
		//titel widget:
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Relive Radio', 'text_domain' );
		}
		
		//stream:
		if ( isset( $instance[ 'stream' ] ) ) {
			$stream = $instance[ 'stream' ];
		}
		else {
			$stream = 'mix';
		}
		
		//style:
		if ( isset( $instance[ 'css' ] ) ) {
			$css = $instance[ 'css' ];
		}
		else {
			$css = ''; //no input
		}
		
		//color:
		if ( isset( $instance[ 'color' ] ) ) {
			$color = $instance[ 'color' ];
		}
		else {
			$color = ''; //no input
		}

?>
<style>
#rr-widget {
	border: 2px solid #222;
	background: #FFF;
	margin-bottom: 15px;
	padding: 10px;
}
#tc {
	color:#008EBB;
	font-size:12px;
	text-shadow: #065A2B 0px 0 3px;
}
.itc {
	border-color: #008DB9 !important;
	background: #222 !important;
	color: #4EC8E7 !important;
}
select.ins {
	border-color: #008DB9 !important;
	background: #222 !important;
	color: #4EC8E7 !important;
	width: 100%;
}
.init {
	background: url(<?php echo plugins_url('/inc/ini.png', __FILE__ ); ?> center right #222 !important;
	border-color: #008DB9 !important;
	color: #4EC8E7 !important;
}
#<?php

$id = explode("-", $this->get_field_id("widget_id"));
echo $id[0].'-'.$id[1] . "-" . $id[2].'-savewidget';


?> { 
	background: #000 !important;

	background-color: #000 !important;
	background-image: -webkit-gradient(linear,left top,left bottom,from(#000),to(#333)) !important;
	background-image: -webkit-linear-gradient(top,#000,#333) !important;
	background-image: -moz-linear-gradient(top,#000,#333) !important;
	background-image: -ms-linear-gradient(top,#000,#333) !important;
	background-image: -o-linear-gradient(top,#000,#333) !important;
	background-image: linear-gradient(to bottom,#000,#333) !important;
	border-color: #666 !important;
	border-bottom-color: #444 !important;
	-webkit-box-shadow: inset 0 1px 0 rgba(0, 0, 0, 0.5) !important;
	box-shadow: inset 0 1px 0 rgba(0, 0, 0, 0.5) !important;
	color: #999 !important;
	text-decoration: none !important;
	text-shadow: 0 1px 0 rgba(200, 200, 200, 0.1) !important;

	display: inline-block !important;
	text-decoration: none !important;
	font-size: 12px !important;
	line-height: 23px !important;
	height: 24px !important;
	margin: 0 !important;
	padding: 0 10px 1px !important;
	cursor: pointer !important;
	border-width: 1px !important;
	border-style: solid !important;
	-webkit-border-radius: 0px !important;
	-webkit-appearance: none !important;
	border-radius: 5px !important;
	white-space: nowrap !important;
	-webkit-box-sizing: border-box !important;
	-moz-box-sizing: border-box !important;
	box-sizing: border-box !important;
}
</style>
<div id="rr-widget">
	<center>
		<a href="#"><img src="https://si0.twimg.com/profile_images/3147800911/89e8a8fab0132c06fc82deb5b7d62890_bigger.png" /></a>
	</center>
</div>

<?php
/**
* für Später!

<script>
 jQuery(document).ready( function() { 
  jQuery('#SelectList').bind('change', function (e) { 
    if( jQuery('#SelectList').val() == 'on') {
      jQuery('div.iv').show();
    }
    else{
      jQuery('div.iv').hide();
    }         
  });  
});
</script>
	

  <select id="SelectList">
    <option value="1">Option 1</option>
    <option value="on">Other</option>
  </select>
  <div class="iv" style="background:#f00;">
  Other
  </div>
*/
?>

<?
#################### Label Title
?>
	<p>
		<label id="tc" for="<?php echo $this->get_field_name( 'title' ); ?>"><b>Titel:</b></label> 
		<input class="widefat itc" 
		id="<?php echo $this->get_field_id( 'title' ); ?>" 
		name="<?php echo $this->get_field_name( 'title' ); ?>" 
		type="text" 
		value="<?php echo esc_attr( $title ); ?>" />
		
		<br>
		<br>
<?
#################### Label Stream
?>		
		<label id="tc" for="<?php echo $this->get_field_name( 'stream' ); ?>"><b>Stream:</b></label> 
		<div class="inside">
			<select class="ins" id="<?php echo $this->get_field_id( 'stream' ); ?>" name="<?php echo $this->get_field_name( 'stream' ); ?>">
		<?php
		
		//bedeutet: (Überprüfung innerhalb der Klammer) ? (wenn true) : (wenn falsch); 
		echo '<option'; echo (esc_attr( $stream ) == '') ? ' 
					value="" selected="selected"> -- Bitte Stream aussuchen -- </option>' : ' 
					value=""> -- Bitte Stream aussuchen -- </option>'; 
	##---------
		//Mix
		echo '<option'; echo (esc_attr( $stream ) == 'mix') ? ' 
			value="mix" selected="selected">  Mix </option>' : ' 
			value="mix"> Mix </option>'; 

		//Mix-Mobile
		echo '<option'; echo (esc_attr( $stream ) == 'mix-mobile') ? ' 
			value="mix-mobile" selected="selected">  Mix Mobile </option>' : ' 
			value="mix-mobile"> Mix Mobile</option>';
	##---------			
		//Technik
		echo '<option'; echo (esc_attr( $stream ) == 'technik') ? ' 
			value="technik" selected="selected">  Technik </option>' : ' 
			value="technik"> Technik </option>'; 		
			 	
		//Technik-Mobile
		echo '<option'; echo (esc_attr( $stream ) == 'technik-mobile') ? ' 
			value="technik-mobile" selected="selected"> Technik Mobile </option>' : ' 
			value="technik-mobile"> Technik Mobile </option>';
	##---------	
		//Kultur
		echo '<option'; echo (esc_attr( $stream ) == 'kultur') ? ' 
			value="kultur" selected="selected">  Kultur </option>' : ' 
			value="kultur"> Kultur </option>'; 
			
		//Kultur-Mobile
		echo '<option'; echo (esc_attr( $stream ) == 'kultur-mobile') ? ' 
			value="kultur-mobile" selected="selected"> Kultur Mobile </option>' : ' 
			value="kultur-mobile"> Kultur Mobile </option>'; 
	 		
	 		?>			
			</select>
		</div>
		<br>
<?
#################### Label CSS
?>	
		<label id="tc" for="<?php echo $this->get_field_name( 'css' ); ?>"><b>Design:</b></label> 
		<div class="inside">
			<select class="ins" id="<?php echo $this->get_field_id( 'css' ); ?> itc" name="<?php echo $this->get_field_name( 'css' ); ?>">
		<?php
		
		//bedeutet: (Überprüfung innerhalb der Klammer) ? (wenn true) : (wenn falsch); 
		echo '<option'; echo (esc_attr( $css ) == '') ? ' 
					value="" selected="selected"> -- Kein Design ausgewählt -- </option>' : ' 
					value=""> -- Kein Design ausgewählt -- </option>'; 
	##---------
		//Mix
		echo '<option'; echo (esc_attr( $css ) == 'mix') ? ' 
			value="mix" selected="selected">  Mix </option>' : ' 
			value="mix"> Mix </option>'; 

	##---------			
		//Technik
		echo '<option'; echo (esc_attr( $css ) == 'technik') ? ' 
			value="technik" selected="selected">  Technik </option>' : ' 
			value="technik"> Technik </option>'; 		
			 	
	##---------	
		//Kultur
		echo '<option'; echo (esc_attr( $css ) == 'kultur') ? ' 
			value="kultur" selected="selected">  Kultur </option>' : ' 
			value="kultur"> Kultur </option>'; 
			
	 		?>			
			</select>
		</div>
		<br>
		
<?
#################### Label Farbe
?>
<script type="text/javascript">
	//<![CDATA[
		jQuery(document).ready(function(){
			// colorpicker field
			jQuery('.cw-color-picker').each(function(){
				var $this = jQuery(this),
				id = $this.attr('rel');
				$this.farbtastic('#' + id);
			});
		});
	//]]>   
</script>
<style>
div#colla {
	width:100% !important;
	cursor:pointer !important;
	border-left: 1px solid;
	border-right: 1px solid;
	border-bottom: 1px solid;
	border-top: none !important;
	box-shadow: none !important;
	background-image:  none !important;
	background: none !important;
}
div#wtitle {
	padding: 0px !important;
}
</style>
<div class="widget" id="colla" >
	<div class="widget-top">
		<div class="widget-title" id="wtitle">
		<h4> <input style="border-color: #008DB9 !important;" class="widefat init" id="<?php echo $this->get_field_id('color'); ?>" name="<?php echo $this->get_field_name('color'); ?>" type="text" value="<?php if($color) { echo '#'.$color; } else { echo '#'; } ?>" /></h4>
		</div>
	</div>

	<div class="widget-inside">	
	<p>
	  <label id="tc" for="<?php echo $this->get_field_id('color'); ?>"><b>Eigene Farbe:</b></label> 
	 	<center><div class="cw-color-picker" rel="<?php echo $this->get_field_id('color'); ?>"></div></center>
	</p>
	</div>
</div>		
	
	

	<a style="text-decoration: none !important;color: #fff !important;" target="_blank" href="http://dev.wikibyte.org/ReliveRadio/Downloads/Miniplayer"><img style="text-decoration: none !important;color: #fff !important; width: 22px;" id="project" src="<?php echo plugins_url('/inc/rr-widget.png', __FILE__ ); ?>" /></a><a style="text-decoration: none !important;color: #fff !important;" target="_blank" href="http://dev.wikibyte.org/ReliveRadio/Downloads/Miniplayer"><span style="text-decoration: none !important;color: #fff !important;">Ein <b>ReliveRadio</b> Projekt</a>

<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 * @see WP_Widget::update()
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['stream'] = ( !empty( $new_instance['stream'] ) ) ? strip_tags( $new_instance['stream'] ) : '';
		$instance['css'] = ( !empty( $new_instance['css'] ) ) ? strip_tags( $new_instance['css'] ) : '';
		$instance['color'] = ( !empty( $new_instance['color'] ) ) ? str_replace("#", "", $new_instance['color']) : '';
		
		return $instance;
	}
}

// register message box widget
add_action('widgets_init', create_function('', 'return register_widget("relive_radio_i_widget");'));

function sample_load_color_picker_script() {
	wp_enqueue_script('farbtastic');
}
function sample_load_color_picker_style() {
	wp_enqueue_style('farbtastic');	
}
add_action('admin_print_scripts-widgets.php', 'sample_load_color_picker_script');
add_action('admin_print_styles-widgets.php', 'sample_load_color_picker_style');



/***
für Später !
//JQ select => object
function my_plugin_admin_init() {
     wp_register_script( 'my-script', plugins_url( '/script.js', __FILE__ ), array( 'jquery' ));
     wp_enqueue_script('my-script');
}
add_action( 'admin_print_scripts-widgets.php', 'my_plugin_admin_init' );
*/

?>