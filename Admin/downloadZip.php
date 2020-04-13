<?php 
// Create ZIP file
if(isset($_POST['create'])){
 $zip = new ZipArchive();
 $filename = "./myzipfile.zip";

 if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
  exit("cannot open <$filename>\n");
 }

 $dir = '../Asset/Images/';

 // Create zip
 createZip($zip,$dir);

 $zip->close();
}

// Create zip
function createZip($zip,$dir){
 if (is_dir($dir)){

  if ($dh = opendir($dir)){
   while (($file = readdir($dh)) !== false){
 
    // If file
    if (is_file($dir.$file)) {
     if($file != '' && $file != '.' && $file != '..'){
 
      $zip->addFile($dir.$file);
     }
    }else{
     // If directory
     if(is_dir($dir.$file) ){

      if($file != '' && $file != '.' && $file != '..'){

       // Add empty directory
       $zip->addEmptyDir($dir.$file);

       $folder = $dir.$file.'/';
 
       // Read data of the folder
       createZip($zip,$folder);
      }
     }
 
    }
 
   }
   closedir($dh);
  }
 }

}

// Download Created Zip file
if(isset($_POST['download'])){
 
 $filename = "myzipfile.zip";

 if (file_exists($filename)) {
  header('Content-Type: application/zip');
  header('Content-Disposition: attachment; filename="'.basename($filename).'"');
  header('Content-Length: ' . filesize($filename));

  flush();
  readfile($filename);
  // delete file
  unlink($filename);
 
 }

}
?>


<?php  include_once'template/header.php';?>

   <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
               <a href="#" class="site_title"><i class="fa fa-paw"></i> <span><?php echo $_SESSION['username']; ?></span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
			<?php  include_once'template/admin-profile.php';?>

             <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
      <?php include_once'template/side-bar.php';?>
        <!-- top navigation -->
		<?php include_once'template/navbar.php';?>
<!-- /top navigation -->

        <!-- page content -->
		<div class='container' style="">
			<div class="row">
				<div class="col-md-offset-4 col-md-4 col-md-offset-4">
						<h4 class="text-center text-success"><?php
                        if (isset($_SESSION['msg'])) {
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        }
                        ?></h4>
						<div class="panel panel-info" style="text-align:center;height:300px;">
						 <div class="panel panel-heading" style="text-align:center;"><h3>Download Zip file(<span><i style="font-size:12px;color:red;">Please Zip before You Download</i></span>)</h3></div>
							 <form method='post' action=''>
							  <input type='submit' id="zip" name='create' class="btn btn-success" value='Create Zip' />&nbsp;
							  <input type='submit' id="download" name='download' class="btn btn-danger"  value='Download' />
							 </form>
						</div>
				</div>			 
			</div>
			
		</div>
		 <!-- /page content -->

        <!-- footer content -->
      <?php include_once'template/footer.php';?>
	   <!-- foot-scripts content -->
      <?php include_once'template/foot-scripts.php';?>
	 