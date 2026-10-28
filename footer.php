<?php
/**
 * The footer.
 *
 * @package Rinova_Casa
 */
?>
<footer class="site-footer">
	<div class="container footer-main">
		<div class="footer-brand">
			<div class="site-brand site-brand--light">
				<?php if ( has_custom_logo() ) : ?>
					<?php the_custom_logo(); ?>
				<?php else : ?>
					<a class="site-brand-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<span class="brand-mark" aria-hidden="true"><span></span><span></span><span></span></span>
						<span class="brand-name">rinova<span>casa</span><small><?php esc_html_e( 'RISTRUTTURAZIONI', 'rinova-casa' ); ?></small></span>
					</a>
				<?php endif; ?>
			</div>
			<p><?php esc_html_e( 'Spazi pensati per viverli. Lavori seguiti con cura, dall’inizio alla fine.', 'rinova-casa' ); ?></p>
		</div>
		<div class="footer-contact">
			<span class="footer-label"><?php esc_html_e( 'PARLIAMONE', 'rinova-casa' ); ?></span>
			<a href="<?php echo esc_url( home_url( '/#richiedi-preventivo' ) ); ?>"><?php esc_html_e( 'Raccontaci cosa hai in mente', 'rinova-casa' ); ?> <span aria-hidden="true">↗</span></a>
			<span class="footer-area"><?php echo esc_html( get_theme_mod( 'rinova_service_area', __( 'La tua zona', 'rinova-casa' ) ) ); ?></span>
			<a class="footer-privacy" href="<?php echo esc_url( rinova_casa_privacy_url() ); ?>"><?php esc_html_e( 'Privacy', 'rinova-casa' ); ?></a>
		</div>
	</div>
	<div class="container footer-bottom">
		<span>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> Rinova Casa</span>
		<span><?php esc_html_e( 'Impresa immaginaria — tema dimostrativo WordPress', 'rinova-casa' ); ?></span>
		<a href="#top"><?php esc_html_e( 'Torna su', 'rinova-casa' ); ?> ↑</a>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
