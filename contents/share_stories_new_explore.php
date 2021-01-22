<div class="currentLiveVideosWrapper">
<div class="liveRoomTitle">
<div class="roomsL"><?php echo $page_Lang['user_stories'][$dataUserPageLanguage];?></div>  
<a>
<form id="storiesform" method="post" enctype="multipart/form-data" action="<?php echo $base_url;?>requests/upload.php">
      <label class="label_storyUpload" data-id="stories" for="storie_img">Create a new Story</label>
      <input type="file" name="storieimg" id="storie_img" data-id="stories"> 
</form>
</a> 
</div> 
<?php  
	 $FriendStories=$Dot->Dot_AllStoryPost($uid);
	 if($FriendStories){
		 echo '<div class="allLivVideos storyContainer" style="overflow: hidden; overflow-x: scroll;" id="story-view"><span class="thswpcntstry"><span class="swiper-wrapper">';
	    foreach($FriendStories as $storyData) {
		        $SotryUploaded = isset($storyData['pics']) ? $storyData['pics'] : NULL;
				$SotrySharedUserFullName = $storyData['user_fullname']; 
				$final_image=$base_url."uploads/stories/".$SotryUploaded;
				$StorySharedUserName = $storyData['user_name'];
				$StoryCreatedTime = $storyData['created']; 
				$storyID = $storyData['s_id'];
				$StorySharedUserID = $storyData['uid_fk'];
				$StorySharedUserAvatar = $Dot->Dot_UserAvatar($StorySharedUserID,$base_url);  
				$up = explode(",", $SotryUploaded);?>
                <div class="story-view-item" style="background-image: url(<?php echo $StorySharedUserAvatar;?> )" data-profile-image="<?php echo $StorySharedUserAvatar;?>" data-profile-name="<?php echo $SotrySharedUserFullName;?>">
                   <span class="name truncate"> <?php echo $SotrySharedUserFullName;?> </span>
                   <ul class="media">
                <?php  
				 foreach ($up as $item) {    
				  $extensionStory =''; 
				  $imageExtensions = array("jpg", "png", "gif", "bmp","jpeg","PNG","JPG","JPEG","GIF","BMP");
				  $videoExtensions = array("mp4", "MP4");
				  $exts = pathinfo($item, PATHINFO_EXTENSION); 
				  
				  if(in_array($exts, $imageExtensions)){
					   $extensionStory = 'photo';
					   $theStory = '<li data-duration="7" data-sid="'.$storyID.'" data-id="'.$StorySharedUserID.'" data-time="'.$StoryCreatedTime.'"> <img src="'.$base_url."uploads/stories/".$item.'"></li>'; 
				  }
				  if(in_array($exts, $videoExtensions)){
				       $extensionStory = 'video';
					   $theStory = '<li> <li class="move_'.$storyID.'"  data-duration="" data-id="'.$StorySharedUserID.'" data-time="'.$StoryCreatedTime.'"> <video id="aample'.$storyID.'" src="'.$base_url."uploads/stories/".$item.'" type="video/webm"></video> </li> </li>';
					   echo '<script>$(document).ready(function () {var videoDuration =  document.getElementById("aample'.$storyID.'");var durationa = videoDuration.duration; $(".move_'.$storyID.'").attr("data-duration", durationa);}); </script>';
				  }     
				  echo $theStory; 
				   }?>
                 </ul>
        </div>	 
		<?php 
		 } 
echo '</span></span></div>';
}else{ ?>
<div class="noVideoStreams" style="justify-content: center;">
<div class="fake-story-view-item"><span class="fake-name truncate"></span></div>
<div class="fake-story-view-item"><span class="fake-name truncate"></span></div>
<div class="fake-story-view-item"><span class="fake-name truncate"></span></div>
<div class="fake-story-view-item"><span class="fake-name truncate"></span></div>
<div class="fake-story-view-item"><span class="fake-name truncate"></span></div>
<div class="fake-story-view-item"><span class="fake-name truncate"></span></div>
<div class="fake-story-view-item"><span class="fake-name truncate"></span></div>
</div>
<?php } ?>     
</div>