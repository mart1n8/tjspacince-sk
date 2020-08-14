<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-60205357-3"></script>
    <script>
				window.dataLayer = window.dataLayer || [];
				function gtag(){dataLayer.push(arguments);}
				gtag('js', new Date());
				gtag('config', 'UA-60205357-3');
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}"><!-- CSRF Token -->
		<link rel="icon" href="{{ asset('images/LOGO_TJ_100x100.png') }}">
		<!--[if IE]><link rel="shortcut icon" href="{{ asset('images/LOGO_TJ_100x100.png') }}"><![endif]-->
    @if(!empty($fb_metas))
        <meta property="fb:app_id" content="1669986116571722" />
		    <meta property="og:locale" content="sk_SK" />
        <!-- FB META TAGS -->
        @foreach($fb_metas as $fb_key => $fb_value)
            <meta property="{{ $fb_key }}" content="{{ $fb_value }}" />
        @endforeach
    @endif
    @if(View::hasSection('title'))
        <title>@yield('title') |  TJ Špačince</title>
    @else
        <title>TJ Družstevník Špačince | futbalový klub</title>
    @endif

    <!-- JS -->
		<script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
		<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
    <script src="{{ asset('js/jquery.cookie.js') }}"></script>
    <script src="{{ asset('js/jquery.cookiecuttr.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/jquery.easy-autocomplete.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datetimepicker.js') }}"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/easy-autocomplete.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/bootstrap-datetimepicker.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/cookiecuttr.css') }}" rel="stylesheet">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
</head>
<body >
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/sk_SK/sdk.js#xfbml=1&version=v3.3&appId=1669986116571722&autoLogAppEvents=1"></script>
<div>
    <div class="container sticky-top" style="padding: 0px">
       @include('layouts._nav')
    </div>
    <div class="container main-container">
          <div class="row">
              <div class="col-md-12" style="padding: 0">
								<header>
										<img src="{{ asset('images/headx.png') }}" class="img-responsive" style="max-width: 100%" alt="head_img">
								</header>
              </div>
          </div>
          <div class="row">
            <div class="col-md-9 gedf-main">
                @include('layouts._messages')
                <main class="py-4">
                    @yield('content')
                </main>
            </div>
							<div class="col-md-3 right-side-panel">
								<aside>
									@include('layouts._side')
								</aside>
							</div>
          </div>
    </div>
		<footer>
				<div id="footer">
				<div class="container text-center">
						 @include('layouts._footer')
				</div>
			</div>
		</footer>
  </div>
    <script>
    $(document).ready(function () { 
        $.cookieCuttr( 
            {
                cookieAnalyticsMessage: 'Tento web používa k poskytovaniu služieb, personalizácii reklám a analýze návštěvnosti súbory cookie. Používaním tohto webu s tým súhlasíte.'
            }
        );
    }); 
    </script>
</body>
</html>
