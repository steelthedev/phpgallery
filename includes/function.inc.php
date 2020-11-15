<?PHP

function emptyInputSignup($name,$email,$username,$pwd,$pwdrepeat){
$result;

if(empty($name)||empty($email)||empty($username)||empty($pwd)||empty($pwdrepeat)){

$result=true;
}

else{
$result=false;

}
return $result;

}

function InvalidUid($username){
$result;

if(!preg_match("/^[a-zA-Z0-9]*$/",$username)){

$result=true;
}

else{
$result=false;

}
return $result;

}

function invalidEmail($email){
$result;

if(!filter_var($email,FILTER_VALIDATE_EMAIL)){

$result=true;
}

else{
$result=false;

}
return $result;

}

function PwdMatch($pwd,$pwdrepeat){
$result;

if($pwd!==$pwdrepeat){

$result=true;
}

else{
$result=false;

}
return $result;

}


function uidExists($conn,$username,$email){
$result;

$sql="SELECT * FROM users WHERE userUid=? OR userEmail=?;";

$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql)){

header("Location: ../signup.php?error=stmtfailed");
exit();

}

mysqli_stmt_bind_param($stmt,"ss",$username,$email);
mysqli_stmt_execute($stmt);

$resultdata=mysqli_stmt_get_result($stmt);

if($row=mysqli_fetch_assoc($resultdata)){

return $row;

}

else{
$result=false;

return $result;
}


mysqli_stmt_close($stmt);
}


function createUser($conn,$name,$email,$username,$pwd){

$sql="INSERT INTO users (userName,userEmail,userUid,userPwd) VALUES(?,?,?,?);";

$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql)){

header("Location: ../signup.php?error=SQL failed");
exit();

}

$hashedpwd=password_hash($pwd,PASSWORD_DEFAULT);

mysqli_stmt_bind_param($stmt,"ssss",$name,$email,$username,$hashedpwd);

mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);




header("Location: ../signup.php?error=none");

}



function loginInputEmpty($username,$pwd){
$result;
if(empty($username)||empty($pwd)){

$result=true;
}

else{

$result=false;
}
return $result;
}


function loginUser($conn,$username,$pwd){

$userExists=uidExists($conn,$username,$username);


if($userExists === false){
header("Location: ../login.php?error=uidunknown");
exit();

}
$pwdhashed=$userExists["userPwd"];
$checkpwd=password_verify($pwd,$pwdhashed);

if($checkpwd===false){

header("Location: ../login.php?error=wrongpassword");
exit();
}

else if($checkpwd === true){
session_start();
$_SESSION["userid"]= $userExists['usersid'];
$_SESSION["useruid"]= $userExists['userUid'];

header("Location: ../profile.php");
exit();

}

}


function sqlImg($conn,$username,$email){
$result;
$id=userExists($conn,$username, $username);

$sqlImg="SELECT * FROM profileimg WHERE userid=?;";

$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sqlImg)){

header("Location: ../profile.php?error=stmtfailed");
exit();

}

mysqli_stmt_bind_param($stmt,"s",$id);
mysqli_stmt_execute($stmt);

$resultdata=mysqli_stmt_get_result($stmt);

if($row=mysqli_fetch_assoc($resultdata)){

return $row;

}

else{

$return= false;
return $result;
}
mysqli_stmt_close($stmt);
}