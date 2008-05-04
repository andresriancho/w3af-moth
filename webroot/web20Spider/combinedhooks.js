function userOnStart()
{
  objectsOnStart();
}

function userOnBeforePage()
{
  eventsOnBeforePage();
}

function userOnAfterPage()
{
  compatModeOnAfterPage();
  objectsOnAfterPage();
  eventsOnAfterPage();
}

function compatModeOnAfterPage()
{
  cdump('Page: ' + 
       gSpider.mCurrentUrl.mUrl + 
       ' is in ' + 
       (gSpider.mDocument.compatMode == 'BackCompat' ? 'Quirks' : 'Standards') +
       ' mode.');
}

function userOnStop()
{
  objectsOnStop();
}

var gObjectClassIds;
var gEmbedTypes;
var gMapClassIdType;

function objectsOnStart()
{
  gObjectClassIds = {};
  gEmbedTypes = {};
  gMapClassIdType = {};
}

function objectsOnAfterPage()
{
  var i;
  var elm;
  var wmode;
  var doc = gSpider.mDocument;
  var loc = doc ? doc.location.href : '';
  var emblist;

  var reLanguageVer = /javascript([0-9.]*)/i;
  var scrlist = doc.getElementsByTagName('script');

  for (i = 0; i < scrlist.length; i++)
  {
    var scr = scrlist[i];

    var file = scr.getAttribute('src');

    if (scr.getAttribute('for') || scr.getAttribute('event'))
    {
      cdump('WARNING: SCRIPT FOR EVENT. Source File: ' + loc + (file ? ' src: ' + file : ''));
    }
    // check for javascript language version uses which can cause
    // incompatibilities
    var scrLanguage = scr.getAttribute('language');
    if (scrLanguage)
    {
      var scrLanguageVer = scrLanguage.replace(reLanguageVer, "$1");
      if (scrLanguageVer)
      {
        cdump('WARNING: SCRIPT LANGUAGE VERSION: ' + scrLanguageVer + '. Source File: ' + loc + (file ? ' src: ' + file : ''));
      }
    }
  }

  var objlist = doc.getElementsByTagName('object');

  for (i = 0; i < objlist.length; i++)
  {
    elm   = objlist[i];
    var classid = elm.getAttribute('classid');
    var data  = elm.getAttribute('data');
    var paramList = elm.getElementsByTagName('param');
    for (var j = 0; j < paramList.length; j++)
    {
      var param = paramList[j];
      var name  = param.getAttribute('name');
      if (name)
      {
        name = name.toLowerCase();
        if (name == 'wmode')
        {
          wmode = param.getAttribute('value');
        }
      }
    }

    cdump('OBJECT: classid = ' + classid + ' ' + 
    (data ? 'data = ' + data  + ' ' : '') + (wmode ? 'wmode = ' + wmode  + ' ' : '') + '. Source File: ' + loc );

    emblist = elm.getElementsByTagName('embed');
    if (emblist.length == 0)
    {
      cdump('WARNING: OBJECT Tag does not contain EMBED Tag. Source File: ' + loc + (file ? ' src: ' + file : ''));
    }
    else
    {
      var emb = emblist[0];

      if (wmode)
      {
        var ewmode = emb.getAttribute('wmode');
        if (!ewmode)
        {
          cdump('WARNING: OBJECT Tag has FLASH WMODE but child EMBED Tag does not. Source File: ' + loc + (file ? ' src: ' + file : ''));
        }
      }

      var etype = emb.getAttribute('type');

      if (etype && classid)
      {
        classid = classid.toLowerCase();
        etype = etype.toLowerCase();
        gMapClassIdType[classid] = etype;
      }

      objectsDumpEmbed(emb, loc);
    }

    if (classid)
    {
      classid = classid.toLowerCase();

      if (classid in gObjectClassIds)
      {
        gObjectClassIds[classid] += 1;
      }
      else
      {
        gObjectClassIds[classid] = 1;
      }
    }

    if (data)
    {
      if (data in gObjectClassIds)
      {
        gObjectClassIds[data] += 1;
      }
      else
      {
        gObjectClassIds[data] = 0;
      }
    }
  }

  // cdump embed tags not contained in object tags

  emblist = doc.getElementsByTagName('embed');
  for (i = 0; i < emblist.length; i++)
  {
    elm = emblist[i];
    var parent = elm.parentNode;
    if (parent && parent.tagName != 'OBJECT')
    {
      objectsDumpEmbed(elm, loc);
    }
  }
}

function objectsOnStop()
{
  var val;

  cdump('\n\n **** SUMMARY ****\n\n');

  cdump('\n\nUnique OBJECT CLSID/DATA\n\n')

  for (val in gObjectClassIds)
  {
    cdump(val + ' occurred ' + gObjectClassIds[val] + ' times.');
  }

  cdump('\n\nUnique EMBED TYPE\n\n')

  for (val in gEmbedTypes)
  {
    cdump(val + ' occurred ' + gEmbedTypes[val] + ' times.');
  }
  
  cdump('\n\nCLASSID to TYPE map\n\n');

  for (val in gMapClassIdType)
  {
    cdump('CLASSID ' + val + ' == ' + 'TYPE ' + gMapClassIdType[val]);
  }
}

function objectsDumpEmbed(elm, loc)
{
  var src   = elm.getAttribute('src');
  var type  = elm.getAttribute('type');
  var wmode = elm.getAttribute('wmode');

  cdump('EMBED: type = ' + type + ' ' + 
       (wmode ? 'wmode = ' + wmode  + ' ' : '') + '. Source File: ' + loc );

  if (type)
  {
    type = type.toLowerCase();

    if (type in gEmbedTypes)
    {
      gEmbedTypes[type] += 1;
    }
    else
    {
      gEmbedTypes[type] = 1;
    }
  }
}

var gEventsPending;
var gEventsPendingLast;
var gEventsPendingObserverId;
var gKungFooDeathGrip;

function eventsOnMouseEvent(event)
{
  if (!gInChrome)
  {
    var e;
    try
    {
      netscape.security.PrivilegeManager.enablePrivilege('UniversalBrowserRead');
    }
    catch(e)
    {
      dlog('eventsOnMouseEvent Exception: ' + e);
      return;
    }
  }

  if (event.metaKey && (event.eventPhase == event.AT_TARGET))
  {
    --gEventsPending;
    updateScriptUrlStatus('Pending Events: ' + gEventsPending);
  }
  if (gEventsPending <= 0)
  {
    if (gEventsPendingObserverId)
    {
      clearTimeout(gEventsPendingObserverId);
    }
    gPageCompleted = true;
  }
  dlog('eventsOnMouseEvent: KungFoo ' + gKungFooDeathGrip + 
       ' gPageCompleted ' + gPageCompleted + 
       ' gEventsPending ' + gEventsPending);
}

function eventsOnBeforePage()
{
  gKungFooDeathGrip = true;
  gEventsPending = gEventsPending = 0;
  if (gEventsPendingObserverId)
  {
    clearTimeout(gEventsPendingObserverId);
  }
  gEventsPendingObserverId = setTimeout(eventsObservePending, 60000);
}

function eventsOnAfterPage()
{
  dlog('eventsOnAfterPage enter : KungFoo ' + gKungFooDeathGrip + 
       ' gPageCompleted ' + gPageCompleted + 
       ' gEventsPending ' + gEventsPending);

  var excp;

  try
  {
    var timeoffset = 0;
    var timeinc = 100;
    var doc = gSpider.mDocument;

    if (!doc)
    {
      dlog('eventsOnAfterPage: missing document');
      return;
    }

    var i;
    var elm;
    var elmlist;

    if ('body' in doc)
    {
      elmlist = getLeaves(doc.body);
      dlog('eventsOnAfterPage: found ' + elmlist.length + ' leaf nodes');
    }
    else
    {
      elmlist = [];
      dlog('eventsOnAfterPage: no body element');
    }

    for (i = 0; i < elmlist.length; i++)
    {
      elm = elmlist[i];

      elm.addEventListener('mouseover', eventsOnMouseEvent, false);
      elm.addEventListener('mouseout', eventsOnMouseEvent, false);
      elm.addEventListener('click', eventsOnMouseEvent, false);

      timeoffset += timeinc;
      ++gEventsPending;
      setTimeout(eventsSendMouseEvent, timeoffset, 'mouseover', elm);

      timeoffset += timeinc;
      ++gEventsPending;
      setTimeout(eventsSendMouseEvent, timeoffset, 'mouseout', elm);

      timeoffset += timeinc;
      ++gEventsPending;
      setTimeout(eventsSendMouseEvent, timeoffset, 'click', elm);

    }
  }
  catch(excp)
  {
    dlog('eventsOnAfterPage Exception: ' + excp);
  }
  // remove Kung Foo Death grip
  gKungFooDeathGrip = false;
  if (gEventsPending <= 0)
  {
    dlog('eventsOnAfterPage: gPageCompleted');
    if (gEventsPendingObserverId)
    {
      clearTimeout(gEventsPendingObserverId);
    }
    gPageCompleted = true;
  }
  dlog('eventsOnAfterPage exit  : KungFoo ' + gKungFooDeathGrip + 
       ' gPageCompleted ' + gPageCompleted + 
       ' gEventsPending ' + gEventsPending);
}

function eventsSendMouseEvent(eventtype, elm)
{
  if (!gInChrome)
  {
    var e;
    try
    {
      netscape.security.PrivilegeManager.enablePrivilege('UniversalXPConnect UniversalBrowserRead');
    }
    catch(e)
    {
      dlog('eventsSendMouseEvent Exception: ' + e);
      return;
    }
  }

  dlog('eventsSendMouseEvent enter : KungFoo ' + gKungFooDeathGrip + 
       ' gPageCompleted ' + gPageCompleted + 
       ' gEventsPending ' + gEventsPending);

  var view = document.getElementById('contentSpider').contentWindow;
  var canBubble = true;
  var cancelable = true;
  var detail = 0;

  var doc = gSpider.mDocument;

  if (!doc)
  {
    dlog('eventsSendMouseEvent: missing document');
    return;
  }

  var clientPosition = getClientPosition(elm);

  var screenPosition = {
    x: clientPosition.x + window.screenX,
    y: clientPosition.y + window.screenY
  };

  try
  {
    var evtMouse = doc.createEvent('MouseEvents');
    evtMouse.initMouseEvent(
                 eventtype,
                 canBubble, 
                 cancelable, 
                 view, 
                 detail,
                 screenPosition.x,
                 screenPosition.y,
                 clientPosition.x,
                 clientPosition.y,
                 false,
                 false,
                 false,
                 true, /* fake metaKey to distinquish hook events from user events */
                 0, 
                 elm.parentNode
                 );
     elm.dispatchEvent(evtMouse);
   }
   catch(e)
   {
     // this can happen in particular when calling dispatchEvent on an
     // applet. There appears to be no conversion from a DOM2 event
     // and an AWTEvent.
     /*
     Chrome JavaScript Error: There is no Java method *.dispatchEvent 
     that matches JavaScript argument types (object). 
     Candidate methods with the same name are:    
     void dispatchEvent(java.awt.AWTEvent) . 
     Source File: chrome://spider/content/spider.js, Line: 451.
     */
     --gEventsPending;
     dlog('eventsSendMouseEvent: unable to call ' + elm + '.dispatchEvent ' + e);
   }

    /*
        TODO:
        I should check if the document.location OF THE SPIDERED PAGE changed, if it changed, I should go 
        back in order to continue with the spidering of the ORIGINAL page. The document.location approach 
        doesnt work, the problem is that when running from chrome:// , the document.location never changes.

        gSpider.mCurrentUrl.mUrl and gSpider.mDocument.location don't change if the browser changes the page.
    */

  dlog('eventsSendMouseEvent exit  : KungFoo ' + gKungFooDeathGrip + 
       ' gPageCompleted ' + gPageCompleted + 
       ' gEventsPending ' + gEventsPending);

}

function getClientPosition(elm)
{
  var position = { x: elm.offsetLeft, y:  elm.offsetTop};

  while (elm.offsetParent)
  {
    elm = elm.offsetParent;
    position.x += elm.offsetLeft;
    position.y += elm.offsetTop;
  }

  return position;
}

function eventsObservePending()
{
  dlog('eventsObservePending enter : KungFoo ' + gKungFooDeathGrip + 
       ' gPageCompleted ' + gPageCompleted + 
       ' gEventsPending ' + gEventsPending);

  if (!gPageCompleted)
  {
    if (!gKungFooDeathGrip && (gEventsPendingLast == gEventsPending))
    {
      gEventsPendingObserverId = 0;
      gEventsPendingLast = gEventsPending = 0;
      gPageCompleted = true;
    }
    else
    {
      gEventsPendingLast = gEventsPending;
      gEventsPendingObserverId = setTimeout(eventsObservePending, 60000);
    }
  }
  dlog('eventsObservePending exit  : KungFoo ' + gKungFooDeathGrip + 
       ' gPageCompleted ' + gPageCompleted + 
       ' gEventsPending ' + gEventsPending);

}

function getLeaves(node)
{
  var leaves = [];

  _getLeaves(node, leaves);

  return leaves;

}
function _getLeaves(node, leaves)
{
  if (node.nodeType != Node.ELEMENT_NODE)
  {
    return;
  }

  if (node.getElementsByTagName('*').length == 0)
  {
    leaves.push(node);
  }
  else
  {
    for (var curr = node.firstChild; curr; curr = curr.nextSibling)
    {
      if (curr.nodeType == Node.ELEMENT_NODE)
      {
        _getLeaves(curr, leaves);
      }
    }
  }
}

