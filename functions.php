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


function punktoinfo_scripts_styles() {
	wp_enqueue_style( 'punktoinfo-style', get_stylesheet_uri(), array() );
}
add_action( 'wp_enqueue_scripts', 'punktoinfo_scripts_styles' );


function punktoinfo_theme_customizer( $wp_customize ) {
	$wp_customize->add_section( 'punktoinfo_footer_logo_section', array(
		'title'      => __( 'Footer logo', 'punktoinfo' ),
		'priority'   => 100,
		'descripton' => 'Upload a logo to appear in the footer.',
	) );

	$wp_customize->add_setting( 'punktoinfo_footer_logo' );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'punktoinfo_footer_logo', array(
		'label'    => __( 'Logo image', 'punktoinfo' ),
		'section'  => 'punktoinfo_footer_logo_section',
		'settings' => 'punktoinfo_footer_logo',
	) ) );
}

add_action( 'customize_register', punktoinfo_theme_customizer );

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

function punktoinfo_episode_nav() {
	global $post;

	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous )
		return;
?>

			<?php if ($previous) :?>
				<a class="prev-button" href="<?php echo get_permalink($previous) ?>">
					<img class="prev-button-image" src="/wp-content/themes/punktoinfo/images/prev-button.svg">
				</a>
			<?php endif ?>
			<?php if ($next) :?>
				<a class="next-button" href="<?php echo get_permalink($next) ?>">
					<img class="next-button-image" src="/wp-content/themes/punktoinfo/images/next-button.svg">
				</a>
			<?php endif ?>

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

	add_settings_section( 'section-favicon', 'Favicon', 'section_favicon_callback', 'punktoinfo-options-page' );
	add_settings_field( 'favicon-link', 'Link to favicon', 'favicon_field_callback', 'punktoinfo-options-page', 'section-favicon' );

	add_settings_section( 'section-social', 'Social Networks', 'section_social_callback', 'punktoinfo-options-page' );
	add_settings_field( 'facebook-profile', 'Facebook profile', 'facebook_field_callback', 'punktoinfo-options-page', 'section-social' );
	add_settings_field( 'twitter-profile', 'Twitter profile', 'twitter_field_callback', 'punktoinfo-options-page', 'section-social' );
	add_settings_field( 'vk-profile', 'VK profile', 'vk_field_callback', 'punktoinfo-options-page', 'section-social' );
	add_settings_field( 'flattr-profile', 'Flattr account', 'flattr_field_callback', 'punktoinfo-options-page', 'section-social' );
}

add_action( 'admin_init', 'punktoinfo_theme_options_init' );

function favicon_field_callback() {
	$setting_array = (array) get_option( 'punktoinfo-setting' );
	$setting = esc_attr( $setting_array['favicon-link'] );
	echo "<input type='text' name='punktoinfo-setting[favicon-link]' value='$setting'>";
}

function section_favicon_callback() {
}

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

function set_tag_cloud_sizes($args) {
	$args = array_merge( $args, array('smallest' => 6, 'largest' => 19) );
	return $args;
}

add_filter('widget_tag_cloud_args','set_tag_cloud_sizes');



function punktoinfo_get_episode_calendar( $initial = true, $echo = true ) {
	global $wpdb, $m, $monthnum, $year, $wp_locale, $posts;

	// Quick check. If we have no posts at all, abort!
	if ( ! $posts ) {
		$gotsome = $wpdb->get_var("SELECT 1 as test FROM $wpdb->posts WHERE post_type = 'podcast' AND post_status = 'publish' LIMIT 1");
		if ( ! $gotsome ) {
			$cache[ $key ] = '';
			wp_cache_set( 'get_calendar', $cache, 'calendar' );
			return;
		}
	}
	if ( isset( $_GET['w'] ) ) {
		$w = (int) $_GET['w'];
	}
	// week_begins = 0 stands for Sunday
	$week_begins = (int) get_option( 'start_of_week' );
	$ts = current_time( 'timestamp' );

	// Let's figure out when we are
	if ( ! empty( $monthnum ) && ! empty( $year ) ) {
		$thismonth = zeroise( intval( $monthnum ), 2 );
		$thisyear = (int) $year;
	} elseif ( ! empty( $w ) ) {
		// We need to get the month from MySQL
		$thisyear = (int) substr( $m, 0, 4 );
		//it seems MySQL's weeks disagree with PHP's
		$d = ( ( $w - 1 ) * 7 ) + 6;
		$thismonth = $wpdb->get_var("SELECT DATE_FORMAT((DATE_ADD('{$thisyear}0101', INTERVAL $d DAY) ), '%m')");
	} elseif ( ! empty( $m ) ) {
		$thisyear = (int) substr( $m, 0, 4 );
		if ( strlen( $m ) < 6 ) {
			$thismonth = '01';
		} else {
			$thismonth = zeroise( (int) substr( $m, 4, 2 ), 2 );
		}
	} else {
		$thisyear = gmdate( 'Y', $ts );
		$thismonth = gmdate( 'm', $ts );
	}

	$unixmonth = mktime( 0, 0 , 0, $thismonth, 1, $thisyear );
	$last_day = date( 't', $unixmonth );

	// Get the next and previous month and year with at least one post
	$previous = $wpdb->get_row("SELECT MONTH(post_date) AS month, YEAR(post_date) AS year
		FROM $wpdb->posts
		WHERE post_date < '$thisyear-$thismonth-01'
		AND post_type = 'podcast' AND post_status = 'publish'
			ORDER BY post_date DESC
			LIMIT 1");
	$next = $wpdb->get_row("SELECT MONTH(post_date) AS month, YEAR(post_date) AS year
		FROM $wpdb->posts
		WHERE post_date > '$thisyear-$thismonth-{$last_day} 23:59:59'
		AND post_type = 'podcast' AND post_status = 'publish'
			ORDER BY post_date ASC
			LIMIT 1");

	/* translators: Calendar caption: 1: month name, 2: 4-digit year */
	$calendar_caption = _x('%1$s %2$s', 'calendar caption');
	$calendar_output = '<table id="wp-calendar">
	<caption>' . sprintf(
		$calendar_caption,
		$wp_locale->get_month( $thismonth ),
		date( 'Y', $unixmonth )
	) . '</caption>
	<thead>
	<tr>';

	$myweek = array();

	for ( $wdcount = 0; $wdcount <= 6; $wdcount++ ) {
		$myweek[] = $wp_locale->get_weekday( ( $wdcount + $week_begins ) % 7 );
	}

	foreach ( $myweek as $wd ) {
		$day_name = $initial ? $wp_locale->get_weekday_initial( $wd ) : $wp_locale->get_weekday_abbrev( $wd );
		$wd = esc_attr( $wd );
		$calendar_output .= "\n\t\t<th scope=\"col\" title=\"$wd\">$day_name</th>";
	}

	$calendar_output .= '
	</tr>
	</thead>

	<tfoot>
	<tr>';

	if ( $previous ) {
		$calendar_output .= "\n\t\t".'<td colspan="3" id="prev"><a href="' . get_month_link( $previous->year, $previous->month ) . '">&laquo; ' .
			$wp_locale->get_month_abbrev( $wp_locale->get_month( $previous->month ) ) .
		'</a></td>';
	} else {
		$calendar_output .= "\n\t\t".'<td colspan="3" id="prev" class="pad">&nbsp;</td>';
	}

	$calendar_output .= "\n\t\t".'<td class="pad">&nbsp;</td>';

	if ( $next ) {
		$calendar_output .= "\n\t\t".'<td colspan="3" id="next"><a href="' . get_month_link( $next->year, $next->month ) . '">' .
			$wp_locale->get_month_abbrev( $wp_locale->get_month( $next->month ) ) .
		' &raquo;</a></td>';
	} else {
		$calendar_output .= "\n\t\t".'<td colspan="3" id="next" class="pad">&nbsp;</td>';
	}

	$calendar_output .= '
	</tr>
	</tfoot>

	<tbody>
	<tr>';

	$daywithpost = array();

	// Get days with posts
	$dayswithposts = $wpdb->get_results("SELECT DISTINCT DAYOFMONTH(post_date)
		FROM $wpdb->posts WHERE post_date >= '{$thisyear}-{$thismonth}-01 00:00:00'
		AND post_type = 'podcast' AND post_status = 'publish'
		AND post_date <= '{$thisyear}-{$thismonth}-{$last_day} 23:59:59'", ARRAY_N);
	if ( $dayswithposts ) {
		foreach ( (array) $dayswithposts as $daywith ) {
			$daywithpost[] = $daywith[0];
		}
	}

	// See how much we should pad in the beginning
	$pad = calendar_week_mod( date( 'w', $unixmonth ) - $week_begins );
	if ( 0 != $pad ) {
		$calendar_output .= "\n\t\t".'<td colspan="'. esc_attr( $pad ) .'" class="pad">&nbsp;</td>';
	}

	$newrow = false;
	$daysinmonth = (int) date( 't', $unixmonth );

	for ( $day = 1; $day <= $daysinmonth; ++$day ) {
		if ( isset($newrow) && $newrow ) {
			$calendar_output .= "\n\t</tr>\n\t<tr>\n\t\t";
		}
		$newrow = false;

		if ( $day == gmdate( 'j', $ts ) &&
			$thismonth == gmdate( 'm', $ts ) &&
			$thisyear == gmdate( 'Y', $ts ) ) {
			$calendar_output .= '<td id="today">';
		} else {
			$calendar_output .= '<td>';
		}

		if ( in_array( $day, $daywithpost ) ) {
			// any posts today?
			$date_format = date( _x( 'F j, Y', 'daily archives date format' ), strtotime( "{$thisyear}-{$thismonth}-{$day}" ) );
			$label = sprintf( __( 'Posts published on %s' ), $date_format );
			$calendar_output .= sprintf(
				'<a href="%s" aria-label="%s" class="calendar-highlight">%s</a>',
				get_day_link( $thisyear, $thismonth, $day ),
				esc_attr( $label ),
				$day
			);
		} else {
			$calendar_output .= $day;
		}
		$calendar_output .= '</td>';

		if ( 6 == calendar_week_mod( date( 'w', mktime(0, 0 , 0, $thismonth, $day, $thisyear ) ) - $week_begins ) ) {
			$newrow = true;
		}
	}

	$pad = 7 - calendar_week_mod( date( 'w', mktime( 0, 0 , 0, $thismonth, $day, $thisyear ) ) - $week_begins );
	if ( $pad != 0 && $pad != 7 ) {
		$calendar_output .= "\n\t\t".'<td class="pad" colspan="'. esc_attr( $pad ) .'">&nbsp;</td>';
	}
	$calendar_output .= "\n\t</tr>\n\t</tbody>\n\t</table>";

	$cache[ $key ] = $calendar_output;
	wp_cache_set( 'get_calendar', $cache, 'calendar' );

	if ( $echo ) {
		echo $calendar_output;
		return;
	}

	return $calendar_output;
}

add_filter('get_calendar', 'punktoinfo_get_episode_calendar', 1, 2);


load_theme_textdomain( 'punktoinfo', get_template_directory().'/languages/' );
