</div><!-- #main -->
<footer id="colophon" class="site-footer" role="contentinfo">
	<?php if ( get_theme_mod( 'punktoinfo_footer_logo' ) ) : ?>
		<div class="footer-logo">
			<img class="footer-logo" src="<?php echo esc_url( get_theme_mod( 'punktoinfo_footer_logo' ) ); ?>">
		</div>
	<?php endif ?>
	<?php if ( is_active_sidebar( 'footer_1' ) ) : ?>
		<div class="footer-elements">
			<?php dynamic_sidebar( 'footer_1' ) ?>
		</div>
	<?php endif ?>
        <div class="site-info">
		Fiere farite per Worpdress kun memhakita etoso. Kodo prunteprenita de la etoso 2013.<br>
		La enhavo de tiu ĉi retejo estas disponebla laŭ la permesilo Krea Komunaĵo Atribuite-Samkondiĉe 4.0 Tutmonda. Ni petas, ke vi informu nin, kiam vi uzas la materialon por ia celo. Des pli ni ĝojus, ke nia laboro estas utila. <img src="https://i.creativecommons.org/l/by-sa/4.0/80x15.png">
          </div><!-- .site-info -->
		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php wp_footer(); ?>
</body>
</html>
