<?php

error_reporting(E_ERROR);

session_start();

include_once("config.php");

global $db;
$check=true;

$name="";



if(isset($_POST['addProject'])){


        $name = trim(addslashes($_POST['name']));
		
       
	   	$fields="name";
       	$vals="'$name'"; 
		$db->Add_Record("projects",$fields,$vals);

        	

					$_SESSION['msg']="Project has been added Successfully";

					$_SESSION['msg_type']="alert alert-success alert-dismissable";

					$Function->Redirect("projects.php");

			

    }
	

?>
<?php include("pages/header.php"); ?>
<script type="text/javascript" src="assets/sckeditor/ckeditor/ckeditor.js"></script>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <i class="fa fa-users"></i> Project Management </h1>
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
            <h3 class="box-title">Add New Project</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" id="addNewAuthor" action="" method="post">
            <div class="box-body">
            <div class="row">
              <div class="col-md-12"> 
                <div class="form-group">
                  <label for="fname">Name</label>
                  <input type="text" class="form-control required" value="<?php echo $name; ?>" id="name" name="name" required>
                </div>
              </div>
		
            </div>
          
         
            <!-- /.box-body -->
            <div class="box-footer">
              <input type="submit" class="btn btn-primary" name="addProject" value="Submit" />
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

