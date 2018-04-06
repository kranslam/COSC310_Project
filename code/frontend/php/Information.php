<?php
require('../../backend/fpdf.php');

$host     = "localhost";
$database = "mfc";
$user     = "root";
$password = "";

$connection = mysqli_connect($host, $user, $password, $database);

$error = mysqli_connect_error();
if ($error != null) {
    //  $output = "<p>Unable to connect to database!</p>";
    exit();
} else {
    //variable list
    $gender                              = (isset($_POST['gender']) ? $_POST['gender'] : null);
    $age                                 = (isset($_POST['age']) ? $_POST['age'] : null);
    $providesServicesToDemographic16to18 = 0;
    $providesServiceToDemographic19      = 0;
    $providesServiceToDemographic55      = 0;
    $providesServiceToOtherDemographic   = 0;
    if ($age == 'under19') {
        $providesServicesToDemographic16to18 = 1;
    } elseif ($age == 'over19') {
        $providesServiceToDemographic19 = 1;
    } elseif ($age == 'Senior') {
        $providesServiceToDemographic55 = 1;
    } else {
        $providesServiceToOtherDemographic = 1;
    }
    $suitablefor = (isset($_POST['group']) ? $_POST['group'] : null);
    $individual  = 0;
    $couples     = 0;
    $family      = 0;
    $othergroup  = 0;
    if ($suitablefor == 'individual') {
        $individual = 1;
    } elseif ($suitablefor == 'couples') {
        $couples = 1;
    } elseif ($suitablefor == 'family') {
        $family = 1;
    } else {
        $othergroup = 1;
    }
    $availableNow       = (isset($_POST['availableNow']) ? 0 : 1);
    $BuildingType       = (isset($_POST['BuildingType']) ? $_POST['BuildingType'] : null);
    $buildingdisability = (isset($_POST['buildingdisability']) ? 1 : 0);
    $unitdisability     = (isset($_POST['unitdisability']) ? 1 : 0);
    $rgi                = (isset($_POST['rgi']) ? 1 : 0);
    $cost               = (isset($_POST['cost']) ? $_POST['cost'] : null);
    $PetFriendly        = (isset($_POST['PetFriendly']) ? 1 : 0);

    //query

    // $sql = "SELECT  DISTINCT title, coordinate, description,
    // buildingType, buildingQualifiesForRentalAssistance, monthlyCostOfStay,
    // hasWaitingList, estimatedWaitTime, hasMaximumDurationOfStay,
    // maximumDurationOfStay, servicesProvided, otherServices, buildingIsPetFriendly,
    // petRestriction FROM mfc WHERE unitsAreRGI=$rgi OR genderServed LIKE '%$gender%'
    // OR buuildingIsPetFriendly=$PetFriendly OR
    // providesServicesToDemographic16to18=$providesServicesToDemographic16to18 OR
    // providesServiceToDemographic19=$providesServiceToDemographic19 OR
    // providesServiceToDemographic55=$providesServiceToDemographic55 OR
    // providesServiceToOtherDemographic=$providesServiceToOtherDemographic OR
    // primaryTargetResidentsAreIndividuals=$individual OR primaryTargetResidentsAreFamilies=$family OR monthlyCostOfStay LIKE '%$cost%'
    // OR buildingType LIKE '%$BuildingType%' OR hasWaitingList=$availableNow ;";
    $sql     = "SELECT  DISTINCT * FROM mfc WHERE unitsAreRGI=$rgi OR genderServed LIKE '%$gender%'
OR buuildingIsPetFriendly=$PetFriendly OR
providesServicesToDemographic16to18=$providesServicesToDemographic16to18 OR
providesServiceToDemographic19=$providesServiceToDemographic19 OR
providesServiceToDemographic55=$providesServiceToDemographic55 OR
providesServiceToOtherDemographic=$providesServiceToOtherDemographic OR
primaryTargetResidentsAreIndividuals=$individual OR primaryTargetResidentsAreFamilies=$family OR monthlyCostOfStay LIKE '%$cost%'
OR buildingType LIKE '%$BuildingType%' OR hasWaitingList=$availableNow ;";
    // $sql="SELECT * FROM mfc;";
    $results = mysqli_query($connection, $sql);

    $pdf = new FPDF();
    $pdf->AddPage();
    while ($row = mysqli_fetch_assoc($results)) {
        $pdf->SetFont('Arial', 'b', 15);
        $pdf->MultiCell(180, 10, $row['title']);
        $pdf->SetFont('Arial', 'u', 10);

        $pdf->MultiCell(50, 10, 'Location: ' );
        $pdf->SetFont('');
        $pdf->MultiCell(180, 10, $row['coordinate']);

        $pdf->SetFont('Arial', 'u', 10);
        $pdf->MultiCell(50, 10, 'Description: ');
        $pdf->SetFont('');
        $pdf->MultiCell(180, 10, isZero($row['description']));

        $pdf->SetFont('Arial', 'u', 10);
        $pdf->MultiCell(50, 10, 'Building Type: ');
        $pdf->SetFont('');
        $pdf->MultiCell(180, 10, $row['buildingType']);

        $pdf->SetFont('Arial', 'b', 11);
        $pdf->MultiCell(180, 10, "Cost");

        $pdf->SetFont('Arial', 'u', 10);
        $pdf->MultiCell(90, 10, 'Eligible for income/disability assistance?: ');
        $pdf->SetFont('');
        $pdf->MultiCell(180, 10, isZero($row['buildingQualifiesForRentalAssistance']));

        $pdf->SetFont('Arial', 'u', 10);
        $pdf->MultiCell(50, 10, 'Rent/costs? ');
        $pdf->SetFont('');
        $pdf->MultiCell(180, 10, $row['monthlyCostOfStay']);

        $pdf->SetFont('Arial', 'u', 10);
        $pdf->MultiCell(50, 10, 'Is there a waitlist? ');
        $pdf->SetFont('');
        $pdf->MultiCell(180, 10,  isZero($row['hasWaitingList']));

        $pdf->SetFont('Arial', 'u', 10);
        $pdf->MultiCell(50, 10, 'Estimated Wait Time: ');
        $pdf->SetFont('');
        $pdf->MultiCell(180, 10,$row['estimatedWaitTime']);

        $pdf->SetFont('Arial', 'u', 10);
        $pdf->MultiCell(80, 10, 'Has maximum duration of stay? ');
        $pdf->SetFont('');
        $pdf->MultiCell(180, 10, isZero($row['hasMaximumDurationOfStay']));

        $pdf->SetFont('Arial', 'u', 10);
        $pdf->MultiCell(50, 10, 'Services provided: ');
        $pdf->SetFont('');
        $pdf->MultiCell(180, 10, $row['servicesProvided']);

        $pdf->SetFont('Arial', 'u', 10);
        $pdf->MultiCell(50, 10, 'Other Services Provided: ');
        $pdf->SetFont('');
        $pdf->MultiCell(180, 10, isZero($row['otherServices']));

        $pdf->SetFont('Arial', 'b', 11);
        $pdf->MultiCell(180, 10, "Restrictions");

        $pdf->SetFont('Arial', 'u', 10);
        $pdf->MultiCell(50, 10, 'Pet Friendly? ' );
        $pdf->SetFont('');
        $pdf->MultiCell(180, 10, isZero($row['buuildingIsPetFriendly']));

        $pdf->SetFont('Arial', 'u', 10);
        $pdf->MultiCell(50, 10, 'Pet Restrictions: ');
        $pdf->SetFont('');
        $pdf->MultiCell(180, 10, $row['petRestriction']);

        $pdf->SetFont('Arial', 'u', 10);
        $pdf->MultiCell(50, 10, 'Smoking? ');
        $pdf->SetFont('');
        $pdf->MultiCell(180, 10, isZero($row['smokingIsPermittedInBuilding']));

        $pdf->SetFont('Arial', 'u', 10);
        $pdf->MultiCell(50, 10, 'Drug / Alcohol Tolerance: ');
        $pdf->SetFont('');
        $pdf->MultiCell(180, 10, isZero($row['levelOfDrugsAndAlcoholTolerence']));

        $pdf->SetFont('Arial', 'u', 10);
        $pdf->MultiCell(50, 10, 'Demographics Accomodated: ');
        $pdf->SetFont('');
        $pdf->MultiCell(180, 10,  $row['demographicServed']);

        $pdf->SetFont('Arial', 'u', 10);
        $pdf->MultiCell(50, 10, 'Genders Accomodated: ');
        $pdf->SetFont('');
        $pdf->MultiCell(180, 10, $row['genderServed']);

        $pdf->SetFont('Arial', 'u', 10);
        $pdf->MultiCell(50, 10, 'People Accommodated: ');
        $pdf->SetFont('');
        $pdf->MultiCell(180, 10, $row['primaryTarget']);

        $pdf->AddPage();


        // $pdf->MultiCell(40,10,'Column: '.$row['title']);
        // foreach($row as $field) {
        //
        //   if ($count==120) {
        //     // $pdf->AddPage();
        //     $pdf->SetFont('Arial','b',15);
        //     $pdf->MultiCell(40,10,"Organization Name");
        //     $count=0;
        //     $pdf->SetFont('Arial','',11);
        //
        //   }
        //   // $pdf->Cell(10, 10, 'Column: ');
        //   $pdf->MultiCell(180,10,'Column: '.$field);
        //   $count++;
        // }


    }
    // mysqli_free_result($results);
    mysqli_close($connection);

}
$pdf->Output();

function isZero($value)
{
    if (!is_array($value)) {
        if (!is_string($value)) {
            if ($value == 0) {
                return 'No';
            } else {
                return 'Yes';
            }
        } else if (empty($value)) {
            return 'N/A';
        } else if ($value == '0') {
            return 'No';
        } else if($value=='1'){
            return 'Yes';
        }else{
            return $value;
        }
    }else //is an array
    if (empty($value)) {
        return 'N/A';
    } else {
        return $value;
    }
}
?>
