<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/images/favicon.png" />
<title><?php if(is_home()) { echo bloginfo("name"); echo " | "; echo bloginfo("description"); } else { echo wp_title(" | ", false, right); echo bloginfo("name"); } ?></title>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); wp_head(); ?>

</head>
<body>
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-58405180-2', 'auto');
		ga('send', 'pageview');
	</script>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.5&appId=168069566726752";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<script>
		!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
	</script>
	<script>
		function onYtEvent(payload) {
			if (payload.eventType == 'subscribe') {
				// Add code to handle subscribe event.
			} else if (payload.eventType == 'unsubscribe') {
				// Add code to handle unsubscribe event.
			}
			if (window.console) { // for debugging only
				window.console.log('YT event: ', payload);
			}
		}
	</script>
	<header class="menu_bar">
		<div id="top_nav">
			<div class="content">
				<?php wp_nav_menu( array( 'menu' => 'segundo_menu', 'menu_class' => 'right', 'container_class' => 'content' ) ); ?>
			</div>
		</div>
		<nav>
			<div class="content">
				<a href="<?php echo site_url(); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/logo.png" alt="Menthes"></a>
				<?php wp_nav_menu( array( 'menu' => 'primeiro_menu', 'theme_location' => 'segundo_menu',  'menu_class' => 'nav-menu' ) ); ?>
			</div>
		</nav>
	</header>
	<header class="menu_bar_mobile">
		<div id="top_nav">
			<?php // wp_nav_menu( array( 'menu' => 'segundo_menu', 'menu_class' => 'right', 'container_class' => 'content' ) ); ?>
			<div class="menu_mobile">
				<select name="" id="menu_mobile">
					<option value=""></option>
					<?php wp_nav_menu( array( 'menu' => 'primeiro_menu', 'theme_location' => 'segundo_menu',  'menu_class' => 'nav-menu_mobile', 'walker' => new Walker_Nav_Menu_Dropdown() ) ); ?>
					<?php wp_nav_menu( array( 'menu' => 'segundo_menu', 'menu_class' => 'right', 'container_class' => 'content', 'walker' => new Walker_Nav_Menu_Dropdown() ) ); ?>
				</select>
			</div>
		</div>
		<nav>
			<div class="content">
				<a href="<?php echo site_url(); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/logo.png" alt="Menthes"></a>
			</div>
		</nav>
	</header>