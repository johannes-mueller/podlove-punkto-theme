<?php
/**
 * The template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header();
$e = \Podlove\get_episode();

?>

<?php if ($e) : ?>
	<div id="featured-episode">
		<div id="featured-episode-player">
			<?php echo $e->player() ?>
		</div>
		<div id="featured-episode-background" style="background-image: url('<?php echo $e->image() ?>')">
		</div>
		<div id="featured-episode-foreground">
			<?php punktoinfo_episode_nav(); ?>
		</div>
	</div>
<?php endif ?>
<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php if (!$e) : ?>
				<h1><?php echo the_title() ?></h1>
			<?php endif ?>
			<?php if ($e) : ?>
				<h2>Kontribuis</h2>
				<?php echo do_shortcode('[podlove-episode-contributor-list]'); ?>
			<?php endif ?>
			<?php get_template_part( 'content', get_post_format() );  ?>
			<?php if(!$e)
						punktoinfo_post_nav();
			?>
			<?php comments_template();  ?>
		<?php endwhile; ?>
	</div>
</div>


<?php get_footer(); ?>
