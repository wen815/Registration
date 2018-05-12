<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>Registration Page</h1>
        <form action="index.php" method="post">
        <p>First Name: <input type="text" name="first_name" size="15" maxlength="20" value="<?php if(isset($_POST['first_name'])) echo $_POST['first_name'];?>" /></p>
	<p>Last Name: <input type="text" name="last_name" size="15" maxlength="40" value="<?php if(isset($_POST['last_name'])) echo $_POST['last_name'];?>" /></p>
	<p>Email Address: <input type="text" name="email" size="20" maxlength="60" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>"  /> </p>
	<p>Password: <input type="password" name="pass1" size="10" maxlength="20" value=""  /></p>
	<p>Confirm Password: <input type="password" name="pass2" size="10" maxlength="20" value=""  /></p>
	<p><input type="submit" name="submit" value="Register" /></p>
</form>
        <?php
        //Validate the post of the form
if($_SERVER['REQUEST_METHOD']=='POST'){
    //Validate First Name
   if (empty($_POST['first_name'])) {
 $errors[] = 'You forgot to enter your first name.';
} else {
 $fn = trim($_POST['first_name']);
 }

    //Validate Last Name
   if (empty($_POST['last_name'])) {
 $errors[] = 'You forgot to enter your last name.';
} else {
 $ln = trim($_POST['last_name']);
 }

    //Validate email address
   if (empty($_POST['email'])) {
 $errors[] = 'You forgot to enter your email address.';
} else {
 $email = trim($_POST['email']);
 }

 //Check for a password and match against the confirmed password:
 if (!empty($_POST['pass1'])) {
if ($_POST['pass1'] != $_POST['pass2']) {
 $errors[] = 'Your password did not match the confirmed password.';
 } else {
 $p = trim($_POST['pass1']);
 }
 } else {
 $errors[] = 'You forgot to enter your password.';
 }
if(empty($errors)){
//link the database
    $mysqli=new mysqli();
    $mysqli->connect('localhost','root','root','sitename');
    $mysqli->set_charset("utf8");
    $sql="insert into user(first_name, last_name, email, pass, registration_date)values('$fn', '$ln',
'$email', SHA1('$p'), NOW() )";
    $rs=$mysqli->query($sql);
$mysqli->close();
}
else{
    foreach($errors as $key=>$value){
        echo $value;
    }
}
}
        ?>
    </body>
</html>
