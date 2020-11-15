<?PHP
include_once 'dbh.Inc.php';


if (isset($_POST['submit'])){

$newFileName=$_POST['filename'];

if(empty($_POST['filename'])){


$newFileName="gallery";

}else{

$newFileName=strtolower(str_replace(" ", "-", $newFileName));
}


$imgTitle=$_POST['filetitle'];
$imgDesc=$_POST['filedesc'];

$file=$_FILES['file'];

$fileName=$_FILES['file']['name'];
$fileTmpName=$_FILES['file']['tmp_name'];
$fileSize=$_FILES['file']['size'];
$fileError=$_FILES['file']['error'];
$fileType=$_FILES['file']['type'];

$fileExt=explode(".", $fileName);
$fileActualExt=strtolower(end($fileExt));
$allowed=array('jpg', 'png', 'jpeg', 'webp');

if (in_array($fileActualExt,$allowed)){

if($fileError === 0){
if($fileSize < 20000000){

$imgFname=$newFileName. '.' .uniqid(".", true). "." .$fileActualExt;

$fileDestination ="../img/gallery/".$imgFname;

if (empty($imgTitle) || empty($imgDesc)){

header("Location: ../gallery.php?upload=empty");
exit();

}else{

$sql="SELECT * FROM gallery ";


$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql)){

ECHO"ERROR CONNECTING TO DATABASE";
}else{

mysqli_stmt_execute($stmt);

$result= mysqli_stmt_get_result($stmt);
$rowCount=mysqli_num_rows($result);

$setImgOrder=$rowCount +1;


$sql="INSERT INTO gallery (titleGallery, descGallery, imgFname, ordergallery) VALUES(?, ?, ?, ? );";

if(!mysqli_stmt_prepare($stmt, $sql )){

ECHO"ERROR CONNECTING TO DATABASE ";
}else {

mysqli_stmt_bind_param($stmt, "ssss", $imgTitle, $imgDesc, $imgFname, $setImgOrder);

mysqli_stmt_execute($stmt);


move_uploaded_file($fileTmpName, $fileDestination );

header("Location:../gallery.php?upload=success");

}


}

}


}else {


echo"Your image is to Big";

}


}else{

echo"There is an Error somewhere";

}


}else{

echo"This type of file is not allowed";

}



}else{

header("Location:../gallery.php");
}