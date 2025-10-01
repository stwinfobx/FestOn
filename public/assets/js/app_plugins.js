
/**
 * jQuery Exists
 */
jQuery.fn.exists = function (){ return jQuery(this).length > 0 ? true : false; };


/**
 * jQuery clearForm
 */
!function(e){e.fn.extend({clearForm:function(){e(this).find(":input").each(function(){if(!e(this).hasClass("excessao"))switch(this.type){case"hidden":case"password":case"select-multiple":case"select-one":case"text":case"email":case"textarea":e(this).val("");break;case"checkbox":case"radio":this.checked=!1}})}})}(jQuery);


/*
 * jQuery Templates : v1.0.0 : http://github.com/jquery/jquery-tmpl
 */
!function(t){function e(e,n,l,a){var r={data:a||0===a||a===!1?a:n?n.data:{},_wrap:n?n._wrap:null,tmpl:null,parent:n||null,nodes:[],calls:u,nest:c,wrap:m,html:f,update:s};return e&&t.extend(r,e,{nodes:[],parent:n}),l&&(r.tmpl=l,r._ctnt=r._ctnt||r.tmpl(t,r),r.key=++w,(T.length?g:y)[w]=r),r}function n(e,a,r){var p,i=r?t.map(r,function(t){return"string"==typeof t?e.key?t.replace(/(<\w+)(?=[\s>])(?![^>]*_tmplitem)([^>]*)/g,"$1 "+_+'="'+e.key+'" $2'):t:n(t,e,t._ctnt)}):e;return a?i:(i=i.join(""),i.replace(/^\s*([^<\s][^<]*)?(<[\w\W]+>)([^>]*[^>\s])?\s*$/,function(e,n,a,r){p=t(a).get(),o(p),n&&(p=l(n).concat(p)),r&&(p=p.concat(l(r)))}),p?p:l(i))}function l(e){var n=document.createElement("div");return n.innerHTML=e,t.makeArray(n.childNodes)}function a(e){return new Function("jQuery","$item","var $=jQuery,call,__=[],$data=$item.data;with($data){__.push('"+t.trim(e).replace(/([\\'])/g,"\\$1").replace(/[\r\t\n]/g," ").replace(/\$\{([^\}]*)\}/g,"{{= $1}}").replace(/\{\{(\/?)(\w+|.)(?:\(((?:[^\}]|\}(?!\}))*?)?\))?(?:\s+(.*?)?)?(\(((?:[^\}]|\}(?!\}))*?)\))?\s*\}\}/g,function(e,n,l,a,r,i,o){var u,c,m,f=t.tmpl.tag[l];if(!f)throw"Unknown template tag: "+l;return u=f._default||[],i&&!/\w$/.test(r)&&(r+=i,i=""),r?(r=p(r),o=o?","+p(o)+")":i?")":"",c=i?r.indexOf(".")>-1?r+p(i):"("+r+").call($item"+o:r,m=i?c:"(typeof("+r+")==='function'?("+r+").call($item):("+r+"))"):m=c=u.$1||"null",a=p(a),"');"+f[n?"close":"open"].split("$notnull_1").join(r?"typeof("+r+")!=='undefined' && ("+r+")!=null":"true").split("$1a").join(m).split("$1").join(c).split("$2").join(a||u.$2||"")+"__.push('"})+"');}return __;")}function r(e,l){e._wrap=n(e,!0,t.isArray(l)?l:[h.test(l)?l:t(l).html()]).join("")}function p(t){return t?t.replace(/\\'/g,"'").replace(/\\\\/g,"\\"):null}function i(t){var e=document.createElement("div");return e.appendChild(t.cloneNode(!0)),e.innerHTML}function o(n){function l(n){function l(t){t+=u,p=c[t]=c[t]||e(p,y[p.parent.key+u]||p.parent)}var a,r,p,i,o=n;if(i=n.getAttribute(_)){for(;o.parentNode&&1===(o=o.parentNode).nodeType&&!(a=o.getAttribute(_)););a!==i&&(o=o.parentNode?11===o.nodeType?0:o.getAttribute(_)||0:0,(p=y[i])||(p=g[i],p=e(p,y[o]||g[o]),p.key=++w,y[w]=p),k&&l(i)),n.removeAttribute(_)}else k&&(p=t.data(n,"tmplItem"))&&(l(p.key),y[p.key]=p,o=t.data(n.parentNode,"tmplItem"),o=o?o.key:0);if(p){for(r=p;r&&r.key!=o;)r.nodes.push(n),r=r.parent;delete p._ctnt,delete p._wrap,t.data(n,"tmplItem",p)}}var a,r,p,i,o,u="_"+k,c={};for(p=0,i=n.length;i>p;p++)if(1===(a=n[p]).nodeType){for(r=a.getElementsByTagName("*"),o=r.length-1;o>=0;o--)l(r[o]);l(a)}}function u(t,e,n,l){return t?void T.push({_:t,tmpl:e,item:this,data:n,options:l}):T.pop()}function c(e,n,l){return t.tmpl(t.template(e),n,l,this)}function m(e,n){var l=e.options||{};return l.wrapped=n,t.tmpl(t.template(e.tmpl),e.data,l,e.item)}function f(e,n){var l=this._wrap;return t.map(t(t.isArray(l)?l.join(""):l).filter(e||"*"),function(t){return n?t.innerText||t.textContent:t.outerHTML||i(t)})}function s(){var e=this.nodes;t.tmpl(null,null,null,this).insertBefore(e[0]),t(e).remove()}var d,$=t.fn.domManip,_="_tmplitem",h=/^[^<]*(<[\w\W]+>)[^>]*$|\{\{\! /,y={},g={},v={key:0,data:{}},w=0,k=0,T=[];t.each({appendTo:"append",prependTo:"prepend",insertBefore:"before",insertAfter:"after",replaceAll:"replaceWith"},function(e,n){t.fn[e]=function(l){var a,r,p,i,o=[],u=t(l),c=1===this.length&&this[0].parentNode;if(d=y||{},c&&11===c.nodeType&&1===c.childNodes.length&&1===u.length)u[n](this[0]),o=this;else{for(r=0,p=u.length;p>r;r++)k=r,a=(r>0?this.clone(!0):this).get(),t(u[r])[n](a),o=o.concat(a);k=0,o=this.pushStack(o,e,u.selector)}return i=d,d=null,t.tmpl.complete(i),o}}),t.fn.extend({tmpl:function(e,n,l){return t.tmpl(this[0],e,n,l)},tmplItem:function(){return t.tmplItem(this[0])},template:function(e){return t.template(e,this[0])},domManip:function(e,n,l){if(e[0]&&t.isArray(e[0])){for(var a,r=t.makeArray(arguments),p=e[0],i=p.length,o=0;i>o&&!(a=t.data(p[o++],"tmplItem")););a&&k&&(r[2]=function(e){t.tmpl.afterManip(this,e,l)}),$.apply(this,r)}else $.apply(this,arguments);return k=0,d||t.tmpl.complete(y),this}}),t.extend({tmpl:function(l,a,p,i){var o,u=!i;if(u)i=v,l=t.template[l]||t.template(null,l),g={};else if(!l)return l=i.tmpl,y[i.key]=i,i.nodes=[],i.wrapped&&r(i,i.wrapped),t(n(i,null,i.tmpl(t,i)));return l?("function"==typeof a&&(a=a.call(i||{})),p&&p.wrapped&&r(p,p.wrapped),o=t.isArray(a)?t.map(a,function(t){return t?e(p,i,l,t):null}):[e(p,i,l,a)],u?t(n(i,null,o)):o):[]},tmplItem:function(e){var n;for(e instanceof t&&(e=e[0]);e&&1===e.nodeType&&!(n=t.data(e,"tmplItem"))&&(e=e.parentNode););return n||v},template:function(e,n){return n?("string"==typeof n?n=a(n):n instanceof t&&(n=n[0]||{}),n.nodeType&&(n=t.data(n,"tmpl")||t.data(n,"tmpl",a(n.innerHTML))),"string"==typeof e?t.template[e]=n:n):e?"string"!=typeof e?t.template(null,e):t.template[e]||t.template(null,h.test(e)?e:t(e)):null},encode:function(t){return(""+t).split("<").join("&lt;").split(">").join("&gt;").split('"').join("&#34;").split("'").join("&#39;")}}),t.extend(t.tmpl,{tag:{tmpl:{_default:{$2:"null"},open:"if($notnull_1){__=__.concat($item.nest($1,$2));}"},wrap:{_default:{$2:"null"},open:"$item.calls(__,$1,$2);__=[];",close:"call=$item.calls();__=call._.concat($item.wrap(call,__));"},each:{_default:{$2:"$index, $value"},open:"if($notnull_1){$.each($1a,function($2){with(this){",close:"}});}"},"if":{open:"if(($notnull_1) && $1a){",close:"}"},"else":{_default:{$1:"true"},open:"}else if(($notnull_1) && $1a){"},html:{open:"if($notnull_1){__.push($1a);}"},"=":{_default:{$1:"$data"},open:"if($notnull_1){__.push($.encode($1a));}"},"!":{open:""}},complete:function(){y={}},afterManip:function(e,n,l){var a=11===n.nodeType?t.makeArray(n.childNodes):1===n.nodeType?[n]:[];l.call(e,n),o(a),k++}})}(jQuery);


/*
 * TouchMouseEvent
 */
(function(){TouchMouseEvent={DOWN:"touchmousedown",UP:"touchmouseup",MOVE:"touchmousemove"};var e=function(e){var t;switch(e.type){case"mousedown":t=TouchMouseEvent.DOWN;break;case"mouseup":t=TouchMouseEvent.UP;break;case"mousemove":t=TouchMouseEvent.MOVE;break;default:return}var r=n(t,e,e.pageX,e.pageY);$(e.target).trigger(r)};var t=function(e){var t;switch(e.type){case"touchstart":t=TouchMouseEvent.DOWN;break;case"touchend":t=TouchMouseEvent.UP;break;case"touchmove":t=TouchMouseEvent.MOVE;break;default:return}var r=e.originalEvent.touches[0];var i;if(t==TouchMouseEvent.UP)i=n(t,e,null,null);else i=n(t,e,r.pageX,r.pageY);$(e.target).trigger(i)};var n=function(e,t,n,r){return $.Event(e,{pageX:n,pageY:r,originalEvent:t})};var r=$(document);if("ontouchstart"in window){r.on("touchstart",t);r.on("touchmove",t);r.on("touchend",t)}else{r.on("mousedown",e);r.on("mouseup",e);r.on("mousemove",e)}})()



let fct_mover_para_topo = function(p, callback){
	let $posicao = $('#scroll-top').offset().top;
	$('html, body').animate({
		scrollTop: $posicao
	}, 500);
}



$(document).ready(function ($) {
  'use strict';

	$(document).on('keypress', 'input.only-number', function(e) {
		var $this = $(this);
		var key = (window.event)?event.keyCode:e.which;
		var dataAcceptDot = $this.data('accept-dot');
		var dataAcceptComma = $this.data('accept-comma');
		var acceptDot = (typeof dataAcceptDot !== 'undefined' && (dataAcceptDot == true || dataAcceptDot == 1)?true:false);
		var acceptComma = (typeof dataAcceptComma !== 'undefined' && (dataAcceptComma == true || dataAcceptComma == 1)?true:false);

		if((key > 47 && key < 58)
		|| (key == 46 && acceptDot)
		|| (key == 44 && acceptComma)) {
			return true;
		} else {
			return (key == 8 || key == 0)?true:false;
		}
	});

	//var SPMaskBehavior = function (val) {
	//	return val.replace(/\D/g, '').length >= 11 ? '(00) 00000-0000' : '(00) 0000-00009';
	//},
	//spOptions = {
	//	onKeyPress: function (val, e, field, options) {
	//		field.mask(SPMaskBehavior.apply({}, arguments), options);
	//	}
	//};

	//var telMaskBehavior = function (val) {
	//	return val.replace(/\D/g, '').length === 11 ? '00000-0000' : '0000-00009';
	//},
	//telOptions = {
	//	onKeyPress: function (val, e, field, options) {
	//		field.mask(telMaskBehavior.apply({}, arguments), options);
	//	}
	//};

	//$('.mask-voucher').mask('SS.AAAA.AAAA.AAAA-000', {clearIfNotMatch: true});




	var SPMaskBehavior = function (val) {
		return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
	},
	spOptions = {
		placeholder: "(__) ____-____",
		onKeyPress: function(val, e, field, options) {
			field.mask(SPMaskBehavior.apply({}, arguments), options);
		}
	};
	$('.mask-phone').mask(SPMaskBehavior, spOptions);
	//$(".mask-cpf").mask('000.000.000-00', {placeholder: "___.___.___-__", clearIfNotMatch: true});
	$(".mask-cpf").mask('000.000.000-00', {placeholder: "___.___.___-__", clearIfNotMatch: true});
	$(".mask-date").mask('00/00/0000', {placeholder: "dd/mm/aaaa", clearIfNotMatch: true});
	$(".mask-cnpj").mask('00.000.000/0000-00', {placeholder: "__.___.___/____-__",clearIfNotMatch: true});
	$(".mask-cep").mask('00000-000', {placeholder: "_____-__", clearIfNotMatch: true});
	
	$(".mask-hours").mask('00:00:00', {placeholder: "00:00:00", clearIfNotMatch: true});
	//$(".mask-minuto").mask('00:00:00', {placeholder: "00:00:00", clearIfNotMatch: true});
	$(".mask-minuto").mask('00:00', {placeholder: "00:00", clearIfNotMatch: true});








	$('.mask-money').mask('#.##0,00', {reverse: true});

	//$(".mask-postcode").mask('00000-000', {placeholder: "_____-___",clearIfNotMatch: true});
	////$(".mask-phone").mask(SPMaskBehavior, {clearIfNotMatch: true});
	////$(".mask-phone").mask(SPMaskBehavior, {clearIfNotMatch: true});

	//$(".mask-phone-fixo").mask('0000-0000', {clearIfNotMatch: true});
	//$(".mask-phone-cel").mask('00000-0000', {clearIfNotMatch: true});

	////$(".cf7tel").mask(telMaskBehavior, {clearIfNotMatch: true});
	////$(".cf7tel").mask(SPMaskBehavior, {clearIfNotMatch: true});
	////$(".cf7ddd").mask('00', {clearIfNotMatch: true});

	//$(".mask-cpf").mask('000.000.000-00', {placeholder: "___.___.___-__",clearIfNotMatch: true});
	//$(".mask-cnpj").mask('00.000.000/0000-00', {placeholder: "__.___.___/____-__",clearIfNotMatch: true});
	//// xx. xxx. xxx/0001-??

	//$(".mask-date").mask('00/00/0000', {placeholder: "__/__/____", clearIfNotMatch: true});
	//$(".mask-date").mask('00/00/0000', {placeholder: "dd/mm/yyyy", clearIfNotMatch: true});

	//$(".mask-hours").mask('00:00:00', {placeholder: "00:00:00", clearIfNotMatch: true});

	//$(".mask-minuto").mask('00:00:00', {placeholder: "00:00:00", clearIfNotMatch: true});

	////$("input[name='cep']").mask('00000-000', {clearIfNotMatch: true});
	////$(".mask-cep").mask('00000-000', {clearIfNotMatch: true});

	//$(".mask-cep").mask('00000-000', {placeholder: "_____-__", clearIfNotMatch: true});


	//var maskOptions = {
	//	placeholder: "(__) ____-____",
	//	onKeyPress: function(cep, e, field, options) {
	//		// Use an optional digit (9) at the end to trigger the change
	//		var masks = ["(00) 0000-00009", "(00) 00000-0000"],
	//		digits = cep.replace(/[^0-9]/g, "").length,
	//		// When you receive a value for the optional parameter, then you need to swap
	//		// to the new format
	//		mask = digits <= 10 ? masks[0] : masks[1];
	//		$(".mask-phone").mask(mask, options);
	//	}
	//};
	//$(".mask-phone_old").mask("(00) 90000-0000", maskOptions);


	var SPMaskBehavior = function (val) {
		return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
	},
	spOptions = {
		onKeyPress: function(val, e, field, options) {
			field.mask(SPMaskBehavior.apply({}, arguments), options);
		}
	};
	$('.mask-phone').mask(SPMaskBehavior, spOptions);


	$(document).on('click', '.togglePassword2', function (e) {
		let $field = $(this).closest(".input-group").find('.fieldPassword');
		let $type = $field.attr("type");
		if( $field.attr("type") === "password" ){
			$(this).removeClass("fa-eye");
			$(this).addClass("fa-eye-slash");
			$field.attr("type", 'text');	
		}else{
			$(this).removeClass("fa-eye-slash");
			$(this).addClass("fa-eye");
			$field.attr("type", 'password');
		}
	});	
});