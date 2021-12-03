<?php

error_reporting(E_ERROR);

session_start();

include_once("config.php");

global $db;
$check=true;


$video_id=0;



if(isset($_REQUEST['video_id'])) {

		$video_id=intval($_REQUEST['video_id']);

}



$title="";
$image="";
$price="";
$course_id="0";
$author_id="";
$video_file="";
$short_description="";
$long_description="";
$post_image="";
$featured="0";

$video_info=$db->selectFrom("select * from videos where video_id=$video_id");

						

$title=$video_info['title'];
$image=$video_info['image'];
$price=$video_info['price'];
$course_id=$video_info['course_id'];
$author_id=$video_info['author_id'];
$video_file=$video_info['video_file'];
$short_description=$video_info['short_description'];
$long_description=$video_info['long_description'];
$featured=$video_info['featured'];


if(isset($_POST['UpdateVideo'])){

		$title = trim(addslashes($_POST['title']));
		$price = trim(addslashes($_POST['price']));
        $course_id = trim(addslashes($_POST['course_id']));
		$author_id = trim(addslashes($_POST['author_id']));
		$video_file = trim(addslashes($_POST['video_file']));
		$short_description = trim(addslashes($_POST['short_description']));
		$long_description = trim(addslashes($_POST['long_description']));
		$featured = trim(addslashes($_POST['featured']));
		
		if($_FILES['image']['tmp_name']!="") {
			$source_path = $_FILES['image']['tmp_name'];
			$image_name=time().$_FILES['image']['name'];
			$target_path = '../assets/video_images/' . $image_name;
			if(move_uploaded_file($source_path, $target_path))	{
				$post_image=$image_name;

			}
			
	}
		
					$params="title='$title',price='$price',course_id='$course_id',author_id='$author_id',
								video_file='$video_file',short_description='$short_description',long_description='$long_description',featured='$featured'";
					
					if($post_image!="") {
						$params=$params.",image='$post_image' ";
					}
					
					$params=$params." where video_id='$video_id'";

					$db->Update_Record("videos",$params);
    
					$_SESSION['msg']="Video has been updated Successfully";
					$_SESSION['msg_type']="alert alert-success alert-dismissable";

					$Function->Redirect("videos.php");

    }
	
$courses=$db->selectMultiRecords("select * from courses order by sort_order");
$authors=$db->selectMultiRecords("select * from authors order by name");
?>
<?php include("pages/header.php"); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <i class="fa fa-users"></i> Videos Management <small>Add / Edit Video</small> </h1>
  </section>
  <section class="content">
    <div class="row">
      <!-- left column -->
      <?php if($_SESSION['msg']!="") { ?>
      <div class="<?php echo $_SESSION['msg_type']; ?>"> <?php echo $_SESSION['msg']; ?> </div>
      <?php } ?>
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
        
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" id="uploadImage" action="" method="post" enctype="multipart/form-data">
            <div class="box-body">
            <div class="row">
              
              <div class="col-md-6">
                <div class="form-group">
                 	 <label for="fname">Title</label>
                  <input type="text" class="form-control required" value="<?php echo $title; ?>" id="title" name="title" required>
                </div>
              </div>
			  
			  <div class="col-md-6"> 
                <div class="form-group">
                  <label for="fname">Video Image</label>
                  <input type="file" class="form-control required" id="image" name="image">
                </div>
              </div>
            </div>
			<div class="row">
              <div class="col-md-3"> 
                <div class="form-group">
                  <label for="fname">Price</label>
                  <input type="text" class="form-control required" value="<?php echo $price; ?>" id="price" name="price" required>
                </div>
              </div>
			  <div class="col-md-3"> 
			  	<div class="form-check" style="padding-top:30px;">
				  <input class="form-check-input" type="checkbox" name="featured" <?php if($featured=="1") { ?> checked="checked" <?php } ?> value="1" id="featured">
				  <label class="form-check-label" for="featured">
					Featured
				  </label>
				</div>
                
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="fname">Course</label>
				  <select name="course_id" class="form-control">
				  		<option value="0">Select Course</option>
						<?php foreach($courses as $course) { ?>
							<option <?php if($course_id==$course['course_id']) { ?> selected="selected" <?php } ?> value="<?php echo $course['course_id']; ?>"><?php echo $course['course_name']; ?></option>			
						<?php } ?>
					</select>

                </div>
              </div>
            </div>
            
			<div class="row">
              
              <div class="col-md-6">
                <div class="form-group">
                  <label for="fname">Video File</label>
				 <input type="text" class="form-control required" value="<?php echo $video_file; ?>" id="video_file" name="video_file" required>
				<!---
				 <br />
				 <div class="progress">
							<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
				<div id="targetLayer" style="display:none;"></div>
				--->
				
			      </div>
              </div>
			  
			  <div class="col-md-6">
                <div class="form-group">
                  <label for="fname">Author</label>
				  <select name="author_id" class="form-control">
				  		<option value="">Select Author</option>
						<?php foreach($authors as $author) { ?>
							<option  <?php if($author_id==$author['author_id']) { ?> selected="selected" <?php } ?> value="<?php echo $author['author_id']; ?>"><?php echo $author['name']; ?></option>			
						<?php } ?>
					</select>

                </div>
              </div>
            </div>
          	
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="fname">Short Description</label>
                  <textarea class="form-control" id="short_description" name="short_description" rows="4"><?php echo $short_description; ?></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="fname">Long Description</label>
                  <textarea class="form-control" id="long_description" name="long_description" rows="8"><?php echo $long_description; ?></textarea>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <input type="submit" class="btn btn-primary" id="uploadSubmit" name="UpdateVideo" value="Submit" />
              <input type="reset" class="btn btn-default" value="Reset" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
<?php include("pages/footer.php"); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<script>

	

	$(function() {

  //$('#datetimepicker1').datetimepicker();
  //$('#datetimepicker2').datetimepicker();

});

	</script>



<script type="text/javascript" src="tinymce/tinymce.min.js"></script>



<script>
 tinymce.init({
   selector: 'textarea#short_description',  //Change this value according to your HTML
   auto_focus: 'short_description',
   width: "100%",
   height: "300",
      convert_newlines_to_brs : true
 }); 


tinymce.init({
   selector: 'textarea#long_description',  //Change this value according to your HTML
   auto_focus: 'long_description',
   width: "100%",
   height: "400",
force_br_newlines : true,
force_p_newlines : true,
forced_root_block : '',
remove_linebreaks : false,
convert_newlines_to_br: true

 }); 
 
 
 </script>


