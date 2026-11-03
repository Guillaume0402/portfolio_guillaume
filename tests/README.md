# Tests de régression du formulaire de contact

Cette petite suite vérifie le contrat P2 : limiter les saisies conservées dans
`$_SESSION['contact_old']` sans modifier la validation métier ni le parcours normal.
Elle n'utilise ni framework de test ni dépendance Composer supplémentaire.

## Exécution

Depuis la racine du dépôt :

```bash
php tests/contact_session_test.php
```

Les chemins sont calculés depuis le fichier de test. La commande peut donc aussi
être lancée depuis un autre dossier en indiquant le chemin du script.

Prérequis : PHP CLI 8.3 ou 8.4, extension `mbstring` et fonction `proc_open`
activées dans la configuration CLI du même binaire. Le script lance un
sous-processus par scénario, car le contrôleur appelle `exit` après une redirection.
Il ne force pas le chargement d'un fichier `mbstring.so`, ce qui convient aussi à
une image où cette extension est déjà intégrée à PHP.

Chaque scénario affiche `PASS` ou `FAIL`, puis un bilan. Code de sortie :

- `0` : les 16 scénarios passent ;
- `1` : au moins une assertion ou un sous-processus échoue ;
- `2` : prérequis manquant ou scénario interne inconnu.

## Couverture

Les 16 scénarios vérifient : CSRF invalide avec données volumineuses ou jeton
tableau ; dépassement des cinq limites ; conservation des saisies ordinaires après
erreur ; accents, emojis et caractères combinés ; tableaux et scalaires inattendus ;
choix métier interdits ; octets UTF-8 malformés ; champ POST supplémentaire ; échecs
IP, Turnstile et SMTP ; parcours valide ordinaire et valeurs aux limites.

Les assertions contrôlent les valeurs conservées, les erreurs, la redirection 303,
la rotation CSRF, l'ordre des appels et les arguments du mailer. Les textes Unicode
attendus sont construits explicitement : les tests ne rappellent pas la méthode
de limitation pour calculer le résultat attendu.

Le véritable `ContactController`, le CSRF et le résolveur d'IP sont chargés depuis
`src/`. Les dépendances SQL, le limiteur lié à MySQL, Turnstile et le mailer sont
remplacés par des doublures. Les en-têtes sont interceptés. Les données sont
synthétiques ; aucun `.env`, service externe ou ancienne copie du contrôleur
n'est utilisé. Les sessions restent en mémoire, sans `session_start()` ni fichier
de session, et le script n'écrit aucun rapport sur disque.

## Limites

Cette suite ne remplace pas les tests HTTP/Docker complets : elle ne vérifie pas
les en-têtes sur le réseau, Apache, les cookies réels, la concurrence SQL, les
migrations, la validation réelle de Cloudflare ou la délivrabilité SMTP.
Elle ne lance aucun conteneur et n'envoie aucun e-mail.

Si une règle métier change volontairement, mettre à jour les attentes concernées
après avoir confirmé le nouveau comportement ; ne pas simplement retirer
l'assertion qui échoue. Une exécution dans l'image PHP 8.4 de production reste
utile pour confirmer la compatibilité de cet environnement.
