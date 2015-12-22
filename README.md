# trinity-armory
A CodeIgniter based armory for the `3.3.5` branch of [TrinityCore](https://github.com/TrinityCore/TrinityCore).

I used the MySQL DB from [Exodius/WoW-Armory](https://github.com/Exodius/WoW-Armory) for a base armory db. I have made some minor changes so will be uploading a new database soon.


## Setup
To set up the armory on your own server, you'll need to make some adjustments to files and to your database server.

* In `application/config/config.php`, change `$config['base_url']` on line 26 as described in the file.
* Execute the SQL files in the `sql/` directory after changing the references to your MySQL hostname and password in `user-setup.sql`.
* In `application/config/database.php`, change the references to your MySQL hostname and password where appropriate, starting on line 77.

You'll also need to extract all icon files from your WoW MPQ's. Icons should then be sorted into the following folders under the `images` directory:
* `achievements`
* `items`
* `spells_abilities`
* `tradeskills`

Lastly, you will need character portraits. They should be sorted into the following folders under the `images` directory:
* `portraits/wow-default`
* `portraits/wow`
* `portraits/wow-70`
* `portraits/wow-80`
