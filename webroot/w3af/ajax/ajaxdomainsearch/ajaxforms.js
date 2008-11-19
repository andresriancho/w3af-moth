 //This JavaScript modified from this Tutorial.
 //AJAX Form POST/GET - HTML Form Submit with AJAX/Javascript Example/Tutorial 
 //http://www.captain.at/howto-ajax-form-post-get.php

 var http_request = false;
   function makeRequest(url, parameters) {
      http_request = false;
      if (window.XMLHttpRequest) { // Mozilla, Safari,...
         http_request = new XMLHttpRequest();
         if (http_request.overrideMimeType) {
         	// set type accordingly to anticipated content type
            //http_request.overrideMimeType('text/xml');
            http_request.overrideMimeType('text/html');
         }
      } else if (window.ActiveXObject) { // IE
         try {
            http_request = new ActiveXObject("Msxml2.XMLHTTP");
         } catch (e) {
            try {
               http_request = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {}
         }
      }
      if (!http_request) {
         alert('Cannot create XMLHTTP instance');
         return false;
      }
      http_request.onreadystatechange = alertContents;
      http_request.open('GET', url + parameters, true);
      http_request.send(null);
	  document.getElementById('myspan').innerHTML = '<img src="http://www.ajaxdomainsearch.com/images/loading.gif" alt="Please wait for your results">';

   }

   function alertContents() {
      if (http_request.readyState == 4) {
         if (http_request.status == 200) {
            //alert(http_request.responseText);

            result = http_request.responseText;
            document.getElementById('myspan').innerHTML = result;     

         } else {
            alert('There was a problem with the request.');
         }
      }
   }
   
   function get(obj) {
      var getstr = "?";
      for (i=0; i<obj.childNodes.length; i++) {
         if (obj.childNodes[i].tagName == "INPUT") {
            if (obj.childNodes[i].type == "text") {
               getstr += obj.childNodes[i].name + "=" + obj.childNodes[i].value + "&";
            }

         }   
       
      }
      makeRequest('get.php', getstr);
   }