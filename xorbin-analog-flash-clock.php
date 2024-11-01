<?php
/*
Plugin Name: Xorbin Analog Flash Clock
Plugin URI: http://www.xorbin.com
Description: Customizable Analog Clock by XorBin.com.
Version: 1.0.2
Author: www.xorbin.com
Author URI: http://www.xorbin.com
License: GPL2 or later
*/

	class XorAnalogClockWidget extends WP_Widget {
		
		private $xorAnalogClockParams = array();
		
		function xorAnalogClockWidget() {
			$widget_params = array( 'classname' => 'xorAnalogClockWidget', 'description' => 'Customizable Analog Clock by XorBin.com' );
			$this->WP_Widget('xorAnalogClockWidget', 'Analog Clock Widget', $widget_params);
			
			$this->xorAnalogClockParams['xorWidth'] = '100%';
			$this->xorAnalogClockParams['xorHeight'] = 200;
			$this->xorAnalogClockParams['clockSkin'] = 2;
            $this->xorAnalogClockParams['arrowSkin'] = 1;
            $this->xorAnalogClockParams['arrowScale'] = 100;
            $this->xorAnalogClockParams['arrowHColor'] = '666666';
            $this->xorAnalogClockParams['arrowMColor'] = '666666';
            $this->xorAnalogClockParams['arrowSColor'] = '666666';
            $this->xorAnalogClockParams['showSeconds'] = true;
            $this->xorAnalogClockParams['UTCTime'] = '0';
            $this->xorAnalogClockParams['timeOffset'] = '0';
            $this->xorAnalogClockParams['urlWindow'] = '_blank';
            $this->xorAnalogClockParams['widgetUrl'] = '';
		}
		
		function widget($args, $instance) {
			$before_widget = '';
			$after_widget = '';
			$before_title = '';
			$after_title = ''; 
			extract($args);
			echo $before_widget;
			echo '<script type="text/javascript">';
			echo 'jQuery(document).ready(function(){';
    		echo 'var flashvars = {};';
			echo 'var params = {};';
			echo 'params.wmode = "transparent";';
			echo 'var attributes = {};';
			echo 'attributes.id = "xbAnalogClock-'.$this->number.'";';
			echo 'attributes.name = "xbAnalogClock-'.$this->number.'";';
    		$defaultSkins = array("-empty-", "skin001.png", "skin002.png", "skin003.png", "skin004.png", "skin005.png", "skin006.gif", "skin007.jpg", "skin008.png", "skin011.png", "skin012.png", "skin013.png", "skin014.png", "skin015.png", "skin016.png", "skin017.png", "skin018.png");
    		foreach ($this->xorAnalogClockParams as $xorKey   => $xorValue) {
				if (($xorKey == 'clockSkin') && (empty($instance['clockSkinUrl']))) {
					if ($instance[$xorKey] == 0) {
					   echo 'flashvars.clockSkin = "empty";';
					} else {
						echo 'flashvars.clockSkin = "'.WP_PLUGIN_URL.'/xorbin-analog-flash-clock/media/skins/'.$defaultSkins[$instance[$xorKey]].'";';
					}
				} elseif (($xorKey == 'clockSkin') && (!empty($instance['clockSkinUrl']))) {
					echo 'flashvars.clockSkin = "'.$instance['clockSkinUrl'].'";';
				} elseif (($xorKey == 'UTCTime') && ($instance['UTCTime'] == true)) {
					echo 'flashvars.'.$xorKey.' = "'.gmdate('H:i:s').'";';
				} elseif (($xorKey == 'timeOffset') && ($instance['UTCTime'] == true)) {
					echo 'flashvars.'.$xorKey.' = "'.$instance['timeOffset'].'";';
				} elseif (($xorKey == 'widgetUrl') && ($instance['widgetUrl'] == '')) {
					echo 'flashvars.'.$xorKey.' = "empty";';
				} elseif (($xorKey != 'xorWidth') && ($xorKey != 'xorHeight') && ($xorKey != 'timeOffset') && ($xorKey != 'UTCTime')) {
					echo 'flashvars.'.$xorKey.' = "'.$instance[$xorKey].'";';
				}
			}
			echo 'swfobject.embedSWF("'.WP_PLUGIN_URL.'/xorbin-analog-flash-clock/media/xorAnalogClock.swf", "xbAnalogClock-'.$this->number.'", "'.$instance['xorWidth'].'", "'.$instance['xorHeight'].'", "9.0.0", "'.WP_PLUGIN_URL.'/xorbin-analog-flash-clock/media/expressInstall.swf", flashvars, params, attributes);';
			echo '});'; 
			echo '</script>';
			
			
			if(!empty($instance['title'])) {
				echo $before_title . $instance['title'] . $after_title;
			}
			echo '<div id="xbAnalogClock-'.$this->number.'"></div>';
			echo $after_widget;
		}
		
		function update($new_instance, $old_instance) {
		
		return $new_instance;
		
		}
		
		function form($instance) {
			$defaultSkins = array("-empty-", "skin001.png", "skin002.png", "skin003.png", "skin004.png", "skin005.png", "skin006.gif", "skin007.jpg", "skin008.png", "skin011.png", "skin012.png", "skin013.png", "skin014.png", "skin015.png", "skin016.png", "skin017.png", "skin018.png");
			$arrowSkins = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ,10 ,11, 12);
			$targetValues = array('_blank', '_self', '_parent', '_top');
			$offsetValues = array ('-12:00' => '-43200', '-11:00' => '-39600', '-10:00' => '-36000', '-09:30' => '-34200', '-09:00' => '-32400', '-08:00' => '-28800', '-07:00' => '-25200', '-06:00' => '-21600', '-05:00' => '-18000', '-04:30'=>'-16200', '-04:00' =>'-14400', '-03:30'=>'-12600','-03:00'=>'-10800','-02:00'=>'-7200','-01:00'=>'-3600','00:00'=>'0','+01:00'=>'3600', '+02:00'=>'7200','+03:00'=>'10800','+03:30'=>'12600', '+04:00' =>'14400', '+04:30'=>'16200','+05:00' => '18000', '+05:30'=>'19800', '+05:45'=>'20700', '+06:00' => '21600', '+06:30' => '23400', '+07:00' => '25200', '+08:00' => '28800', '+09:00' => '32400', '+09:30'=>'34200', '+10:00' => '36000', '+10:30' => '37800', '+11:00' => '39600', '+11:30' => '41400', '+12:00' => '43200', '+12:45' => '45900', '+13:00' => '46800', '+14:00' => '50400');
			if (empty($instance)) {
				foreach ($this->xorAnalogClockParams as $xorKey => $xorValue) {
					$instance[$xorKey] = empty($instance[$xorKey]) ? $xorValue: $instance[$xorKey];
				}
			}
			?>	
			
			<style type="text/css">
					.xorClockWidget label {
						display:block;
						padding-top:8px;
						padding-left:3px;
						clear:both;
					}
					.xorClockWidget select, input[type="text"] {
						width:218px;
					}
					.xorbinLogo {
						text-align:center;						 
					}
     		</style>
			<div class="xorClockWidget">
				<div class="xorbinLogo">
					<a href="http://www.xorbin.com"><img src="<?php echo WP_PLUGIN_URL; ?>/xorbin-analog-flash-clock/media/analog_clock_by_xorbin.png" /></a> 
				</div>
				<label for="<?php echo $this->get_field_id("title");?>">Title:</label>
				<input type="text" name="<?php echo $this->get_field_name("title"); ?>" id="<?php echo $this->get_field_id("title"); ?>" value="<?php echo $instance["title"]; ?>" />
				
				<label for="<?php echo $this->get_field_id("xorWidth");?>">Width:
					<input style="width:175px; margin-left:5px;" type="text" name="<?php echo $this->get_field_name("xorWidth"); ?>" id="<?php echo $this->get_field_id("xorWidth"); ?>" value="<?php echo $instance["xorWidth"]; ?>" />
				</label>
				
				<label for="<?php echo $this->get_field_id("xorHeight");?>">Height:
					<input style="width:175px;" type="text" name="<?php echo $this->get_field_name("xorHeight"); ?>" id="<?php echo $this->get_field_id("xorHeight"); ?>" value="<?php echo $instance["xorHeight"]; ?>" />
				</label>
				
				<label for="<?php echo $this->get_field_id("clockSkin");?>">Clock skin:</label>
				<select name="<?php echo $this->get_field_name("clockSkin"); ?>" id="<?php echo $this->get_field_id("clockSkin"); ?>" >
					<?php foreach ($defaultSkins as $xorKey => $xorValue): ?>
						<option <?php if ($xorKey == $instance['clockSkin']): ?> selected="selected" <?php endif;?> value="<?php echo $xorKey;?>"><?php echo $xorValue; ?></option>
					<?php endforeach; ?>	
				</select>
				
				<label for="<?php echo $this->get_field_id("clockSkinUrl");?>">Custom clock skin [URL]:</label>
				<input type="text" name="<?php echo $this->get_field_name("clockSkinUrl"); ?>" id="<?php echo $this->get_field_id("clockSkinUrl"); ?>" value="<?php echo $instance["clockSkinUrl"]; ?>" />
				
				<label for="<?php echo $this->get_field_id("arrowSkin");?>">Arrows skin:
					<select style="width:145px;" name="<?php echo $this->get_field_name("arrowSkin"); ?>" id="<?php echo $this->get_field_id("arrowSkin"); ?>" >
						<?php foreach ($arrowSkins as $xorKey => $xorValue): ?>
							<?php if ($xorKey == 0) continue; ?>
							<option <?php if ($xorKey == $instance['arrowSkin']): ?> selected="selected" <?php endif;?> value="<?php echo $xorKey;?>"><?php echo $xorValue; ?></option>
						<?php endforeach; ?>	
					</select>
				</label>
				
				<label for="<?php echo $this->get_field_id("arrowScale");?>">Arrow scale, % [10..500]:</label>
				<input type="text" name="<?php echo $this->get_field_name("arrowScale"); ?>" id="<?php echo $this->get_field_id("arrowScale"); ?>" value="<?php echo $instance["arrowScale"]; ?>" />

				<label for="<?php echo $this->get_field_id("arrowHColor");?>">Hour arrow color:</label>
				<input type="text" name="<?php echo $this->get_field_name("arrowHColor"); ?>" id="<?php echo $this->get_field_id("arrowHColor"); ?>" value="<?php echo $instance["arrowHColor"]; ?>" />
				
				<label for="<?php echo $this->get_field_id("arrowMColor");?>">Minutes arrow color:</label>
				<input type="text" name="<?php echo $this->get_field_name("arrowMColor"); ?>" id="<?php echo $this->get_field_id("arrowMColor"); ?>" value="<?php echo $instance["arrowMColor"]; ?>" />
				
				<label for="<?php echo $this->get_field_id("arrowSColor");?>">Seconds arrow color:</label>
				<input type="text" name="<?php echo $this->get_field_name("arrowSColor"); ?>" id="<?php echo $this->get_field_id("arrowSColor"); ?>" value="<?php echo $instance["arrowSColor"]; ?>" />

				<label for="<?php echo $this->get_field_id("showSeconds");?>">Display seconds:
					<input type="checkbox" name="<?php echo $this->get_field_name("showSeconds"); ?>" id="<?php echo $this->get_field_id("showSeconds"); ?>" <?php if($instance["showSeconds"] == true ):?> checked <?php endif; ?>value="true" />
				</label>
				
				<label for="<?php echo $this->get_field_id("widgetUrl");?>">Clock url:</label>
				<input type="text" name="<?php echo $this->get_field_name("widgetUrl"); ?>" id="<?php echo $this->get_field_id("widgetUrl"); ?>" value="<?php echo $instance["widgetUrl"]; ?>" />

				<label for="<?php echo $this->get_field_id("urlWindow");?>">Url target:
					<select style="width:158px;" name="<?php echo $this->get_field_name("urlWindow"); ?>" id="<?php echo $this->get_field_id("urlWindow"); ?>" >
						<?php foreach ($targetValues as $xorKey => $xorValue): ?>
							<option <?php if ($xorValue == $instance['urlWindow']): ?> selected="selected" <?php endif;?> value="<?php echo $xorValue;?>"><?php echo $xorValue; ?></option>
						<?php endforeach; ?>	
					</select>
				</label>
				<label for="<?php echo $this->get_field_id("timeOffset");?>">
				<input type="checkbox" name="<?php echo $this->get_field_name("UTCTime"); ?>" id="<?php echo $this->get_field_id("UTCTime"); ?>" <?php if($instance["UTCTime"] == true ):?> checked <?php endif; ?> value="true" />
				Time zone:
					<select style="width:133px;" name="<?php echo $this->get_field_name("timeOffset"); ?>" id="<?php echo $this->get_field_id("timeOffset"); ?>" >
						<?php foreach ($offsetValues as $xorKey => $xorValue): ?>
							<option <?php if ($xorValue == $instance['timeOffset']): ?> selected="selected" <?php endif;?> value="<?php echo $xorValue;?>"><?php echo $xorKey; ?></option>
						<?php endforeach; ?>	
					</select>
				</label>
			</div>
			<?php 
		}
		
	}
	
	function frontUserHeader () {
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'swfobject.v2.2', WP_PLUGIN_URL.'/xorbin-analog-flash-clock/js/swfobject.v2.2.js');
		
	}
	
	add_action('widgets_init', create_function('', 'return register_widget("xorAnalogClockWidget");'));
    add_action('wp_enqueue_scripts', 'frontUserHeader');

           			
    


