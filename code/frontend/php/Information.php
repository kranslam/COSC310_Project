<<<<<<< HEAD
<!DOCTYPE html>
<html>

<p>Here are some results:</p>

<?php

$host = "localhost";
$database = "mfac";
$user = "mfac";
$password = "v9KdEMGL";

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
    $drugalcoholtolerance=(isset($_POST['zerodrugs']) ? 1 : 0);

    //query

    $sql = "SELECT  DISTINCT * FROM mfac WHERE unitsAreRGI=$rgi OR genderServed LIKE '%$gender%' OR
    residentsAreRequiredToAbstainFromAlcoholAndDrugs=$drugalcoholtolerance OR buuildingIsPetFriendly=$PetFriendly OR
    providesServicesToDemographic16to18=$providesServicesToDemographic16to18 OR
    providesServiceToDemographic19=$providesServiceToDemographic19 OR
    providesServiceToDemographic55=$providesServiceToDemographic55 OR
    providesServiceToOtherDemographic=$providesServiceToOtherDemographic OR
    primaryTargetResidentsAreIndividuals=$individual OR primaryTargetResidentsAreFamilies=$family OR monthlyCostOfStay LIKE '%$cost%'
    OR buildingType LIKE '%$BuildingType%' OR hasWaitingList=$availableNow ;";
    $results = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($results))
    {
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
      "<br>rgi".$row['unitsAreRGI']."<br>cost: ".$row['monthlyCostOfStay']."<br>petfriendly: ".$row['buuildingIsPetFriendly'].
      "<br>levelOfDrugsAndAlcoholTolerence: ".$row['residentsAreRequiredToAbstainFromAlcoholAndDrugs']."</p>";

    }
    mysqli_free_result($results);
    mysqli_close($connection);

}
?>
</html>
=======
<!DOCTYPE html>
<html>

<p>Here are some results:</p>

<?php

$host = "localhost";
$database = "mfac";
$user = "mfac";
$password = "v9KdEMGL";

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
    $email=$_POST['email'];
    $bday=$_POST['bday'];
    $gender=(isset($_POST['gender']) ? $_POST['gender'] : null);
    $tel=$_POST['tel'];
    $BuildingType=(isset($_POST['BuildingType']) ? $_POST['BuildingType'] : null);
    $CaseManagementServices=(isset($_POST['CaseManagmentServices']) ? $_POST['CaseManagmentServices'] : null);
    $ReferralsToOtherAgencies=(isset($_POST['ReferralsToOtherAgencies']) ? $_POST['ReferralsToOtherAgencies'] : null);
    $HealthDentalCare=(isset($_POST['Health/DentalCare']) ? $_POST['Health/DentalCare'] : null);
    $meals=(isset($_POST['meals']) ? $_POST['meals'] : null);
    $Showers=(isset($_POST['Showers']) ? $_POST['Showers'] : null);
    $Storage=(isset($_POST['Storage']) ? $_POST['Storage'] : null);
    $ClothingHouseholdGoods=(isset($_POST['Clothing/HouseholdGoods']) ? $_POST['Clothing/HouseholdGoods'] : null);
    $OtherServices=(isset($_POST['Text1']) ? $_POST['Text1'] : null);
    $NumberOfBeds=(isset($_POST['NumberOfBeds']) ? $_POST['NumberOfBeds'] : null);
    $OtherBedroomUnits=(isset($_POST['OtherBedroomUnits']) ? $_POST['OtherBedroomUnits'] : null);
    $disabilities=(isset($_POST['disabilities']) ? $_POST['disabilities'] : null);
    $aboriginal=(isset($_POST['aboriginal']) ? $_POST['aboriginal'] : null);
    $budget=(isset($_POST['budget']) ? $_POST['budget'] : null);
    $FixedIncome=(isset($_POST['FixedIncome']) ? $_POST['FixedIncome'] : null);
    $DisabilityAssistance=(isset($_POST['DisabilityAssistance']) ? $_POST['DisabilityAssistance'] : null);
    $PetFriendly=(isset($_POST['PetFriendly']) ? $_POST['PetFriendly'] : null);
    $drinker=(isset($_POST['drinker']) ? $_POST['drinker'] : null);
    $smoker=(isset($_POST['smoker']) ? $_POST['smoker'] : null);
    $ProfessionalSupport=(isset($_POST['ProfessionalSupport']) ? $_POST['ProfessionalSupport'] : null);
    //query
    echo $HealthDentalCare;
    echo $smoker;
    $sql = "SELECT * FROM mfac;";
    $results = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($results))
    {
      /*
      foreach($row as $field) {
        echo '<p>' . htmlspecialchars($field) . '</p>';
    }
    */
    }
    mysqli_free_result($results);
    mysqli_close($connection);

}
?>
</html>
>>>>>>> bb30078c83cc6aba4144fae83a543a5fe985493b
