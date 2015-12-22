# Grant privileges on appropriate DBs and tables.
# Do not let the armory user edit any TrinityCore databases, just in case of injections etc.
CREATE USER 'armory'@'your-webserver-ip' IDENTIFIED BY 'your-password';
GRANT ALL ON armory.* TO 'armory'@'your-webserver-ip';
GRANT SELECT ON world.item_template TO 'armory'@'your-webserver-ip';
GRANT SELECT ON characters.characters TO 'armory'@'your-webserver-ip';
GRANT SELECT ON characters.character_inventory TO 'armory'@'your-webserver-ip';
GRANT SELECT ON characters.item_instance TO 'armory'@'your-webserver-ip';
GRANT SELECT ON characters.glyphs TO 'armory'@'your-webserver-ip';
GRANT SELECT ON characters.character_reputation TO 'armory'@'your-webserver-ip';
