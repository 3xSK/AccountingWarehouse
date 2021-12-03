<?php

error_reporting(E_ERROR);

session_start();

include_once("config.php");

$lead_id=0;



if(isset($_REQUEST['lead_id'])) {

		$lead_id=intval($_REQUEST['lead_id']);

}


$lead_info=$db->selectFrom("select * from leads inner join landing on  leads.landing_id=landing.landing_id where leads.lead_id='$lead_id'");

?>
<?php include("pages/header.php"); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <i class="fa fa-users"></i> Leads Information </h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12 text-right">
        <!--- <div class="form-group"> <a class="btn btn-primary" href="add_user.php?group_id=3"> <i class="fa fa-plus"></i> Add Manufacturer</a> </div>--->
      </div>
    </div>
    <br />
    <?php if($_SESSION['msg']!="") { ?>
    <div class="<?php echo $_SESSION['msg_type']; ?>"> <?php echo $_SESSION['msg']; ?> </div>
    <?php } ?>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            
			
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-md-12"> 
                <div class="form-group">
                  <label for="fname">Landing Page:&nbsp;&nbsp;&nbsp;</label>
                  <?php echo $lead_info['title']; ?>
                </div>
              </div>
		
            </div>
          
            <div class="row">

                                <div class="col-md-12">

                                    <div class="form-group">

                                        <label for="fname">Name:&nbsp;&nbsp;&nbsp;</label>
                  <?php echo $lead_info['name']; ?>

                                    </div>

                                </div>

						</div>
						
			<div class="row">
              <div class="col-md-12"> 
                <div class="form-group">
                  <label for="fname">Email:&nbsp;&nbsp;&nbsp;</label>
                  <?php echo $lead_info['email']; ?>
                </div>
              </div>
		
            </div>
			
			<div class="row">
              <div class="col-md-12"> 
                <div class="form-group">
                   <label for="fname">Phone:&nbsp;&nbsp;&nbsp;</label>
                  <?php echo $lead_info['phone']; ?>
                </div>
              </div>
		
            </div>
			
			<div class="row">
              <div class="col-md-12"> 
                <div class="form-group">
                   <label for="fname">Details:&nbsp;&nbsp;&nbsp;</label>
                  <?php echo $lead_info['details']; ?>
                </div>
              </div>
		
            </div>
			
			<div class="row">
              <div class="col-md-12"> 
                <div class="form-group">
                  <a href="leads.php?landing_id=<?php echo $lead_info['landing_id']; ?>"> >> Back</a>
                </div>
              </div>
		
            </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
  </section>
</div>
<script>
function selectPage(lead_id) { 
	window.location.href='leads.php?lead_id=' + lead_id;

}

</script>
<?php include("pages/footer.php"); ?>
