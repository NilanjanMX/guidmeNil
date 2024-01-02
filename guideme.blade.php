<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="title" content="@yield('title')">
        <meta name="keywords" content="@yield('keywords')">
        @if(Request::is('/'))
        <meta name="description" content="Guide Me Education is the best guide for any MBA aspirant, where aspirants can collect all the latest information on courses, admission, placement, scholarships and the latest updates from multiple MBA colleges." />
        @elseif(Request::is('colleges'))
        <meta name="description" content= "Discover your ideal MBA college! Compare top institutions for the perfect fit. Make informed decisions for a successful business education journey.">
        @else        
        <meta name="description" content="@yield('description')">
        @endif
        {{-- <meta name="author" content=""> --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        @if(Request::is('/'))
          <meta name="google-site-verification" content="fGkwBk-psZvuGfRKMV3ZieJshfIMjCSz5zTpuhI5XSk" />
        @endif
        {{--<title>{{ config('app.name', 'Guide Me') }} | @yield('title')</title>--}}
        @if(Request::is('/'))
          <title>Guide Me Education-One Stop Solution for MBA Aspirants | MBA College, Admission, Placement</title>
        @elseif(Request::is('colleges'))
          <title>Find The Right MBA College | Compare Top MBA Colleges</title>
        @else
          <title>@yield('title') | {{ config('app.name', 'Guide Me') }}</title>
        @endif
        
        @if(Request::is('/'))
          <!-- Facebook Open Graph & Twitter Cards  -->
          <meta property="og:type" content="website" />
          <meta property="og:title" content="Guide Me Education-One Stop Solution for MBA Aspirants | MBA College, Admission, Placement" />
          <meta property="og:image" content="https://guidemeeducation.in/site/assets/images/logo.png" />
          <meta property="og:description" content="Guide Me Education is the best guide for any MBA aspirant, where aspirants can collect all the latest information on courses, admission, placement, scholarships and the latest updates from multiple MBA colleges." />
          <meta property="og:url" content="https://guidemeeducation.in/">
          <meta name="twitter:card" content="summary_large_image" />
	        <meta name="twitter:label1" content="Est. reading time" />
          <!-- Facebook Open Graph & Twitter Cards  -->
        @endif
        
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('site/assets/images/favicon.png') }}">
        {{-- Css Libraries --}}
        <link href="{{ asset('site/assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('site/assets/css/owl.carousel.min.css') }}" rel="stylesheet">
        <link href="{{ asset('site/assets/css/owl.theme.default.min.css') }}" rel="stylesheet">
        <link href="{{ asset('site/assets/css/custom.min.css') }}" rel="stylesheet">
        <link href="{{ asset('site/assets/css/custom-responsive.min.css') }}" rel="stylesheet">
        {{-- <link href="{{ asset('site/assets/css/toast.css') }}" rel="stylesheet"> --}}
        {{-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries --}}
        {{-- WARNING: Respond.js doesn't work if you view the page via file:// --}}
        {{-- [if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif] --}}
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
         <!-- For select2 -->
        <link rel="stylesheet" href="{{ asset('site/assets/css/select2.min.css') }}">
        <!------------------>
        <!-- Global site tag (gtag.js) - Google Analytics -->
          <script async src="https://www.googletagmanager.com/gtag/js?id=G-3BMJ5G78KH"></script>
          <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-3BMJ5G78KH');
          </script>
          
          <!-- Google tag (gtag.js) -->
          <script async src="https://www.googletagmanager.com/gtag/js?id=UA-254965532-1"></script>
          <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-254965532-1');
          </script>
        <!-- Global site tag (gtag.js) - Google Analytics -->  
        {{-- Start of Zendesk Chat Script --}}
        <!-- <script type="text/javascript">
            window.$zopim||(function(d,s){var z=$zopim=function(c){
            z._.push(c)},$=z.s=
            d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
            _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
            $.src='https://v2.zopim.com/?6Z6CKKWlU5LfA9K7V9dcq5ts5fI7VTu3';z.t=+new Date;$.
            type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
        </script> -->
        {{-- End of Zendesk Chat Script --}}
        <!-- <script async src="https://platform-api.sharethis.com/js/sharethis.js#property=5d483d0c3387b20012d76954&product="sticky-share-buttons"></script> -->
        @stack('custom-styles')
    </head>
    @php($settings = settings())
    <body>
        <div class="loader"></div>
        @include('site.elements.header')
            @include('site.elements.panel')
            @yield('content')
        @include('site.elements.footer')
        @if(Session::get('success'))
            @php($flashMsg = Session::get('success')) @php($flashMsgCls = 'success')
        @elseif(Session::get('warning'))
            @php($flashMsg = Session::get('warning')) @php($flashMsgCls = 'warning')
        @elseif(Session::get('error'))
            @php($flashMsg = Session::get('error'))   @php($flashMsgCls = 'danger')
        @elseif(Session::get('info'))
            @php($flashMsg = Session::get('info'))    @php($flashMsgCls = 'info')
        @else    
            @php($flashMsg = '')                      @php($flashMsgCls = '')
        @endif
        {{-- Jquery Libraries --}}
        <script src="{{ asset('site/assets/js/jquery.js') }}"></script>
        <script src="{{ asset('site/assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('site/assets/js/jquery.validate.js') }}"></script>
        <script src="{{ asset('site/assets/js/additional-methods.min.js') }}"></script>
        <script src="{{ asset('site/assets/js/bootstrap-notify.min.js') }}"></script>
        <script src="{{ asset('site/assets/js/custom/common.js') }}"></script>
        <!-- For select2 -->
        <script type="text/javascript" src="{{ asset('site/assets/js/select2.full.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('site/assets/js/slider/jquery.fadeImg.js') }}"></script>
        <script type="text/javascript" src="{{ asset('site/assets/js/owl.carousel.js') }}"></script>
        <script type="text/javascript" src="{{ asset('site/assets/js/custom/index.js') }}"></script>
        <!----select2 js ends --->
        @stack('custom-scripts')
        <script>
            APP_URL = "{{ url('/') }}";
            CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            DEFAULT_ERR_MSG =  'Something went wrong. Please refresh the page and try again!';
            $(document).ready(function() {
                @if($flashMsg && $flashMsgCls)
                    $.notify({
                        // options
                        // icon: "nc-icon nc-app",
                        message: '{{ $flashMsg }}'
                    },{
                        // settings
                        type: '{{ $flashMsgCls }}',
                        timer: 5000,
                        placement: {
                            from: 'bottom',
                            align: 'right'
                        }
                    });
                @endif
                @if(!empty($errors->collegeForgotPasswordErrors->toArray()))
                    $("#college-forgot-password-modal").modal("toggle").fadeIn();
                @endif
                @if(!empty($errors->studentForgotPasswordErrors->toArray()))
                    $("#student-forgot-password-modal").modal("toggle").fadeIn();
                @endif
                @if(!empty($errors->collegeLoginErrors->toArray()))
                    $("#student-college-signup-modal").modal("toggle").fadeIn();
                    $('input:radio[name=loginType][value=college]').prop('checked', true);
                    $("#student-login-box").hide();
                    $("#college-login-box").show();
                @endif
                @if(!empty($errors->studentLoginErrors->toArray()))
                    $("#student-signup-modal").modal("toggle").fadeIn();
                    //$('input:radio[name=loginType][value=student]').prop('checked', true);
                    //$("#student-login-box").show();
                    //$("#college-login-box").hide();
                @endif
                @if(!empty($errors->studentRegisterErrors->toArray()) || isset($_GET['key']))
                    $("#student-signup-modal").modal("toggle").fadeIn();
                @endif
            });
        </script>
        @if(Auth::guard('student')->check())
            @php($isLoggedIn = Auth::guard('student')->check())
        @elseif(Auth::guard('college')->check())
            @php($isLoggedIn = Auth::guard('college')->check())
        @else
            @php($isLoggedIn = false)
        @endif
        @if($isLoggedIn == false)
            <div id="student-signup-modal" data-backdrop="static" data-keyboard="false" class="modal fade home_signup_modal" 
                role="dialog" tabindex="-1" data-replace="true">
                @include('site.elements._modals.student-signup')
            </div>
            <div id="student-college-signup-modal" data-backdrop="static" data-keyboard="false" class="modal fade home_signup_modal" 
                role="dialog" tabindex="-1" data-replace="true">
                @include('site.elements._modals.student-college-signin')
            </div>
            <div id="student-forgot-password-modal" data-backdrop="static" data-keyboard="false" class="modal fade home_signup_modal" 
                role="dialog" tabindex="-1" data-replace="true">
                @include('site.elements._modals.student-forgot-password')
            </div>    
            <div id="college-forgot-password-modal" data-backdrop="static" data-keyboard="false" class="modal fade home_signup_modal" 
                role="dialog" tabindex="-1" data-replace="true">
                @include('site.elements._modals.college-forgot-password')
            </div>
            <div id="new-student-password-modal" data-backdrop="static" data-keyboard="false" class="modal fade home_signup_modal" 
                role="dialog" tabindex="-1" data-replace="true">
                @include('site.elements._modals.new-student-password')
            </div>
            <div id="existing-student-password-modal" data-backdrop="static" data-keyboard="false" class="modal fade home_signup_modal" 
                role="dialog" tabindex="-1" data-replace="true">
                @include('site.elements._modals.existing-student-password')
            </div> 
        @endif 
        @if(!empty(Session::get('flagpassword')) && Session::get('flagpassword') =="password modal")
          <script>
          $(function() {
              $('#new-student-password-modal').modal('show');
          });
          </script>
         @endif
         @if(!empty(Session::get('flagpassword_existing')) && Session::get('flagpassword_existing') =="existing password modal")
          <script>
          $(function() {
              $('#existing-student-password-modal').modal('show');
          });
          </script>
         @endif  
        <div class="modal fade" data-backdrop="static" data-keyboard="false" id="myModal-error" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header alert-info">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        {{-- <h4 class="modal-title">Alert!</h4> --}}
                    </div>
                    <div class="modal-body">
                        <ul id="successErrorMsg">
                            {{-- <li>This is a small modal.</li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        {{-- <!-- Load Facebook SDK for JavaScript -->
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js#xfbml=1&version=v2.12&autoLogAppEvents=1';
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        <!-- Your customer chat code -->
        <div class="fb-customerchat"
            attribution=install_email
            page_id="2175275556131700"
            logged_in_greeting="Hi! How can we help you?"
            logged_out_greeting="Hi! How can we help you?">
        </div> --}}
        
        <script type="text/javascript">
var s=document.createElement("script");
s.type="text/javascript";
s.async=true;
s.src="https://widgets.nopaperforms.com/emwgts.js";
document.body.appendChild(s);
</script>

    </body>
</html>