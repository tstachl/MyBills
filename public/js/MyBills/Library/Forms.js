var MyBills_Library_Forms = new Class({
	
	borderOnChangeColor: '#FF0000',
	borderChangedColor: '#47834B',
	textColor: '#666666',
	htmlTags: ['input', 'textarea', 'button', 'select'],
	elements: [],
	
	initialize: function() {
		this.findAllFormElements();
		this.addLabel();
	},
	findAllFormElements: function() {
		this.htmlTags.each(function(item) {
			this.elements.combine($$(item));
		}.bind(this));
		return true;
	},
	getLabel: function(item) {
		return $$('label[for=' + item.get('name') + ']').get('text');
	},
	addLabel: function() {
		this.elements.each(function(item) {
			switch (item.get('tag')) {
				case 'input':
					switch (item.get('type')) {
						case 'text': this.addLabelToTextfield(item); break;
						case 'password': this.addLabelToTextfield(item); break;
					}
					break;
			}
		}.bind(this));
	},
	addLabelToTextfield: function(item) {
		item.set('value', '');
		
		var label = new Element('input', {
			type: 'text',
			value: this.getLabel(item)
		});
		var borderColor = item.getParent('div').getStyle('border-color');
		var self = this;
		
		item.set('styles', {
			'display': 'none',
			'color': this.textColor
		});
		label.inject(item, 'after');
		label.addEvent('focus', function() {
			if (this.getPrevious().get('readonly')) { 
				this.blur();
				return;
			}
			this.setStyle('display', 'none').getParent('div').setStyle('border-color', self.borderOnChangeColor);
			this.getPrevious().setStyle('display', 'inline').focus();
		});
		item.addEvent('blur', function() {
			if (this.get('value') == '') {
				this.setStyle('display', 'none').getParent('div').setStyle('border-color', borderColor);
				this.getNext().setStyle('display', 'inline');
			} else {
				if (!this.get('readonly')) {
					this.getParent('div').setStyle('border-color', self.borderChangedColor);
				}
			}
		});
		$extend(item, {
			removeLabel: function() {
				this.setStyle('display', 'inline').getNext().setStyle('display', 'none');
				return this;
			}
		});
	}
});