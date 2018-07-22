
<!-- //Head -->

<?php
session_start();
if(isset($_REQUEST['login'])){
    $greska="";
	$username=$_REQUEST['username'];
	$password=$_REQUEST['password'];
$upit="SELECT  k.id,k.username,k.status_anketa,u.naziv from korisnici as k  inner join uloga as u on k.id_uloga = u.id where username=:username and password=:password";
$stmt=$kon->prepare($upit);
$stmt->bindParam(":username",$username);
$stmt->bindParam(":password",$password);
$stmt->execute();
$rezultat=$stmt->fetchAll();
if($rezultat){

	foreach($rezultat as $r){
		$_SESSION['username']=$r['username'];
		$_SESSION['uloga']=$r['naziv'];
        $_SESSION['id']=$r['id'];
        $_SESSION['status_anketa']=$r['status_anketa'];
	}
	$id=$_SESSION['id'];
    $status = "select status_anketa from korisnici where id=$id;";
    $res=mysqli_query($conn,$status);
    $a=mysqli_fetch_array($res);
    echo $a['status_anketa'];
}
else{
	$greka="nema takvog korisnika";
}
}
if(isset($_REQUEST['register'])) {
    $greske = array();
    $username = $_REQUEST['username'];
    $email = $_REQUEST['email'];
    $upitkorisnik = "SELECT * from korisnici where username='$username'";
    $rezultatkorisnici = mysqli_query($conn, $upitkorisnik);
    $upitemail = "SELECT * from korisnici where email='$email'";
    $rezultatemail = mysqli_query($conn, $upitemail);
    $greskausername=null;
    $greskaemail=null;
    if (mysqli_num_rows($rezultatemail)>0){
        $greskaemail="Email je rezervisan";
    }
    if (mysqli_num_rows($rezultatkorisnici)>0) {
      $greskausername="Username je rezervisan";
    }
    if($greskausername==null&&$greskaemail==null){
        $password = $_REQUEST['password'];
        $email = $_REQUEST['email'];
        $telefon = $_REQUEST['telefon'];
        $reemail = "/^[a-zA-Z0-9.]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/";
        $retelefon = "/^[0-9]{3}-[0-9]{4}-[0-9]{3,4}$/";
        $repassword = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{5,}$/";
        $reusername = "/^[A-Za-z]{1}[A-Za-z0-9]{5,31}$/";
        if (!preg_match($reusername, $username)) {
            $greske[] = "Username nije u dobrom formatu";
        }
        if (!preg_match($retelefon, $telefon)) {
            $greske[] = "Telefon nije u dobrom formatu mora biti 000-0000-000!";
        }
        if (!preg_match($repassword, $password)) {
            $greske[] = "Password nije u dobrom formatu";
        }
        if (!preg_match($reemail, $email)) {
            $greske[] = "email nije u dobrom formatu";
        }
        $pass=md5($password);
        if (count($greske) == 0) {
            $upit1="INSERT into korisnici(username,password,email,telefon,id_uloga,datum) VALUES(:username,:password,:email,:telefon,2,NOW())";
            $stmt=$kon->prepare($upit1);
            $stmt->bindParam(":username",$username);
            $stmt->bindParam(":password",$pass);
            $stmt->bindParam(":email",$email);
            $stmt->bindParam(":telefon",$telefon);
            try{
                $res=$stmt->execute();
                echo $res;
            }catch (PDOException $ex){
                echo $ex->getMessage();
            }
        }
    }
}

?>
<script>
    function registracija(){
        var greske=[];
        var username=document.querySelector('#username').value;
        var password=document.querySelector('#password').value;
        var email=document.querySelector('#email').value;
        var telefon=document.querySelector('#telefon').value;
        var reemail=/^[a-zA-Z0-9.]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
        var retelefon=/^[0-9]{3}-[0-9]{4}-[0-9]{3,4}$/;
        var repassword=/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{5,}$/;
        var reusername=/^[A-Za-z]{1}[A-Za-z0-9]{5,31}$/;

        if(!reusername.test(username)){
            greske.push("<p class='text-danger'>username nije u dobrom formatu!</p>");
        }
        if(!repassword.test(password)){
            greske.push("<p class='text-danger'>password nije u dobrom formatu!'</p>");

        }
        if(!retelefon.test(telefon)){
            greske.push("<p class='text-danger'>telefon nije u dobrom formatu mora biti(000-0000-000)!</p>");

        }
        if(!reemail.test(email)){
            greske.push("<p class='text-danger'>email nije u dobrom formatu!</p>");
        }
        if(greske.length>0){
            for(i=0;i<greske.length;i++){
               document.querySelector("#greske").innerHTML+=greske[i];

            }
            return false;
            }
            if(greske.length==0){
                document.querySelector('#greske').innerHTML+=("<p class='text-success'>Uspesno ste se registrovali!</p>");
                return true;


            }
        }
</script>

<!-- Body -->
<body>



	<!-- Header -->
	<div class="agileheader" id="agileitshome">

		<!-- Navigation -->
		<div class="w3lsnavigation">
			<nav class="navbar navbar-inverse agilehover-effect wthreeeffect navbar-default">

				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- Logo -->
					<div class="logo">
						<a class="navbar-brand logo-w3l button" href="index.html">GAME ROBO</a>
					</div>
					<!-- //Logo -->
				</div>

				<div id="navbar" class="navbar-collapse navbar-right collapse">
					<ul class="nav navbar-nav navbar-right cross-effect" id="cross-effect">
                        <?php
                        $upit="SELECT naziv,link FROM navigacija";
                        $result=mysqli_query($conn,$upit);
                        mysqli_fetch_array($result);
                        ?>
					 <?php foreach($result as $r) :?>
						<li><a href="<?php echo $r['link']?>"><?php echo $r['naziv'] ?></a></li>
					<?php	endforeach; ?>
					<?php if(isset($_SESSION['uloga'])):?>
						<?php $uloga=$_SESSION['uloga'];?>
							<?php if($uloga== 'admin'): ?>
								<li><a href="views/admin.php">Admin panel</li>
							<?php endif; ?>
                        <li><a href="logout.php">Logout</a></li>
						<?php else:?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Login<b class="caret"></b></a>
							<div class="dropdown-menu">
								<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
									<div id="login" class="animate w3loginagile form">
										<h3>Login</h3>
										<input type="text" Name="username" placeholder="Username" required="">
										<input type="password" Name="password" placeholder="Password" required="">
										<div class="send-button wthree agileits">
											<input type="submit" name="login" value="Login">
										</div>
										<div class="clearfix"></div>s
									</div>
								</form>
								<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post"  onsubmit="return registracija()">
									<div id="register" class="animate w3registeragile form">
										<h3>Sign Up</h3>
										<input type="text" name="username" id="username" placeholder="Username" required="">
										<input type="text" name="email" id="email" placeholder="Email" required="">
										<input type="password" name="password" id="password" placeholder="Password" required="">
										<input type="text" name="telefon" id="telefon" placeholder="Phone Number" required="">
                                        <div id="greske">
                                        </div>
										<div class="send-button wthree agileits">
											<input type="submit" name="register" value="Sign Up">
										</div>
									
									</div>
									    <?php
                                    if(isset($greskausername)){
                                        echo "<h3 class='dagnerous'>$greskausername</h3>";
                                    }
                                    if(isset($greskaemail)){
                                        echo "<h3 class='dagnerous'>$greskaemail</h3>";
                                    }
                                

                                    ?>
								</form>
							</div>
						</li>
					<?php endif; ?>
					</ul>
				</div><!-- //Navbar-Collapse -->

			</nav>
		</div>
		<!-- //Navigation -->
