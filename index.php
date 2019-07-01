<?php

require 'dbcon/user.php';
require 'dbcon/dbcon.php';

for($year=2008; $x<2020; $year++ ){
$json = file_get_contents('https://calendarific.com/api/v2/holidays?api_key=2f7dbf82f945b1c6f040ed33ce148906b3777e2f&country=no&year='.$year.'');
$filename = $year.'.json';
$filestore = fopen($filename,'a');
fwrite($filestore,$json);
fclose($filestore);
//$json=file_get_contents($filename);

//echo $json;
$data=json_decode($json,true);
$datacount= count($data["response"]["holidays"]);
 for($x=0; $x<$datacount; $x++ ){
    $holiday=$data["response"]["holidays"][$x];
    $name= $holiday["name"];
    $desc= $holiday["description"];
    $date= $holiday["date"]["iso"];
    $type= $holiday["type"][0];
    echo '</br>';
    $sql = "INSERT INTO `holiday`(`name`, `description`, `date`, `type`) VALUES ('$name','$desc','$date','$type')";
    $res1=mysqli_query($conn,$sql);
    
 }
echo $year."Completed";

}
?>
