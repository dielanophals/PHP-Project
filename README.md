# PHP-Project - InstaPet
## Inhoud
TBA
## Bugs en opmerkingen
### Algemeen
* `$_SESSION['userID]` en `$_SESSION['id']` zijn bijna indentiek. Echter is 1 hardcoded en 1 in de klasse `Session.class.php`.
* `passwordVerify()` in aparte functie steken zodat het gebruikt kan worden in de klasse `User.class.php` voor de functies passwordCheck() en login(). Zie DRY.
### Profile - upload werkt niet
Situatieschets
* lege post tabel in database
* geen map 'uploads'. Ook het aanmaken helpt niet.
* Zowel bij het gedeelte "Upload image" en "Edit profile".
* branch 'master'

Bug
* Bij het posten van de eerste afbeelding is de feedback: "Sorry, this file already exists. Please try again."
* De error is "mkdir(): no such file or directory in ... on line 34".

### Profile - Edit profile wachtwoord

* branch 'master'
* Geen feedback op niet ingevulde wachtwoord of foute wachtwoord.
