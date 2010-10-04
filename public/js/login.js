;$.login = {
	usernameValue: null,
	clearPasswordField: null,
	passwordField: null,
	init: function() {
		$.login.initUsername();
		$.login.initPassword();
		$.login.initForm();
	},
	initUsername: function() {
		$('#username').bind('focus', function() {
			if (($.login.usernameValue === null) || ($.login.usernameValue == $(this).val())) {
				if ($.login.usernameValue === null) {
					$.login.usernameValue = $(this).val();
				}
				$(this).val('');
			}
			$(this).css('color', '#333333').parent().css('border-color', '#FF0000');
		}).bind('blur', function() {
			if ($(this).val() == '') {
				$(this).css('color', '');
				$(this).val($.login.usernameValue);
			}
			$(this).parent().css('border-color', '');
		});
	},
	initPassword: function() {
		$.login.clearPasswordField = $('<input type="text" />').val($('input[name=passwordtext]').val());
		$.login.passwordField = $('#password').css('color', '#333333').css('display', 'none').val('').after($.login.clearPasswordField);
		
		$.login.clearPasswordField.bind('focus', function() {
			$.login.clearPasswordField.css('display', 'none');
			$.login.passwordField.css('display', 'inline').focus();
		});
		
		$.login.passwordField.bind('focus', function() {
			$.login.passwordField.parent().css('border-color', '#FF0000');
		});
		
		$.login.passwordField.bind('blur', function() {
			if ($(this).val() == '') {
				$.login.passwordField.css('display', 'none');
				$.login.clearPasswordField.css('display', 'inline');
			}
			$.login.passwordField.parent().css('border-color', '');
		});
	},
	initForm: function() {
		$('#login_form').submit(function() {
			$.login.passwordField.attr('name', $.login.clearPasswordField.attr('name')).css('display', 'inline');
			$.login.clearPasswordField.remove();
		});
	}
};

$(function() {
	$.login.init();
});