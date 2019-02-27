var objM = {
    init: function(){
        carousels: {

            //carousel
        }

        def:  {

            function preloader(){
                $('.preload').delay(500).fadeOut('slow');
            }

            $('.preload').length ? preloader() : '';

            $('[type="phone"]').mask('+7 (999) 999-99-99');

            $('.call').on('click',function (e) {
			  e.preventDefault();
			  $('#exampleModal').modal();
		   });

		    $('.privacy_policy').on('click',function (e) {
			   e.preventDefault();
			   $('#policyModal').modal();
		    });

            window.addEventListener('resize', function () {

            });


            //add js

        }
    }
};

$(document).ready(function () {
    objM.init();
});