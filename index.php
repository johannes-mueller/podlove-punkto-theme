<?php
get_header();
$eps = \Podlove\get_podcast()->episodes();
$featured_episode = array_shift($eps);
shuffle($eps);
?>
<div id="main">
	<div id="content">
		<div id="featured-episode">
			<div id="featured-episode-player">
				<?php echo $featured_episode->player() ?>
			</div>
			<div id="featured-episode-background" style="background-image: url('<?php echo $featured_episode->image() ?>')">
			</div>
		</div>
		<div id="random-episodes">
			<?php
			$i = 0;
			foreach ( $eps as $e):
			?>
				<div class="episode-tile">
					<a href="<?php echo $e->url() ?>">
						<?php echo $e->image()->html( array( "width" => 160, "class" => "episode-title-image" ) ) ?>

					</a>
					<?php
					$i++;
					if ( $i > 9 ) {
						break;
					}
					?>
				</div>
			<?php endforeach ?>
		</div>
	</div>
	<div id="delimiter">
	</div>
	<?php get_footer(); ?>
