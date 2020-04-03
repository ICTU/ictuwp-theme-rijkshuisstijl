
//
// Gebruiker Centraal - menu.js
// ----------------------------------------------------------------------------------
// Script voor het tonen / verbergen van de menu-hamburger op smalle schermpjes
// ----------------------------------------------------------------------------------
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @package wp-rijkshuisstijl
// * @version 2.14.2
// * @desc.   Menu herzien voor mobiel schermbreedtes.
// * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl

// Vars
var header      = document.querySelector('#genesis-nav-primary'),
    menu        = document.querySelector('nav .wrap ul.menu'),
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

	//Attempt to get the element using document.getElementById
	var herosearchform		= document.getElementById("herosearchform");
	var menuwrapper 		= header.querySelector(".wrap");
	
	if ( ( typeof(menuwrapper) != 'undefined' && menuwrapper != null) )  {

		if ( ( typeof(herosearchform) != 'undefined' && herosearchform != null) )  {
			menuwrapper.prepend(herosearchform);
		}

		var listitem_home_a = '<a href="/">Home</a>';
		var divcontainer	= document.createElement('div');
		var lihome 			= menuwrapper.querySelector("li.home");
		
		divcontainer.setAttribute('id', 'homelink_button');
		menuwrapper.prepend( divcontainer );

		if ( ( typeof(lihome) != 'undefined' && lihome != null) )  {
			// er is een list-item met class home in de wrapper
			listitem_home_a 		= lihome.innerHTML;
			lihome.remove();
		}

		// Create a link to home
		menuButton = document.createElement('p');
		menuButton.innerHTML = listitem_home_a;
		divcontainer.appendChild(menuButton);

		// Create a button and set properties
		menuButton = document.createElement('button');
		menuButton.classList.add('menu-button');
		menuButton.setAttribute('id', 'menu-button');
		menuButton.setAttribute('aria-label', 'Menu');
		menuButton.setAttribute('aria-expanded', 'false');
		menuButton.setAttribute('aria-controls', 'menu');
		menuButton.innerHTML = '<b>menu</b>';
		divcontainer.appendChild(menuButton);

		if (header.classList.contains('init')) {

			// Hide
			header.classList.remove('init');
			menu.classList.remove('active');
			menu.setAttribute('aria-hidden', 'true');
			menuButton.setAttribute('aria-label', 'Open menu');
			menuButton.setAttribute('aria-expanded', 'false');
			
		}
	}

	// Menu properties
	menu.setAttribute('aria-labelledby', 'menu-button');
	
	header.classList.add('menu-met-js');
	header.classList.remove('geen-menu-button');

	// Handle button click event
	menuButton.addEventListener('click', function () {
		
		// If active...
		if (menu.classList.contains('active')) {

			// Hide
			header.classList.remove('active');
			menu.classList.remove('active');
			menu.setAttribute('aria-hidden', 'true');
			menuButton.setAttribute('aria-label', 'Open menu');
			menuButton.setAttribute('aria-expanded', 'false');
		} 
		else {

			// Show
			header.classList.add('active');
			menu.classList.add('active');
			menu.setAttribute('aria-hidden', 'false');
			menuButton.setAttribute('aria-label', 'Sluit menu');
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

