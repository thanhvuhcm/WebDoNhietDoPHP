<?php
if(isset($_GET['temp']) && isset($_GET['humi'])){
    $temp = $_GET['temp'];
    $humi = $_GET['humi'];
    $b = array(
            'temp'=>$temp, 
            'humi'=>$humi
    );
    $filedata = fopen("data.json", "w");
    if( $filedata == false )
    {
    	echo "error make file ";
    	exit();
    }
    $data = json_encode($b);
    fwrite($filedata, $data );
    fclose($filedata);
    echo($data);
    }
else{
    echo "no data";
}
?>