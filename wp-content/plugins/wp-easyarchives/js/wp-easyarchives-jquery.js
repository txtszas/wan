/**
 * @author mg12
 * @update 2010/10/09
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

		jQuery('#' + this.config.authorId).attr('selectedIndex', '0');
		jQuery('#' + this.config.yearId).attr('selectedIndex', '0');

		this._bindAction({_self:this});
	},

	_bindAction: function(args) {
		var _self = args._self;
		var container = jQuery('#' + _self.config.containerId);

		container.find('.' + _self.config.expandButtonClass).click(function() {
			_self._toggle(jQuery(this), true);
		});

		container.find('.' + _self.config.collapseButtonClass).click(function() {
			_self._toggle(jQuery(this), true);
		});

		jQuery('#' + _self.config.expandAllButtonId).click(function() {
			_self._expandAll();
		});

		jQuery('#' + _self.config.collapseAllButtonId).click(function() {
			_self._collapseAll();
		});

		jQuery('#' + _self.config.yearId).change(function() {
			_self._changeYear({_self:_self, year:jQuery(this).val()});
		});

		jQuery('#' + _self.config.authorId).change(function() {
			var year = jQuery('#' + _self.config.yearId).val();
			var authorId = jQuery(this).val();
			_self._changeAuthor({year:year, authorId:authorId, _self:_self});
		});

		if(_self.param.external) {
			_self._initLinks({wrap:container});
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

		jQuery.ajax({
			type		:'GET',
			url			:url,
			cache		:false,
			contentType	:'text/html; charset=utf-8',

			beforeSend: function(data){
				_self._changeCursor('wait');
				_self._loading();
			},
			success: function(data){
				_self._build(data);
				_self._changeCursor('auto');
			}
		});
	},

	_changeYear: function(args) {
		var _self = args._self;
		var year = args.year;

		jQuery('#' + _self.config.containerId + ' div.' + _self.config.monthlyItemClass).each(function() {
			var item = jQuery(this);

			// select 'all' or select a year
			if(year.length <= 0 || item.attr(_self.config.yearAttrName) === year) {

				// change the status by mode (all / none)
				if(_self.param.mode === 'none') {
					var collapseButton = item.find('a.' + _self.config.collapseButtonClass);
					_self._toggle(collapseButton, false);
				} else {
					var expandButton = item.find('a.' + _self.config.expandButtonClass);
					_self._toggle(expandButton, false);
				}

				item.show(0);

			} else {
				item.hide(0);
			}
		});
	},

	_build: function(html) {
		jQuery('#' + this.config.containerId).html(html);
		this._bindAction({_self:this});
	},

	_loading: function() {
		var filter = jQuery('#' + this.config.filterId);
		if(filter) {
			filter.html('<span class="' + this.config.loadingClass + '">' + this.param.loadingText + '...<span>');
		}
	},

	_changeCursor: function(status) {
		jQuery('#' + this.config.containerId).css('cursor', status);
	},

	_toggle: function(button, isEffect) {
		var _self = this;

		var duration = 0;
		if(isEffect) {
			duration = 400;
		}
		if (button.is('.' + _self.config.collapseButtonClass)) {	
			button.parent().next().hide(duration, function() {
				button.text('展开');
				button.removeClass(_self.config.collapseButtonClass).addClass(_self.config.expandButtonClass);
			}).removeClass().addClass(_self.config.closedWrapClass);
		} else {
			button.parent().next().show(duration, function() {
				button.text('折叠');
				button.removeClass(_self.config.expandButtonClass).addClass(_self.config.collapseButtonClass);
			}).removeClass().addClass(_self.config.openWrapClass);
		}
	},

	_expandAll: function() {
		var _self = this;
		jQuery('#' + _self.config.containerId + ' a.' + _self.config.expandButtonClass).each(function() {
			_self._toggle(jQuery(this), false);
		});
	},

	_collapseAll: function() {
		var _self = this;
		jQuery('#' + _self.config.containerId + ' a.' + _self.config.collapseButtonClass).each(function() {
			_self._toggle(jQuery(this), false);
		});
	},

	_initLinks: function(args) {
		var wrap = args.wrap;

		wrap.find('a[href]').click(function(){
			window.open(this.href);
			return false;
		});
	}
};

jQuery(document).ready(function() {
	(new EasyArchives()).init();
});
