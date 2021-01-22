<?php  
include_once("../functions/inc.php");
$requestArray = array("live_comment","live_comment_own","live_subslike","ups");
if(isset($_POST['f']) && in_array($_POST['f'], $requestArray)){
   $activity = mysqli_real_escape_string($db, $_POST['f']); 
if($activity == 'live_comment'){  
if(isset($_POST['idc']) && isset($_POST['lc'])){
   $liveVideoID = mysqli_real_escape_string($db, $_POST['idc']);
   $lastCommendID = mysqli_real_escape_string($db, $_POST['lc']);
   $getliveCommentsLive = $Dot->Dot_CheckNewLiveVideoComment($liveVideoID,$lastCommendID);
   
   $liveNewCommentID = $getliveCommentsLive['live_comment_id'];
   $liveNewCommentUidFk = $getliveCommentsLive['live_comment_uid_fk'];
   $liveNewComment = $getliveCommentsLive['live_video_comment'];  
   $liveNewCommentUserName = $getliveCommentsLive['user_name'];
   $liveNewCommentUserFullName = $getliveCommentsLive['user_fullname'];
   $liveNewCommentVerifiedStatus = $getliveCommentsLive['verified_user'];
   $liveNewCommentStartStatus = $getliveCommentsLive['start_live'];
   $liveNewCommentGiftStatus = $getliveCommentsLive['live_donate_type'];
   $liveNewCommentUserAvatar = $Dot->Dot_UserAvatar($liveNewCommentUidFk, $base_url) ;
   if($liveNewCommentStartStatus == '1'){
		 $liveNewComment = $page_Lang['started_live_video'][$dataUserPageLanguage];
   }  
   $cVerifiedBadge ='';
   if($liveNewCommentVerifiedStatus){
	   $cVerifiedBadge = '<span class="CmewfM Szr5J  coreSpriteVerifiedBadgeSmall icons" title="'.$page_Lang['verified'][$dataUserPageLanguage].'"></span>';
	}
   if(!empty($liveNewCommentID) && ($liveNewCommentID != $lastCommendID)){ 
      $json = array();
	  $data = array(
	     'commentid' => $liveNewCommentID,
		 'commentUsername' => $liveNewCommentUserName,
		 'userAvatar' => $liveNewCommentUserAvatar, 
		 'userFullName' => $liveNewCommentUserFullName,
		 'verifiedUser' => $liveNewCommentVerifiedStatus,
		 'gift' => $liveNewCommentGiftStatus,
		 'giftNote' => $page_Lang['send_you_a_gift'][$dataUserPageLanguage],
		 'giftSticker' => 'heart-gift2.gif',
		 'LiveComment' => strip_unsafe(styletext(congract($liveNewComment))),
		 'subscribers' => $Dot->Dot_OnlineLiveVideoUserCount($uid,$liveVideoID),
		 'likes' => $Dot->Dot_CountLikeLiveVideo($liveVideoID)
		 ); 
	  $result =  json_encode( $data , JSON_UNESCAPED_UNICODE);	
	  echo preg_replace('/,\s*"[^"]+":null|"[^"]+":null,?/', '', $result);
   }  
}
}
if($activity == 'live_subslike'){
	if(isset($_POST['idc'])){
		  $liveVideoID = mysqli_real_escape_string($db, $_POST['idc']);
		  $json = array();
		  $data = array( 
			 'subscribers' => $Dot->Dot_OnlineLiveVideoUserCount($uid,$liveVideoID),
			 'likes' => $Dot->Dot_CountLikeLiveVideo($liveVideoID),
			 'commentsl' => $Dot->Dot_GetCommentStatus($liveVideoID),
			 'likeStatus' => $Dot->Dot_GetLikeLiveStatus($liveVideoID),
			 'donateStatus' => $Dot->Dot_GetDonatetLiveStatus($liveVideoID),
			 'liveFilter' => $Dot->Dot_GetFilterLiveStatus($liveVideoID)
			 ); 
		  $result =  json_encode( $data , JSON_UNESCAPED_UNICODE);	
		  echo preg_replace('/,\s*"[^"]+":null|"[^"]+":null,?/', '', $result);
	}
}
if($activity == 'ups'){
	if(isset($_POST['idc'])){
		 $liveVideoID = mysqli_real_escape_string($db, $_POST['idc']); 
		 $Dot->Dot_UpdateLiveTime($uid, $liveVideoID);
	}
}
if($activity == 'live_comment_own'){
if(isset($_POST['idc'])){
   $liveVideoID = mysqli_real_escape_string($db, $_POST['idc']); 
   $getliveComments = $Dot->Dot_CheckNewLiveVideoCommentLatest($liveVideoID);
    $liveNewCommentID = $getliveComments['live_comment_id'];
   if($liveNewCommentID){ 
			$liveNewCommentID = $getliveComments['live_comment_id'];
		    $liveNewCommentUidFk = $getliveComments['live_comment_uid_fk'];
			$liveNewComment = $getliveComments['live_video_comment'];  
			$liveNewCommentUserName = $getliveComments['user_name'];
			$liveNewCommentUserFullName = $getliveComments['user_fullname'];
			$liveNewCommentVerifiedStatus = $getliveComments['verified_user'];
			$liveNewCommentStartStatus = $getliveComments['start_live'];
			$liveNewCommentUserAvatar = $Dot->Dot_UserAvatar($liveNewCommentUidFk, $base_url) ;
			if($liveNewCommentStartStatus == '1'){
			    $liveNewComment = $page_Lang['started_live_video'][$dataUserPageLanguage];
			}
			$cVerifiedBadge ='';
			if($liveNewCommentVerifiedStatus){
			   $cVerifiedBadge = '<span class="CmewfM Szr5J  coreSpriteVerifiedBadgeSmall icons" title="'.$page_Lang['verified'][$dataUserPageLanguage].'"></span>';
			}
?> 
<!---->
<div class="gElp9 eo2As cUq_<?php echo $liveNewCommentID;?>" id="<?php echo $liveNewCommentID;?>">
  <div class="commentBody_w">
    <!--Commented User Avatar STARTED-->
    <div class="comment_avatar" id="1">
      <a href="<?php echo $base_url;?>profile/<?php echo $liveNewCommentUserName;?>"><img class="_6q-tv" src="<?php echo $liveNewCommentUserAvatar;?>" alt="<?php echo $liveNewCommentUserFullName;?>"></a>
    </div>
    <!--Commented User Avatar FINISHED-->
    <!--Comment and Username STARTED-->
    <div class="o-MQd simg" id="ed_com_<?php echo $liveNewCommentID;?>">
      <a class="FPmhX" title="<?php echo $liveNewCommentUserFullName;?>" href="<?php echo $base_url;?>profile/<?php echo $liveNewCommentUserName;?>"><?php echo $liveNewCommentUserFullName;?></a>
      <?php echo $cVerifiedBadge;?>
      <div class="commentitem_" data-linkify="this" data-linkify-target="_target"> <?php echo sanitize_output($liveNewComment);?> </div>
      <div class="uv"> </div>
    </div>
    <!--Comment and Username FINISHED-->
  </div>

</div>
<!----> 
<?php }}
}
}
?>