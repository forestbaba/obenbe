<?php  
include_once("../functions/inc.php");
if(isset($_POST['idc'])){
   $liveVideoID = mysqli_real_escape_string($db, $_POST['idc']);
   $getliveComments = $Dot->Dot_CheckNewLiveVideoCommentAll($liveVideoID);
   if($getliveComments){
	    foreach($getliveComments as $liveCo){
			$liveNewCommentID = $liveCo['live_comment_id'];
		    $liveNewCommentUidFk = $liveCo['live_comment_uid_fk'];
			$liveNewComment = $liveCo['live_video_comment'];  
			$liveNewCommentUserName = $liveCo['user_name'];
			$liveNewCommentUserFullName = $liveCo['user_fullname'];
			$liveNewCommentVerifiedStatus = $liveCo['verified_user'];
			$liveNewCommentStartStatus = $liveCo['start_live'];
			$liveNewCommentUserAvatar = $Dot->Dot_UserAvatar($liveNewCommentUidFk, $base_url) ;
			if($liveNewCommentStartStatus == '1'){
			    $liveNewComment = 'Started a Live Video';
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
      <span class="CmewfM Szr5J  coreSpriteVerifiedBadgeSmall icons" title="Doğrulanmış"></span>
      <div class="commentitem_" data-linkify="this" data-linkify-target="_target"> <?php echo $liveNewComment;?> </div>
      <div class="uv"> </div>
    </div>
    <!--Comment and Username FINISHED-->
  </div>

</div>
<!----> 
<?php }}}
?> 