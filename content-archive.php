<?php
$e = \Podlove\get_episode();
$icon_size = 96;
?>
<tr class="archive-episode-row">
	<?php if ($e) : ?>
		<td class="archive-episode-icon">
			<?php
			if ( $e->image() )
				echo $e->image()->html( array("width" => $icon_size ) )
			?>
		</td>
		<td class="archive-episode-description">
			<div class="episode-title">
				<a href="<?php echo the_permalink() ?>"><?php echo the_title() ?></a>
			</div>
			<div class="episode-meta">
				&#x1f4c5;&nbsp;<?php echo the_date() ?>
				<?php echo punktoinfo_print_duration($e->duration()); ?>
			</div>
			<div class="episode-subtitle">
				<?php echo $e->subtitle() ?>
			</div>
		</td>
		<td>
			<?php foreach ($e->contributors() as $c) : ?>
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
			</div>
		</td>
	<?php else : ?>
		<td class="archive-episode-icon"></td>
		<td colspan="3" class="archive-episode-description">
			<div class="episode-title">
				<a href="<?php echo the_permalink() ?>"><?php echo the_title() ?></a>
			</div>
			<div class="episode-meta">
				&#x1f4c5;&nbsp;<?php echo the_date() ?>
			</div>
			<div class="episode-excerpt"><?php echo the_content('',false,'') ?>
		</td>

	<?php endif ?>
</tr>
