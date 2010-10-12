var MyBills_Controllers_Invoice = new Class({
	row: null,
	
	initialize: function() {
		this.addEvents();
		this.initDataStores();
		this.initComponents();
	},
	
	initDataStores: function() {
		if (null === $.jStorage.get('countries')) {
			var request = new Request.JSON({
				url: '/contacts/countries',
				onComplete: function(json) {
					$.jStorage.set('countries', json);
				}
			}).send();
		}
	},
	
	initComponents: function() {
		var size = $('contact').setStyle('display', 'inline').getSize().x;
		$('contact').setStyle('display', 'none').autocomplete({
			id: 'iso',
			filter: 'name',
			store: 'countries',
			show: ['name'],
			delimiter: ', ',
			styles: {
				width: size
			}
		});
	},
	
	clone: function() {
		this.row.clone().cloneEventsDeep(this.row).inject($('product-element').getLast('fieldset'), 'after');
		$('product-element').getLast('fieldset').getElement('input[name=units]').getNext().focus();
		var name = $('product-element').getLast('fieldset').getElement('input[name=name]');
		var size = name.setStyle('display', 'inline').getSize().x;
		name.setStyle('display', 'none').autocomplete({
			id: 'iso',
			filter: 'name',
			store: 'countries',
			show: ['name'],
			delimiter: ', ',
			styles: {
				width: size
			}
		});
	},
	
	addEvents: function() {
		var fieldset = $('product-element').getFirst('fieldset');
		var units = fieldset.getElement('input[name=units]');
		var name = fieldset.getElement('input[name=name]');
		var price = fieldset.getElement('input[name=price]');
		var self = this;
		
		units.addEvents({
			change: function() {
				if (this.get('value').isNumeric()) {
					this.set('value', this.get('value').numberFormat(2, '.', ','));
					self.checkRow(this.getParent('fieldset'), this);
				} else {
					this.set('value', '');
				}
			},
			focus: this.setCleanNumber
		});
		
		price.addEvents({
			change: function() {
				if (this.get('value').isNumeric()) {
					this.set('value', this.get('value').numberFormat(2, '.', ',', '$'));
					self.checkRow(this.getParent('fieldset'), this);
				} else {
					this.set('value', '');
				}
			},
			focus: this.setCleanNumber
		});
		
		this.row = $('product-element').getFirst('fieldset').clone().cloneEventsDeep($('product-element').getFirst('fieldset'));
		
		var size = name.setStyle('display', 'inline').getSize().x;
		name.setStyle('display', 'none').autocomplete({
			id: 'iso',
			filter: 'name',
			store: 'countries',
			show: ['name'],
			delimiter: ', ',
			styles: {
				width: size
			}
		});
		
		$('tax').addEvents({
			change: function() {
				if (this.get('value').isNumeric()) {
					this.set('value', this.get('value').numberFormat(2, '.', '', '', ' %'));
					self.recalculate();
				} else {
					this.set('value', '');
				}
			},
			focus: this.setCleanNumber
		});
		
		$('taxsum').addEvent('focus', this.focusOnButton);
		$('sum').addEvent('focus', this.focusOnButton);
	},
	focusOnButton: function() {
		$('create').focus();
		return this;
	},
	setCleanNumber: function() {
		if (this.get('value') !== '') {
			this.set('value', this.get('value').removeNumberFormat());
		}
	},
	
	checkRow: function(fieldset, el) {
		if ((product = fieldset.retrieve('product')) === null) {
			product = {
				'units': null,
				'price': null
			};
		}
		
		product[el.get('name')] = el.get('value').removeNumberFormat();
		fieldset.store('product', product);
		
		var complete = true;
		$each(product, function(item) {
			if (item === null) { complete = false; }
		});
		
		if (complete) {
			this.recalculate();
			this.clone();
		}
	},
	recalculate: function() {
		var sum = 0;
		var rows = $('product-element').getElements('fieldset');
		var taxPercent = ((($('tax').get('value') != '') && ($('tax').get('value').removeNumberFormat())) ? $('tax').get('value').removeNumberFormat() : 0);
		
		rows.each(function(item) {
			var product = item.retrieve('product');
			if (null !== product) {
				sum += product.units * product.price;
			}
		});
		
		$('taxsum').set('value', ((sum / 100) * taxPercent).numberFormat(2, '.', ',', '$')).removeLabel();
		$('sum').set('value', (((sum / 100) * taxPercent) + sum).numberFormat(2, '.', ',', '$')).removeLabel();
	}
});