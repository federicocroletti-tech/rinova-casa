<?php
/**
 * The front page.
 *
 * @package Rinova_Casa
 */
get_header();
$project_query = new WP_Query(
	array(
		'post_type'      => 'rinova_progetto',
		'posts_per_page' => 3,
	)
);
?>
<main id="contenuto">
	<section class="hero">
		<div class="container hero-grid">
			<div class="hero-copy">
				<p class="eyebrow"><span class="eyebrow-line"></span><?php echo esc_html( get_theme_mod( 'rinova_eyebrow', __( 'Ristrutturazioni, senza sorprese', 'rinova-casa' ) ) ); ?></p>
				<h1><?php echo esc_html( get_theme_mod( 'rinova_headline', __( 'La casa che immagini. Il percorso per arrivarci.', 'rinova-casa' ) ) ); ?></h1>
				<p class="hero-description"><?php echo esc_html( get_theme_mod( 'rinova_intro', __( 'Ristrutturazioni curate, un referente presente e decisioni condivise, dall’idea alla consegna.', 'rinova-casa' ) ) ); ?></p>
				<div class="hero-actions">
					<a class="button button--dark" href="#richiedi-preventivo"><?php echo esc_html( get_theme_mod( 'rinova_cta_label', __( 'Parliamo del tuo progetto', 'rinova-casa' ) ) ); ?> <span aria-hidden="true">→</span></a>
					<a class="text-link" href="#lavori"><?php esc_html_e( 'Scopri i nostri lavori', 'rinova-casa' ); ?> <span aria-hidden="true">↓</span></a>
				</div>
				<div class="hero-proof">
					<span class="proof-icon" aria-hidden="true">✳</span>
					<p><?php esc_html_e( 'Un referente, aggiornamenti chiari, cura per ogni dettaglio.', 'rinova-casa' ); ?></p>
				</div>
			</div>
			<div class="hero-art" role="img" aria-label="<?php esc_attr_e( 'Illustrazione architettonica di una casa ristrutturata', 'rinova-casa' ); ?>">
				<div class="art-label art-label--top"><span>01</span> <?php esc_html_e( 'SPAZI CHE PARLANO DI TE', 'rinova-casa' ); ?></div>
				<div class="art-sun"></div>
				<div class="art-building">
					<div class="building-roof"></div>
					<div class="building-main">
						<div class="building-window building-window--left"><span></span></div>
						<div class="building-door"></div>
						<div class="building-window building-window--right"><span></span></div>
					</div>
					<div class="building-base"></div>
				</div>
				<div class="art-plant art-plant--one"><i></i><i></i><i></i></div>
				<div class="art-plant art-plant--two"><i></i><i></i><i></i></div>
				<div class="art-label art-label--bottom"><?php esc_html_e( 'PROGETTI SEGUITI CON CURA', 'rinova-casa' ); ?> <span aria-hidden="true">↗</span></div>
				<div class="art-number">01<span>/</span>03</div>
			</div>
		</div>
		<div class="container hero-meta">
			<span><?php esc_html_e( 'RISTRUTTURAZIONE · INTERNI · CURA', 'rinova-casa' ); ?></span>
			<span><?php echo esc_html( get_theme_mod( 'rinova_service_area', __( 'La tua zona', 'rinova-casa' ) ) ); ?> <span aria-hidden="true">⌖</span></span>
		</div>
	</section>

	<section class="services section-pad" id="servizi">
		<div class="container">
			<div class="section-heading">
				<div><p class="eyebrow"><span class="eyebrow-line"></span><?php esc_html_e( 'COSA FACCIAMO', 'rinova-casa' ); ?></p><h2><?php esc_html_e( 'Una casa, tante possibilità.', 'rinova-casa' ); ?></h2></div>
				<p><?php esc_html_e( 'Dalla trasformazione completa al dettaglio che cambia tutto: mettiamo ordine nelle idee e concretezza nei lavori.', 'rinova-casa' ); ?></p>
			</div>
			<div class="service-grid">
				<article class="service-card">
					<span class="service-index">01 / INTERNI</span>
					<div class="service-icon" aria-hidden="true"><svg viewBox="0 0 48 48"><path d="M7 22 24 8l17 14v19H7zM18 41V27h12v14M14 20h20"/></svg></div>
					<h3><?php esc_html_e( 'Ristrutturazioni complete', 'rinova-casa' ); ?></h3>
					<p><?php esc_html_e( 'Ridisegniamo gli ambienti e coordiniamo le lavorazioni per dare forma a una casa che funziona davvero per te.', 'rinova-casa' ); ?></p>
					<a href="#richiedi-preventivo" class="service-link" aria-label="<?php esc_attr_e( 'Chiedi informazioni sulle ristrutturazioni complete', 'rinova-casa' ); ?>">↗</a>
				</article>
				<article class="service-card service-card--featured">
					<span class="service-index">02 / BAGNI E CUCINE</span>
					<div class="service-icon" aria-hidden="true"><svg viewBox="0 0 48 48"><path d="M8 11h32v29H8zM8 19h32M15 15h.1M20 15h.1M13 25h10v9H13zM29 26h6M29 31h6M29 36h6"/></svg></div>
					<h3><?php esc_html_e( 'Bagni e cucine', 'rinova-casa' ); ?></h3>
					<p><?php esc_html_e( 'Spazi quotidiani ripensati con materiali scelti con attenzione, impianti aggiornati e finiture curate.', 'rinova-casa' ); ?></p>
					<a href="#richiedi-preventivo" class="service-link" aria-label="<?php esc_attr_e( 'Chiedi informazioni su bagni e cucine', 'rinova-casa' ); ?>">↗</a>
				</article>
				<article class="service-card">
					<span class="service-index">03 / FINITURE</span>
					<div class="service-icon" aria-hidden="true"><svg viewBox="0 0 48 48"><path d="M9 39h30M13 34V18h22v16M18 18V9h12v9M18 26h12M21 34v-5h6v5M7 13h5M36 13h5"/></svg></div>
					<h3><?php esc_html_e( 'Finiture e dettagli', 'rinova-casa' ); ?></h3>
					<p><?php esc_html_e( 'Pavimenti, tinteggiature e interventi mirati: la qualità si vede, soprattutto nelle cose fatte bene.', 'rinova-casa' ); ?></p>
					<a href="#richiedi-preventivo" class="service-link" aria-label="<?php esc_attr_e( 'Chiedi informazioni su finiture e dettagli', 'rinova-casa' ); ?>">↗</a>
				</article>
			</div>
		</div>
	</section>

	<section class="projects section-pad" id="lavori">
		<div class="container">
			<div class="section-heading">
				<div><p class="eyebrow"><span class="eyebrow-line"></span><?php esc_html_e( 'PROGETTI RECENTI', 'rinova-casa' ); ?></p><h2><?php esc_html_e( 'Fatti bene. Da vivere.', 'rinova-casa' ); ?></h2></div>
				<p><?php esc_html_e( 'Ogni progetto parte da esigenze diverse. Il risultato migliore? Quello che senti tuo.', 'rinova-casa' ); ?></p>
			</div>
			<?php if ( $project_query->have_posts() ) : ?>
				<div class="project-grid">
					<?php
					while ( $project_query->have_posts() ) :
						$project_query->the_post();
						?>
						<article class="project-card">
							<a class="project-image" href="<?php the_permalink(); ?>">
								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( 'large', array( 'loading' => 'lazy' ) ); ?>
								<?php else : ?>
									<span class="project-placeholder" aria-hidden="true">R<span>.</span></span>
								<?php endif; ?>
								<span class="project-arrow" aria-hidden="true">↗</span>
							</a>
							<p class="project-type"><?php esc_html_e( 'PROGETTO RINOVA', 'rinova-casa' ); ?></p>
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<?php if ( has_excerpt() ) : ?><p class="project-excerpt"><?php the_excerpt(); ?></p><?php endif; ?>
						</article>
					<?php endwhile; ?>
				</div>
				<?php wp_reset_postdata(); ?>
			<?php else : ?>
				<div class="projects-empty">
					<div class="empty-mark" aria-hidden="true">R<span>.</span></div>
					<div><h3><?php esc_html_e( 'I prossimi lavori da raccontare sono i tuoi.', 'rinova-casa' ); ?></h3><p><?php esc_html_e( 'Qui troverai i progetti realizzati. Intanto, raccontaci cosa vorresti cambiare.', 'rinova-casa' ); ?></p></div>
					<a class="text-link" href="#richiedi-preventivo"><?php esc_html_e( 'Inizia da qui', 'rinova-casa' ); ?> <span aria-hidden="true">→</span></a>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<section class="method section-pad" id="metodo">
		<div class="container method-grid">
			<div class="method-intro">
				<p class="eyebrow"><span class="eyebrow-line"></span><?php esc_html_e( 'IL NOSTRO METODO', 'rinova-casa' ); ?></p>
				<h2><?php esc_html_e( 'Più chiarezza. Meno pensieri.', 'rinova-casa' ); ?></h2>
				<p><?php esc_html_e( 'Una ristrutturazione è fatta di tante scelte. Ti aiutiamo a prenderle con calma, sapendo sempre cosa succede e qual è il passo successivo.', 'rinova-casa' ); ?></p>
				<a class="button button--outline" href="#richiedi-preventivo"><?php esc_html_e( 'Conosciamoci', 'rinova-casa' ); ?> <span aria-hidden="true">→</span></a>
			</div>
			<div class="method-steps">
				<article class="method-step"><span>01</span><div><h3><?php esc_html_e( 'Ci racconti la tua idea', 'rinova-casa' ); ?></h3><p><?php esc_html_e( 'Ascoltiamo le esigenze, visitiamo gli spazi e mettiamo a fuoco le priorità.', 'rinova-casa' ); ?></p></div><span class="step-plus" aria-hidden="true">+</span></article>
				<article class="method-step"><span>02</span><div><h3><?php esc_html_e( 'Definiamo il percorso', 'rinova-casa' ); ?></h3><p><?php esc_html_e( 'Ricevi una proposta chiara, con lavorazioni, materiali e passaggi concordati.', 'rinova-casa' ); ?></p></div><span class="step-plus" aria-hidden="true">+</span></article>
				<article class="method-step"><span>03</span><div><h3><?php esc_html_e( 'Seguiamo ogni fase', 'rinova-casa' ); ?></h3><p><?php esc_html_e( 'Un referente ti aggiorna sull’avanzamento e condivide con te ogni decisione.', 'rinova-casa' ); ?></p></div><span class="step-plus" aria-hidden="true">+</span></article>
				<article class="method-step"><span>04</span><div><h3><?php esc_html_e( 'Consegniamo il tuo spazio', 'rinova-casa' ); ?></h3><p><?php esc_html_e( 'Verifichiamo insieme il risultato e ti lasciamo goderti la casa rinnovata.', 'rinova-casa' ); ?></p></div><span class="step-plus" aria-hidden="true">+</span></article>
			</div>
		</div>
	</section>

	<section class="contact section-pad" id="contatti">
		<div class="container contact-grid">
			<div class="contact-copy">
				<p class="eyebrow eyebrow--light"><span class="eyebrow-line"></span><?php esc_html_e( 'IL PRIMO PASSO È UNA CHIACCHIERATA', 'rinova-casa' ); ?></p>
				<h2><?php esc_html_e( 'Hai un progetto in mente?', 'rinova-casa' ); ?></h2>
				<p><?php esc_html_e( 'Due righe per raccontarcelo, senza impegno. Ti risponderemo per capire insieme da dove partire.', 'rinova-casa' ); ?></p>
				<div class="contact-details">
					<?php $phone = get_theme_mod( 'rinova_phone', '' ); ?>
					<?php if ( $phone ) : ?>
						<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?> <span aria-hidden="true">↗</span></a>
					<?php endif; ?>
					<span><?php echo esc_html( get_theme_mod( 'rinova_service_area', __( 'La tua zona', 'rinova-casa' ) ) ); ?></span>
				</div>
			</div>
			<div class="contact-form-panel" id="richiedi-preventivo">
				<p class="form-heading"><?php esc_html_e( 'Raccontaci cosa ti serve', 'rinova-casa' ); ?></p>
				<?php echo do_shortcode( '[rinova_contact_form]' ); ?>
			</div>
		</div>
	</section>
</main>
<?php get_footer(); ?>
