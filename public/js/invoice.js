//$('#product-element *').removeAttr('id');
//$($('#product-element fieldset')[0]).clone(true).appendTo('#product-element');
$.fn.priceFormat = function(options) {
    
    var defaultOptions = {
        groupSeparator: ",",
        decimalSeparator: "."
    }
    
    // default options
    options = $.extend({}, defaultOptions, options);
    
    var formatValue = function(val) {
        if (isNaN(val)) return 0.00;
        val = Number(val).toFixed(2);
        var p = String(val).split(options.decimalSeparator);
        
        var intPart = "";
        
        for (var i = 3, t = p[0].length; i < t + 3; i+= 3) {
            intPart = p[0].slice(-3) + options.groupSeparator + intPart;        
            p[0] = p[0].substring(0, t-i);
        }
        
        // remove extra comma,
        p[0] = intPart.substring(0, intPart.length-1);        
                
        return p.join(options.decimalSeparator);
    }
    
    this.each(function(i, e) {
        e = $(e);
        if ($.inArray(e.attr("tagName"), ["INPUT", "TEXTAREA"]) !== -1) {
           e.val(formatValue(e.val()));
        } else {
           e.text(formatValue(e.text()));
        }
    });
    
    return this;
};
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
	priceFormatOptions: {
	    groupSeparator: ",",
	    decimalSeparator: "."
	},
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
			self.removePriceFormat($(this));
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
		return el.css('text-align', 'right').priceFormat($.invoice.priceFormatOptions);
	},
	removePriceFormat: function(el) {
		var val = el.val().replace($.invoice.priceFormatOptions.groupSeparator, '');
		
		if ($.invoice.priceFormatOptions.decimalSeparator != '.') {
			val.replace($.invoice.priceFormatOptions.decimalSeparator, '.');
		}

		return val;
	},
	recalculate: function(self) {
		var sum = 0;
		var container = $('#product-element').get();
		var taxPercent = ($.isNumeric($('dd.tax_tax input').val()) ? $('dd.tax_tax input').val() : 0);
		
		$.each($('#product-element fieldset'), function(i, v) {
			var pieces = ($.isNumeric($(v).find('.product_pieces input').val()) ? $(v).find('.product_pieces input').val() : 0);
			var priceNum = self.removePriceFormat($(v).find('.product_price input'));
			var price = ($.isNumeric(priceNum) ? priceNum : 0);
			sum = sum + (pieces * price);
		});
		
		container.sumNoTax = sum;
		container.sumTax = ((sum / 100) * taxPercent);
		container.sumGrand = (container.sumNoTax + container.sumTax);
		
		self.priceFormat($('#taxsum').val(container.sumTax));
		self.priceFormat($('#sum').val(container.sumGrand));
	}
};