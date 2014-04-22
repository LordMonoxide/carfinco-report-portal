<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>CARFINCO</title>
        <meta name="description" content="Login area for CARFINCO">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link rel="icon" href="_assets/images/favicon.ico">
        {{ HTML::style('_assets/css/normalize.css') }}
        {{ HTML::style('_assets/css/screen.css') }}
        {{ HTML::script('_assets/js/jquery-1.8.3.js') }}
        {{ HTML::script('_assets/js/plugins.js') }}
        {{ HTML::script('_assets/js/init.js') }}
        {{ HTML::script('_assets/js/modernizr.2.0.6.js') }}
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
		
		<div class="site-wrap">
			<header class="site-block">
				<div id="logo">
					<a href="#" title="CARFINCO">CARFINCO</a>
				</div>
				<nav id="primary">
					<ul>
						<li>{{ HTML::linkAction('reports',      'Reports') }}</li>
						<li>{{ HTML::linkAction('profile.view', 'Profile') }}</li>
						<li>{{ HTML::linkAction('help',         'Help')    }}</li>
						<li>{{ HTML::linkAction('auth.logout',  'Logout')  }}</li>
					</ul>
				</nav>
			</header>
      
      @yield('body')
    </body>
</html>