<?php
error_reporting(E_ERROR);
session_start();

include_once("config.php");
include('classes/simple_html_dom.php');
$main_contents = new simple_html_dom();
$headings = new simple_html_dom();

global $db;

$keyword="";
$items=array();

	$Google_api_key = 'AIzaSyCdFPMuUZJZATveE_8mzXrsFJosfpucsWI';


	$eng_text="The hackers infected targets' electronic devices with malware to enable surveillance, Facebook (FB) said. In some cases, the hackers compromised or impersonated news websites popular among Uyghurs to secretly install spying software.

This group used fake accounts on Facebook to create fictitious personas posing as journalists, students, human rights advocates or members of the Uyghur community to build trust with people they targeted and trick them into clicking on malicious links, the company said.

Some of Facebook's finding benefited from research by FireEye, a cybersecurity company, Facebook said.
In January, the United States officially determined that China is committing genocide and crimes against humanity against Uyghur Muslims and ethnic and religious minority groups who live in the northwestern region of Xinjiang. (The Chinese government denied this assertion, calling it a lie.)";

	$url = 'https://www.googleapis.com/language/translate/v2?key='.$Google_api_key.'&q='.rawurlencode($eng_text).'&source=en&target=fr';
   
   echo $url;
   exit;
    $handle = curl_init($url);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);     //We want the result to be saved into variable, not printed out
    $response = curl_exec($handle);    
                 
    curl_close($handle);
	
	$response=json_decode($response);
	
		
	if(isset($response->data->translations[0]->translatedText)) {
		$output_text=$response->data->translations[0]->translatedText;
	} else {
		$output_text='';
	}
	
	exit;


if(isset($_REQUEST['keyword']))	 {
	
		$keyword=$_REQUEST['keyword'];
		
		$keyword=str_replace(" ","+",$keyword);
		$data = file_get_contents("https://www.googleapis.com/customsearch/v1?key=AIzaSyAC7P-68iJuxbi9mWna0neVhkJIhGv1ncs&cx=003077015056494353986:h4wlnlblkpy&q=".$keyword);

	$data = json_decode($data);
	
	
	$totalResults = $data->queries->request[0]->totalResults;
	
	$i=0;
	foreach($data->items as $result) {
			
			$items[$i]['title']=$result->title;
			$items[$i]['link']=$result->link;
			
			
		$i++;
	}
		

}


function findHtml($link) {
	
		global $main_contents;
	
	
		$useragent = "Opera/9.80 (J2ME/MIDP; Opera Mini/4.2.14912/870; U; id) Presto/2.4.15";
		$ch = curl_init ("");
		curl_setopt ($ch, CURLOPT_URL, $link);
		curl_setopt ($ch, CURLOPT_USERAGENT, $useragent); // set user agent
		//curl_setopt($ch, CURLOPT_PROXY, $proxy);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		$output = curl_exec ($ch);
		curl_close($ch);
	
	
	
		return $output;

}

function getHeadings($html) {
		
		global $headings;
		$headings->load($html);
		
	   $heads = $headings->find('p',0)->innertext; 
  	
		return $heads;
		
}

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
		
		<?php foreach($items as $item) { 
			
			$html=findHtml($item['link']);
			$headings=getHeadings($html);
			
			echo "<pre>";
			print_r($headings);
			exit;
		?>
		
		
		<?php } ?>

		<table width="100%">
		
			<tr>
				<td><a href="<?php echo $item['link']; ?>" target="_blank"><i class="fa fa-eye"></i></a></td>
				<td nowrap="nowrap"><div class="direct-chat-text">  <a title="<?php echo $item['link']; ?>" onClick="LoadPage('<?php echo $item['link']; ?>');" href="javascript:void(0);"><?php echo substr($item['title'],0,40); ?></a></div></td>
			</tr>
		  	
		
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
