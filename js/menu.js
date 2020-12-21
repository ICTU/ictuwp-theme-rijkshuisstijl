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


var menu_open = menumenu.menu_open,
    menu_close = menumenu.menu_close,
    search_open = menumenu.search_open,
    search_close = menumenu.search_close;


// Vars
var buttons_container = document.getElementById("buttons_container"),
    menu_container = document.getElementById("menu_container"),
    menu_button = document.getElementById("menu_button"),
    search_container = document.getElementById("search_container"),
    search_button = document.getElementById("search_button"),
    navsecondary = document.getElementsByClassName('nav-secondary')[0];

// =========================================================================================================

function hidemenu_button(document, window, undefined) {

    if (typeof (navsecondary) !== 'undefined' && navsecondary !== null) {
        navsecondary.hidden = false;
    }
    if (typeof (menu_container) !== 'undefined' && menu_container !== null) {
        menu_container.hidden = false;
    }
    if (typeof (search_container) !== 'undefined' && search_container !== null) {
        search_container.hidden = false;
    }

}

// =========================================================================================================


// =========================================================================================================

function showmenu_button(document, window, undefined) {

    // is er uberhaupt een zoekformulier?
    if (typeof (search_container) !== 'undefined' && search_container !== null) {

        // ja, er is een zoekformulier

        // dan checken of de button voor het zoeken al bestaat
        if (typeof (search_button) === 'undefined' || search_button === null) {
            // bestaat nog niet, dus maken
            search_button = document.createElement('button');
            search_button.setAttribute('id', 'search_button');
            search_button.setAttribute('class', 'open');
            search_button.setAttribute('aria-expanded', 'false');
            search_button.setAttribute('aria-controls', 'menu_container');
            search_button.innerHTML = '<span class="label">' + search_open + '</span><span class="icon">&nbsp;</span>';
            buttons_container.appendChild(search_button);
        }


        if (typeof (search_button) !== 'undefined' && search_button !== null) {

            search_button.classList.remove('init');
            search_button.classList.add('closed');

            search_container.classList.remove('init');
            search_container.classList.add('closed');
            search_container.hidden = true;
            search_container.setAttribute('aria-expanded', 'false');

            search_button.addEventListener('click', function () {

                // Als het zoekformulier niet zichtbaar is
                if (search_container.classList.contains('closed')) {

                    // ..dan maken we het weer zichtbaar
                    search_container.classList.remove('closed');
                    search_container.classList.add('opened');
                    search_container.setAttribute('aria-expanded', 'true');
                    search_container.hidden = false;

                    search_button.setAttribute('aria-label', search_open);
                    search_button.setAttribute('aria-expanded', 'false');
                    search_button.classList.remove('closed');
                    search_button.classList.add('opened');
                    search_button.querySelector('.label').innerHTML = search_close;

                } else {

                    // zoekformulier is wel zichtbaar, dus weer verbergen
                    search_container.classList.add('closed');
                    search_container.classList.remove('opened');
                    search_container.setAttribute('aria-expanded', 'false');
                    search_container.hidden = true;

                    search_button.setAttribute('aria-label', search_close);
                    search_button.setAttribute('aria-expanded', 'true');
                    search_button.classList.remove('opened');
                    search_button.classList.add('closed');
                    search_button.querySelector('.label').innerHTML = search_close;

                }
            }, false);
        }
    }

    // is er uberhaupt een menu?
    if (typeof (menu_container) !== 'undefined' && menu_container !== null) {

        // ja, er is een menu

        // dan eerst checken of de button voor het menu al bestaat
        if (typeof (menu_button) === 'undefined' || menu_button === null) {
            // bestaat nog niet, dus maken
            // Create a link to home
            menu_button = document.createElement('button');
            menu_button.setAttribute('id', 'menu_button');
            menu_button.setAttribute('class', 'closed');
            menu_button.setAttribute('aria-expanded', 'false');
            menu_button.setAttribute('aria-controls', 'menu_container');
            menu_button.innerHTML = '<span class="label">' + menu_open + '</span><span class="icon">&nbsp;</span>';
            buttons_container.appendChild(menu_button);
        }


        if (typeof (menu_button) !== 'undefined' && menu_button !== null) {

            menu_button.classList.remove('init');
            menu_button.classList.add('closed');

            menu_container.classList.remove('init');
            menu_container.classList.add('closed');
            menu_container.hidden = true;
            menu_container.setAttribute('aria-expanded', 'false');

            menu_button.addEventListener('click', function () {

                // Als het menu niet zichtbaar is
                if (menu_container.classList.contains('closed')) {

                    // ..dan maken we het weer zichtbaar
                    menu_container.classList.remove('closed');
                    menu_container.classList.add('opened');
                    menu_container.setAttribute('aria-expanded', 'true');
                    menu_container.hidden = false;

                    menu_button.setAttribute('aria-label', menu_open);
                    menu_button.setAttribute('aria-expanded', 'true');
                    menu_button.classList.remove('closed');
                    menu_button.classList.add('opened');
                    menu_button.querySelector('.label').innerHTML = menu_close;

                } else {

                    // menu is wel zichtbaar, dus weer verbergen
                    menu_container.classList.add('closed');
                    menu_container.classList.remove('opened');
                    menu_container.setAttribute('aria-expanded', 'false');
                    menu_container.hidden = true;

                    menu_button.setAttribute('aria-label', menu_close);
                    menu_button.setAttribute('aria-expanded', 'false');
                    menu_button.classList.remove('opened');
                    menu_button.classList.add('closed');
                    menu_button.querySelector('.label').innerHTML = menu_close;

                }
            }, false);
        }
    }

    if (typeof (navsecondary) !== 'undefined' && navsecondary !== null) {
        navsecondary.hidden = true;
    }

}


// =========================================================================================================

// media query change
function WidthChange(mq) {

    if (mq.matches) {
        // window width is at least 760px
        // don't show menu button
        hidemenu_button(document, window);
    } else {
        // window width is less than 760px
        // DO show menu button
        showmenu_button(document, window);
    }

}

// =========================================================================================================

var mq = window.matchMedia('(min-width: 760px)');

// media query event handler
//if (matchMedia) {

//	if ( mq.addListener ) {
mq.addListener(WidthChange);
//	}
WidthChange(mq);

//}

// =========================================================================================================
