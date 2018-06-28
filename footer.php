<footer id="colophon" class="site-footer" role="contentinfo">
        <?php $footer_logo = get_theme_mod( 'punktoinfo_footer_logo' )  ?>
	<?php if ( $footer_logo ) : ?>
		<?php
			if (stripos($footer_logo, 'http://') === 0) {
				$footer_logo = 'https' . substr($footer_logo, 4);
			}
		?>
		<div class="footer-logo">
			<img class="footer-logo" alt="" src="<?php echo esc_url($footer_logo); ?>">
		</div>
	<?php endif ?>
	<?php if ( is_active_sidebar( 'footer_1' ) ) : ?>
		<div class="footer-elements">
			<?php dynamic_sidebar( 'footer_1' ) ?>
		</div>
	<?php endif ?>
        <div class="site-info">
		Fiere farite per Worpdress kun memhakita etoso. Kodo prunteprenita de la etoso 2013. <a href="https://johannes-mueller.org/datumprotektado.html">Datumprotekado</a><br>
		La enhavo de tiu ĉi retejo estas disponebla laŭ la permesilo Krea Komunaĵo Atribuite-Samkondiĉe 4.0 Tutmonda. Ni petas, ke vi informu nin, kiam vi uzas la materialon por ia celo. Des pli ni ĝojus, ke nia laboro estas utila. <img alt="CC-BY-SA-4.0" src="/img/cc-by-sa.png">
        </div><!-- .site-info -->
</footer><!-- #colophon -->
		</div><!-- #page -->



</body>
</html>
