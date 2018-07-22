
<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
  <fieldset>
    <div id="legend">
      <legend class="">Registracija</legend>
    </div>
		  <div class="control-group">
    <select name="uloga" class="selectpicker">
  <option value="1">Admin</option>
  <option value="2">Korisnik</option>
</select>
</div>
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">Username</label>
      <div class="controls">
        <input type="text" id="username" name="username" placeholder="" class="input-xlarge">

      </div>
    </div>

    <div class="control-group">
      <!-- E-mail -->
      <label class="control-label" >Password</label>
      <div class="controls">
        <input type="password"  name="password" placeholder="" class="input-xlarge">
      </div>
    </div>

    <div class="control-group">
      <!-- Password-->
      <label class="control-label" >Email</label>
      <div class="controls">
        <input type="text"  name="email" placeholder="" class="input-xlarge">
      </div>
    </div>

    <div class="control-group">
      <!-- Password -->
      <label class="control-label"  for="telephone">Telefon</label>
      <div class="controls">
        <input type="text"  name="telefon" placeholder="" class="input-xlarge">
      </div>
    </div>

    <div class="control-group">
      <!-- Button -->
      <div class="controls">
      </br>
        <button type="submit" class="btn btn-success" name="register">Register</button>
      </div>
    </div>
  </fieldset>
</form>
