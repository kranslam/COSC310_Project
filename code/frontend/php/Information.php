<!DOCTYPE html>
<html>

<p>Here are some results:</p>

<?php

$host = "localhost";
$database = "mfac";
$user = "devon";
$password = "password";

$connection = mysqli_connect($host, $user, $password, $database);

$error = mysqli_connect_error();
if($error != null)
{
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}
else
{
    //variable list
    $gender=(isset($_POST['gender']) ? $_POST['gender'] : null);
    $age=(isset($_POST['age']) ? $_POST['age'] : null);
    $providesServicesToDemographic16to18=0;
    $providesServiceToDemographic19=0;
    $providesServiceToDemographic55=0;
    $providesServiceToOtherDemographic=0;
    if($age=='under19'){
      $providesServicesToDemographic16to18=1;
    }
    elseif ($age=='over19') {
      $providesServiceToDemographic19=1;
    }
    elseif ($age=='Senior') {
      $providesServiceToDemographic55=1;
    }
    else {
      $providesServiceToOtherDemographic=1;
    }
    $suitablefor=(isset($_POST['group']) ? $_POST['group'] : null);
    $individual=0;
    $couples=0;
    $family=0;
    $othergroup=0;
    if($suitablefor=='individual'){
      $individual=1;
    }
    elseif ($suitablefor=='couples') {
      $couples=1;
    }
    elseif ($suitablefor=='family') {
      $family=1;
    }
    else {
      $othergroup=1;
    }
    $availableNow=(isset($_POST['availableNow']) ? 0 : 1);
    $BuildingType=(isset($_POST['BuildingType']) ? $_POST['BuildingType'] : null);
    $buildingdisability=(isset($_POST['buildingdisability']) ? 1 : 0);
    $unitdisability=(isset($_POST['unitdisability']) ? 1 : 0);
    $rgi=(isset($_POST['rgi']) ? 1 : 0);
    $cost=(isset($_POST['cost']) ? $_POST['cost'] : null);
    $PetFriendly=(isset($_POST['PetFriendly']) ? 1 : 0);

    //query
    // make a key value pair array with the id as the key and the count of how many times it shows up as the value
    //everytime the id shows up in a query increase the count by 1
    //might need to make it a 2d array not sure yet
    //dort the array on the value in decending order and query on the id and print what we need to print
    $rowIds = array();
    $sql = "SELECT  DISTINCT * FROM mfac WHERE unitsAreRGI=$rgi ;";
    $sql2 = "SELECT  DISTINCT * FROM mfac WHERE genderServed LIKE '%$gender%' ;";
    $sql3 = "SELECT  DISTINCT * FROM mfac WHERE buuildingIsPetFriendly=$PetFriendly ;";
    $sql4 = "SELECT  DISTINCT * FROM mfac WHERE providesServicesToDemographic16to18=$providesServicesToDemographic16to18 ;";
    $sql5 = "SELECT  DISTINCT * FROM mfac WHERE providesServiceToDemographic19=$providesServiceToDemographic19 ;";
    $sql6 = "SELECT  DISTINCT * FROM mfac WHERE providesServiceToDemographic55=$providesServiceToDemographic55 ;";
    $sql7 = "SELECT  DISTINCT * FROM mfac WHERE providesServiceToOtherDemographic=$providesServiceToOtherDemographic ;";
    $sql8 = "SELECT  DISTINCT * FROM mfac WHERE primaryTargetResidentsAreIndividuals=$individual ;";
    $sql9 = "SELECT  DISTINCT * FROM mfac WHERE primaryTargetResidentsAreFamilies=$family ;";
    $sql10= "SELECT  DISTINCT * FROM mfac WHERE monthlyCostOfStay LIKE '%$cost%' ;";
    $sql11= "SELECT  DISTINCT * FROM mfac WHERE buildingType LIKE '%$BuildingType%' ;";
    $sql12= "SELECT  DISTINCT * FROM mfac WHERE hasWaitingList=$availableNow ;";
    $results = mysqli_query($connection, $sql);
    $results2 = mysqli_query($connection, $sql2);
    $results3 = mysqli_query($connection, $sql3);
    $results4 = mysqli_query($connection, $sql4);
    $results5 = mysqli_query($connection, $sql5);
    $results6 = mysqli_query($connection, $sql6);
    $results7 = mysqli_query($connection, $sql7);
    $results8 = mysqli_query($connection, $sql8);
    $results9 = mysqli_query($connection, $sql9);
    $results10 = mysqli_query($connection, $sql10);
    $results11 = mysqli_query($connection, $sql11);
    $results12 = mysqli_query($connection, $sql12);
    while ($row = mysqli_fetch_assoc($results))
    {
      if($rowsIds[$row['id']]==null){
        $rowIds[$rows['id']]=1;
      }else{
        $count = $rowIds[$rows['id']];
        $rowIds[$rows['id']]= ($count+1);
      }
    }

    while ($row2 = mysqli_fetch_assoc($results2))
    {
      if($rowsIds[$row2['id']]==null){
        $rowIds[$rows2['id']]=1;
      }else{
        $count = $rowIds[$rows2['id']];
        $rowIds[$rows2['id']]= ($count+1);
      }
    }

    while ($row3 = mysqli_fetch_assoc($results3))
    {
      if($rowsIds[$row3['id']]==null){
        $rowIds[$rows3['id']]=1;
      }else{
        $count = $rowIds[$rows3['id']];
        $rowIds[$rows3['id']]= ($count+1);
      }
    }

    while ($row4 = mysqli_fetch_assoc($results4))
    {
      if($rowsIds[$row4['id']]==null){
        $rowIds[$rows4['id']]=1;
      }else{
        $count = $rowIds[$rows4['id']];
        $rowIds[$rows4['id']]= ($count+1);
      }
    }

    while ($row5 = mysqli_fetch_assoc($results5))
    {
      if($rowsIds[$row5['id']]==null){
        $rowIds[$rows5['id']]=1;
      }else{
        $count = $rowIds[$rows5['id']];
        $rowIds[$rows5['id']]= ($count+1);
      }
    }

    while ($row6 = mysqli_fetch_assoc($results6))
    {
      if($rowsIds[$row6['id']]==null){
        $rowIds[$rows6['id']]=1;
      }else{
        $count = $rowIds[$rows6['id']];
        $rowIds[$rows6['id']]= ($count+1);
      }
    }

    while ($row7 = mysqli_fetch_assoc($results))
    {
      if($rowsId[$row['id']]==null){
        $rowIds[$rows['id']]=1;
      }else{
        $count = $rowIds[$rows['id']];
        $rowIds[$rows['id']]= ($count+1);
      }
    }
      echo "<p>id is: ".$row['id']."<br>item owner name: ".$row['itemOwnerName']."<br>item owner email: ".
      $row['itemOwnerEmail']."<br>providesServiceToMales: ".
      $row["providesServiceToMales"]."<br>providesServiceToFemales: ".
      $row['providesServiceToFemales']."<br>providesServiceToTransgender: ".$row['providesServiceToTransgender'].
      "<br>providesServicesToDemographic16to18: ".$row['providesServicesToDemographic16to18'].
      "<br>providesServiceToDemographic19: ".$row['providesServiceToDemographic19'].
      "<br>providesServiceToDemographic55: ".$row['providesServiceToDemographic55'].
      "<br>providesServiceToOtherDemographic: ".$row['providesServiceToOtherDemographic'].
      "<br>primaryTargetResidentsAreIndividuals: ".$row['primaryTargetResidentsAreIndividuals'].
      "<br>primaryTargetResidentsAreFamilies: ".$row['primaryTargetResidentsAreFamilies'].
      "<br>availableNow: ".$row['hasWaitingList']."<br>buildingType: ".$row['buildingType'].
      "<br>buildingdisability: ".$row['buildingAccommodatedIndividualsWithDisabilites']."<br>unitdisability".$row['someUnitsAccommodateIndividualsWithDisabilities'].
      "<br>rgi".$row['unitsAreRGI']."<br>cost: ".$row['monthlyCostOfStay']."<br>petfriendly: ".$row['buuildingIsPetFriendly']."</p>";


    mysqli_free_result($results);
    mysqli_close($connection);

}
?>
</html>
