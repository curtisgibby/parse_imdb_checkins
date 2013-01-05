<?php

# try to figure out when the current TV season would've started
if (intval(date('m')) >= 9) {
	$currentSeasonStartDateYear = date('Y');
}
else {
	$currentSeasonStartDateYear = intval(date('Y')) - 1;
}

$currentSeasonStartDate = $currentSeasonStartDateYear.'-08-20';

$defaults = array(
	'maximum_chart_entries' => 10,
	'use_sample_csv' => 0,
	'current_season_only' => 0,
	'current_season_start_date' => $currentSeasonStartDate,
	'minimum_count' => 1,
	'chart_width' => 800,
	'chart_height' => 400,
	'charts' => array(
		'mostWatched' => true,
		'fastestWatchedTv' => true,
		'fastestWatchedMovies' => true,
		'daysOfWeekTotal' => true,
		'daysOfWeekTv' => false,
		'daysOfWeekMovies' => false,
		'monthsTotal' => true,
		'monthsTv' => false,
		'monthsMovies' => false,
		'genresTotal' => true,
		'genresTv' => false,
		'genresMovies' => false,
	)
);

if (!empty($_POST)) {
	foreach ($defaults['charts'] as $key => $value) {
		if(!isset($_REQUEST['charts'][$key])) {
			$_REQUEST['charts'][$key] = false;
		}
	}
}

$options = array_merge_recursive_replace($defaults, $_REQUEST);

if (!empty($options['maximum_chart_entries']) && is_numeric($options['maximum_chart_entries'])) {
	$maximumChartEntries = intval($options['maximum_chart_entries']);
}
else {
	$maximumChartEntries = false;
}

if (!empty($options['current_season_only'])) {
	$currentSeasonOnly = true;
}
else {
	$currentSeasonOnly = false;
}

if (!empty($options['use_sample_csv'])) {
	$useSampleCSV = true;
}
else {
	$useSampleCSV = false;
}

if (isset($options['minimum_count']) && is_numeric($options['minimum_count'])) {
	$minimumCount = intval($options['minimum_count']);
}
else {
	$minimumCount = $defaults['minimum_count'];
}

if (isset($options['chart_width']) && is_numeric($options['chart_width'])) {
	$chartWidth = intval($options['chart_width']);
}
else {
	$chartWidth = $defaults['chart_width'];
}

if (isset($options['chart_width']) && is_numeric($options['chart_width'])) {
	$chartHeight = intval($options['chart_height']);
}
else {
	$chartHeight = $defaults['chart_height'];
}

$currentSeasonStartTime = strtotime($options['current_season_start_date']);

$charts = array(
	'mostWatched' => array(
		'dataSource' => 'mostWatched',
		'type' => 'Column',
		'label' => 'Count',
		'maximum_entries_filterable' => true,
		'chartOptions' => array(
			'title' => 'Most Watched TV Shows',
			'width' => $chartWidth,
			'height' => $chartHeight
		)
	),
	'fastestWatchedTv' => array(
		'dataSource' => "fastestWatchedTv",
		'type' => 'Column',
		'label' => 'Average days between release and check-in',
		'maximum_entries_filterable' => true,
		'chartOptions' => array(
			'title' => 'Fastest Watched TV Shows',
			'width' => $chartWidth,
			'height' => $chartHeight
		)
	),
	'fastestWatchedMovies' => array(
		'dataSource' => "fastestWatchedMovies",
		'type' => 'Column',
		'label' => 'Days between release and check-in',
		'maximum_entries_filterable' => true,
		'chartOptions' => array(
			'title' => 'Fastest Watched Movies',
			'width' => $chartWidth,
			'height' => $chartHeight
		)
	),
	'daysOfWeekTotal' => array(
		'dataSource' => "daysOfWeekTotal",
		'type' => 'Pie',
		'label' => 'Check-ins',
		'maximum_entries_filterable' => false,
		'chartOptions' => array(
			'title' => 'Total Check-ins Per Day of Week',
			'width' => $chartWidth,
			'height' => $chartHeight
		)
	),
	'daysOfWeekTv' => array(
		'dataSource' => "daysOfWeekTv",
		'type' => 'Pie',
		'label' => 'Check-ins',
		'maximum_entries_filterable' => false,
		'chartOptions' => array(
			'title' => 'TV Check-ins Per Day of Week',
			'width' => $chartWidth,
			'height' => $chartHeight
		)
	),
	'daysOfWeekMovies' => array(
		'dataSource' => "daysOfWeekMovies",
		'type' => 'Pie',
		'label' => 'Check-ins',
		'maximum_entries_filterable' => false,
		'chartOptions' => array(
			'title' => 'Movie Check-ins Per Day of Week',
			'width' => $chartWidth,
			'height' => $chartHeight
		)
	),
	'monthsTotal' => array(
		'dataSource' => "monthsTotal",
		'type' => 'Column',
		'label' => 'Check-ins',
		'maximum_entries_filterable' => false,
		'chartOptions' => array(
			'title' => 'Total Check-ins Per Month',
			'width' => $chartWidth,
			'height' => $chartHeight
		)
	),
	'monthsTv' => array(
		'dataSource' => "monthsTv",
		'type' => 'Column',
		'label' => 'Check-ins',
		'maximum_entries_filterable' => false,
		'chartOptions' => array(
			'title' => 'TV Check-ins Per Month',
			'width' => $chartWidth,
			'height' => $chartHeight
		)
	),
	'monthsMovies' => array(
		'dataSource' => "monthsMovies",
		'type' => 'Column',
		'label' => 'Check-ins',
		'maximum_entries_filterable' => false,
		'chartOptions' => array(
			'title' => 'Movie Check-ins Per Month',
			'width' => $chartWidth,
			'height' => $chartHeight
		)
	),
	'genresTotal' => array(
		'dataSource' => "genresTotal",
		'type' => 'Column',
		'label' => 'Check-ins',
		'maximum_entries_filterable' => true,
		'chartOptions' => array(
			'title' => 'Total Check-ins Per Genre',
			'width' => $chartWidth,
			'height' => $chartHeight
		)
	),
	'genresTv' => array(
		'dataSource' => "genresTv",
		'type' => 'Column',
		'label' => 'Check-ins',
		'maximum_entries_filterable' => true,
		'chartOptions' => array(
			'title' => 'TV Check-ins Per Genre',
			'width' => $chartWidth,
			'height' => $chartHeight
		)
	),
	'genresMovies' => array(
		'dataSource' => "genresMovies",
		'type' => 'Column',
		'label' => 'Check-ins',
		'maximum_entries_filterable' => true,
		'chartOptions' => array(
			'title' => 'Movie Check-ins Per Genre',
			'width' => $chartWidth,
			'height' => $chartHeight
		)
	)
);

/*
* Calculates the time in days between when the title was released
* and when the checkin occurred
*/
function watch_delay($row) {
	$created = strtotime(trim($row[2]));
	$released = strtotime(trim($row[14]));
	return ($created - $released) / 86400;
}

function array_merge_recursive_replace($array1, $array2) {
	foreach($array2 as $key => $value) {
		if(array_key_exists($key, $array1) && is_array($value)) {
			$array1[$key] = array_merge_recursive_replace($array1[$key], $array2[$key]);
		}
		else {
			$array1[$key] = $value;
		}

	}

	return $array1;
}


?>

<html>
	<head>
		<title>Parse IMDb Check-ins</title>
		<link href="bootstrap.min.css" rel="stylesheet" media="screen">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js" type="text/javascript"></script>
	</head>

	<body>
		<h1>Parse IMDb Check-ins</h1>



<?php

if ($useSampleCSV) {
	if (empty($_POST)) {
		$_POST = 'not empty!';
	}

	$_FILES['csv_file']['tmp_name'] = 'CHECKINS.csv';
}

if (!empty($_POST)):

	if (!empty($_FILES['csv_file']['tmp_name']) && ($handle = fopen($_FILES['csv_file']['tmp_name'], "r")) !== FALSE) {

		$output = array(
			'tv' => array('total' => array(
				'count' => 0,
				'watch_delay' => 0
			)),
			'movies' => array('total' => array(
				'count' => 0,
				'watch_delay' => 0
			))
		);

		$daysOfWeekTotal = $daysOfWeekTv = $daysOfWeekMovies = array(
			'Sunday' => 0,
			'Monday' => 0,
			'Tuesday' => 0,
			'Wednesday' => 0,
			'Thursday' => 0,
			'Friday' => 0,
			'Saturday' => 0
		);

		$monthsTotal = $monthsTv = $monthsMovies = array(
			'January' => 0,
			'February' => 0,
			'March' => 0,
			'April' => 0,
			'May' => 0,
			'June' => 0,
			'July' => 0,
			'August' => 0,
			'September' => 0,
			'October' => 0,
			'November' => 0,
			'December' => 0
		);

		$genresTotal = $genresTv = $genresMovies = array();

		$i = 0;
		while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
			$i++;

			if (trim($row[6]) == 'TV Episode') {
				$isTvShow = true;
			}
			else {
				$isTvShow = false;
			}
			

			// skip the header row, plus any rows where the release date is blank
			// and, if we're only looking at the current season, TV shows released before then
			if(
				$i == 1 ||
				empty($row[14]) ||
				($currentSeasonOnly && $isTvShow && (strtotime(trim($row[14])) < $currentSeasonStartTime))
			) {
				continue;
			}

			$checkinTime = strtotime(trim($row[2]));
			$genres = explode(', ', trim($row[12]));

			$dayOfWeek = date('l', $checkinTime);
			$month = date('F', $checkinTime);

			$daysOfWeekTotal[$dayOfWeek]++;
			$monthsTotal[$month]++;

			foreach ($genres as $genre) {
				if(!array_key_exists($genre, $genresTotal)) {
					$genresTotal[$genre] = 0;
				}
				$genresTotal[$genre]++;
			}

			if ($isTvShow) {
				$watchDelay = watch_delay($row);
				$output['tv']['total']['count']++;
				$output['tv']['total']['watch_delay'] += $watchDelay;
				list($showTitle, $episodeTitle) = explode(': ', trim($row[5]));
				$showTitle = utf8_decode($showTitle);
				if (empty($output['tv'][$showTitle])) {
					$output['tv'][$showTitle] = array(
						'count' => 0,
						'watch_delay' => 0
					);
				}
				$output['tv'][$showTitle]['count']++;
				$output['tv'][$showTitle]['watch_delay'] += $watchDelay;
				$daysOfWeekTv[$dayOfWeek]++;
				$monthsTv[$month]++;

				foreach ($genres as $genre) {
					if(!array_key_exists($genre, $genresTv)) {
						$genresTv[$genre] = 0;
					}
					$genresTv[$genre]++;
				}
			}
			else {
				$output['movies']['total']['count']++;
				$output['movies']['total']['watch_delay'] += watch_delay($row);
				$title = utf8_decode(trim($row[5]));
				$output['movies'][$title] = array('watch_delay' => watch_delay($row));
				$daysOfWeekMovies[$dayOfWeek]++;
				$monthsMovies[$month]++;

				foreach ($genres as $genre) {
					if(!array_key_exists($genre, $genresMovies)) {
						$genresMovies[$genre] = 0;
					}
					$genresMovies[$genre]++;
				}
			}
		}
		fclose($handle);
	}
	else {
		echo "<p>Error opening uploaded file."; // debug!
		exit(); // debug!
	}

	$mostWatched = $fastestWatchedTv = $fastestWatchedMovies = array();
	foreach ($output['tv'] as $title => &$data) {
		if ($data['count'] < $minimumCount) {
			unset($output['tv'][$title]);
			continue;
		}

		if (!empty($data['count'])) {
			$data['watch_delay'] /= $data['count'];
		}
		$fastestWatchedTv[$title] = $data['watch_delay'];
		if ($title != 'total') {
			$mostWatched[$title] = $data['count'];
		}
	}

	foreach ($output['movies'] as $title => &$data) {
		if ($title == 'total') {
			$data['watch_delay'] /= $data['count'];
		}
		if (empty($fastestWatchedMovies[$title])) {
			$fastestWatchedMovies[$title] = $data['watch_delay'];
		}
	}

	asort($fastestWatchedTv);
	asort($fastestWatchedMovies);
	arsort($mostWatched);
	arsort($genresTotal);
	arsort($genresTv);
	arsort($genresMovies);

?>
		<!--Load the AJAX API-->
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<script type="text/javascript">

			// Load the Visualization API and the piechart package.
			google.load('visualization', '1.0', {'packages':['corechart']});

			// Set a callback to run when the Google Visualization API is loaded.
			google.setOnLoadCallback(drawCharts);

			// Callback that creates and populates a data table,
			// instantiates the pie chart, passes in the data and
			// draws it.
			function drawCharts() {

				<?php foreach ($charts as $chartType => $chartTypeData):
					if(!empty($options['charts'][$chartType])):
				?>

				var <?php echo $chartType; ?>Data = new google.visualization.DataTable();
				<?php echo $chartType; ?>Data.addColumn('string', 'Title');
				<?php echo $chartType; ?>Data.addColumn('number', '<?php echo $chartTypeData['label']?>');
				<?php echo $chartType; ?>Data.addRows([
					<?php
						$jsData = array();
						foreach ($$chartTypeData['dataSource'] as $title => $count) {
							// TODO: figure out a way to put the 'total' (average) in as a horizontal line
							if ($title == 'total') {
								continue;
							};

							$jsData[] = "[".json_encode(utf8_encode($title)).", $count]";
						}
						if ($maximumChartEntries && $chartTypeData['maximum_entries_filterable']) {
							$jsData = array_slice($jsData, 0, $maximumChartEntries);
						}
						echo implode(',', $jsData);
					?>
				]);


				var <?php echo $chartType; ?>Chart = new google.visualization.<?php echo $chartTypeData['type']; ?>Chart(document.getElementById('<?php echo $chartType; ?>_chart_div'));
				<?php echo $chartType; ?>Chart.draw(<?php echo $chartType; ?>Data, <?php echo json_encode($chartTypeData['chartOptions']); ?>);
				<?php
				endif;
				endforeach;
				?>

			}
		</script>
		<?php
		foreach ($charts as $chartType => $chartTypeData) {
			echo '<div id="'.$chartType.'_chart_div"></div>';
		}
		?>
<?php

endif;
?>
	<form class="form-horizontal" method="post" action="index.php" enctype="multipart/form-data">
		<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
		<fieldset>
			<div class="control-group">
				<label class="control-label" for="maximum_chart_entries">Maximum Chart Entries</label>
				<div class="controls">
					<input type="number" class="input-xlarge" id="maximum_chart_entries" name="maximum_chart_entries" value="<?php echo $options['maximum_chart_entries']?>">
					<p class="help-block">The number of items to list on each chart (0 = no limit)</p>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="minimum_count">Minimum Count</label>
				<div class="controls">
					<input type="number" class="input-xlarge" id="minimum_count" name="minimum_count" value="<?php echo $options['minimum_count']?>">
					<p class="help-block">For TV shows, the minimum number of check-ins for the show to be displayed, in case you tried out a pilot or two and don't want those shows appearing in your stats. (Default 1 = no minimum)</p>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="current_season_only">Current Season Only</label>
				<div class="controls">
					<label class="checkbox">
						<input type="checkbox" id="current_season_only" name="current_season_only"<?php echo (!empty($options['current_season_only']) ? ' checked="checked"': ''); ?>>
						<p class="help-block">For TV shows, display only shows released during the current season (so as to not skew the "fastest watched" chart with check-ins tied to older seasons)</p>
					</label>
				</div>
			</div>
			<div class="control-group" id="current_season_start_date_div">
				<label class="control-label" for="current_season_start_date">Current Season Start Date</label>
				<div class="controls">
					<input type="date" class="input-xlarge" id="current_season_start_date" name="current_season_start_date" value="<?php echo $options['current_season_start_date']?>">
					<p class="help-block">For TV shows, date the current season began</p>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="chart_width">Chart Width</label>
				<div class="controls">
					<input type="number" class="input-xlarge" id="chart_width" name="chart_width" value="<?php echo $options['chart_width']?>">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="chart_height">Chart Height</label>
				<div class="controls">
					<input type="number" class="input-xlarge" id="chart_height" name="chart_height" value="<?php echo $options['chart_height']?>">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="use_sample_csv">Use Sample CSV</label>
				<div class="controls">
					<label class="checkbox">
						<input type="checkbox" id="use_sample_csv" name="use_sample_csv"<?php echo (!empty($options['use_sample_csv']) ? ' checked="checked"': ''); ?>>
						<p class="help-block">If you don't have your own check-ins and just want to try out the system, we'll automatically use my <a href="CHECKINS.csv">CHECKINS.csv</a> file (as of <?php echo date("d M Y", filemtime("CHECKINS.csv"))?>).</p>
					</label>
				</div>
			</div>
			<div class="control-group" id="csv_file_div">
				<label class="control-label" for="csv_file">CSV File</label>
				<div class="controls">
					<input class="input-file" id="csv_file" name="csv_file" type="file">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Charts</label>
				<div class="controls">
					<?php foreach ($charts as $key => $data): ?>
					<label class="checkbox">
						<input type="checkbox" id="charts[<?php echo $key?>]" name="charts[<?php echo $key?>]"<?php echo (!empty($options['charts'][$key]) ? ' checked="checked"': ''); ?>>
						<p class="help-block"><?php echo $data['chartOptions']['title']?></p>
					</label>
					<?php endforeach;?>
				</div>
			</div>
			<div class="form-actions">
				<input type="submit" value="Submit" class="btn btn-primary">
			</div>
		</fieldset>

		<h2>Usage</h2>
		<ol>
			<li>Download the "CHECKINS.csv" file from IMDb. (Log in to IMDb, go to the <a href="http://www.imdb.com/profile/lists">"Your Lists" page</a>, then find the "Your Checkins" link, and then find the "Export this list" link at the bottom.)</li>
			<li>Upload the "CHECKINS.csv" file into the form on this page.</li>
		</ol>

		<h2>About</h2>
		<p>IMDb's check-in service is rather new and thus is very limited: there's only two ways to get data in, and only one way to get data out (by pulling down a CSV file of your check-ins). This leads to a chicken-and-egg problem: why would you put the time into doing the check-ins if there's nothing that you can do with the data? This script helps alleviate that problem somewhat by making some sense of the raw data provided by that CSV.</p>
		<p>The source code for this project is available at <a href="https://github.com/curtisgibby/parse_imdb_checkins">GitHub</a>.</p>
	</form>

	<script>
		$(document).ready(function() {

			$("#current_season_only").change( function () {
				if ($(this).is(":checked")) {
					$("#current_season_start_date_div").show('slow');
				}
				else{
					$("#current_season_start_date_div").hide('slow');
				};
			}).change();

			$("#use_sample_csv").change( function () {
				if (!$(this).is(":checked")) {
					$("#csv_file_div").show('slow');
				}
				else{
					$("#csv_file_div").hide('slow');
				};
			}).change();
		});
	</script>
</body>
</html>
