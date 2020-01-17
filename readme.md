# Adylic Backend Test

## Vist at

https://adylic-be-test.herokuapp.com/

### Requirements:

-   PHP >= 7.2
-   OpenSSL PHP Extension
-   PDO PHP Extension
-   Mbstring PHP Extension

### Run:

`php -S localhost:8000 -t public`

### Test:

`./vendor/bin/phpunit`

#### Results:

```
PHPUnit 8.5.2 by Sebastian Bergmann and contributors.

Game
 ✔ Create game
 ✔ Delete game
 ✔ Update score

Player
 ✔ Create player
 ✔ Get player
 ✔ Update player
 ✔ Delete player

Team
 ✔ Create team
 ✔ Get team
 ✔ Update team
 ✔ Delete team

Transfer
 ✔ Add player to team
 ✔ Limit max player per team 8

Time: 5.06 seconds, Memory: 16.00 MB

OK (13 tests, 22 assertions)

```
