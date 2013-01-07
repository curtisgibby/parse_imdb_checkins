Parse IMDb check-ins
====================

[IMDb's check-in service](http://www.imdb.com/help/search?domain=helpdesk_faq&index=1&file=checkins) is rather new and thus is very limited: there's only two ways to get data in, and only one way to get data out (by pulling down a CSV file of your check-ins). This leads to a chicken-and-egg problem: why would you put the time into doing the check-ins if there's nothing that you can do with the data? This script helps alleviate that problem somewhat by making some sense of the raw data provided by that CSV.

## Features

* List most-watched titles (totals, movies and TV shows separately)
* List fastest-watched titles (time between release date and check-in; totals, movies and TV shows separately)
* List check-ins by day of week and by month (totals, movies and TV shows separately)
* List most popular genres (totals, movies and TV shows separately)
* Update width and height of resulting Google Visualization charts
* Limit the number of entries in charts (for example, to display only the 10 most-watched TV shows)
* Specify the minimum number of check-ins for a TV show to be displayed, in case you tried out a pilot or two and don't want those shows appearing in your stats. (Default 1 = no minimum)
* For TV shows, display only shows released during the current season (so as to not skew the "fastest watched" chart with check-ins tied to older seasons)
* If you don't have your own check-ins and just want to try out the system, you can use my sample CHECKINS.csv file

## Usage

1. Download the "CHECKINS.csv" file from IMDb. (Log in to IMDb, go to the ["Your Lists" page](http://www.imdb.com/profile/lists), then find the "Your Checkins" link, and then find the "Export this list" link at the bottom.)
2. Run this project's `index.php` file and upload the "CHECKINS.csv" file.

There's also a live version of the code running on [my web site](http://www.curtisgibby.com/parse_imdb_checkins/index.php).

## Charts

* Most Watched TV Shows
* Fastest Watched TV Shows
* Fastest Watched Movies
* Total Check-ins Per Day of Week
* TV Check-ins Per Day of Week
* Movie Check-ins Per Day of Week
* Total Check-ins Per Month
* TV Check-ins Per Month
* Movie Check-ins Per Month
* Total Check-ins Per Genre
* TV Check-ins Per Genre
* Movie Check-ins Per Genre