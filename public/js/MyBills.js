var MyBills = new Class({
	/* static information about this application */
	version: '0.1',
	name: 'MyBills.cc',
	autoload: ['MyBills_Forms'],
	controllerNamespace: 'MyBills_Controllers_',
	
	/* dynamic information about the current initialization */
	controllerName: null,
	controller: null,
	
	initialize: function(controllerName) {
		this.load();
	
		if (!$defined(controllerName)) {
			throw new Error('No controller defined');
		}
		this.setControllerName(controllerName);
	},
	load: function() {
		this.autoload.each(function(item) {
			new window[item]();
		});
	},
	
	setControllerName: function(value) {
		this.controllerName = value;
		return this;
	},
	getControllerName: function() {
		return this.controllerName;
	},
	setController: function(c) {
		this.controller = c;
		return this;
	},
	getController: function() {
		return this.controller;
	},
	setControllerNamespace: function(v) {
		this.controllerNamespace = v;
		return this;
	},
	getControllerNamespace: function() {
		return this.controllerNamespace;
	},
	
	run: function() {
		var controller = this.getControllerNamespace() + this.getControllerName().ucfirst();
		this.setController(new window[controller]);
	}
});