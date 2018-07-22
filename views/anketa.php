<?php
include('../konekcija.php');
if(isset($_REQUEST['id']))
{
    $id = $_REQUEST['id'];
    $upit = "UPDATE anketa SET glasova = glasova + 1 WHERE id = $id;";
    $updated = mysqli_query($konekcija,$upit);
    if($updated)
    {
        $upit = "SELECT * FROM anketa;";
        $result = mysqli_query($konekcija,$upit);
        if(mysqli_num_rows($result))
        {
            echo '<table>';
            $upit_ukupno = "SELECT SUM(glasova) FROM anketa;";
            $result_ukupno = mysqli_query($konekcija,$upit_ukupno);
            $ukupno = mysqli_fetch_row($result_ukupno)[0];
            while($r = mysqli_fetch_array($result)) {
                echo "<tr><td>" . $r['opcija'] . '<td><td>' . round($r['glasova']/$ukupno*100,1) . '%</td></tr>';
            }
            echo "</table>";
        }
    }
}
?>