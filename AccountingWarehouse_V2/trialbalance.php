<?php
error_reporting(E_ERROR);
session_start();
include_once("config.php");
$id=0;

$datetime = date('M d, Y');

$accounts=$db->selectMultiRecords("SELECT 
ch.id,
ch.acctName as Accounts,
(case  when (j.debit>0 & j.credit>0) 
then 'DR/CR'
 when j.debit>0   then 'DR' when j.credit>0  then 'CR' end) as 'PR',
sum(j.debit) as   Debit,
sum(j.credit) as Credit
FROM  journal j 
 join coa ch on ch.id=j.acc_id
group by ch.id");
?>
<?php include("pages/header.php"); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <i class="fa fa-users"></i> Trial Balance</h1>
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
             <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                  <tr>
                    <th>Account Titles</th>
                    <th>Debit</th>
                    <th>Credit</th>
                  </tr>
                </thead>
                <tbody>
                  <?php

					

                    if(!empty($accounts))



                    {



                        foreach($accounts as $account)



                        {

						

						

                    ?>
					        <tr>
                                <td><?php echo $account['Accounts'];?></td>
                                <td>$<span class="debit"><?php echo number_format($account['Debit'],2); ?></span></td>
                               <td>$<span class="credit"><?php echo number_format($account['Credit'],2); ?></span></td>
                             </tr>
                  
                  <?php



                        }



                    }



                    ?>
                </tbody>
                <tfoot>
                     <tr class="primary">
                                <th >Total</th>
                               <th></th>
                                <th>$<span id="debit"></span></th>
                                <th>$<span id="credit"></span></th>
                             </tr>
                </tfoot>
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
