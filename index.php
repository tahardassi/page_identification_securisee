<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="./css/index.css">
    <script src="./js/validation.js"></script>
    <title>Formulaire d'identification</title>
  </head>
  <body>
     
    <form class="form-container"   onsubmit="return validateForm()" action="./php/form-handler.php" method="post">
      <div class="form-group">
        <label for="username">Nom d'utilisateur :</label>
        <div>
          <input type="text" id="username" name="username">
          <button type="button" onclick="document.getElementById('username').value=''">&times;</button>
          <br><br>
          <span id="username-error"></span>
        </div>
      </div>


      
      <div class="form-group">
        <label for="password">Mot de passe :</label>
        <div>
          <input type="password" id="password" name="password">

          <button type="button" onclick="document.getElementById('password').value=''">&times;</button>
          <br><br>
          <span id="password-error"></span>
          
        </div>
      </div>

      <input type="submit" name="submit_button" value="SignIn" class="signin-button">

      <p style="text-align: center; margin: 10px 0;">
        <span>ou</span>
      </p>

      <input type="submit" name="submit_button" value="SignUp" class="signup-button">
    </form>

  </body>
</html>
