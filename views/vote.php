<?php
include('../konekcija.php');
$id = $_REQUEST['id_korisnika'];
$status = "select status_anketa from korisnici where id=$id;";
$res=mysqli_query($conn,$status);
$a=mysqli_fetch_array($res);
if((isset($_REQUEST['id_glasa']))&&$a['status_anketa']==0) {


        $id = $_REQUEST['id_glasa'];
        $upit = "UPDATE anketa SET glasovi = glasovi + 1 WHERE id = $id;";
        $updated = mysqli_query($conn, $upit);
        if ($updated) {
            $upit = "SELECT * FROM anketa;";
            $result = mysqli_query($conn, $upit);
            if (mysqli_num_rows($result)) {
                echo '<table>';
                $upit_ukupno = "SELECT SUM(glasovi) FROM anketa;";
                $result_ukupno = mysqli_query($conn, $upit_ukupno);
                $ukupno = mysqli_fetch_row($result_ukupno)[0];
                while ($a = mysqli_fetch_array($result)) {
                    echo "<tr><td>" . $a['opcija'] . '<td><td>' . round($a['glasovi'] / $ukupno * 100, 1) . '%</td></tr>';
                }
                echo "</table>";
            }
            $id = $_REQUEST['id_korisnika'];
            $query = "UPDATE korisnici SET status_anketa=1 WHERE id=$id;";
            $rezultat = mysqli_query($conn, $query);
        }
        
    }
    else{
        echo "Vec ste glasali!!!";
    }

?>