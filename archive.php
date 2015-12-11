<?php
/*
Template Name: Archives
 */
get_header();

if ($pagename == 'arkivo') {
	$q = new WP_Query( array(
            'post_type' => array('podcast', 'post'),
            'orderby' => 'date',
            'posts_per_page' => -1)
    );
	query_posts($q->query);
}


?>
<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">

		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h1 class="archive-title">
					<?php
					if ( is_day() ) :
						printf( __( 'Daily Archives: %s', 'punktoinfo' ), get_the_date() );
					elseif ( is_month() ) :
							printf( __( 'Monthly Archives: %s', 'punktoinfo' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'punktoinfo' ) ) );
					elseif ( is_year() ) :
								printf( __( 'Yearly Archives: %s', 'punktoinfo' ), get_the_date( _x( 'Y', 'yearly archives date format', 'punktoinfo' ) ) );
					else :
									_e( 'Archives', 'punktoinfo' );
					endif;
					?>
				</h1>
			</header><!-- .archive-header -->

			<table class="archive-table">
				<colgroup>
					<col id="episode-icon" width="<?php echo $icon-size + 16 ?>" />
					<col id="episode-description" />
					<col id="episode-contributors" />
				</colgroup>
				<tbody>

					<?php /* The loop */ ?>
					<?php
					while ( have_posts() ) {
						the_post();
						get_template_part('content-archive', get_post_format());
					}
					?>
				</tbody>
			</table>
		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

	</div><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>
