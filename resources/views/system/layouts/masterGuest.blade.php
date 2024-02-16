<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link href="{{ asset('images/eklogo.png') }}" rel="shortcut icon">
    <link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('compiledCssAndJs/css/system.css') }}" rel="stylesheet" media="screen"> --}}

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('css/vendors/font-awesome.css')}}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/vendors/icofont.css')}}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/vendors/themify.css')}}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/vendors/flag-icon.css')}}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/vendors/feather-icon.css')}}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/vendors/scrollbar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/vendors/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/vendors/date-picker.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/vendors/photoswipe.css')}}">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/vendors/bootstrap.css')}}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <link id="color" rel="stylesheet" href="{{asset('css/color-1.css')}}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/responsive.css')}}">
    <title>
        {{translate($title ?? 'Login')}}
    </title>
</head>

<body style="background-color: rgba(41, 41, 97, 0.09);">

<style>
    html,
    body {
        height: 100%;
    }
</style>
@yield('content')
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
{{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> --}}
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
<script src="{{ asset('js/typeahead/handlebars.js') }}"></script>
<script src="{{ asset('js/height-equal.js') }}"></script>
<!-- Plugins JS Ends-->
<!-- Theme js-->
<script src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('js/theme-customizer/customizer.js') }}"></script>
<!-- login js-->
<!-- Plugin used-->


<script>
    function hex2rgb(hex, opacity) {
        var h = hex.replace('#', '');
        h = h.match(new RegExp('(.{' + h.length / 3 + '})', 'g'));

        for (var i = 0; i < h.length; i++)
            h[i] = parseInt(h[i].length == 1 ? h[i] + h[i] : h[i], 16);

        if (typeof opacity != 'undefined') h.push(opacity);

        return 'rgba(' + h.join(',') + ')';
    }

    $(function () {
        $("body").css("background-color", hex2rgb("{{getCmsConfig('cms theme color')}}", 0.09));
    })

</script>
<script>
    const error = "{{isset($errors) && $errors->first('alert-throttle') ?? null}}";

    if (error !== '') {
        var seconds = {{session('seconds') ?? 0}}; // Default value 0 if $seconds is not set

        function updateCountdown() {
            $('#alert-throttle').text('Too many attempts. Please try again after ' + seconds + ' seconds');

            if (seconds === 0) {
                clearInterval(countdownInterval); // Clear the interval when seconds reach 0
                $('#alert-throttle').hide();
            } else {
                seconds--;
            }
        }

        updateCountdown(); // Call the function initially

        var countdownInterval = setInterval(updateCountdown, 1000); // Run the countdown every 1000 milliseconds (1 second)
    }
</script>

<script>
    $(document).on("input", ".password, .confirm-password", function () {
        const input = $(this);
        const value = input.val();
        const iconClass = input.hasClass("password") ? "togglePassword" : "toggleConfirmPassword";
        const iconElement = input.next(`.${iconClass}`);

        if (value.length > 0) {
            if (iconElement.length === 0) {
                input.after(`<span class="input-group-text ${iconClass}" style="cursor: pointer;"><i class="fa fa-eye"></i></span>`);
            }
        } else {
            iconElement.remove();
        }
    });

    $(document).on("click", ".togglePassword, .toggleConfirmPassword", function () {
        const passwordInput = $(this).prev(".password, .confirm-password");
        const type = passwordInput.attr("type");
        passwordInput.attr("type", type === "password" ? "text" : "password");

        const eyeIcon = $(this).find("i");
        eyeIcon.toggleClass("fa-eye fa-eye-slash");
    });
</script>
@yield('scripts')
</body>

</html>
