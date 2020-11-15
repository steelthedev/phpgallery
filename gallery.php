<?php
$_SESSION['username']="Admin";
include 'header1.php';
?>



 

 
 <div class="container">
 <div class="row">
 


<?php
include_once 'includes/dbh.Inc.php';


$sql="SELECT * FROM gallery ORDER BY idGallery DESC;";

$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt, $sql)){

echo"There is an Error while connecting to database";
}else {

mysqli_stmt_execute($stmt);
$result=mysqli_stmt_get_result($stmt);
while($row=mysqli_fetch_assoc($result)){

  
echo' <div class="col-md-4 ">
  <a href="" >
  <div style="background-image:url(img/gallery/'.$row["imgFname"].');"></div>
  <h3>'.$row["titleGallery"].'</h3>
  <p>'.$row["descGallery"].'</p>
  </a>
</div> ';
  }
  }
  ?>
  </div>
  </div>
  </div>
  
  
  
  <section class="container upload" >
  <div class="row justify-content-center" >
  <div class="col-md-12 text-center">
  <div class="gallery-upload" >
  <?
  if(isset($_SESSION['username'])){
 
 echo" 

  
 
 
  
  <form action='includes/gallery.inc.php' method='POST' enctype='multipart/form-data'>
  
  <div class='form-group' >
  <input type='text' name='filename' class='form-control' placeholder='filename...' >
  </div>
  <div class='form-group' >
  <input type='text' name='filetitle' class='form-control' placeholder='img title...' >
  </div>
  <div class='form-group' >
  <input type='text' name='filedesc' class='form-control' placeholder='IMG desc...' >
  </div>
  <div class='form-group'>
  <input type='file' name='file' class='btn' >
  </div>
  
  <button class='btn btn-outline-white form-btn' name='submit' type='submit' >Upload</button>
  </form>
  
  ";
  }

 
  ?>
  </div>
  </div>
  </div>
  </section>
  
  </div>
  
  
  
  
  
  
  
  
  
  
  
  
  
  </body>
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/typed.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="lib/lightbox/js/lightbox.min.js"></script>
  <!--my main js-->
  <script src="js/contact.js"></script>
  <script src="js/main.js"></script>
  </body>
  