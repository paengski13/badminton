var Datepicker = function () {

    return {
        
        //Datepickers
        initDatepicker: function () {
	        // Regular datepicker
	        $('.date').datepicker({
	            dateFormat: 'dd M yy',
                changeMonth: true,
                changeYear: true,
                yearRange: "-45:+3",
	            prevText: '<i class="fa fa-angle-left"></i>',
	            nextText: '<i class="fa fa-angle-right"></i>'
	        });

            $('.date_month_year').datepicker({
	            dateFormat: 'MM yy',
                changeMonth: true,
                changeYear: true,
                yearRange: "-45:+3",
                //showButtonPanel: true,
	            prevText: '<i class="fa fa-angle-left"></i>',
	            nextText: '<i class="fa fa-angle-right"></i>',
                beforeShow : function(input, inst) {
                    $(this).removeClass("ui-datepicker-current");
                    $(this).removeClass("ui-datepicker-calendar");
                    $(".ui-datepicker-current").css("display","none");
                    $(".ui-datepicker-calendar").css("display","none");
                }
            
	        }).bind('dateSelected', function(dateText, inst) {

                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                $(this).datepicker('setDate', new Date(year, month, 1));
            });
            
	        // Date range
	        $('#start').datepicker({
	            dateFormat: 'dd M yy',
	            prevText: '<i class="fa fa-angle-left"></i>',
	            nextText: '<i class="fa fa-angle-right"></i>',
	            onSelect: function( selectedDate )
	            {
	                $('#finish').datepicker('option', 'minDate', selectedDate);
	            }
	        });
	        $('#finish').datepicker({
	            dateFormat: 'dd M yy',
	            prevText: '<i class="fa fa-angle-left"></i>',
	            nextText: '<i class="fa fa-angle-right"></i>',
	            onSelect: function( selectedDate )
	            {
	                $('#start').datepicker('option', 'maxDate', selectedDate);
	            }
	        });
        }

    };
}();