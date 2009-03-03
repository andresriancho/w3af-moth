if(typeof Effect=="undefined"){throw ("controls.js requires including script.aculo.us' effects.js library")}var Autocompleter={};Autocompleter.Base=function(){};Autocompleter.Base.prototype={baseInitialize:function(B,C,A){this.element=$(B);this.update=$(C);this.hasFocus=false;this.changed=false;this.active=false;this.index=0;this.entryCount=0;if(this.setOptions){this.setOptions(A)}else{this.options=A||{}}this.options.paramName=this.options.paramName||this.element.name;this.options.tokens=this.options.tokens||[];this.options.frequency=this.options.frequency||0.4;this.options.minChars=this.options.minChars||1;this.options.onShow=this.options.onShow||function(D,E){if(!E.style.position||E.style.position=="absolute"){E.style.position="absolute";Position.clone(D,E,{setHeight:false,offsetTop:D.offsetHeight})}Effect.Appear(E,{duration:0.15})};this.options.onHide=this.options.onHide||function(D,E){new Effect.Fade(E,{duration:0.15})};if(typeof (this.options.tokens)=="string"){this.options.tokens=new Array(this.options.tokens)}this.observer=null;this.element.setAttribute("autocomplete","off");Element.hide(this.update);Event.observe(this.element,"blur",this.onBlur.bindAsEventListener(this));Event.observe(this.element,"keypress",this.onKeyPress.bindAsEventListener(this))},show:function(){if(Element.getStyle(this.update,"display")=="none"){this.options.onShow(this.element,this.update)}if(!this.iefix&&(navigator.appVersion.indexOf("MSIE")>0)&&(navigator.userAgent.indexOf("Opera")<0)&&(Element.getStyle(this.update,"position")=="absolute")){new Insertion.After(this.update,'<iframe id="'+this.update.id+'_iefix" style="display:none;position:absolute;filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0);" src="javascript:false;" frameborder="0" scrolling="no"></iframe>');this.iefix=$(this.update.id+"_iefix")}if(this.iefix){setTimeout(this.fixIEOverlapping.bind(this),50)}},fixIEOverlapping:function(){Position.clone(this.update,this.iefix,{setTop:(!this.update.style.height)});this.iefix.style.zIndex=1;this.update.style.zIndex=2;Element.show(this.iefix)},hide:function(){this.stopIndicator();if(Element.getStyle(this.update,"display")!="none"){this.options.onHide(this.element,this.update)}if(this.iefix){Element.hide(this.iefix)}},startIndicator:function(){if(this.options.indicator){Element.show(this.options.indicator)}},stopIndicator:function(){if(this.options.indicator){Element.hide(this.options.indicator)}},onKeyPress:function(A){if(this.active){switch(A.keyCode){case Event.KEY_TAB:case Event.KEY_RETURN:this.selectEntry();Event.stop(A);case Event.KEY_ESC:this.hide();this.active=false;Event.stop(A);return ;case Event.KEY_LEFT:case Event.KEY_RIGHT:return ;case Event.KEY_UP:this.markPrevious();this.render();if(navigator.appVersion.indexOf("AppleWebKit")>0){Event.stop(A)}return ;case Event.KEY_DOWN:this.markNext();this.render();if(navigator.appVersion.indexOf("AppleWebKit")>0){Event.stop(A)}return }}else{if(A.keyCode==Event.KEY_TAB||A.keyCode==Event.KEY_RETURN||(navigator.appVersion.indexOf("AppleWebKit")>0&&A.keyCode==0)){return }}this.changed=true;this.hasFocus=true;if(this.observer){clearTimeout(this.observer)}this.observer=setTimeout(this.onObserverEvent.bind(this),this.options.frequency*1000)},activate:function(){this.changed=false;this.hasFocus=true;this.getUpdatedChoices()},onHover:function(B){var A=Event.findElement(B,"LI");if(this.index!=A.autocompleteIndex){this.index=A.autocompleteIndex;this.render()}Event.stop(B)},onClick:function(B){var A=Event.findElement(B,"LI");this.index=A.autocompleteIndex;this.selectEntry();this.hide()},onBlur:function(A){setTimeout(this.hide.bind(this),250);this.hasFocus=false;this.active=false},render:function(){if(this.entryCount>0){for(var A=0;A<this.entryCount;A++){this.index==A?Element.addClassName(this.getEntry(A),"selected"):Element.removeClassName(this.getEntry(A),"selected")}if(this.hasFocus){this.show();this.active=true}}else{this.active=false;this.hide()}},markPrevious:function(){if(this.index>0){this.index--}else{this.index=this.entryCount-1}this.getEntry(this.index).scrollIntoView(true)},markNext:function(){if(this.index<this.entryCount-1){this.index++}else{this.index=0}this.getEntry(this.index).scrollIntoView(false)},getEntry:function(A){return this.update.firstChild.childNodes[A]},getCurrentEntry:function(){return this.getEntry(this.index)},selectEntry:function(){this.active=false;this.updateElement(this.getCurrentEntry())},updateElement:function(F){if(this.options.updateElement){this.options.updateElement(F);return }var C="";if(this.options.select){var A=document.getElementsByClassName(this.options.select,F)||[];if(A.length>0){C=Element.collectTextNodes(A[0],this.options.select)}}else{C=Element.collectTextNodesIgnoreClass(F,"informal")}var E=this.findLastToken();if(E!=-1){var D=this.element.value.substr(0,E+1);var B=this.element.value.substr(E+1).match(/^\s+/);if(B){D+=B[0]}this.element.value=D+C}else{this.element.value=C}this.element.focus();if(this.options.afterUpdateElement){this.options.afterUpdateElement(this.element,F)}},updateChoices:function(C){if(!this.changed&&this.hasFocus){this.update.innerHTML=C;Element.cleanWhitespace(this.update);Element.cleanWhitespace(this.update.down());if(this.update.firstChild&&this.update.down().childNodes){this.entryCount=this.update.down().childNodes.length;for(var A=0;A<this.entryCount;A++){var B=this.getEntry(A);B.autocompleteIndex=A;this.addObservers(B)}}else{this.entryCount=0}this.stopIndicator();this.index=0;if(this.entryCount==1&&this.options.autoSelect){this.selectEntry();this.hide()}else{this.render()}}},addObservers:function(A){Event.observe(A,"mouseover",this.onHover.bindAsEventListener(this));Event.observe(A,"click",this.onClick.bindAsEventListener(this))},onObserverEvent:function(){this.changed=false;if(this.getToken().length>=this.options.minChars){this.startIndicator();this.getUpdatedChoices()}else{this.active=false;this.hide()}},getToken:function(){var B=this.findLastToken();if(B!=-1){var A=this.element.value.substr(B+1).replace(/^\s+/,"").replace(/\s+$/,"")}else{var A=this.element.value}return/\n/.test(A)?"":A},findLastToken:function(){var C=-1;for(var B=0;B<this.options.tokens.length;B++){var A=this.element.value.lastIndexOf(this.options.tokens[B]);if(A>C){C=A}}return C}};Ajax.Autocompleter=Class.create();Object.extend(Object.extend(Ajax.Autocompleter.prototype,Autocompleter.Base.prototype),{initialize:function(C,D,B,A){this.baseInitialize(C,D,A);this.options.asynchronous=true;this.options.onComplete=this.onComplete.bind(this);this.options.defaultParams=this.options.parameters||null;this.url=B},getUpdatedChoices:function(){entry=encodeURIComponent(this.options.paramName)+"="+encodeURIComponent(this.getToken());this.options.parameters=this.options.callback?this.options.callback(this.element,entry):entry;if(this.options.defaultParams){this.options.parameters+="&"+this.options.defaultParams}new Ajax.Request(this.url,this.options)},onComplete:function(A){this.updateChoices(A.responseText)}});Autocompleter.Local=Class.create();Autocompleter.Local.prototype=Object.extend(new Autocompleter.Base(),{initialize:function(B,D,C,A){this.baseInitialize(B,D,A);this.options.array=C},getUpdatedChoices:function(){this.updateChoices(this.options.selector(this))},setOptions:function(A){this.options=Object.extend({choices:10,partialSearch:true,partialChars:2,ignoreCase:true,fullSearch:false,selector:function(B){var D=[];var C=[];var H=B.getToken();var G=0;for(var E=0;E<B.options.array.length&&D.length<B.options.choices;E++){var F=B.options.array[E];var I=B.options.ignoreCase?F.toLowerCase().indexOf(H.toLowerCase()):F.indexOf(H);while(I!=-1){if(I==0&&F.length!=H.length){D.push("<li><strong>"+F.substr(0,H.length)+"</strong>"+F.substr(H.length)+"</li>");break}else{if(H.length>=B.options.partialChars&&B.options.partialSearch&&I!=-1){if(B.options.fullSearch||/\s/.test(F.substr(I-1,1))){C.push("<li>"+F.substr(0,I)+"<strong>"+F.substr(I,H.length)+"</strong>"+F.substr(I+H.length)+"</li>");break}}}I=B.options.ignoreCase?F.toLowerCase().indexOf(H.toLowerCase(),I+1):F.indexOf(H,I+1)}}if(C.length){D=D.concat(C.slice(0,B.options.choices-D.length))}return"<ul>"+D.join("")+"</ul>"}},A||{})}});Field.scrollFreeActivate=function(A){setTimeout(function(){Field.activate(A)},1)};Ajax.InPlaceEditor=Class.create();Ajax.InPlaceEditor.defaultHighlightColor="#FFFF99";Ajax.InPlaceEditor.prototype={initialize:function(C,B,A){this.url=B;this.element=$(C);this.options=Object.extend({paramName:"value",okButton:true,okText:"ok",cancelLink:true,cancelText:"cancel",savingText:"Saving...",clickToEditText:"Click to edit",okText:"ok",rows:1,onComplete:function(E,D){new Effect.Highlight(D,{startcolor:this.options.highlightcolor})},onFailure:function(D){alert("Error communicating with the server: "+D.responseText.stripTags())},callback:function(D){return Form.serialize(D)},handleLineBreaks:true,loadingText:"Loading...",savingClassName:"inplaceeditor-saving",loadingClassName:"inplaceeditor-loading",formClassName:"inplaceeditor-form",highlightcolor:Ajax.InPlaceEditor.defaultHighlightColor,highlightendcolor:"#FFFFFF",externalControl:null,submitOnBlur:false,ajaxOptions:{},evalScripts:false},A||{});if(!this.options.formId&&this.element.id){this.options.formId=this.element.id+"-inplaceeditor";if($(this.options.formId)){this.options.formId=null}}if(this.options.externalControl){this.options.externalControl=$(this.options.externalControl)}this.originalBackground=Element.getStyle(this.element,"background-color");if(!this.originalBackground){this.originalBackground="transparent"}this.element.title=this.options.clickToEditText;this.onclickListener=this.enterEditMode.bindAsEventListener(this);this.mouseoverListener=this.enterHover.bindAsEventListener(this);this.mouseoutListener=this.leaveHover.bindAsEventListener(this);Event.observe(this.element,"click",this.onclickListener);Event.observe(this.element,"mouseover",this.mouseoverListener);Event.observe(this.element,"mouseout",this.mouseoutListener);if(this.options.externalControl){Event.observe(this.options.externalControl,"click",this.onclickListener);Event.observe(this.options.externalControl,"mouseover",this.mouseoverListener);Event.observe(this.options.externalControl,"mouseout",this.mouseoutListener)}},enterEditMode:function(A){if(this.saving){return }if(this.editing){return }this.editing=true;this.onEnterEditMode();if(this.options.externalControl){Element.hide(this.options.externalControl)}Element.hide(this.element);this.createForm();this.element.parentNode.insertBefore(this.form,this.element);if(!this.options.loadTextURL){Field.scrollFreeActivate(this.editField)}if(A){Event.stop(A)}return false},createForm:function(){this.form=document.createElement("form");this.form.id=this.options.formId;Element.addClassName(this.form,this.options.formClassName);this.form.onsubmit=this.onSubmit.bind(this);this.createEditField();if(this.options.textarea){var A=document.createElement("br");this.form.appendChild(A)}if(this.options.okButton){okButton=document.createElement("input");okButton.type="submit";okButton.value=this.options.okText;okButton.className="editor_ok_button";this.form.appendChild(okButton)}if(this.options.cancelLink){cancelLink=document.createElement("a");cancelLink.href="#";cancelLink.appendChild(document.createTextNode(this.options.cancelText));cancelLink.onclick=this.onclickCancel.bind(this);cancelLink.className="editor_cancel";this.form.appendChild(cancelLink)}},hasHTMLLineBreaks:function(A){if(!this.options.handleLineBreaks){return false}return A.match(/<br/i)||A.match(/<p>/i)},convertHTMLLineBreaks:function(A){return A.replace(/<br>/gi,"\n").replace(/<br\/>/gi,"\n").replace(/<\/p>/gi,"\n").replace(/<p>/gi,"")},createEditField:function(){var E;if(this.options.loadTextURL){E=this.options.loadingText}else{E=this.getText()}var C=this;if(this.options.rows==1&&!this.hasHTMLLineBreaks(E)){this.options.textarea=false;var A=document.createElement("input");A.obj=this;A.type="text";A.name=this.options.paramName;A.value=E;A.style.backgroundColor=this.options.highlightcolor;A.className="editor_field";var B=this.options.size||this.options.cols||0;if(B!=0){A.size=B}if(this.options.submitOnBlur){A.onblur=this.onSubmit.bind(this)}this.editField=A}else{this.options.textarea=true;var D=document.createElement("textarea");D.obj=this;D.name=this.options.paramName;D.value=this.convertHTMLLineBreaks(E);D.rows=this.options.rows;D.cols=this.options.cols||40;D.className="editor_field";if(this.options.submitOnBlur){D.onblur=this.onSubmit.bind(this)}this.editField=D}if(this.options.loadTextURL){this.loadExternalText()}this.form.appendChild(this.editField)},getText:function(){return this.element.innerHTML},loadExternalText:function(){Element.addClassName(this.form,this.options.loadingClassName);this.editField.disabled=true;new Ajax.Request(this.options.loadTextURL,Object.extend({asynchronous:true,onComplete:this.onLoadedExternalText.bind(this)},this.options.ajaxOptions))},onLoadedExternalText:function(A){Element.removeClassName(this.form,this.options.loadingClassName);this.editField.disabled=false;this.editField.value=A.responseText.stripTags();Field.scrollFreeActivate(this.editField)},onclickCancel:function(){this.onComplete();this.leaveEditMode();return false},onFailure:function(A){this.options.onFailure(A);if(this.oldInnerHTML){this.element.innerHTML=this.oldInnerHTML;this.oldInnerHTML=null}return false},onSubmit:function(){var A=this.form;var B=this.editField.value;this.onLoading();if(this.options.evalScripts){new Ajax.Request(this.url,Object.extend({parameters:this.options.callback(A,B),onComplete:this.onComplete.bind(this),onFailure:this.onFailure.bind(this),asynchronous:true,evalScripts:true},this.options.ajaxOptions))}else{new Ajax.Updater({success:this.element,failure:null},this.url,Object.extend({parameters:this.options.callback(A,B),onComplete:this.onComplete.bind(this),onFailure:this.onFailure.bind(this)},this.options.ajaxOptions))}if(arguments.length>1){Event.stop(arguments[0])}return false},onLoading:function(){this.saving=true;this.removeForm();this.leaveHover();this.showSaving()},showSaving:function(){this.oldInnerHTML=this.element.innerHTML;this.element.innerHTML=this.options.savingText;Element.addClassName(this.element,this.options.savingClassName);this.element.style.backgroundColor=this.originalBackground;Element.show(this.element)},removeForm:function(){if(this.form){if(this.form.parentNode){Element.remove(this.form)}this.form=null}},enterHover:function(){if(this.saving){return }this.element.style.backgroundColor=this.options.highlightcolor;if(this.effect){this.effect.cancel()}Element.addClassName(this.element,this.options.hoverClassName)},leaveHover:function(){if(this.options.backgroundColor){this.element.style.backgroundColor=this.oldBackground}Element.removeClassName(this.element,this.options.hoverClassName);if(this.saving){return }this.effect=new Effect.Highlight(this.element,{startcolor:this.options.highlightcolor,endcolor:this.options.highlightendcolor,restorecolor:this.originalBackground})},leaveEditMode:function(){Element.removeClassName(this.element,this.options.savingClassName);this.removeForm();this.leaveHover();this.element.style.backgroundColor=this.originalBackground;Element.show(this.element);if(this.options.externalControl){Element.show(this.options.externalControl)}this.editing=false;this.saving=false;this.oldInnerHTML=null;this.onLeaveEditMode()},onComplete:function(A){this.leaveEditMode();this.options.onComplete.bind(this)(A,this.element)},onEnterEditMode:function(){},onLeaveEditMode:function(){},dispose:function(){if(this.oldInnerHTML){this.element.innerHTML=this.oldInnerHTML}this.leaveEditMode();Event.stopObserving(this.element,"click",this.onclickListener);Event.stopObserving(this.element,"mouseover",this.mouseoverListener);Event.stopObserving(this.element,"mouseout",this.mouseoutListener);if(this.options.externalControl){Event.stopObserving(this.options.externalControl,"click",this.onclickListener);Event.stopObserving(this.options.externalControl,"mouseover",this.mouseoverListener);Event.stopObserving(this.options.externalControl,"mouseout",this.mouseoutListener)}}};Ajax.InPlaceCollectionEditor=Class.create();Object.extend(Ajax.InPlaceCollectionEditor.prototype,Ajax.InPlaceEditor.prototype);Object.extend(Ajax.InPlaceCollectionEditor.prototype,{createEditField:function(){if(!this.cached_selectTag){var A=document.createElement("select");var C=this.options.collection||[];var B;C.each(function(E,D){B=document.createElement("option");B.value=(E instanceof Array)?E[0]:E;if((typeof this.options.value=="undefined")&&((E instanceof Array)?this.element.innerHTML==E[1]:E==B.value)){B.selected=true}if(this.options.value==B.value){B.selected=true}B.appendChild(document.createTextNode((E instanceof Array)?E[1]:E));A.appendChild(B)}.bind(this));this.cached_selectTag=A}this.editField=this.cached_selectTag;if(this.options.loadTextURL){this.loadExternalText()}this.form.appendChild(this.editField);this.options.callback=function(D,E){return"value="+encodeURIComponent(E)}}});Form.Element.DelayedObserver=Class.create();Form.Element.DelayedObserver.prototype={initialize:function(B,A,C){this.delay=A||0.5;this.element=$(B);this.callback=C;this.timer=null;this.lastValue=$F(this.element);Event.observe(this.element,"keyup",this.delayedListener.bindAsEventListener(this))},delayedListener:function(A){if(this.lastValue==$F(this.element)){return }if(this.timer){clearTimeout(this.timer)}this.timer=setTimeout(this.onTimerEvent.bind(this),this.delay*1000);this.lastValue=$F(this.element)},onTimerEvent:function(){this.timer=null;this.callback(this.element,$F(this.element))}}