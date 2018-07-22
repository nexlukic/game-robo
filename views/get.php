<?php

include ('../konekcija.php');
include('json.php');
$table=$_REQUEST['table'];
$id=$_REQUEST['id'];
$stmt=$kon->prepare("SELECT * from $table where id = :id");
$stmt->bindParam('id',$id);
$stmt->execute();
$niz=$stmt->fetchAll();
returnJson($niz);