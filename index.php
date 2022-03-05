<?php
#Ref: Gazetteer Files
#Title: ZIP Code Tabulation Areas
#Link: https://www.census.gov/geographies/reference-files/time-series/geo/gazetteer-files.html

$row = 1;
$header=[];
$onlyArrData=[];
$resData[]=["zip","lat","long"];
echo "<pre>";
if (($handle = fopen("2021_Gaz_zcta_national.csv", "r")) !== FALSE) {
    while (($line = fgetcsv($handle, 1000, ",")) !== FALSE) {
		if($row!=1){
			$csvData = $newLine = [];
			foreach($line as $col){
				$newLine[]=trim($col);
			}
			$csvData = array_combine($header, $newLine);
			$resData[] = array_intersect_key($csvData, array_flip(["GEOID","INTPTLAT","INTPTLONG"]));
		}else{
			$header = $line;
		}
        $row++;
    }
	createCSV($resData);
    fclose($handle);
}

function createCSV($data){
	$filename = 'USA_ZipCodeLatLong_Results.csv';
	$f = fopen($filename, 'w');
	foreach ($data as $row) {
		fputcsv($f, $row);
	}
	fclose($f);
}