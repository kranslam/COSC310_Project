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
