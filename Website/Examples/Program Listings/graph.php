<?php
ini_set('max_execution_time', 300);
 include ("c:/jpgraph-3.5.0b1/src/jpgraph.php");   
 include ("c:/jpgraph-3.5.0b1/src/jpgraph_line.php");
 include("dbcon.php");
if (isset($_POST['Plot']) ) ;// when submit button is pressed
{
//assign value in Temp to variable $data
$data=$_POST['Temp'];
$count=count($data);// get number of arrays
$dbdata = implode(',',$data);// change array to string
//select data from database
$query1 = "SELECT * FROM temp_values";
 $result1 = mysql_query($query1);
 if (!$result1) die ("Database access failed:" . mysql_error());
while($row = mysql_fetch_array($result1))
 {
$Hour[] = $row[1];
 }
//set graph scale
$graph = new Graph(1200,700,"auto");
$graph->SetScale("textlin");

$theme_class=new UniversalTheme;
$graph->SetMargin(30,10,40,10);
$graph->SetTheme($theme_class);
$graph->title->Set('Temperature Plots');
$graph->SetBox(false);

$graph->img->SetAntiAliasing(false);
$graph->img->SetAntiAliasing();

$graph->yaxis->HideZeroLabel();
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);


$graph->xgrid->Show();
$graph->xgrid->SetLineStyle("solid");

$graph->xaxis->SetTickLabels($Hour);
$graph->xscale->ticks->Set(20,5);
$graph->xaxis->SetLabelAngle(90);
$graph->xgrid->SetColor('#E3E3E3');
$graph->legend->SetAbsPos(5,20,'right','top');

// Select value from database
for ($i=0; $i<$count;++$i)		
{
$query= "SELECT $data[$i] FROM temp_values";
 $result = mysql_query($query);
 if (!$result) die ("Database access failed:" . mysql_error());
while($row = mysql_fetch_array($result))
 {
 //Plot selected value
 $val[$i][]=$row[0];
 $v[$i]= new LinePlot($val[$i]);
  $graph-> Add($v[$i]);	 

	}
 //create Legend for new temperature
 if ($data[$i]== 'New_temp')
  {
  	$v[$i]->SetColor('red');
	$v[$i]->SetLegend('New_temp');
	}
  //create Legend for new power
  if ($data[$i]== 'New_power')
  {
  	$v[$i]->SetColor('green');
	$v[$i]->SetLegend('New_power');
  }
  //Create Legend for Measured temperature
  if ($data[$i]== 'Measured_temp')
  {
  	$v[$i]->SetColor('blue');
	$v[$i]->SetLegend('Measured_temp');
  }
	
	}

// Get the handler to prevent the library from sending the
// image to the browser
$gdImgHandler = $graph->Stroke(_IMG_HANDLER);

//delete the previous graph
 @unlink("/xampp/htdocs/Labtools/img/graph.png");
$graph->Stroke("/xampp/htdocs/Labtools/img/graph.png");

header("location:index.php");
}

?>