<?php

include ('../konekcija.php');
$table=$_REQUEST['table'];
$id=$_REQUEST['id'];
$stmt=$kon->prepare("Delete from $table where id = :id");
$stmt->bindParam('id',$id);
try{
    $stmt->execute();
    header("Location:".$_SERVER['HTTP_REFERER']);
}
catch(PDOException $ex){
    echo $ex;
}