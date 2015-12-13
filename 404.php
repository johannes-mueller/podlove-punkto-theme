<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<header class="entry-header">
				<h1 class="entry-title"><?php _e( "— four-O-four — not found — 404", 'punktoinfo' ); ?></h1>
			</header>

			<div class="entry-content">
				<h2><?php _e( 'We don&rsquo;t know who has taken you here.', 'punktoinfo' ); ?></h2>
				<p><?php _e( 'Maybe you clicked on a wrong or obsolete link?<br>Or typed in a wrong address?', 'punktoinfo' ); ?></p>
			</div><!-- .entry-content -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>
