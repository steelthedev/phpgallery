<?PHP
if(isset($_POST['submit'])){


$name=$_POST['name'];
$email=$_POST['email'];
$username=$_POST['uid'];
$pwd=$_POST['pwd'];
$pwdrepeat=$_POST['pwdrepeat'];

require_once'dbh.inc.php';
require_once'function.inc.php';


if (emptyInputSignup($name,$email,$username,$pwd,$pwdrepeat) !== false){

header("Location: ../signup.php?error=emptyinput");
exit();

}


if (invalidUid($username) !== false){

header("Location: ../signup.php?error=invaliduid");
exit();

}


if (invalidEmail($email) !== false){

header("Location: ../signup.php?error=invalidemail");
exit();

}


if (PwdMatch($pwd,$pwdrepeat) !== false){

header("Location: ../signup.php?error=pwderror");
exit();

}


if (uidExists($conn,$username,$email) !== false){

header("Location: ../signup.php?error=uidexists");
exit();

}


createUser($conn,$name,$email,$username,$pwd);



}

else{

header("Location: ../signup.php");
exit();

}


























