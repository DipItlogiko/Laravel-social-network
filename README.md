# Here i have updated some functionalities of my social network project such as:

* Hide like or dislike button for own posts.
* Hide account or logout links when not authenticated.
* Restrict access to account or logout page or url when not authenticated.
* Fix wrong sign in message.
* Fix wrong create time in posts.
* Fix wrong profile image with changing first name.

* UTC time to Localtime.

By default, Laravel uses the UTC timezone for timestamps stored in the database. 

when i create a new post that time don't match with my local time to solve this problem go to config/app.php reples it 'timezone' => UTC,  to   'timezone' => 'Asia/Dhaka', it will work.

the appropriate timezone identifier for your location. You can find a list of supported timezone identifiers in the PHP documentation:[Click_Here](https://www.php.net/manual/en/timezones.asia.php)

* Fix notification bar.

Here i am just used bootstrap class in message.blade.php 