<?PHP
if(isset($_POST['submit'])){



$username=$_POST['uid'];
$pwd=$_POST['pwd'];

require_once'dbh.inc.php';
require_once'function.inc.php';


if (loginInputEmpty($username,$pwd) !== false){

header("Location: ../login.php?error=emptylogininput");
exit();

}

loginUser($conn,$username,$pwd);

}

else{

header("Location: ..login.php");
}
