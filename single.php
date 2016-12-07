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

$icon_size = 96;
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
				<?php $releps = $e->relatedEpisodes(); ?>
			<?php endif ?>
			<?php get_template_part( 'content', get_post_format() );  ?>
			<?php if ($e) : ?>
				<?php if ($releps) : ?>
					<h2>Rilataj epizodeoj</h2>
					<table class="archive-table">
						<colgroup>
							<col id="episode-icon" width="<?php echo $icon_size + 16 ?>" />
							<col id="episode-description" />
							<col id="episode-contributors" />
						</colgroup>
						<tbody>
							<?php foreach ($releps as $re) : ?>
								<tr class="archive-episode-row">
									<td class="archive-episode-icon">
										<?php
										$img = $re->image();
										if ( !$img )
											$img = \Podlove\get_podcast()->image();
										echo $img->html( array("width" => $icon_size ) )
										?>
									</td>
									<td class="archive-episode-description">
										<div class="episode-title">
											<a href="<?php echo $re->url() ?>"><?php echo $re->title() ?></a>
										</div>
										<div class="episode-meta">
											&#x1f4c5;&nbsp;<?php echo $re->publicationDate()->format('Y-m-d') ?>
											<?php echo punktoinfo_print_duration($re->duration()); ?>
										</div>
										<div class="episode-subtitle">
											<?php echo $re->subtitle() ?>
										</div>
									</td>
									<td>
										<?php foreach ($re->contributors() as $c) : ?>
											<?php if ($c->role() != "aŭtoro") : ?>
												<div class="episode-contributor">
													<div class="episode-contributor-avatars">
														<?php printf('<img src="%1$s" title="%2$s" width="48" heigth="48">', $c->avatar()->url(), $c->name()) ?>
													</div>
													<div class="episode-contributor-names">
														<?php printf('%1$s kiel %2$s', $c->name(), $c->role()) ?>
													</div>
												</div>
											<?php endif ?>
										<?php endforeach ?>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				<?php endif ?>
				<?php punktoinfo_post_nav(); ?>
			<?php endif?>
			<?php comments_template();  ?>
		<?php endwhile; ?>
	</div>
</div>


<?php get_footer(); ?>
