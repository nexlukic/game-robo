<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- MetisMenu CSS -->
<link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="../data/dist/css/sb-admin-2.css" rel="stylesheet">

<!-- Morris Charts CSS -->
<link href="../vendor/morrisjs/morris.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<?php
include('../konekcija.php');
$id=$_REQUEST['id'];
$upit="SELECT * from anketa where id=$id";
$result=mysqli_query($conn,$upit);
?>
<?php
if(isset($_REQUEST['izmenianketu'])){
    $id=$_REQUEST['id'];
    $opcija=$_REQUEST['opcija'];
    $glasovi=$_REQUEST['glasovi'];
    $upit="UPDATE ANKETA SET opcija='$opcija',glasovi='$glasovi' WHERE id='$id';";
    $result=mysqli_query($conn,$upit);
    if($result){
        header('Location: http://localhost/sajt/views/admin.php?page=anketa');
    }
}
?>
<?php foreach($result as $r):?>
    <div class="col-lg-12  col-lg-offset-5 centred">
        <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <fieldset>
                <div id="legend">
                    <legend class="">Izmeni</legend>
                </div>
                <input type="hidden" name="id" value="<?php echo $r['id']?>">
                <div class="control-group">
                    <!-- E-mail -->
                    <label class="control-label" >Naziv</label>
                    <div class="controls">
                        <input type="text" value="<?php echo $r['opcija'];?>" name="opcija" placeholder="" class="input-xlarge">
                    </div>
                </div>
                <div class="control-group">
                    <!-- E-mail -->
                    <label class="control-label" >Naziv</label>
                    <div class="controls">
                        <input type="text" value="<?php echo $r['glasovi'];?>" name="glasovi" placeholder="" class="input-xlarge">
                    </div>
                </div>

                <div class="control-group">
                    <!-- Button -->
                    <div class="controls">
                        </br>
                        <button type="submit" class="btn btn-success" name="izmenianketu">Izmeni</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
<?php endforeach;?>