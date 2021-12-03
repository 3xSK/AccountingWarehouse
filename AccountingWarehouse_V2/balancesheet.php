<?php
error_reporting(E_ERROR);
session_start();
include_once("config.php");
$id=0;

$datetime = date('M d, Y');




?>
<?php include("pages/header.php"); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <i class="fa fa-users"></i>  Balance Sheet</h1>
    <h3>As of <?php echo $datetime ?></h3>
  </section>
  <section class="content">
    <div class="row">

     

    </div>

	 <br />
    <?php if($_SESSION['msg']!="") { ?>
    <div class="<?php echo $_SESSION['msg_type']; ?>"> <?php echo $_SESSION['msg']; ?> </div>
    <?php } ?>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
       
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <div class="panel-body">
             <table width="100%" class="table" id="dataTables-exampl">
                
                  <?php

					

                   
$AccType=$db->selectMultiRecords("select j.AccType as AccType from journal j group by j.AccType order by j.accType");

$Debit=0;
$Credit=0;

                        foreach($AccType as $Type)



                        {
                          $Debit=0;
$Credit=0;

$AccTpe=$Type['AccType'];
						              
?>

   <tr class="dark odd">
                       
                            <th colspan="2"><h4><?php echo $AccTpe?></h4></th>
                               
                                <td></td>
                                <td></td>
                                
                             </tr>
<?php
                         
$accounts=$db->selectMultiRecords("select  j.accounts as Accounts, j.debit as Debit, j.credit as Credit from journal j where j.accType='".$AccTpe."' group by j.accounts order by j.accType");
						foreach($accounts as $account){
$Debit += $account['Debit'];
$Credit += $account['Credit'];
                    ?>
					        <tr class="warning">
                                <td ><?php echo $account['Accounts'];?></td>
                             
                                <td>$<span class="debit"><?php echo number_format($account['Debit'],2);?></span></td>
                             
                                
                                
                                <td>$<span class="credit"><?php echo number_format($account['Credit'],2);?></span></td>
                             
                                 
                              
                                
                             </tr>
                          
                  
                  <?php

                        }

                        ?>
    <tr class="primary">
                                <td >Total</td>
                             
                                <td>$<span class="font-weight-bold"><?php echo number_format($Debit,2 );?></span></td>
                             
                                
                                
                                <td>$<span class="font-weight-bold"><?php echo number_format($Credit,2);?></span></td>
                             
                                 
                              
                                
                             </tr>
                        <?php

                        }



                    
                  



                    ?>
                            <tr class="danger">
                                <th >Total</th>
                               
                                <th>$<span id="debit"></span></th>
                                <th>$<span id="credit"></span></th>
                             </tr>
               
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
  $(document).ready(function(){

balance();
    function Debit()
{
  var total = 0;
  $('.debit').each(function(){
    total += parseInt( $(this).text() );
  })
 return total;

}
  function Credit()
{
  var total = 0;
  $('.credit').each(function(){
    total += parseInt( $(this).text() );
  })
 return total;

}
  function balance()
{
var tbldebit=Debit();
var tblCredit=Credit();
$("#debit").html(tbldebit);
$("#credit").html(tblCredit);

//$("#balance").html((tbldebit-tblCredit));
      /*          
   var balance=$("#balance").html();
   if(balance<1)
   {

      $("#balance").css("color","red");

   }
   else
   {

      $("#balance").css("color","green");


   }*/
}
  });
</script>
