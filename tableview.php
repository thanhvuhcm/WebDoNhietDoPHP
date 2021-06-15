<?php include 'header.php';?>

<form class="container" action="/php/tableview.php" method="post" style="margin-bottom:2em">
  <label for="tableview">Table view:</label>
  <input type="date" id="tableview" name="tableview" value="2021-06-12">
   <input type="submit">
   <!-- <button type="submit" onclick="myFunction()">Watch it</button> -->

</form>

<?php

  $year1=substr($_POST["tableview"], 2, 2);
  $month1=substr($_POST["tableview"], 5, 2);
  $day1=substr($_POST["tableview"], 8, 3);

  $fileName1="datalog/".$day1 .$month1 .$year1 ."data.txt";

//echo $fileName1;
if(!file_exists($fileName1))
{
    echo "<span class='error'>Không thể tìm thấy tệp theo ngày này!</span>";
    exit;
}

    $fp = fopen($fileName1, "r");

    if(!$fp)
    {
        echo "Tập tin không mở được! :)";
        exit;
    }
    echo "<table class='container table-responsive'  border = 4><tr><th>No.</th><th>Date time</th><th>Soil temperature (°C)</th><th>Soil Moisture (%)</th><th>Air temperature (°C)</th><th>Air Moisture (%)</th></tr>";
    $counter = 1;
    while(!feof($fp))
    {
        $noidung = fgets($fp);
        $date_time=substr($noidung,0,20);
        $soil_temp=substr($noidung,21,5);
        $soil_humi=substr($noidung,27,2);
       
        echo "<tr><td class='formatcenter'>$counter</td>";
        echo "<td>$date_time</td>";
        echo "<td class='formatcenter'>$soil_temp</td>";
        echo "<td class='formatcenter'>$soil_humi</td>";

        echo "<td></td>";
        echo "<td></td></tr>";

        $counter++;
    }
        echo "</table>";
    fclose($fp)
?>

</body>