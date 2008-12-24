/* 
*  Copyright 2006 Dynamic Site Solutions.
*  Free use of this script is permitted for non-commercial applications,
*  subject to the requirement that this comment block be kept and not be
*  altered.  The data and executable parts of the script may be changed
*  as needed.  Dynamic Site Solutions makes no warranty regarding fitness
*  of use or correct function of the script.  Terms for use of this script
*  in commercial applications may be negotiated; for this, or for other
*  questions, contact "license-info@dynamicsitesolutions.com".
*
*  Script by: Dynamic Site Solutions -- http://www.dynamicsitesolutions.com/
*  Last Updated: 2006-09-29
*/

//IE5+/Win, Firefox, Netscape 6+, Opera 7+, Safari, Konqueror 3, IE5/Mac, iCab 3

var addBookmarkObj = {
  init:function() {
    if(!document.getElementById || !document.createTextNode) return;
    var cont=document.getElementById('addBookmarkContainer');
    if(!cont) return;
    var a=document.createElement('a');
    a.href=location.href;
    if(window.opera) {
      a.rel='sidebar'; // this makes it work in Opera 7+
    } else {
      // this doesn't work in Opera 7+ if the link has an onclick handler,
      // so we only add it if the browser isn't Opera.
      a.onclick=function() {
        addBookmarkObj.exec(this.href,this.title);
        return false;
      }
    }
    a.title=document.title;
    a=cont.appendChild(a);
    a.appendChild(document.createTextNode('Bookmark This Page'));
  },
  exec:function(url, title) {
    var isKonq=(isLikelyKonqueror3 && isLikelyKonqueror3());
    var isMac=(navigator.userAgent.toLowerCase().indexOf('mac')!=-1);
    var buttonStr = isMac?'Command/Cmd':'CTRL';

    if(window.external && (!document.createTextNode ||
      (typeof(window.external.AddFavorite)=='unknown'))) {
        // IE4/Win generates an error when you
        // execute "typeof(window.external.AddFavorite)"
        // In IE7 the page must be from web server, not directly from a local 
        // file system, otherwise, you get a permission denied error.
        window.external.AddFavorite(url, title); // IE/Win
    } else if(isKonq) {
      alert('You need to press CTRL + B to bookmark our site.');
    } else if((window.opera && 
        opera.buildNumber && !isNaN(opera.buildNumber()))) {
          void(0); // do nothing here (Opera 7+)
    } else if(window.opera) { // older Opera
      alert('You need to press '+buttonStr+' + T to bookmark our site.');
    } else if(window.home) { // Netscape, iCab
      alert('You need to press '+buttonStr+' + D to bookmark our site.');
    } else if(!window.print || isMac) { // IE5/Mac and Safari 1.0
      alert('You need to press Command/Cmd + D to bookmark our site.');    
    } else {
      alert('In order to bookmark this site you need to do so manually '+
        'through your browser.');
    }
  }
}

function isLikelyKonqueror3() {
  if(!document.getElementById) return false;
  if(document.defaultCharset || window.opera || !window.print) return false;
  if(window.home) return false; // Konqueror doesn't support this but Firefox,
    // which has silent support for document.all when in Quirks Mode does
  if(document.all) return true; // Konqueror versions before 3.4
  var likely = 1;
  // testing for silent document.all support; try-catch used to keep it from
  // generating errors in other browsers.
  // try-catch causes errors in IE4 and NS4.x so we use the eval() to hide it.
  // try {
  //   var str=document.all[0].tagName;
  // } catch(err) { likely=0; }
  eval("try{var str=document.all[0].tagName;}catch(err){likely=0;}");
  return likely;
}

function dss_addEvent(el,etype,fn) {
  if(el.addEventListener && (!window.opera || opera.version) &&
  (etype!='load')) {
    el.addEventListener(etype,fn,false);
  } else if(el.attachEvent) {
    el.attachEvent('on'+etype,fn);
  } else {
    if(typeof(fn) != "function") return;
    if(typeof(window.earlyNS4)=='undefined') {
      // to prevent this function from crashing Netscape versions before 4.02
      window.earlyNS4=((navigator.appName.toLowerCase()=='netscape')&&
      (parseFloat(navigator.appVersion)<4.02)&&document.layers);
    }
    if((typeof(el['on'+etype])=="function")&&!window.earlyNS4) {
      var tempFunc = el['on'+etype];
      el['on'+etype]=function(e){
        var a=tempFunc(e),b=fn(e);
        a=(typeof(a)=='undefined')?true:a;
        b=(typeof(b)=='undefined')?true:b;
        return (a&&b);
      }
    } else {
      el['on'+etype]=fn;
    }
  }
}

dss_addEvent(window,'load',addBookmarkObj.init);

