<?php
session_start();
require_once'dbh.inc.php';
require_once'function.inc.php';
?>


<?php
if(isset($_POST['submit'])){

$file=$_FILES['file'];

$filesName=$_FILES['file']['name'];
$filesTmpName=$_FILES['file']['tmp_name'];
$filesSize=$_FILES['file']['size'];
$filesError=$_FILES['file']['error'];
$filesType=$_FILES['file']['type'];


$fileExt=explode('.',$filesName);
$fileActualExt=strtolower(end($fileExt));

$allowed = array('jpg','png','jpeg');

if(in_array($fileActualExt, $allowed)){

if($filesError === 0){

if($filesSize < 1000000){
$id=$_SESSION['useruid'];

$fileNameNew="profile ".$id. "." . $fileActualExt;

$fileDestination='../uploads/'. $fileNameNew;

move_uploaded_file($filesTmpName, $fileDestination);
$sql="UPDATE profileimg SET status=0 where userid='$id';";
$result=mysqli_query($conn,$sql);

header("Location: ../profile.php?success");


}

else{
echo"Your file is too big ";

}
}
else{

echo "there is an error while uploading ";

}

}

else{
echo "This file type is not allowed" ;


}


}