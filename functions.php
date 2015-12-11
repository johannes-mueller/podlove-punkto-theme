<?php

function punktoinfo_setup()
{
        add_theme_support( 'html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption') );

        add_theme_support( 'custom-header', array(
                'default-image'          => '',
                'width'                  => 0,
                'height'                 => 0,
                'flex-height'            => true,
                'flex-width'             => false,
                'uploads'                => true,
                'random-default'         => false,
                'header-text'            => true,
                'default-text-color'     => '',
                'wp-head-callback'       => '',
                'admin-head-callback'    => '',
                'admin-preview-callback' => '',
        ) );

        register_nav_menu( 'primary', __( 'Navigation Menu', 'punkto-info' ) );
}

add_action( 'after_setup_theme', 'punktoinfo_setup' );


function punktoinfo_post_nav() {
	global $post;

	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous )
		return;
	?>
	<nav class="navigation post-navigation" role="navigation">
		<div class="nav-links">

			<?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'punktoinfo' ) ); ?>
			<?php next_post_link( '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'punktoinfo' ) ); ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}

function punktoinfo_paging_nav() {
	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'punktoinfo' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'punktoinfo' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'punktoinfo' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}




function punktoinfo_entry_meta() {
	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<span class="featured-post">' . esc_html__( 'Sticky', 'punktoinfo' ) . '</span>';

	if ( ! has_post_format( 'link' ) && ('post' == get_post_type() || 'podcast' == get_post_type()) )
		punktoinfo_entry_date();

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'punktoinfo' ) );
	if ( $categories_list ) {
		echo '<span class="categories-links">' . $categories_list . '</span>';
	}

	// Translators: used between list items, there is a space after the comma.
    $tag_list = get_the_tag_list( '', __( ', ', 'punktoinfo' ) );
	if ( $tag_list ) {
		echo '<span class="tags-links">' . $tag_list . '</span>';
	}
}

function punktoinfo_entry_date( $echo = true ) {
	if ( has_post_format( array( 'chat', 'status' ) ) )
		$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'punktoinfo' );
	else
		$format_prefix = '%2$s';

	$date = sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'punktoinfo' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);

	if ( $echo )
		echo $date;

	return $date;
}

/*
function punktoinfo_print_date( $date ) {
        printf('<img src="/bildoj/icon-calendar-128x128.png" width="16" height="16"> %1$s', $date->format('d.m.Y'));
}
*/

function punktoinfo_print_duration( $duration ) {
        echo '&#x23f1;&nbsp';
        $h = $duration->hours();
        if ( $h == 1 ) {
                printf('1 horo ');
        } elseif ( $h != 0 ) {
                printf('%d hours ', $h);
        }

        $m = $duration->minutes();
        if ( $m == 1 ) {
                printf('1 minuto');
        } elseif ( $m != 0 ) {
                printf('%d minutoj', $m);
        }
}

add_filter('pre_get_posts', 'only_podcasts_in_archive');

function only_podcasts_in_archive($query)
{
        if (is_archive()) {
                $query->set('post_type', array('post', 'podcast'));
                $query->set('orderby', 'date');
                $query->set('order', 'DESC');

                return $query;
        }
}


function footer_widgets_init() {
	register_sidebar( array (
		'name' => 'Footer sidebar',
		'id' => 'footer_1',
		'before_widget' => '<div id="%1$s" class="footer-element">',
		'after_widget' => '</div>'
	) );
}

add_action( 'widgets_init', 'footer_widgets_init' );



function punktoinfo_theme_options_page() {
    add_theme_page( 'Options', 'Options', 'edit_theme_options', 'punktoinfo-options-page', 'punktoinfo_options_page' );
}

add_action( 'admin_menu', 'punktoinfo_theme_options_page' );


function punktoinfo_theme_options_init() {
	register_setting( 'punktoinfo-settings-group', 'punktoinfo-setting' );
	add_settings_section( 'section-social', 'Social Networks', 'section_social_callback', 'punktoinfo-options-page' );
	add_settings_field( 'facebook-profile', 'Facebook profile', 'facebook_field_callback', 'punktoinfo-options-page', 'section-social' );
	add_settings_field( 'twitter-profile', 'Twitter profile', 'twitter_field_callback', 'punktoinfo-options-page', 'section-social' );
	add_settings_field( 'vk-profile', 'VK profile', 'vk_field_callback', 'punktoinfo-options-page', 'section-social' );
	add_settings_field( 'flattr-profile', 'Flattr account', 'flattr_field_callback', 'punktoinfo-options-page', 'section-social' );
}

add_action( 'admin_init', 'punktoinfo_theme_options_init' );

function section_social_callback() {
}

function facebook_field_callback() {
	$setting_array = (array) get_option( 'punktoinfo-setting' );
	$setting = esc_attr( $setting_array['facebook-profile'] );
	echo "<input type='text' name='punktoinfo-setting[facebook-profile]' value='$setting'>";
}

function vk_field_callback() {
	$setting_array = (array) get_option( 'punktoinfo-setting' );
	$setting = esc_attr( $setting_array['vk-profile'] );
	echo "<input type='text' name='punktoinfo-setting[vk-profile]' value='$setting'>";
}

function twitter_field_callback() {
	$setting_array = (array) get_option( 'punktoinfo-setting' );
	$setting = esc_attr( $setting_array['twitter-profile'] );
	echo "<input type='text' name='punktoinfo-setting[twitter-profile]' value='$setting'>";
}

function flattr_field_callback() {
	$setting_array = (array) get_option( 'punktoinfo-setting' );
	$setting = esc_attr( $setting_array['flattr-profile'] );
	echo "<input type='text' name='punktoinfo-setting[flattr-profile]' value='$setting'>";
}

function punktoinfo_options_page() {
       if ( ! isset( $_REQUEST['settings-updated'] ) ) {
               $_REQUEST['settings-updated'] = false;
       }
?>
	<div class="wrap">
		<h2>Punktoinfo Options</h2>
		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
			<div class="updated fade">
				<p><strong>Einstellungen gespeichert!</strong></p>
			</div>
		<?php endif; ?>
		<form action="options.php" method="POST">
			<?php settings_fields( 'punktoinfo-settings-group' ); ?>
			<?php do_settings_sections( 'punktoinfo-options-page' ); ?>
			<?php submit_button(); ?>
		</form>
	</div>
<?php
}
