<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> PATIENT PAGE </title>
</head>
<body>

    <h1> Registeration</h1>

    <br>

    <form action= "includes/newpatientformhandler.php" method = "post"> 

        <label for="login_id" > Login ID </label>
        <input id ="login_id" type ="text" name ="login_id" placeholder ="LOGIN ID">

        <label for="login_password" > Login Password </label>
        <input id ="login_password" type ="text" name ="login_password" placeholder ="LOGIN PASSWORD">

        <br> <br>

        <label for="first_name"> First Name </label>
        <input id="first_name" type="text" name="first_name" placeholder="FIRST NAME">

        <label for="middle_initials"> Middle Initials </label>
        <input id="middle_initials" type="text" name="middle_initials" placeholder="MI">


        <label for="last_name"> Last Name </label>
        <input id="last_name" type="text" name="last_name" placeholder="LAST NAME">

        <br><br>

        <label for="ssn"> SSN </label>
        <input id="ssn" type="text" name="ssn" placeholder="SSN">

        <label for="age"> Age </label>
        <input id="age" type="text" name="age" placeholder="AGE">

        <label for="gender" > Gender </label>
        <select id="gender" name ="gender">
            <option value="male"> Male </option>
            <option value="female"> Female </option>
        </select>

        <label for="race"> Race </label>
        <input id="race" type="text" name="race" placeholder="RACE">


        <label for="occupation_class"> Occupation Class </label>
        <input id="occupation_class" type="text" name="occupation_class" placeholder="Occupation class">

        <br><br>

        <label for="phone_number"> Phone Number </label>
        <input id="phone_number" type="text" name="phone_number" placeholder="PHONE NUMBER">

        <label for="address"> Address </label>
        <input id="address" type="text" name="address" placeholder="ADDRESS">
        
        <br><br>
        
        <button type ="submit"> Register </button>

    </form>

    <br><br>

    <input type="button" onclick="location.href='index.php';" value="back to login" />



</body>
</html>