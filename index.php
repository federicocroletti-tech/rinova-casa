<?php
/**
 * Fallback template for posts and pages.
 *
 * @package Rinova_Casa
 */
get_header();
?>
<main id="contenuto" class="container content-layout">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<article <?php post_class( 'content-entry' ); ?>>
				<p class="eyebrow"><span class="eyebrow-line"></span><?php echo esc_html( get_post_type_object( get_post_type() )->labels->singular_name ); ?></p>
				<h1><?php the_title(); ?></h1>
				<?php if ( has_post_thumbnail() ) : ?><div class="content-featured-image"><?php the_post_thumbnail( 'large' ); ?></div><?php endif; ?>
				<div class="entry-content"><?php the_content(); ?></div>
			</article>
		<?php endwhile; ?>
		<?php the_posts_pagination(); ?>
	<?php else : ?>
		<h1><?php esc_html_e( 'Nessun contenuto trovato', 'rinova-casa' ); ?></h1>
		<p><?php esc_html_e( 'Prova a consultare le altre pagine del sito.', 'rinova-casa' ); ?></p>
	<?php endif; ?>
</main>
<?php get_footer(); ?>
