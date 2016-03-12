<?php
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if (function_exists('podlove\\get_podcast')) {

$podcast = \Podlove\get_podcast();

foreach ($podcast->feeds() as $f) {
	$feeds[] = array(
	    "type" => $f->asset()->fileType()->type(),
	    "format" => $f->asset()->fileType()->extension(),
	    "url" => $f->url(),
	    "variant" => "high"
	);
}

$podcast_data = json_encode( array(
        "title" => $podcast->title(),
	"subtitle" => $podcast->subtitle(),
	"description" => $podcast->summary(),
	"cover" => $podcast->image()->url(),
	"feeds" => $feeds
),JSON_UNESCAPED_SLASHES);

$theme_options = (array) get_option('punktoinfo-setting');
$facebook_profile = $theme_options['facebook-profile'];
$twitter_profile = $theme_options['twitter-profile'];
$vk_profile = $theme_options['vk-profile'];
$flattr_profile = $theme_options['flattr-profile'];

$favicon_link = $theme_options['favicon-link'];

} else {
	$podcast = 0;
}

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php bloginfo( 'name' ); ?> | <?php bloginfo( 'description' ); ?></title>
	<?php if ( $favicon_link ) : ?>	<link rel="icon" href="<?php echo $favicon_link ?>" type="image/vnd.microsoft.icon"><?php endif ?>
	<?php wp_head(); ?>
	<script>window.podcastData = <?php echo $podcast_data ?></script>
</head>
<body>
        <header id="masthead" class="site-header" role="banner">
		<?php if ($podcast) : ?>
		<div class="contact-button-bar">
			<div id="contact-button-container">
				<ul id="contact-buttons">
					<?php if ($facebook_profile !== '' && isset($facebook_profile) ) : ?>
						<li><a id="FB" class="contact-button" target="_blank"
							    href="https://www.facebook.com/<?php echo $facebook_profile ?>"></a></li>
					<?php endif ?>
					<?php if ($vk_profile !== '' && isset($vk_profile) ) : ?>
						<li><a id="VK" class="contact-button" target="_blank"
							    href="https://vk.com/<?php echo $vk_profile ?>"></a></li>
					<?php endif ?>
					<?php if ($twitter_profile !== '' && isset($twitter_profile) ) : ?>
						<li><a id="TW" class="contact-button" target="_blank"
							    href="https://twitter.com/<?php echo $twitter_profile ?>/"></a></li>
					<?php endif ?>
					<?php if ($flattr_profile !== '' && isset($flattr_profile) ) : ?>
						<li><a id="flattr" class="contact-button" target="_blank"
							    href="https://flattr.com/submit/auto?user_id=<?php
													 echo $flattr_profile
													 ?>&url=<?php
														echo urlencode( get_bloginfo('url') )
														?>"></a></li>
					<?php endif ?>
					<li>
						<script class="podlove-subscribe-button"
							src="https://cdn.podlove.org/subscribe-button/javascripts/app.js"
							data-language="eo"
							data-size="auto"
							data-json-data="podcastData"
							data-colors="#3A1F00;#B62900;#DF3200"
							data-buttonid="subscribeButton"
							data-hide="true">
						</script>
						<a href="#" id="subscribe-button" class="podlove-subscribe-button-subscribeButton"></a>
					</li>
					<li class="feed-menu">
						<a href="#"></a>
						<ul>
							<?php foreach ($podcast->feeds() as $f) : ?>
								<li>
									<a class="feed-menu-item" href="<?php echo $f->url() ?>">
										<?php echo $f->asset()->fileType()->extension() ?>
									</a>
								</li>
							<?php endforeach ?>
						</ul>
					</li>
				</ul>
				<style>
				 #FB       { background-image: url('/wp-content/themes/punktoinfo/images/FB_blanka.svg'); }
				 #FB:hover { background-image: url('/wp-content/themes/punktoinfo/images/FB_inversa.svg'); }
				 #VK       { background-image: url('/wp-content/themes/punktoinfo/images/VK_blanka.svg'); }
				 #VK:hover { background-image: url('/wp-content/themes/punktoinfo/images/VK_inversa.svg'); }
				 #TW       { background-image: url('/wp-content/themes/punktoinfo/images/TW_blanka.svg'); }
				 #TW:hover { background-image: url('/wp-content/themes/punktoinfo/images/TW_inversa.svg'); }
				 #flattr       { background-image: url('/wp-content/themes/punktoinfo/images/flattr_blanka.svg'); }
				 #flattr:hover { background-image: url('/wp-content/themes/punktoinfo/images/flattr_inversa.svg'); }
				 #subscribe-button       { background-image: url('/wp-content/themes/punktoinfo/images/aboni_blanka.svg'); }
				 #subscribe-button:hover { background-image: url('/wp-content/themes/punktoinfo/images/aboni_inversa.svg'); }
				</style>
			</div>
		</div>
		<?php endif ?>
		<a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<img class="title-image" src="<?php echo get_header_image() ?>">
		</a>
		<div id="navbar" class="navbar">
			<nav id="site-navigation" class="navigation main-navigation" role="navigation">
				<button class="menu-toggle"><?php _e( 'Menu', 'punkto.info' ); ?></button>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'menu_class' => 'nav-menu',
					'menu_id' => 'primary-menu' ) );
				?>
				<?php get_search_form(); ?>
			</nav><!-- #site-navigation -->
		</div><!-- #navbar -->
	</header><!-- #masthead -->
