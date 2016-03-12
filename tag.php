<?php
get_header(); ?>

<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">

		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h1 class="archive-title"><?php printf( __( 'Tag Archives: %s', 'punktoinfo' ), single_tag_title( '', false ) ); ?></h1>

				<?php if ( tag_description() ) : // Show an optional tag description ?>
					<div class="archive-meta"><?php echo tag_description(); ?></div>
				<?php endif; ?>
			</header><!-- .archive-header -->

			<table>
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
						if ( get_post_type() != "podcast" ) continue;
						get_template_part('content-archive', get_post_format());
					}
					?>
				</tbody>
			</table>
		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		<?php punktoinfo_paging_nav(); ?>


	</div><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>
