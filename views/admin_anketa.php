<?php
include('../konekcija.php');
$upit="SELECT * from anketa";
$result=mysqli_query($conn,$upit);
mysqli_fetch_array($result);
?>
<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Opcija</th>
        <th scope="col">glasovi</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($result as $r):?>
        <tr>
            <th scope="row"><?php echo $r['id']?></th>
            <td><?php echo $r['opcija']?></td>
            <td><?php echo $r['glasovi']?></td>
            <td><a href="izmenianketu.php?id=<?php echo $r['id'];?>"><button type="button" class="btn btn-primary">Izmeni</button></a>&nbsp<a href="delete.php?id=<?php echo $r['id'];?>&tip=anketa"><button type="button" class="btn btn-danger">Obrisi</button></a></td></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
