<?php
include ('../konekcija.php');
session_start();

if(isset($_POST['send'])) {
    $first = $_POST['first'];
    $last = $_POST['last'];
    $email = $_POST['email'];
    $mesage = $_POST['mesage'];
    $reemail = "/^[a-zA-Z0-9.]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/";
    $errors=[];
    if(!preg_match($reemail,$email)){
        array_push($errors,"Email nije u dobro formatu");
    }
    if($first==""){
        array_push($errors,"Niste upisali ime");
    }
    if($last==""){
        array_push($errors,"Niste upisali prezime");
    }
    if($mesage==""){
        array_push($errors,"Niste upisali poruku");
    }
   if(count($errors)==0) {

       $upit = "INSERT INTO contact(ime,prezime,email,message)VALUES(:ime,:prezime,:email,:message)";
       $stmt = $kon->prepare($upit);
       $stmt->bindParam(":ime", $first);
       $stmt->bindParam(":prezime", $last);
       $stmt->bindParam(":email", $email);
       $stmt->bindParam(":message", $mesage);
       $stmt->execute();
       $_SESSION['success']="Uspesno ste poslali poruku";
       header("Location:".$_SERVER['HTTP_REFERER']);
   }else{
        $_SESSION['errors']=$errors;
       header("Location:".$_SERVER['HTTP_REFERER']);
   }
}
?>