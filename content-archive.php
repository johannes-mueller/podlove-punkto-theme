<?php
$e = \Podlove\get_episode();
$icon_size = 96;
?>
<tr class="archive-episode-row">
	<?php if ($e) : ?>
		<td class="archive-episode-icon">
			<?php echo $e->image()->html( array("width" => $icon_size ) ) ?>
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
			<div class="episode-contributor-avatars">
				<?php
				foreach ($e->contributors() as $c) {
					if ($c->role() != "aŭtoro") {
						printf('<img src="%1$s" title="%2$s" width="48" heigth="48">',
							$c->avatar()->url(), $c->name());
					}
				}
				?>
			</div>
		</td>
		<td>
			<div class="episode-contributor-names">
				<?php
				$contributer_seen = false;
				foreach ($e->contributors() as $c) {
					if ($c->role() != "aŭtoro") {
						if ($contributer_seen) echo ", ";
						printf('%1$s kiel %2$s', $c->name(), $c->role());
						$contributer_seen = true;
					}
				}
				?>
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
