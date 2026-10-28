<?php
/**
 * The header.
 *
 * @package Rinova_Casa
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body id="top" <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#contenuto"><?php esc_html_e( 'Vai al contenuto', 'rinova-casa' ); ?></a>
<header class="site-header">
	<div class="container header-inner">
		<div class="site-brand">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a class="site-brand-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<span class="brand-mark" aria-hidden="true"><span></span><span></span><span></span></span>
					<span class="brand-name">rinova<span>casa</span><small><?php esc_html_e( 'RISTRUTTURAZIONI', 'rinova-casa' ); ?></small></span>
				</a>
			<?php endif; ?>
		</div>
		<button class="menu-toggle" type="button" aria-expanded="false" aria-controls="primary-menu">
			<span class="menu-toggle-label"><?php esc_html_e( 'Menu', 'rinova-casa' ); ?></span>
			<span class="menu-toggle-icon" aria-hidden="true"><i></i><i></i></span>
		</button>
		<nav class="primary-navigation" aria-label="<?php esc_attr_e( 'Menu principale', 'rinova-casa' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_id'        => 'primary-menu',
					'menu_class'     => 'nav-menu',
					'fallback_cb'    => 'rinova_casa_menu_fallback',
				)
			);
			?>
		</nav>
		<a class="header-cta" href="<?php echo esc_url( home_url( '/#richiedi-preventivo' ) ); ?>"><?php esc_html_e( 'Parliamone', 'rinova-casa' ); ?> <span aria-hidden="true">↗</span></a>
	</div>
</header>
<?php
function rinova_casa_menu_fallback() {
	?>
	<ul id="primary-menu" class="nav-menu">
		<li><a href="<?php echo esc_url( home_url( '/#servizi' ) ); ?>"><?php esc_html_e( 'Servizi', 'rinova-casa' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/#lavori' ) ); ?>"><?php esc_html_e( 'Lavori', 'rinova-casa' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/#metodo' ) ); ?>"><?php esc_html_e( 'Metodo', 'rinova-casa' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/#contatti' ) ); ?>"><?php esc_html_e( 'Contatti', 'rinova-casa' ); ?></a></li>
	</ul>
	<?php
}
