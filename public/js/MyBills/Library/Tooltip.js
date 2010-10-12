var MyBills_Library_Tooltip = new Class({
	holderDiv: null,
	arrowDiv: null,
	contentDiv: null,
	timeout: null,
	
	options: {
		maxWidth: '200px',
		edgeOffset: 3,
		defaultPosition: 'top',
		delay: 400,
		enter: function(){},
		exit: function(){}
	},
	initialize: function(options) {		
		this.setOptions(options);
		
	 	if ($('tiptip_holder') == null){
	 		this.holderDiv = new Element('div', {
	 			id: 'tooltip_holder',
	 			styles: {
	 				'max-width': this.options.maxWidth
	 			}
	 		});
			this.contentDiv = new Element('div', {id: 'tooltip_content'});
			this.arrowDiv = new Element('div', {id: 'tooltip_arrow'});
			var tooltip_arrow_inner = new Element('div', {id:'tooltip_arrow_inner'});
			$$('body').grab(this.holderDiv.grab(this.contentDiv).grab(this.arrowDiv.grab(tooltip_arrow_inner), 'top'));
		} else {
			this.holderDiv = $('tiptip_holder');
			this.contentDiv = $('tiptip_content');
			this.arrowDiv = $('tiptip_arrow');
		}
	 	
	 	$$('*[title]').each(this.addEvents.bind(this));
	},
	addEvents: function(item) {
		if (item.getChildren().length > 0) {
			item.getChildren().each(this.addEvents.bind(this));
		}
 		item.addEvents({
 			blur: function(e) {
 				var i = e.target;
				if (i.retrieve('hasTitle', false) != false)
 					this.hide(e.target);
				i = i.getParent('[title]');
				if ((i != null) && (i.retrieve('hasTitle', false) != false))
					this.hide(i);
			}.bind(this),
 			focus: function(e) {
 				var i = e.target;
 				if (i.get('title') == null)
 					i = i.getParent('[title]');
 				if (i != null)
 					this.show(i);
 			}.bind(this),
 			mouseover: function(e) {
 				var i = e.target;
 				if (i.get('title') == null)
 					i = i.getParent('[title]');
 				if (i != null)
 					this.show(i);
 			}.bind(this),
 			mouseout: function(e) {
 				var i = e.target;
				if (i.retrieve('hasTitle', false) != false)
 					this.hide(e.target);
				i = i.getParent('[title]');
				if ((i != null) && (i.retrieve('hasTitle', false) != false))
					this.hide(i);
 			}.bind(this)
 		});
	},
	setOptions: function(options) {
		$extend(this.options, options);
	},
	setContent: function(content) {
		this.contentDiv.set('html', content);
		return this;
	},
	changeArrow: function(left, top) {
		this.arrowDiv.setStyles({
			'margin-left': left,
			'margin-top': top
		});
		return this;
	},
	changeHolder: function(left, top, cls) {
		this.holderDiv.setStyles({
			'margin-left': left,
			'margin-top': top
		}).set('class', 'tip' + cls);
		return this;
	},
	show: function(item) {		
		this.options.enter.call(this);
		this.setContent(item.get('title'));
		item.removeProperty('title');
		item.store('hasTitle', true);
		this.holderDiv.hide().removeProperty('class').setStyle('margin', '0');
		this.arrowDiv.removeProperty('style');
		
		var top = parseInt(item.getPosition().y);
		var left = parseInt(item.getPosition().x);
		var org_width = parseInt(item.getSize().x);
		var org_height = parseInt(item.getSize().y);
		
		this.holderDiv.show();
		var tip_w = this.holderDiv.getSize().x;
		var tip_h = this.holderDiv.getSize().y;
		this.holderDiv.hide();
		
		var w_compare = Math.round((org_width - tip_w) / 2);
		var h_compare = Math.round((org_height - tip_h) / 2);
		var marg_left = Math.round(left + w_compare);
		var marg_top = Math.round(top + org_height + this.options.edgeOffset);
		var t_class = '_' + this.options.defaultPosition;
		var arrow_top = '';
		var arrow_left = Math.round(tip_w - 12) / 2;
		
		var right_compare = (w_compare + left) < parseInt($(window).getScroll().x);
		var left_compare = (tip_w + left) > parseInt($(window).getSize().x);
		
		if ((right_compare && w_compare < 0)
				|| (t_class == '_right' && !left_compare) 
				|| (t_class == '_left' && left < (tip_w + this.options.edgeOffset + 5))) {
			t_class = '_right';
			arrow_top = Math.round(tip_h - 13) / 2;
			arrow_left = -12;
			marg_left = Math.round(left + org_width + this.options.edgeOffset);
			marg_top = Math.round(top + h_compare);
		} else if ((left_compare && w_compare < 0) 
				|| (t_class == '_left' && !right_compare)) {
			t_class = '_left';
			arrow_top = Math.round(tip_h - 13) / 2;
			arrow_left =  Math.round(tip_w);
			marg_left = Math.round(left - (tip_w + this.options.edgeOffset + 5));
			marg_top = Math.round(top + h_compare);
		}
		
		var top_compare = (top + org_height + this.options.edgeOffset + tip_h + 8) > parseInt($(window).getSize().y + $(window).getScroll().y);
		var bottom_compare = ((top + org_height) - (this.options.edgeOffset + tip_h + 8)) < 0;
		
		if (top_compare || (t_class == '_bottom' && top_compare) || (t_class == '_top' && !bottom_compare)) {
			if (t_class == '_top' || t_class == '_bottom') {
				t_class = '_top';
			} else {
				t_class = t_class+'_top';
			}
			arrow_top = tip_h;
			marg_top = Math.round(top - (tip_h + 5 + this.options.edgeOffset));
		} else if (bottom_compare | (t_class == '_top' && bottom_compare) || (t_class == '_bottom' && !top_compare)) {
			if (t_class == '_top' || t_class == '_bottom') {
				t_class = '_bottom';
			} else {
				t_class = t_class+'_bottom';
			}
			arrow_top = -12;						
			marg_top = Math.round(top + org_height + this.options.edgeOffset);
		}
	
		if (t_class == '_right_top' || t_class == '_left_top') {marg_top = marg_top + 5;}
		else if (t_class == '_right_bottom' || t_class == '_left_bottom') {marg_top = marg_top - 5;}
		if (t_class == '_left_top' || t_class == '_left_bottom') {marg_left = marg_left + 5;}
		
		this.changeArrow(arrow_left, arrow_top);
		this.changeHolder(marg_left, marg_top, t_class);
		
		if (this.timeout){ clearTimeout(this.timeout); }
		this.timeout = setTimeout(function(){ this.holderDiv.show().fade('in'); }.bind(this), this.options.delay);	
       	
	},
	hide: function(item) {
		this.options.exit.call(this);
		if (this.timeout){ clearTimeout(this.timeout); }
		this.holderDiv.fade('out');
		item.setProperty('title', this.contentDiv.get('html'));
	}
});