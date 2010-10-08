
Native.implement([Element, Window, Document], {
	cloneEventsDeep: function(from, type){
		if (this.getChildren().length > 0) {
			this.getChildren().each(function(item, index) {
				item.cloneEventsDeep(from.getChildren()[index], type);
			});
			this.cloneEvents(from, type);
		} else {
			this.cloneEvents(from, type);
		}
		return this;
	}
});

String.implement({
	isNumeric: function() {
		var r = true;
		this.split('').each(function(i) {
			if ('0123456789.,'.indexOf(i) == -1) {
				r = false;
			}
		});
		return r;
	},
	numberFormat: function(decimals, dec_point, thousands_sep, front_sign, back_sign) {
		return this.toFloat().numberFormat(decimals, dec_point, thousands_sep, front_sign, back_sign);
	},
	removeNumberFormat: function() {
		return this.replace(new RegExp("[^\\d.-]", "g"), '').toFloat();
	},
	ucfirst: function() {
	    var f = this.charAt(0).toUpperCase();
	    return f + this.substr(1);
	}
});

Number.implement({
	numberFormat: function(decimals, dec_point, thousands_sep, front_sign, back_sign) {
		decimals = Math.abs(decimals) + 1 ? decimals : 2;
		dec_point = dec_point || '.';
		thousands_sep = thousands_sep || ',';
		front_sign = front_sign || '';
		back_sign = back_sign || '';
	
		var matches = /(-)?(\d+)(\.\d+)?/.exec((isNaN(this) ? 0 : this) + ''); // returns matches[1] as sign, matches[2] as numbers and matches[3] as decimals
		var remainder = matches[2].length > 3 ? matches[2].length % 3 : 0;
		return front_sign + (matches[1] ? matches[1] : '') + (remainder ? matches[2].substr(0, remainder) + thousands_sep : '') + 
				matches[2].substr(remainder).replace(/(\d{3})(?=\d)/g, "$1" + thousands_sep) + (decimals ? dec_point + (+matches[3] || 0).toFixed(decimals).substr(2) : '') + back_sign;
	}
});

Element.implement({
	autocomplete: function(options) {
		new MyBills_Library_Autocomplete(this, options);
		return this;
	}
});