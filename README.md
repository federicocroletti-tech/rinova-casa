# Rinova Casa — tema WordPress

Tema dimostrativo in italiano per il sito di una piccola impresa di ristrutturazioni. Brand, attività e testi sono fittizi: sostituiscili con informazioni autorizzate e verificabili prima di pubblicare un sito commerciale.

## Installazione

1. Copia la cartella `rinova-casa` in `wp-content/themes/` oppure comprimi il tema in un file ZIP e caricalo da **Aspetto → Temi → Aggiungi nuovo tema → Carica tema**.
2. Attiva **Rinova Casa** da **Aspetto → Temi**.
3. In **Aspetto → Personalizza → Rinova Casa: pagina iniziale**, sostituisci titolo, presentazione, descrizione SEO, ragione sociale, email per la privacy, conservazione, zona servita e telefono. Aggiungi il logo da **Identità del sito**.
4. Crea e assegna un menu in **Aspetto → Menu**, scegliendo la posizione **Menu principale**.
5. Crea una pagina con lo slug `privacy` e titolo **Privacy**. Il template dedicato si applica automaticamente e il modulo usa il permalink effettivo della pagina. Personalizza e verifica l’informativa con le pratiche reali del titolare, dei fornitori di hosting e posta e degli eventuali plugin; elimina l’avviso di configurazione soltanto completando i valori richiesti.
6. Pubblica i lavori da **Lavori → Aggiungi un lavoro**. Usa immagini autorizzate, testo ed estratto: gli ultimi tre lavori appariranno in home.
7. Imposta un indirizzo amministrativo valido in **Impostazioni → Generali**, configura HTTPS e una struttura dei permalink funzionante, quindi verifica l’invio email dal provider. Il modulo inoltra le richieste con `wp_mail`, senza salvarle come contenuti nel database; messaggi e dati tecnici possono essere conservati dai sistemi di posta e hosting.
8. Prima della messa online verifica accessibilità, sicurezza e privacy dell’intera installazione, inclusi cookie impostati da WordPress, tema, hosting e plugin. Il tema non include analytics o servizi remoti e non installa cookie di profilazione.

## Requisiti

- WordPress 6.4 o superiore
- PHP 7.4 o superiore
- Nessun plugin richiesto

## Privacy e SEO

La demo statica non invia moduli, usa `noindex` e non carica servizi di terze parti. Il tema WordPress include un modulo che tratta nome, email e testo del messaggio e li inoltra alla casella configurata: prima di attivarlo, identifica il titolare e i fornitori, definisci basi giuridiche e tempi di conservazione reali, pubblica l’informativa corretta e configura la posta. La configurazione proposta è un punto di partenza tecnico, **non una certificazione di conformità al GDPR o una consulenza legale**.

Il tema imposta title tag tramite il supporto nativo di WordPress, aggiunge descrizioni e metadati social di base e usa struttura semantica. Se installi Yoast SEO o Rank Math, i metadati del tema vengono disabilitati per evitare duplicati. La qualità del posizionamento dipende anche dai contenuti, dalla configurazione del sito, dalle prestazioni e da altri fattori esterni.

## Anteprima e verifiche

La [preview GitHub Pages](https://federicocroletti-tech.github.io/rinova-casa/) è solo un mockup statico: **non esegue PHP e non è un’installazione WordPress**. Ogni push su `main` esegue i controlli PHP e una prova d’integrazione con WordPress e MariaDB, poi pubblica la preview se i test passano.
