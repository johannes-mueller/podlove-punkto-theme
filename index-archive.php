<?php
/**
 * Template Name: Index Archive
 */
$eps = \Podlove\get_podcast()->episodes();
$featured_episode = array_shift($eps);

$q = new WP_Query( array(
        'post_type' => array('podcast', 'post'),
	'orderby' => 'date',
	'posts_per_page' => 10)
);
query_posts($q->query);


get_header();
?>
<div id="main">
	<div id="featured-episode">
		<div id="featured-episode-player">
			<?php echo $featured_episode->player() ?>
		</div>
		<div id="featured-episode-background" style="background-image: url('<?php echo $featured_episode->image() ?>')">
		</div>
	</div>
	<div class="site-content">
		<table class="archive-table">
			<colgroup>
				<col id="episode-icon" width="<?php echo $icon_size + 16 ?>" />
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
	</div>
	<div id="delimiter">
	</div>
	<?php get_footer(); ?>
