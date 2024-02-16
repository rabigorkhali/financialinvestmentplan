
//DateRange Picker
(function($) {
    "use strict";
    $(function() {
        $('input[name="daterange"]').daterangepicker({
             timePicker: true,
            timePickerIncrement: 30,
             locale: {
                format: 'YYYY-MM-DD'
            }
        });
        $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
             $('#from').val(picker.startDate.format('YYYY-MM-DD'));
            $('#to').val(picker.endDate.format('YYYY-MM-DD'));
        });
    });
//Date and Time
    $(function() {
        $('input[name="daterange2"]').daterangepicker({
            timePicker: true,
            autoUpdateInput: false,

            timePickerIncrement: 30,
            locale: {
                format: 'yyyy-mm-dd'
            }
        });
    });
// Single Date Picker
    $(function() {
        $('input[name="birthdate"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true
            },
            function(start, end, label) {
                var years = moment().diff(start, 'years');
                alert("You are " + years + " years old.");
            });
    });


//Predefined Ranges

//Input Initially Empty

})(jQuery);
