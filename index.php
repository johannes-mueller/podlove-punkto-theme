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
			<style>
			<?php
			$img = $featured_episode->image();
			if ( !$img )
				$img = \Podlove\get_podcast()->image();
			?>
			@media screen and (min-width: 480px) {
			    #featured-episode-background { background-image: url('<?php echo $img ?>') }
			}
			</style>
			<div id="featured-episode-background">
			</div>
		</div>
		<div id="random-episodes">
			<?php
			$i = 0;
			foreach ( $eps as $e):
			?>
				<div class="episode-tile">
				    <a href="<?php echo $e->url() ?>">
					<?php
					$img = $e->image();
					if ( !$img ) {
					    $img = \Podlove\get_podcast()->image();
					}
					$title = $e->title();
					echo $img->html( array( "width" => 160, "class" => "episode-tile-image", "alt" => "$title"  ) );
					?>

				    </a>
				</div>
				<?php
				$i++;
				if ( $i > 9 ) {
				    break;
				}
				?>
			<?php endforeach ?>
		</div>
	</div>
	<div id="delimiter">
	</div>
</div>
<?php get_footer(); ?>
