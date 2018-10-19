"classList"in document.createElement("_")||!function(a){"use strict";if("Element"in a){var b="classList",c="prototype",d=a.Element[c],e=Object,f=String[c].trim||function(){return this.replace(/^\s+|\s+$/g,"")},g=Array[c].indexOf||function(a){for(var b=0,c=this.length;c>b;b++)if(b in this&&this[b]===a)return b;return-1},h=function(a,b){this.name=a,this.code=DOMException[a],this.message=b},i=function(a,b){if(""===b)throw new h("SYNTAX_ERR","An invalid or illegal string was specified");if(/\s/.test(b))throw new h("INVALID_CHARACTER_ERR","String contains an invalid character");return g.call(a,b)},j=function(a){for(var b=f.call(a.getAttribute("class")||""),c=b?b.split(/\s+/):[],d=0,e=c.length;e>d;d++)this.push(c[d]);this._updateClassName=function(){a.setAttribute("class",this.toString())}},k=j[c]=[],l=function(){return new j(this)};if(h[c]=Error[c],k.item=function(a){return this[a]||null},k.contains=function(a){return a+="",-1!==i(this,a)},k.add=function(){var a,b=arguments,c=0,d=b.length,e=!1;do a=b[c]+"",-1===i(this,a)&&(this.push(a),e=!0);while(++c<d);e&&this._updateClassName()},k.remove=function(){var a,b,c=arguments,d=0,e=c.length,f=!1;do for(a=c[d]+"",b=i(this,a);-1!==b;)this.splice(b,1),f=!0,b=i(this,a);while(++d<e);f&&this._updateClassName()},k.toggle=function(a,b){a+="";var c=this.contains(a),d=c?b!==!0&&"remove":b!==!1&&"add";return d&&this[d](a),b===!0||b===!1?b:!c},k.toString=function(){return this.join(" ")},e.defineProperty){var m={get:l,enumerable:!0,configurable:!0};try{e.defineProperty(d,b,m)}catch(n){-2146823252===n.number&&(m.enumerable=!1,e.defineProperty(d,b,m))}}else e[c].__defineGetter__&&d.__defineGetter__(b,l)}}(self),function(a){"use strict";if(a.URL=a.URL||a.webkitURL,a.Blob&&a.URL)try{return void new Blob}catch(b){}var c=a.BlobBuilder||a.WebKitBlobBuilder||a.MozBlobBuilder||function(a){var b=function(a){return Object.prototype.toString.call(a).match(/^\[object\s(.*)\]$/)[1]},c=function(){this.data=[]},d=function(a,b,c){this.data=a,this.size=a.length,this.type=b,this.encoding=c},e=c.prototype,f=d.prototype,g=a.FileReaderSync,h=function(a){this.code=this[this.name=a]},i="NOT_FOUND_ERR SECURITY_ERR ABORT_ERR NOT_READABLE_ERR ENCODING_ERR NO_MODIFICATION_ALLOWED_ERR INVALID_STATE_ERR SYNTAX_ERR".split(" "),j=i.length,k=a.URL||a.webkitURL||a,l=k.createObjectURL,m=k.revokeObjectURL,n=k,o=a.btoa,p=a.atob,q=a.ArrayBuffer,r=a.Uint8Array,s=/^[\w-]+:\/*\[?[\w\.:-]+\]?(?::[0-9]+)?/;for(d.fake=f.fake=!0;j--;)h.prototype[i[j]]=j+1;return k.createObjectURL||(n=a.URL=function(a){var b,c=document.createElementNS("http://www.w3.org/1999/xhtml","a");return c.href=a,"origin"in c||("data:"===c.protocol.toLowerCase()?c.origin=null:(b=a.match(s),c.origin=b&&b[1])),c}),n.createObjectURL=function(a){var b,c=a.type;return null===c&&(c="application/octet-stream"),a instanceof d?(b="data:"+c,"base64"===a.encoding?b+";base64,"+a.data:"URI"===a.encoding?b+","+decodeURIComponent(a.data):o?b+";base64,"+o(a.data):b+","+encodeURIComponent(a.data)):l?l.call(k,a):void 0},n.revokeObjectURL=function(a){"data:"!==a.substring(0,5)&&m&&m.call(k,a)},e.append=function(a){var c=this.data;if(r&&(a instanceof q||a instanceof r)){for(var e="",f=new r(a),i=0,j=f.length;j>i;i++)e+=String.fromCharCode(f[i]);c.push(e)}else if("Blob"===b(a)||"File"===b(a)){if(!g)throw new h("NOT_READABLE_ERR");var k=new g;c.push(k.readAsBinaryString(a))}else a instanceof d?"base64"===a.encoding&&p?c.push(p(a.data)):"URI"===a.encoding?c.push(decodeURIComponent(a.data)):"raw"===a.encoding&&c.push(a.data):("string"!=typeof a&&(a+=""),c.push(unescape(encodeURIComponent(a))))},e.getBlob=function(a){return arguments.length||(a=null),new d(this.data.join(""),a,"raw")},e.toString=function(){return"[object BlobBuilder]"},f.slice=function(a,b,c){var e=arguments.length;return 3>e&&(c=null),new d(this.data.slice(a,e>1?b:this.data.length),c,this.encoding)},f.toString=function(){return"[object Blob]"},f.close=function(){this.size=0,delete this.data},c}(a);a.Blob=function(a,b){var d=b?b.type||"":"",e=new c;if(a)for(var f=0,g=a.length;g>f;f++)Uint8Array&&a[f]instanceof Uint8Array?e.append(a[f].buffer):e.append(a[f]);var h=e.getBlob(d);return!h.slice&&h.webkitSlice&&(h.slice=h.webkitSlice),h};var d=Object.getPrototypeOf||function(a){return a.__proto__};a.Blob.prototype=d(new a.Blob)}("undefined"!=typeof self&&self||"undefined"!=typeof window&&window||this.content||this),function(a,b){"use strict";var c="object"==typeof module&&"undefined"!=typeof process&&process&&process.versions&&process.versions.electron;c||"object"!=typeof module?"function"==typeof define&&define.amd?define(function(){return b}):a.MediumEditor=b:module.exports=b}(this,function(){"use strict";function a(a,b){return this.init(a,b)}return a.extensions={},function(b){function c(a,b){var c,d=Array.prototype.slice.call(arguments,2);b=b||{};for(var e=0;e<d.length;e++){var f=d[e];if(f)for(c in f)f.hasOwnProperty(c)&&"undefined"!=typeof f[c]&&(a||b.hasOwnProperty(c)===!1)&&(b[c]=f[c])}return b}var d=!1;try{var e=document.createElement("div"),f=document.createTextNode(" ");e.appendChild(f),d=e.contains(f)}catch(g){}var h={isIE:"Microsoft Internet Explorer"===navigator.appName||"Netscape"===navigator.appName&&null!==new RegExp("Trident/.*rv:([0-9]{1,}[.0-9]{0,})").exec(navigator.userAgent),isEdge:null!==/Edge\/\d+/.exec(navigator.userAgent),isFF:navigator.userAgent.toLowerCase().indexOf("firefox")>-1,isMac:b.navigator.platform.toUpperCase().indexOf("MAC")>=0,keyCode:{BACKSPACE:8,TAB:9,ENTER:13,ESCAPE:27,SPACE:32,DELETE:46,K:75,M:77,V:86},isMetaCtrlKey:function(a){return!!(h.isMac&&a.metaKey||!h.isMac&&a.ctrlKey)},isKey:function(a,b){var c=h.getKeyCode(a);return!1===Array.isArray(b)?c===b:-1!==b.indexOf(c)},getKeyCode:function(a){var b=a.which;return null===b&&(b=null!==a.charCode?a.charCode:a.keyCode),b},blockContainerElementNames:["p","h1","h2","h3","h4","h5","h6","blockquote","pre","ul","li","ol","address","article","aside","audio","canvas","dd","dl","dt","fieldset","figcaption","figure","footer","form","header","hgroup","main","nav","noscript","output","section","video","table","thead","tbody","tfoot","tr","th","td"],emptyElementNames:["br","col","colgroup","hr","img","input","source","wbr"],extend:function(){var a=[!0].concat(Array.prototype.slice.call(arguments));return c.apply(this,a)},defaults:function(){var a=[!1].concat(Array.prototype.slice.call(arguments));return c.apply(this,a)},createLink:function(a,b,c,d){var e=a.createElement("a");return h.moveTextRangeIntoElement(b[0],b[b.length-1],e),e.setAttribute("href",c),d&&("_blank"===d&&e.setAttribute("rel","noopener noreferrer"),e.setAttribute("target",d)),e},findOrCreateMatchingTextNodes:function(a,b,c){for(var d=a.createTreeWalker(b,NodeFilter.SHOW_ALL,null,!1),e=[],f=0,g=!1,i=null,j=null;null!==(i=d.nextNode());)if(!(i.nodeType>3))if(3===i.nodeType){if(!g&&c.start<f+i.nodeValue.length&&(g=!0,j=h.splitStartNodeIfNeeded(i,c.start,f)),g&&h.splitEndNodeIfNeeded(i,j,c.end,f),g&&f===c.end)break;if(g&&f>c.end+1)throw new Error("PerformLinking overshot the target!");g&&e.push(j||i),f+=i.nodeValue.length,null!==j&&(f+=j.nodeValue.length,d.nextNode()),j=null}else"img"===i.tagName.toLowerCase()&&(!g&&c.start<=f&&(g=!0),g&&e.push(i));return e},splitStartNodeIfNeeded:function(a,b,c){return b!==c?a.splitText(b-c):null},splitEndNodeIfNeeded:function(a,b,c,d){var e,f;e=d+a.nodeValue.length+(b?b.nodeValue.length:0)-1,f=c-d-(b?a.nodeValue.length:0),e>=c&&d!==e&&0!==f&&(b||a).splitText(f)},splitByBlockElements:function(b){if(3!==b.nodeType&&1!==b.nodeType)return[];var c=[],d=a.util.blockContainerElementNames.join(",");if(3===b.nodeType||0===b.querySelectorAll(d).length)return[b];for(var e=0;e<b.childNodes.length;e++){var f=b.childNodes[e];if(3===f.nodeType)c.push(f);else if(1===f.nodeType){var g=f.querySelectorAll(d);0===g.length?c.push(f):c=c.concat(a.util.splitByBlockElements(f))}}return c},findAdjacentTextNodeWithContent:function(a,b,c){var d,e=!1,f=c.createNodeIterator(a,NodeFilter.SHOW_TEXT,null,!1);for(d=f.nextNode();d;){if(d===b)e=!0;else if(e&&3===d.nodeType&&d.nodeValue&&d.nodeValue.trim().length>0)break;d=f.nextNode()}return d},findPreviousSibling:function(a){if(!a||h.isMediumEditorElement(a))return!1;for(var b=a.previousSibling;!b&&!h.isMediumEditorElement(a.parentNode);)a=a.parentNode,b=a.previousSibling;return b},isDescendant:function(a,b,c){if(!a||!b)return!1;if(a===b)return!!c;if(1!==a.nodeType)return!1;if(d||3!==b.nodeType)return a.contains(b);for(var e=b.parentNode;null!==e;){if(e===a)return!0;e=e.parentNode}return!1},isElement:function(a){return!(!a||1!==a.nodeType)},throttle:function(a,b){var c,d,e,f=50,g=null,h=0,i=function(){h=Date.now(),g=null,e=a.apply(c,d),g||(c=d=null)};return b||0===b||(b=f),function(){var f=Date.now(),j=b-(f-h);return c=this,d=arguments,0>=j||j>b?(g&&(clearTimeout(g),g=null),h=f,e=a.apply(c,d),g||(c=d=null)):g||(g=setTimeout(i,j)),e}},traverseUp:function(a,b){if(!a)return!1;do{if(1===a.nodeType){if(b(a))return a;if(h.isMediumEditorElement(a))return!1}a=a.parentNode}while(a);return!1},htmlEntities:function(a){return String(a).replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/"/g,"&quot;")},insertHTMLCommand:function(b,c){var d,e,f,g,i,j,k,l=!1,m=["insertHTML",!1,c];if(!a.util.isEdge&&b.queryCommandSupported("insertHTML"))try{return b.execCommand.apply(b,m)}catch(n){}if(d=b.getSelection(),d.rangeCount){if(e=d.getRangeAt(0),k=e.commonAncestorContainer,h.isMediumEditorElement(k)&&!k.firstChild)e.selectNode(k.appendChild(b.createTextNode("")));else if(3===k.nodeType&&0===e.startOffset&&e.endOffset===k.nodeValue.length||3!==k.nodeType&&k.innerHTML===e.toString()){for(;!h.isMediumEditorElement(k)&&k.parentNode&&1===k.parentNode.childNodes.length&&!h.isMediumEditorElement(k.parentNode);)k=k.parentNode;e.selectNode(k)}for(e.deleteContents(),f=b.createElement("div"),f.innerHTML=c,g=b.createDocumentFragment();f.firstChild;)i=f.firstChild,j=g.appendChild(i);e.insertNode(g),j&&(e=e.cloneRange(),e.setStartAfter(j),e.collapse(!0),a.selection.selectRange(b,e)),l=!0}return b.execCommand.callListeners&&b.execCommand.callListeners(m,l),l},execFormatBlock:function(b,c){var d,e=h.getTopBlockContainer(a.selection.getSelectionStart(b));if("blockquote"===c){if(e&&(d=Array.prototype.slice.call(e.childNodes),d.some(function(a){return h.isBlockContainer(a)})))return b.execCommand("outdent",!1,null);if(h.isIE)return b.execCommand("indent",!1,c)}if(e&&c===e.nodeName.toLowerCase()&&(c="p"),h.isIE&&(c="<"+c+">"),e&&"blockquote"===e.nodeName.toLowerCase()){if(h.isIE&&"<p>"===c)return b.execCommand("outdent",!1,c);if((h.isFF||h.isEdge)&&"p"===c)return d=Array.prototype.slice.call(e.childNodes),d.some(function(a){return!h.isBlockContainer(a)})&&b.execCommand("formatBlock",!1,c),b.execCommand("outdent",!1,c)}return b.execCommand("formatBlock",!1,c)},setTargetBlank:function(a,b){var c,d=b||!1;if("a"===a.nodeName.toLowerCase())a.target="_blank",a.rel="noopener noreferrer";else for(a=a.getElementsByTagName("a"),c=0;c<a.length;c+=1)!1!==d&&d!==a[c].attributes.href.value||(a[c].target="_blank",a[c].rel="noopener noreferrer")},removeTargetBlank:function(a,b){var c;if("a"===a.nodeName.toLowerCase())a.removeAttribute("target"),a.removeAttribute("rel");else for(a=a.getElementsByTagName("a"),c=0;c<a.length;c+=1)b===a[c].attributes.href.value&&(a[c].removeAttribute("target"),a[c].removeAttribute("rel"))},addClassToAnchors:function(a,b){var c,d,e=b.split(" ");if("a"===a.nodeName.toLowerCase())for(d=0;d<e.length;d+=1)a.classList.add(e[d]);else{var f=a.getElementsByTagName("a");if(0===f.length){var g=h.getClosestTag(a,"a");a=g?[g]:[]}else a=f;for(c=0;c<a.length;c+=1)for(d=0;d<e.length;d+=1)a[c].classList.add(e[d])}},isListItem:function(a){if(!a)return!1;if("li"===a.nodeName.toLowerCase())return!0;for(var b=a.parentNode,c=b.nodeName.toLowerCase();"li"===c||!h.isBlockContainer(b)&&"div"!==c;){if("li"===c)return!0;if(b=b.parentNode,!b)return!1;c=b.nodeName.toLowerCase()}return!1},cleanListDOM:function(b,c){if("li"===c.nodeName.toLowerCase()){var d=c.parentElement;"p"===d.parentElement.nodeName.toLowerCase()&&(h.unwrap(d.parentElement,b),a.selection.moveCursor(b,c.firstChild,c.firstChild.textContent.length))}},splitOffDOMTree:function(a,b,c){for(var d=b,e=null,f=!c;d!==a;){var g,h=d.parentNode,i=h.cloneNode(!1),j=f?d:h.firstChild;for(e&&(f?i.appendChild(e):g=e),e=i;j;){var k=j.nextSibling;j===d?(j.hasChildNodes()?j=j.cloneNode(!1):j.parentNode.removeChild(j),j.textContent&&e.appendChild(j),j=f?k:null):(j.parentNode.removeChild(j),(j.hasChildNodes()||j.textContent)&&e.appendChild(j),j=k)}g&&e.appendChild(g),d=h}return e},moveTextRangeIntoElement:function(a,b,c){if(!a||!b)return!1;var d=h.findCommonRoot(a,b);if(!d)return!1;if(b===a){var e=a.parentNode,f=a.nextSibling;return e.removeChild(a),c.appendChild(a),f?e.insertBefore(c,f):e.appendChild(c),c.hasChildNodes()}for(var g,i,j,k=[],l=0;l<d.childNodes.length;l++)if(j=d.childNodes[l],g){if(h.isDescendant(j,b,!0)){i=j;break}k.push(j)}else h.isDescendant(j,a,!0)&&(g=j);var m=i.nextSibling,n=d.ownerDocument.createDocumentFragment();return g===a?(g.parentNode.removeChild(g),n.appendChild(g)):n.appendChild(h.splitOffDOMTree(g,a)),k.forEach(function(a){a.parentNode.removeChild(a),n.appendChild(a)}),i===b?(i.parentNode.removeChild(i),n.appendChild(i)):n.appendChild(h.splitOffDOMTree(i,b,!0)),c.appendChild(n),i.parentNode===d?d.insertBefore(c,i):m?d.insertBefore(c,m):d.appendChild(c),c.hasChildNodes()},depthOfNode:function(a){for(var b=0,c=a;null!==c.parentNode;)c=c.parentNode,b++;return b},findCommonRoot:function(a,b){for(var c=h.depthOfNode(a),d=h.depthOfNode(b),e=a,f=b;c!==d;)c>d?(e=e.parentNode,c-=1):(f=f.parentNode,d-=1);for(;e!==f;)e=e.parentNode,f=f.parentNode;return e},isElementAtBeginningOfBlock:function(a){for(var b,c;!h.isBlockContainer(a)&&!h.isMediumEditorElement(a);){for(c=a;c=c.previousSibling;)if(b=3===c.nodeType?c.nodeValue:c.textContent,b.length>0)return!1;a=a.parentNode}return!0},isMediumEditorElement:function(a){return a&&a.getAttribute&&!!a.getAttribute("data-medium-editor-element")},getContainerEditorElement:function(a){return h.traverseUp(a,function(a){return h.isMediumEditorElement(a)})},isBlockContainer:function(a){return a&&3!==a.nodeType&&-1!==h.blockContainerElementNames.indexOf(a.nodeName.toLowerCase())},getClosestBlockContainer:function(a){return h.traverseUp(a,function(a){return h.isBlockContainer(a)||h.isMediumEditorElement(a)})},getTopBlockContainer:function(a){var b=h.isBlockContainer(a)?a:!1;return h.traverseUp(a,function(a){return h.isBlockContainer(a)&&(b=a),!b&&h.isMediumEditorElement(a)?(b=a,!0):!1}),b},getFirstSelectableLeafNode:function(a){for(;a&&a.firstChild;)a=a.firstChild;if(a=h.traverseUp(a,function(a){return-1===h.emptyElementNames.indexOf(a.nodeName.toLowerCase())}),"table"===a.nodeName.toLowerCase()){var b=a.querySelector("th, td");b&&(a=b)}return a},getFirstTextNode:function(a){return h.warn("getFirstTextNode is deprecated and will be removed in version 6.0.0"),h._getFirstTextNode(a)},_getFirstTextNode:function(a){if(3===a.nodeType)return a;for(var b=0;b<a.childNodes.length;b++){var c=h._getFirstTextNode(a.childNodes[b]);if(null!==c)return c}return null},ensureUrlHasProtocol:function(a){return-1===a.indexOf("://")?"http://"+a:a},warn:function(){void 0!==b.console&&"function"==typeof b.console.warn&&b.console.warn.apply(b.console,arguments)},deprecated:function(a,b,c){var d=a+" is deprecated, please use "+b+" instead.";c&&(d+=" Will be removed in "+c),h.warn(d)},deprecatedMethod:function(a,b,c,d){h.deprecated(a,b,d),"function"==typeof this[b]&&this[b].apply(this,c)},cleanupAttrs:function(a,b){b.forEach(function(b){a.removeAttribute(b)})},cleanupTags:function(a,b){-1!==b.indexOf(a.nodeName.toLowerCase())&&a.parentNode.removeChild(a)},unwrapTags:function(b,c){-1!==c.indexOf(b.nodeName.toLowerCase())&&a.util.unwrap(b,document)},getClosestTag:function(a,b){return h.traverseUp(a,function(a){return a.nodeName.toLowerCase()===b.toLowerCase()})},unwrap:function(a,b){for(var c=b.createDocumentFragment(),d=Array.prototype.slice.call(a.childNodes),e=0;e<d.length;e++)c.appendChild(d[e]);c.childNodes.length?a.parentNode.replaceChild(c,a):a.parentNode.removeChild(a)},guid:function(){function a(){return Math.floor(65536*(1+Math.random())).toString(16).substring(1)}return a()+a()+"-"+a()+"-"+a()+"-"+a()+"-"+a()+a()+a()}};a.util=h}(window),function(){var b=function(b){a.util.extend(this,b)};b.extend=function(b){var c,d=this;c=b&&b.hasOwnProperty("constructor")?b.constructor:function(){return d.apply(this,arguments)},a.util.extend(c,d);var e=function(){this.constructor=c};return e.prototype=d.prototype,c.prototype=new e,b&&a.util.extend(c.prototype,b),c},b.prototype={init:function(){},base:void 0,name:void 0,checkState:void 0,destroy:void 0,queryCommandState:void 0,isActive:void 0,isAlreadyApplied:void 0,setActive:void 0,setInactive:void 0,getInteractionElements:void 0,window:void 0,document:void 0,getEditorElements:function(){return this.base.elements},getEditorId:function(){return this.base.id},getEditorOption:function(a){return this.base.options[a]}},["execAction","on","off","subscribe","trigger"].forEach(function(a){b.prototype[a]=function(){return this.base[a].apply(this.base,arguments)}}),a.Extension=b}(),function(){function b(b){return a.util.isBlockContainer(b)?NodeFilter.FILTER_ACCEPT:NodeFilter.FILTER_SKIP}var c={findMatchingSelectionParent:function(b,c){var d,e,f=c.getSelection();return 0===f.rangeCount?!1:(d=f.getRangeAt(0),e=d.commonAncestorContainer,a.util.traverseUp(e,b))},getSelectionElement:function(b){return this.findMatchingSelectionParent(function(b){return a.util.isMediumEditorElement(b)},b)},exportSelection:function(a,b){if(!a)return null;var c=null,d=b.getSelection();if(d.rangeCount>0){var e,f=d.getRangeAt(0),g=f.cloneRange();g.selectNodeContents(a),g.setEnd(f.startContainer,f.startOffset),e=g.toString().length,c={start:e,end:e+f.toString().length},this.doesRangeStartWithImages(f,b)&&(c.startsWithImage=!0);var h=this.getTrailingImageCount(a,c,f.endContainer,f.endOffset);if(h&&(c.trailingImageCount=h),0!==e){var i=this.getIndexRelativeToAdjacentEmptyBlocks(b,a,f.startContainer,f.startOffset);-1!==i&&(c.emptyBlocksIndex=i)}}return c},importSelection:function(a,b,c,d){if(a&&b){var e=c.createRange();e.setStart(b,0),e.collapse(!0);var f,g=b,h=[],i=0,j=!1,k=!1,l=0,m=!1,n=!1,o=null;for((d||a.startsWithImage||"undefined"!=typeof a.emptyBlocksIndex)&&(n=!0);!m&&g;)if(g.nodeType>3)g=h.pop();else{if(3!==g.nodeType||k){if(a.trailingImageCount&&k&&("img"===g.nodeName.toLowerCase()&&l++,l===a.trailingImageCount)){for(var p=0;g.parentNode.childNodes[p]!==g;)p++;e.setEnd(g.parentNode,p+1),m=!0}if(!m&&1===g.nodeType)for(var q=g.childNodes.length-1;q>=0;)h.push(g.childNodes[q]),q-=1}else f=i+g.length,!j&&a.start>=i&&a.start<=f&&(n||a.start<f?(e.setStart(g,a.start-i),j=!0):o=g),j&&a.end>=i&&a.end<=f&&(a.trailingImageCount?k=!0:(e.setEnd(g,a.end-i),m=!0)),i=f;m||(g=h.pop())}!j&&o&&(e.setStart(o,o.length),e.setEnd(o,o.length)),"undefined"!=typeof a.emptyBlocksIndex&&(e=this.importSelectionMoveCursorPastBlocks(c,b,a.emptyBlocksIndex,e)),d&&(e=this.importSelectionMoveCursorPastAnchor(a,e)),this.selectRange(c,e)}},importSelectionMoveCursorPastAnchor:function(b,c){var d=function(a){return"a"===a.nodeName.toLowerCase()};if(b.start===b.end&&3===c.startContainer.nodeType&&c.startOffset===c.startContainer.nodeValue.length&&a.util.traverseUp(c.startContainer,d)){for(var e=c.startContainer,f=c.startContainer.parentNode;null!==f&&"a"!==f.nodeName.toLowerCase();)f.childNodes[f.childNodes.length-1]!==e?f=null:(e=f,f=f.parentNode);if(null!==f&&"a"===f.nodeName.toLowerCase()){for(var g=null,h=0;null===g&&h<f.parentNode.childNodes.length;h++)f.parentNode.childNodes[h]===f&&(g=h);c.setStart(f.parentNode,g+1),c.collapse(!0)}}return c},importSelectionMoveCursorPastBlocks:function(c,d,e,f){var g,h,i=c.createTreeWalker(d,NodeFilter.SHOW_ELEMENT,b,!1),j=f.startContainer,k=0;for(e=e||1,g=3===j.nodeType&&a.util.isBlockContainer(j.previousSibling)?j.previousSibling:a.util.getClosestBlockContainer(j);i.nextNode();)if(h){if(h=i.currentNode,k++,k===e)break;if(h.textContent.length>0)break}else g===i.currentNode&&(h=i.currentNode);return h||(h=g),f.setStart(a.util.getFirstSelectableLeafNode(h),0),f},getIndexRelativeToAdjacentEmptyBlocks:function(c,d,e,f){if(e.textContent.length>0&&f>0)return-1;var g=e;if(3!==g.nodeType&&(g=e.childNodes[f]),g){if(!a.util.isElementAtBeginningOfBlock(g))return-1;var h=a.util.findPreviousSibling(g);if(!h)return-1;if(h.nodeValue)return-1}for(var i=a.util.getClosestBlockContainer(e),j=c.createTreeWalker(d,NodeFilter.SHOW_ELEMENT,b,!1),k=0;j.nextNode();){var l=""===j.currentNode.textContent;if((l||k>0)&&(k+=1),j.currentNode===i)return k;l||(k=0)}return k},doesRangeStartWithImages:function(a,b){if(0!==a.startOffset||1!==a.startContainer.nodeType)return!1;if("img"===a.startContainer.nodeName.toLowerCase())return!0;var c=a.startContainer.querySelector("img");if(!c)return!1;for(var d=b.createTreeWalker(a.startContainer,NodeFilter.SHOW_ALL,null,!1);d.nextNode();){var e=d.currentNode;if(e===c)break;if(e.nodeValue)return!1}return!0},getTrailingImageCount:function(a,b,c,d){if(0===d||1!==c.nodeType)return 0;if("img"!==c.nodeName.toLowerCase()&&!c.querySelector("img"))return 0;for(var e=c.childNodes[d-1];e.hasChildNodes();)e=e.lastChild;for(var f,g=a,h=[],i=0,j=!1,k=!1,l=!1,m=0;!l&&g;)if(g.nodeType>3)g=h.pop();else{if(3!==g.nodeType||k){if("img"===g.nodeName.toLowerCase()&&m++,g===e)l=!0;else if(1===g.nodeType)for(var n=g.childNodes.length-1;n>=0;)h.push(g.childNodes[n]),n-=1}else m=0,f=i+g.length,!j&&b.start>=i&&b.start<=f&&(j=!0),j&&b.end>=i&&b.end<=f&&(k=!0),i=f;l||(g=h.pop())}return m},selectionContainsContent:function(a){var b=a.getSelection();if(!b||b.isCollapsed||!b.rangeCount)return!1;if(""!==b.toString().trim())return!0;var c=this.getSelectedParentElement(b.getRangeAt(0));return!(!c||!("img"===c.nodeName.toLowerCase()||1===c.nodeType&&c.querySelector("img")))},selectionInContentEditableFalse:function(a){var b,c=this.findMatchingSelectionParent(function(a){var c=a&&a.getAttribute("contenteditable");return"true"===c&&(b=!0),"#text"!==a.nodeName&&"false"===c},a);return!b&&c},getSelectionHtml:function(a){var b,c,d,e="",f=a.getSelection();if(f.rangeCount){for(d=a.createElement("div"),b=0,c=f.rangeCount;c>b;b+=1)d.appendChild(f.getRangeAt(b).cloneContents());e=d.innerHTML}return e},getCaretOffsets:function(a,b){var c,d;return b||(b=window.getSelection().getRangeAt(0)),c=b.cloneRange(),d=b.cloneRange(),c.selectNodeContents(a),c.setEnd(b.endContainer,b.endOffset),d.selectNodeContents(a),d.setStart(b.endContainer,b.endOffset),{left:c.toString().length,right:d.toString().length}},rangeSelectsSingleNode:function(a){var b=a.startContainer;return b===a.endContainer&&b.hasChildNodes()&&a.endOffset===a.startOffset+1},getSelectedParentElement:function(a){return a?this.rangeSelectsSingleNode(a)&&3!==a.startContainer.childNodes[a.startOffset].nodeType?a.startContainer.childNodes[a.startOffset]:3===a.startContainer.nodeType?a.startContainer.parentNode:a.startContainer:null},getSelectedElements:function(a){var b,c,d,e=a.getSelection();if(!e.rangeCount||e.isCollapsed||!e.getRangeAt(0).commonAncestorContainer)return[];if(b=e.getRangeAt(0),3===b.commonAncestorContainer.nodeType){for(c=[],d=b.commonAncestorContainer;d.parentNode&&1===d.parentNode.childNodes.length;)c.push(d.parentNode),d=d.parentNode;return c}return[].filter.call(b.commonAncestorContainer.getElementsByTagName("*"),function(a){return"function"==typeof e.containsNode?e.containsNode(a,!0):!0})},selectNode:function(a,b){var c=b.createRange();c.selectNodeContents(a),this.selectRange(b,c)},select:function(a,b,c,d,e){var f=a.createRange();return f.setStart(b,c),d?f.setEnd(d,e):f.collapse(!0),this.selectRange(a,f),f},clearSelection:function(a,b){b?a.getSelection().collapseToStart():a.getSelection().collapseToEnd()},moveCursor:function(a,b,c){this.select(a,b,c)},getSelectionRange:function(a){var b=a.getSelection();return 0===b.rangeCount?null:b.getRangeAt(0)},selectRange:function(a,b){var c=a.getSelection();c.removeAllRanges(),c.addRange(b)},getSelectionStart:function(a){var b=a.getSelection().anchorNode,c=b&&3===b.nodeType?b.parentNode:b;return c}};a.selection=c}(),function(){function b(b,c){return b?b.some(function(b){if("function"!=typeof b.getInteractionElements)return!1;var d=b.getInteractionElements();return d?(Array.isArray(d)||(d=[d]),d.some(function(b){return a.util.isDescendant(b,c,!0)})):!1}):!1}var c=function(a){this.base=a,this.options=this.base.options,this.events=[],this.disabledEvents={},this.customEvents={},this.listeners={}};c.prototype={InputEventOnContenteditableSupported:!a.util.isIE&&!a.util.isEdge,attachDOMEvent:function(b,c,d,e){var f=this.base.options.contentWindow,g=this.base.options.ownerDocument;b=a.util.isElement(b)||[f,g].indexOf(b)>-1?[b]:b,Array.prototype.forEach.call(b,function(a){a.addEventListener(c,d,e),this.events.push([a,c,d,e])}.bind(this))},detachDOMEvent:function(b,c,d,e){var f,g,h=this.base.options.contentWindow,i=this.base.options.ownerDocument;b&&(b=a.util.isElement(b)||[h,i].indexOf(b)>-1?[b]:b,Array.prototype.forEach.call(b,function(a){f=this.indexOfListener(a,c,d,e),-1!==f&&(g=this.events.splice(f,1)[0],g[0].removeEventListener(g[1],g[2],g[3]))}.bind(this)))},indexOfListener:function(a,b,c,d){var e,f,g;for(e=0,f=this.events.length;f>e;e+=1)if(g=this.events[e],g[0]===a&&g[1]===b&&g[2]===c&&g[3]===d)return e;return-1},detachAllDOMEvents:function(){for(var a=this.events.pop();a;)a[0].removeEventListener(a[1],a[2],a[3]),a=this.events.pop()},detachAllEventsFromElement:function(a){for(var b=this.events.filter(function(b){return b&&b[0].getAttribute&&b[0].getAttribute("medium-editor-index")===a.getAttribute("medium-editor-index")}),c=0,d=b.length;d>c;c++){var e=b[c];this.detachDOMEvent(e[0],e[1],e[2],e[3])}},attachAllEventsToElement:function(a){this.listeners.editableInput&&(this.contentCache[a.getAttribute("medium-editor-index")]=a.innerHTML),this.eventsCache&&this.eventsCache.forEach(function(b){this.attachDOMEvent(a,b.name,b.handler.bind(this))},this)},enableCustomEvent:function(a){void 0!==this.disabledEvents[a]&&delete this.disabledEvents[a]},disableCustomEvent:function(a){this.disabledEvents[a]=!0},attachCustomEvent:function(a,b){this.setupListener(a),this.customEvents[a]||(this.customEvents[a]=[]),this.customEvents[a].push(b)},detachCustomEvent:function(a,b){var c=this.indexOfCustomListener(a,b);-1!==c&&this.customEvents[a].splice(c,1)},indexOfCustomListener:function(a,b){return this.customEvents[a]&&this.customEvents[a].length?this.customEvents[a].indexOf(b):-1},detachAllCustomEvents:function(){this.customEvents={}},triggerCustomEvent:function(a,b,c){this.customEvents[a]&&!this.disabledEvents[a]&&this.customEvents[a].forEach(function(a){a(b,c)})},destroy:function(){this.detachAllDOMEvents(),this.detachAllCustomEvents(),this.detachExecCommand(),this.base.elements&&this.base.elements.forEach(function(a){a.removeAttribute("data-medium-focused")})},attachToExecCommand:function(){this.execCommandListener||(this.execCommandListener=function(a){this.handleDocumentExecCommand(a)}.bind(this),this.wrapExecCommand(),this.options.ownerDocument.execCommand.listeners.push(this.execCommandListener))},detachExecCommand:function(){var a=this.options.ownerDocument;if(this.execCommandListener&&a.execCommand.listeners){var b=a.execCommand.listeners.indexOf(this.execCommandListener);-1!==b&&a.execCommand.listeners.splice(b,1),a.execCommand.listeners.length||this.unwrapExecCommand()}},wrapExecCommand:function(){var a=this.options.ownerDocument;if(!a.execCommand.listeners){var b=function(b,c){a.execCommand.listeners&&a.execCommand.listeners.forEach(function(a){a({command:b[0],value:b[2],args:b,result:c})})},c=function(){var c=a.execCommand.orig.apply(this,arguments);if(!a.execCommand.listeners)return c;var d=Array.prototype.slice.call(arguments);return b(d,c),c};c.orig=a.execCommand,c.listeners=[],c.callListeners=b,a.execCommand=c}},unwrapExecCommand:function(){var a=this.options.ownerDocument;a.execCommand.orig&&(a.execCommand=a.execCommand.orig)},setupListener:function(a){if(!this.listeners[a]){switch(a){case"externalInteraction":this.attachDOMEvent(this.options.ownerDocument.body,"mousedown",this.handleBodyMousedown.bind(this),!0),this.attachDOMEvent(this.options.ownerDocument.body,"click",this.handleBodyClick.bind(this),!0),this.attachDOMEvent(this.options.ownerDocument.body,"focus",this.handleBodyFocus.bind(this),!0);break;case"blur":this.setupListener("externalInteraction");break;case"focus":this.setupListener("externalInteraction");break;case"editableInput":this.contentCache={},this.base.elements.forEach(function(a){this.contentCache[a.getAttribute("medium-editor-index")]=a.innerHTML},this),this.InputEventOnContenteditableSupported&&this.attachToEachElement("input",this.handleInput),this.InputEventOnContenteditableSupported||(this.setupListener("editableKeypress"),this.keypressUpdateInput=!0,this.attachDOMEvent(document,"selectionchange",this.handleDocumentSelectionChange.bind(this)),this.attachToExecCommand());break;case"editableClick":this.attachToEachElement("click",this.handleClick);break;case"editableBlur":this.attachToEachElement("blur",this.handleBlur);break;case"editableKeypress":this.attachToEachElement("keypress",this.handleKeypress);break;case"editableKeyup":this.attachToEachElement("keyup",this.handleKeyup);break;case"editableKeydown":this.attachToEachElement("keydown",this.handleKeydown);break;case"editableKeydownSpace":this.setupListener("editableKeydown");break;case"editableKeydownEnter":this.setupListener("editableKeydown");break;case"editableKeydownTab":this.setupListener("editableKeydown");break;case"editableKeydownDelete":this.setupListener("editableKeydown");break;case"editableMouseover":this.attachToEachElement("mouseover",this.handleMouseover);break;case"editableDrag":this.attachToEachElement("dragover",this.handleDragging),this.attachToEachElement("dragleave",this.handleDragging);break;case"editableDrop":this.attachToEachElement("drop",this.handleDrop);break;case"editablePaste":this.attachToEachElement("paste",this.handlePaste)}this.listeners[a]=!0}},attachToEachElement:function(a,b){this.eventsCache||(this.eventsCache=[]),this.base.elements.forEach(function(c){this.attachDOMEvent(c,a,b.bind(this))},this),this.eventsCache.push({name:a,handler:b})},cleanupElement:function(a){var b=a.getAttribute("medium-editor-index");b&&(this.detachAllEventsFromElement(a),this.contentCache&&delete this.contentCache[b])},focusElement:function(a){a.focus(),this.updateFocus(a,{target:a,type:"focus"})},updateFocus:function(c,d){var e,f=this.base.getFocusedElement();f&&"click"===d.type&&this.lastMousedownTarget&&(a.util.isDescendant(f,this.lastMousedownTarget,!0)||b(this.base.extensions,this.lastMousedownTarget))&&(e=f),e||this.base.elements.some(function(b){return!e&&a.util.isDescendant(b,c,!0)&&(e=b),!!e},this);var g=!a.util.isDescendant(f,c,!0)&&!b(this.base.extensions,c);e!==f&&(f&&g&&(f.removeAttribute("data-medium-focused"),this.triggerCustomEvent("blur",d,f)),e&&(e.setAttribute("data-medium-focused",!0),this.triggerCustomEvent("focus",d,e))),g&&this.triggerCustomEvent("externalInteraction",d)},updateInput:function(a,b){if(this.contentCache){var c=a.getAttribute("medium-editor-index"),d=a.innerHTML;d!==this.contentCache[c]&&this.triggerCustomEvent("editableInput",b,a),this.contentCache[c]=d}},handleDocumentSelectionChange:function(b){if(b.currentTarget&&b.currentTarget.activeElement){var c,d=b.currentTarget.activeElement;this.base.elements.some(function(b){return a.util.isDescendant(b,d,!0)?(c=b,!0):!1},this),c&&this.updateInput(c,{target:d,currentTarget:c})}},handleDocumentExecCommand:function(){var a=this.base.getFocusedElement();a&&this.updateInput(a,{target:a,currentTarget:a})},handleBodyClick:function(a){this.updateFocus(a.target,a)},handleBodyFocus:function(a){this.updateFocus(a.target,a);
},handleBodyMousedown:function(a){this.lastMousedownTarget=a.target},handleInput:function(a){this.updateInput(a.currentTarget,a)},handleClick:function(a){this.triggerCustomEvent("editableClick",a,a.currentTarget)},handleBlur:function(a){this.triggerCustomEvent("editableBlur",a,a.currentTarget)},handleKeypress:function(a){if(this.triggerCustomEvent("editableKeypress",a,a.currentTarget),this.keypressUpdateInput){var b={target:a.target,currentTarget:a.currentTarget};setTimeout(function(){this.updateInput(b.currentTarget,b)}.bind(this),0)}},handleKeyup:function(a){this.triggerCustomEvent("editableKeyup",a,a.currentTarget)},handleMouseover:function(a){this.triggerCustomEvent("editableMouseover",a,a.currentTarget)},handleDragging:function(a){this.triggerCustomEvent("editableDrag",a,a.currentTarget)},handleDrop:function(a){this.triggerCustomEvent("editableDrop",a,a.currentTarget)},handlePaste:function(a){this.triggerCustomEvent("editablePaste",a,a.currentTarget)},handleKeydown:function(b){return this.triggerCustomEvent("editableKeydown",b,b.currentTarget),a.util.isKey(b,a.util.keyCode.SPACE)?this.triggerCustomEvent("editableKeydownSpace",b,b.currentTarget):a.util.isKey(b,a.util.keyCode.ENTER)||b.ctrlKey&&a.util.isKey(b,a.util.keyCode.M)?this.triggerCustomEvent("editableKeydownEnter",b,b.currentTarget):a.util.isKey(b,a.util.keyCode.TAB)?this.triggerCustomEvent("editableKeydownTab",b,b.currentTarget):a.util.isKey(b,[a.util.keyCode.DELETE,a.util.keyCode.BACKSPACE])?this.triggerCustomEvent("editableKeydownDelete",b,b.currentTarget):void 0}},a.Events=c}(),function(){var b=a.Extension.extend({action:void 0,aria:void 0,tagNames:void 0,style:void 0,useQueryState:void 0,contentDefault:void 0,contentFA:void 0,classList:void 0,attrs:void 0,constructor:function(c){b.isBuiltInButton(c)?a.Extension.call(this,this.defaults[c]):a.Extension.call(this,c)},init:function(){a.Extension.prototype.init.apply(this,arguments),this.button=this.createButton(),this.on(this.button,"click",this.handleClick.bind(this))},getButton:function(){return this.button},getAction:function(){return"function"==typeof this.action?this.action(this.base.options):this.action},getAria:function(){return"function"==typeof this.aria?this.aria(this.base.options):this.aria},getTagNames:function(){return"function"==typeof this.tagNames?this.tagNames(this.base.options):this.tagNames},createButton:function(){var a=this.document.createElement("button"),b=this.contentDefault,c=this.getAria(),d=this.getEditorOption("buttonLabels");return a.classList.add("medium-editor-action"),a.classList.add("medium-editor-action-"+this.name),this.classList&&this.classList.forEach(function(b){a.classList.add(b)}),a.setAttribute("data-action",this.getAction()),c&&(a.setAttribute("title",c),a.setAttribute("aria-label",c)),this.attrs&&Object.keys(this.attrs).forEach(function(b){a.setAttribute(b,this.attrs[b])},this),"fontawesome"===d&&this.contentFA&&(b=this.contentFA),a.innerHTML=b,a},handleClick:function(a){a.preventDefault(),a.stopPropagation();var b=this.getAction();b&&this.execAction(b)},isActive:function(){return this.button.classList.contains(this.getEditorOption("activeButtonClass"))},setInactive:function(){this.button.classList.remove(this.getEditorOption("activeButtonClass")),delete this.knownState},setActive:function(){this.button.classList.add(this.getEditorOption("activeButtonClass")),delete this.knownState},queryCommandState:function(){var a=null;return this.useQueryState&&(a=this.base.queryCommandState(this.getAction())),a},isAlreadyApplied:function(a){var b,c,d=!1,e=this.getTagNames();return this.knownState===!1||this.knownState===!0?this.knownState:(e&&e.length>0&&(d=-1!==e.indexOf(a.nodeName.toLowerCase())),!d&&this.style&&(b=this.style.value.split("|"),c=this.window.getComputedStyle(a,null).getPropertyValue(this.style.prop),b.forEach(function(a){this.knownState||(d=-1!==c.indexOf(a),(d||"text-decoration"!==this.style.prop)&&(this.knownState=d))},this)),d)}});b.isBuiltInButton=function(b){return"string"==typeof b&&a.extensions.button.prototype.defaults.hasOwnProperty(b)},a.extensions.button=b}(),function(){a.extensions.button.prototype.defaults={bold:{name:"bold",action:"bold",aria:"bold",tagNames:["b","strong"],style:{prop:"font-weight",value:"700|bold"},useQueryState:!0,contentDefault:"<b>B</b>",contentFA:'<i class="fa fa-bold"></i>'},italic:{name:"italic",action:"italic",aria:"italic",tagNames:["i","em"],style:{prop:"font-style",value:"italic"},useQueryState:!0,contentDefault:"<b><i>I</i></b>",contentFA:'<i class="fa fa-italic"></i>'},underline:{name:"underline",action:"underline",aria:"underline",tagNames:["u"],style:{prop:"text-decoration",value:"underline"},useQueryState:!0,contentDefault:"<b><u>U</u></b>",contentFA:'<i class="fa fa-underline"></i>'},strikethrough:{name:"strikethrough",action:"strikethrough",aria:"strike through",tagNames:["strike"],style:{prop:"text-decoration",value:"line-through"},useQueryState:!0,contentDefault:"<s>A</s>",contentFA:'<i class="fa fa-strikethrough"></i>'},superscript:{name:"superscript",action:"superscript",aria:"superscript",tagNames:["sup"],contentDefault:"<b>x<sup>1</sup></b>",contentFA:'<i class="fa fa-superscript"></i>'},subscript:{name:"subscript",action:"subscript",aria:"subscript",tagNames:["sub"],contentDefault:"<b>x<sub>1</sub></b>",contentFA:'<i class="fa fa-subscript"></i>'},image:{name:"image",action:"image",aria:"image",tagNames:["img"],contentDefault:"<b>image</b>",contentFA:'<i class="fa fa-picture-o"></i>'},html:{name:"html",action:"html",aria:"evaluate html",tagNames:["iframe","object"],contentDefault:"<b>html</b>",contentFA:'<i class="fa fa-code"></i>'},orderedlist:{name:"orderedlist",action:"insertorderedlist",aria:"ordered list",tagNames:["ol"],useQueryState:!0,contentDefault:"<b>1.</b>",contentFA:'<i class="fa fa-list-ol"></i>'},unorderedlist:{name:"unorderedlist",action:"insertunorderedlist",aria:"unordered list",tagNames:["ul"],useQueryState:!0,contentDefault:"<b>&bull;</b>",contentFA:'<i class="fa fa-list-ul"></i>'},indent:{name:"indent",action:"indent",aria:"indent",tagNames:[],contentDefault:"<b>&rarr;</b>",contentFA:'<i class="fa fa-indent"></i>'},outdent:{name:"outdent",action:"outdent",aria:"outdent",tagNames:[],contentDefault:"<b>&larr;</b>",contentFA:'<i class="fa fa-outdent"></i>'},justifyCenter:{name:"justifyCenter",action:"justifyCenter",aria:"center justify",tagNames:[],style:{prop:"text-align",value:"center"},contentDefault:"<b>C</b>",contentFA:'<i class="fa fa-align-center"></i>'},justifyFull:{name:"justifyFull",action:"justifyFull",aria:"full justify",tagNames:[],style:{prop:"text-align",value:"justify"},contentDefault:"<b>J</b>",contentFA:'<i class="fa fa-align-justify"></i>'},justifyLeft:{name:"justifyLeft",action:"justifyLeft",aria:"left justify",tagNames:[],style:{prop:"text-align",value:"left"},contentDefault:"<b>L</b>",contentFA:'<i class="fa fa-align-left"></i>'},justifyRight:{name:"justifyRight",action:"justifyRight",aria:"right justify",tagNames:[],style:{prop:"text-align",value:"right"},contentDefault:"<b>R</b>",contentFA:'<i class="fa fa-align-right"></i>'},removeFormat:{name:"removeFormat",aria:"remove formatting",action:"removeFormat",contentDefault:"<b>X</b>",contentFA:'<i class="fa fa-eraser"></i>'},quote:{name:"quote",action:"append-blockquote",aria:"blockquote",tagNames:["blockquote"],contentDefault:"<b>&ldquo;</b>",contentFA:'<i class="fa fa-quote-right"></i>'},pre:{name:"pre",action:"append-pre",aria:"preformatted text",tagNames:["pre"],contentDefault:"<b>0101</b>",contentFA:'<i class="fa fa-code fa-lg"></i>'},h1:{name:"h1",action:"append-h1",aria:"header type one",tagNames:["h1"],contentDefault:"<b>H1</b>",contentFA:'<i class="fa fa-header"><sup>1</sup>'},h2:{name:"h2",action:"append-h2",aria:"header type two",tagNames:["h2"],contentDefault:"<b>H2</b>",contentFA:'<i class="fa fa-header"><sup>2</sup>'},h3:{name:"h3",action:"append-h3",aria:"header type three",tagNames:["h3"],contentDefault:"<b>H3</b>",contentFA:'<i class="fa fa-header"><sup>3</sup>'},h4:{name:"h4",action:"append-h4",aria:"header type four",tagNames:["h4"],contentDefault:"<b>H4</b>",contentFA:'<i class="fa fa-header"><sup>4</sup>'},h5:{name:"h5",action:"append-h5",aria:"header type five",tagNames:["h5"],contentDefault:"<b>H5</b>",contentFA:'<i class="fa fa-header"><sup>5</sup>'},h6:{name:"h6",action:"append-h6",aria:"header type six",tagNames:["h6"],contentDefault:"<b>H6</b>",contentFA:'<i class="fa fa-header"><sup>6</sup>'}}}(),function(){var b=a.extensions.button.extend({init:function(){a.extensions.button.prototype.init.apply(this,arguments)},formSaveLabel:"&#10003;",formCloseLabel:"&times;",activeClass:"medium-editor-toolbar-form-active",hasForm:!0,getForm:function(){},isDisplayed:function(){return this.hasForm?this.getForm().classList.contains(this.activeClass):!1},showForm:function(){this.hasForm&&this.getForm().classList.add(this.activeClass)},hideForm:function(){this.hasForm&&this.getForm().classList.remove(this.activeClass)},showToolbarDefaultActions:function(){var a=this.base.getExtensionByName("toolbar");a&&a.showToolbarDefaultActions()},hideToolbarDefaultActions:function(){var a=this.base.getExtensionByName("toolbar");a&&a.hideToolbarDefaultActions()},setToolbarPosition:function(){var a=this.base.getExtensionByName("toolbar");a&&a.setToolbarPosition()}});a.extensions.form=b}(),function(){var b=a.extensions.form.extend({customClassOption:null,customClassOptionText:"Button",linkValidation:!1,placeholderText:"Paste or type a link",targetCheckbox:!1,targetCheckboxText:"Open in new window",name:"anchor",action:"createLink",aria:"link",tagNames:["a"],contentDefault:"<b>#</b>",contentFA:'<i class="fa fa-link"></i>',init:function(){a.extensions.form.prototype.init.apply(this,arguments),this.subscribe("editableKeydown",this.handleKeydown.bind(this))},handleClick:function(b){b.preventDefault(),b.stopPropagation();var c=a.selection.getSelectionRange(this.document);return"a"===c.startContainer.nodeName.toLowerCase()||"a"===c.endContainer.nodeName.toLowerCase()||a.util.getClosestTag(a.selection.getSelectedParentElement(c),"a")?this.execAction("unlink"):(this.isDisplayed()||this.showForm(),!1)},handleKeydown:function(b){a.util.isKey(b,a.util.keyCode.K)&&a.util.isMetaCtrlKey(b)&&!b.shiftKey&&this.handleClick(b)},getForm:function(){return this.form||(this.form=this.createForm()),this.form},getTemplate:function(){var a=['<input type="text" class="medium-editor-toolbar-input" placeholder="',this.placeholderText,'">'];return a.push('<a href="#" class="medium-editor-toolbar-save">',"fontawesome"===this.getEditorOption("buttonLabels")?'<i class="fa fa-check"></i>':this.formSaveLabel,"</a>"),a.push('<a href="#" class="medium-editor-toolbar-close">',"fontawesome"===this.getEditorOption("buttonLabels")?'<i class="fa fa-times"></i>':this.formCloseLabel,"</a>"),this.targetCheckbox&&a.push('<div class="medium-editor-toolbar-form-row">','<input type="checkbox" class="medium-editor-toolbar-anchor-target" id="medium-editor-toolbar-anchor-target-field-'+this.getEditorId()+'">','<label for="medium-editor-toolbar-anchor-target-field-'+this.getEditorId()+'">',this.targetCheckboxText,"</label>","</div>"),this.customClassOption&&a.push('<div class="medium-editor-toolbar-form-row">','<input type="checkbox" class="medium-editor-toolbar-anchor-button">',"<label>",this.customClassOptionText,"</label>","</div>"),a.join("")},isDisplayed:function(){return a.extensions.form.prototype.isDisplayed.apply(this)},hideForm:function(){a.extensions.form.prototype.hideForm.apply(this),this.getInput().value=""},showForm:function(b){var c=this.getInput(),d=this.getAnchorTargetCheckbox(),e=this.getAnchorButtonCheckbox();if(b=b||{value:""},"string"==typeof b&&(b={value:b}),this.base.saveSelection(),this.hideToolbarDefaultActions(),a.extensions.form.prototype.showForm.apply(this),this.setToolbarPosition(),c.value=b.value,c.focus(),d&&(d.checked="_blank"===b.target),e){var f=b.buttonClass?b.buttonClass.split(" "):[];e.checked=-1!==f.indexOf(this.customClassOption)}},destroy:function(){return this.form?(this.form.parentNode&&this.form.parentNode.removeChild(this.form),void delete this.form):!1},getFormOpts:function(){var a=this.getAnchorTargetCheckbox(),b=this.getAnchorButtonCheckbox(),c={value:this.getInput().value.trim()};return this.linkValidation&&(c.value=this.checkLinkFormat(c.value)),c.target="_self",a&&a.checked&&(c.target="_blank"),b&&b.checked&&(c.buttonClass=this.customClassOption),c},doFormSave:function(){var a=this.getFormOpts();this.completeFormSave(a)},completeFormSave:function(a){this.base.restoreSelection(),this.execAction(this.action,a),this.base.checkSelection()},ensureEncodedUri:function(a){return a===decodeURI(a)?encodeURI(a):a},ensureEncodedUriComponent:function(a){return a===decodeURIComponent(a)?encodeURIComponent(a):a},ensureEncodedParam:function(a){var b=a.split("="),c=b[0],d=b[1];return c+(void 0===d?"":"="+this.ensureEncodedUriComponent(d))},ensureEncodedQuery:function(a){return a.split("&").map(this.ensureEncodedParam.bind(this)).join("&")},checkLinkFormat:function(a){var b=/^([a-z]+:)?\/\/|^(mailto|tel|maps):|^\#/i,c=b.test(a),d="",e=/^\+?\s?\(?(?:\d\s?\-?\)?){3,20}$/,f=a.match(/^(.*?)(?:\?(.*?))?(?:#(.*))?$/),g=f[1],h=f[2],i=f[3];if(e.test(a))return"tel:"+a;if(!c){var j=g.split("/")[0];(j.match(/.+(\.|:).+/)||"localhost"===j)&&(d="http://")}return d+this.ensureEncodedUri(g)+(void 0===h?"":"?"+this.ensureEncodedQuery(h))+(void 0===i?"":"#"+i)},doFormCancel:function(){this.base.restoreSelection(),this.base.checkSelection()},attachFormEvents:function(a){var b=a.querySelector(".medium-editor-toolbar-close"),c=a.querySelector(".medium-editor-toolbar-save"),d=a.querySelector(".medium-editor-toolbar-input");this.on(a,"click",this.handleFormClick.bind(this)),this.on(d,"keyup",this.handleTextboxKeyup.bind(this)),this.on(b,"click",this.handleCloseClick.bind(this)),this.on(c,"click",this.handleSaveClick.bind(this),!0)},createForm:function(){var a=this.document,b=a.createElement("div");return b.className="medium-editor-toolbar-form",b.id="medium-editor-toolbar-form-anchor-"+this.getEditorId(),b.innerHTML=this.getTemplate(),this.attachFormEvents(b),b},getInput:function(){return this.getForm().querySelector("input.medium-editor-toolbar-input")},getAnchorTargetCheckbox:function(){return this.getForm().querySelector(".medium-editor-toolbar-anchor-target")},getAnchorButtonCheckbox:function(){return this.getForm().querySelector(".medium-editor-toolbar-anchor-button")},handleTextboxKeyup:function(b){return b.keyCode===a.util.keyCode.ENTER?(b.preventDefault(),void this.doFormSave()):void(b.keyCode===a.util.keyCode.ESCAPE&&(b.preventDefault(),this.doFormCancel()))},handleFormClick:function(a){a.stopPropagation()},handleSaveClick:function(a){a.preventDefault(),this.doFormSave()},handleCloseClick:function(a){a.preventDefault(),this.doFormCancel()}});a.extensions.anchor=b}(),function(){var b=a.Extension.extend({name:"anchor-preview",hideDelay:500,previewValueSelector:"a",showWhenToolbarIsVisible:!1,showOnEmptyLinks:!0,init:function(){this.anchorPreview=this.createPreview(),this.getEditorOption("elementsContainer").appendChild(this.anchorPreview),this.attachToEditables()},getInteractionElements:function(){return this.getPreviewElement()},getPreviewElement:function(){return this.anchorPreview},createPreview:function(){var a=this.document.createElement("div");return a.id="medium-editor-anchor-preview-"+this.getEditorId(),a.className="medium-editor-anchor-preview",a.innerHTML=this.getTemplate(),this.on(a,"click",this.handleClick.bind(this)),a},getTemplate:function(){return'<div class="medium-editor-toolbar-anchor-preview" id="medium-editor-toolbar-anchor-preview">    <a class="medium-editor-toolbar-anchor-preview-inner"></a></div>'},destroy:function(){this.anchorPreview&&(this.anchorPreview.parentNode&&this.anchorPreview.parentNode.removeChild(this.anchorPreview),delete this.anchorPreview)},hidePreview:function(){this.anchorPreview&&this.anchorPreview.classList.remove("medium-editor-anchor-preview-active"),this.activeAnchor=null},showPreview:function(a){return this.anchorPreview.classList.contains("medium-editor-anchor-preview-active")||a.getAttribute("data-disable-preview")?!0:(this.previewValueSelector&&(this.anchorPreview.querySelector(this.previewValueSelector).textContent=a.attributes.href.value,this.anchorPreview.querySelector(this.previewValueSelector).href=a.attributes.href.value),this.anchorPreview.classList.add("medium-toolbar-arrow-over"),this.anchorPreview.classList.remove("medium-toolbar-arrow-under"),this.anchorPreview.classList.contains("medium-editor-anchor-preview-active")||this.anchorPreview.classList.add("medium-editor-anchor-preview-active"),this.activeAnchor=a,this.positionPreview(),this.attachPreviewHandlers(),this)},positionPreview:function(a){a=a||this.activeAnchor;var b,c,d,e,f,g=this.window.innerWidth,h=this.anchorPreview.offsetHeight,i=a.getBoundingClientRect(),j=this.diffLeft,k=this.diffTop,l=this.getEditorOption("elementsContainer"),m=["absolute","fixed"].indexOf(window.getComputedStyle(l).getPropertyValue("position"))>-1,n={};b=this.anchorPreview.offsetWidth/2;var o=this.base.getExtensionByName("toolbar");o&&(j=o.diffLeft,k=o.diffTop),c=j-b,m?(e=l.getBoundingClientRect(),["top","left"].forEach(function(a){n[a]=i[a]-e[a]}),n.width=i.width,n.height=i.height,i=n,g=e.width,f=l.scrollTop):f=this.window.pageYOffset,d=i.left+i.width/2,f+=h+i.top+i.height-k-this.anchorPreview.offsetHeight,this.anchorPreview.style.top=Math.round(f)+"px",this.anchorPreview.style.right="initial",b>d?(this.anchorPreview.style.left=c+b+"px",this.anchorPreview.style.right="initial"):b>g-d?(this.anchorPreview.style.left="auto",this.anchorPreview.style.right=0):(this.anchorPreview.style.left=c+d+"px",this.anchorPreview.style.right="initial")},attachToEditables:function(){this.subscribe("editableMouseover",this.handleEditableMouseover.bind(this)),this.subscribe("positionedToolbar",this.handlePositionedToolbar.bind(this))},handlePositionedToolbar:function(){this.showWhenToolbarIsVisible||this.hidePreview()},handleClick:function(a){var b=this.base.getExtensionByName("anchor"),c=this.activeAnchor;b&&c&&(a.preventDefault(),this.base.selectElement(this.activeAnchor),this.base.delay(function(){if(c){var a={value:c.attributes.href.value,target:c.getAttribute("target"),buttonClass:c.getAttribute("class")};b.showForm(a),c=null}}.bind(this))),this.hidePreview()},handleAnchorMouseout:function(){this.anchorToPreview=null,this.off(this.activeAnchor,"mouseout",this.instanceHandleAnchorMouseout),this.instanceHandleAnchorMouseout=null},handleEditableMouseover:function(b){var c=a.util.getClosestTag(b.target,"a");if(!1!==c){if(!this.showOnEmptyLinks&&(!/href=["']\S+["']/.test(c.outerHTML)||/href=["']#\S+["']/.test(c.outerHTML)))return!0;var d=this.base.getExtensionByName("toolbar");if(!this.showWhenToolbarIsVisible&&d&&d.isDisplayed&&d.isDisplayed())return!0;this.activeAnchor&&this.activeAnchor!==c&&this.detachPreviewHandlers(),this.anchorToPreview=c,this.instanceHandleAnchorMouseout=this.handleAnchorMouseout.bind(this),this.on(this.anchorToPreview,"mouseout",this.instanceHandleAnchorMouseout),this.base.delay(function(){this.anchorToPreview&&this.showPreview(this.anchorToPreview)}.bind(this))}},handlePreviewMouseover:function(){this.lastOver=(new Date).getTime(),this.hovering=!0},handlePreviewMouseout:function(a){a.relatedTarget&&/anchor-preview/.test(a.relatedTarget.className)||(this.hovering=!1)},updatePreview:function(){if(this.hovering)return!0;var a=(new Date).getTime()-this.lastOver;a>this.hideDelay&&this.detachPreviewHandlers()},detachPreviewHandlers:function(){clearInterval(this.intervalTimer),this.instanceHandlePreviewMouseover&&(this.off(this.anchorPreview,"mouseover",this.instanceHandlePreviewMouseover),this.off(this.anchorPreview,"mouseout",this.instanceHandlePreviewMouseout),this.activeAnchor&&(this.off(this.activeAnchor,"mouseover",this.instanceHandlePreviewMouseover),this.off(this.activeAnchor,"mouseout",this.instanceHandlePreviewMouseout))),this.hidePreview(),this.hovering=this.instanceHandlePreviewMouseover=this.instanceHandlePreviewMouseout=null},attachPreviewHandlers:function(){this.lastOver=(new Date).getTime(),this.hovering=!0,this.instanceHandlePreviewMouseover=this.handlePreviewMouseover.bind(this),this.instanceHandlePreviewMouseout=this.handlePreviewMouseout.bind(this),this.intervalTimer=setInterval(this.updatePreview.bind(this),200),this.on(this.anchorPreview,"mouseover",this.instanceHandlePreviewMouseover),this.on(this.anchorPreview,"mouseout",this.instanceHandlePreviewMouseout),this.on(this.activeAnchor,"mouseover",this.instanceHandlePreviewMouseover),this.on(this.activeAnchor,"mouseout",this.instanceHandlePreviewMouseout)}});a.extensions.anchorPreview=b}(),function(){function b(b){return!a.util.getClosestTag(b,"a")}var c,d,e,f,g;c=[" ","	","\n","\r"," "," "," "," "," ","\u2028","\u2029"],d="com|net|org|edu|gov|mil|aero|asia|biz|cat|coop|info|int|jobs|mobi|museum|name|post|pro|tel|travel|xxx|ac|ad|ae|af|ag|ai|al|am|an|ao|aq|ar|as|at|au|aw|ax|az|ba|bb|bd|be|bf|bg|bh|bi|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|cr|cs|cu|cv|cx|cy|cz|dd|de|dj|dk|dm|do|dz|ec|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gg|gh|gi|gl|gm|gn|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|im|in|io|iq|ir|is|it|je|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|me|mg|mh|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|mv|mw|mx|my|mz|na|nc|ne|nf|ng|ni|nl|no|np|nr|nu|nz|om|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|ps|pt|pw|py|qa|re|ro|rs|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|ja|sk|sl|sm|sn|so|sr|ss|st|su|sv|sx|sy|sz|tc|td|tf|tg|th|tj|tk|tl|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw",e="(((?:(https?://|ftps?://|nntp://)|www\\d{0,3}[.]|[a-z0-9.\\-]+[.]("+d+")\\/)\\S+(?:[^\\s`!\\[\\]{};:'\".,?«»“”‘’])))|(([a-z0-9\\-]+\\.)?[a-z0-9\\-]+\\.("+d+"))",f=new RegExp("^("+d+")$","i"),g=new RegExp(e,"gi");var h=a.Extension.extend({init:function(){a.Extension.prototype.init.apply(this,arguments),this.disableEventHandling=!1,this.subscribe("editableKeypress",this.onKeypress.bind(this)),this.subscribe("editableBlur",this.onBlur.bind(this)),this.document.execCommand("AutoUrlDetect",!1,!1)},isLastInstance:function(){for(var a=0,b=0;b<this.window._mediumEditors.length;b++){var c=this.window._mediumEditors[b];null!==c&&void 0!==c.getExtensionByName("autoLink")&&a++}return 1===a},destroy:function(){this.document.queryCommandSupported("AutoUrlDetect")&&this.isLastInstance()&&this.document.execCommand("AutoUrlDetect",!1,!0)},onBlur:function(a,b){this.performLinking(b)},onKeypress:function(b){this.disableEventHandling||a.util.isKey(b,[a.util.keyCode.SPACE,a.util.keyCode.ENTER])&&(clearTimeout(this.performLinkingTimeout),this.performLinkingTimeout=setTimeout(function(){try{var a=this.base.exportSelection();this.performLinking(b.target)&&this.base.importSelection(a,!0)}catch(c){window.console&&window.console.error("Failed to perform linking",c),this.disableEventHandling=!0}}.bind(this),0))},performLinking:function(b){var c=a.util.splitByBlockElements(b),d=!1;0===c.length&&(c=[b]);for(var e=0;e<c.length;e++)d=this.removeObsoleteAutoLinkSpans(c[e])||d,d=this.performLinkingWithinElement(c[e])||d;return this.base.events.updateInput(b,{target:b,currentTarget:b}),d},removeObsoleteAutoLinkSpans:function(c){if(!c||3===c.nodeType)return!1;for(var d=c.querySelectorAll('span[data-auto-link="true"]'),e=!1,f=0;f<d.length;f++){var g=d[f].textContent;if(-1===g.indexOf("://")&&(g=a.util.ensureUrlHasProtocol(g)),d[f].getAttribute("data-href")!==g&&b(d[f])){e=!0;var h=g.replace(/\s+$/,"");if(d[f].getAttribute("data-href")===h){var i=g.length-h.length,j=a.util.splitOffDOMTree(d[f],this.splitTextBeforeEnd(d[f],i));d[f].parentNode.insertBefore(j,d[f].nextSibling)}else a.util.unwrap(d[f],this.document)}}return e},splitTextBeforeEnd:function(a,b){for(var c=this.document.createTreeWalker(a,NodeFilter.SHOW_TEXT,null,!1),d=!0;d;)d=null!==c.lastChild();for(var e,f,g;b>0&&null!==g;)e=c.currentNode,f=e.nodeValue,f.length>b?(g=e.splitText(f.length-b),b=0):(g=c.previousNode(),b-=f.length);return g},performLinkingWithinElement:function(b){for(var c=this.findLinkableText(b),d=!1,e=0;e<c.length;e++){var f=a.util.findOrCreateMatchingTextNodes(this.document,b,c[e]);this.shouldNotLink(f)||this.createAutoLink(f,c[e].href)}return d},shouldNotLink:function(b){for(var c=!1,d=0;d<b.length&&c===!1;d++)c=!!a.util.traverseUp(b[d],function(a){return"a"===a.nodeName.toLowerCase()||a.getAttribute&&"true"===a.getAttribute("data-auto-link")});return c},findLinkableText:function(a){for(var b=a.textContent,d=null,e=[];null!==(d=g.exec(b));){var h=!0,i=d.index+d[0].length;h=!(0!==d.index&&-1===c.indexOf(b[d.index-1])||i!==b.length&&-1===c.indexOf(b[i])),h=h&&(-1!==d[0].indexOf("/")||f.test(d[0].split(".").pop().split("?").shift())),h&&e.push({href:d[0],start:d.index,end:i})}return e},createAutoLink:function(b,c){c=a.util.ensureUrlHasProtocol(c);var d=a.util.createLink(this.document,b,c,this.getEditorOption("targetBlank")?"_blank":null),e=this.document.createElement("span");for(e.setAttribute("data-auto-link","true"),e.setAttribute("data-href",c),d.insertBefore(e,d.firstChild);d.childNodes.length>1;)e.appendChild(d.childNodes[1])}});a.extensions.autoLink=h}(),function(){function b(b){var d=a.util.getContainerEditorElement(b),e=Array.prototype.slice.call(d.parentElement.querySelectorAll("."+c));e.forEach(function(a){a.classList.remove(c)})}var c="medium-editor-dragover",d=a.Extension.extend({name:"fileDragging",allowedTypes:["image"],init:function(){a.Extension.prototype.init.apply(this,arguments),this.subscribe("editableDrag",this.handleDrag.bind(this)),this.subscribe("editableDrop",this.handleDrop.bind(this))},handleDrag:function(a){a.preventDefault(),a.dataTransfer.dropEffect="copy";var d=a.target.classList?a.target:a.target.parentElement;b(d),"dragover"===a.type&&d.classList.add(c)},handleDrop:function(a){a.preventDefault(),a.stopPropagation(),this.base.selectElement(a.target);var c=this.base.exportSelection();c.start=c.end,this.base.importSelection(c),a.dataTransfer.files&&Array.prototype.slice.call(a.dataTransfer.files).forEach(function(a){this.isAllowedFile(a)&&a.type.match("image")&&this.insertImageFile(a)},this),b(a.target)},isAllowedFile:function(a){return this.allowedTypes.some(function(b){return!!a.type.match(b)})},insertImageFile:function(b){if("function"==typeof FileReader){var c=new FileReader;c.readAsDataURL(b),c.addEventListener("load",function(b){var c=this.document.createElement("img");c.src=b.target.result,a.util.insertHTMLCommand(this.document,c.outerHTML)}.bind(this))}}});a.extensions.fileDragging=d}(),function(){var b=a.Extension.extend({name:"keyboard-commands",commands:[{command:"bold",key:"B",meta:!0,shift:!1,alt:!1},{command:"italic",key:"I",meta:!0,shift:!1,alt:!1},{command:"underline",key:"U",meta:!0,shift:!1,alt:!1}],init:function(){a.Extension.prototype.init.apply(this,arguments),this.subscribe("editableKeydown",this.handleKeydown.bind(this)),this.keys={},this.commands.forEach(function(a){var b=a.key.charCodeAt(0);this.keys[b]||(this.keys[b]=[]),this.keys[b].push(a)},this)},handleKeydown:function(b){var c=a.util.getKeyCode(b);if(this.keys[c]){var d=a.util.isMetaCtrlKey(b),e=!!b.shiftKey,f=!!b.altKey;this.keys[c].forEach(function(a){a.meta!==d||a.shift!==e||a.alt!==f&&void 0!==a.alt||(b.preventDefault(),b.stopPropagation(),"function"==typeof a.command?a.command.apply(this):!1!==a.command&&this.execAction(a.command))},this)}}});a.extensions.keyboardCommands=b}(),function(){var b=a.extensions.form.extend({name:"fontname",action:"fontName",aria:"change font name",contentDefault:"&#xB1;",contentFA:'<i class="fa fa-font"></i>',fonts:["","Arial","Verdana","Times New Roman"],init:function(){a.extensions.form.prototype.init.apply(this,arguments)},handleClick:function(a){if(a.preventDefault(),a.stopPropagation(),!this.isDisplayed()){var b=this.document.queryCommandValue("fontName")+"";this.showForm(b)}return!1},getForm:function(){return this.form||(this.form=this.createForm()),this.form},isDisplayed:function(){return"block"===this.getForm().style.display},hideForm:function(){this.getForm().style.display="none",this.getSelect().value=""},showForm:function(a){var b=this.getSelect();this.base.saveSelection(),this.hideToolbarDefaultActions(),this.getForm().style.display="block",this.setToolbarPosition(),b.value=a||"",b.focus()},destroy:function(){return this.form?(this.form.parentNode&&this.form.parentNode.removeChild(this.form),void delete this.form):!1},doFormSave:function(){this.base.restoreSelection(),this.base.checkSelection()},doFormCancel:function(){this.base.restoreSelection(),this.clearFontName(),this.base.checkSelection()},createForm:function(){var a,b=this.document,c=b.createElement("div"),d=b.createElement("select"),e=b.createElement("a"),f=b.createElement("a");c.className="medium-editor-toolbar-form",c.id="medium-editor-toolbar-form-fontname-"+this.getEditorId(),this.on(c,"click",this.handleFormClick.bind(this));for(var g=0;g<this.fonts.length;g++)a=b.createElement("option"),a.innerHTML=this.fonts[g],a.value=this.fonts[g],d.appendChild(a);return d.className="medium-editor-toolbar-select",c.appendChild(d),this.on(d,"change",this.handleFontChange.bind(this)),f.setAttribute("href","#"),f.className="medium-editor-toobar-save",f.innerHTML="fontawesome"===this.getEditorOption("buttonLabels")?'<i class="fa fa-check"></i>':"&#10003;",c.appendChild(f),this.on(f,"click",this.handleSaveClick.bind(this),!0),e.setAttribute("href","#"),e.className="medium-editor-toobar-close",e.innerHTML="fontawesome"===this.getEditorOption("buttonLabels")?'<i class="fa fa-times"></i>':"&times;",c.appendChild(e),this.on(e,"click",this.handleCloseClick.bind(this)),c},getSelect:function(){return this.getForm().querySelector("select.medium-editor-toolbar-select")},clearFontName:function(){a.selection.getSelectedElements(this.document).forEach(function(a){"font"===a.nodeName.toLowerCase()&&a.hasAttribute("face")&&a.removeAttribute("face")})},handleFontChange:function(){var a=this.getSelect().value;""===a?this.clearFontName():this.execAction("fontName",{value:a})},handleFormClick:function(a){a.stopPropagation()},handleSaveClick:function(a){a.preventDefault(),this.doFormSave()},handleCloseClick:function(a){a.preventDefault(),this.doFormCancel()}});a.extensions.fontName=b}(),function(){var b=a.extensions.form.extend({name:"fontsize",action:"fontSize",aria:"increase/decrease font size",contentDefault:"&#xB1;",contentFA:'<i class="fa fa-text-height"></i>',init:function(){a.extensions.form.prototype.init.apply(this,arguments)},handleClick:function(a){if(a.preventDefault(),a.stopPropagation(),!this.isDisplayed()){var b=this.document.queryCommandValue("fontSize")+"";this.showForm(b)}return!1},getForm:function(){return this.form||(this.form=this.createForm()),this.form},isDisplayed:function(){return"block"===this.getForm().style.display},hideForm:function(){this.getForm().style.display="none",this.getInput().value=""},showForm:function(a){var b=this.getInput();this.base.saveSelection(),this.hideToolbarDefaultActions(),this.getForm().style.display="block",this.setToolbarPosition(),b.value=a||"",b.focus()},destroy:function(){return this.form?(this.form.parentNode&&this.form.parentNode.removeChild(this.form),void delete this.form):!1},doFormSave:function(){this.base.restoreSelection(),this.base.checkSelection()},doFormCancel:function(){this.base.restoreSelection(),this.clearFontSize(),this.base.checkSelection()},createForm:function(){var a=this.document,b=a.createElement("div"),c=a.createElement("input"),d=a.createElement("a"),e=a.createElement("a");return b.className="medium-editor-toolbar-form",b.id="medium-editor-toolbar-form-fontsize-"+this.getEditorId(),this.on(b,"click",this.handleFormClick.bind(this)),c.setAttribute("type","range"),c.setAttribute("min","1"),
c.setAttribute("max","7"),c.className="medium-editor-toolbar-input",b.appendChild(c),this.on(c,"change",this.handleSliderChange.bind(this)),e.setAttribute("href","#"),e.className="medium-editor-toobar-save",e.innerHTML="fontawesome"===this.getEditorOption("buttonLabels")?'<i class="fa fa-check"></i>':"&#10003;",b.appendChild(e),this.on(e,"click",this.handleSaveClick.bind(this),!0),d.setAttribute("href","#"),d.className="medium-editor-toobar-close",d.innerHTML="fontawesome"===this.getEditorOption("buttonLabels")?'<i class="fa fa-times"></i>':"&times;",b.appendChild(d),this.on(d,"click",this.handleCloseClick.bind(this)),b},getInput:function(){return this.getForm().querySelector("input.medium-editor-toolbar-input")},clearFontSize:function(){a.selection.getSelectedElements(this.document).forEach(function(a){"font"===a.nodeName.toLowerCase()&&a.hasAttribute("size")&&a.removeAttribute("size")})},handleSliderChange:function(){var a=this.getInput().value;"4"===a?this.clearFontSize():this.execAction("fontSize",{value:a})},handleFormClick:function(a){a.stopPropagation()},handleSaveClick:function(a){a.preventDefault(),this.doFormSave()},handleCloseClick:function(a){a.preventDefault(),this.doFormCancel()}});a.extensions.fontSize=b}(),function(){function b(){return[[new RegExp(/^[\s\S]*<body[^>]*>\s*|\s*<\/body[^>]*>[\s\S]*$/g),""],[new RegExp(/<!--StartFragment-->|<!--EndFragment-->/g),""],[new RegExp(/<br>$/i),""],[new RegExp(/<[^>]*docs-internal-guid[^>]*>/gi),""],[new RegExp(/<\/b>(<br[^>]*>)?$/gi),""],[new RegExp(/<span class="Apple-converted-space">\s+<\/span>/g)," "],[new RegExp(/<br class="Apple-interchange-newline">/g),"<br>"],[new RegExp(/<span[^>]*(font-style:italic;font-weight:(bold|700)|font-weight:(bold|700);font-style:italic)[^>]*>/gi),'<span class="replace-with italic bold">'],[new RegExp(/<span[^>]*font-style:italic[^>]*>/gi),'<span class="replace-with italic">'],[new RegExp(/<span[^>]*font-weight:(bold|700)[^>]*>/gi),'<span class="replace-with bold">'],[new RegExp(/&lt;(\/?)(i|b|a)&gt;/gi),"<$1$2>"],[new RegExp(/&lt;a(?:(?!href).)+href=(?:&quot;|&rdquo;|&ldquo;|"|“|”)(((?!&quot;|&rdquo;|&ldquo;|"|“|”).)*)(?:&quot;|&rdquo;|&ldquo;|"|“|”)(?:(?!&gt;).)*&gt;/gi),'<a href="$1">'],[new RegExp(/<\/p>\n+/gi),"</p>"],[new RegExp(/\n+<p/gi),"<p"],[new RegExp(/<\/?o:[a-z]*>/gi),""],[new RegExp(/<!\[if !supportLists\]>(((?!<!).)*)<!\[endif]\>/gi),"$1"]]}function c(a,b,c){var d=a.clipboardData||b.clipboardData||c.dataTransfer,e={};if(!d)return e;if(d.getData){var f=d.getData("Text");f&&f.length>0&&(e["text/plain"]=f)}if(d.types)for(var g=0;g<d.types.length;g++){var h=d.types[g];e[h]=d.getData(h)}return e}var d="%ME_PASTEBIN%",e=null,f=null,g=function(a){a.stopPropagation()},h=a.Extension.extend({forcePlainText:!0,cleanPastedHTML:!1,preCleanReplacements:[],cleanReplacements:[],cleanAttrs:["class","style","dir"],cleanTags:["meta"],unwrapTags:[],init:function(){a.Extension.prototype.init.apply(this,arguments),(this.forcePlainText||this.cleanPastedHTML)&&(this.subscribe("editableKeydown",this.handleKeydown.bind(this)),this.getEditorElements().forEach(function(a){this.on(a,"paste",this.handlePaste.bind(this))},this),this.subscribe("addElement",this.handleAddElement.bind(this)))},handleAddElement:function(a,b){this.on(b,"paste",this.handlePaste.bind(this))},destroy:function(){(this.forcePlainText||this.cleanPastedHTML)&&this.removePasteBin()},handlePaste:function(a,b){if(!a.defaultPrevented){var d=c(a,this.window,this.document),e=d["text/html"],f=d["text/plain"];this.window.clipboardData&&void 0===a.clipboardData&&!e&&(e=f),(e||f)&&(a.preventDefault(),this.doPaste(e,f,b))}},doPaste:function(b,c,d){var e,f,g="";if(this.cleanPastedHTML&&b)return this.cleanPaste(b);if(c){if(this.getEditorOption("disableReturn")||d&&d.getAttribute("data-disable-return"))g=a.util.htmlEntities(c);else if(e=c.split(/[\r\n]+/g),e.length>1)for(f=0;f<e.length;f+=1)""!==e[f]&&(g+="<p>"+a.util.htmlEntities(e[f])+"</p>");else g=a.util.htmlEntities(e[0]);a.util.insertHTMLCommand(this.document,g)}},handlePasteBinPaste:function(a){if(a.defaultPrevented)return void this.removePasteBin();var b=c(a,this.window,this.document),d=b["text/html"],e=b["text/plain"],g=f;return!this.cleanPastedHTML||d?(a.preventDefault(),this.removePasteBin(),this.doPaste(d,e,g),void this.trigger("editablePaste",{currentTarget:g,target:g},g)):void setTimeout(function(){this.cleanPastedHTML&&(d=this.getPasteBinHtml()),this.removePasteBin(),this.doPaste(d,e,g),this.trigger("editablePaste",{currentTarget:g,target:g},g)}.bind(this),0)},handleKeydown:function(b,c){a.util.isKey(b,a.util.keyCode.V)&&a.util.isMetaCtrlKey(b)&&(b.stopImmediatePropagation(),this.removePasteBin(),this.createPasteBin(c))},createPasteBin:function(b){var c,h=a.selection.getSelectionRange(this.document),i=this.window.pageYOffset;f=b,h&&(c=h.getClientRects(),i+=c.length?c[0].top:void 0!==h.startContainer.getBoundingClientRect?h.startContainer.getBoundingClientRect().top:h.getBoundingClientRect().top),e=h;var j=this.document.createElement("div");j.id=this.pasteBinId="medium-editor-pastebin-"+ +Date.now(),j.setAttribute("style","border: 1px red solid; position: absolute; top: "+i+"px; width: 10px; height: 10px; overflow: hidden; opacity: 0"),j.setAttribute("contentEditable",!0),j.innerHTML=d,this.document.body.appendChild(j),this.on(j,"focus",g),this.on(j,"focusin",g),this.on(j,"focusout",g),j.focus(),a.selection.selectNode(j,this.document),this.boundHandlePaste||(this.boundHandlePaste=this.handlePasteBinPaste.bind(this)),this.on(j,"paste",this.boundHandlePaste)},removePasteBin:function(){null!==e&&(a.selection.selectRange(this.document,e),e=null),null!==f&&(f=null);var b=this.getPasteBin();b&&b&&(this.off(b,"focus",g),this.off(b,"focusin",g),this.off(b,"focusout",g),this.off(b,"paste",this.boundHandlePaste),b.parentElement.removeChild(b))},getPasteBin:function(){return this.document.getElementById(this.pasteBinId)},getPasteBinHtml:function(){var a=this.getPasteBin();if(!a)return!1;if(a.firstChild&&"mcepastebin"===a.firstChild.id)return!1;var b=a.innerHTML;return b&&b!==d?b:!1},cleanPaste:function(a){var c,d,e,f,g=/<p|<br|<div/.test(a),h=[].concat(this.preCleanReplacements||[],b(),this.cleanReplacements||[]);for(c=0;c<h.length;c+=1)a=a.replace(h[c][0],h[c][1]);if(!g)return this.pasteHTML(a);for(e=this.document.createElement("div"),e.innerHTML="<p>"+a.split("<br><br>").join("</p><p>")+"</p>",d=e.querySelectorAll("a,p,div,br"),c=0;c<d.length;c+=1)switch(f=d[c],f.innerHTML=f.innerHTML.replace(/\n/gi," "),f.nodeName.toLowerCase()){case"p":case"div":this.filterCommonBlocks(f);break;case"br":this.filterLineBreak(f)}this.pasteHTML(e.innerHTML)},pasteHTML:function(b,c){c=a.util.defaults({},c,{cleanAttrs:this.cleanAttrs,cleanTags:this.cleanTags,unwrapTags:this.unwrapTags});var d,e,f,g,h=this.document.createDocumentFragment();for(h.appendChild(this.document.createElement("body")),g=h.querySelector("body"),g.innerHTML=b,this.cleanupSpans(g),d=g.querySelectorAll("*"),f=0;f<d.length;f+=1)e=d[f],"a"===e.nodeName.toLowerCase()&&this.getEditorOption("targetBlank")&&a.util.setTargetBlank(e),a.util.cleanupAttrs(e,c.cleanAttrs),a.util.cleanupTags(e,c.cleanTags),a.util.unwrapTags(e,c.unwrapTags);a.util.insertHTMLCommand(this.document,g.innerHTML.replace(/&nbsp;/g," "))},isCommonBlock:function(a){return a&&("p"===a.nodeName.toLowerCase()||"div"===a.nodeName.toLowerCase())},filterCommonBlocks:function(a){/^\s*$/.test(a.textContent)&&a.parentNode&&a.parentNode.removeChild(a)},filterLineBreak:function(a){this.isCommonBlock(a.previousElementSibling)?this.removeWithParent(a):!this.isCommonBlock(a.parentNode)||a.parentNode.firstChild!==a&&a.parentNode.lastChild!==a?a.parentNode&&1===a.parentNode.childElementCount&&""===a.parentNode.textContent&&this.removeWithParent(a):this.removeWithParent(a)},removeWithParent:function(a){a&&a.parentNode&&(a.parentNode.parentNode&&1===a.parentNode.childElementCount?a.parentNode.parentNode.removeChild(a.parentNode):a.parentNode.removeChild(a))},cleanupSpans:function(b){var c,d,e,f=b.querySelectorAll(".replace-with"),g=function(a){return a&&"#text"!==a.nodeName&&"false"===a.getAttribute("contenteditable")};for(c=0;c<f.length;c+=1)d=f[c],e=this.document.createElement(d.classList.contains("bold")?"b":"i"),d.classList.contains("bold")&&d.classList.contains("italic")?e.innerHTML="<i>"+d.innerHTML+"</i>":e.innerHTML=d.innerHTML,d.parentNode.replaceChild(e,d);for(f=b.querySelectorAll("span"),c=0;c<f.length;c+=1){if(d=f[c],a.util.traverseUp(d,g))return!1;a.util.unwrap(d,this.document)}}});a.extensions.paste=h}(),function(){var b=a.Extension.extend({name:"placeholder",text:"Type your text",hideOnClick:!0,init:function(){a.Extension.prototype.init.apply(this,arguments),this.initPlaceholders(),this.attachEventHandlers()},initPlaceholders:function(){this.getEditorElements().forEach(this.initElement,this)},handleAddElement:function(a,b){this.initElement(b)},initElement:function(a){a.getAttribute("data-placeholder")||a.setAttribute("data-placeholder",this.text),this.updatePlaceholder(a)},destroy:function(){this.getEditorElements().forEach(this.cleanupElement,this)},handleRemoveElement:function(a,b){this.cleanupElement(b)},cleanupElement:function(a){a.getAttribute("data-placeholder")===this.text&&a.removeAttribute("data-placeholder")},showPlaceholder:function(b){b&&(a.util.isFF&&0===b.childNodes.length?(b.classList.add("medium-editor-placeholder-relative"),b.classList.remove("medium-editor-placeholder")):(b.classList.add("medium-editor-placeholder"),b.classList.remove("medium-editor-placeholder-relative")))},hidePlaceholder:function(a){a&&(a.classList.remove("medium-editor-placeholder"),a.classList.remove("medium-editor-placeholder-relative"))},updatePlaceholder:function(a,b){return a.querySelector("img, blockquote, ul, ol, table")||""!==a.textContent.replace(/^\s+|\s+$/g,"")?this.hidePlaceholder(a):void(b||this.showPlaceholder(a))},attachEventHandlers:function(){this.hideOnClick&&this.subscribe("focus",this.handleFocus.bind(this)),this.subscribe("editableInput",this.handleInput.bind(this)),this.subscribe("blur",this.handleBlur.bind(this)),this.subscribe("addElement",this.handleAddElement.bind(this)),this.subscribe("removeElement",this.handleRemoveElement.bind(this))},handleInput:function(a,b){var c=this.hideOnClick&&b===this.base.getFocusedElement();this.updatePlaceholder(b,c)},handleFocus:function(a,b){this.hidePlaceholder(b)},handleBlur:function(a,b){this.updatePlaceholder(b)}});a.extensions.placeholder=b}(),function(){var b=a.Extension.extend({name:"toolbar",align:"center",allowMultiParagraphSelection:!0,buttons:["bold","italic","underline","anchor","h2","h3","quote"],diffLeft:0,diffTop:-10,firstButtonClass:"medium-editor-button-first",lastButtonClass:"medium-editor-button-last",standardizeSelectionStart:!1,"static":!1,sticky:!1,stickyTopOffset:0,updateOnEmptySelection:!1,relativeContainer:null,init:function(){a.Extension.prototype.init.apply(this,arguments),this.initThrottledMethods(),this.relativeContainer?this.relativeContainer.appendChild(this.getToolbarElement()):this.getEditorOption("elementsContainer").appendChild(this.getToolbarElement())},forEachExtension:function(a,b){return this.base.extensions.forEach(function(c){return c!==this?a.apply(b||this,arguments):void 0},this)},createToolbar:function(){var a=this.document.createElement("div");return a.id="medium-editor-toolbar-"+this.getEditorId(),a.className="medium-editor-toolbar",this["static"]?a.className+=" static-toolbar":this.relativeContainer?a.className+=" medium-editor-relative-toolbar":a.className+=" medium-editor-stalker-toolbar",a.appendChild(this.createToolbarButtons()),this.forEachExtension(function(b){b.hasForm&&a.appendChild(b.getForm())}),this.attachEventHandlers(),a},createToolbarButtons:function(){var b,c,d,e,f,g,h=this.document.createElement("ul");return h.id="medium-editor-toolbar-actions"+this.getEditorId(),h.className="medium-editor-toolbar-actions",h.style.display="block",this.buttons.forEach(function(d){"string"==typeof d?(f=d,g=null):(f=d.name,g=d),e=this.base.addBuiltInExtension(f,g),e&&"function"==typeof e.getButton&&(c=e.getButton(this.base),b=this.document.createElement("li"),a.util.isElement(c)?b.appendChild(c):b.innerHTML=c,h.appendChild(b))},this),d=h.querySelectorAll("button"),d.length>0&&(d[0].classList.add(this.firstButtonClass),d[d.length-1].classList.add(this.lastButtonClass)),h},destroy:function(){this.toolbar&&(this.toolbar.parentNode&&this.toolbar.parentNode.removeChild(this.toolbar),delete this.toolbar)},getInteractionElements:function(){return this.getToolbarElement()},getToolbarElement:function(){return this.toolbar||(this.toolbar=this.createToolbar()),this.toolbar},getToolbarActionsElement:function(){return this.getToolbarElement().querySelector(".medium-editor-toolbar-actions")},initThrottledMethods:function(){this.throttledPositionToolbar=a.util.throttle(function(){this.base.isActive&&this.positionToolbarIfShown()}.bind(this))},attachEventHandlers:function(){this.subscribe("blur",this.handleBlur.bind(this)),this.subscribe("focus",this.handleFocus.bind(this)),this.subscribe("editableClick",this.handleEditableClick.bind(this)),this.subscribe("editableKeyup",this.handleEditableKeyup.bind(this)),this.on(this.document.documentElement,"mouseup",this.handleDocumentMouseup.bind(this)),this["static"]&&this.sticky&&this.on(this.window,"scroll",this.handleWindowScroll.bind(this),!0),this.on(this.window,"resize",this.handleWindowResize.bind(this))},handleWindowScroll:function(){this.positionToolbarIfShown()},handleWindowResize:function(){this.throttledPositionToolbar()},handleDocumentMouseup:function(b){return b&&b.target&&a.util.isDescendant(this.getToolbarElement(),b.target)?!1:void this.checkState()},handleEditableClick:function(){setTimeout(function(){this.checkState()}.bind(this),0)},handleEditableKeyup:function(){this.checkState()},handleBlur:function(){clearTimeout(this.hideTimeout),clearTimeout(this.delayShowTimeout),this.hideTimeout=setTimeout(function(){this.hideToolbar()}.bind(this),1)},handleFocus:function(){this.checkState()},isDisplayed:function(){return this.getToolbarElement().classList.contains("medium-editor-toolbar-active")},showToolbar:function(){clearTimeout(this.hideTimeout),this.isDisplayed()||(this.getToolbarElement().classList.add("medium-editor-toolbar-active"),this.trigger("showToolbar",{},this.base.getFocusedElement()))},hideToolbar:function(){this.isDisplayed()&&(this.getToolbarElement().classList.remove("medium-editor-toolbar-active"),this.trigger("hideToolbar",{},this.base.getFocusedElement()))},isToolbarDefaultActionsDisplayed:function(){return"block"===this.getToolbarActionsElement().style.display},hideToolbarDefaultActions:function(){this.isToolbarDefaultActionsDisplayed()&&(this.getToolbarActionsElement().style.display="none")},showToolbarDefaultActions:function(){this.hideExtensionForms(),this.isToolbarDefaultActionsDisplayed()||(this.getToolbarActionsElement().style.display="block"),this.delayShowTimeout=this.base.delay(function(){this.showToolbar()}.bind(this))},hideExtensionForms:function(){this.forEachExtension(function(a){a.hasForm&&a.isDisplayed()&&a.hideForm()})},multipleBlockElementsSelected:function(){var b=/<[^\/>][^>]*><\/[^>]+>/gim,c=new RegExp("<("+a.util.blockContainerElementNames.join("|")+")[^>]*>","g"),d=a.selection.getSelectionHtml(this.document).replace(b,""),e=d.match(c);return!!e&&e.length>1},modifySelection:function(){var b=this.window.getSelection(),c=b.getRangeAt(0);if(this.standardizeSelectionStart&&c.startContainer.nodeValue&&c.startOffset===c.startContainer.nodeValue.length){var d=a.util.findAdjacentTextNodeWithContent(a.selection.getSelectionElement(this.window),c.startContainer,this.document);if(d){for(var e=0;0===d.nodeValue.substr(e,1).trim().length;)e+=1;c=a.selection.select(this.document,d,e,c.endContainer,c.endOffset)}}},checkState:function(){if(!this.base.preventSelectionUpdates){if(!this.base.getFocusedElement()||a.selection.selectionInContentEditableFalse(this.window))return this.hideToolbar();var b=a.selection.getSelectionElement(this.window);return!b||-1===this.getEditorElements().indexOf(b)||b.getAttribute("data-disable-toolbar")?this.hideToolbar():this.updateOnEmptySelection&&this["static"]?this.showAndUpdateToolbar():!a.selection.selectionContainsContent(this.document)||this.allowMultiParagraphSelection===!1&&this.multipleBlockElementsSelected()?this.hideToolbar():void this.showAndUpdateToolbar()}},showAndUpdateToolbar:function(){this.modifySelection(),this.setToolbarButtonStates(),this.trigger("positionToolbar",{},this.base.getFocusedElement()),this.showToolbarDefaultActions(),this.setToolbarPosition()},setToolbarButtonStates:function(){this.forEachExtension(function(a){"function"==typeof a.isActive&&"function"==typeof a.setInactive&&a.setInactive()}),this.checkActiveButtons()},checkActiveButtons:function(){var b,c=[],d=null,e=a.selection.getSelectionRange(this.document),f=function(a){"function"==typeof a.checkState?a.checkState(b):"function"==typeof a.isActive&&"function"==typeof a.isAlreadyApplied&&"function"==typeof a.setActive&&!a.isActive()&&a.isAlreadyApplied(b)&&a.setActive()};if(e&&(this.forEachExtension(function(a){return"function"==typeof a.queryCommandState&&(d=a.queryCommandState(),null!==d)?void(d&&"function"==typeof a.setActive&&a.setActive()):void c.push(a)}),b=a.selection.getSelectedParentElement(e),this.getEditorElements().some(function(c){return a.util.isDescendant(c,b,!0)})))for(;b&&(c.forEach(f),!a.util.isMediumEditorElement(b));)b=b.parentNode},positionToolbarIfShown:function(){this.isDisplayed()&&this.setToolbarPosition()},setToolbarPosition:function(){var a=this.base.getFocusedElement(),b=this.window.getSelection();return a?void(!this["static"]&&b.isCollapsed||(this.showToolbar(),this.relativeContainer||(this["static"]?this.positionStaticToolbar(a):this.positionToolbar(b)),this.trigger("positionedToolbar",{},this.base.getFocusedElement()))):this},positionStaticToolbar:function(a){this.getToolbarElement().style.left="0";var b,c=this.document.documentElement&&this.document.documentElement.scrollTop||this.document.body.scrollTop,d=this.window.innerWidth,e=this.getToolbarElement(),f=a.getBoundingClientRect(),g=f.top+c,h=f.left+f.width/2,i=e.offsetHeight,j=e.offsetWidth,k=j/2;switch(this.sticky?c>g+a.offsetHeight-i-this.stickyTopOffset?(e.style.top=g+a.offsetHeight-i+"px",e.classList.remove("medium-editor-sticky-toolbar")):c>g-i-this.stickyTopOffset?(e.classList.add("medium-editor-sticky-toolbar"),e.style.top=this.stickyTopOffset+"px"):(e.classList.remove("medium-editor-sticky-toolbar"),e.style.top=g-i+"px"):e.style.top=g-i+"px",this.align){case"left":b=f.left;break;case"right":b=f.right-j;break;case"center":b=h-k}0>b?b=0:b+j>d&&(b=d-Math.ceil(j)-1),e.style.left=b+"px"},positionToolbar:function(a){this.getToolbarElement().style.left="0",this.getToolbarElement().style.right="initial";var b=a.getRangeAt(0),c=b.getBoundingClientRect();(!c||0===c.height&&0===c.width&&b.startContainer===b.endContainer)&&(c=1===b.startContainer.nodeType&&b.startContainer.querySelector("img")?b.startContainer.querySelector("img").getBoundingClientRect():b.startContainer.getBoundingClientRect());var d,e,f=this.window.innerWidth,g=this.getToolbarElement(),h=g.offsetHeight,i=g.offsetWidth,j=i/2,k=50,l=this.diffLeft-j,m=this.getEditorOption("elementsContainer"),n=["absolute","fixed"].indexOf(window.getComputedStyle(m).getPropertyValue("position"))>-1,o={},p={};n?(e=m.getBoundingClientRect(),["top","left"].forEach(function(a){p[a]=c[a]-e[a]}),p.width=c.width,p.height=c.height,c=p,f=e.width,o.top=m.scrollTop):o.top=this.window.pageYOffset,d=c.left+c.width/2,o.top+=c.top-h,c.top<k?(g.classList.add("medium-toolbar-arrow-over"),g.classList.remove("medium-toolbar-arrow-under"),o.top+=k+c.height-this.diffTop):(g.classList.add("medium-toolbar-arrow-under"),g.classList.remove("medium-toolbar-arrow-over"),o.top+=this.diffTop),j>d?(o.left=l+j,o.right="initial"):j>f-d?(o.left="auto",o.right=0):(o.left=l+d,o.right="initial"),["top","left","right"].forEach(function(a){g.style[a]=o[a]+(isNaN(o[a])?"":"px")})}});a.extensions.toolbar=b}(),function(){var b=a.Extension.extend({init:function(){a.Extension.prototype.init.apply(this,arguments),this.subscribe("editableDrag",this.handleDrag.bind(this)),this.subscribe("editableDrop",this.handleDrop.bind(this))},handleDrag:function(a){var b="medium-editor-dragover";a.preventDefault(),a.dataTransfer.dropEffect="copy","dragover"===a.type?a.target.classList.add(b):"dragleave"===a.type&&a.target.classList.remove(b)},handleDrop:function(b){var c,d="medium-editor-dragover";b.preventDefault(),b.stopPropagation(),b.dataTransfer.files&&(c=Array.prototype.slice.call(b.dataTransfer.files,0),c.some(function(b){if(b.type.match("image")){var c,d;c=new FileReader,c.readAsDataURL(b),d="medium-img-"+ +new Date,a.util.insertHTMLCommand(this.document,'<img class="medium-editor-image-loading" id="'+d+'" />'),c.onload=function(){var a=this.document.getElementById(d);a&&(a.removeAttribute("id"),a.removeAttribute("class"),a.src=c.result)}.bind(this)}}.bind(this))),b.target.classList.remove(d)}});a.extensions.imageDragging=b}(),function(){function b(b){var c=a.selection.getSelectionStart(this.options.ownerDocument),d=c.textContent,e=a.selection.getCaretOffsets(c);(void 0===d[e.left-1]||""===d[e.left-1].trim()||void 0!==d[e.left]&&""===d[e.left].trim())&&b.preventDefault()}function c(b,c){if(this.options.disableReturn||c.getAttribute("data-disable-return"))b.preventDefault();else if(this.options.disableDoubleReturn||c.getAttribute("data-disable-double-return")){var d=a.selection.getSelectionStart(this.options.ownerDocument);(d&&""===d.textContent.trim()&&"li"!==d.nodeName.toLowerCase()||d.previousElementSibling&&"br"!==d.previousElementSibling.nodeName.toLowerCase()&&""===d.previousElementSibling.textContent.trim())&&b.preventDefault()}}function d(b){var c=a.selection.getSelectionStart(this.options.ownerDocument),d=c&&c.nodeName.toLowerCase();"pre"===d&&(b.preventDefault(),a.util.insertHTMLCommand(this.options.ownerDocument,"    ")),a.util.isListItem(c)&&(b.preventDefault(),b.shiftKey?this.options.ownerDocument.execCommand("outdent",!1,null):this.options.ownerDocument.execCommand("indent",!1,null))}function e(b){var c,d=a.selection.getSelectionStart(this.options.ownerDocument),e=d.nodeName.toLowerCase(),f=/^(\s+|<br\/?>)?$/i,g=/h\d/i;a.util.isKey(b,[a.util.keyCode.BACKSPACE,a.util.keyCode.ENTER])&&d.previousElementSibling&&g.test(e)&&0===a.selection.getCaretOffsets(d).left?a.util.isKey(b,a.util.keyCode.BACKSPACE)&&f.test(d.previousElementSibling.innerHTML)?(d.previousElementSibling.parentNode.removeChild(d.previousElementSibling),b.preventDefault()):!this.options.disableDoubleReturn&&a.util.isKey(b,a.util.keyCode.ENTER)&&(c=this.options.ownerDocument.createElement("p"),c.innerHTML="<br>",d.previousElementSibling.parentNode.insertBefore(c,d),b.preventDefault()):a.util.isKey(b,a.util.keyCode.DELETE)&&d.nextElementSibling&&d.previousElementSibling&&!g.test(e)&&f.test(d.innerHTML)&&g.test(d.nextElementSibling.nodeName.toLowerCase())?(a.selection.moveCursor(this.options.ownerDocument,d.nextElementSibling),d.previousElementSibling.parentNode.removeChild(d),b.preventDefault()):a.util.isKey(b,a.util.keyCode.BACKSPACE)&&"li"===e&&f.test(d.innerHTML)&&!d.previousElementSibling&&!d.parentElement.previousElementSibling&&d.nextElementSibling&&"li"===d.nextElementSibling.nodeName.toLowerCase()?(c=this.options.ownerDocument.createElement("p"),c.innerHTML="<br>",d.parentElement.parentElement.insertBefore(c,d.parentElement),a.selection.moveCursor(this.options.ownerDocument,c),d.parentElement.removeChild(d),b.preventDefault()):a.util.isKey(b,a.util.keyCode.BACKSPACE)&&a.util.getClosestTag(d,"blockquote")!==!1&&0===a.selection.getCaretOffsets(d).left?(b.preventDefault(),a.util.execFormatBlock(this.options.ownerDocument,"p")):a.util.isKey(b,a.util.keyCode.ENTER)&&a.util.getClosestTag(d,"blockquote")!==!1&&0===a.selection.getCaretOffsets(d).right?(c=this.options.ownerDocument.createElement("p"),c.innerHTML="<br>",d.parentElement.insertBefore(c,d.nextSibling),a.selection.moveCursor(this.options.ownerDocument,c),b.preventDefault()):a.util.isKey(b,a.util.keyCode.BACKSPACE)&&a.util.isMediumEditorElement(d.parentElement)&&!d.previousElementSibling&&d.nextElementSibling&&f.test(d.innerHTML)&&(b.preventDefault(),a.selection.moveCursor(this.options.ownerDocument,d.nextSibling),d.parentElement.removeChild(d))}function f(b){var c,d=a.selection.getSelectionStart(this.options.ownerDocument);d&&(a.util.isMediumEditorElement(d)&&0===d.children.length&&!a.util.isBlockContainer(d)&&this.options.ownerDocument.execCommand("formatBlock",!1,"p"),!a.util.isKey(b,a.util.keyCode.ENTER)||a.util.isListItem(d)||a.util.isBlockContainer(d)||(c=d.nodeName.toLowerCase(),"a"===c?this.options.ownerDocument.execCommand("unlink",!1,null):b.shiftKey||b.ctrlKey||this.options.ownerDocument.execCommand("formatBlock",!1,"p")))}function g(a,b){var c=b.parentNode.querySelector('textarea[medium-editor-textarea-id="'+b.getAttribute("medium-editor-textarea-id")+'"]');c&&(c.value=b.innerHTML.trim())}function h(a){a._mediumEditors||(a._mediumEditors=[null]),this.id||(this.id=a._mediumEditors.length),a._mediumEditors[this.id]=this}function i(a){a._mediumEditors&&a._mediumEditors[this.id]&&(a._mediumEditors[this.id]=null)}function j(b,c,d){var e=[];if(b||(b=[]),"string"==typeof b&&(b=c.querySelectorAll(b)),a.util.isElement(b)&&(b=[b]),d)for(var f=0;f<b.length;f++){var g=b[f];!a.util.isElement(g)||g.getAttribute("data-medium-editor-element")||g.getAttribute("medium-editor-textarea-id")||e.push(g)}else e=Array.prototype.slice.apply(b);return e}function k(a){var b=a.parentNode.querySelector('textarea[medium-editor-textarea-id="'+a.getAttribute("medium-editor-textarea-id")+'"]');b&&(b.classList.remove("medium-editor-hidden"),b.removeAttribute("medium-editor-textarea-id")),a.parentNode&&a.parentNode.removeChild(a)}function l(a,b){return Object.keys(b).forEach(function(c){void 0===a[c]&&(a[c]=b[c])}),a}function m(a,b,c){var d={window:c.options.contentWindow,document:c.options.ownerDocument,base:c};return a=l(a,d),"function"==typeof a.init&&a.init(),a.name||(a.name=b),a}function n(){return this.elements.every(function(a){return!!a.getAttribute("data-disable-toolbar")})?!1:this.options.toolbar!==!1}function o(){return n.call(this)?this.options.anchorPreview!==!1:!1}function p(){return this.options.placeholder!==!1}function q(){return this.options.autoLink!==!1}function r(){return this.options.imageDragging!==!1}function s(){return this.options.keyboardCommands!==!1}function t(){return!this.options.extensions.imageDragging}function u(a){for(var b=this.options.ownerDocument.createElement("div"),c=Date.now(),d="medium-editor-"+c,e=a.attributes;this.options.ownerDocument.getElementById(d);)c++,d="medium-editor-"+c;b.className=a.className,b.id=d,b.innerHTML=a.value,a.setAttribute("medium-editor-textarea-id",d);for(var f=0,g=e.length;g>f;f++)b.hasAttribute(e[f].nodeName)||b.setAttribute(e[f].nodeName,e[f].value);return a.form&&this.on(a.form,"reset",function(a){a.defaultPrevented||this.resetContent(this.options.ownerDocument.getElementById(d))}.bind(this)),a.classList.add("medium-editor-hidden"),a.parentNode.insertBefore(b,a),b}function v(b,d){if(!b.getAttribute("data-medium-editor-element")){"textarea"===b.nodeName.toLowerCase()&&(b=u.call(this,b),this.instanceHandleEditableInput||(this.instanceHandleEditableInput=g.bind(this),this.subscribe("editableInput",this.instanceHandleEditableInput))),this.options.disableEditing||b.getAttribute("data-disable-editing")||(b.setAttribute("contentEditable",!0),b.setAttribute("spellcheck",this.options.spellcheck)),this.instanceHandleEditableKeydownEnter||(b.getAttribute("data-disable-return")||b.getAttribute("data-disable-double-return"))&&(this.instanceHandleEditableKeydownEnter=c.bind(this),this.subscribe("editableKeydownEnter",this.instanceHandleEditableKeydownEnter)),this.options.disableReturn||b.getAttribute("data-disable-return")||this.on(b,"keyup",f.bind(this));var e=a.util.guid();b.setAttribute("data-medium-editor-element",!0),b.classList.add("medium-editor-element"),b.setAttribute("role","textbox"),b.setAttribute("aria-multiline",!0),b.setAttribute("data-medium-editor-editor-index",d),b.setAttribute("medium-editor-index",e),B[e]=b.innerHTML,this.events.attachAllEventsToElement(b)}return b}function w(){this.subscribe("editableKeydownTab",d.bind(this)),this.subscribe("editableKeydownDelete",e.bind(this)),this.subscribe("editableKeydownEnter",e.bind(this)),this.options.disableExtraSpaces&&this.subscribe("editableKeydownSpace",b.bind(this)),this.instanceHandleEditableKeydownEnter||(this.options.disableReturn||this.options.disableDoubleReturn)&&(this.instanceHandleEditableKeydownEnter=c.bind(this),this.subscribe("editableKeydownEnter",this.instanceHandleEditableKeydownEnter))}function x(){if(this.extensions=[],Object.keys(this.options.extensions).forEach(function(a){"toolbar"!==a&&this.options.extensions[a]&&this.extensions.push(m(this.options.extensions[a],a,this))},this),t.call(this)){var b=this.options.fileDragging;b||(b={},r.call(this)||(b.allowedTypes=[])),this.addBuiltInExtension("fileDragging",b)}var c={paste:!0,"anchor-preview":o.call(this),autoLink:q.call(this),keyboardCommands:s.call(this),placeholder:p.call(this)};Object.keys(c).forEach(function(a){c[a]&&this.addBuiltInExtension(a)},this);var d=this.options.extensions.toolbar;if(!d&&n.call(this)){var e=a.util.extend({},this.options.toolbar,{allowMultiParagraphSelection:this.options.allowMultiParagraphSelection});d=new a.extensions.toolbar(e)}d&&this.extensions.push(m(d,"toolbar",this))}function y(b,c){var d=[["allowMultiParagraphSelection","toolbar.allowMultiParagraphSelection"]];return c&&d.forEach(function(b){c.hasOwnProperty(b[0])&&void 0!==c[b[0]]&&a.util.deprecated(b[0],b[1],"v6.0.0")}),a.util.defaults({},c,b)}function z(b,c){var d,e,f=/^append-(.+)$/gi,g=/justify([A-Za-z]*)$/g;if(d=f.exec(b))return a.util.execFormatBlock(this.options.ownerDocument,d[1]);if("fontSize"===b)return c.size&&a.util.deprecated(".size option for fontSize command",".value","6.0.0"),e=c.value||c.size,this.options.ownerDocument.execCommand("fontSize",!1,e);if("fontName"===b)return c.name&&a.util.deprecated(".name option for fontName command",".value","6.0.0"),e=c.value||c.name,this.options.ownerDocument.execCommand("fontName",!1,e);if("createLink"===b)return this.createLink(c);if("image"===b){var h=this.options.contentWindow.getSelection().toString().trim();return this.options.ownerDocument.execCommand("insertImage",!1,h)}if("html"===b){var i=this.options.contentWindow.getSelection().toString().trim();return a.util.insertHTMLCommand(this.options.ownerDocument,i)}if(g.exec(b)){var j=this.options.ownerDocument.execCommand(b,!1,null),k=a.selection.getSelectedParentElement(a.selection.getSelectionRange(this.options.ownerDocument));return k&&A.call(this,a.util.getTopBlockContainer(k)),j}return e=c&&c.value,this.options.ownerDocument.execCommand(b,!1,e)}function A(b){if(b){var c,d=Array.prototype.slice.call(b.childNodes).filter(function(a){var b="div"===a.nodeName.toLowerCase();return b&&!c&&(c=a.style.textAlign),b});d.length&&(this.saveSelection(),d.forEach(function(b){if(b.style.textAlign===c){var d=b.lastChild;if(d){a.util.unwrap(b,this.options.ownerDocument);var e=this.options.ownerDocument.createElement("BR");d.parentNode.insertBefore(e,d.nextSibling)}}},this),b.style.textAlign=c,this.restoreSelection())}}var B={};a.prototype={init:function(a,b){return this.options=y.call(this,this.defaults,b),this.origElements=a,this.options.elementsContainer||(this.options.elementsContainer=this.options.ownerDocument.body),this.setup()},setup:function(){this.isActive||(h.call(this,this.options.contentWindow),this.events=new a.Events(this),this.elements=[],this.addElements(this.origElements),0!==this.elements.length&&(this.isActive=!0,x.call(this),w.call(this)));
},destroy:function(){this.isActive&&(this.isActive=!1,this.extensions.forEach(function(a){"function"==typeof a.destroy&&a.destroy()},this),this.events.destroy(),this.elements.forEach(function(a){this.options.spellcheck&&(a.innerHTML=a.innerHTML),a.removeAttribute("contentEditable"),a.removeAttribute("spellcheck"),a.removeAttribute("data-medium-editor-element"),a.classList.remove("medium-editor-element"),a.removeAttribute("role"),a.removeAttribute("aria-multiline"),a.removeAttribute("medium-editor-index"),a.removeAttribute("data-medium-editor-editor-index"),a.getAttribute("medium-editor-textarea-id")&&k(a)},this),this.elements=[],this.instanceHandleEditableKeydownEnter=null,this.instanceHandleEditableInput=null,i.call(this,this.options.contentWindow))},on:function(a,b,c,d){return this.events.attachDOMEvent(a,b,c,d),this},off:function(a,b,c,d){return this.events.detachDOMEvent(a,b,c,d),this},subscribe:function(a,b){return this.events.attachCustomEvent(a,b),this},unsubscribe:function(a,b){return this.events.detachCustomEvent(a,b),this},trigger:function(a,b,c){return this.events.triggerCustomEvent(a,b,c),this},delay:function(a){var b=this;return setTimeout(function(){b.isActive&&a()},this.options.delay)},serialize:function(){var a,b,c={},d=this.elements.length;for(a=0;d>a;a+=1)b=""!==this.elements[a].id?this.elements[a].id:"element-"+a,c[b]={value:this.elements[a].innerHTML.trim()};return c},getExtensionByName:function(a){var b;return this.extensions&&this.extensions.length&&this.extensions.some(function(c){return c.name===a?(b=c,!0):!1}),b},addBuiltInExtension:function(b,c){var d,e=this.getExtensionByName(b);if(e)return e;switch(b){case"anchor":d=a.util.extend({},this.options.anchor,c),e=new a.extensions.anchor(d);break;case"anchor-preview":e=new a.extensions.anchorPreview(this.options.anchorPreview);break;case"autoLink":e=new a.extensions.autoLink;break;case"fileDragging":e=new a.extensions.fileDragging(c);break;case"fontname":e=new a.extensions.fontName(this.options.fontName);break;case"fontsize":e=new a.extensions.fontSize(c);break;case"keyboardCommands":e=new a.extensions.keyboardCommands(this.options.keyboardCommands);break;case"paste":e=new a.extensions.paste(this.options.paste);break;case"placeholder":e=new a.extensions.placeholder(this.options.placeholder);break;default:a.extensions.button.isBuiltInButton(b)&&(c?(d=a.util.defaults({},c,a.extensions.button.prototype.defaults[b]),e=new a.extensions.button(d)):e=new a.extensions.button(b))}return e&&this.extensions.push(m(e,b,this)),e},stopSelectionUpdates:function(){this.preventSelectionUpdates=!0},startSelectionUpdates:function(){this.preventSelectionUpdates=!1},checkSelection:function(){var a=this.getExtensionByName("toolbar");return a&&a.checkState(),this},queryCommandState:function(a){var b,c=/^full-(.+)$/gi,d=null;b=c.exec(a),b&&(a=b[1]);try{d=this.options.ownerDocument.queryCommandState(a)}catch(e){d=null}return d},execAction:function(b,c){var d,e,f=/^full-(.+)$/gi;return d=f.exec(b),d?(this.saveSelection(),this.selectAllContents(),e=z.call(this,d[1],c),this.restoreSelection()):e=z.call(this,b,c),"insertunorderedlist"!==b&&"insertorderedlist"!==b||a.util.cleanListDOM(this.options.ownerDocument,this.getSelectedParentElement()),this.checkSelection(),e},getSelectedParentElement:function(b){return void 0===b&&(b=this.options.contentWindow.getSelection().getRangeAt(0)),a.selection.getSelectedParentElement(b)},selectAllContents:function(){var b=a.selection.getSelectionElement(this.options.contentWindow);if(b){for(;1===b.children.length;)b=b.children[0];this.selectElement(b)}},selectElement:function(b){a.selection.selectNode(b,this.options.ownerDocument);var c=a.selection.getSelectionElement(this.options.contentWindow);c&&this.events.focusElement(c)},getFocusedElement:function(){var a;return this.elements.some(function(b){return!a&&b.getAttribute("data-medium-focused")&&(a=b),!!a},this),a},exportSelection:function(){var b=a.selection.getSelectionElement(this.options.contentWindow),c=this.elements.indexOf(b),d=null;return c>=0&&(d=a.selection.exportSelection(b,this.options.ownerDocument)),null!==d&&0!==c&&(d.editableElementIndex=c),d},saveSelection:function(){this.selectionState=this.exportSelection()},importSelection:function(b,c){if(b){var d=this.elements[b.editableElementIndex||0];a.selection.importSelection(b,d,this.options.ownerDocument,c)}},restoreSelection:function(){this.importSelection(this.selectionState)},createLink:function(b){var c,d=a.selection.getSelectionElement(this.options.contentWindow),e={};if(-1!==this.elements.indexOf(d)){try{if(this.events.disableCustomEvent("editableInput"),b.url&&a.util.deprecated(".url option for createLink",".value","6.0.0"),c=b.url||b.value,c&&c.trim().length>0){var f=this.options.contentWindow.getSelection();if(f){var g,h,i,j,k=f.getRangeAt(0),l=k.commonAncestorContainer;if(3===k.endContainer.nodeType&&3!==k.startContainer.nodeType&&0===k.startOffset&&k.startContainer.firstChild===k.endContainer&&(l=k.endContainer),h=a.util.getClosestBlockContainer(k.startContainer),i=a.util.getClosestBlockContainer(k.endContainer),3!==l.nodeType&&0!==l.textContent.length&&h===i){var m=h||d,n=this.options.ownerDocument.createDocumentFragment();this.execAction("unlink"),g=this.exportSelection(),n.appendChild(m.cloneNode(!0)),d===m?a.selection.select(this.options.ownerDocument,m.firstChild,0,m.lastChild,3===m.lastChild.nodeType?m.lastChild.nodeValue.length:m.lastChild.childNodes.length):a.selection.select(this.options.ownerDocument,m,0,m,m.childNodes.length);var o=this.exportSelection();j=a.util.findOrCreateMatchingTextNodes(this.options.ownerDocument,n,{start:g.start-o.start,end:g.end-o.start,editableElementIndex:g.editableElementIndex}),0===j.length&&(n=this.options.ownerDocument.createDocumentFragment(),n.appendChild(l.cloneNode(!0)),j=[n.firstChild.firstChild,n.firstChild.lastChild]),a.util.createLink(this.options.ownerDocument,j,c.trim());var p=(n.firstChild.innerHTML.match(/^\s+/)||[""])[0].length;a.util.insertHTMLCommand(this.options.ownerDocument,n.firstChild.innerHTML.replace(/^\s+/,"")),g.start-=p,g.end-=p,this.importSelection(g)}else this.options.ownerDocument.execCommand("createLink",!1,c);this.options.targetBlank||"_blank"===b.target?a.util.setTargetBlank(a.selection.getSelectionStart(this.options.ownerDocument),c):a.util.removeTargetBlank(a.selection.getSelectionStart(this.options.ownerDocument),c),b.buttonClass&&a.util.addClassToAnchors(a.selection.getSelectionStart(this.options.ownerDocument),b.buttonClass)}}if(this.options.targetBlank||"_blank"===b.target||b.buttonClass){e=this.options.ownerDocument.createEvent("HTMLEvents"),e.initEvent("input",!0,!0,this.options.contentWindow);for(var q=0,r=this.elements.length;r>q;q+=1)this.elements[q].dispatchEvent(e)}}finally{this.events.enableCustomEvent("editableInput")}this.events.triggerCustomEvent("editableInput",e,d)}},cleanPaste:function(a){this.getExtensionByName("paste").cleanPaste(a)},pasteHTML:function(a,b){this.getExtensionByName("paste").pasteHTML(a,b)},setContent:function(a,b){if(b=b||0,this.elements[b]){var c=this.elements[b];c.innerHTML=a,this.checkContentChanged(c)}},getContent:function(a){return a=a||0,this.elements[a]?this.elements[a].innerHTML.trim():null},checkContentChanged:function(b){b=b||a.selection.getSelectionElement(this.options.contentWindow),this.events.updateInput(b,{target:b,currentTarget:b})},resetContent:function(a){if(a){var b=this.elements.indexOf(a);return void(-1!==b&&this.setContent(B[a.getAttribute("medium-editor-index")],b))}this.elements.forEach(function(a,b){this.setContent(B[a.getAttribute("medium-editor-index")],b)},this)},addElements:function(a){var b=j(a,this.options.ownerDocument,!0);return 0===b.length?!1:void b.forEach(function(a){a=v.call(this,a,this.id),this.elements.push(a),this.trigger("addElement",{target:a,currentTarget:a},a)},this)},removeElements:function(a){var b=j(a,this.options.ownerDocument),c=b.map(function(a){return a.getAttribute("medium-editor-textarea-id")&&a.parentNode?a.parentNode.querySelector('div[medium-editor-textarea-id="'+a.getAttribute("medium-editor-textarea-id")+'"]'):a});this.elements=this.elements.filter(function(a){return-1!==c.indexOf(a)?(this.events.cleanupElement(a),a.getAttribute("medium-editor-textarea-id")&&k(a),this.trigger("removeElement",{target:a,currentTarget:a},a),!1):!0},this)}},a.getEditorFromElement=function(a){var b=a.getAttribute("data-medium-editor-editor-index"),c=a&&a.ownerDocument&&(a.ownerDocument.defaultView||a.ownerDocument.parentWindow);return c&&c._mediumEditors&&c._mediumEditors[b]?c._mediumEditors[b]:null}}(),function(){a.prototype.defaults={activeButtonClass:"medium-editor-button-active",buttonLabels:!1,delay:0,disableReturn:!1,disableDoubleReturn:!1,disableExtraSpaces:!1,disableEditing:!1,autoLink:!1,elementsContainer:!1,contentWindow:window,ownerDocument:document,targetBlank:!1,extensions:{},spellcheck:!0}}(),a.parseVersionString=function(a){var b=a.split("-"),c=b[0].split("."),d=b.length>1?b[1]:"";return{major:parseInt(c[0],10),minor:parseInt(c[1],10),revision:parseInt(c[2],10),preRelease:d,toString:function(){return[c[0],c[1],c[2]].join(".")+(d?"-"+d:"")}}},a.version=a.parseVersionString.call(this,{version:"5.23.3"}.version),a}());
/*! Sortable 1.7.0 - MIT | git://github.com/rubaxa/Sortable.git */
!function(a){"use strict";"function"==typeof define&&define.amd?define(a):"undefined"!=typeof module&&"undefined"!=typeof module.exports?module.exports=a():window.Sortable=a()}(function(){"use strict";function a(b,c){if(!b||!b.nodeType||1!==b.nodeType)throw"Sortable: `el` must be HTMLElement, and not "+{}.toString.call(b);this.el=b,this.options=c=t({},c),b[V]=this;var d={group:Math.random(),sort:!0,disabled:!1,store:null,handle:null,scroll:!0,scrollSensitivity:30,scrollSpeed:10,draggable:/[uo]l/i.test(b.nodeName)?"li":">*",ghostClass:"sortable-ghost",chosenClass:"sortable-chosen",dragClass:"sortable-drag",ignore:"a, img",filter:null,preventOnFilter:!0,animation:0,setData:function(a,b){a.setData("Text",b.textContent)},dropBubble:!1,dragoverBubble:!1,dataIdAttr:"data-id",delay:0,forceFallback:!1,fallbackClass:"sortable-fallback",fallbackOnBody:!1,fallbackTolerance:0,fallbackOffset:{x:0,y:0},supportPointer:a.supportPointer!==!1};for(var e in d)!(e in c)&&(c[e]=d[e]);ka(c);for(var g in this)"_"===g.charAt(0)&&"function"==typeof this[g]&&(this[g]=this[g].bind(this));this.nativeDraggable=!c.forceFallback&&ca,f(b,"mousedown",this._onTapStart),f(b,"touchstart",this._onTapStart),c.supportPointer&&f(b,"pointerdown",this._onTapStart),this.nativeDraggable&&(f(b,"dragover",this),f(b,"dragenter",this)),ia.push(this._onDragOver),c.store&&this.sort(c.store.get(this))}function b(a,b){"clone"!==a.lastPullMode&&(b=!0),B&&B.state!==b&&(i(B,"display",b?"none":""),b||B.state&&(a.options.group.revertClone?(C.insertBefore(B,D),a._animate(y,B)):C.insertBefore(B,y)),B.state=b)}function c(a,b,c){if(a){c=c||X;do if(">*"===b&&a.parentNode===c||r(a,b))return a;while(a=d(a))}return null}function d(a){var b=a.host;return b&&b.nodeType?b:a.parentNode}function e(a){a.dataTransfer&&(a.dataTransfer.dropEffect="move"),a.preventDefault()}function f(a,b,c){a.addEventListener(b,c,aa)}function g(a,b,c){a.removeEventListener(b,c,aa)}function h(a,b,c){if(a)if(a.classList)a.classList[c?"add":"remove"](b);else{var d=(" "+a.className+" ").replace(T," ").replace(" "+b+" "," ");a.className=(d+(c?" "+b:"")).replace(T," ")}}function i(a,b,c){var d=a&&a.style;if(d){if(void 0===c)return X.defaultView&&X.defaultView.getComputedStyle?c=X.defaultView.getComputedStyle(a,""):a.currentStyle&&(c=a.currentStyle),void 0===b?c:c[b];b in d||(b="-webkit-"+b),d[b]=c+("string"==typeof c?"":"px")}}function j(a,b,c){if(a){var d=a.getElementsByTagName(b),e=0,f=d.length;if(c)for(;e<f;e++)c(d[e],e);return d}return[]}function k(a,b,c,d,e,f,g,h){a=a||b[V];var i=X.createEvent("Event"),j=a.options,k="on"+c.charAt(0).toUpperCase()+c.substr(1);i.initEvent(c,!0,!0),i.to=e||b,i.from=f||b,i.item=d||b,i.clone=B,i.oldIndex=g,i.newIndex=h,b.dispatchEvent(i),j[k]&&j[k].call(a,i)}function l(a,b,c,d,e,f,g,h){var i,j,k=a[V],l=k.options.onMove;return i=X.createEvent("Event"),i.initEvent("move",!0,!0),i.to=b,i.from=a,i.dragged=c,i.draggedRect=d,i.related=e||b,i.relatedRect=f||b.getBoundingClientRect(),i.willInsertAfter=h,a.dispatchEvent(i),l&&(j=l.call(k,i,g)),j}function m(a){a.draggable=!1}function n(){ea=!1}function o(a,b){var c=a.lastElementChild,d=c.getBoundingClientRect();return b.clientY-(d.top+d.height)>5||b.clientX-(d.left+d.width)>5}function p(a){for(var b=a.tagName+a.className+a.src+a.href+a.textContent,c=b.length,d=0;c--;)d+=b.charCodeAt(c);return d.toString(36)}function q(a,b){var c=0;if(!a||!a.parentNode)return-1;for(;a&&(a=a.previousElementSibling);)"TEMPLATE"===a.nodeName.toUpperCase()||">*"!==b&&!r(a,b)||c++;return c}function r(a,b){if(a){b=b.split(".");var c=b.shift().toUpperCase(),d=new RegExp("\\s("+b.join("|")+")(?=\\s)","g");return!(""!==c&&a.nodeName.toUpperCase()!=c||b.length&&((" "+a.className+" ").match(d)||[]).length!=b.length)}return!1}function s(a,b){var c,d;return function(){void 0===c&&(c=arguments,d=this,Z(function(){1===c.length?a.call(d,c[0]):a.apply(d,c),c=void 0},b))}}function t(a,b){if(a&&b)for(var c in b)b.hasOwnProperty(c)&&(a[c]=b[c]);return a}function u(a){return _&&_.dom?_.dom(a).cloneNode(!0):$?$(a).clone(!0)[0]:a.cloneNode(!0)}function v(a){for(var b=a.getElementsByTagName("input"),c=b.length;c--;){var d=b[c];d.checked&&ha.push(d)}}function w(a){return Z(a,0)}function x(a){return clearTimeout(a)}if("undefined"==typeof window||!window.document)return function(){throw new Error("Sortable.js requires a window with a document")};var y,z,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S={},T=/\s+/g,U=/left|right|inline/,V="Sortable"+(new Date).getTime(),W=window,X=W.document,Y=W.parseInt,Z=W.setTimeout,$=W.jQuery||W.Zepto,_=W.Polymer,aa=!1,ba=!1,ca="draggable"in X.createElement("div"),da=function(a){return!navigator.userAgent.match(/(?:Trident.*rv[ :]?11\.|msie)/i)&&(a=X.createElement("x"),a.style.cssText="pointer-events:auto","auto"===a.style.pointerEvents)}(),ea=!1,fa=Math.abs,ga=Math.min,ha=[],ia=[],ja=s(function(a,b,c){if(c&&b.scroll){var d,e,f,g,h,i,j=c[V],k=b.scrollSensitivity,l=b.scrollSpeed,m=a.clientX,n=a.clientY,o=window.innerWidth,p=window.innerHeight;if(G!==c&&(F=b.scroll,G=c,H=b.scrollFn,F===!0)){F=c;do if(F.offsetWidth<F.scrollWidth||F.offsetHeight<F.scrollHeight)break;while(F=F.parentNode)}F&&(d=F,e=F.getBoundingClientRect(),f=(fa(e.right-m)<=k)-(fa(e.left-m)<=k),g=(fa(e.bottom-n)<=k)-(fa(e.top-n)<=k)),f||g||(f=(o-m<=k)-(m<=k),g=(p-n<=k)-(n<=k),(f||g)&&(d=W)),S.vx===f&&S.vy===g&&S.el===d||(S.el=d,S.vx=f,S.vy=g,clearInterval(S.pid),d&&(S.pid=setInterval(function(){return i=g?g*l:0,h=f?f*l:0,"function"==typeof H?H.call(j,h,i,a):void(d===W?W.scrollTo(W.pageXOffset+h,W.pageYOffset+i):(d.scrollTop+=i,d.scrollLeft+=h))},24)))}},30),ka=function(a){function b(a,b){return void 0!==a&&a!==!0||(a=c.name),"function"==typeof a?a:function(c,d){var e=d.options.group.name;return b?a:a&&(a.join?a.indexOf(e)>-1:e==a)}}var c={},d=a.group;d&&"object"==typeof d||(d={name:d}),c.name=d.name,c.checkPull=b(d.pull,!0),c.checkPut=b(d.put),c.revertClone=d.revertClone,a.group=c};try{window.addEventListener("test",null,Object.defineProperty({},"passive",{get:function(){ba=!1,aa={capture:!1,passive:ba}}}))}catch(a){}return a.prototype={constructor:a,_onTapStart:function(a){var b,d=this,e=this.el,f=this.options,g=f.preventOnFilter,h=a.type,i=a.touches&&a.touches[0],j=(i||a).target,l=a.target.shadowRoot&&a.path&&a.path[0]||j,m=f.filter;if(v(e),!y&&!(/mousedown|pointerdown/.test(h)&&0!==a.button||f.disabled)&&!l.isContentEditable&&(j=c(j,f.draggable,e),j&&E!==j)){if(b=q(j,f.draggable),"function"==typeof m){if(m.call(this,a,j,this))return k(d,l,"filter",j,e,e,b),void(g&&a.preventDefault())}else if(m&&(m=m.split(",").some(function(a){if(a=c(l,a.trim(),e))return k(d,a,"filter",j,e,e,b),!0})))return void(g&&a.preventDefault());f.handle&&!c(l,f.handle,e)||this._prepareDragStart(a,i,j,b)}},_prepareDragStart:function(a,b,c,d){var e,g=this,i=g.el,l=g.options,n=i.ownerDocument;c&&!y&&c.parentNode===i&&(P=a,C=i,y=c,z=y.parentNode,D=y.nextSibling,E=c,N=l.group,L=d,this._lastX=(b||a).clientX,this._lastY=(b||a).clientY,y.style["will-change"]="all",e=function(){g._disableDelayedDrag(),y.draggable=g.nativeDraggable,h(y,l.chosenClass,!0),g._triggerDragStart(a,b),k(g,C,"choose",y,C,C,L)},l.ignore.split(",").forEach(function(a){j(y,a.trim(),m)}),f(n,"mouseup",g._onDrop),f(n,"touchend",g._onDrop),f(n,"touchcancel",g._onDrop),f(n,"selectstart",g),l.supportPointer&&f(n,"pointercancel",g._onDrop),l.delay?(f(n,"mouseup",g._disableDelayedDrag),f(n,"touchend",g._disableDelayedDrag),f(n,"touchcancel",g._disableDelayedDrag),f(n,"mousemove",g._disableDelayedDrag),f(n,"touchmove",g._disableDelayedDrag),l.supportPointer&&f(n,"pointermove",g._disableDelayedDrag),g._dragStartTimer=Z(e,l.delay)):e())},_disableDelayedDrag:function(){var a=this.el.ownerDocument;clearTimeout(this._dragStartTimer),g(a,"mouseup",this._disableDelayedDrag),g(a,"touchend",this._disableDelayedDrag),g(a,"touchcancel",this._disableDelayedDrag),g(a,"mousemove",this._disableDelayedDrag),g(a,"touchmove",this._disableDelayedDrag),g(a,"pointermove",this._disableDelayedDrag)},_triggerDragStart:function(a,b){b=b||("touch"==a.pointerType?a:null),b?(P={target:y,clientX:b.clientX,clientY:b.clientY},this._onDragStart(P,"touch")):this.nativeDraggable?(f(y,"dragend",this),f(C,"dragstart",this._onDragStart)):this._onDragStart(P,!0);try{X.selection?w(function(){X.selection.empty()}):window.getSelection().removeAllRanges()}catch(a){}},_dragStarted:function(){if(C&&y){var b=this.options;h(y,b.ghostClass,!0),h(y,b.dragClass,!1),a.active=this,k(this,C,"start",y,C,C,L)}else this._nulling()},_emulateDragOver:function(){if(Q){if(this._lastX===Q.clientX&&this._lastY===Q.clientY)return;this._lastX=Q.clientX,this._lastY=Q.clientY,da||i(A,"display","none");var a=X.elementFromPoint(Q.clientX,Q.clientY),b=a,c=ia.length;if(a&&a.shadowRoot&&(a=a.shadowRoot.elementFromPoint(Q.clientX,Q.clientY),b=a),b)do{if(b[V]){for(;c--;)ia[c]({clientX:Q.clientX,clientY:Q.clientY,target:a,rootEl:b});break}a=b}while(b=b.parentNode);da||i(A,"display","")}},_onTouchMove:function(b){if(P){var c=this.options,d=c.fallbackTolerance,e=c.fallbackOffset,f=b.touches?b.touches[0]:b,g=f.clientX-P.clientX+e.x,h=f.clientY-P.clientY+e.y,j=b.touches?"translate3d("+g+"px,"+h+"px,0)":"translate("+g+"px,"+h+"px)";if(!a.active){if(d&&ga(fa(f.clientX-this._lastX),fa(f.clientY-this._lastY))<d)return;this._dragStarted()}this._appendGhost(),R=!0,Q=f,i(A,"webkitTransform",j),i(A,"mozTransform",j),i(A,"msTransform",j),i(A,"transform",j),b.preventDefault()}},_appendGhost:function(){if(!A){var a,b=y.getBoundingClientRect(),c=i(y),d=this.options;A=y.cloneNode(!0),h(A,d.ghostClass,!1),h(A,d.fallbackClass,!0),h(A,d.dragClass,!0),i(A,"top",b.top-Y(c.marginTop,10)),i(A,"left",b.left-Y(c.marginLeft,10)),i(A,"width",b.width),i(A,"height",b.height),i(A,"opacity","0.8"),i(A,"position","fixed"),i(A,"zIndex","100000"),i(A,"pointerEvents","none"),d.fallbackOnBody&&X.body.appendChild(A)||C.appendChild(A),a=A.getBoundingClientRect(),i(A,"width",2*b.width-a.width),i(A,"height",2*b.height-a.height)}},_onDragStart:function(a,b){var c=this,d=a.dataTransfer,e=c.options;c._offUpEvents(),N.checkPull(c,c,y,a)&&(B=u(y),B.draggable=!1,B.style["will-change"]="",i(B,"display","none"),h(B,c.options.chosenClass,!1),c._cloneId=w(function(){C.insertBefore(B,y),k(c,C,"clone",y)})),h(y,e.dragClass,!0),b?("touch"===b?(f(X,"touchmove",c._onTouchMove),f(X,"touchend",c._onDrop),f(X,"touchcancel",c._onDrop),e.supportPointer&&(f(X,"pointermove",c._onTouchMove),f(X,"pointerup",c._onDrop))):(f(X,"mousemove",c._onTouchMove),f(X,"mouseup",c._onDrop)),c._loopId=setInterval(c._emulateDragOver,50)):(d&&(d.effectAllowed="move",e.setData&&e.setData.call(c,d,y)),f(X,"drop",c),c._dragStartId=w(c._dragStarted))},_onDragOver:function(d){var e,f,g,h,j=this.el,k=this.options,m=k.group,p=a.active,q=N===m,r=!1,s=k.sort;if(void 0!==d.preventDefault&&(d.preventDefault(),!k.dragoverBubble&&d.stopPropagation()),!y.animated&&(R=!0,p&&!k.disabled&&(q?s||(h=!C.contains(y)):O===this||(p.lastPullMode=N.checkPull(this,p,y,d))&&m.checkPut(this,p,y,d))&&(void 0===d.rootEl||d.rootEl===this.el))){if(ja(d,k,this.el),ea)return;if(e=c(d.target,k.draggable,j),f=y.getBoundingClientRect(),O!==this&&(O=this,r=!0),h)return b(p,!0),z=C,void(B||D?C.insertBefore(y,B||D):s||C.appendChild(y));if(0===j.children.length||j.children[0]===A||j===d.target&&o(j,d)){if(0!==j.children.length&&j.children[0]!==A&&j===d.target&&(e=j.lastElementChild),e){if(e.animated)return;g=e.getBoundingClientRect()}b(p,q),l(C,j,y,f,e,g,d)!==!1&&(y.contains(j)||(j.appendChild(y),z=j),this._animate(f,y),e&&this._animate(g,e))}else if(e&&!e.animated&&e!==y&&void 0!==e.parentNode[V]){I!==e&&(I=e,J=i(e),K=i(e.parentNode)),g=e.getBoundingClientRect();var t=g.right-g.left,u=g.bottom-g.top,v=U.test(J.cssFloat+J.display)||"flex"==K.display&&0===K["flex-direction"].indexOf("row"),w=e.offsetWidth>y.offsetWidth,x=e.offsetHeight>y.offsetHeight,E=(v?(d.clientX-g.left)/t:(d.clientY-g.top)/u)>.5,F=e.nextElementSibling,G=!1;if(v){var H=y.offsetTop,L=e.offsetTop;G=H===L?e.previousElementSibling===y&&!w||E&&w:e.previousElementSibling===y||y.previousElementSibling===e?(d.clientY-g.top)/u>.5:L>H}else r||(G=F!==y&&!x||E&&x);var M=l(C,j,y,f,e,g,d,G);M!==!1&&(1!==M&&M!==-1||(G=1===M),ea=!0,Z(n,30),b(p,q),y.contains(j)||(G&&!F?j.appendChild(y):e.parentNode.insertBefore(y,G?F:e)),z=y.parentNode,this._animate(f,y),this._animate(g,e))}}},_animate:function(a,b){var c=this.options.animation;if(c){var d=b.getBoundingClientRect();1===a.nodeType&&(a=a.getBoundingClientRect()),i(b,"transition","none"),i(b,"transform","translate3d("+(a.left-d.left)+"px,"+(a.top-d.top)+"px,0)"),b.offsetWidth,i(b,"transition","all "+c+"ms"),i(b,"transform","translate3d(0,0,0)"),clearTimeout(b.animated),b.animated=Z(function(){i(b,"transition",""),i(b,"transform",""),b.animated=!1},c)}},_offUpEvents:function(){var a=this.el.ownerDocument;g(X,"touchmove",this._onTouchMove),g(X,"pointermove",this._onTouchMove),g(a,"mouseup",this._onDrop),g(a,"touchend",this._onDrop),g(a,"pointerup",this._onDrop),g(a,"touchcancel",this._onDrop),g(a,"pointercancel",this._onDrop),g(a,"selectstart",this)},_onDrop:function(b){var c=this.el,d=this.options;clearInterval(this._loopId),clearInterval(S.pid),clearTimeout(this._dragStartTimer),x(this._cloneId),x(this._dragStartId),g(X,"mouseover",this),g(X,"mousemove",this._onTouchMove),this.nativeDraggable&&(g(X,"drop",this),g(c,"dragstart",this._onDragStart)),this._offUpEvents(),b&&(R&&(b.preventDefault(),!d.dropBubble&&b.stopPropagation()),A&&A.parentNode&&A.parentNode.removeChild(A),C!==z&&"clone"===a.active.lastPullMode||B&&B.parentNode&&B.parentNode.removeChild(B),y&&(this.nativeDraggable&&g(y,"dragend",this),m(y),y.style["will-change"]="",h(y,this.options.ghostClass,!1),h(y,this.options.chosenClass,!1),k(this,C,"unchoose",y,z,C,L),C!==z?(M=q(y,d.draggable),M>=0&&(k(null,z,"add",y,z,C,L,M),k(this,C,"remove",y,z,C,L,M),k(null,z,"sort",y,z,C,L,M),k(this,C,"sort",y,z,C,L,M))):y.nextSibling!==D&&(M=q(y,d.draggable),M>=0&&(k(this,C,"update",y,z,C,L,M),k(this,C,"sort",y,z,C,L,M))),a.active&&(null!=M&&M!==-1||(M=L),k(this,C,"end",y,z,C,L,M),this.save()))),this._nulling()},_nulling:function(){C=y=z=A=D=B=E=F=G=P=Q=R=M=I=J=O=N=a.active=null,ha.forEach(function(a){a.checked=!0}),ha.length=0},handleEvent:function(a){switch(a.type){case"drop":case"dragend":this._onDrop(a);break;case"dragover":case"dragenter":y&&(this._onDragOver(a),e(a));break;case"mouseover":this._onDrop(a);break;case"selectstart":a.preventDefault()}},toArray:function(){for(var a,b=[],d=this.el.children,e=0,f=d.length,g=this.options;e<f;e++)a=d[e],c(a,g.draggable,this.el)&&b.push(a.getAttribute(g.dataIdAttr)||p(a));return b},sort:function(a){var b={},d=this.el;this.toArray().forEach(function(a,e){var f=d.children[e];c(f,this.options.draggable,d)&&(b[a]=f)},this),a.forEach(function(a){b[a]&&(d.removeChild(b[a]),d.appendChild(b[a]))})},save:function(){var a=this.options.store;a&&a.set(this)},closest:function(a,b){return c(a,b||this.options.draggable,this.el)},option:function(a,b){var c=this.options;return void 0===b?c[a]:(c[a]=b,void("group"===a&&ka(c)))},destroy:function(){var a=this.el;a[V]=null,g(a,"mousedown",this._onTapStart),g(a,"touchstart",this._onTapStart),g(a,"pointerdown",this._onTapStart),this.nativeDraggable&&(g(a,"dragover",this),g(a,"dragenter",this)),Array.prototype.forEach.call(a.querySelectorAll("[draggable]"),function(a){a.removeAttribute("draggable")}),ia.splice(ia.indexOf(this._onDragOver),1),this._onDrop(),this.el=a=null}},f(X,"touchmove",function(b){a.active&&b.preventDefault()}),a.utils={on:f,off:g,css:i,find:j,is:function(a,b){return!!c(a,b,a)},extend:t,throttle:s,closest:c,toggleClass:h,clone:u,index:q,nextTick:w,cancelNextTick:x},a.create=function(b,c){return new a(b,c)},a.version="1.7.0",a});
var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _toConsumableArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var GridHelper = function () {
    function GridHelper() {
        _classCallCheck(this, GridHelper);
    }

    _createClass(GridHelper, null, [{
        key: 'arrayToSortPattern',
        value: function arrayToSortPattern(arr) {
            var obj = {};
            arr.forEach(function (item, index) {
                obj[item] = index;
            });
            return obj;
        }
    }, {
        key: 'getFilterd',
        value: function getFilterd(arr, arr2) {
            return arr.filter(function (el) {
                return !arr2.includes(el);
            });
        }
    }, {
        key: 'getHtml',
        value: function getHtml(id) {
            return document.getElementById(id).innerHTML;
        }
    }, {
        key: 'decodeHtml',
        value: function decodeHtml(html) {
            var doc = new DOMParser().parseFromString(html, "text/html");
            return doc.documentElement.textContent;
        }
    }, {
        key: 'parseHTML',
        value: function parseHTML(str) {
            var tmp = document.implementation.createHTMLDocument();
            tmp.body.innerHTML = str;
            return tmp.body.children;
        }
    }, {
        key: 'uniqueArray',
        value: function uniqueArray(arrArg) {
            return Array.from(new Set(arrArg));
        }
    }]);

    return GridHelper;
}();

var ImageUploader = function () {
    function ImageUploader() {
        _classCallCheck(this, ImageUploader);
    }

    _createClass(ImageUploader, [{
        key: 'init',
        value: function init() {}
    }]);

    return ImageUploader;
}();

/**
 * lodash (Custom Build) <https://lodash.com/>
 * Build: `lodash modularize exports="npm" -o ./`
 * Copyright jQuery Foundation and other contributors <https://jquery.org/>
 * Released under MIT license <https://lodash.com/license>
 * Based on Underscore.js 1.8.3 <http://underscorejs.org/LICENSE>
 * Copyright Jeremy Ashkenas, DocumentCloud and Investigative Reporters & Editors
 */


function Unescape(text) {

    var INFINITY = 1 / 0;
    var symbolTag = '[object Symbol]';
    var reEscapedHtml = /&(?:amp|lt|gt|quot|#39|#96);/g;
    var reHasEscapedHtml = RegExp(reEscapedHtml.source);

    var htmlUnescapes = {
        '&amp;': '&',
        '&lt;': '<',
        '&gt;': '>',
        '&quot;': '"',
        '&#39;': "'",
        '&#96;': '`'
    };

    var freeGlobal = (typeof global === 'undefined' ? 'undefined' : _typeof(global)) == 'object' && global && global.Object === Object && global;

    var freeSelf = (typeof self === 'undefined' ? 'undefined' : _typeof(self)) == 'object' && self && self.Object === Object && self;

    var root = freeGlobal || freeSelf || Function('return this')();

    var unescapeHtmlChar = basePropertyOf(htmlUnescapes);

    var objectProto = Object.prototype;

    var objectToString = objectProto.toString;

    var _Symbol = root.Symbol;

    var symbolProto = _Symbol ? _Symbol.prototype : undefined;
    var symbolToString = symbolProto ? symbolProto.toString : undefined;

    function basePropertyOf(object) {
        return function (key) {
            return object == null ? undefined : object[key];
        };
    }

    function baseToString(value) {
        // Exit early for strings to avoid a performance hit in some environments.
        if (typeof value == 'string') {
            return value;
        }
        if (isSymbol(value)) {
            return symbolToString ? symbolToString.call(value) : '';
        }
        var result = value + '';
        return result == '0' && 1 / value == -INFINITY ? '-0' : result;
    }

    function isObjectLike(value) {
        return !!value && (typeof value === 'undefined' ? 'undefined' : _typeof(value)) == 'object';
    }

    function isSymbol(value) {
        return (typeof value === 'undefined' ? 'undefined' : _typeof(value)) == 'symbol' || isObjectLike(value) && objectToString.call(value) == symbolTag;
    }

    function toString(value) {
        return value == null ? '' : baseToString(value);
    }

    function unescape(string) {
        string = toString(string);
        return string && reHasEscapedHtml.test(string) ? string.replace(reEscapedHtml, unescapeHtmlChar) : string;
    }

    return unescape(text);
}

var AbstractElement = function () {
    function AbstractElement() {
        _classCallCheck(this, AbstractElement);
    }

    _createClass(AbstractElement, [{
        key: 'init',


        /**
         * some init staff like enable MediumEditor and etc.
         */
        value: function init() {
            throw new Error('init() \u0434\u043E\u043B\u0436\u0435\u043D \u0431\u044B\u0442\u044C \u0440\u0435\u0430\u043B\u0438\u0437\u043E\u0432\u0430\u043D');
        }

        /**
         * init Buttons for item control
         */

    }, {
        key: 'addFromRaw',

        /**
         * create DOM from json
         */
        value: function addFromRaw(item) {
            throw new Error('addFromRaw(item) \u0434\u043E\u043B\u0436\u0435\u043D \u0431\u044B\u0442\u044C \u0440\u0435\u0430\u043B\u0438\u0437\u043E\u0432\u0430\u043D');
        }
        /**
            * should prepare to create json
            */

    }, {
        key: 'getObject',
        value: function getObject() {
            throw new Error('getObject() \u0434\u043E\u043B\u0436\u0435\u043D \u0431\u044B\u0442\u044C \u0440\u0435\u0430\u043B\u0438\u0437\u043E\u0432\u0430\u043D');
        }

        /**
         * should return id of text/template
         */

    }, {
        key: 'getTemplateId',
        value: function getTemplateId() {
            throw new Error('getTemplateId \u0434\u043E\u043B\u0436\u0435\u043D \u0431\u044B\u0442\u044C \u0440\u0435\u0430\u043B\u0438\u0437\u043E\u0432\u0430\u043D');
        }
    }], [{
        key: 'initButtons',
        value: function initButtons() {
            throw new Error('static initButtons() \u0434\u043E\u043B\u0436\u0435\u043D \u0431\u044B\u0442\u044C \u0440\u0435\u0430\u043B\u0438\u0437\u043E\u0432\u0430\u043D');
        }
    }]);

    return AbstractElement;
}();

var FrameElement = function (_AbstractElement) {
    _inherits(FrameElement, _AbstractElement);

    function FrameElement() {
        var id = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
        var column = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;

        _classCallCheck(this, FrameElement);

        var _this = _possibleConstructorReturn(this, (FrameElement.__proto__ || Object.getPrototypeOf(FrameElement)).call(this));

        _this.column = column;
        _this.instance = null;
        _this.id = id;
        _this.type = 'frame';
        _this.content = null;
        return _this;
    }

    _createClass(FrameElement, [{
        key: 'addFromRaw',
        value: function addFromRaw(item) {
            var id = this.column.getNewElementId();
            //  let content = (new Unescape).do(item.content);
            var content = Unescape(item.content);
            //let content = GridHelper.decodeHtml(item.content);
            var block = this.getHtmlBlock(id, content);
            var container = this.column.instance.querySelector('.grid__column--container');
            container.innerHTML = '';
            container.appendChild(block);
            this.instance = block;
            this.init();
        }
    }, {
        key: 'addIcon',
        value: function addIcon() {
            var icon = FrameElement.getIcon();
            var html = GridHelper.parseHTML('<div class="grid__row--icon">' + icon + '</div>')[0];
            var controls = this.instance.closest('.grid__column').querySelector('.grid__column--control');
            controls.insertBefore(html, controls.firstChild);
        }
    }, {
        key: 'getHtmlBlock',
        value: function getHtmlBlock(id) {
            var content = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '';

            var block = this.getTemplate(id, content);
            block = GridHelper.parseHTML(block);
            return block[0];
        }
    }, {
        key: 'getTemplate',
        value: function getTemplate(id) {
            var content = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '';

            return '<div class="grid__item" data-type="frame" data-id="' + id + '">\n            <div class="grid__item--frame">\n                <textarea>' + content + '</textarea>\n            </div>\n        </div>';
        }
    }, {
        key: 'init',
        value: function init() {}
    }, {
        key: 'getObject',
        value: function getObject() {
            return {
                type: 'frame',
                id: this.id,
                content: this.instance.querySelector('textarea').value
            };
        }
    }], [{
        key: 'getIcon',
        value: function getIcon() {
            return '<i class="fa fa-code"></i>';
        }
    }, {
        key: 'getTitle',
        value: function getTitle() {
            return "iFrame/HTML";
        }
    }]);

    return FrameElement;
}(AbstractElement);

var GalleryElement = function (_AbstractElement2) {
    _inherits(GalleryElement, _AbstractElement2);

    function GalleryElement() {
        _classCallCheck(this, GalleryElement);

        return _possibleConstructorReturn(this, (GalleryElement.__proto__ || Object.getPrototypeOf(GalleryElement)).apply(this, arguments));
    }

    _createClass(GalleryElement, [{
        key: 'init',
        value: function init(container) {
            this.initControlButtons();
            this.initImageUpload();
            this.container = container.find('.grid__item--gallery').get(0);
            this.initSortable();
        }
    }, {
        key: 'getItemTemplate',
        value: function getItemTemplate() {
            return '<div class="grid__item--gallery__item empty">\n' + '            <div class="image__placeholder">\n' + '            </div>\n' + '            <div class="editable"></div>\n' + '            <div class="grid__btn remove"><i class="fa fa-trash"></i> Удалить фото</div>\n' + '        </div>';
        }
    }, {
        key: 'initImageUpload',
        value: function initImageUpload() {
            var _self = this;
            $('.add-images').fileupload({
                dataType: 'json',
                add: function add(e, data) {
                    var self = $(this);
                    $.each(data.files, function (index, file) {
                        _self.createPlaceholder(self);
                    });
                    if (e.isDefaultPrevented()) {
                        return false;
                    }
                    if (data.autoUpload || data.autoUpload !== false && $(this).fileupload('option', 'autoUpload')) {
                        data.process().done(function () {
                            data.submit();
                        });
                    }
                },
                done: function done(e, data) {
                    // $(this).parent().find('input').hide();
                    _self.addImagesToContainer($(this), data);
                },
                fail: function fail(e, data) {
                    alert('failed');
                    console.log(data);
                }
            });
        }
    }, {
        key: 'initSortable',
        value: function initSortable() {
            var container = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;

            var _self = this;
            var _container = void 0;
            if (container === null) {
                _container = _self.container;
            } else {
                _container = container;
            }

            var sort = Sortable.create(_container, {
                animation: 150, // ms, animation speed moving items when sorting, `0` — without animation
                scrollSpeed: 10,
                scrollSensitivity: 70,
                handle: ".image__placeholder", // Restricts sort start click/touch to the specified element
                draggable: ".grid__item--gallery__item" // Specifies which items inside the element should be sortable
            });
        }
    }, {
        key: 'createPlaceholder',
        value: function createPlaceholder(self) {
            var item = $.parseHTML(this.getItemTemplate())[0];
            item = $(item);
            self.closest('.grid__row').find('.grid__item--gallery').append(item);
            this.initMedium('Описание фото...');
        }
    }, {
        key: 'addImagesToContainer',
        value: function addImagesToContainer(self, data) {
            var block = self.closest('.grid__row').find('.grid__item--gallery__item.empty').first();
            block.removeClass('empty');
            block.find('.image__placeholder').append('<img src="' + data.result + '" />');
        }
    }, {
        key: 'initControlButtons',
        value: function initControlButtons() {
            var _self = this;
            $(document).on("click", '.grid__item--gallery__item .remove', function () {
                _self.removeImage($(this).closest(".grid__item--gallery__item"));
            });
        }
    }, {
        key: 'removeImage',
        value: function removeImage(container) {
            var src = container.find('img').attr('src');
            $.get("/admin.php/pages/longrid/remove-media?url=" + src, function (data) {});
            container.remove();
        }
    }, {
        key: 'getTemplateId',
        value: function getTemplateId() {
            return 'galleryBlock';
        }
    }, {
        key: 'getItemsObject',
        value: function getItemsObject(item) {
            var items = [];
            item.find('.grid__item--gallery__item').each(function () {
                items.push({
                    'image': $(this).find('.image__placeholder img').attr('src'),
                    'content': $(this).find('.editable').html()
                });
            });
            return items;
        }
    }, {
        key: 'getObject',
        value: function getObject(item) {
            return {
                'type': item.data('type'),
                'items': this.getItemsObject(item)
            };
        }
    }], [{
        key: 'initFromHtml',
        value: function initFromHtml() {
            var _self = new GalleryElement();
            _self.initControlButtons();
            _self.initImageUpload();
            $('.grid__item--gallery').each(function () {
                _self.initSortable($(this).get(0));
            });
        }
    }]);

    return GalleryElement;
}(AbstractElement);

var ImageElement = function (_AbstractElement3) {
    _inherits(ImageElement, _AbstractElement3);

    function ImageElement(id, column) {
        _classCallCheck(this, ImageElement);

        var _this3 = _possibleConstructorReturn(this, (ImageElement.__proto__ || Object.getPrototypeOf(ImageElement)).call(this));

        _this3.column = column;
        _this3.instance = null;
        _this3.id = id;
        _this3.type = 'image';
        _this3.desc = '';
        _this3.alt = '';
        _this3.state = 'default';
        _this3.editors = new Map();
        _this3.image = null;
        _this3.states = {
            default: "Обычный",
            left: 'Слева',
            right: 'Справа'
        };

        _this3.dropzone = null;
        return _this3;
    }

    _createClass(ImageElement, [{
        key: 'getObject',
        value: function getObject() {
            return {
                'type': this.type,
                'id': this.id,
                'state': this.state,
                'image': this.image,
                'desc': this.desc,
                'alt': this.alt

            };
        }
    }, {
        key: 'addFromRaw',
        value: function addFromRaw(item) {
            var id = this.column.getNewElementId();
            console.log(item);
            //  let content = (new Unescape).do(item.content);
            this.alt = Unescape(item.alt);
            this.desc = Unescape(item.desc);
            this.image = item.image;
            this.state = item.state;
            //let content = GridHelper.decodeHtml(item.content);
            var block = this.getHtmlBlock(id);
            var container = this.column.instance.querySelector('.grid__column--container');
            container.innerHTML = '';
            container.appendChild(block);
            this.instance = block;
            this.init();
        }
    }, {
        key: 'init',
        value: function init() {
            this.initControlButtons();
        }
    }, {
        key: 'initControlButtons',
        value: function initControlButtons() {
            var _self = this;
            this.initMedium('.image_alt', 'Alt,title etc.');
            this.initMedium('.image_desc', 'Описание');
            this.initImageUpload();

            this.instance.addEventListener('click', function (event) {
                var target = event.target;
                if (target.matches('.grid__item--control_item')) {
                    target.parentNode.querySelectorAll('.grid__item--control_item').forEach(function (item) {
                        return item.classList.remove('active');
                    });
                    target.classList.add('active');
                    _self.state = target.getAttribute('data-type');
                }
                Grid.triggerSave();
            });
        }
    }, {
        key: 'getHtmlBlock',
        value: function getHtmlBlock(id) {
            var block = this.getTemplate(id);
            block = GridHelper.parseHTML(block);
            return block[0];
        }
    }, {
        key: 'initImageUpload',
        value: function initImageUpload() {
            var _self = this;

            this.dropzone = new Dropzone(this.instance.querySelector('.image__placeholder .preview'), {
                url: "/ajax/image/upload",
                addRemoveLinks: true,
                maxFilesize: 10,
                thumbnailWidth: 300,
                maxFiles: 1,
                success: function success(file, response) {
                    _self.image = response.src;
                    Grid.triggerSave();
                },
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });
            if (this.image !== null) {
                var mock = { name: "", size: 1, accepted: true };
                this.dropzone.emit("addedfile", mock);
                this.dropzone.emit("thumbnail", mock, this.image);
                this.dropzone.emit("complete", mock);
                this.dropzone.files.push(mock);
                this.dropzone._updateMaxFilesReachedClass();
            }
        }
    }, {
        key: 'removeImage',
        value: function removeImage(container) {}
    }, {
        key: 'addIcon',
        value: function addIcon() {
            var icon = ImageElement.getIcon();
            var html = GridHelper.parseHTML('<div class="grid__row--icon">' + icon + '</div>')[0];
            var controls = this.instance.closest('.grid__column').querySelector('.grid__column--control');
            controls.insertBefore(html, controls.firstChild);
        }
    }, {
        key: 'getTemplateId',
        value: function getTemplateId() {
            return 'imageBlock';
        }
    }, {
        key: 'getStates',
        value: function getStates() {
            var states = '';
            var _self = this;
            for (var state in this.states) {

                states += '<div class="grid__item--control_item ' + (state == _self.state ? 'active' : '') + '" data-type="' + state + '">' + this.states[state] + '</div>';
            }
            return states;
        }
    }, {
        key: 'getTemplate',
        value: function getTemplate(id) {
            return '\n            <div class="grid__item" data-type="image"  data-id="' + id + '">\n                <div class="grid__item--control">\n                    <div class="left">\n                                 \n                    </div>\n                    <div class="main">\n                        ' + this.getStates() + '\n                    </div>\n                </div>\n                <div class="grid__item--image ">\n                  ' + this.getImageTemplate() + '\n                </div>\n            </div>';
        }
    }, {
        key: 'getImageTemplate',
        value: function getImageTemplate() {
            var template = '';
            if (this.image !== null) {
                template += '\n                        <div class="image__placeholder dropzone">\n                            <div class="preview">\n                               \n                            </div>\n                        </div>\n                        <div class="editable image_alt">\n                            ' + this.alt + ' \n                        </div>\n                        <div class="editable image_desc">\n                            ' + this.desc + '  \n                        </div>\n\n                ';
            } else {
                template += ' \n                        <div class="image__placeholder dropzone">\n                            <div class="preview"></div>\n                        </div> \n                        <div class="editable image_alt">\n                        </div>\n                        <div class="editable image_desc">\n                        </div>';
            }

            return template;
        }
    }, {
        key: 'initMedium',
        value: function initMedium() {
            var class_name = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '.editable';
            var placeholder = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'Введите текст...';

            var _self = this;
            var selector = this.instance.querySelector(class_name);
            var editor = new MediumEditor(selector, {
                toolbar: {
                    /* These are the default options for the toolbar,
                     if nothing is passed this is what is used */
                    allowMultiParagraphSelection: true,
                    buttons: ['h2', 'h3', 'h4', 'anchor', 'h5', 'h6', 'removeFormat'],
                    diffLeft: 0,
                    diffTop: -10,
                    firstButtonClass: 'medium-editor-button-first',
                    lastButtonClass: 'medium-editor-button-last',
                    standardizeSelectionStart: false,
                    static: false,
                    relativeContainer: null,
                    /* options which only apply when static is true */
                    align: 'center',
                    sticky: false,
                    updateOnEmptySelection: false
                },
                placeholder: {
                    text: placeholder,
                    hideOnClick: true
                },
                imageDragging: false
            });
            editor.subscribe('editableInput', function (event, editorElement) {
                var content = editor.getContent();
                if (class_name == '.image_alt') {
                    _self.alt = content;
                } else {
                    _self.desc = content;
                }
                Grid.triggerSave();
            });
            this.editors.set(class_name, editor);
        }
    }], [{
        key: 'getIcon',
        value: function getIcon() {
            return '<i class="fa fa-image"></i>';
        }
    }, {
        key: 'getTitle',
        value: function getTitle() {
            return "Изображение";
        }
    }, {
        key: 'initFromHtml',
        value: function initFromHtml() {
            var _self = new ImageElement();
            _self.initControlButtons();
            _self.initImageUpload();
        }
    }]);

    return ImageElement;
}(AbstractElement);

var QuoteElement = function (_AbstractElement4) {
    _inherits(QuoteElement, _AbstractElement4);

    function QuoteElement() {
        _classCallCheck(this, QuoteElement);

        return _possibleConstructorReturn(this, (QuoteElement.__proto__ || Object.getPrototypeOf(QuoteElement)).apply(this, arguments));
    }

    _createClass(QuoteElement, [{
        key: 'getTemplateId',
        value: function getTemplateId() {
            return 'quoteBlock';
        }
    }, {
        key: 'getObject',
        value: function getObject(item) {
            return {
                'type': item.data('type'),
                'content': item.find('.editable').html()
            };
        }
    }]);

    return QuoteElement;
}(AbstractElement);

var TextElement = function (_AbstractElement5) {
    _inherits(TextElement, _AbstractElement5);

    function TextElement(id, column) {
        _classCallCheck(this, TextElement);

        var _this5 = _possibleConstructorReturn(this, (TextElement.__proto__ || Object.getPrototypeOf(TextElement)).call(this));

        _this5.column = column;
        _this5.instance = null;
        _this5.id = id;
        _this5.type = 'text';
        _this5.editor = null;
        return _this5;
    }

    _createClass(TextElement, [{
        key: 'addFromRaw',
        value: function addFromRaw(item) {
            var id = this.column.getNewElementId();
            //  let content = (new Unescape).do(item.content);
            var content = Unescape(item.content);
            //let content = GridHelper.decodeHtml(item.content);
            var block = this.getHtmlBlock(id, content);
            var container = this.column.instance.querySelector('.grid__column--container');
            container.innerHTML = '';
            container.appendChild(block);
            this.instance = block;
            this.init();
        }
    }, {
        key: 'getObject',
        value: function getObject() {
            return {
                type: 'text',
                id: this.id,
                content: this.instance.querySelector('.editable').innerHTML
            };
        }
    }, {
        key: 'addIcon',
        value: function addIcon() {
            var icon = TextElement.getIcon();
            var html = GridHelper.parseHTML('<div class="grid__row--icon">' + icon + '</div>')[0];
            var controls = this.instance.closest('.grid__column').querySelector('.grid__column--control');
            controls.insertBefore(html, controls.firstChild);
        }
    }, {
        key: 'getTemplateId',
        value: function getTemplateId() {
            return 'textBlock';
        }
    }, {
        key: 'getHtmlBlock',
        value: function getHtmlBlock(id) {
            var content = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '';

            var block = this.getTemplate(id, content);
            block = GridHelper.parseHTML(block);
            return block[0];
        }
    }, {
        key: 'getTemplate',
        value: function getTemplate(id) {
            var content = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '';

            return '<div class="grid__item" data-type="text" data-id="' + id + '">\n            <div class="grid__item--text">\n                <div class="editable">\n                ' + content + '\n                </div>\n            </div>\n        </div>';
        }
    }, {
        key: 'init',
        value: function init() {
            this.initMedium();
        }
    }, {
        key: 'initMedium',
        value: function initMedium() {
            var placeholder = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 'Введите текст...';

            var selector = this.instance.querySelector('.editable');
            this.editor = new MediumEditor(selector, {
                toolbar: {
                    /* These are the default options for the toolbar,
                     if nothing is passed this is what is used */
                    allowMultiParagraphSelection: true,
                    buttons: ['bold', 'italic', 'h3', 'anchor', 'justifyLeft', 'justifyCenter', 'justifyRight', 'removeFormat'],
                    diffLeft: 0,
                    diffTop: -10,
                    firstButtonClass: 'medium-editor-button-first',
                    lastButtonClass: 'medium-editor-button-last',
                    standardizeSelectionStart: false,
                    static: false,
                    relativeContainer: null,
                    /* options which only apply when static is true */
                    align: 'center',
                    sticky: false,
                    updateOnEmptySelection: false
                },
                placeholder: {
                    text: placeholder,
                    hideOnClick: true
                },
                imageDragging: false
            });
            this.editor.subscribe('editableInput', function (event, editorElement) {
                Grid.triggerSave();
            });
        }
    }], [{
        key: 'getIcon',
        value: function getIcon() {
            return '<i class="fa fa-font"></i>';
        }
    }, {
        key: 'getTitle',
        value: function getTitle() {
            return "Текст";
        }
    }]);

    return TextElement;
}(AbstractElement);

var GridColumn = function () {
    function GridColumn(row) {
        var width = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 1;

        _classCallCheck(this, GridColumn);

        this.items = new Map();
        this.row = row;
        this.instance = null;
        this.width = width;
        this.id = null;
    }

    _createClass(GridColumn, [{
        key: 'getObject',
        value: function getObject() {
            var items = [];
            this.items.forEach(function (item) {
                items.push(item.getObject());
            });

            return {
                items: items,
                width: this.getWidth(),
                empty: this.isEmpty(),
                id: this.id
            };
        }
    }, {
        key: 'add',
        value: function add(id) {
            var column = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;

            var row = this.row.instance.querySelector('.grid__row--container');
            var block = this.getTemplate(id);
            block = GridHelper.parseHTML(block);
            this.instance = block[0];
            if (column !== null) {
                column.instance.parentNode.insertBefore(this.instance, column.instance.nextSibling);
            } else {
                row.appendChild(this.instance);
            }

            this.id = id;
            this.init();
            Grid.triggerSave();
        }
    }, {
        key: 'addFromRaw',
        value: function addFromRaw(column) {
            var _self = this;
            // let empty = column.items.length?false:true;
            var block = this.getTemplate(column.id, column.empty);
            block = GridHelper.parseHTML(block);
            block = block[0];
            var row = this.row.instance.querySelector('.grid__row--container');
            row.appendChild(block);
            this.instance = block;
            this.id = column.id;
            this.init();

            if (column.hasOwnProperty('items')) {
                column.items.forEach(function (item) {
                    var className = _self.getGrid().items[item.type];
                    var instance = new className(item.id, _self);
                    instance.addFromRaw(item);
                    instance.addIcon();
                    _self.addItemsToColumn(item.id, instance);
                });
            }
        }
    }, {
        key: 'addItem',
        value: function addItem(type) {
            var classInstance = this.getGrid().items[type];
            var id = this.getNewElementId();
            var item = new classInstance(id, this);
            var block = item.getHtmlBlock(id);
            var container = this.instance.querySelector('.grid__column--container');
            container.innerHTML = '';
            container.appendChild(block);
            item.instance = block;
            item.init();
            item.addIcon();
            this.addItemsToColumn(id, item);
            this.changeColumnStatus();
        }
    }, {
        key: 'addItemsToColumn',
        value: function addItemsToColumn(id, item) {
            this.items.set(id, item);
        }
    }, {
        key: 'changeColumnStatus',
        value: function changeColumnStatus() {
            this.instance.classList.remove('empty');
            this.row.emptyWidth -= this.getWidth();
            this.row.itemsWidth += this.getWidth();
        }
    }, {
        key: 'changeDataWidth',
        value: function changeDataWidth() {
            this.instance.setAttribute('data-width', this.width);
        }
    }, {
        key: 'decreaseWidth',
        value: function decreaseWidth() {
            this.row.inActionColumn = this;
            if (this.width - 1 <= 0) {
                throw new Error('can\'t decrease');
                return false;
            } else {}
            if (this.row.canChangeColumnWidth(true) || this.row.addAction) {
                this.width = this.width - 1;
                this.row.setWidth(-1, this.isEmpty());
                if (!this.isEmpty()) {
                    this.row.addOrChangeEmptyColumn(1, true);
                }
            } else {
                throw new Error('can\'t change column width to -');
            }
            this.changeDataWidth();
            this.row.inActionColumn = null;
        }
    }, {
        key: 'getColumnItems',
        value: function getColumnItems() {
            var items = this.getGrid().items;
            var template = '';
            for (var item in items) {
                if (items.hasOwnProperty(item)) {
                    var instance = items[item];
                    template += ' <div class="grid__column--add_item" data-type="' + item + '" title="' + instance.getTitle() + '" >\n                       ' + instance.getIcon() + '\n                    </div>';
                }
            }
            return template;
        }
    }, {
        key: 'getNewElementId',
        value: function getNewElementId() {

            var keys = [].concat(_toConsumableArray(this.items.keys()));
            if (keys.length > 0) {
                return Math.max.apply(Math, _toConsumableArray(keys)) + 1;
            } else {
                return 1;
            }
        }
    }, {
        key: 'getGrid',
        value: function getGrid() {
            return this.row.grid;
        }
    }, {
        key: 'getTemplate',
        value: function getTemplate(id) {
            var empty = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;

            var _self = this;
            var template = ' <div class="grid__column ' + (empty ? 'empty' : '') + '" data-width="' + _self.getWidth() + '" data-id="' + id + '">\n        <div class="grid__column--control"> \n            <div class="grid__column--move">\n                <i class="fa fa-arrows"></i>\n            </div>\n             <div class="grid__column--action" data-action="decreaseWidth">\n                -\n            </div> \n            <div class="grid__column--action" data-action="increaseWidth">\n               +\n            </div>\n             <div class="grid__column--action" data-action="removeColumn">\n                <i class="fa fa-trash"></i>\n            </div>\n        </div>\n        <div class="grid__column--container">\n           \n            <div class="empty"> \n                <div class="items__list">\n                    ' + _self.getColumnItems() + '                   \n                </div>\n                <div class="select__item">\n\n                </div>\n\n            </div>\n        </div>\n    </div>';
            return template.trim();
        }
    }, {
        key: 'getTemplateId',
        value: function getTemplateId() {
            return 'columnBlock';
        }
    }, {
        key: 'getWidth',
        value: function getWidth() {
            return this.width;
        }
    }, {
        key: 'increaseWidth',
        value: function increaseWidth() {
            this.row.inActionColumn = this;
            if (this.width + 1 > this.row.maxWidth) {
                throw new Error('can\'t increase');
                return false;
            }
            if (this.row.canChangeColumnWidth()) {
                this.width = this.width + 1;
                this.row.setWidth(1, this.isEmpty());
                if (!this.isEmpty()) {
                    this.row.removeOrChangeEmptyColumn();
                }
            } else {
                throw new Error('can\'t change column width to +');
            }
            this.changeDataWidth();
            this.row.inActionColumn = null;
        }
    }, {
        key: 'init',
        value: function init() {
            this.initButtons();
        }
    }, {
        key: 'initButtons',
        value: function initButtons() {
            var _self = this;

            this.instance.addEventListener('click', function (event) {
                var target = event.target;
                if (target.matches('.grid__column--add_item')) {
                    _self.addItem(target.getAttribute('data-type'));
                }

                if (target.matches('.grid__column--action')) {
                    var action = target.getAttribute('data-action');
                    if (_self[action] instanceof Function) {
                        if (['increaseWidth', 'decreaseWidth'].includes(action)) {
                            if (!_self.isEmpty()) {
                                _self[action](target);
                            }
                        } else {
                            _self[action](target);
                        }
                    }
                }
                Grid.triggerSave();
                //_self.row.updateColumnsOrder();
            });
        }
    }, {
        key: 'isEmpty',
        value: function isEmpty() {
            return this.instance.classList.contains('empty');
        }
    }, {
        key: 'removeColumn',
        value: function removeColumn() {
            if (!this.isEmpty()) {
                var removeConfirm = confirm('Are you sure to delete?');
                if (!removeConfirm) {
                    return false;
                }
                this.row.setWidth(-this.getWidth());
                //Save Old Sorting
                //let oldSort = GridHelper.uniqueArray(this.row.sortable.toArray());

                var emptyColumn = this.row.addColumn(this.getWidth());
                this.instance.parentNode.replaceChild(emptyColumn.instance, this.instance);
                //Fix this.row.columns ordering
                //this.orderRowColumns(emptyColumn, oldSort,this.id,emptyColumn.id);
            } else {
                this.instance.remove();
            }
            this.row.columns.delete(this.id);
            Grid.triggerSave();
        }
    }, {
        key: 'orderRowColumns',
        value: function orderRowColumns(emptyColumn, oldSort, removedIndex, newIndex) {
            oldSort = oldSort.map(function (name) {
                if (name == removedIndex) {
                    return newIndex;
                } else {
                    return name;
                }
            });
            this.row.sortColumns(GridHelper.arrayToSortPattern(oldSort));
        }
    }, {
        key: 'updateDataId',
        value: function updateDataId() {
            this.instance.setAttribute('data-id', this.id);
        }
    }]);

    return GridColumn;
}();

var GridRow = function () {
    function GridRow() {
        var grid = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
        var maxWidth = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 6;

        _classCallCheck(this, GridRow);

        this.columns = new Map();
        this.instance = null; // DOMElement
        this.grid = grid;
        this.id = null;
        this.maxWidth = maxWidth; //4 items or 2 items with size 2 and etc.
        this.itemsWidth = 0;
        this.emptyWidth = 0;
        this.addAction = false;
        this.sortable = null;
        this.inActionColumn = null;
    }

    /**
     * Если row не null, то добавляем строку после этого row
     * @param container
     * @param row
     * @param id
     */


    _createClass(GridRow, [{
        key: 'add',
        value: function add(container) {
            var row = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
            var id = arguments[2];

            var block = this.getTemplate(id, this.maxWidth);
            block = GridHelper.parseHTML(block);
            block = block[0];
            if (row !== null) {
                row.parentNode.insertBefore(block, row.nextSibling);
            } else {
                container.appendChild(block);
            }
            this.instance = block;
            this.id = id;
            this.init();
            this.addColumn(this.maxWidth);
        }
    }, {
        key: 'addFromRaw',
        value: function addFromRaw(container, row) {
            var block = this.getTemplate(row.id, this.maxWidth);
            var _self = this;
            block = GridHelper.parseHTML(block);
            block = block[0];

            container.appendChild(block);
            this.instance = block;
            this.id = row.id;
            this.emptyWidth = row.emptyWidth;
            this.itemsWidth = row.itemsWidth;
            this.maxWidth = row.maxWidth;
            this.init();
            if (row.hasOwnProperty('columns')) {
                row.columns.forEach(function (column) {
                    var grid_column = new GridColumn(_self, column.width);
                    grid_column.addFromRaw(column);
                    _self.addColumnToRow(column.id, grid_column);
                });
            }
        }
    }, {
        key: 'addColumn',
        value: function addColumn() {
            var defaultColumnWidth = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 1;
            var addItem = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;

            var id = this.getNewElementId();
            var column = new GridColumn(this, defaultColumnWidth);
            if (this.canAddColumn(column.getWidth())) {
                column.add(id, this.inActionColumn);
                this.addColumnToRow(id, column);
                this.setWidth(column.getWidth(), column.isEmpty());
                if (addItem) {
                    if (this.grid.options.hasOwnProperty('defaultItem')) {
                        column.addItem(this.grid.options.defaultItem);
                    }
                }
            } else {
                throw new Error('No space in row');
            }
            return column;
        }
    }, {
        key: 'addColumnFromAnotherRow',
        value: function addColumnFromAnotherRow(column) {
            var new_id = this.getNewElementId();
            this.addAction = true;
            column.row = this;
            column.id = new_id;
            column.updateDataId();
            this.removeOrChangeEmptyColumn(column.getWidth());
            this.setWidth(column.getWidth(), column.isEmpty());
            this.addColumnToRow(new_id, column);
            this.addAction = false;
        }
    }, {
        key: 'addColumnToRow',
        value: function addColumnToRow(id, column) {
            this.columns.set(id, column);
        }
    }, {
        key: 'addOrChangeEmptyColumn',
        value: function addOrChangeEmptyColumn() {
            var times = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 1;
            var decreaseAction = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;

            for (var i = 0; i < times; i++) {
                if (this.getAvailableWidth() > 0) {
                    var emptyItem = this.hasEmptyColumns(decreaseAction);
                    if (!emptyItem) {
                        this.addColumn(1);
                    } else {
                        emptyItem.increaseWidth();
                    }
                }
            }
        }
    }, {
        key: 'canAddColumn',
        value: function canAddColumn(columnWidth) {
            var nextWidth = this.getAvailableWidth() - columnWidth;
            return nextWidth >= 0;
        }
    }, {
        key: 'canChangeColumnWidth',
        value: function canChangeColumnWidth() {
            var decrease = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;

            var available = this.getAvailableWidth();
            if (decrease) {
                if (this.addAction) {
                    return true;
                }
                if (available + 1 < this.maxWidth) {
                    return true;
                }
            } else {
                if (available - 1 >= 0) {
                    return true;
                }
            }
            return false;
        }
    }, {
        key: 'collapse',
        value: function collapse(row) {
            var parent = row.closest('.grid__row');

            var content = function () {
                var block = row.find('.editable,textarea');
                if (block.length) {
                    if (block.hasClass('editable')) {
                        return block.text().trim().substring(0, 70).replace(/[\r\n +(?= )]+/g, ' ');
                    } else {
                        return block.val().trim().substring(0, 70).replace(/[\r\n +(?= )]+/g, ' ');
                    }
                }
                return '';
            }();
            parent.find('.grid__row--move_title').html(content);
            parent.toggleClass('collapsed');
            if (parent.hasClass('collapsed')) {
                $('.collapse_all').attr('data-state', 1);
            }
            row.slideToggle();
        }
    }, {
        key: 'collectColumnData',
        value: function collectColumnData(row) {
            var column = new GridColumn(this.grid);
            var _self = this;
            var columns = [];
            row.find('.grid__column').each(function () {
                columns.push(column.collectItemData($(this)));
            });
            return {
                'columns': columns
            };
        }
    }, {
        key: 'getAvailableWidth',
        value: function getAvailableWidth() {
            return this.maxWidth - this.itemsWidth;
        }
    }, {
        key: 'getColumnById',
        value: function getColumnById(id) {
            id = parseInt(id);
            return this.columns.get(id);
        }
    }, {
        key: 'getNewElementId',
        value: function getNewElementId() {

            var keys = [].concat(_toConsumableArray(this.columns.keys()));
            if (keys.length > 0) {
                return Math.max.apply(Math, _toConsumableArray(keys)) + 1;
            } else {
                return 1;
            }
        }
    }, {
        key: 'getTemplate',
        value: function getTemplate(id) {
            var columns = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 4;

            var template = '<div class="grid__row col_' + columns + '" data-id="' + id + '">\n        <div class="white_background">\n            <div class="grid__row--control">\n                <div class="grid__row--move">\n                    <i class="fa fa-arrows"></i>\n                    <span class="grid__row--move_title"></span>\n                </div>\n                <div class="grid__row--remove"><i class="fa fa-trash"></i> \u0423\u0434\u0430\u043B\u0438\u0442\u044C \u0440\u044F\u0434</div>\n                <div class="grid__row--collapse"><i class="fa fa-caret-up"></i></div>\n            </div>\n            <div class="grid__row--container">\n            </div>\n        </div>\n        <div class="grid__row--add">\n            <div class="btn add-inblock" data-type="row"><i class="fa fa-plus"></i> \u0414\u043E\u0431\u0430\u0432\u0438\u0442\u044C \u0440\u044F\u0434</div>\n        </div>\n    </div>';
            return template.trim();
        }
    }, {
        key: 'getTemplateId',
        value: function getTemplateId() {
            return 'rowBlock';
        }
    }, {
        key: 'hasEmptyColumns',
        value: function hasEmptyColumns() {
            var decreaseAction = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;

            var has = false;
            var _self = this;
            var items = {
                'before': [],
                'after': []
            };
            var arrName = 'before';
            this.columns.forEach(function (item) {
                if (item == _self.inActionColumn) {
                    arrName = 'after';
                } else {
                    items[arrName].push(item);
                }
            });
            var _iteratorNormalCompletion = true;
            var _didIteratorError = false;
            var _iteratorError = undefined;

            try {
                for (var _iterator = items.after[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
                    var item = _step.value;

                    if (item.isEmpty()) {
                        has = item;
                        return has;
                    } else {
                        if (decreaseAction) {
                            return false;
                        }
                    }
                }
            } catch (err) {
                _didIteratorError = true;
                _iteratorError = err;
            } finally {
                try {
                    if (!_iteratorNormalCompletion && _iterator.return) {
                        _iterator.return();
                    }
                } finally {
                    if (_didIteratorError) {
                        throw _iteratorError;
                    }
                }
            }

            if (decreaseAction) {
                if (!items.after.length) {
                    return false;
                }
            }

            var _iteratorNormalCompletion2 = true;
            var _didIteratorError2 = false;
            var _iteratorError2 = undefined;

            try {
                for (var _iterator2 = items.before[Symbol.iterator](), _step2; !(_iteratorNormalCompletion2 = (_step2 = _iterator2.next()).done); _iteratorNormalCompletion2 = true) {
                    var _item = _step2.value;

                    if (_item.isEmpty()) {
                        has = _item;
                        return has;
                    }
                }
            } catch (err) {
                _didIteratorError2 = true;
                _iteratorError2 = err;
            } finally {
                try {
                    if (!_iteratorNormalCompletion2 && _iterator2.return) {
                        _iterator2.return();
                    }
                } finally {
                    if (_didIteratorError2) {
                        throw _iteratorError2;
                    }
                }
            }

            return has;
        }
    }, {
        key: 'init',
        value: function init() {
            this.initButtons();
            //this.initColumnSorting();
        }
    }, {
        key: 'initButtons',
        value: function initButtons() {
            var _self = this;
            this.instance.addEventListener('click', function (event) {
                var target = event.target;
                if (target.matches('.grid__row--remove')) {
                    _self.removeRow();
                }
            });
        }
    }, {
        key: 'initColumnSorting',
        value: function initColumnSorting() {
            var _self = this;

            var sortable = Sortable.create(_self.instance.querySelector('.grid__row--container'), {
                group: 'columns',
                animation: 150,
                ghostClass: "ghost",
                handle: ".grid__column--move", // Restricts sort start click/touch to the specified element
                draggable: ".grid__column", // Specifies which items inside the element should be sortable
                onMove: function onMove(evt, originalEvent) {
                    if (evt.to !== evt.from) {
                        _self.hideOrResizeEmpty(evt);
                    } else {
                        _self.removeTempWidth();
                    }
                },
                onStart: function onStart(evt) {
                    _self._temp_sortOrder = _self.sortable.toArray();
                },
                onAdd: function onAdd(evt) {
                    _self.moveColumnToAnotherRow(evt);
                    _self._temp_sortOrder = null;
                },
                onSort: function onSort(evt) {
                    _self.updateColumnsOrder();
                },
                onEnd: function onEnd(evt) {

                    _self.removeTempWidth();
                }
            });

            this.sortable = sortable;
        }
    }, {
        key: 'updateColumnsOrder',
        value: function updateColumnsOrder() {
            this.sortColumns(GridHelper.arrayToSortPattern(this.sortable.toArray()));
        }
    }, {
        key: 'removeTempWidth',
        value: function removeTempWidth(rowInstance) {
            this.grid.container.querySelectorAll('.grid__column.empty').forEach(function (item) {
                item.removeAttribute('temp_width');
            });
        }
    }, {
        key: 'hideOrResizeEmpty',
        value: function hideOrResizeEmpty(event) {

            var newRow = this.grid.getRowById(event.to.closest('.grid__row').getAttribute('data-id'));
            var item = event.dragged;
            var itemSize = parseInt(item.getAttribute('data-width'));
            var emptyColumn = newRow.hasEmptyColumns();
            var emptyColumnNewSize = emptyColumn.width - itemSize;
            if (emptyColumn) {
                emptyColumn.instance.setAttribute('temp_width', emptyColumnNewSize);
            }
        }
    }, {
        key: 'moveColumnToAnotherRow',
        value: function moveColumnToAnotherRow(e) {
            var oldRow = this.grid.getRowById(e.from.closest('.grid__row').getAttribute('data-id'));
            var newRow = this.grid.getRowById(e.target.closest('.grid__row').getAttribute('data-id'));
            var column = oldRow.getColumnById(e.item.getAttribute('data-id'));
            var clone = Object.assign(Object.create(Object.getPrototypeOf(column)), column);
            if (newRow.canAddColumn(column.getWidth())) {
                newRow.addColumnFromAnotherRow(column);
                oldRow.removeColumnToAnotherRow(clone);
            } else {
                this.reverseSortedColumn(e);
                console.warn('No free space in row');
                //throw new Error('No free space in row');
            }
        }
    }, {
        key: 'removeColumnToAnotherRow',
        value: function removeColumnToAnotherRow(column) {
            this.columns.delete(column.id);
            this.setWidth(-column.getWidth(), column.isEmpty());
            for (var i = 0; i < column.getWidth(); i++) {
                this.addOrChangeEmptyColumn();
            }
            //Отсортировать добавленную колонку так, чтобы она встала на место перемещенного
            var oldSort = GridHelper.uniqueArray(this._temp_sortOrder);
            var removedIndex = GridHelper.getFilterd(oldSort, this.sortable.toArray()).join();
            var newIndex = GridHelper.getFilterd(this.sortable.toArray(), this._temp_sortOrder).join();
            oldSort = oldSort.map(function (name) {
                if (name == removedIndex) {
                    return newIndex;
                } else {
                    return name;
                }
            });
            this.sortable.sort(oldSort);
        }
    }, {
        key: 'removeOrChangeEmptyColumn',
        value: function removeOrChangeEmptyColumn() {
            var times = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 1;

            for (var i = 0; i < times; i++) {
                var emptyItem = this.hasEmptyColumns();
                if (emptyItem) {
                    if (this.emptyWidth == 1) {
                        emptyItem.removeColumn();
                        this.emptyWidth = 0;
                    } else {
                        if (emptyItem.getWidth() == 1) {
                            emptyItem.removeColumn();
                        } else {
                            emptyItem.decreaseWidth();
                        }
                    }
                }
            }
        }
    }, {
        key: 'removeRow',
        value: function removeRow() {
            var removeConfirm = confirm('Are you sure to delete?');
            if (removeConfirm) {
                this.instance.remove();
                this.grid.rows.delete(this.id);
                Grid.triggerSave();
            }

            return false;
        }
    }, {
        key: 'reverseSortedColumn',
        value: function reverseSortedColumn(e) {
            var oldRow = this.grid.getRowById(e.from.closest('.grid__row').getAttribute('data-id'));
            e.from.appendChild(e.item);
            oldRow.sortable.sort(oldRow._temp_sortOrder);
        }
    }, {
        key: 'setWidth',
        value: function setWidth(columnWidth, emptyItem) {
            if (emptyItem) {
                this.emptyWidth += columnWidth;
            } else {
                this.itemsWidth += columnWidth;
            }
        }
    }, {
        key: 'sortColumns',
        value: function sortColumns(pattern) {
            this.columns = new Map([].concat(_toConsumableArray(this.columns.entries())).sort(function (x, y) {
                return pattern[x[0]] - pattern[y[0]];
            }));
        }
    }, {
        key: 'getObject',
        value: function getObject() {
            var columns = [];
            this.columns.forEach(function (column) {
                columns.push(column.getObject());
            });
            return {
                columns: columns,
                id: this.id,
                maxWidth: this.maxWidth,
                itemsWidth: this.itemsWidth,
                emptyWidth: this.emptyWidth
            };
        }
    }]);

    return GridRow;
}();
/**
 * columns can be 2 to 12
 */


var Grid = function () {
    function Grid(options) {
        _classCallCheck(this, Grid);

        this.rows = new Map();
        this.container = options.container;
        this.raw = options.raw;
        this.sortable = null;
        this.options = {
            columns: 6,
            defaultItem: 'text'
        };
        Object.assign(this.options, options.other);
        this.items = {
            'text': TextElement,
            'image': ImageElement
        };
    }

    _createClass(Grid, [{
        key: 'addItem',
        value: function addItem(name, instance_class) {
            var instance = new instance_class(null, null);
            if (!(instance instanceof AbstractElement)) {
                throw new Error(name + ' should be instanceof AbstractElement');
            }
            this.items[name] = instance_class;
        }
    }, {
        key: 'addRowBlock',
        value: function addRowBlock() {
            var row = new GridRow(this, this.options.columns);
            var id = this.getNewElementId();
            row.add(this.container, null, id);
            this.addRowToGrid(id, row);
        }
    }, {
        key: 'addRowBlockAfter',
        value: function addRowBlockAfter(item) {
            var row = new GridRow(this, this.options.columns);
            var id = this.getNewElementId();
            row.add(this.container, item, id);
            this.addRowToGrid(id, row);
            this.sortRows(GridHelper.arrayToSortPattern(this.sortable.toArray()));
        }
    }, {
        key: 'addRowToGrid',
        value: function addRowToGrid(id, row) {
            this.rows.set(id, row);
            Grid.triggerSave();
        }
    }, {
        key: 'getCleanClone',
        value: function getCleanClone() {
            var clone = Object.assign(Object.create(this), this);
            var rows = [];
            clone.rows.forEach(function (row, index) {
                rows.push(row.getObject());
            });
            clone.rows = rows;
            delete clone.sortable;
            delete clone.raw;
            delete clone.items;
            clone.container = clone.container.id;
            return clone;
        }
    }, {
        key: 'getNewElementId',
        value: function getNewElementId() {
            var keys = [].concat(_toConsumableArray(this.rows.keys()));
            if (keys.length > 0) {
                return Math.max.apply(Math, _toConsumableArray(keys)) + 1;
            } else {
                return 1;
            }
        }
    }, {
        key: 'getRowById',
        value: function getRowById(id) {
            id = parseInt(id);
            return this.rows.get(id);
        }
    }, {
        key: 'init',
        value: function init() {
            if (this.hasRaw()) {
                this.initRaw();
            }
            //console.log('hello');
            this.initButtons();
            this.initSortable();
            // this.initRowIcons();
        }
    }, {
        key: 'initRaw',
        value: function initRaw() {
            var raw = JSON.parse(this.raw);
            var _self = this;
            if (raw.hasOwnProperty('rows')) {
                this.checkRawOptions(raw);
                raw.rows.forEach(function (row) {
                    var grid_row = new GridRow(_self, _self.options.columns);
                    grid_row.addFromRaw(_self.container, row);
                    _self.addRowToGrid(row.id, grid_row);
                });
            }
        }
    }, {
        key: 'checkRawOptions',
        value: function checkRawOptions(raw) {
            if (this.container.id !== raw.container) {
                console.warn('wrong container ID');
            }
            if (this.options.columns !== raw.options.columns) {
                throw new Error('This JSON has ' + raw.options.columns + ' columns scheme, when Grid has ' + this.options.columns + ' columns');
            }
        }
    }, {
        key: 'hasRaw',
        value: function hasRaw() {
            try {
                var r = JSON.parse(this.raw);
                if (r.hasOwnProperty('rows')) {
                    return true;
                } else {
                    return false;
                }
            } catch (err) {
                console.warn(err);
                return false;
            }
        }
    }, {
        key: 'initButtons',
        value: function initButtons() {
            var _self = this;
            document.querySelector('.grid__maker').addEventListener('click', function (event) {
                var target = event.target;
                if (target.matches('.add-block')) {
                    _self.addRowBlock();
                }
                if (target.matches('.add-inblock')) {
                    _self.addRowBlockAfter(target.closest('.grid__row'));
                }
            });
        }
    }, {
        key: 'initSortable',
        value: function initSortable() {
            var _self = this;
            var container = document.querySelector("#grid__container");
            var sort = Sortable.create(container, {
                animation: 250, // ms, animation speed moving items when sorting, `0` — without animation
                scrollSpeed: 10,
                scrollSensitivity: 70,
                handle: ".grid__row--move", // Restricts sort start click/touch to the specified element
                draggable: ".grid__row", // Specifies which items inside the element should be sortable
                onSort: function onSort(evt) {
                    _self.sortRows(GridHelper.arrayToSortPattern(_self.sortable.toArray()));
                }
            });
            this.sortable = sort;
        }
    }, {
        key: 'sortRows',
        value: function sortRows(pattern) {
            this.rows = new Map([].concat(_toConsumableArray(this.rows.entries())).sort(function (x, y) {
                return pattern[x[0]] - pattern[y[0]];
            }));
            Grid.triggerSave();
        }
    }, {
        key: 'toJson',
        value: function toJson() {
            return JSON.stringify(this.getCleanClone());
        }
    }], [{
        key: 'triggerSave',
        value: function triggerSave() {
            document.dispatchEvent(new CustomEvent('updateGridTextarea'));
        }
    }]);

    return Grid;
}();

var Longread = function () {
    function Longread() {
        _classCallCheck(this, Longread);

        this.data = {};
        this.grid = null;
        this.textarea = document.querySelector('#grid__textarea');
    }

    _createClass(Longread, [{
        key: 'initButtons',
        value: function initButtons() {}
    }, {
        key: 'init',
        value: function init() {
            var _this6 = this;

            Dropzone.autoDiscover = false;

            this.grid = new Grid({
                container: document.getElementById('grid__container'),
                raw: this.textarea.innerHTML
            });
            this.grid.init();
            this.initButtons();
            document.addEventListener("updateGridTextarea", function (e) {
                return _this6.save();
            });
        }
    }, {
        key: 'save',
        value: function save() {
            var _self = this;
            this.textarea.innerHTML = this.grid.toJson();
        }
    }]);

    return Longread;
}();

var longridMaker = new Longread();
longridMaker.init();