<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> ADMIN PAGE </title>
</head>
<body>

    <h1 style="text-align:center"> Admin Portal </h1>

    <h2> Staff Management</h2>

    <h3> Add a New Nurse </h3>

    <br><br>

    <form action= "includes/newnurseformhandler.php" method = "post"> 

        <label for="first_name" > First Name </label>
        <input id ="first_name" type ="text" name ="first_name" placeholder ="FIRST NAME">

        <label for="middle_initials" > MI </label>
        <input id ="middle_initials" type ="text" name ="middle_initials" placeholder ="MI">

        <label for="last_name" > Last Name </label>
        <input id ="last_name" type ="text" name ="last_name" placeholder ="LAST NAME">

        <label for="EmpID" > Employee ID </label>
        <input id ="EmpID" type ="text" name ="EmpID" placeholder =" EMPLOYEE ID">

        <label for="age" > Age </label>
        <input id ="age" type ="text" name ="age" placeholder ="AGE">

        <label for="gender" > Gender </label>
        <select id="gender" name ="gender">
            <option value="male"> Male </option>
            <option value="female"> Female </option>
        </select>

        <label for="address" > Address </label>
        <input id ="address" type ="text" name ="address" placeholder ="ADDRESS">

        <label for="phone_number" > Phone </label>
        <input id ="phone_number" type ="text" name ="phone_number" placeholder ="PHONE">

        <label for="login_id" > Username </label>
        <input id ="login_id" type ="text" name ="login_id" placeholder ="USERNAME">

        <label for="login_password" > Password </label>
        <input id ="login_password" type ="text" name ="login_password" placeholder ="PASSWORD">
       

        <button type ="submit"> Add </button>

    </form>
    
    <br><br>

    <h3> Remove a Nurse </h3>

    <br><br>

    <form action= "includes/deletenurseformhandler.php" method = "post"> 

        <label for="nurse_id" > Employee id </label>
        <input id ="nurse_id" type ="text" name ="nurse_id" placeholder ="EMPLOYEE ID">

        <button type ="submit"> Delete </button>

    </form>

    <br><br>

    <h3> Update Nurse info </h3>

    <form action= "includes/updatenurseinfo.php" method = "post"> 

        <label for="EmpID" > Employee ID </label>
        <input id ="EmpID" type ="text" name ="EmpID" placeholder =" EMPLOYEE ID">

        <br><br> 

        <label for="first_name" > First Name </label>
        <input id ="first_name" type ="text" name ="first_name" placeholder ="FIRST NAME">

        <label for="middle_initials" > MI </label>
        <input id ="middle_initials" type ="text" name ="middle_initials" placeholder ="MI">

        <label for="last_name" > Last Name </label>
        <input id ="last_name" type ="text" name ="last_name" placeholder ="LAST NAME">

        <label for="age" > Age </label>
        <input id ="age" type ="text" name ="age" placeholder ="AGE">

        <label for="gender" > Gender </label>
        <select id="gender" name ="gender">
            <option value="male"> Male </option>
            <option value="female"> Female </option>
        </select>

        <label for="login_id" > Username </label>
        <input id ="login_id" type ="text" name ="login_id" placeholder ="USERNAME">

        <label for="login_password" > Password </label>
        <input id ="login_password" type ="text" name ="login_password" placeholder ="PASSWORD">
       

        <button type ="submit"> Add </button>

    </form>

    <br><br>

    <h3> Search a patient or nurse </h3><br>

    <br><br>

    <form class = "searchForm" action= "includes/admin_search.php" method = "post"> 

      <label for="username" > Username </label>
      <input id ="username" type ="text" name ="username" placeholder ="USERNAME">

      <label for="role" > Role </label>
        <select id="role" name ="role">
            <option value="Patient"> Patient </option>
            <option value="Nurse"> Nurse </option>
        </select>
      <button type ="submit"> Search </button>

    </form>

    <br><br>


    <h2> Vaccine Inventory </h2>

    <h3> Record a Delivery </h3><br>

    <br><br>

    <form action= "includes/deliveryformhandler.php" method = "post"> 

      <label for="vaccine_id" > Vaccine ID </label>
      <input id ="vaccine_id" type ="text" name ="vaccine_id" placeholder ="VACCINE ID">

      <label for="delivery_amt" > Delivery Amount </label>
      <input id ="delivery_amt" type ="text" name ="delivery_amt" placeholder ="DELIVERY AMOUNT">

      <button type ="submit"> Add </button>

    </form>

    <br><br>

    <h3> Edit available stock </h3><br>

    <br><br>

    <form action= "includes/reducevaccine.php" method = "post"> 

      <label for="vaccine_id" > Vaccine ID </label>
      <input id ="vaccine_id" type ="text" name ="vaccine_id" placeholder ="VACCINE ID">

      <label for="amt" > Amount to be reduced </label>
      <input id ="amt" type ="text" name ="amt" placeholder ="AMOUNT">

      <button type ="submit"> Remove </button>

    </form>

    <br><br>


    <h3> Add new vaccine info </h3>

    <br><br>

    <form action= "includes/newvaccineformhandler.php" method = "post"> 

      <label for="vaccine_name" > Vaccine Name </label>
      <input id ="vaccine_name" type ="text" name ="vaccine_name" placeholder ="VACCINE NAME">

      <label for="vaccine_company" > Company Name </label>
      <input id ="vaccine_company" type ="text" name ="vaccine_company" placeholder ="COMPANY NAME">

      <label for="total_dose_req" > Total Doses Required </label>
      <input id ="total_dose_req" type ="text" name ="total_dose_req" placeholder ="TOTAL DOSES">

      <label for="description" > Description </label>
      <input id ="description" type ="text" name ="description" placeholder ="DESCRIPTION">

      <button type ="submit"> Create </button>

    </form>
    
    <br><br>

    <input type="button" onclick="location.href='index.php';" value="logout" />



</body>
</html>