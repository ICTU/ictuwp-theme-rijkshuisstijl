/*

// * Rijkshuisstijl (Digitale Overheid) - details-element.js
// * ----------------------------------------------------------------------------------
// * Polyfill voor IE / Edge en knuppelbrowsers die details/summary tag niet kennen
// * ----------------------------------------------------------------------------------
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @package wp-rijkshuisstijl
// * @version 2.9.3
// * @desc.   JS + CSS voor inklapbare blokken.
// * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */


var alledetailstags = document.querySelectorAll("details");
var currentElement, parent_of_element;

if ( alledetailstags.length > 1 ) {

  // live-region toevoegen
  var liveregion_detailsummary = '';

  function detailsbuttonListenFunc(event) {

    var buttonlabel = this.innerHTML;
    var newlabel    = detailssummarytranslate.close;

    
    if ( buttonlabel == detailssummarytranslate.open ) {

      this.innerHTML = detailssummarytranslate.close;
      liveregion_detailsummary.textContent = detailssummarytranslate.detailsbutton_resultclose;

      for( var i = 0; i < alledetailstags.length; i++) {
        alledetailstags[i].setAttribute('open','');
      }
      
    }
    else {

      newlabel = detailssummarytranslate.open;
      liveregion_detailsummary.textContent = detailssummarytranslate.detailsbutton_resultopen;

      for( var i = 0; i < alledetailstags.length; i++) {
        alledetailstags[i].removeAttribute('open');
      }
    }

    var allebuttons = document.querySelectorAll("button.openbutton");

    for( var i = 0; i < allebuttons.length; i++) {
      allebuttons[i].innerHTML = newlabel;
    }
    
  }
  
  for( var i = 0; i < alledetailstags.length; i++) {
    
    currentElement      = alledetailstags[i];
    parent_of_element   = currentElement.parentNode
    var newNode         = document.createElement("button");

    if ( i == 0 ) {

      // vlak voor de eerste <details> een live region toevoegen
      var myNewLiveRegion = document.createElement("div");
      myNewLiveRegion.setAttribute('role','region');
      myNewLiveRegion.setAttribute('id','liveregion_detailsummary');
      myNewLiveRegion.setAttribute('aria-live','polite');
      myNewLiveRegion.innerHTML = 'Hier een paragraaf';

      var thelabel = detailssummarytranslate.detailsbutton_init.replace("__NUMBER__",  alledetailstags.length );      

      myNewLiveRegion.textContent = thelabel;
      
      parent_of_element.insertBefore( myNewLiveRegion, currentElement );

      liveregion_detailsummary = document.querySelector('#liveregion_detailsummary');
      
      // en vlak voor de eerste <details> een knop toevoegen
      newNode.innerHTML = detailssummarytranslate.open;
       
      // Handle button click event
      newNode.addEventListener('click', detailsbuttonListenFunc );    
      newNode.classList.add('openbutton');
      
      parent_of_element.insertBefore( newNode, currentElement );
      
      
    }
    
    if ( i == ( alledetailstags.length - 1 ) ) {

      // na het laatste element de knop toevoegen
      newNode.innerHTML = detailssummarytranslate.open;
      newNode.classList.add('openbutton');
      
      // Handle button click event
      newNode.addEventListener('click', detailsbuttonListenFunc );    
      parent_of_element.insertBefore( newNode, currentElement.nextSibling );

    }
  }
}


// source (eh, inspiration) inclusive-components.design/collapsible-sections/
(function() {
	var headings = document.querySelectorAll('.collapsetoggle');
	for( var i = 0; i < headings.length; i++) {
		var btn		= headings[i].querySelector('button');
		btn.onclick = function(e) {

			var expanded	= this.getAttribute('aria-expanded') === 'true' || false;
			var target		= this.parentElement.nextElementSibling;

			if ( expanded ) {
				this.setAttribute('aria-expanded', false );
				target.setAttribute('hidden', 'hidden');
			}
			else {
				this.setAttribute('aria-expanded', true );
				target.removeAttribute('hidden');
			}
		}
	}
})();

  
