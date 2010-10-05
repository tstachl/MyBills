;$.forms = {
	inputs: null,
	passwords: null,
	style: function() {
		var self = this;
		
		self.inputs = $('.form input[type=text]');
		self.passwords = $('.form input[type=password]');
		
		$.each(self.inputs, function(i, el) {
			$(el).val(self.getLabel($(el)));
			if ($(el).attr('readonly') === false) {
				self.bindTextEvents($(el));
			}
		});
		
		$.each(self.passwords, function(i, el) {
			self.bindPasswordEvents($(el), self.getLabel($(el)));
		});
	},
	getLabel: function(el) {
		return el.closest('dd').prev('dt').find('label').html();
	},
	bindTextEvents: function(el) {
		el.bind('focus', function() {
			if ((this.label === undefined) || (this.label == $(this).val())) {
				if (this.label === undefined) {
					this.label = $(this).val();
				}
				$(this).val('');
			}
			$(this).css('color', '#333333').parent().css('border-color', '#FF0000');
		}).bind('blur', function() {
			if ($(this).val() == '') {
				$(this).css('color', '');
				$(this).val(this.label);
			}
			$(this).parent().css('border-color', '');
		});
	},
	bindPasswordEvents: function(el, label) {
		var clear = $('<input type="text" />').val(label);
		el.css('color', '#333333').css('display', 'none').val('').after(clear);
		
		clear.bind('focus', function() {
			$(this).css('display', 'none');
			el.css('display', 'inline').focus();
		});
		
		el.bind('focus', function() {
			$(this).parent().css('border-color', '#FF0000');
		}).bind('blur', function() {
			if ($(this).val() == '') {
				$(this).css('display', 'none');
				clear.css('display', 'inline');
			}
			$(this).parent().css('border-color', '');
		});
	}
};

$(function() {
	$.forms.style();
});