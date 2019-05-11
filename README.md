# PHP-Project - InstaPet
## Inhoud
'Instapet' is een website waarbij je zowel de meeste schattige als coolste foto's van jouw favoriete dieren plaatst en deelt.
## Bugs en opmerkingen
### Algemeen
* `passwordVerify()` in aparte functie steken zodat het gebruikt kan worden in de klasse `User.class.php` voor de functies passwordCheck() en login(). Zie DRY.
* Niet alle content/pagina's zijn responsive.
### AJAX
* De like en posts laden werken afzonderlijk van elkaar. Op dit moment werkt de like feature. Als je de like feature wegcomment in index.php dan werken de posts. Het probleem ligt niet aan de script like.js. 
### .gitignore voor uploads
* Je kan iets met .gitignore en .keep doen om de folders te bewaren maar niet de content.
### Profile - Edit profile wachtwoord
* Eventuele feedback bij het noteren van 3 dezelfde wachtwoorden (nieuw wachtwoord mag niet hetzelfde zijn als oud wachtwoord).
* Duidelijker CSS tussen het veranderen van wachtwoord en het huidige wachtwoord vb. Current Password, New Password & Confirm Password. Zo weet de gebruiker ook beter wat hij/zij moet invullen. Nu moet je eerst jouw nieuw ww invullen en daarna jouw oude om het te wijzigen. Dit kan verwarrend zijn.
### Profile - geen posts
* Wanneer er geen posts zijn zie je de template van de posts met natuurlijk geen foto. Dit is verwarrend. Anders krijg je een error i.v.m. geen posts found.
### Profile - upload profiel foto
* De juist geüploade foto is nergens zichtbaar op de website.
### Register
* Geen CSS aanwezig
* Eventueel een check of het een e-mailadres is.
