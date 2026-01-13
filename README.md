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

# Exporting the ContactRequests to a CSV
It is possible to export the requests which are saved to the database by running the Command
* `bin/console app:export-requests`
This will save the file in the root of the current director (`/contactform`) as `requests.csv`


## Additional Thoughts
Due to time reasons I skipped the implementation of a Spam-Protection. I read in the Symfony docs it would be possible to to implement a Spam-Protection with Askimet. But creating a Askimet Api Key and reading the docs of that API would have gone over the scope, thats why I prefered to complete the bonus task to export the requests to a csv.