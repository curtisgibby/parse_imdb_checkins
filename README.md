Parse IMDb check-ins
====================

IMDb's check-in service is rather new and thus is very limited: there's only two ways to get data in, and only one way to get data out (by pulling down a CSV file of your check-ins). This leads to a chicken-and-egg problem: why would you put the time into doing the check-ins if there's nothing that you can do with the data? This script helps alleviate that problem somewhat by making some sense of the raw data provided by that CSV.

## Features

* List most-watched titles (totals, movies and TV shows separately)
* List fastest-watched titles (time between release date and check-in; totals, movies and TV shows separately)
* List check-ins by day of week and by month (totals, movies and TV shows separately)
* List most popular genres (totals, movies and TV shows separately)

## Usage

1. Download the "CHECKINS.csv" file from IMDb. (Log in to IMDb, go to the ["Your Lists" page](http://www.imdb.com/profile/lists), then find the "Your Checkins" link, and then find the "Export this list" link at the bottom.)
2. Run this project's `index.php` file and upload the "CHECKINS.csv" file.

There's also a live version of the code running on [my web site](http://www.curtisgibby.com/parse_imdb_checkins/index.php).

## Options

* `maximum_chart_entries`
* `minimum_count`
* `current_season_only`
* `current_season_start_date`
* `chart_width`
* `chart_height`