<?php
require_once("config.php"); 


$article=$_POST['text'];
$sentences=explode(".",$article);


$stop_words = array(
    'a',
    'about',
    'above',
    'after',
    'again',
    'against',
    'all',
    'am',
    'an',
    'and',
    'any',
    'are',
    "aren't",
    'as',
    'at',
    'be',
    'because',
    'been',
    'before',
    'being',
    'below',
    'between',
    'both',
    'but',
    'by',
    "can't",
    'cannot',
    'could',
    "couldn't",
    'did',
    "didn't",
    'do',
    'does',
    "doesn't",
    'doing',
    "don't",
    'down',
    'during',
    'each',
    'few',
    'for',
    'from',
    'further',
    'had',
    "hadn't",
    'has',
    "hasn't",
    'have',
    "haven't",
    'having',
    'he',
    "he'd",
    "he'll",
    "he's",
    'her',
    'here',
    "here's",
    'hers',
    'herself',
    'him',
    'himself',
    'his',
    'how',
    "how's",
    'i',
    "i'd",
    "i'll",
    "i'm",
    "i've",
    'if',
    'in',
    'into',
    'is',
    "isn't",
    'it',
    "it's",
    'its',
    'itself',
    "let's",
    'me',
    'more',
    'most',
    "mustn't",
    'my',
    'myself',
    'no',
    'nor',
    'not',
    'of',
    'off',
    'on',
    'once',
    'only',
    'or',
    'other',
    'ought',
    'our',
    'ours',
    'ourselves',
    'out',
    'over',
    'own',
    'same',
    "shan't",
    'she',
    "she'd",
    "she'll",
    "she's",
    'should',
    "shouldn't",
    'so',
    'some',
    'such',
    'than',
    'that',
    "that's",
    'the',
    'their',
    'theirs',
    'them',
    'themselves',
    'then',
    'there',
    "there's",
    'these',
    'they',
    "they'd",
    "they'll",
    "they're",
    "they've",
    'this',
    'those',
    'through',
    'to',
    'too',
    'under',
    'until',
    'up',
    'very',
    'was',
    "wasn't",
    'we',
    "we'd",
    "we'll",
    "we're",
    "we've",
    'were',
    "weren't",
    'what',
    "what's",
    'when',
    "when's",
    'where',
    "where's",
    'which',
    'while',
    'who',
    "who's",
    'whom',
    'why',
    "why's",
    'with',
    "won't",
    'would',
    "wouldn't",
    'you',
    "you'd",
    "you'll",
    "you're",
    "you've",
    'your',
    'yours',
    'yourself',
    'yourselves',
    'zero'
);


$output="";

$counter=0;
foreach($sentences as $sentence) {
	$words=explode(" ",$sentence);
	
	foreach($words as $word) {
	
		$counter++;

			if(in_array(strtolower($word),$stop_words)) {
				$output.= $word." ";
			} else {
				$output.= ' <span class="word" id="word'.$counter.'">'.$word.'</span> ';
			}
		}
	$output.= ".";
}	

?>
<?php include_once("pages/header.php"); ?>
<script type="text/javascript" src="assets/sckeditor/ckeditor/ckeditor.js"></script>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header"> <strong>Article Rewriter</strong>
    <div class="row">
      <!-- left column -->
      
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary" style="padding:15px; font-size:16px">
		<textarea id="page_text" name="page_text"><?php echo trim($output); ?></textarea>
          <div class="context" id="dynamic_menu" hidden> <a href="#" onClick="HideMenu();" style="position:absolute; right:10px; top:10px">X</a>
            <div class="context_item">
              <div class="inner_item"> Copy </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
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
<script>
function HideMenu() {

	 jQuery(".context").fadeOut("fast");
}

var selectedWord="";
var selectedID="";

jQuery(".word").on('click', function(event){

	var ele=this;
	var word=ele.innerHTML;
	selectedWord=word;
	selectedID=ele.id;
	
	word.replace(".","");
	getRelated(word);

	  jQuery(".context")
    .show()
    .css({
      top: event.pageY-100,
      left: event.pageX-200
    });

});



function ReplaceWord(replace_word) {

	document.getElementById(selectedID).innerHTML="&nbsp;"+replace_word+"&nbsp;";
	HideMenu();
}


function getRelated(word) {
	jQuery("#dynamic_menu").html('');
	jQuery.ajax({
  type: "GET",
  url: "php/getword.php?word="+word,
  cache: false,
  success: function(data){
    jQuery("#dynamic_menu").html(data);
  }
});

}

</script>
<style>
.word { text-decoration:underline;  margin-right:5px ; margin-left:5px }

.context {
  font-size: 1.1em;
  position: absolute;
  width: 200px;
  height: auto;
  padding: 5px 0px;
  border-radius: 5px;
  top: 10;
  left: 10;
  background-color: #fff;
  box-shadow: 0 12px 15px 0 rgba(0, 0, 0, 0.24);
  color: #333;
 }
  .context_item {
    height: 32px;
    line-height: 32px;
    cursor: pointer;
    text-overflow: ellipsis;
    overflow: hidden;
	margin-left:20px;
    white-space: nowrap;
    &:hover {
      background-color: #ddd;
    }
    .inner_item {
      margin: 20px 10px;
      i {
        margin: 20px 5px 0 0;
        font-weight: bold;
      }
  .context_hr {
    height: 1px;
    border-top: 1px solid #bbb;
    margin: 3px 10px;
  }


</style>
<script>

CKEDITOR.replace('page_text',{contentsCss : 'http://brcl.edu.pk/css/dark-blue.css',width:'1116',height:'500',customConfig:'ck_config_v5.js'});

</script>
<?php include("pages/footer.php"); ?>
