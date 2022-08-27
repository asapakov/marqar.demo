!function(e){function t(a){if(r[a])return r[a].exports;var n=r[a]={i:a,l:!1,exports:{}};return e[a].call(n.exports,n,n.exports,t),n.l=!0,n.exports}var r={};t.m=e,t.c=r,t.d=function(e,r,a){t.o(e,r)||Object.defineProperty(e,r,{configurable:!1,enumerable:!0,get:a})},t.n=function(e){var r=e&&e.__esModule?function(){return e.default}:function(){return e};return t.d(r,"a",r),r},t.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},t.p="/",t(t.s=17)}({0:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var a=null;if(window.age_gate_params)a=window.age_gate_params;else{var n=document.querySelector("[data-age-gate-params]");a=JSON.parse(atob(n.dataset.ageGateParams))}t.age_gate_params=a},17:function(e,t,r){"use strict";function a(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}var n=function(){function e(e,t){for(var r=0;r<t.length;r++){var a=t[r];a.enumerable=a.enumerable||!1,a.configurable=!0,"value"in a&&(a.writable=!0),Object.defineProperty(e,a.key,a)}}return function(t,r,a){return r&&e(t.prototype,r),a&&e(t,a),t}}(),o=r(18),i=function(e){return e&&e.__esModule?e:{default:e}}(o),s=r(0),c=function(){function e(){a(this,e),this.formUpdate=this.formUpdate.bind(this),this.formSubmit=this.formSubmit.bind(this),this.checkShortcodes=this.checkShortcodes.bind(this),this.ajaxEvents=this.ajaxEvents.bind(this),this.init()}return n(e,[{key:"init",value:function(){this.ajaxEvents(),jQuery("body").on("click",'.age-gate-sc-form button[name="age_gate[confirm]"]',this.formUpdate),jQuery(".age-gate-sc-form").on("submit",this.formSubmit),window.addEventListener("DOMContentLoaded",this.checkShortcodes)}},{key:"formUpdate",value:function(e){jQuery(e.target).closest(".age-gate-sc-form").find('input[name="confirm_action"]').val(e.target.classList.contains("age-gate-submit-yes")?1:0)}},{key:"ajaxEvents",value:function(){var e=window.XMLHttpRequest.prototype.send,t=this;window.XMLHttpRequest.prototype.send=function(){var r=this,a=window.setInterval(function(){4==r.readyState&&(t.checkShortcodes(),clearInterval(a))},1);return e.apply(this,[].slice.call(arguments))}}},{key:"checkShortcodes",value:function(){var e=i.default.get("age_gate"),t=i.default.get("age_gate_failed"),r=s.age_gate_params.settings.rechallenge,a=s.age_gate_params.errors.failed;(!r||e&&!navigator.userAgent.match(/bot|crawl|slurp|spider|facebookexternalhit|Facebot|Twitterbot/i))&&jQuery(".age-gate-sc-wrapper").each(function(n,o){var i=parseInt(atob(atob(jQuery(o).find('[name="age_gate[age]"]').val())).replace(/\D/g,""));if(e>=i){var s=jQuery(o).find('[type="text/template"]').html();return void jQuery(o).replaceWith(s)}(!r&&t||!r&&e&&e<i)&&jQuery(o).replaceWith('\n            <div class="age-gate-inline-failed">\n              <div class="age-gate-inline-failed-icon"></div>\n              <p class="age-gate-error" style="display: block;">'+a+"</p>\n            </div>")})}},{key:"formSubmit",value:function(e){var t=this;e.preventDefault(),jQuery(e.target).addClass("working");var r=jQuery(e.target).serialize();jQuery.ajax({url:e.target.dataset.action+"shortcode",data:r,method:"GET",dataType:"JSON",success:function(r){jQuery(e.target).removeClass("working");var a=r.age,n=r.error,o=window.age_gate_params.settings.rechallenge;if("pass"===r.status){var s=jQuery(e.target).closest(".age-gate-sc-wrapper"),c=s.find('[type="text/template"]').html();s.replaceWith(c),i.default.set("age_gate",a)}else jQuery(e.target).find(".age-gate-error-message").remove(),jQuery(e.target).find(".age-gate-submit").before('<p class="age-gate-error-message">'+n+"</p>"),jQuery(e.target).find('[name="age_gate[confirm]"]:first').before('<p class="age-gate-error-message">'+n+"</p>"),o||"invalid"===a||i.default.set("age_gate_failed",1);t.checkShortcodes()}})}}]),e}();!function(e){new c}(jQuery)},18:function(e,t,r){"use strict";var a,n,o="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e};!function(i){var s;if(a=i,void 0!==(n="function"==typeof a?a.call(t,r,t,e):a)&&(e.exports=n),s=!0,"object"===o(t)&&(e.exports=i(),s=!0),!s){var c=window.Cookies,u=window.Cookies=i();u.noConflict=function(){return window.Cookies=c,u}}}(function(){function e(){for(var e=0,t={};e<arguments.length;e++){var r=arguments[e];for(var a in r)t[a]=r[a]}return t}function t(e){return e.replace(/(%[0-9A-Z]{2})+/g,decodeURIComponent)}function r(a){function n(){}function o(t,r,o){if("undefined"!=typeof document){o=e({path:"/"},n.defaults,o),"number"==typeof o.expires&&(o.expires=new Date(1*new Date+864e5*o.expires)),o.expires=o.expires?o.expires.toUTCString():"";try{var i=JSON.stringify(r);/^[\{\[]/.test(i)&&(r=i)}catch(e){}r=a.write?a.write(r,t):encodeURIComponent(String(r)).replace(/%(23|24|26|2B|3A|3C|3E|3D|2F|3F|40|5B|5D|5E|60|7B|7D|7C)/g,decodeURIComponent),t=encodeURIComponent(String(t)).replace(/%(23|24|26|2B|5E|60|7C)/g,decodeURIComponent).replace(/[\(\)]/g,escape);var s="";for(var c in o)o[c]&&(s+="; "+c,!0!==o[c]&&(s+="="+o[c].split(";")[0]));return document.cookie=t+"="+r+s}}function i(e,r){if("undefined"!=typeof document){for(var n={},o=document.cookie?document.cookie.split("; "):[],i=0;i<o.length;i++){var s=o[i].split("="),c=s.slice(1).join("=");r||'"'!==c.charAt(0)||(c=c.slice(1,-1));try{var u=t(s[0]);if(c=(a.read||a)(c,u)||t(c),r)try{c=JSON.parse(c)}catch(e){}if(n[u]=c,e===u)break}catch(e){}}return e?n[e]:n}}return n.set=o,n.get=function(e){return i(e,!1)},n.getJSON=function(e){return i(e,!0)},n.remove=function(t,r){o(t,"",e(r,{expires:-1}))},n.defaults={},n.withConverter=r,n}return r(function(){})})}});