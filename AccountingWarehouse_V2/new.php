<?php
error_reporting(E_ERROR);
session_start();

include_once("config.php");
global $db;

$keyword="";
$items=array();

if(isset($_REQUEST['keyword']))	 {
	
		$keyword=$_REQUEST['keyword'];
		
		$keyword=str_replace(" ","+",$keyword);
	
		$data = file_get_contents("https://www.googleapis.com/customsearch/v1?key=AIzaSyAC7P-68iJuxbi9mWna0neVhkJIhGv1ncs&cx=003077015056494353986:h4wlnlblkpy&sort=date-sdate
&q=".$keyword);
echo "<pre>";
	print_r($data);
	exit;
	$data = json_decode($data);
	
	$totalResults = $data->queries->request[0]->totalResults;
	
	$i=0;
	foreach($data->items as $result) {
			
			$items[$i]['title']=$result->title;
			$items[$i]['link']=$result->link;
		$i++;
	}
		

}


	
$projects=$db->selectMultiRecords("select * from projects order by name");
$niches=$db->selectMultiRecords("select * from niches order by niche");

$users=$db->selectMultiRecords("select * from users where user_id=$_SESSION[user_id] or added_by=$_SESSION[user_id] order by first_name,last_name");

?>

<?php include("pages/header.php"); ?>

<script type="text/javascript" src="assets/sckeditor/ckeditor/ckeditor.js"></script>

<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <strong>Find Articles </strong>
	<div class="row">

      <!-- left column -->

      <?php if($_SESSION['msg']!="") { ?>

      <div class="<?php echo $_SESSION['msg_type']; ?>"> <?php echo $_SESSION['msg']; ?> </div>

      <?php } ?>

      <div class="col-md-12">

        <!-- general form elements -->

        <div class="box box-primary">

          <form role="form" id="addNewAuthor" action="" method="get" enctype="multipart/form-data">

            <div class="box-body">
			
			<div class="row">
             
              <div class="col-md-4">
                <div class="form-group">
                  <label for="fname">Enter Keyword</label>
				  <input type="text" class="form-control required" value="<?php echo str_replace("+", " ", $keyword); ?>" id="keyword" name="keyword" required>
				  
                </div>
              </div>
			  
			  <div class="col-md-1">
                <div class="form-group">
				<br />
                 <input type="submit" class="btn btn-primary" name="find_article" value=" FIND " />
                </div>
              </div>
			
            </div>

        	</div>
		  </form>


      </div>
	  
	  
	</div>
	
	</div>

  </section>

  <section class="content">

    
	
	
	<div class="row">
	 <div class="col-md-12">
		<div class="box box-primary">
   				 <div class="box-body">

      <div class="col-md-3">
		
        
		<table width="100%">
		<?php foreach($items as $item) { ?>
			<tr>
				<td><a href="<?php echo $item['link']; ?>" target="_blank"><i class="fa fa-eye"></i></a></td>
				<td nowrap="nowrap"><div class="direct-chat-text">  <a title="<?php echo $item['link']; ?>" onClick="LoadPage('<?php echo $item['link']; ?>');" href="javascript:void(0);"><?php echo substr($item['title'],0,40); ?></a></div></td>
			</tr>
		  	
		<?php } ?>
		</table>
	  
		</div>
		
      <div class="col-md-9">
		<iframe src="" id="Pagecontents" style="height:400px; width:100%; overflow:scroll"></iframe>
      <!--- <div id="Pagecontents" style="height:500px; width:100%; overflow:scroll"></div>--->
		</div>
		</div>
		</div>
	</div>
	</div>
	
	<div class="row">
	 <div class="col-md-12">
		<div class="box box-primary">
   				 <div class="box-body">

      
		
      <div class="col-md-12">
		 <textarea class="form-control" id="page_text" name="text" rows="4" style="height:500px"></textarea>
		</div>
		</div>
		</div>
	</div>
	</div>
	
  </section>

</div>
  
<script>
function LoadPage(url){
	
document.getElementById("Pagecontents").src="php/getPage.php?link=" + url;

/*
	$.ajax({
			  type: "POST",
			  url: "php/getPage.php",
			  data: {link : url},
			  cache: false,
			  success: function(data){
				 $("#Pagecontents").html(data);
			  }
			});
	*/
}

</script>
<script>

//CKEDITOR.replace('page_text',{contentsCss : 'http://brcl.edu.pk/css/dark-blue.css',width:'1116',height:'500',customConfig:'ck_config_v5.js'});

</script>
<style>


.direct-chat-text::after, .direct-chat-text::before {
	 position:relative; 
	right: 100%; 
	 top: 15px; 
	border: solid transparent;
	content: ' ';
	height: 0;
	width: 0;
	pointer-events: none;
}
.direct-chat-text {
	border-radius: 5px;
	position: relative;
	padding: 5px 5px;
	background: #d2d6de;
	border: 1px solid #d2d6de;
	margin: 5px 0 0 5px;
	color: #444;
}
</style>
<?php include("pages/footer.php"); ?>

<script>
	

	$("body").toggleClass("sidebar-collapse");
	
</script>
<script>

function PopulateTextEditor(text) {

	document.getElementById("page_text").value=  document.getElementById("page_text").value + text;
}

</script>
