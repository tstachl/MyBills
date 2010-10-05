//$('#product-element *').removeAttr('id');
//$($('#product-element fieldset')[0]).clone(true).appendTo('#product-element');
$.isNumeric = function(v) {
	var validChars = '0123456789.,';
	var r = true;
	$.each(v.split(''), function(i, v) {
		if (validChars.indexOf(v) == -1) {
			r = false;
		}
	});
	return r;
};
$.invoice = {
	productElements: null,
	init: function() {
		var self = this;
		
		// remove id's from all elements beneath product-element so we can clone
		// without having to worry about the id's
		$('#product-element *').removeAttr('id');
		self.initCalculator(self);
		self.initNewRow(self);
		self.productElements = $($('#product-element fieldset')[0]).clone(true);
	},
	initCalculator: function(self) {
		$('#product-element .product_pieces input').change(function() {
			self.recalculate(self);
		});
		
		$('#product-element .product_price input').focus(function() {
			$(this).toNumber();
		}).blur(function() {
			$(this).formatCurrency();
		});
		
		$('#product-element .product_price input').change(function() {
			self.recalculate(self);
			self.priceFormat($(this));
		});
		
		$('dd.tax_tax input').change(function() {
			self.recalculate(self);
		});
	},
	initNewRow: function(self) {
		$('#newrow').click(function() {
			self.newRow(self);
		});
	},
	newRow: function(self) {
		self.productElements.clone(true).appendTo('#product-element');
	},
	priceFormat: function(el) {
		return el.css('text-align', 'right').formatCurrency();
	},
	recalculate: function(self) {
		var sum = 0;
		var container = $('#product-element').get();
		var taxPercent = ($.isNumeric($('dd.tax_tax input').val()) ? $('dd.tax_tax input').val() : 0);
		
		$.each($('#product-element fieldset'), function(i, v) {
			var pieces = ($.isNumeric($(v).find('.product_pieces input').val()) ? $(v).find('.product_pieces input').val() : 0);
			var price = ($.isNumeric($(v).find('.product_price input').toNumber().val()) ? $(v).find('.product_price input').toNumber().val() : 0);
			$(v).find('.product_price input').formatCurrency();
			sum = sum + (pieces * price);
		});
		
		container.sumNoTax = sum;
		container.sumTax = ((sum / 100) * taxPercent);
		container.sumGrand = (container.sumNoTax + container.sumTax);
		
		self.priceFormat($('#taxsum').val(container.sumTax));
		self.priceFormat($('#sum').val(container.sumGrand));
	}
};