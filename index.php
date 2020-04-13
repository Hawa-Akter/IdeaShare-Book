
<?php
 
session_start();
if (!isset($_SESSION['user_role'])){
	header('location:login.php');
}
include_once 'dbCon.php';
$conn = connect();

if($_SESSION['user_role']==3){
	$sqldepartment="select department_name from users, department where users.department_id=department.id AND users.role=3 AND users.id=".$_SESSION['id'];
	$resultdep = $conn->query($sqldepartment);
	$resultdep=mysqli_fetch_assoc($resultdep);
	$_SESSION['departmentName']=$resultdep['department_name'];
	
}


$sql = "select * from categories where publication=1 ";
$result = $conn->query($sql);

$limit=5;
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;
//ideas query
$sqli = "select ideas.*,categories.name as category_name, users.name from ideas,users,categories where ideas.students_id=users.id and ideas.categories_id=categories.id AND publication_status=1 AND closure_date>= CURDATE() ORDER BY ideas.id DESC LIMIT $start_from, $limit";
$ideas = $conn->query($sqli);

//Departmetnal user
$userId=$_SESSION['id'];
$department="select department_id from users where id=$userId";
$department = $conn->query($department);
$department=mysqli_fetch_assoc($department);
$_SESSION['department']=$department['department_id'];
//like dislike saving code start's here

	//Recent ideas
	$sqli="SELECT ideas.*, users.name FROM ideas,users WHERE ideas.students_id=users.id AND ideas.`publication_status`=1 AND ideas.closure_date>= CURDATE() ORDER BY ideas.id DESC LIMIT 5";
	$recentIdeas=$conn->query($sqli);
	
	
	//Recent comments
	$s = "select comments.*,ideas.idea_name,users.name from comments,users,ideas where comments.idea_id=ideas.id AND ideas.students_id=users.id ORDER BY comments.id DESC LIMIT 5";
	$recentComments= $conn->query($s);
	
	//Most popular ideas
	$sql="SELECT ideas.*,users.name FROM ideas,users where ideas.students_id=users.id ORDER BY likes DESC LIMIT 5";
	$mostPopularIdeas= $conn->query($sql);
	
	//most viewed ideas
	$sqlView="select ideas.*,users.name FROM ideas,users where ideas.students_id=users.id ORDER BY ideas.views DESC LIMIT 3";
	$mostViewdIdeas= $conn->query($sqlView);
	
?>


<?php include_once'Mastering/header.php'; ?>
    <!-- Navigation -->
<?php include 'Mastering/nav-bar.php'; ?>

<?php 

//if($_SESSION['user_role'] == 3 && $_SESSION['department']==1 ){
	//	 header('location:Admin/BITView.php');
//}
?>
    <!-- Page Content -->
    <div class="container" style="padding-bottom:100px;">

      <div class="row">

        <!-- Post Content Column -->
		
        <div class="col-md-7" style=" padding-top:0px; margin-top:0px;">
			<?php foreach($ideas as $idea){ ?>
				<div class="col-md-12" style="background-color:#F2F3F5;margin-bottom:8px;">
				<!-- IDEAS loop start from here -->
					<div style="background-color:white; border-radius:4px;padding:10px;margin-bottom:10px;margin-top:10px;">
					  <!--Idea Title -->
					  <h1 class="mt-4"><?=$idea['idea_name']?></h1>
					   <!-- Preview Image-->
								<?php 
								if($idea['file_name']!=null){ 
									$imageUrl=pathinfo($idea['file_name']);
								if($imageUrl['extension'] == 'jpg' || $imageUrl['extension'] == 'png'|| $imageUrl['extension']== 'JPG' || $imageUrl['extension'] == 'PNG') {?>
									<img class="img-fluid rounded" src="<?=$idea['file_name']?>" alt="No image/file given">
								<?php } ?>
								<?php }else{ ?>
								
								<img class="img-fluid rounded" src="http://maestroselectronics.com/wp-content/uploads/2017/12/No_Image_Available.jpg" width="100%" alt="No image/file given">
								<?php } ?>
						<!-- Preview Image End-->
						<?php $postid=$idea['id']; ?>
						 <?php
							// Checking user status
							$status_query = "SELECT count(*) as cntStatus,type FROM like_unlike WHERE userid=".$userId." and postid=".$postid;
							$status_result = mysqli_query($conn,$status_query);
							$status_row = mysqli_fetch_array($status_result);
							$count_status = $status_row['cntStatus'];
							if($count_status > 0){
							  $type = $status_row['type'];
							}

							// Count post total likes and unlikes
							$like_query = "SELECT COUNT(*) AS cntLikes FROM like_unlike WHERE type=1 and postid=".$postid;
							$like_result = mysqli_query($conn,$like_query);
							$like_row = mysqli_fetch_array($like_result);
							$total_likes = $like_row['cntLikes'];

							$unlike_query = "SELECT COUNT(*) AS cntUnlikes FROM like_unlike WHERE type=0 and postid=".$postid;
							$unlike_result = mysqli_query($conn,$unlike_query);
							$unlike_row = mysqli_fetch_array($unlike_result);
							$total_unlikes = $unlike_row['cntUnlikes'];

						?>
							<!--view ideas Details-->
								<button id="<?php echo $postid; ?>" style="padding:0px;margin:0px;height:30px;width:100%;" type="button" class="view" data-toggle="collapse" data-target="#collapseExamplethree_<?=$idea['id'] ?>" aria-expanded="false" aria-controls="collapseExample">
									<p style="padding:0px;margin:0px;text-align:center;">View Details</p>
								</button>
								<div class="collapse" id="collapseExamplethree_<?=$idea['id'] ?>">
								  <div class="post">

									 <div class="post-action row">
										<div class="col-md-6" style="margin-right:0px;padding-right:0px;">
									  <button style="width:100%; height:35px;"  id="like_<?php echo $postid; ?>" class="like  glyphicon glyphicon-thumbs-up btn btn-default" style="<?php if($type == 1){ echo "color: #ffa449;"; } ?>"> LIKE(<span id="likes_<?php echo $postid; ?>"><?php echo $total_likes; ?></span>)</button>&nbsp;&nbsp;
										</div>
										<div class="col-md-6" style="margin-left:0px;padding-left:0px;">
									  <button style="width:100%; height:35px; margin-left:0px;" id="unlike_<?php echo $postid; ?>" class="unlike glyphicon glyphicon-thumbs-down btn btn-default" style="<?php if($type == 0){ echo "color: #ffa449;"; } ?>"> DISLIKE(<span id="unlikes_<?php echo $postid; ?>"><?php echo $total_unlikes; ?></span>)</button>&nbsp;
										</div>
									 </div>
								  </div>
										<div style="background-color:white;">
										<label id="view"></label>
											<!--Idea owner name-->
											<div style="float:left">
											<span style="font-family:URW Chancery L, cursive;color:Green;">Posted By: </span><strong>(<?php if($idea['anonymous_post']==1){echo "Anonymous";}else{echo $idea['name'];}?>)</strong>
											</div>
											<!--Idea owner name end-->
											<!--Idea Category name-->
											<div style="float:right;">
											<span style="font-family:URW Chancery L, cursive;color:Green;">Category Name: </span><span style="color:#6E523D;"><b><?=$idea['category_name']?></b></span></h5>
											</div>
											<!--Idea Category name end-->
											<!--Idea details-->
											<div style="clear:both;margin-top:10px;">
											<p><span style="font-family:URW Chancery L, cursive;color:Green;">Details Of Idea: </span>
												<?=$idea['idea_details']?></p>
											</div>	
											<!--Idea details end-->
										</div>
										<hr>
									   <?php 
									  //comments query
									  //Comments of students
											$id=$idea['id'];
											$sqlc = "select comments.*,users.name,users.image_name from comments,users,ideas where comments.idea_id=$id AND comments.staffOnstudent_comment=0 AND comments.idea_id=ideas.id AND comments.users_id=users.id";
											$comments = $conn->query($sqlc);
											
											//Comments of staffs
											$s = "select comments.*,users.name,users.image_name from comments,users,ideas where comments.idea_id=$id AND comments.idea_id=ideas.id AND comments.users_id=users.id";
											$commentsOfStaff = $conn->query($s);
											
									  
									  ?>
								
									   <!--Comment Section Start-->
									<div style="background-color:#F2F3F5;margin:0px;padding:50px; border-radius:10px;">
									   <!-- Single Comment -->
									  <?php if($_SESSION['user_role']==1){?>
										
									  <?php foreach($comments as $comment){?>
									  <div class="media mb-4">
									   
										<?php if($comment['anonymous_comment']==1){ ?>
										<img class="d-flex mr-3 rounded-circle" src="<?php echo $comment['image_name'] ?>" alt=""  height="50px" width="50px">
										<?php }else{  ?>
										 <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" height="50px" width="50px" alt="">
										<?php } ?>
										<div class="media-body">
										  <h4 class="mt-0" style="color:blue"><?php if($comment['anonymous_comment']==0){ echo "Anonymous";}else{ echo $comment['name'];}?><span><div style="margin-left:30px;border-radius:20px; padding:7px;color:black; font-size:16px;box-shadow: 0 0 2px white, 1px 1px 1px White; background-color:white;text-align:justify;line-height: 1.6;"><?=$comment['reply']?></div></span></h4>
										  
										</div>
									  </div>
									  <?php } ?>
									  <?php }else{?>
									   <?php foreach($commentsOfStaff as $commentOfStaff){?>
									  <div class="media mb-4">
										<?php if($commentOfStaff['anonymous_comment']==1){ ?>
										<img class="d-flex mr-3 rounded-circle" src="<?php echo $commentOfStaff['image_name'] ?>" alt=""  height="50px" width="50px">
										<?php }else{  ?>
										 <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" height="50px" width="50px" alt="">
										<?php } ?>
										<div class="media-body" style="padding-top:15px;">
										  <h4 class="mt-0" style="color:blue"><?php if($commentOfStaff['anonymous_comment']==0){ echo "Anonymous";}else{ echo $commentOfStaff['name'];}?><span><div style="margin-left:30px;border-radius:20px; padding:7px;color:black; font-size:16px;box-shadow: 0 0 2px white, 1px 1px 1px White; background-color:white;text-align:justify;line-height: 1.6;"><?=$commentOfStaff['reply']?></div></span></h4>
										
										</div>
									  </div>
									  <?php } ?>
									  <?php } ?>
										<!-- end Single Comment -->
										<!-- Comments Form start-->
									  <form action="SaveComments.php" method="post">
										<div class="form-group">
										  <textarea class="form-control" name="reply" rows="3" placeholder="reply...."></textarea>
										  <input type="hidden" name="ideaId" value="<?=$idea['id']?>">
										  <input type="hidden" name="userId" value="<?=$_SESSION['id']?>">
										  <input type="hidden" name="user_name" value="<?=$_SESSION['username']?>">
										</div>
										<div class="form-group">
												<label><input type="checkbox" name="anonymousComment" value="0"/> Anonimous Comment</label>
										</div>
										<button type="submit" class="btn btn-primary">Submit</button>
									  </form>
										<!-- Comments Form End-->	
									</div>	
										<!--Comment Section End-->
								</div>
					</div>				
				</div>	
							
					
						
         
				
         
		 <?php }?>
        </div>
		 
		<div class="col-md-4">
			<?php if($_SESSION['user_role']==0 || $_SESSION['user_role']==2 || $_SESSION['user_role']==3){?>
				<div class="row">
		
				  <div class="btn btn-success col-md-12" type="button" style="margin-top:10px;height:70px;" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
					<h4 style="line-height:40px">Most Recent Ideas</h4>
				  </div>
					<div class="collapse col-md-12" id="collapseExample" style=" margin:0px; padding:0px">
					  <div class="card card-body col-md-12" style="height: 300px;overflow: auto;">
					  <?php $i=0 ?>
					  <?php foreach($recentIdeas as $recentIdea){?>
					  <?php $i++ ?>

					   <p style="font-size:15px;"><?php echo $i?>.<span style="font-family:Apple Chancery, cursive;color:lightseagreen; ">Idea Name: </span><?=$recentIdea['idea_name']?></p>
						 
						<p ><span style="font-family:Apple Chancery, cursive;color:#C24D5D;">Posted By: </span>(<?php if($recentIdea['anonymous_post']==1){echo "Anonimous";}else{echo $recentIdea['name']; }?>)</p>
							
					  
					  <?php }?>
					  </div>
					</div>
					<!--Most recent comments-->
					<div class="btn btn-info col-md-12" style="margin-top:6px;height:70px; line-height:50px;" type="button" data-toggle="collapse" data-target="#collapseExampletwo" aria-expanded="false" aria-controls="collapseExample">
						<h4 style="line-height:35px">Most Recent Comments</h4>
					</div>
					<div class="collapse col-md-12" id="collapseExampletwo" style=" margin:0px; padding:0px">
					  <div class="card card-body col-md-12" style="height: 300px;overflow: auto;">
							<!-- Loop for recentComment-->
							<?php $i=0 ?>
						  <?php foreach($recentComments as $recentComment){?>
						  
						  <?php $i++ ?>
						  
						  <p style="font-size:15px;"><?php echo $i?>.<span style="font-family:Apple Chancery, cursive;color:lightseagreen; ">Popular Comment: </span><?=$recentComment['reply']?></p>
						 
						 <p ><span style="font-family:Apple Chancery, cursive;color:#C24D5D;">Posted By: </span>(<?php if($recentComment['anonymous_comment']==0){echo "Anonimous";}else{echo $recentComment['name']; }?>)</p>
							<p><span style="font-family:Apple Chancery, cursive;color:#1A639A;">Idea Name : <?=$recentComment['idea_name']?></span></p>
							
						  
						  <?php }?>
					  
					  </div>
					</div>
					<!--Most recent comments end -->

					<!--Most popular ideas-->
					<div class="btn btn-primary col-md-12" style="margin-top:6px;height:70px; line-height:50px;" type="button" data-toggle="collapse" data-target="#collapseExamplethree" aria-expanded="false" aria-controls="collapseExample">
						<h4 style="line-height:35px">Most Popular Ideas</h4>
					</div>
					<div class="collapse col-md-12" id="collapseExamplethree" style=" margin:0px; padding:0px">
					  <div class="card card-body col-md-12" style="height: 300px;overflow: auto;">
							<!-- Loop for mostPopularIdea-->
							<?php $i=0 ?>
						  <?php foreach($mostPopularIdeas as $mostPopularIdea){?>
						  
						  <?php $i++ ?>
						  <p style="font-size:15px;"><?php echo $i?>.<span style="font-family:Apple Chancery, cursive;color:lightseagreen; ">Idea Name: </span><?=$mostPopularIdea['idea_name']?></p>
						 
						 <p ><span style="font-family:Apple Chancery, cursive;color:#C24D5D;">Posted By: </span>(<?php if($mostPopularIdea['anonymous_post']==1){echo "Anonimous";}else{echo $mostPopularIdea['name']; }?>)</p>
							<p><span style="font-family:Apple Chancery, cursive;color:#1A639A;">Likes : <?=$mostPopularIdea['likes']?></span></p>
							
						 
							
						  
						  <?php }?>
					  
					  </div>
					</div>
					<!--Most popular ideas end-->
					<!--Most view ideas start-->
					<div class="btn btn-warning col-md-12" style="margin-top:6px;height:70px; line-height:50px;" type="button" data-toggle="collapse" data-target="#collapseExamplefour" aria-expanded="false" aria-controls="collapseExample">
						<h4 style="line-height:35px">Most Viewed Ideas</h4>
					</div>
					<div class="collapse col-md-12" id="collapseExamplefour" style=" margin:0px; padding:0px">
					  <div class="card card-body col-md-12" style="height: 300px;overflow: auto;">
							<!-- Loop for mostviewed-->
							<?php $i=0 ?>
						  <?php foreach($mostViewdIdeas as $mostViewdIdea){?>
						  
						  <?php $i++ ?>
						  <p style="font-size:15px;"><?php echo $i?>.<span style="font-family:Apple Chancery, cursive;color:lightseagreen; ">Idea Name: </span><?=$mostViewdIdea['idea_name']?></p>
						 
						<p ><span style="font-family:Apple Chancery, cursive;color:#C24D5D;">Posted By: </span>(<?php if($mostViewdIdea['anonymous_post']==1){echo "Anonimous";}else{echo $mostViewdIdea['name']; }?>)</p>
							<p><span style="font-family:Apple Chancery, cursive;color:#1A639A;">Views : <?=$mostViewdIdea['views']?></span></p>
							
						  
						  <?php }?>
					  <!--End Loop for mostviewed-->
					  </div>
					</div>
					
				
					<!--Most view ideas ends-->
					
				</div>
		<?php } ?>
		</div>

			

      <!-- /.row -->

    </div>
<?php  
$sql = "SELECT COUNT(id) FROM ideas";  
$rs_result = $conn->query($sql);  
$row = mysqli_fetch_row($rs_result);  
$total_records = $row[0];  
$total_pages = ceil($total_records / $limit);  
$pagLink = "<div class='pagination' style=\"padding-left:20%;\">";  
for ($i=1; $i<=$total_pages; $i++) {  
             $pagLink .= "<li><a href='index.php?page=".$i."'>".$i."</a></li>";  
};  
echo $pagLink . "</div>";  
?>
    </div>
    <!-- /.container -->

  <!-- Footer -->

  <?php include_once'Mastering/footer.php';?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
	
$(document).ready(function(){

    // like and unlike click
    $(".like, .unlike").click(function(){
        var id = this.id;   // Getting Button id
        var split_id = id.split("_");

        var text = split_id[0];
        var postid = split_id[1];  // postid

        // Finding click type
        var type = 0;
        if(text == "like"){
            type = 1;
        }else{
            type = 0;
        }

        // AJAX Request
        $.ajax({
            url: 'likeunlike.php',
            type: 'post',
            data: {postid:postid,type:type},
            dataType: 'json',
            success: function(data){
                var likes = data['likes'];
                var unlikes = data['unlikes'];

                $("#likes_"+postid).text(likes);        // setting likes
                $("#unlikes_"+postid).text(unlikes);    // setting unlikes

                if(type == 1){
                    $("#like_"+postid).css("color","red");
                    $("#unlike_"+postid).css("color","lightseagreen");
                }

                if(type == 0){
                    $("#unlike_"+postid).css("color","red");
                    $("#like_"+postid).css("color","lightseagreen");
                }


            }
            
        });

    });

});
</script>
<script type="text/javascript">
$(document).ready(function(){

    // like and unlike click
    $(".view").click(function(){
        var id = this.id;   // Getting Button id
       

        // AJAX Request
        $.ajax({
            url: 'viewCount.php',
            type: 'post',
            data: {ideaid:id,view:1},
            dataType: 'json',
            success: function(data){
				$.get("viewCount.php",function (msg) {
                $('#view').html(msg);
            })


            }
            
        });

    });

});
</script>

  <?php include_once'Mastering/foot-scripts.php';?>


