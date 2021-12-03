<?php

require('pages/header.php');


if(isset($_REQUEST['campaign_id'])){

  $campaign_id =  intval($_REQUEST['campaign_id']);

}
  
 $campaign_info=$db->selectFrom("select * from campaigns where campaign_id=".$campaign_id);

if(isset($_POST['Updatecampaign'])){
		
		
		$name=$_POST['name'];
		$template_id=$_POST['template_id'];
		$list_id=$_POST['list_id'];
		$status=$_POST['status'];
		


		$db->Update_Record("campaigns","name='".$name."',template_id='".$template_id."',list_id='".$list_id."',status='".$status."' where campaign_id=".$campaign_id);
		
		$db->Delete_Record('campaign_servers', " campaign_id=".$campaign_id);
		
		for($i=0;$i<count($_POST['smtp']);$i++) {
			$smtp_id=$_POST['smtp'][$i];

			$db->Add_Record("campaign_servers","campaign_id,server_id","'".$campaign_info['campaign_id']."','".$smtp_id."'");			

		}
    $displayMsg = "display:block";
    $msgType = "success";
    $msg = " Campaign updated!";



		$Function->Redirect("campaigns.php");
}


$lists=$db->selectMultiRecords("select * from lists order by list_name");
$messages=$db->selectMultiRecords("select * from templates order by name");

$smtps=$db->selectMultiRecords("select * from servers order by username");
?>
<script src="ckeditor/ckeditor.js"></script>
<link href="bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
<form action="" method="post" name="templateform">
	<div id="page-wrapper">
  <div class="row"> <h2> Add New Campaign</h2></div>
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <!-- Nav tabs -->
        <div role="tabpanel" class="tab-pane active" id="home">
              <div class="row"> &nbsp; </div>
              <div class="row">
                <div class="form-group">
                  <label class="col-lg-3 control-label">Campaign Name:</label>
                  <div class="col-lg-7">
                    <input type="text" class="form-control" name="name"  value="<?php echo $campaign_info['name'] ?>"/>
                  </div>
                </div>
                <br />
                <br />
                <div class="form-group">
                  <label class="col-lg-3 control-label">Message:</label>
                  <div class="col-lg-7">
                    <select  class="form-control" name="template_id">
						<option value=""></option>
						<?php for($m=0;$m<count($messages);$m++) { ?>
								<option <?php if($messages[$m]['template_id']==$campaign_info['template_id']) { ?> selected="selected" <?php } ?>
											 value="<?php echo $messages[$m]['template_id'] ?>"><?php echo $messages[$m]['name'] ?></option>
						<?php } ?>
					</select>
						 
                  </div>
				
                </div>
				<br />
                <br />
                <div class="form-group">
                  <label class="col-lg-3 control-label">Selct Contacts:</label>
                  <div class="col-lg-7">
                     <select  class="form-control" name="list_id">
					 	<option value=""></option>
						<?php for($l=0;$l<count($lists);$l++) { ?>
								<option value="<?php echo $lists[$l]['list_id'] ?>"
									<?php if($lists[$l]['list_id']==$campaign_info['list_id']) { ?> selected="selected" <?php } ?>
									><?php echo $lists[$l]['list_name'] ?></option>
						<?php } ?>
					 </select>
                  </div>
				  
                </div>
				
				<br />
                <br />
				
				<div class="form-group">
                  <label class="col-lg-3 control-label">Status:</label>
                  <div class="col-lg-7">
                     <select  class="form-control" name="status">
					 	<option value="1" <?php if($campaign_info['status']=='1') { ?> selected="selected" <?php } ?>>Enabled</option>
						<option value="0" <?php if($campaign_info['status']=='0') { ?> selected="selected" <?php } ?>>Disabled</option>
					 </select>
                  </div>
				  
                </div>
				<br />
                <br />
				
				<div class="form-group">
                  <label class="col-lg-3 control-label">SMTP Profiles:</label>
                  <div class="col-lg-9">
				  
				  	<?php for($s=0;$s<count($smtps);$s++) { 
						$checked=false;
						$check_server=$db->countRecords("select * from campaign_servers where campaign_id=".$campaign_id." and server_id=".$smtps[$s]['server_id']);
						
						if($check_server>0) {
								$checked=true;
						}
					?>
					<input type="checkbox" <?php if($checked) { ?> checked="checked" <?php } ?> name="smtp[]" id="smtp<?php echo $smtps[$s]['server_id'] ?>" value="<?php echo $smtps[$s]['server_id'] ?>"  />&nbsp;<label for="smtp<?php echo $smtps[$s]['server_id'] ?>"><?php echo $smtps[$s]['username'] ?></label><br />
						<?php } ?>
                   
                  </div>
				  
                </div>
				
				<br />
                <br />
			</div>
			<div class="row">
					<div class="form-group">
                            <label class="col-lg-3 control-label"></label>
                           
                            <div class="col-lg-9">
							<br />
                <input type="submit" name="Updatecampaign" class="btn btn-primary"  value="Update Campaign">
                                
                            </div>
                        </div>
			</div>
				
				
              </div>
              
             
            
            </div>
      </div>
    </div>
    <!-- /.col-lg-12 -->
    <!-- </div> -->
    <div class="panel-body">
      
    </div>
    <!-- Edit Modal -->
    <div id="modal_edit" class="modal fade" style="font-weight: normal;">
      <div class="modal-dialog">
        <div class="modal-content"> </div>
      </div>
    </div>
    <!-- End Edit Modal -->
    <!-- delete modal -->
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body"> Do you really want to Delete  ? </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <a class="btn btn-danger btn-ok">Delete</a> </div>
        </div>
      </div>
    </div>
 
  </div>
  <!-- /#page-wrapper -->
</div>
</form>
<!-- /#wrapper -->
<?php

require('pages/footer.php');
?>
<script>

function ChangeAll() {
		
		var editorData= CKEDITOR.instances['content1'].getData();
		for(i=2;i<=10;i++) {
			
			document.getElementById("subject" + i).value=document.getElementById("subject1").value;
			CKEDITOR.instances['content2'].setData(editorData);
			CKEDITOR.instances['content3'].setData(editorData);
			CKEDITOR.instances['content4'].setData(editorData);
			CKEDITOR.instances['content5'].setData(editorData);
			CKEDITOR.instances['content6'].setData(editorData);
			CKEDITOR.instances['content7'].setData(editorData);
			CKEDITOR.instances['content8'].setData(editorData);
			CKEDITOR.instances['content9'].setData(editorData);
			CKEDITOR.instances['content10'].setData(editorData);
		
		}
		
                    
}

  $('.modalButton').click(function(){
        var listid = $(this).attr('data-userid');
       
        $.ajax({url:"ajax/getList.php?listid="+listid,cache:false,success:function(result){
         var result =  JSON.parse(result) ;
          console.log(result);
          var form = "";
           form +=  '<div class="modal-header">';
              
               form +=   '<h4 class="modal-title" id="myModalLabel">Update List</h4>';
            form +=  ' </div>';
               form +=  '<form id="editForm" class="form-horizontal" method="post">';
               form +=  '<input type="hidden" name="updateID" value="'+ result[0].list_id+'">';

              

                
               form += '<div class="form-group" style="margin-top:5px">';
                  form += ' <label class="col-lg-3 control-label">Name</label>';
                  form +=  '<div class="col-lg-5">';
                  form +=   '   <input type="text" class="form-control" name="uname"  value="'+ result[0].list_name+'"/>';
                  form +=  '</div>';
                form +='</div> ';
           
       

                  form +='<div class="form-group">';
                 form +=  ' <label class="col-lg-3 control-label"></label>';
                 form +=   '<div class="col-lg-5">';


                  form += '<input type="submit" name="updateUser" class="btn btn-primary"  value="Update List">';
                   
                 

                  form +=  '</div>';  

            
               form +=' </div> ;';
            $(".modal-content").html(form);
           
        }});
    });
    $(document).ready(function() {


      $('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});
      //check status code
     $('#registrationForm').bootstrapValidator({
        fields: {
             
            name: {
               
                validators: {
                   
                    notEmpty: {
                        message: 'The name is required and cannot be empty'
                    }
              
                }
            } 
        }
    });
       //end check status code

        $('#dataTables-example').DataTable({
                responsive: true,
                "bSort": false,
                "bFilter": true
        });
   


    });


   
    </script>
