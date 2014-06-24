/**
 * Plugin Name: Admidio Events
 * Plugin URI:  http://fechten-in-waldkirch.de/
 * Description: A widget that displays dates from Admidio's dates module via RSS.
 * Version:     0.3.3
 * Author:      Ulrik Schoth
 * Author URI:  http://fechten-in-waldkirch.de/kontakt/webmaster/
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
 * Clicking in headline of widget toggles visibility of corresponding descriptions.
 * @since 0.3.1
 */
jQuery( '.admidio-events .widget-title .icon' ).click( function() {

	var myWidgetInstance = jQuery( this ).parent().parent();
	
	// Update title formatting and icon.
	if ( myWidgetInstance.find( '.admidio-events-description' ).is( ':hidden' ) ) {
	
		myWidgetInstance.find( '.admidio-events-title' ).addClass( 'admidio-events-title-strong' );
		myWidgetInstance.find( '.icon' ).removeClass( 'icon-expand' ).addClass( 'icon-collapse' );
		
	} else {
	
		myWidgetInstance.find( '.admidio-events-title' ).removeClass( 'admidio-events-title-strong' );
		myWidgetInstance.find( '.icon' ).addClass( 'icon-expand' ).removeClass( 'icon-collapse' );
		
	};

	// Toggle visibility of all descriptions in this widget instance.
	myWidgetInstance.find( '.admidio-events-description' ).slideToggle( 'slow', function() {
		//
	});
	
});
