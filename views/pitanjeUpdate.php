<?php

include("../konekcija.php");
if(isset($_REQUEST['Edit'])){
    $id=$_REQUEST['id'];
    $name=$_REQUEST['name'];
    $upit="UPDATE pitanje SET tekst_pitanja=:name where id=:id";
    $stmt=$kon->prepare($upit);
    $stmt->bindParam(":id",$id);
    $stmt->bindParam("name",$name);
    try{
        $stmt->execute();
        header("Location:".$_SERVER['HTTP_REFERER']);
    }catch (PDOException $ex){
        echo $ex->getMessage();
    }
}