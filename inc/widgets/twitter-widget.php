<?php
// Twitter Widget
class widget_thb_twitterwidget extends WP_Widget {
	function __construct() {
		$widget_ops = array(
			'classname'   => 'widget_thb_twitterwidget',
			'description' => __('Display your Tweets','revolution')
		);
		
		parent::__construct(
			'thb_thb_twitterwidget_widget',
			__( 'Fuel Themes - Twitter' , 'revolution' ),
			$widget_ops
		);
				
		$this->defaults = array( 'title' => 'Twitter', 'show' => '3' );
	}

	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$show = $instance['show'];
		
		$tweets = thb_gettweets($show);
		echo $before_widget;
		echo ($title ? $before_title . $title . $after_title : '');
		
		if (is_array($tweets)) {
			?>
			<ul>
			<?php
			foreach ($tweets as $tweet) {
				?>
				<li class="thb_tweet">
					<p><?php echo wp_kses_post($tweet['tweet']); ?></p>
					<a href="<?php echo esc_url($tweet['url']); ?>" class="thb_tweet_time" target="_blank"><?php echo wp_kses_post($tweet['time']); ?></a>
				</li>
				<?php
			}
			?>
			</ul>
			<?php
		} else {
			var_dump($tweets);
		}
		echo $after_widget;
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['show'] = strip_tags( $new_instance['show'] );
		
		return $instance;
	}
	function form($instance) {
		$defaults = $this->defaults;
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Widget Title:', 'revolution'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" class="widefat" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'name' )); ?>"><?php esc_html_e('Number of Tweets:', 'revolution'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'name' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show' )); ?>" value="<?php echo esc_attr($instance['show']); ?>" class="widefat" />
		</p>
	<?php
	}
}
function widget_thb_twitterwidget_init() {
	register_widget('widget_thb_twitterwidget');
}
add_action('widgets_init', 'widget_thb_twitterwidget_init');