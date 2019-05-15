# PHP-Project - InstaPet
## Inhoud
'Instapet' is een website waarbij je zowel de meeste schattige als coolste foto's van jouw favoriete dieren plaatst en deelt.
## Bugs en opmerkingen
### Algemeen
* `passwordVerify()` in aparte functie steken zodat het gebruikt kan worden in de klasse `User.class.php` voor de functies passwordCheck() en login(). Zie DRY.
### Profile - Edit profile wachtwoord
* Eventuele feedback bij het noteren van 3 dezelfde wachtwoorden (nieuw wachtwoord mag niet hetzelfde zijn als oud wachtwoord).
* Duidelijker CSS tussen het veranderen van wachtwoord en het huidige wachtwoord vb. Current Password, New Password & Confirm Password. Zo weet de gebruiker ook beter wat hij/zij moet invullen. Nu moet je eerst jouw nieuw ww invullen en daarna jouw oude om het te wijzigen. Dit kan verwarrend zijn.
### Profile - geen posts
* Wanneer er geen posts zijn zie je de template van de posts met natuurlijk geen foto. Dit is verwarrend. Anders krijg je een error i.v.m. geen posts found.
### Profile - upload profiel foto
* De juist geüploade foto is nergens zichtbaar op de website.
