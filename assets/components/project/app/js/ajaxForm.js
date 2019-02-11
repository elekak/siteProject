var AjaxForm = {

   initialize: function (afConfig) {
	  if (!jQuery().ajaxForm) {
		 document.write('<script src="' + afConfig['assetsUrl'] + 'js/lib/jquery.form.min.js"><\/script>');
	  }
	  var bot4               = true,
		  messageError       = true,
		  tooltip            = false;

	  $(document).off('submit', afConfig['formSelector']).on('submit', afConfig['formSelector'], function (e) {

		 $(this).ajaxSubmit({
			dataType: 'json',
			data: {pageId: afConfig['pageId']},
			url: afConfig['actionUrl'],
			beforeSerialize: function (form) {
			   form.find(':submit').each(function () {
				  if (!form.find('input[type="hidden"][name="' + $(this).attr('name') + '"]').length) {
					 $(form).append(
						 $('<input type="hidden">').attr({
							name: $(this).attr('name'),
							value: $(this).attr('value')
						 })
					 );
				  }
			   })
			},
			beforeSubmit: function (fields, form) {
			   //noinspection JSUnresolvedVariable
			   if (typeof(afValidated) != 'undefined' && afValidated == false) {
				  return false;
			   }
			   form.find('input,textarea,select,button').attr('disabled', true);
			   return true;
			},
			success: function (response, status, xhr, form) {
			   form.find('input,textarea,select,button').attr('disabled', false);
			   response.form = form;
			   $(document).trigger('af_complete', response);

			   //tooltip ? form.find('[required]').attr('data-toggle', 'tooltip') : '';
			   tooltip ? form.find('[required]').parent().tooltip(bot4 ? 'dispose' : 'destroy') : '';

			   if (bot4) {
				  form.find('[required]').removeClass('is-invalid').addClass('is-valid');
				  form.find('[data-error-for]').removeClass('invalid-feedback').html('').hide();
			   } else {
				  form.find('[required]').parent().removeClass('has-error').addClass('has-success');
				  form.find('[data-error-for]').removeClass('help-block').html('').hide();
			   }
			   if (!response.success) {
				  AjaxForm.Message.error(form, response.message);
				  if (response.data) {
					 var key, value, focused;
					 for (key in response.data) {
						if (response.data.hasOwnProperty(key)) {
						   if (!focused) {
							  form.find('[name="' + key + '"]').focus();
							  focused = true;
						   }
						   value = response.data[key];
						   if (tooltip) {
							  form.find('[data-error-for="'+key+'"]').parent().tooltip({
								 trigger: 'manual',
								 placement: 'top',
								 title: value,
							  }).tooltip('show');
						   }
						   if (bot4) {
							  form.find('[name="' + key + '"]').removeClass('is-valid').addClass('is-invalid');
							  if(messageError) {
								 form.find('[data-error-for="'+key+'"]').addClass('invalid-feedback').show().html(value);
							  }
						   } else {
							  form.find('[name="' + key + '"]').parent().removeClass('has-success').addClass('has-error');
							  if(messageError) {
								 form.find('[data-error-for="'+key+'"]').addClass('help-block').show().html(value);
							  }
						   }
						}
					 }
				  }
			   }
			   else {
				  AjaxForm.Message.success(form, response.message);
				  tooltip ? form.find('[required]').parent().tooltip(bot4 ? 'dispose' : 'destroy') : '';
				  if (bot4) {
					 form.find('[data-error-for]').removeClass('invalid-feedback').html('').hide();
				  } else {
					 form.find('[data-error-for]').removeClass('help-block').html('').hide();
				  }
				  form[0].reset();
				  //noinspection JSUnresolvedVariable
				  if (typeof(grecaptcha) != 'undefined') {
					 //noinspection JSUnresolvedVariable
					 grecaptcha.reset();
				  }
			   }
			}
		 });
		 e.preventDefault();
		 return false;
	  });

	  $(document).on('keypress change', '.error', function () {
		 var key = $(this).attr('name');
		 $(this).removeClass('error');
		 $('.error_' + key).html('').removeClass('error');
	  });

	  $(document).on('reset', afConfig['formSelector'], function () {
		 if (bot4) {
			$(this).find('.form-control').removeClass('is-valid');
		 } else {
			$(this).find('.form-group').removeClass('has-success');
		 }
		 var that = $(this);
		 setTimeout(function () {
			AjaxForm.Message.close($(that));
		 },5000);
	  });

	  $('[type="submit"]').attr('name', 'sendOrder');
   }
};

//noinspection JSUnusedGlobalSymbols
AjaxForm.Message = {
   reset: function(form) {
	  form.find('.toggle-alert')
		  .removeClass('alert-success')
		  .removeClass('alert-danger')
		  .removeClass('alert-info');
   },
   success: function (form, message) {
	  this.reset(form);
	  form.find('.toggle-alert').show().addClass('alert-success').text(message);
   },
   error: function (form, message) {
	  this.reset(form);
	  form.find('.toggle-alert').show().addClass('alert-danger').text(message);
   },
   info: function (form, message) {
	  this.reset(form);
	  form.find('.toggle-alert').show().addClass('alert-info').text(message);
   },
   close: function (form) {
	  form.find('.toggle-alert').hide();
   },
};