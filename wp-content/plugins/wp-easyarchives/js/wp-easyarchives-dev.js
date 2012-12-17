/**
 * @author mg12
 * @update 2010/11/11
 * @website http://www.neoease.com/
 */

EasyArchives = function() {
	this.param = aeGlobal;

	this.config = {
		containerId			:'easy-archives',
		filterId			:'ea-filter',
		yearId				:'ea-year-selector',
		authorId			:'ea-author-selector',
		expandButtonClass	:'ea-expand',
		collapseButtonClass	:'ea-collapse',
		expandAllButtonId	:'ea-expand-all',
		collapseAllButtonId	:'ea-collapse-all',
		openWrapClass		:'ea-open',
		closedWrapClass		:'ea-closed',
		monthlyItemClass	:'ea-month',
		yearAttrName		:'data-year',
		loadingClass		:'ea-loading'
	};
};

EasyArchives.prototype = {

	init: function(config) {
		this.config = config || this.config;

		var authorSelected = document.getElementById(this.config.authorId);
		if(authorSelected) {
			authorSelected.selectedIndex = 0;
		}

		var yearSelected = document.getElementById(this.config.yearId);
		if(yearSelected) {
			yearSelected.selectedIndex = 0;
		}

		this._bindAction({_self:this});
	},

	_bindAction: function(args) {
		var _self = args._self;
		var container = document.getElementById(_self.config.containerId);

		var expandButtons = _self._getElementsByClassName(_self.config.expandButtonClass, 'a', container);
		for(var i=0,len=expandButtons.length; i<len; i++) {
			_self._addListener(expandButtons[i], 'click', function(ev){
				var button = ev.target || ev.srcElement;
				_self._toggle(button);
			});
		}

		var collapseButtons = _self._getElementsByClassName(_self.config.collapseButtonClass, 'a', container);
		for(var i=0,len=collapseButtons.length; i<len; i++) {
			_self._addListener(collapseButtons[i], 'click', function(ev){
				var button = ev.target || ev.srcElement;
				_self._toggle(button);
			});
		}

		var expandAllButton = document.getElementById(_self.config.expandAllButtonId);
		if(expandAllButton) {
			_self._addListener(expandAllButton, 'click', function(ev){
				_self._expandAll();
			});
		}

		var collapseAllButton = document.getElementById(_self.config.collapseAllButtonId);
		if(collapseAllButton) {
			_self._addListener(collapseAllButton, 'click', function(ev){
				_self._collapseAll();
			});
		}

		var yearButton = document.getElementById(_self.config.yearId);
		if(yearButton) {
			_self._addListener(yearButton, 'change', function(ev){
				var button = ev.target || ev.srcElement;
				_self._changeYear({_self:_self, year:button.value});
			});
		}

		var authorButton = document.getElementById(_self.config.authorId);
		if(authorButton) {
			_self._addListener(authorButton, 'change', function(ev){
				yearButton = document.getElementById(_self.config.yearId);
				var year = '';
				if(yearButton) {
					year = yearButton.value;
				}
				var button = ev.target || ev.srcElement;
				var authorId = button.value;
				_self._changeAuthor({year:year, authorId:authorId, _self:_self});
			});
		}

		if(_self.param.external) {
			_self._initLinks({wrap:container, _self:_self});
		}
	},

	_changeAuthor: function(args) {
		var _self = args._self;
		var year = args.year;
		var authorId = args.authorId;

		var url = _self.param.serverUrl;
		url += '?action=ea-monthly-ajax';
		url += '&year=' + year;
		url += '&author=' + authorId;
		url += '&_=' + Date.parse(new Date());

		_self._ajax('GET', url, {
			beforeSend: function() {
				_self._changeCursor('wait');
				_self._loading();
			},
			success: function(data) {
				_self._build(data);
				_self._changeCursor('auto');
			}
		});
	},

	_changeYear: function(args) {
		var _self = args._self;
		var year = args.year;

		var items = _self._getElementsByClassName(_self.config.monthlyItemClass, 'div', document.getElementById(_self.config.containerId));

		for(var i=0,len=items.length; i<len; i++) {
			var item = items[i];

			// select 'all' or select a year
			if(year.length <= 0 || item.getAttribute(_self.config.yearAttrName) === year) {

				// change the status by mode (all / none)
				if(_self.param.mode === 'none') {
					var collapseButtons = _self._getElementsByClassName(_self.config.collapseButtonClass, 'a', item);
					if(collapseButtons && collapseButtons[0]) {
						_self._toggle(collapseButtons[0]);
					}
				} else {
					var expandButtons = _self._getElementsByClassName(_self.config.expandButtonClass, 'a', item);
					if(expandButtons && expandButtons[0]) {
						_self._toggle(expandButtons[0]);
					}
				}

				_self._show(item);

			} else {
				_self._hide(item);
			}

		}
	},

	_build: function(html) {
		var container = document.getElementById(this.config.containerId);
		if(container) {
			container.innerHTML = html;
		}
		this._bindAction({_self:this});
	},

	_loading: function() {
		var filter = document.getElementById(this.config.filterId);
		if(filter) {
			filter.innerHTML = '<span class="' + this.config.loadingClass + '">' + this.param.loadingText + '...<span>';
		}
	},

	_changeCursor: function(status) {
		document.getElementById(this.config.containerId).style.cursor = status;
	},

	_toggle: function(button) {
		var parent = button.parentNode;
		var dailyArchives = parent.nextSibling;

		if (button.className === this.config.collapseButtonClass) {
			button.className = this.config.expandButtonClass;
			dailyArchives.className = this.config.closedWrapClass;

		} else {
			button.className = this.config.collapseButtonClass;
			dailyArchives.className = this.config.openWrapClass;
		}
	},

	_expandAll: function() {
		var elements = this._getElementsByClassName(this.config.expandButtonClass, 'a', document.getElementById(this.config.containerId));
		for (var i=0,len=elements.length; i<len; i++) {
			this._toggle(elements[i]);
		}
	},

	_collapseAll: function() {
		var elements = this._getElementsByClassName(this.config.collapseButtonClass, 'a', document.getElementById(this.config.containerId));
		for (var i=0,len=elements.length; i<len; i++) {
			this._toggle(elements[i]);
		}
	},

	_initLinks: function(args) {
		var _self = args._self;
		var wrap = args.wrap;

		var links = wrap.getElementsByTagName('a');
		for(var i=0; i<links.length; i++) {
			var link = links[i];
			if(link.href) {
				_self._addListener(link, 'click', _self._bindPopup, {link:link});
			}
		}
	},

	_bindPopup: function(ev, args) {
		window.open(args.link.href);

		if(ev.preventDefault) {
			ev.preventDefault();
		} else {
			ev.returnValue = false;
		}
	},

	_show: function(element) {
		element.style.display = '';
	},

	_hide: function(element) {
		element.style.display = 'none';
	},

	_getElementsByClassName: function(className, tag, parent) {
		var allTags = (tag === '*' && parent.all) ? parent.all : parent.getElementsByTagName(tag);
		var matchingElements = [];

		className = className.replace(/\-/g, '\\-');
		var regex = new RegExp('(^|\\s)' + className + '(\\s|$)');

		var element;
		for (var i = 0; i < allTags.length; i++) {
			element = allTags[i];
			if (regex.test(element.className)) {
				matchingElements.push(element);
			}
		}

		return matchingElements;
	},

	_getXmlHttpObject: function() {
		try {
			xmlHttp = new XMLHttpRequest();
		} catch(e) {
			try {
				xmlHttp = new ActiveXObject('Msxml2.XMLHTTP');
			} catch(e) {
				xmlHttp = new ActiveXObject('Microsoft.XMLHTTP');
			}
		}

		return xmlHttp;
	},

	_ajax: function(type, url, actions) {
		var _self = this;
		var xmlHttp = _self._getXmlHttpObject();

		xmlHttp.onreadystatechange = function(ev){_self._callback(xmlHttp, actions);};
		xmlHttp.open(type, url, true);
		xmlHttp.setRequestHeader('Content-type', 'charset=UTF-8');
		xmlHttp.send(null);
	},

	_callback: function(xmlHttp, actions) {
		if (actions.beforeSend && xmlHttp.readyState === 1) {
			actions.beforeSend();
		}
		if (actions.success && (xmlHttp.readyState === 4 || xmlHttp.readyState === 'complete')) {
			actions.success(xmlHttp.responseText);
		}
	},

	_addListener: function(node, type, listener, obj) {
		var param = obj || {};

		if(node.addEventListener) {
			node.addEventListener(type, function(ev){listener(ev, param);}, false);
			return true;
		} else if(node.attachEvent) {
			node['e' + type + listener] = listener;
			node[type + listener] = function() {
				node['e' + type + listener](window.event, param);
			};
			node.attachEvent('on' + type, node[type + listener]);
			return true;
		}
		return false;
	}
};

if (document.addEventListener) {
	document.addEventListener("DOMContentLoaded", function(){(new EasyArchives()).init();}, false);

} else if (/MSIE/i.test(navigator.userAgent)) {
	document.write('<script id="__ie_onload_for_wp_easyarichives" defer src="javascript:void(0)"></script>');
	var script = document.getElementById('__ie_onload_for_wp_easyarichives');
	script.onreadystatechange = function() {
		if (this.readyState === 'complete') {
			(new EasyArchives()).init();
		}
	};

} else if (/WebKit/i.test(navigator.userAgent)) {
	var _timer = setInterval( function() {
		if (/loaded|complete/.test(document.readyState)) {
			clearInterval(_timer);
			(new EasyArchives()).init();
		}
	}, 10);

} else {
	window.onload = function(e) {
		(new EasyArchives()).init();
	};
}