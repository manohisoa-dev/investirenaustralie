var themoneyconverter;if(!themoneyconverter)themoneyconverter={};themoneyconverter=(function(){var F=function(a){var b=a
.lastIndexOf("#");return a.substring(b+1)},e=function(a){return document.getElementById(F(a))},D=function(a){var b=e(F(a
));if(b==null)throw new Error("No element with id: "+a)},i=function(a,b,c){if(!a)return undefined;return c===undefined?a
.getAttribute(b):a.setAttribute(b,c)},j=function(a,d,c){if(!a)return undefined;var b=getComputedStyle(a)[d];return c?
parseFloat(b):b},k=function(b,a,c){a="data-"+a;return i(b,a,c)},m=function(a){a=a||{};for(var c=1;c<arguments.length;c+=
1){var b=arguments[c];if(b)for(var d in b)if(b.hasOwnProperty(d))a[d]=b[d]}return a},n=function(a,b){return a?a.
querySelector(b):undefined},y=function(a,b){return a?a.querySelectorAll(b):undefined},p=function(a,b){if(!a||!b)
return undefined;else if(a.classList)return a.classList.contains(b);else return new RegExp("(^| )"+b+"( |$)","gi").test(
a.className)},u=function(a){if(typeof a==="string")a=parseInt(a);return typeof a==="number"&&isFinite(a)},t=function(a){
return a&&Array.isArray(a)},r=function(b,a){return t(a)&&a.indexOf(b)!==-1},v=function(b,a){return!r(b,a)},z=function(a,
c){if(a){var b=a.textContent;if(c===undefined)return b!==undefined?b:a.innerText;else if(b!==undefined)a.textContent=c;
else a.innerText=c}return undefined},h=function(a,b){if(a)if(a.classList)a.classList.add(b);else a.className+=" "+b},x=
function(a,b){if(a)if(a.classList)a.classList.remove(b);else a.className=a.className.replace(new RegExp("(^|\\b)"+b.
split(" ").join("|")+"(\\b|$)","gi")," ")},A=function(a){a=a||window;if(a.innerWidth!=null)return{width:a.innerWidth,
height:a.innerHeight};if(!a.document)return{width:0,height:0};var b=a.document;if(document.compatMode==="CSS1Compat")
return{width:b.documentElement.clientWidth,height:b.documentElement.clientHeight};return{width:b.body.clientWidth,height
:b.body.clientHeight}},l=function(b){if(!b)return A(b);var a=b.getBoundingClientRect(),f=a.width||a.right-a.left,c=a.
height||a.bottom-a.top,d=a.left||0;return{width:f,height:c,left:d}},q=function(a){return l(a).height||j(a,"height")},C=
function(a){return l(a).width||j(a,"width")},o=function(a){var b=0,c=0;if(a!==undefined&&a!==null){b=a.offsetLeft;c=a.
offsetTop}return{x:b,y:c}},B=function(d,c,b){var a=document.createEvent("HTMLEvents");if(b===undefined)a.initEvent(c,
true,false);else if(window.CustomEvent)a=new CustomEvent(c,{detail:b});else{a=document.createEvent("CustomEvent");a.
initCustomEvent(c,true,true,b)}d.dispatchEvent(a)},G=function(a){a=a||window;if(a.pageXOffset!=null)return{left:a.
pageXOffset,top:a.pageYOffset};if(!a.document)return{left:0,top:0};var b=a.document;if(document.compatMode===
"CSS1Compat")return{left:b.documentElement.scrollLeft,top:b.documentElement.scrollTop};return{left:b.body.scrollLeft,top
:b.body.scrollTop}},E=function(a){return G(a).top},w=function(a){a=a||window;if(a===window){var c=document.
documentElement.offsetHeight,d=document.documentElement.offsetWidth,f=window.innerHeight,g=window.innerWidth;return{top:
c-f,left:d-g}}var b=a.getBoundingClientRect();return{top:b.top+document.body.scrollTop,left:b.left+document.body.
scrollLeft}},s=function(a,b){return(a.matches||a.matchesSelector||a.msMatchesSelector||a.mozMatchesSelector||a.
webkitMatchesSelector||a.oMatchesSelector).call(a,b)};return{$:e,$$:D,attr:i,css:j,data:k,extend:m,find:n,select:y,
hasClass:p,isNumber:u,isArray:t,inArray:r,notInArray:v,text:z,addClass:h,removeClass:x,getContext:e,getRelativePosition:
o,dimensions:l,viewport:A,height:q,width:C,offset:w,scrollTop:E,is:s,trigger:B}})();var whenReady=(function(){var c=[],d
=false;function a(e){if(d)return;if(e.type==="readystatechange"&&document.readyState!=="complete")return;for(var b=0;b<c
.length;b++)c[b].call(document);d=true;c=null}if(document.addEventListener){document.addEventListener("DOMContentLoaded"
,a,false);document.addEventListener("readystatechange",a,false);window.addEventListener("load",a,false)}else if(document
.attachEvent){document.attachEvent("onreadystatechange",a);document.attachEvent("onload",a)}return function f(b){if(d)b.
call(document);else c.push(b)}})();var themoneyconverter;if(!themoneyconverter)themoneyconverter={};themoneyconverter.
numberformat=(function(o){var l=function(a){return Math.LOG10E*Math.log(a)},q=function(h,e,d){var c=e.dec,f=e.format.
substring(e.format.lastIndexOf(e.dec)+1),g=!isNaN(d)?d>0?d:0:f.length,b=new String(h.toFixed(g));b=b.substring(b.
lastIndexOf(".")+1);if(isNaN(d)){var a;for(a=0;a<g;a+=1)if(f.charAt(a)==="#"&&b.charAt(a)!=="0"){c+=b.charAt(a);break}
else if(f.charAt(a)==="0")c+=b.charAt(a)}else if(d>0)c+=b;else c="";return c},r=function(i,d,a){var b="",f=a===-1?d.
format:d.format.substring(0,a);a=f.lastIndexOf(d.group);var h=a!==-1?f.length-a-1:9999,g=new String(i),e=0,c;for(c=g.
length-1;c>-1;c-=1){b=g.charAt(c)+b;e++;if(e===h&&c!==0){b=d.group+b;e=0}}return b},m=function(a,b,h){var c="",f=a%1,d=b
.format.indexOf(b.dec);if(d>-1)c=a+"x"==="1x"?"":q(f,b,h);else a=Math.round(a);var e=a<0?Math.ceil(a):Math.floor(a),g=e
===0?"0":r(e,b,d);return g+c},p=function(c,a){var b=a.group==="."?"\\.":a.group,d=new RegExp(b,"g"),e=c.replace(d,"").
replace(a.dec,".").replace(a.neg,"-").replace(/\s/g,"");return new Number(e)},k=function(f,a){var h="0#-,.",e="",d="",b;
for(b=0;b<a.format.length;b+=1)if(h.indexOf(a.format.charAt(b))===-1)e=e+a.format.charAt(b);else break;var c;for(c=a.
format.length-1;c>=0;c-=1)if(h.indexOf(a.format.charAt(c))===-1)d=a.format.charAt(c)+d;else break;a.format=a.format.
substring(e.length);a.format=a.format.substring(0,a.format.length-d.length);var g=!f?0:p(f,a);return d==="%"?g*100:g},j=
function(a){var b=".",d=",",e="-",c="#,###.00";if(o.notInArray(a,["us","en","ae","eg","il","jp","sk","th","cn","zh","hk"
,"tw","au","ca","gb","in"]))if(o.inArray(a,["de","vn","es","dk","at","gr","br"])){b=",";d=".";c="#.###,00"}else if(o.
inArray(a,["cz","fr","fi","ru","se"])){d=" ";b=",";c="# ###,00"}else if(a==="ch"){d="'";b=".";c="#'###,00"}return{dec:b,
group:d,neg:e,format:c,locale:a}};return{fc:j,lsn:k,nls:m,log10:l}})(themoneyconverter);var themoneyconverter;if(!
themoneyconverter)themoneyconverter={};themoneyconverter.website=(function(j){var i="en",g=function(c){var a=new Date(c)
,b=new Date(Date.UTC(a.getFullYear(),a.getMonth(),a.getDate(),a.getHours(),a.getMinutes(),a.getSeconds(),a.
getMilliseconds()));return b.toString()!=="Invalid Date"?b.toLocaleDateString().replace(",","").replace("Wednesday",
"Wed")+" "+b.toLocaleTimeString():c.toString()},h=function(b){j.select(document.body,b).forEach(function(a){a.innerHTML=
g(j.attr(a,"datetime"))});return true},e=function(a){return a&&a.length>=2?a.substr(a.length-2,2).toLowerCase():i},f=
function(){var a=j.find(document,"html");return e(j.attr(a,"lang"))};return{utcToLocalTime:h,toLocalTimestamp:g,
extractLocale:e,getLocale:f,defaultLocale:i}})(themoneyconverter);var themoneyconverter;if(!themoneyconverter)
themoneyconverter={};themoneyconverter.converter=(function(g,m){var i=function(a,b){return!isNaN(a)&&!isNaN(b)?Math.
round(a*b*100)/100:0},j=function(d,e,h){var f=1;if(d&&e){var b=g.fc(h),a=g.lsn(d,b),c=g.lsn(e,b);if(a&&c&&parseFloat(a)>
0)f=c/a}return f},n=function(a){return a===229||a===8||a===9||a===44||a===46||a===110||a===188||a===190||a>=37&&a<=40||a
>=48&&a<=57||a>=96&&a<=105},k=function(a){var c=a.charCode||a.keyCode||a.k||a.detail.keyCode||0,b=n(c);if(!b)if(a.
preventDefault)a.preventDefault();if(a.returnValue)a.returnValue=b;return b},l=function(d,f,a,c,e){var b=g.fc(e);return!
isNaN(a)&&!isNaN(c)?g.nls(a,b)+" "+d+" = "+g.nls(c,b)+" "+f:""};return{nf:g,web:m,onKeydown:k,getCrossRate:j,
convertAmount:i,resultString:l}})(themoneyconverter.numberformat,themoneyconverter.website);var themoneyconverter;if(!
themoneyconverter)themoneyconverter={};themoneyconverter.mini=(function(a,m){var r="@";if(!a.hasOwnProperty("token"))a.
token=undefined;var p=function(i,e,d){var h=a.converter.web.getLocale();if(!i||!e||!d)return undefined;var f=i.split(a.
tok),g=e.split(a.tok),b=m.nf.lsn(d,m.nf.fc(h));if(b<=0)b=1;var c=a.tok!=="^"?0:1,j=m.convertAmount(b,m.getCrossRate(f[c]
,g[c],m.web.defaultLocale));return{f:f[c===0?1:0],t:g[c===0?1:0],a:b,r:j,l:h}},q=function(c){var e=a.$("#dfm"),g=a.$(
"#dtm"),i=e.value,f=a.find(e,"option[value"+(a.tok!=="^"?"$":a.tok)+"="+g.value+"]").value,b=p(i,f,c);if(b!=undefined){
var h=a.find(document,"output");a.text(h,m.resultString(b.f,b.t,b.a,b.r,b.l));var d="https://themoneyconverter.com/"+(b.
l==="en"?"":b.l==="zh"?"CN/":b.l.toUpperCase()+"/")+b.f+"/"+b.t;if(c&&c>1)d=d+"?amount="+c;a.attr(a.$("#lrm"),"href",
encodeURI(d))}},s=function(b){if(m.onKeydown(b)){var c=a.find(document,"input");q(c.value||"1")}return false},u=function
(){var b=a.find(document,"input");q(b.value||"1");return false},t=function(){var b=a.find(document,"input"),d=b.value;
if(d==="")return;setTimeout(function(){var c=b.value;if(c==="")q("1")},1)},l=function(){var e=a.find(document,"main");a.
tok=a.data(e,"value")||r;var d=a.$("#dfm");if(d)d.addEventListener("change",u,false);var c=a.$("#dtm");if(c)c.
addEventListener("change",u,false);var b=a.find(document,"input");if(b){b.addEventListener("keydown",m.onKeydown,false);
b.addEventListener("keyup",s,false);b.addEventListener("mouseup",t,false);q(b.value||"1")}};return{initialize:l}})(
themoneyconverter,themoneyconverter.converter);whenReady(themoneyconverter.mini.initialize)