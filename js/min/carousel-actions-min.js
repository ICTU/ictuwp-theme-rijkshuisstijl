!function(){function e(e){var t="focus"===e.type?"focusin":"focusout",a=new CustomEvent(t,{bubbles:!0,cancelable:!1});a.c1Generated=!0,e.target.dispatchEvent(a)}function t(a){a.c1Generated||(n.removeEventListener("focus",e,!0),n.removeEventListener("blur",e,!0),n.removeEventListener("focusin",t,!0),n.removeEventListener("focusout",t,!0)),setTimeout(function(){n.removeEventListener("focusin",t,!0),n.removeEventListener("focusout",t,!0)})}var a=window,n=a.document;void 0===a.onfocusin&&(n.addEventListener("focus",e,!0),n.addEventListener("blur",e,!0),n.addEventListener("focusin",t,!0),n.addEventListener("focusout",t,!0))}();var myCarousel=function(){"use strict";function e(e,t){e.classList?e.classList.remove(t):e.className=e.className.replace(new RegExp("(^|\\b)"+t.split(" ").join("|")+"(\\b|$)","gi")," ")}function t(e,t){return e.classList?e.classList.contains(t):new RegExp("(^| )"+t+"( |$)","gi").test(e.className)}function a(a){if(v=a,c=document.getElementById(v.id),u=c.querySelectorAll(".slide"),c.className="active carousel",v.starttext="Speel diashow af",v.stoptext="Stop diashow",v.duration||(v.duration=1e4),(v.slidenav||v.animate)&&u.length>1){m=document.createElement("ul"),m.className="slidenav";var i=document.createElement("li");v.animate&&(v.startAnimated?i.innerHTML="<button data-stop=true>"+v.stoptext+"</button>":i.innerHTML="<button data-start=true>"+v.starttext+"</button>",m.appendChild(i)),m.addEventListener("click",function(e){var t=e.target;"button"==t.localName&&(t.getAttribute("data-stop")?(console.log("stopbutton 2"),o()):t.getAttribute("data-start")&&(console.log("stopbutton 3"),r()))},!0),c.className="active carousel with-slidenav",c.appendChild(m)}u[0].parentNode.addEventListener("transitionend",function(a){var n=a.target;e(n,"in-transition"),t(n,"current")&&(p&&(n.setAttribute("tabindex","-1"),n.focus(),p=!1),g&&(n.removeAttribute("aria-live"),g=!1))}),c.addEventListener("focusin",function(e){t(e.target,"slide")||l()}),c.addEventListener("focusout",function(e){t(e.target,"slide")||r()}),d=0,n(d),v.startAnimated&&(f=setTimeout(s,v.duration))}function n(e,t,a){p="undefined"!=typeof t&&t,a="undefined"!=typeof a?a:"none",e=parseFloat(e);var n=u.length,s=e+1,i=e-1;s===n?s=0:i<0&&(i=n-1);for(var o=u.length-1;o>=0;o--)u[o].className="slide",u[o].querySelector(".img-container").setAttribute("aria-hidden","true");n>1?(u[s].className="next slide","next"==a&&(u[s].className="next slide in-transition"),u[i].className="prev slide","prev"==a&&(u[i].className="prev slide in-transition"),u[e].className="current slide",u[e].querySelector(".img-container").removeAttribute("aria-hidden"),g&&u[e].setAttribute("aria-live","polite"),d=e):u[0].className="current slide"}function s(){var e=u.length,t=d+1;t===e&&(t=0),g=!0,n(t,!1,"prev"),v.animate&&(f=setTimeout(s,v.duration))}function i(){var e=u.length,t=d-1;t<0&&(t=e-1),g=!0,n(t,!1,"next")}function o(){clearTimeout(f),v.animate=!1,b=!1;var e=c.querySelector("[data-stop], [data-start]");e.innerHTML=v.starttext,e.removeAttribute("data-stop"),e.setAttribute("data-start","true")}function r(){v.animate=!0,b=!1,f=setTimeout(function(){s()},5e3);var e=c.querySelector("[data-stop], [data-start]");e.innerHTML=v.stoptext,e.setAttribute("data-stop","true"),e.removeAttribute("data-start")}function l(){v.animate&&(clearTimeout(f),v.animate=!1,b=!0)}var c,u,d,m,v,f,p,b,g="false";return{init:a,next:s,prev:i,goto:n,stop:o,start:r}};if(document.getElementById("carousel")){var carousel=new myCarousel;carousel.init({id:"carousel",slidenav:!0,animate:!0,startAnimated:!0,duration:1e4})}var collapsiblelist=document.getElementsByClassName("tabs");if(collapsiblelist.length>0){console.log("ja");var selectedelement=collapsiblelist[0].getElementsByClassName("selected"),i=selectedelement[0].getElementsByTagName("a");collapsiblelist[0].className="tabs collapsed",t=i.length>0?i:selectedelement,t[0].onclick=function(e){"tabs collapsed"==collapsiblelist[0].className?collapsiblelist[0].className="tabs":collapsiblelist[0].className="tabs collapsed"}}