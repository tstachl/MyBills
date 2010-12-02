var MyBills_Controllers_Contacts = new Class({
	initialize: function() {
		this.initDataStores();
		this.initComponents();
	},
	initDataStores: function() {
		if ($.jStorage.get('countries') === null) {
			var request = new Request.JSON({
				url: '/contacts/countries',
				onComplete: function(json) {
					$.jStorage.set('countries', json);
				}
			}).send();
		}
		
		if ($.jStorage.get('states') === null) {
			var request = new Request.JSON({
				url: '/contacts/states',
				onComplete: function(json) {
					$.jStorage.set('states', json);
				}
			}).send();
		}
	},
	
	initComponents: function() {
		var size = $('country').setStyle('display', 'inline').getSize().x;
		$('country').setStyle('display', 'none').autocomplete({
			id: 'iso',
			filter: 'name',
			store: 'countries',
			show: ['name'],
			delimiter: ', ',
			styles: {
				width: size
			}
		});
		
		$('country').addEvents({
			change: function() {
				var size = $('state').setStyle('display', 'inline').getSize().x;
				$('state').setStyle('display', 'none').set('readonly', false).autocomplete({
					id: 'id',
					allowNew: true,
					filter: [{
						property: 'name',
						multipleAnd: true
					}, {
						property: 'country',
						value: $('country').get('value'),
						multipleAnd: true
					}],
					store: 'states',
					show: ['name'],
					styles: {
						width: size
					}
				});
			}
		});
	}
});