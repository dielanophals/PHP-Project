# PHP-Project - InstaPet
## Inhoud
'Instapet' is een website waarbij je zowel de meeste schattige als coolste foto's van jouw favoriete dieren plaatst en deelt.
## Bugs en opmerkingen
### Algemeen
* `$_SESSION['userID]` en `$_SESSION['id']` zijn bijna indentiek. Echter is 1 hardcoded en 1 in de klasse `Session.class.php`.
* `passwordVerify()` in aparte functie steken zodat het gebruikt kan worden in de klasse `User.class.php` voor de functies passwordCheck() en login(). Zie DRY.
### Profile - Edit profile wachtwoord
* branch 'master'
* Geen feedback op niet ingevulde wachtwoord of foute wachtwoord.
* Duidelijker CSS tussen het veranderen van wachtwoord en het huidige wachtwoord.
