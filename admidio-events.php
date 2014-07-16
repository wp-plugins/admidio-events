<?php

/**
 * Plugin Name: Admidio Events
 * Plugin URI:  http://wordpress.org/plugins/admidio-events/
 * Description: A widget that displays event data from the online membership management system <a href="http://sourceforge.net/projects/admidio/">Admidio</a>.
 * Version:     0.4.1
 * Author:      Ulrik Schoth
 * Author URI:  http://profiles.wordpress.org/fiwad/
 * Text Domain: admidio-events
 * Domain Path: /languages
 *
 * Module:      admidio-events.php
 * Description: Widget management.
 * 
 * Copyright (C) 2014 Ulrik Schoth
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 3
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, see <http://www.gnu.org/licenses/>.
 */


/**
 * Admidio Events Widget class.
 * This class handles everything that needs to be handled with the widget: Settings (functions *form* and *update*) and output (function *widget*).
 * 
 * @since 0.3.1
 * 
 * @todo Add section "FAQ" to readme.txt.
 */
class Admidio_Events_Widget extends WP_Widget {

	/**
	 * Regular expressions for extracting event date information.
	 * 
	 * @since 0.3.8
	 */
	private $date_formats;

	
	/**
	 * Widget class initialization (set up widget name etc).
	 * 
	 * @since 0.3.1
	 */
	function __construct() {

		// Create widget.
		parent::__construct(
			'admidio-events', // Base ID for CSS (usually appended by '-2', '-3', etc. depending on no of used widget instances).
			'Admidio Events', // Name used on widget configuration page.
			array(
				'classname' => 'admidio-events', // Class name for CSS.
				'description' => __( 'Event data from Admidio.', 'admidio-events' ), // Description used on widget configuration page.
			)
		);
		
		// Init private variable.
		$this->date_formats = array (
			'd.m.Y' => '/^(\d{2}\.\d{2}\.\d{4})( - )?(\d{2}\.\d{2}\.\d{4})?\s/',
			'd.m.'  => '/^(\d{2}\.\d{2}\.)( - )?(\d{2}\.\d{2}\.)?\s/',
			'Y-m-d' => '/^(\d{4}-\d{2}-\d{2})( - )?(\d{4}-\d{2}-\d{2})?\s/',
		);
		
		// Register style sheet and scripts.
		add_action( 'wp_enqueue_scripts', array( $this, 'register_frontend_styles_and_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_styles_and_scripts' ) );

	}


	/**
	 * Register and enqueue style sheet and javascript.
	 * 
	 * @see http://codex.wordpress.org/Function_Reference/wp_register_style/
	 * @see https://codex.wordpress.org/Function_Reference/wp_enqueue_style/
	 * 
	 * @since 0.3.1
	 */
	public function register_frontend_styles_and_scripts() {

		wp_enqueue_style( 'admidio-events', plugins_url( 'css/admidio-events.css', __FILE__ ), array(), false );
		wp_enqueue_script( 'admidio-events-js', plugins_url( 'js/admidio-events.js', __FILE__ ), array( 'jquery' ), false, true );

	}

	
	/**
	 * Register color picker.
	 * 
	 * @see http://make.wordpress.org/core/2012/11/30/new-color-picker-in-wp-3-5/
	 * 
	 * @since 0.3.7
	 */
	public function register_admin_styles_and_scripts( $hook ) {

		// We'll need the color picker only for widgets admin screen.
		if ( 'widgets.php' !== $hook ) {
			return;
		}
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'underscore' );
		wp_enqueue_script( 'admidio-events-admin-js', plugins_url( 'js/admidio-events-admin.js', __FILE__ ), array( 'wp-color-picker' ), false, true );

	}

	
	/**
	 * Echo the settings update form on backend.
	 * 
	 * @since 0.3.1
	 * 
	 * @param array $instance - Current settings.
	 */
	function form( $instance ) {

		// Set up default widget settings.
		$date_formats_temp = array_keys( $this->date_formats ); // temporary variable necessary for PHP versions 5.3 and older
		$defaults = array(
			'title'          => __( 'Upcoming Events', 'admidio-events' ),
			'rss_feed'       => '',
			'date_format'    => $date_formats_temp[0], // PHP 5.4 and higher: array_keys( $this->date_formats )[0],
			'no_of_items'    => '5',
			'show_date'      => '0',
			'date_color'     => '#888888',
			'start_expanded' => '0',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'admidio-events' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'rss_feed' ); ?>"><?php _e( 'Enter the event RSS feed URL here:', 'admidio-events' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'rss_feed' ); ?>" name="<?php echo $this->get_field_name( 'rss_feed' ); ?>" value="<?php echo $instance['rss_feed']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'date_format' ); ?>"><?php _e( 'Date format setting in Admidio:', 'admidio-events' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'date_format' ); ?>" name="<?php echo $this->get_field_name( 'date_format' ); ?>">
				<?php
					foreach ( array_keys( $this->date_formats ) as $date_format ) {
						echo '<option value="' . $date_format . '"', selected( $instance['date_format'], $date_format, false ), '>', $date_format, '</option>'; 
					}
				?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'no_of_items' ); ?>"><?php _e( 'How many events would you like to display?', 'admidio-events' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'no_of_items' ); ?>" name="<?php echo $this->get_field_name( 'no_of_items' ); ?>">
				<?php
					for ( $i = 1; $i <= 10; ++$i ) {
						echo '<option value="' . $i . '"', selected( $instance['no_of_items'], $i, false ), '>', $i, '</option>'; 
					}
				?>
			</select>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" type="checkbox" value="1" <?php checked( '1', $instance['show_date'] ); ?> />
			<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display event title with date?', 'admidio-events' ); ?></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'date_color' ); ?>"><?php _e( 'Date font color:', 'admidio-events' ); ?></label><br />
			<input type="text" class="date-color-picker" id="<?php echo $this->get_field_id( 'date_color' ); ?>" name="<?php echo $this->get_field_name( 'date_color' ); ?>" value="<?php echo $instance['date_color']; ?>" />
		</p>
		<p>
			<input id="<?php echo $this->get_field_id( 'start_expanded' ); ?>" name="<?php echo $this->get_field_name( 'start_expanded' ); ?>" type="checkbox" value="1" <?php checked( '1', $instance['start_expanded'] ); ?> />
			<label for="<?php echo $this->get_field_id( 'start_expanded' ); ?>"><?php _e( 'Start with expanded view?', 'admidio-events' ); ?></label>
		</p>
		
		<?php
	}


	/**
	 * Update a particular instance.
	 * 
	 * This function checks that *$new_instance* is set correctly. The newly calculated value of *$instance* should be returned.If *false* is returned, the instance won't be saved/updated.
	 * 
	 * @since 0.3.1
	 * 
	 * @param array $new_instance - New settings for this instance as input by the user via admin form.
	 * @param array $old_instance - Old settings for this instance.
	 * 
	 * @return array Settings to save or bool false to cancel saving.
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		// Strip tags to remove HTML.
		$instance['title']           = strip_tags( $new_instance['title'] );
		$instance['date_format']     = strip_tags( $new_instance['date_format'] );
		$instance['no_of_items']     = strip_tags( $new_instance['no_of_items'] );
		$instance['show_date']       = strip_tags( $new_instance['show_date'] );
		$instance['start_expanded']  = strip_tags( $new_instance['start_expanded'] );

		// Ensure that url contains scheme.
		$rss_feed_url = strip_tags( $new_instance['rss_feed'] );
		if ( parse_url( $rss_feed_url, PHP_URL_SCHEME ) === null ) {
			$rss_feed_url = 'http://' . $rss_feed_url;
		}
		$instance['rss_feed'] = $rss_feed_url;
 
		// Date color validation. If color code is not correct, use previous one.
		$date_color = strip_tags( $new_instance['date_color'] );
		preg_match( '/^#?([a-f0-9]{6})$/i', $date_color, $matches );
		if ( count( $matches) == 2 ) {
			$date_color = '#' . $matches[1];
		} else {
			$date_color = $old_instance['date_color'];
		}
		$instance['date_color'] = $date_color;

		return $instance;
	}


	/**
	 * Output the content of the widget.
	 * 
	 * @since 0.3.1
	 * 
	 * @param array $args - Display arguments including *before_title*, *after_title*, *before_widget*, and *after_widget*.
	 * @param array $instance - Settings for the particular instance of the widget.
	 */
	function widget( $args, $instance ) {
		
		// Get variables from the widget settings.
		$title = apply_filters( 'widget_title', $instance['title'] );
		$rss_feed = $instance['rss_feed'];
		$date_format = $instance['date_format'];
		$no_of_items = $instance['no_of_items'];
		$show_date = $instance['show_date'];
		$date_color = $instance['date_color'];
		$start_expanded = $instance['start_expanded'];


		if ($start_expanded) {
			$init_status_description = 'style="display: block;"';
			$init_icon = 'icon-collapse';
			$init_status_event_title = 'event-title-strong';
		} else {
			$init_status_description = 'style="display: none;"';
			$init_icon = 'icon-expand';
			$init_status_event_title = '';
		}
			
		
		// Before widget (defined by themes).
		extract( $args ); // Separate array $args into $before_widget, $before_title, etc.
		echo $before_widget;

		// Display the widget title (before and after defined by themes).
		echo $before_title . '<div class="text">' . $title . '</div><div class="icon ' . $init_icon . '"></div>' . $after_title;

		// Get RSS data and handle result.
		$rss_items = $this->get_rss_feed_data( $rss_feed, 20 );
		if ( $rss_items === false ) {

			_e( 'Error when fetching event data.', 'admidio-events' );

		} elseif ( empty( $rss_items ) ) {

			_e( 'No event data available.', 'admidio-events' );

		} else {

			// Extract Admidio data from RSS items.
			$admidio_data = $this->extract_admidio_data( $rss_items, $date_format );

			// Sort items for date.
			ksort( $admidio_data );

			$items_counter = 1;
			echo "<ul>";
			foreach ( $admidio_data as $value ) {
				echo '<li><span class="event-title ' . $init_status_event_title . '">' . $value['title'] . '</span>';
				if ( $show_date ) {
					echo '<span class="event-date" style="color: ' . $date_color . ';">' . $value['start_date'] . '</span>';
				}

				echo '<div class="admidio-events-description" ' . $init_status_description . '>' . $value['description'] . '</div>';

				echo '</li>';
				if ( $items_counter >= $no_of_items ) {
					break;
				}
				$items_counter++;
			}

			echo "</ul>";
		}

		// After widget (defined by themes).
		echo $after_widget;
	}

	
	/**
	 * Get rss feed data.
	 * 
	 * @since 0.3.1
	 * 
	 * @param string $rss_feed_url
	 * @param int $items_limit - Maximum number of items that are read from the rss url (0 = unlimited number).
	 * 
	 * @return mixed Array with rss feed items (reversely sorted by publishing date) or empty array. False if error occurred.
	 */

	function get_rss_feed_data( $rss_feed_url, $items_limit ) {

		/** 
		 * Get RSS Feed.
		 * @see https://codex.wordpress.org/Function_Reference/fetch_feed/
		 */
		include_once( ABSPATH . WPINC . '/feed.php' );

		// Change the feed cache lifetime from default value (12 hours) to 1 hour.
		add_filter( 'wp_feed_cache_transient_lifetime', array( $this, 'set_feed_cache_lifetime' ) );

		// Get a SimplePie feed object from the specified feed url.
		$rss = fetch_feed( $rss_feed_url );

		// Change the feed cache lifetime back to default value.
		remove_filter( 'wp_feed_cache_transient_lifetime', array( $this, 'set_feed_cache_lifetime' ) );
		
		// The SimplePie feed object has an auto-detection built in. So when a wrong url is given,
		// it tries to find a suitable one. We cannot use this feature here because we have to ensure 
		// correct data content.
		if ( strcasecmp( $rss_feed_url,$rss->feed_url ) != 0 ) {
			return false;
		}

		// Checks that the object was created correctly		
		if ( ! is_wp_error( $rss ) ) {

			// Figure out how many total items there are, but limit it to $items_limit. 
			$maxitems = $rss->get_item_quantity( $items_limit ); 
			
			if ( $maxitems>0) {
				// Build an array of all the items, starting with element 0 (first element).
				return $rss->get_items( 0, $maxitems );
			}
			return array();
		}
		return false;
	}
	
	
	/**
	 * Set feed cache lifetime
	 * 
	 * @see https://codex.wordpress.org/Plugin_API/Filter_Reference/wp_feed_cache_transient_lifetime/
	 * @since 0.3.1
	 * 
	 * @param int $seconds - Time in seconds between cache recreation.
	 * @return int New time.
	 */
	public function set_feed_cache_lifetime( $seconds ) {
		return 60;
	}

	
	/**
	 * Extract Admidio data from rss items.
	 * 
	 * @since 0.3.1
	 * 
	 * @param array $rss_items
	 * @param string $date_format
	 * @return array Extracted Admidio data.
	 */
	function extract_admidio_data( $rss_items, $date_format ) {

		$admidio_data = array();
		foreach ( $rss_items as $item ) {

			// Check for correct date format setting.
			$admidio_title = $item->get_title();
			preg_match( $this->date_formats[ $date_format ], $admidio_title, $matches );
			if ( ( ( count( $matches ) === 2 ) or ( count( $matches ) === 4 ) ) and ( date_create_from_format( $date_format, $matches[1] ) !== FALSE ) ) {
				
				// Remove date(s) from title.
				$admidio_title = str_replace( $matches[0],'',$admidio_title );

				// Convert formatting to make it usable for sorting and for pretty display.
				$admidio_start_date_key = date_format( date_create_from_format( $date_format, $matches[1]), 'Y-m-d' );
				$admidio_start_date_pretty = date_i18n( get_option( 'date_format' ), strtotime( $admidio_start_date_key ) );

				// Get description, decode HTML entities back to characters, remove any number of break tags directly followed by link tag at the end.
				$admidio_description_raw = preg_replace( '/(<br \/>)+<a.*<\/a>$/', '', htmlspecialchars_decode( $item->get_description(), ENT_QUOTES ) );

				// Replace two "<br />" by one and delete any Line Feeds and Tabs. Strip tags except for break tags.
				$admidio_description = strip_tags( str_replace( array('<br /><br />', "\n", "\t"), array('<br />','',''), $admidio_description_raw ), '<br>' );

				// Get start time for finer sorting.
				$admidio_start_time_key = substr( $admidio_description, strlen( $matches[1] ) + 1, 5 );
				if ( date_create_from_format( 'H:i', $admidio_start_time_key ) === FALSE ) {
					$admidio_start_time_key = '00:00';
				}
				
			} else {

				$admidio_title             = __( 'Invalid event data.', 'admidio-events' );
				$admidio_start_date_key    = '';
				$admidio_start_date_pretty = '';
				$admidio_start_time_key    = '';
				$admidio_description       = '';

			}
			
			// Create array for sorting.
			$admidio_data[$admidio_start_date_key . ' ' . $admidio_start_time_key] = array( 'title' => $admidio_title, 'start_date' => $admidio_start_date_pretty, 'description' => $admidio_description );

		} // foreach ( $rss_items as $item )...
		return $admidio_data;
	}
	
} // class Admidio_Events_Widget ...


/**
 * Register widget *Admidio_Events_Widget*.
 * 
 * @since 0.3.1
 */
add_action( 'widgets_init', function(){
	register_widget( 'Admidio_Events_Widget' );
});


// Load language file.
$plugin_dir = basename( dirname( __FILE__ ) );
load_plugin_textdomain( 'admidio-events', null, $plugin_dir . '/languages/' );


?>