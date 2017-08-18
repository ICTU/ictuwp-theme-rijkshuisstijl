
// Optimaal Digitaal sortfunctions.js
// ----------------------------------------------------------------------------------
// dit script zorgt voor de filtering aan de voorkant
// ----------------------------------------------------------------------------------
// @package optimaal-digitaal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 0.9.6
// @desc.   Filter op onderwerppagina.
// @link    https://github.com/ICTU/optimaal-digitaal-wordpress-theme

// ============================================================================================================================================
// http://codepen.io/patrickkunka/pen/KpVPWo
// To keep our code clean and modular, all custom functionality will be contained inside a single object literal called "rhswp_mixitupfilter".

// http://www.quirksmode.org/js/cookies.html
function createCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

function eraseCookie(name) {
	createCookie(name,"",-1);
}

var rhswp_mixitupfilter = {
  
  // Declare any variables we will need as properties of the object
  
  $filterGroups: null,
  $filterUi: null,
  $resetbutton: null,
  groups: [],
  outputArray: [],
  outputString: '',
  
  // The "init" method will run on document ready and cache any jQuery objects we will need.
  
  init: function(){
    var self = this; // As a best practice, in each method we will asign "this" to the variable "self" so that it remains scope-agnostic. We will use it to refer to the parent "checkboxFilter" object so that we can share methods and properties between all parts of the object.

  self.$filterUi		  = jQuery('#rhswp-searchform-onderwerpen');
  self.$filterGroups	= jQuery('.filter-group');
  self.$resetbutton 	= jQuery('.reset');
  self.$container 	  = jQuery('#cardflex_tab1');

  var now = new Date();
  now.setDate( now.getDate() + 1 );
  
  self.$cookieExpiration      = now.toUTCString();
  self.$cookieFilterKeyword   = 'do_filter_keyword';
  self.$cookieCheckboxPrefix  = 'do_filter_checkbox_';
  self.$cookieChecked         = 'do_filter_checkbox_checked';
  

	self.$resetbutton.hide();
    
    self.$filterGroups.each(function(){
      self.groups.push({
        $inputs: jQuery(this).find('input'),
        active: [],
		    tracker: false
      });
    });

	window.addEventListener( 'keydown', function( ev ) {
		self.checkKeyboard(ev);
	});
    
    self.bindHandlers();
  },


  checkSavedSelection: function(){

    var self = this;

    var cookieFilterKeyword  = readCookie(self.$cookieFilterKeyword);
    if (  !cookieFilterKeyword ) {
       // no cookie     
    }
    else {
      self.$filterUi.find('input[type="search"]').val( cookieFilterKeyword );
    }

    self.parseFilters();

  },

  
  // The "bindHandlers" method will listen for whenever a form value changes. 
  
  bindHandlers: function(){
    var self			    = this,
        typingDelay 	= 300,
        typingTimeout = -1,
        resetTimer 		= function() {
          //'.search'
          clearTimeout(typingTimeout);
          typingTimeout = setTimeout(function() {
            self.parseFilters();
          }, typingDelay);
        };
    
    self.$filterGroups
      .filter('.checkboxes')
    	.on('change', function() {
      	self.parseFilters();
    	});

    self.$filterGroups
      .filter('.searchkeyword')
      .on('keyup change', resetTimer);
    
    self.$resetbutton.on('click', function(e){
  		e.preventDefault();
  		self.clearSelection();
  		self.$filterUi.find('.search').val('');
    });
  },
	checkKeyboard: function (ev) {
    var self = this, 
        currentThingy = jQuery(':focus');

    if( currentThingy.closest("#rhswp-searchform-onderwerpen").length > 0 ) {
        // alleen actief checken als we in de filter tips zitten    
      
//      console.log('knopppies drukken? ' + ev.which + ', type of current focus: ' + currentThingy.attr('type') );
      
      if (ev.which === 13) {
        // enter key
        
        if ( currentThingy.attr('type') === 'checkbox' ) {
        
          ev.preventDefault();
          
          if ( currentThingy.attr('type') === 'checkbox' ) {
            self.toggleCheckbox(ev);
          }
          
        }
        else if ( currentThingy.attr('type') === 'search' ) {
          // the input box for keyword filter
          ev.preventDefault();

        }
        else if ( currentThingy.attr('type') === 'button' ) {
        // do not ev.preventDefault();
        }
        else {
        // do not ev.preventDefault();
        }
        
      }
      // esc toets wordt al beluisterd door het menu
//      if (ev.which === 27) {
//        // esc key
//        ev.stopPropagation();
//        ev.preventDefault();
//        self.clearSelection();
//      }
    }

	},
  
  // The parseFilters method checks which filters are active in each group:


  clearSelection: function(){
    var self = this;
      self.$filterUi.find('input[type="search"]').val('');

    eraseCookie(self.$cookieFilterKeyword);

		for(var i = 0, group; group = self.groups[i]; i++){
			group.$inputs.each(function(){
				var $input = jQuery(this);
				
				$input.parent().removeClass('active');
				
				if ($input.is(':checked')) {
					$input.removeAttr('checked');
				}

        eraseCookie(self.$cookieCheckboxPrefix + $input.attr('id'));

			});
		}
    self.parseFilters();

	},

	toggleCheckbox: function(ev){
    var self = this,
        currentThingy = jQuery( document.activeElement );

    if ( currentThingy.attr('type') === 'checkbox' ) {
      
      if ( currentThingy.is(':checked') ) {
        currentThingy.prop( "checked", false );
      }
      else {
        currentThingy.prop( "checked", true );
      }
    }
		self.parseFilters();
	},

  
  parseFilters: function(){
    var self = this;
 
    // loop through each filter group and add active filters to arrays
    
    for(var i = 0, group; group = self.groups[i]; i++){
      group.active = []; // reset arrays
      group.$inputs.each(function(){

      var searchTerm		= '',
          $input			  = jQuery(this),
          minimumLength = 3;

			$input.parent().removeClass('active');

      var theCookieID     = self.$cookieCheckboxPrefix + $input.attr('id');
      var theCookieState  = '';
        
			if ($input.is(':checked')) {
        theCookieState  = self.$cookieChecked;
        $input.parent().addClass('active');
        group.active.push(this.value);
			}

      createCookie(theCookieID,theCookieState,1);

        if ($input.is('[type="search"]') && this.value.length >= minimumLength) {

          searchTerm = this.value
            .trim()
            .toLowerCase()
            .replace(' ', '-');


          createCookie(self.$cookieFilterKeyword,searchTerm,1);

          group.active[0] = '[data-titel*="' + searchTerm + '"]'; 

        }
        else {
          eraseCookie(self.$cookieFilterKeyword);
          
        }
      });
	    group.active.length && (group.tracker = 0);
    }
    
    self.concatenate();
  },
  
  // The "concatenate" method will crawl through each group, concatenating filters as desired:
  
  concatenate: function(){

//    console.log("concatenating!");

    var self = this,
		cache = '',
		crawled = false,
		checkTrackers = function(){
			var done = 0;
			
			for(var i = 0, group; group = self.groups[i]; i++){
				(group.tracker === false) && done++;
			}
			
			return (done < self.groups.length);
		},
		crawl = function(){
			for(var i = 0, group; group = self.groups[i]; i++){
  			
//  			console.log("crawl group! (" + i + ")");
  			
				group.active[group.tracker] && (cache += group.active[group.tracker]);
				
				if(i === self.groups.length - 1){
					self.outputArray.push(cache);
					cache = '';
					updateTrackers();
				}
			}
		},
		updateTrackers = function(){
			for(var i = self.groups.length - 1; i > -1; i--){
				var group = self.groups[i];
//  			console.log("updateTrackers group! (" + i + ")");
				
				if(group.active[group.tracker + 1]){
					group.tracker++; 
					break;
				}
				else if(i > 0){
					group.tracker && (group.tracker = 0);
				}
				else {
					crawled = true;
				}
			}
		};

	self.outputArray = []; // reset output array
	
	do{
		crawl();
	}
	while(!crawled && checkTrackers());

	self.outputString = self.outputArray.join();
    
    // If the output string is empty, show all rather than none:

    jQuery('#mixitupfilterlist').removeAttr('style');
    
    if ( !self.outputString.length && (self.outputString = 'all') ) {
  		self.$resetbutton.hide();
      jQuery('#mixitupfilterlist').removeClass('filtered');
      jQuery('#mixitupfilterlist').addClass('unfiltered');
    }
    else {
  		self.$resetbutton.show();
      jQuery('#mixitupfilterlist').removeClass('unfiltered');
      jQuery('#mixitupfilterlist').addClass('filtered');

/*

      var $active = jQuery('#mixitupfilterlist [style*="display: block"]');
      var theRun = 0;

      $active.each(function() {
        theRun++;
        console.log("yo (" + theRun + ")");
      });

*/
      
    }

    // If the output string is empty, show all rather than none:
    // ^ we can check the console here to take a look at the filter string that is produced
    
    // Send the output string to MixItUp via the 'filter' method:
  	if( self.$container.mixItUp('isLoaded') ){
    	// console.log("Is Loaded");
  		self.$container.mixItUp('filter', self.outputString);
  	}
  	else {
    	// console.log("NOT Loaded");
  	}
  }
};


// On document ready, initialise our code.

jQuery(function(){

  // Initialize rhswp_mixitupfilter code
  rhswp_mixitupfilter.init();

	var theLabelTekst = jQuery('.filtercounter').text();

  jQuery('#cardflex_tab1').mixItUp({
    controls: {
      enable: false // we won't be needing these
    },
    selectors: {
      target: '.cat-item'
    },
		layout: {
			display: 'block',
    },
    animation: {
      duration: 1,
      effects: 'none',
      easing: 'ease'
    },
    callbacks: {
      onMixStart: function(state, futureState){
        jQuery('#h-result').text('Onderwerpen');
        jQuery('.reset').hide();
//        rhswp_mixitupfilter.checkSavedSelection();
      },
      onMixEnd: function(state){

        var cookieFilterKeyword  = readCookie('do_filter_keyword');
        if (  !cookieFilterKeyword ) {
           // no cookie     
          cookieFilterKeyword = '';
        }
        else {
          cookieFilterKeyword = ' voor \'' + cookieFilterKeyword + '\'';
        }
        
        if ( state.totalShow !== state.totalTargets ) {

          if ( state.totalShow < 1 ) {
            jQuery('#h-result').text( 'Niets gevonden' + cookieFilterKeyword);
          }
          else if( state.totalShow < 2 ) {
            jQuery('#h-result').text( state.totalShow + ' onderwerp gevonden' + cookieFilterKeyword);
          }
          else {
            jQuery('#h-result').text( state.totalShow + ' onderwerpen gevonden' + cookieFilterKeyword);
          }

          // zorg dat de parents van actieve elementen ook zichtbaar zijn
          state.$show.each(function() {
            var currentElement = jQuery(this);
            var parentContainer = currentElement.parent().parent();

            if ( parentContainer.length ) {
              parentContainer.css('display','block');
              parentContainer.children('span:first-of-type').hide();
            }

          });

          jQuery('.reset').show();
        }
        else {
        }
      }	
    }
  });    
});
