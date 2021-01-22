<?php 
include("functions/inc.php");
if(empty($uid)){
   header("Location: $base_url");   
}
$page = 'liveStreaming';
include("contents/header.php");
if(isset($_GET['username'])) { 
$username= mysqli_real_escape_string($db, $_GET['username']); 
include_once 'functions/get_profile.php'; 

$liveChannel = $Dot->Dot_GetLivingVideo($profileUserID);
$liveChannelName = $liveChannel['live_channel'];
$liveID = $liveChannel['live_id'];
if($liveID){
  $insertOnline = $Dot->Dot_InsertMyOnlineStatus($uid, $liveID);
} 
	if(empty($profileUserID)) {   
		  header("Location:".$base_url."sources/not-found.php");   
	}
}else{
      header("Location:".$base_url."sources/not-found.php");   
}
?> 
<div class="video-con goLiveContainer" id="0">
	<div class="MyLiveContainer">
		<div id="remote-media">
			<div class="liv_counter"><?php echo $Dot->Dot_SelectedMenuIcon('live_streaming_count');?> <span class="live_count" id="live_count"> 0</span></div> 
            <div class="liv_vid_cont"><div class="filtvid" id="post_live_video"></div></div> 
			<div id="live_post_comments" class="liv_comments_feed">
                <div class="live_comments_container">
                     <div class="comments_wall">
                        <div class="comments_wall_container">
                            <div class="all_live_comments">
                                
                             </div>
                         </div>
                     </div>
                     <span class="likeHearts"></span>
                     <div class="comment_wall">
                         <div class="commentFeats">
                             <span class="sendLiveDonate dlimam" data-type="donateLiveFrm" data-u="<?php echo $profileUserID;?>"><?php echo $Dot->Dot_SelectedMenuIcon('send_live_stream_donation');?></span>
                             <span class="sendLiveLike"><?php echo $Dot->Dot_SelectedMenuIcon('heart_live_video');?></span>
                             <span class="sendLiveComment" style="display:none;"><?php echo $Dot->Dot_SelectedMenuIcon('send_live_comment');?></span>
                         </div>
                         <input type="text" class="live_comment_m" id="typ" placeholder="<?php echo $page_Lang['live_streaming_comment'][$dataUserPageLanguage];?>" />
                     </div>
                </div>
            </div>
		</div> 
	</div>
	<input type="hidden" id="live_post_id" value="<?php echo $liveID;?>">
</div>
<?php 
// Here is some javascript codes
include("contents/javascripts_vars.php"); 
?>
<!--
************************
************************
************************
************************
-->
<?php if($liveID){?>
<script type="text/javascript">
RunLiveAgora("<?php echo $liveChannelName;?>","post_live_video");
var main_live = setInterval(function(){ 
if ($('#live_post_id').length == 0) {
    clearInterval(main_live);
}
	var type ='live_comment';		  
if ($('#live_post_id').val() != 0) {
	var liveVideo = $("#live_post_id").val();
	var lastCom = $(".eo2As:last").attr("id");
	
	var data = 'f='+type+'&idc='+liveVideo+'&lc='+lastCom;		  
	  $.ajax({
            type: "POST",
            url: requestUrl + "contents/live_video_comment",
            dataType: "json",
            data: data,
            cache: false,
            beforeSend: function() { 
            },
            success: function(response) {
				 var liveNewCommentID = response.commentid;
				 var liveNewCommentUserName = response.commentUsername;
				 var liveNewCommentUserAvatar = response.userAvatar;
				 var liveNewCommentUserName = response.userName;
				 var liveNewCommentUserFullName = response.userFullName;
				 var liveNewComment = response.LiveComment; 
				 var cVerifiedBadge = response.verifiedUser; 
				 var liveNewGift = response.gift;
				 var liveNewGiftNote = response.giftNote;
				 var liveNewGif = response.giftSticker;
				 var badge = '';
				 var giftBody = '';
				 if(liveNewGift){
					 var liveNewComment = liveNewGiftNote;
				     var giftBody = '<img src="'+requestUrl+'uploads/gifs/'+liveNewGif+'">';
				 }
				 if(cVerifiedBadge == 1){
				     var badge = '<span class="CmewfM Szr5J  coreSpriteVerifiedBadgeSmall icons"></span>';
				 }
				 if(liveNewComment || liveNewGift){  
				    $(".all_live_comments").append('<div class="gElp9 eo2As cUq_'+liveNewCommentID+'" id="'+liveNewCommentID+'"><div class="commentBody_w"><div class="comment_avatar" id="1"><a href="'+requestUrl+'profile/'+liveNewCommentUserName+'"><img class="_6q-tv" src="'+liveNewCommentUserAvatar+'"></a></div><div class="o-MQd simg" id="ed_com_'+liveNewCommentID+'"><a class="FPmhX" title="'+liveNewCommentUserFullName+'" href="'+requestUrl+'profile/'+liveNewCommentUserName+'">'+liveNewCommentUserFullName+'</a>'+badge+'<div class="commentitem_" data-linkify="this" data-linkify-target="_target">'+liveNewComment+'</div><div class="uvgf">'+giftBody+'</div></div></div></div>');
				 }  
		  }
	});  
}
}, 3000);
var main_live_like_subs = setInterval(function(){ 
if ($('#live_post_id').length == 0) {
    clearInterval(main_live_like_subs);
}
	var type ='live_subslike';		  
if ($('#live_post_id').val() != 0) {
	var liveVideo = $("#live_post_id").val();
	 
	var data = 'f='+type+'&idc='+liveVideo;		  
	  $.ajax({
            type: "POST",
            url: requestUrl + "contents/live_video_comment",
            dataType: "json",
            data: data,
            cache: false,
            beforeSend: function() { 
            },
            success: function(response) { 
				 var subscribers = response.subscribers;
				 var likes = response.likes; 
				 var coml = response.commentsl;
				 var likestat = response.likeStatus;
				 var donat = response.donateStatus;
				 var livesFilter = response.liveFilter;
				 $("#live_count").html(subscribers);
				 $(".goLiveContainer").attr('id',likes);
				 if(coml == 0){
				    $(".comments_wall_container").hide();
					document.getElementById("typ").disabled = true;
				 }else{
					 if( $(".comments_wall_container").css('display') == 'none')  {
					   $(".comments_wall_container").show();
					   document.getElementById("typ").disabled = false;
					 } 
				 }
				 if(likestat == 0){
				    $(".sendLiveLike , .likeHearts").hide();
					$(".sendLiveLike").bind('click', function(){ return false; });
				 }else{
				    $(".sendLiveLike , .likeHearts").show();
					$(".sendLiveLike").bind('click', function(){ return true; });
				 }
				 if(donat == 0){
				    $(".sendLiveDonate").hide();
					$(".sendLiveDonate").bind('click', function(){ return false; });
				 }else{
				    $(".sendLiveDonate").show();
					$(".sendLiveDonate").unbind('click');
				 }
				 if(livesFilter){
			        if($('.'+livesFilter).length == 0){
					      $("#post_live_video").removeClass().addClass("filtvid " + livesFilter);
					}
				 }
		  }
	}); 
}
}, 3000);
$('body').on('input','.live_comment_m', function(){
    if ($(this).val().length > 1) {
		$(".sendLiveComment").show();
		$(".sendLiveLike").addClass("sendLiveLike_move");
	} else {
        $(".sendLiveComment").hide();
		$(".sendLiveLike").removeClass("sendLiveLike_move");
    }
});
$(document).ready(function(){ 
    setInterval(function () {
        var checkLikeSum = $(".goLiveContainer").attr("id");
        if(checkLikeSum !=  0 ){
           // Init
            var rand = Math.floor(Math.random() * 100 + 15);
            var flows = ["flowOne", "flowTwo", "flowThree"];
            var colors = ["colOne", "colTwo", "colThree", "colFour", "colFive", "colSix"];
            var timing = (Math.random() * (1.3 - 1.0) + 1.0).toFixed(10);
            // Animate Particle 
              
             var count = '3';
            for (var i=0; i<count; i++){
              $('<div class="particle part-' + rand + " " + colors[Math.floor(Math.random() * 6)] + '" style="background-size:' + Math.floor(Math.random() * (30 - 22) + 22) + 'px;"></div>').appendTo(".likeHearts").css({animation:"" + flows[Math.floor(Math.random() * 3)] + " " + timing + "s linear"});
            }
            $(".part-" + rand).show();
            $(".goLiveContainer").attr("id",""+checkLikeSum-1+"");
            // Remove Particle
            setTimeout(function () {
              $(".part-" + rand).remove();
            }, timing * 1000 - 300);
                  }
    }, 150);  
});
</script>
<?php }?>
</body>
</html>