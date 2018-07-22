<?php
if(isset($_REQUEST['dodajanketu'])){
    $opcija=$_REQUEST['opcija'];
    $upit="INSERT INTO anketa(opcija) VALUES('$opcija')";
    $result=mysqli_query($conn,$upit);
}
?>
<form class="form-horizontal" action="admin.php?page=dodajanketu" method="POST" enctype="multipart/form-data">
    <fieldset>
        <div id="legend">
            <legend class="">Dodaj pitanje</legend>
        </div>
        <div class="control-group">
            <!-- Username -->
            <div class="controls">
                <input type="text" name="opcija" placeholder="" class="input-xlarge">

            </div>
        </div
        <div class="control-group">
            <!-- Button -->
            <div class="controls">
                </br>
                <button type="submit" class="btn btn-success" name="dodajanketu">Dodaj</button>
            </div>
        </div>
    </fieldset>
</form>