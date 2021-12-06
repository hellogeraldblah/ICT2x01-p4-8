<?php
 
$dataPoints = array(
	array("y" => 10, "label" => "5"),
	array("y" => 15, "label" => "10"),
	array("y" => 25, "label" => "15"),
	array("y" => 30, "label" => "20"),
	array("y" => 35, "label" => "25"),
	array("y" => 45, "label" => "30"),
	array("y" => 55, "label" => "35"),
    array("y" => 70, "label" => "40"),
	array("y" => 80, "label" => "45"),
	array("y" => 90, "label" => "50"),
	array("y" => 110, "label" => "55"),
	array("y" => 120, "label" => "60"),
	array("y" => 130, "label" => "65"),
	array("y" => 150, "label" => "70")
);
 
?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	title: {
		text: "Speed of Car"
	},
    axisX: {
		title: "Duration(sec)"
	},
	axisY: {
		title: "Speed (cm/sec)"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>             