PHP IP Notifier
===============

Description
-----------
PHP IP Notifier is a standalone PHP based tool for checking and updating a text file 
with the local network's externally-accessible IP address. It is meant as an alternative 
to using Dynamic DNS for user's who wish to keep track of their home broadband's dynamic 
IP address without maintaining a DynDNS account (or similar) or for those whose routers 
do not support Dynamic DNS services.

Usage
-----
The notifier is intended to be set up as a cron job on the host machine within the network
and should have internet access. Once this is achieved the script will check the externally
available IP address using [ip6.me](http://ip6.me) and write it to a file called *current_ip.txt*
if the value retrieved from ip6.me is ever different from the contents of current_ip.txt it will
notify the configured recipient via email of the IP change.

Configuration
-------------
  - Edit *ipchecker.php* and change the `$config` array to contain your desired email settings.
  - Touch an empty file called *current_ip.txt* in the same folder as the *ipchecker.php* file.
  - Ensure the *ipchecker.php* file can be executed by running `chmod +x ipchecker.php` on it.
  - Configure a Cron job for the running of the script (example below runs every 15 minutes):
    `0,15,30,45 * * * *  root   /tools/php_ip_notifier/ipchecker.php &> /dev/null`
   
Testing
-------
To test your configuration, run the script manually by using `./ipchecker.php`
