# Information

This Project is just rendering a contactform where you can input some data.  
The data is then saved to a sqlite-database and no real E-mails are sent.

# Instructions to run the WebApp
Given you have all Requirements for running a Symfony project on your machine:
1. Clone Repository
2. `cd contactform`
3. `composer install`
4. `bin/console sass:build`
5. `bin/console doctrine:migrations:migrate`
6. `symfony serve`

After successfully sending a contactrequest you can find it in the database at `/var/data_dev.db`