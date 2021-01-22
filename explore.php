<?php  
include_once 'functions/inc.php';  
if(empty($uid)){
   header("Location: $base_url");   
}
$page ='explore'; 
$pmore = 'more_explore';
if(isset($_GET['ex'])){ 
    $getp = isset($_GET['ex']) ? $_GET['ex'] : '';	
	$exploreClass = 'explores';
	if($getp == 'text'){
	     $pmore = 'more_explore_text';
	}else if($getp == 'img'){
	     $pmore = 'more_explore_img';
	}else if($getp == 'vid'){
	     $pmore = 'more_explore_vid';
	}else if($getp == 'aud'){
	     $pmore = 'more_explore_aud';
	}else if($getp == 'filter'){
	     $pmore = 'more_explore_fil';
	}else if($getp == 'gifs'){
	     $pmore = 'more_explore_gif';
	}else if($getp == 'watermarks'){
	     $pmore = 'more_explore_watermarks';
	}else if($getp == 'which'){
	     $pmore = 'more_explore_which';
		 $exploreClass = 'explores_which';
	}else if($getp == 'bfaf'){
	     $pmore = 'more_explore_bfaf';
		 $exploreClass = 'explores_which';
	}
	
}  

//This file is displayed on all pages, all the changes you make can be displayed on all pages.
include("contents/header.php");
?> 

<div class="section">
   <div class="main">
       <div class="container">
            <!--MIDDLE STARTED-->
            <div class="exploreWrapper">
                <?php 
				include("contents/explore_page_header_menu.php");
				include("contents/share_stories_new_explore.php");
				?>
                <main class="<?php echo $exploreClass;?>" id="morePostType" data-type="<?php echo $pmore;?>"> 
                    <?php  
					switch($getp) { 
						case 'text': 
							include('contents/post_text_explore.php');
							break;
					    case 'img': 
							include('contents/post_img_explore.php');
							break;
					   case 'vid': 
							include('contents/post_video_explore.php');
							break;
					   case 'aud': 
							include('contents/post_audio_explore.php');
							break; 
					  case 'filter': 
							include('contents/post_filter_explore.php');
							break;
			          case 'gifs': 
							include('contents/post_gif_explore.php');
							break;   
					  case 'watermarks': 
							include('contents/post_watermark_explore.php');
							break;
					  case 'which': 
							include('contents/post_whichs_explore.php');
							break;
					  case 'bfaf': 
							include('contents/post_bfaf_explore.php');
							break;
					  default:
				      include('contents/post_explore.php');
					 }
					?>  
                  </main>    
            </div>
            <!--MIDDLE FINISHED--> 
       </div>
   </div>
</div> 
<?php 
// Here is some javascript codes
include("contents/javascripts_vars.php"); 
  $FriendStories=$Dot->Dot_AllStoryPost($uid);
  if($FriendStories){?> 
<script type="text/javascript" src="<?php echo $base_url;?>js/sw/lib/hammer.min.js"></script>
<script type="text/javascript" src="<?php echo $base_url;?>js/sw/sview.js"></script>   
<script type="application/javascript">
$( document ).ready( function() { 
	var storyView = new StoryView({
	  container: document.querySelector( '#story-view' ),
	  autoClose: true
	}); 
}); 
</script> 
<?php  }?> 
</body>
</html>