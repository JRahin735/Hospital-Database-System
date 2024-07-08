

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
</head>
<body>
  
  <h1> Vaccination Center </h1>
  <h2> please login below </h2>

  <main>

    <form action= "includes/loginhandler.php" method = "post"> 

      <label for="login_id" > ID </label>
      <br>
      <input id ="login_id" type ="text" name ="login_id" placeholder ="LOGIN ID">
      <br><br>

      <label for="login_password" > Password </label>
      <br>
      <input id ="login_password" type ="password" name ="login_password" placeholder ="LOGIN PASSWORD">
      <br><br>

      <label for="role" > Role </label>
      <br>
      <select id="role" name ="role">
        <option value="admin"> Admin </option>
        <option value="nurse"> Nurse </option>
        <option value="patient"> Patient </option>
      </select>
      <br><br>

      <button type ="submit"> LOGIN </button>

      <input type="button" onclick="location.href='new_patient.php';" value="new patient?" />


    </form>

  </main>

</body>
</html>