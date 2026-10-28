<?php
/**
 * Privacy information page.
 *
 * @package Rinova_Casa
 */
get_header();
$legal_name      = get_theme_mod( 'rinova_legal_name', __( 'DA COMPLETARE — inserisci il nome o la ragione sociale del titolare', 'rinova-casa' ) );
$privacy_email   = sanitize_email( get_theme_mod( 'rinova_privacy_email', get_option( 'admin_email' ) ) );
$retention       = get_theme_mod( 'rinova_retention', __( 'DA DEFINIRE — specifica il periodo effettivamente applicato dal titolare e ai messaggi email.', 'rinova-casa' ) );
$privacy_is_ready = false === stripos( $legal_name, 'DA COMPLETARE' ) && false === stripos( $retention, 'DA DEFINIRE' ) && is_email( $privacy_email );
?>
<main id="contenuto" class="container content-layout privacy-page">
	<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class( 'content-entry' ); ?>>
			<p class="eyebrow"><span class="eyebrow-line"></span><?php esc_html_e( 'INFORMATIVA SUL TRATTAMENTO DEI DATI', 'rinova-casa' ); ?></p>
			<h1><?php the_title(); ?></h1>
			<?php if ( ! $privacy_is_ready ) : ?>
				<div class="privacy-setup-note" role="note">
					<strong><?php esc_html_e( 'Informativa dimostrativa da completare prima della pubblicazione.', 'rinova-casa' ); ?></strong>
					<p><?php esc_html_e( 'In Aspetto → Personalizza → Rinova Casa: pagina iniziale, inserisci l’identità e i contatti reali del titolare, definisci la conservazione dei messaggi e verifica hosting, email, registri tecnici e gli eventuali plugin. Questa pagina è una base informativa, non una certificazione di conformità.', 'rinova-casa' ); ?></p>
				</div>
			<?php endif; ?>

			<p><?php esc_html_e( 'La presente informativa riguarda i dati inviati tramite il modulo di richiesta informazioni di questo sito.', 'rinova-casa' ); ?></p>

			<h2><?php esc_html_e( 'Titolare del trattamento e contatti', 'rinova-casa' ); ?></h2>
			<p><strong><?php echo esc_html( $legal_name ); ?></strong></p>
			<?php if ( is_email( $privacy_email ) ) : ?>
				<p><a href="mailto:<?php echo esc_attr( $privacy_email ); ?>"><?php echo esc_html( $privacy_email ); ?></a></p>
			<?php else : ?>
				<p><?php esc_html_e( 'Contatto privacy: da inserire prima della pubblicazione.', 'rinova-casa' ); ?></p>
			<?php endif; ?>

			<h2><?php esc_html_e( 'Quali dati, perché e su quale base', 'rinova-casa' ); ?></h2>
			<p><?php esc_html_e( 'Il modulo richiede nome, indirizzo email e una descrizione del progetto. Il titolare usa questi dati soltanto per rispondere alla richiesta e, se necessario, svolgere attività precontrattuali chieste dall’interessato. La base giuridica è l’esecuzione di misure precontrattuali adottate su richiesta dell’interessato (art. 6, par. 1, lett. b, GDPR).', 'rinova-casa' ); ?></p>
			<p><?php esc_html_e( 'I campi indicati come obbligatori sono necessari per poter rispondere; senza tali informazioni la richiesta non può essere gestita.', 'rinova-casa' ); ?></p>

			<h2><?php esc_html_e( 'Come vengono trasmessi e conservati', 'rinova-casa' ); ?></h2>
			<p><?php esc_html_e( 'Il tema invia il modulo al server del sito e inoltra il messaggio all’indirizzo email amministrativo configurato in WordPress. Il tema non archivia le richieste come contenuti nel database WordPress. Il messaggio può rimanere nelle caselle email del titolare e dei fornitori che le gestiscono; i fornitori di hosting possono trattare dati tecnici di connessione nei propri registri. Verifica le condizioni e la localizzazione dei fornitori realmente utilizzati.', 'rinova-casa' ); ?></p>
			<p><?php echo esc_html( $retention ); ?></p>
			<p><?php esc_html_e( 'Definisci un periodo effettivo di conservazione per le email e i registri, tenendo conto degli obblighi applicabili e delle procedure aziendali. Elimina i dati quando non sono più necessari, fatti salvi gli eventuali obblighi di legge.', 'rinova-casa' ); ?></p>

			<h2><?php esc_html_e( 'Cookie e strumenti di misurazione', 'rinova-casa' ); ?></h2>
			<p><?php esc_html_e( 'Il tema non integra strumenti di analytics, pubblicità, mappe, font remoti o servizi di terze parti, e non installa cookie di profilazione. WordPress, il provider di hosting e gli eventuali plugin o servizi aggiunti dal titolare possono comunque trattare dati tecnici o impostare cookie propri: censiscili e aggiorna questa informativa prima della pubblicazione.', 'rinova-casa' ); ?></p>

			<h2><?php esc_html_e( 'Diritti dell’interessato', 'rinova-casa' ); ?></h2>
			<p><?php esc_html_e( 'Nei casi previsti dal GDPR puoi chiedere accesso, rettifica, cancellazione, limitazione del trattamento, portabilità e opporti al trattamento. Puoi inoltre proporre reclamo al Garante per la protezione dei dati personali. Per esercitare i diritti, scrivi al titolare usando il contatto riportato sopra.', 'rinova-casa' ); ?></p>
			<p><a href="https://www.garanteprivacy.it/" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Garante per la protezione dei dati personali', 'rinova-casa' ); ?> <span aria-hidden="true">↗</span></a></p>

			<h2><?php esc_html_e( 'Aggiornamenti', 'rinova-casa' ); ?></h2>
			<p><?php esc_html_e( 'Il titolare aggiorna questa informativa quando cambiano il sito, i fornitori o le finalità di trattamento. Verifica che il contenuto descriva le pratiche effettive prima di rendere operativo il modulo.', 'rinova-casa' ); ?></p>
			<p><?php esc_html_e( 'Ultimo aggiornamento:', 'rinova-casa' ); ?> <time datetime="<?php echo esc_attr( get_the_modified_date( 'Y-m-d' ) ); ?>"><?php echo esc_html( get_the_modified_date() ); ?></time></p>
		</article>
	<?php endwhile; ?>
</main>
<?php get_footer(); ?>
