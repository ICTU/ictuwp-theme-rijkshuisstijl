
//
// Gebruiker Centraal - menu.js
// ----------------------------------------------------------------------------------
// Script voor het tonen / verbergen van de menu-hamburger op smalle schermpjes
// ----------------------------------------------------------------------------------
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @package wp-rijkshuisstijl
// * @version 2.12.13.a
// * @desc.   Menu-knop gereactiveerd voor mobiele schermen.
// * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl

// Vars
var header      = document.querySelector('#skiplinkscontainer'),
    menu        = document.querySelector('.nav-primary'),
    menuButton  = document.querySelector('.menu-button');


// =========================================================================================================

function hideMenuButton(document, window, undefined) {
	
	header.classList.remove('menu-met-js');
	header.classList.remove('active');
	header.classList.add('geen-menu-button');
	menu.setAttribute('aria-hidden', 'false');
	
	var ele = document.getElementById("menu-button");
	
	if (ele) {
		// Remove button from page
		header.removeChild(menuButton);
	}
}

// =========================================================================================================

function showMenuButton(document, window, undefined) {
	
	'use strict';

			window.alert('menu ja');
	
	header.classList.add('menu-met-js');
	header.classList.remove('geen-menu-button');
	
	menuButton = document.createElement('button');

	// Button properties
	menuButton.classList.add('menu-button');
	menuButton.setAttribute('id', 'menu-button');
	menuButton.setAttribute('aria-label', 'Menu');
	menuButton.setAttribute('aria-expanded', 'false');
	menuButton.setAttribute('aria-controls', 'menu');
	menuButton.innerHTML = '<i>&#x2261;</i><b>&nbsp;menu</b>';
	
	// Menu properties
//	menu.setAttribute('aria-hidden', 'true');
	menu.setAttribute('aria-labelledby', 'menu-button');
	
	// Add button to page
	header.insertBefore(menuButton, menu);
	// var insertedNode = parentNode.insertBefore(newNode, referenceNode);
	
	// Handle button click event
	menuButton.addEventListener('click', function () {
		
		// If active...
		if (menu.classList.contains('active')) {

			// Hide
			
			header.classList.remove('active');
			
			menu.classList.remove('active');
			menu.setAttribute('aria-hidden', 'true');
			menuButton.setAttribute('aria-label', 'Open menu');
			menuButton.innerHTML = '<i>&#x2261;</i><b>&nbsp;menu</b>';
			
			menuButton.setAttribute('aria-expanded', 'false');
		} 
		else {
			// Show
			
			header.classList.add('active');
			
			menu.classList.add('active');
			menu.setAttribute('aria-hidden', 'false');
			menuButton.setAttribute('aria-label', 'Sluit menu');
			menuButton.innerHTML = '<i>X</i><b>&nbsp;Sluit menu</b>';
			
			menuButton.setAttribute('aria-expanded', 'true');
			
		}
	}, false);

}

// =========================================================================================================

// media query change
function WidthChange(mq) {
	
	if ( mq.addListener ) {

		
		if (mq.matches) {
			// window width is at least 900px
			// don't show menu button
			hideMenuButton(document, window);
		}
		else {
			// window width is less than 900px
			// DO show menu button
			showMenuButton(document, window);
		}
	}
}

// =========================================================================================================

// media query event handler
if (matchMedia) {
	var mq = window.matchMedia('(min-width: 900px)');
	if ( mq.addListener ) {
		mq.addListener( WidthChange );
	}
	WidthChange(mq);
}

// =========================================================================================================

