<script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
<script src="{{ asset('jscolor/jscolor.js')}}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"
        integrity="sha256-mFeNnkKbr+LtvZ0AJx6IqF+kV+rUwQZIXRV/2VW18t4=" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"
        integrity="sha256-mFeNnkKbr+LtvZ0AJx6IqF+kV+rUwQZIXRV/2VW18t4=" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>

<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>

<script src="{{ asset('compiledCssAndJs/js/system.js')}}"></script>
<script src="{{ asset('toast/jquery.toast.min.js')}}"></script>
<!-- latest jquery-->
{{-- <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script> --}}
<!-- Bootstrap js-->
<script src="{{ asset('js/bootstrap/bootstrap.bundle.min.js') }}"></script>
<!-- scrollbar js-->
<script src="{{ asset('js/scrollbar/simplebar.js') }}"></script>
<script src="{{ asset('js/scrollbar/custom.js') }}"></script>
<!-- Sidebar jquery-->
<script src="{{ asset('js/config.js') }}"></script>
<!-- Plugins JS start-->
<script src="{{ asset('js/sidebar-menu.js') }}"></script>
<script src="{{ asset('js/notify/bootstrap-notify.min.js') }}"></script>
{{-- this is for alert message --}}
{{-- <script src="{{ asset('js/notify/index.js') }}"></script> --}}
<script src="{{ asset('js/datepicker/date-picker/datepicker.js') }}"></script>
<script src="{{ asset('js/datepicker/date-picker/datepicker.en.js') }}"></script>
<script src="{{ asset('js/datepicker/date-picker/datepicker.custom.js') }}"></script>

<script src="{{ asset('js/datepicker/daterange-picker/moment.min.js')}}"></script>
<script src="{{ asset('js/datepicker/daterange-picker/daterangepicker.js')}}"></script>
<script src="{{ asset('js/datepicker/daterange-picker/daterange-picker.custom.js')}}"></script>


<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>

<script src="{{ asset('js/typeahead/handlebars.js') }}"></script>
<script src="{{ asset('js/height-equal.js') }}"></script>
<!-- Plugins JS Ends-->
<!-- Theme js-->
<script src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('js/theme-customizer/customizer.js') }}"></script>
<!-- login js-->
<!-- Plugin used-->

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="{{ asset('compiledCssAndJs/js/system.js')}}"></script>

<script>
    $(function () {
        var check = `{{$errors->first('success')}}`;
        if (check !== "") {
            $.toast({
                heading: 'success',
                text: `{{$errors->first('success')}}`,
                showHideTransition: 'plain',
                icon: 'success',
                position: 'top-right',
            });
        }

        let sideBarState = localStorage.getItem('sidebarToggle')
        if (sideBarState == 1) {
            $(".page-wrapper").addClass('toggle-page')
        }
    })

    if (localStorage.getItem("cust-dark-theme") == 'dark-only') {
        $("body").attr("class", "dark-only");
    }

    $(".toggle-button").on('click', function () {
        let sideBarState = localStorage.getItem('sidebarToggle')
        if (sideBarState == 0) localStorage.setItem('sidebarToggle', 1)
        if (sideBarState == 1) localStorage.setItem('sidebarToggle', 0)
        $(".page-wrapper").toggleClass("toggle-page")
    })

    $('.datepicker-here').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });

    $('.datepicker-here').on('apply.daterangepicker', function (ev, picker) {
        $('#from-date').val(picker.startDate.format('YYYY-MM-DD'));
        $('#to-date').val(picker.endDate.format('YYYY-MM-DD'));
        $(this).val(picker.startDate.format('YYYY-MM-DD') + ' to ' + picker.endDate.format('YYYY-MM-DD'));
    });

    $('.datepicker-here').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        autoUpdateInput: false,
        locale: {
            format: 'YYYY-MM-DD'
        }
    }, function (start, end, label) {
    });

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>


