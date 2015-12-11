<?php
$e = \Podlove\get_episode();

?>

<div id="featured-episode">
	<div id="featured-episode-player">
		<?php echo $e->player() ?>
	</div>
	<div id="featured-episode-background" style="background-image: url('<?php echo $e->imageUrlWithFallback() ?>')">
	</div></div>
