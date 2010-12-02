MyBills.Validator = new Class({
	
	/**
	 * The value to be validated.
	 * 
	 * @var mixed
	 */
	value: null,
	
	/**
	 * Array of validation failure messages
	 * 
	 * @var array
	 */
	messages: [],
	
	/**
	 * Active failure message
	 * 
	 * @var string
	 */
	message: '',
	
	/**
	 * Regex pattern for validation
	 * 
	 * @var object
	 */
	pattern: new RegExp(),
	
	/**
	 * Function to test the value
	 * 
	 * @return boolean
	 */
	isValid: function(value) {},
	
	setMessage: function(message) {
		this.message = message;
	}.protect(),
	
	getMessage: function() {
		return this.message;
	}
});