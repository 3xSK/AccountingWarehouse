<?php
//error_reporting(E_ERROR);
session_start();
include_once("config.php");
$id=0;
/*
if($_SESSION['group_id']!="") {
	$Function->Redirect("index.php");
}*/

if(isset($_REQUEST['action']))  {

			if($_REQUEST['action']=='delete') {
					$journal_id=intval($_REQUEST['journal_id']);
								$deleted=$db->Delete_Record("journal"," journal_id=".$journal_id);
								if($deleted) {
										$_SESSION['msg']="Account has been deleted Successfully";
										$_SESSION['msg_type']="alert alert-success alert-dismissable";
										$Function->Redirect("journal.php");
								}	else {
										$_SESSION['msg']="Error while deleting the Account";
										$_SESSION['msg_type']="alert alert-danger alert-dismissable";
										$Function->Redirect("journal.php");
								}				
			}
	}


$accounts=$db->selectMultiRecords("select * from journalmaster order by journal_id");
?>
<?php include("pages/header.php"); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <i class="fa fa-users"></i>Journal</h1>
  </section>
  <section class="content">
    <div class="row">

      <div class="col-xs-12 text-right">

        <div class="form-group">


      <a class="btn btn-primary" data-bs-toggle="modal" href="add_journal.php" data-bs-target="#exampleModal">  Add Journal Entry</a> 

        <?php
    if($_SESSION['group_id']=='4') 
          {
          ?>
             <a class="btn btn-primary" href="send.php"> <i class="fa fa-envelope" aria-hidden="true"></i> Send Mail</a> 
          <?php
          }
          ?>
      </div>
      </div>

       <div class="form-inline" method="POST" action="search.php">
        <label></label>
        <input type="date" class="form-control" placeholder="Start"  id="FromDate"  />
        <label>To</label>
        <input type="date" class="form-control" placeholder="End"  id="ToDate"/> 
        <button class="btn btn-primary" name="search" id="btnFilter"><span class="glyphicon glyphicon-search"></span></button> <a  type="button" id="btnAllSearch" class="btn btn-success"><span class = "glyphicon glyphicon-refresh"><span></a>
		</div>

    </div>

	 <br />
    <?php if(isset($_SESSION['msg'])) { ?>
    <div class="<?php echo $_SESSION['msg_type']; ?>"> <?php echo $_SESSION['msg']; ?> </div>
    <?php } ?>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
       
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <div class="panel-body">
              <table width="100%" class="table" >
              
                <thead>
                  <tr>
                 
                    <th>Type</th>
                 
                   <th>Debit</th>
                   <th>Credit</th>
                   
                  
                  
                    
                 </tr>
                </thead>
                <tbody >
                  <?php
                         
$accounts=$db->selectMultiRecords("select  j.accounts as Accounts, j.accType as Type, Sum(j.debit) as Debit, sum(j.credit) as Credit from journal j  group by j.accType order by j.accType");
            foreach($accounts as $account){

                    ?>
                    <tr >
    <th><?php echo $account['Type'];?></th>
                 
                   <th class="warning">$<?php echo $account['Debit'];?></th>
                   <th class="warning">$<?php echo $account['Credit'];?></th>
</tr>
                  <?php }?>
                </tbody>
              </table>
             <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
              
                <thead>
                  <tr>
                    <th>Journal Entry #</th>
                    <th>Date</th>
               
                 
                   
                   <th>Description</th>
                  
                   <th>Action</th>
                   <th>Entry Status</th>
                    
                 
                    
                 </tr>
                </thead>
                <tbody id="tblaccount">
                   
                  
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
  </section>
</div>


<?php include("pages/footer.php"); ?>
<script>
  $(document).ready(function () {
    load('0');
    function load(filter)
    {
   var FromDate=$("#FromDate").val();
   var ToDate=$("#ToDate").val();
      //List.php
      var opt=filter;

     // alert(filter)
      $.ajax({
   url:'Journal/rejectedJournalList.php',
   datatype:"application/json",
   type:'POST',
  data:{FromDate:FromDate,ToDate:ToDate,filter:opt}, 
   success:function(data){
      $('#tblaccount').html(data); 
      console.log(data);
   },
   error:function( e){
      // code for error
          console.log(e);}
        });
   }
   $("#btnFilter").click(function(){


load('1');

});
    $("#btnAllSearch").click(function(){


load('0');

});
   
 });
 
</script>
