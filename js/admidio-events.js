/**
 * Plugin Name: Admidio Events
 * Plugin URI:  http://wordpress.org/plugins/admidio-events/
 * Description: A widget that displays event data from the online membership management system Admidio.
 * Version:     0.3.8
 * Author:      Ulrik Schoth
 * Author URI:  http://profiles.wordpress.org/fiwad/
 *
 * Module:      admidio-events.js
 * Description: Handling of expanded and collapsed view.
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
 * Clicking on widget title toggles visibility of descriptions.
 * @since 0.3.1
 */
jQuery( '.admidio-events .widget-title' ).click( function() {

	var myWidgetInstance = jQuery( this ).parent();
	
	// If slideToogle animation of last click is still running: complete it immediately.
	myWidgetInstance.find( '.admidio-events-description' ).stop( false, true );

	// Update event title formatting and icon.
	if ( myWidgetInstance.find( '.admidio-events-description' ).is( ':hidden' ) ) {
	
		myWidgetInstance.find( '.event-title' ).addClass( 'event-title-strong' );
		myWidgetInstance.find( '.icon' ).removeClass( 'icon-expand' ).addClass( 'icon-collapse' );
		
	} else {
	
		myWidgetInstance.find( '.event-title' ).removeClass( 'event-title-strong' );
		myWidgetInstance.find( '.icon' ).addClass( 'icon-expand' ).removeClass( 'icon-collapse' );
		
	};

	// Toggle visibility of all descriptions in this widget instance.
	myWidgetInstance.find( '.admidio-events-description' ).slideToggle( 'slow', function() {
		//
	});
	
});
