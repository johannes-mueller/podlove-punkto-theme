<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'punktoinfo' ), get_search_query() ); ?></h1>
			</header>
			<table class="archive-table">
				<colgroup>
					<col id="episode-icon" width="<?php echo $icon-size + 16 ?>" />
					<col id="episode-description" />
					<col id="episode-contributors" />
				</colgroup>
				<tbody>

					<?php /* The loop */ ?>
					<?php while ( have_posts() ) {
						the_post();
						if ( get_post_type() == 'podcast' )
							get_template_part( 'content-archive', get_post_format() );
					}
					?>
				</tbody>
			</table>
			<?php punktoinfo_paging_nav(); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>
