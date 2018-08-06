<?php
$e = \Podlove\get_episode();
?>
<tr class="archive-episode-row">
	<?php if ($e and $e->number() != '') : ?>
		<td class="archive-episode-icon">
			<?php
			$img = $e->image();
			if ( !$img )
				$img = \Podlove\get_podcast()->image();
			echo $img->html( array("width" => 96, "alt" => " " ) )
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
							<?php printf('<img src="%1$s" title="%2$s" alt="">', $c->avatar()->url(), $c->name()) ?>
						</div>
						<div class="episode-contributor-names">
							<?php printf('%1$s kiel %2$s', $c->name(), $c->role()) ?>
						</div>
					</div>
				<?php endif ?>
			<?php endforeach ?>
		</td>
	<?php elseif ($e->number() != '') : ?>
		<td class="archive-episode-icon"></td>
		<td colspan="2" class="archive-episode-description">
			<div class="episode-title">
				<a href="<?php echo the_permalink() ?>"><?php echo the_title() ?></a>
			</div>
			<div class="episode-meta">
				&#x1f4c5;&nbsp;<?php echo the_date() ?>
			</div>
			<div class="episode-excerpt"><?php echo the_content('',false,'') ?></div>
		</td>
	<?php endif ?>
</tr>
