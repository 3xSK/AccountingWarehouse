<?php

error_reporting(E_ERROR);

session_start();

include_once("config.php");

global $db;
$check=true;

$title="";
$description="";
$form_title="";
$form_text="";



if(isset($_POST['addLanding'])){


        $title = trim(addslashes($_POST['title']));
		$description = trim(addslashes($_POST['description']));
		$form_title = trim(addslashes($_POST['form_title']));
		$form_text = trim($_POST['form_text']);
       
	   	$fields="title,description,form_title,form_text";
       	$vals="'$title','$description','$form_title','$form_text'"; 
		$db->Add_Record("landing",$fields,$vals);

        	

					$_SESSION['msg']="Landing Page has been added Successfully";

					$_SESSION['msg_type']="alert alert-success alert-dismissable";

					$Function->Redirect("landing.php");

			

    }
	

?>
<?php include("pages/header.php"); ?>
<script type="text/javascript" src="assets/sckeditor/ckeditor/ckeditor.js"></script>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <i class="fa fa-users"></i> Landing Page Management <small>Add / Edit Course</small> </h1>
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
          <div class="box-header">
            <h3 class="box-title">Add New Landing Page</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" id="addNewAuthor" action="" method="post">
            <div class="box-body">
            <div class="row">
              <div class="col-md-12"> 
                <div class="form-group">
                  <label for="fname">Title</label>
                  <input type="text" class="form-control required" value="<?php echo $title; ?>" id="title" name="title" required>
                </div>
              </div>
		
            </div>
          
            <div class="row">

                                <div class="col-md-12">

                                    <div class="form-group">

                                        <label for="fname">Description</label>

                                       <textarea class="form-control" id="description" name="description" rows="4"><?php echo $description; ?></textarea>

                                    </div>

                                </div>

						</div>
						
			<div class="row">
              <div class="col-md-12"> 
                <div class="form-group">
                  <label for="fname">Form Title</label>
                  <input type="text" class="form-control required" value="<?php echo $form_title; ?>" id="form_title" name="form_title" required>
                </div>
              </div>
		
            </div>
			
			<div class="row">
              <div class="col-md-12"> 
                <div class="form-group">
                  <label for="fname">Form Text</label>
                  <input type="text" class="form-control required" value="<?php echo $form_text; ?>" id="form_text" name="form_text" required>
                </div>
              </div>
		
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <input type="submit" class="btn btn-primary" name="addLanding" value="Submit" />
              <input type="reset" class="btn btn-default" value="Reset" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
<?php include("pages/footer.php"); ?>
<script>

CKEDITOR.replace('description',{contentsCss : 'http://brcl.edu.pk/css/dark-blue.css',width:'1116',height:'350',customConfig:'ck_config_v5.js'});

</script>

