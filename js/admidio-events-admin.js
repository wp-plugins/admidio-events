/**
 * Plugin Name: Admidio Events
 * Plugin URI:  http://wordpress.org/plugins/admidio-events/
 * Description: A widget that displays event data from the online membership management system Admidio.
 * Version:     0.4.2
 * Author:      Ulrik Schoth
 * Author URI:  http://profiles.wordpress.org/fiwad/
 *
 * Module:      admidio-events-admin.js
 * Description: Helper functions for admin screen.
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
 * Color picker to select date color in admin screen.
 * 
 * @see https://core.trac.wordpress.org/ticket/25809
 * @see https://core.trac.wordpress.org/ticket/19675
 * 
 * @since 0.3.7
 */
( function( $ ){
	
	function initColorPicker( widget ) {
		widget.find( '.date-color-picker' ).wpColorPicker( {
			change: _.throttle( function() { // For Customizer
				jQuery(this).trigger( 'change' );
			}, 3000 )
		});
	}

	function onFormUpdate( event, widget ) {
		initColorPicker( widget );
	}

	jQuery( document ).on( 'widget-added widget-updated', onFormUpdate );

	jQuery( document ).ready( function() {
		$( '#widgets-right .widget:has(.date-color-picker)' ).each( function () {
			initColorPicker( jQuery( this ) );
		} );
	} );
	
}( jQuery ) );
