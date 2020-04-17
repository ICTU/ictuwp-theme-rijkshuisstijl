
//
// Gebruiker Centraal - menu.js
// ----------------------------------------------------------------------------------
// Script voor het tonen / verbergen van de menu-hamburger op smalle schermpjes
// ----------------------------------------------------------------------------------
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @package wp-rijkshuisstijl
// * @version 2.14.2
// * @desc.   Menu verbouwd zodat bij schermbreedtewijzigingen wel of niet de mobiele styling gebruikt wordt
// * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl

// Vars
var header      	= document.querySelector('#genesis-nav-primary'),
    menu        	= document.querySelector('nav .wrap ul.menu'),
    menuButton  	= document.querySelector('.menu-button'),
    menuwrapper 	= header.querySelector(".wrap"),
    herosearchform	= document.getElementById("herosearchform"),
    heroimage 		= document.querySelector('.hero-image .wrapper');

// =========================================================================================================

function hideMenuButton(document, window, undefined) {

	header.classList.remove('menu-met-js');
	header.classList.remove('active');
	header.classList.add('geen-menu-button');
	menu.setAttribute('aria-hidden', 'false');
	
	if ( ( typeof(menuwrapper) != 'undefined' && menuwrapper != null) )  {
	
		var div_homelink_button = document.getElementById("homelink_button");
		
		// search form terugplaatsen in hero-image
		if ( ( typeof(herosearchform) != 'undefined' && herosearchform != null) )  {
			heroimage.append(herosearchform);
		}

		if ( ( typeof(menu) != 'undefined' && menu != null) )  {
			
			var home_exists  = document.querySelector('li.home');
			
			if ( ( typeof(home_exists) != 'undefined' && home_exists != null) )  {
				// listitem with class .home already exists
				// no need to reinsert it
			} else {

				var lihome	= document.createElement('li');
				lihome.setAttribute('class', 'home');
				lihome.innerHTML 		= '<a href="/">Home</a>';

				var theP = div_homelink_button.querySelector('p');

				if (theP.classList.contains('is_home')) {

					lihome.classList.add('current-menu-item');
				}	
				
				menu.insertBefore(lihome, menu.childNodes[0]);
			}
		}

		if ( ( typeof(div_homelink_button) != 'undefined' && div_homelink_button != null) )  {
			// Remove button from page
			menuwrapper.removeChild(div_homelink_button);
		}
		

	
	}
}

// =========================================================================================================

function showMenuButton(document, window, undefined) {
	
	'use strict';

	if ( ( typeof(menuwrapper) != 'undefined' && menuwrapper != null) )  {

		if ( ( typeof(herosearchform) != 'undefined' && herosearchform != null) )  {
			menuwrapper.prepend(herosearchform);
		}

		var listitem_home_a 	= '<a href="/">Home</a>';
		var div_homelink_button	= document.createElement('div');
		var lihome 				= menuwrapper.querySelector("li.home");

		// Create a link to home
		menuButton = document.createElement('p');
		menuButton.innerHTML = listitem_home_a;

		
		div_homelink_button.setAttribute('id', 'homelink_button');
		menuwrapper.prepend( div_homelink_button );

		if ( ( typeof(lihome) != 'undefined' && lihome != null) )  {
			// er is een list-item met class home in de wrapper
			listitem_home_a 		= lihome.innerHTML;

			if (lihome.classList.contains('current-menu-item')) {
				menuButton.classList.add('is_home');
			}	

			lihome.remove();
		}


		div_homelink_button.appendChild(menuButton);

		// Create a button and set properties
		menuButton = document.createElement('button');
		menuButton.classList.add('menu-button');
		menuButton.setAttribute('id', 'menu-button');
		menuButton.setAttribute('aria-label', 'Menu');
		menuButton.setAttribute('aria-expanded', 'false');
		menuButton.setAttribute('aria-controls', 'menu');
		menuButton.innerHTML = '<b>menu</b>';
		div_homelink_button.appendChild(menuButton);

		if (header.classList.contains('init')) {

			// Hide
			header.classList.remove('init');
			menu.classList.remove('active');
			menu.setAttribute('aria-hidden', 'true');
			menuButton.setAttribute('aria-label', 'Open menu');
			menuButton.setAttribute('aria-expanded', 'false');
			
		} else {

			menu.setAttribute('aria-hidden', 'true');

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

// =========================================================================================================

var mq = window.matchMedia('(min-width: 900px)');

// media query event handler
//if (matchMedia) {
	
//	if ( mq.addListener ) {
		mq.addListener( WidthChange );
//	}
	WidthChange(mq);

//}

// =========================================================================================================
