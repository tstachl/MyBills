var MyBills_Library_Autocomplete = new Class({
	
	el: null,
	ac: null,
	list: null,
	listElement: null,
	options: null,
	
	initialize: function(el, options) {
		this.el = el;
		
		options.styles = $extend({
			'width': '500px',
			'margin-top': '20px'
		}, options.styles);
		
		this.options = $extend({
			delimiter: ', ',
			max: 10
		}, options);
		
		if ((this.el.get('tag') !== 'input') && (this.el.get('type') !== 'text')) {
			throw new Exception('Autocomplete only works with input elements.');
		}
		
		this.ac = this.el.clone().cloneEvents(this.el).set('name', '').set('autocomplete', 'autocomplete').inject(this.el, 'after');
		this.el.setStyle('display', 'none');
		
		this.list = new Element('ul', {'styles': $extend({'display': 'none'}, this.options.styles)});
		this.list.inject(this.el, 'before');
		this.listElement = new Element('li');
		
		this.ac.addEvents({
			focus: function() {
				this.showList();
			}.bind(this),
			blur: function() {
				this.hideList();	
			}.bind(this),
			keydown: function(e) {
				switch (e.key) {
					case 'tab':
						this.selectItem();
						break;
				}
			}.bind(this),
			keyup: function(e) {
				switch (e.key) {
					case 'up':
						this.moveFocus(true);
						break;
					case 'down':
						this.moveFocus(false);
						break;
					default:
						this.addElements();
						break;
				}
			}.bind(this)
		});
	},
	
	showList: function() {
		this.addElements();
		this.list.setStyle('display', 'inline');
	},
	hideList: function() {
		this.list.setStyle('display', 'none');
	},
	
	moveFocus: function(up) {
		var active = this.getActive();
		this.removeActive();
		if (up) {
			if (!active || (null == active.getPrevious())) {
				this.list.getLast().addClass('active');
			} else {
				active.getPrevious().addClass('active');
			}
		} else {
			if (!active || (null == active.getNext())) {
				this.list.getFirst().addClass('active');
			} else {
				active.getNext().addClass('active');
			}
		}
	},
	
	addElements: function() {
		this.list.empty();
		var c = 0, tmp = [];
		
		$each($.jStorage.filter(this.options.store, this.options.filter, this.ac.get('value'), true, false, false), function(item) {
			tmp.push(item);
		});
		
		for (var z = 0; z < tmp.length; z++) {
			if (c++ === this.options.max) return;
			
			var text = '';
			for (var i = 0; i < this.options.show.length; i++) {
				text += tmp[z][this.options.show[i]] + this.options.delimiter;
			}
			tmp[z]['zzzzzz_show'] = text.substring(0, (text.length - this.options.delimiter.length));
			
			var nel = this.listElement.clone().appendText(tmp[z]['zzzzzz_show']);
			nel.store('item', tmp[z]).addEvents({
				mouseenter: function(e) {
					this.removeActive();
					e.target.addClass('active');
				}.bind(this),
				mousedown: function() {
					this.selectItem();
				}.bind(this)
			});
			
			this.list.grab(nel);
		}
		
	},
	
	removeActive: function() {
		$each(this.list.getChildren('li'), function(item) {
			item.removeClass('active');
		});
	},
	getActive: function() {
		var active = false;
		$each(this.list.getChildren('li'), function(item) {
			if (item.hasClass('active')) {
				active = item;
			}
		});
		return active;
	},
	selectItem: function() {
		var item = this.getActive().retrieve('item', false);
		this.ac.set('value', item['zzzzzz_show']);
		this.el.set('value', item[this.options.id]);
		console.log(item[this.options.id], this.el);
	}
	
	
});