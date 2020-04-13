 
 <?php
include_once 'dbCon.php';
$conn = connect();
$sql = "select * from categories";
$result = $conn->query($sql);
 
?>
 <div class="card my-4">
            <h5 class="card-header">Categories</h5>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-12">
                  <ul class="list-unstyled mb-0">
                   <?php foreach($result as $row){?>
				   <li style="display:inline";>
                    <b><?=$row['name']?></b>,
                    </li>
                   <?php }?>
                  </ul>
                </div>
             </div>
            </div>
          </div>

         