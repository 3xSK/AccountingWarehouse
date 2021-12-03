<?php

error_reporting(E_ERROR);

session_start();

include_once("config.php");


$page_id=0;



if(isset($_REQUEST['page_id'])) {

		$page_id=intval($_REQUEST['page_id']);

}


if(isset($_POST['UpdatePage'])){

								
					$text=$_POST['text'];	
					$title=$_POST['title'];	
					$text=str_replace("../../images/","http://www.iosnow.com/purelinked/images/",$text);
					$text=addslashes($text);	
	
					$updated=$db->Update_Record("pages"," title='$title',text='$text' where page_id=".$page_id);

								if($updated) {

										$_SESSION['msg']="Page has been updated Successfully";

										$_SESSION['msg_type']="alert alert-success alert-dismissable";

										$Function->Redirect("cms_main.php");

								

								}	else {

										$_SESSION['msg']="Error while updating the Page";

										$_SESSION['msg_type']="alert alert-danger alert-dismissable";

										$Function->Redirect("cms_main.php");

								

								}						
       

    }


$page_info=$db->selectFrom("select * from pages where page_id=$page_id");

?>

<?php include("pages/header.php"); ?>
<script type="text/javascript" src="assets/sckeditor/ckeditor/ckeditor.js"></script>

<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

        <h1>

            <i class="fa fa-users"></i> <?php echo $page_info['name']; ?>

           </h1>

    </section>

    <section class="content">

        <div class="row">

            <!-- left column -->

				<?php if($_SESSION['msg']!="") { ?>

		<div class="<?php echo $_SESSION['msg_type']; ?>">

             <?php echo $_SESSION['msg']; ?>

        </div>

		<?php } ?>

            <div class="col-md-8">

                <!-- general form elements -->

                <div class="box box-primary">

                   

                    <!-- /.box-header -->

                    <!-- form start -->

                    

                    <form role="form" id="addcms" action="" method="post" enctype="multipart/form-data">
						<input type="hidden" name="page_id" value="<?php echo $page_id; ?>" />
                        <div class="box-body">

                            <div class="row">

                                <div class="col-md-12">

                                    <div class="form-group">

                                        <label for="fname">Title</label>

                                        <input type="text" class="form-control required" value="<?php echo $page_info['title']; ?>" id="title" name="title" required>

                                    </div>

                                </div>

						</div>
						
						
						<div class="row">

                                <div class="col-md-12">

                                    <div class="form-group">

                                        <label for="fname">Text</label>

                                       <textarea class="form-control" id="page_text" name="text" rows="4"><?php echo $page_info['text']; ?></textarea>

                                    </div>

                                </div>

						</div>

					

                            <div class="box-footer">

                                <input type="submit" class="btn btn-primary" name="UpdatePage" value="Submit" />

                                <input type="reset" class="btn btn-default" value="Reset" />

                            </div>

                    </form>

                    </div>

                </div>

                

            </div>

    </section>



    </div>

<script>

CKEDITOR.replace('page_text',{contentsCss : 'http://brcl.edu.pk/css/dark-blue.css',width:'1116',height:'500',customConfig:'ck_config_v5.js'});

</script>
	<?php include("pages/footer.php"); ?>

	