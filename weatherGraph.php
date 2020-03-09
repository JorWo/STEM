<!DOCTYPE HTML>
<?php
$servername = "192.168.0.210";
$username = "humChecker";
$password = "raspberry";
$dbname = "projects";

$tempValues = array();
$humValues = array();
$temps = array();
$hums = array();
$lastTimeStamp;

//Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT * FROM humTemp";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    //Push data from SQL server into arrays
    while($row = $result->fetch_assoc()) {
       array_push($tempValues, "{ x: ".(strtotime($row["timeStamp"])*1000).", y: ".$row["temperature"].", label:'".strftime("%b %d, %Y | %r",strtotime($row["timeStamp"]))."' }");
       array_push($humValues, "{ x: ".(strtotime($row["timeStamp"])*1000).", y: ".$row["humidity"]." }");
       array_push($temps, $row["temperature"]."°C on ".strftime("%b %d, %Y at %r",strtotime($row["timeStamp"])));
       array_push($hums, $row["humidity"]."% on ".strftime("%b %d, %Y at %r",strtotime($row["timeStamp"])));
       $lastTimeStamp = strtotime($row["timeStamp"]);
    }
} else {
    echo "0 results";
}
$conn->close();

//Send alert if data has not been updated for 5 minutes
if ((mktime() - $lastTimeStamp) > 300) {
	echo("ALERT: Data has not been updated for 5 minutes <br></br>");
}
//Echo highest and lowest values for temperature and humidity
echo("Temperature - High: ".max($temps)." | Low: ".min($temps)."<br></br>");
echo("Humidity - High: ".max($hums)." | Low: ".min($hums)."<br></br>");

?>

<html>
<head>


<script>
//Code from CanvasJS
window.onload = function () {
	var chart = new CanvasJS.Chart("chartContainer", {
	zoomEnabled: true,
	title:{
		text: "Temperature and Humidity from DHT11 Sensor"
	},
	subtitles:[
	{
		text: "Zoom and Pan Enabled"
	}
	],
	axisY:{
		title: "Temperature",
		lineColor: "#C24642",
		tickColor: "#C24642",
		labelFontColor: "#C24642",
		titleFontColor: "#C24642",
		suffix: "°C"
	},
	axisY2: {
		title: "Humidity",
		lineColor: "#1661BE",
		tickColor: "#1661BE",
		labelFontColor: "#1661BE",
		titleFontColor: "#1661BE",
		suffix: "%"
	},
	toolTip: {
		shared: true
	},
	legend: {
		cursor: "pointer",
		itemclick: toggleDataSeries
	},
	data: [
	{
		type: "line",
        xValueType: "dateTime",
		name: "Temperature",
		color: "#C24642",
		axisYIndex: 0,
		showInLegend: true,
		toolTipContent: "<strong>{label}</strong></br><font color='#C24642'>Temperature: </font>{y}°C",
		dataPoints: [
			<?php echo join(", ", $tempValues) ?>
		]
	},
	{
		type: "line",
		xValueType: "dateTime",
		name: "Humidity",
		color: "#1661BE",
		axisYType: "secondary",
		showInLegend: true,
		toolTipContent: "<font color='#1661BE'>Humidity: </font>{y}%",
		dataPoints: [
			<?php echo join(", ", $humValues) ?>
		]
	}]
});
chart.render();

function toggleDataSeries(e) {
	if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	} else {
		e.dataSeries.visible = true;
	}
	e.chart.render();
}

}
</script>
</head>
<body>
<div id="chartContainer" style="height: 300px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
