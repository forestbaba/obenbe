<?php 
include("functions/inc.php");
if(empty($uid)){
   header("Location: $base_url");   
}
$page = 'liveStreaming';
include("contents/header.php");
?> 
<div class="video-con goLiveContainer" id="1">
	<div class="MyLiveContainer">
		<div id="remote-media">
           <!---->
           <div class="lvSetting" style="display:none;">
              <?php echo $Dot->Dot_SelectedMenuIcon('live_streaming_settings');?>
           </div>
           <!---->
			<div class="liv_counter" style="display:none;"><?php echo $Dot->Dot_SelectedMenuIcon('live_streaming_count');?> <span class="live_count" id="live_count">0</span></div>
			<div class="liv_vid_cont"><div class="filtvid" id="main_live_video"></div></div> 
			<div id="live_post_comments" class="liv_comments_feed">
                <div class="live_comments_container">
                     <div class="comments_wall">
                        <div class="comments_wall_container">
                             <div class="all_live_comments">
                                
                             </div>
                         </div>
                     </div> 
                     <span class="likeHearts"></span>
                     <div class="comment_wall" style="display:none;">
                         <div class="commentFeats">
                             <span class="sendLiveDonate dlimam" data-type="donateLiveFrm" ><?php echo $Dot->Dot_SelectedMenuIcon('send_live_stream_donation');?></span>
                             <span class="sendLiveLike"><?php echo $Dot->Dot_SelectedMenuIcon('heart_live_video');?></span> 
                             <span class="sendLiveComment" style="display:none;"><?php echo $Dot->Dot_SelectedMenuIcon('send_live_comment');?></span>
                         </div>
                         <input type="text" class="live_comment_m" id="typ" placeholder="<?php echo $page_Lang['live_streaming_comment'][$dataUserPageLanguage];?>" />
                     </div>
                </div>
            </div>
		</div>
		<a class="end_vdo_call end_live_btn hidden" href="<?php echo $base_url;?>" onclick="DeleteLive()">
			<?php echo $Dot->Dot_SelectedMenuIcon('close_live_streaming');?> <?php echo $page_Lang['end_live'][$dataUserPageLanguage];?>
		</a>
		<button class="btn-success start_vdo_call go_live_btn" id="publishBtn"><?php echo $Dot->Dot_SelectedMenuIcon('video_live');?> <?php echo $page_Lang['start_live'][$dataUserPageLanguage];?></button>
	</div>
	<input type="hidden" id="live_post_id"> 
 <!---->
<?php include("contents/liveStreamingSetings.php");?>
 <!---->   
</div>    
<?php 
// Here is some javascript codes
include("contents/javascripts_vars.php"); 
?> 
<?php if($agoreStatus == '1' && !empty($agoraAppID)){?>  
<script type="text/javascript">
	var rand = <?php echo rand(1111111,9999999); ?>; 
	function ready() { 
	  let pubBtn = document.getElementById('publishBtn');
	  if (pubBtn) {
	    pubBtn.onclick = evt => {
	      startAgoraBroadcast();
	    };
	  } 
	  getMedia()
	    .then(str => {
	      stream     = str;
	      //set cam feed to video window so user can see self.
	      let vidWin = document.getElementsByTagName('video')[0];
	      if (vidWin) { 
	        $('#basic-stream').removeClass('hidden'); 
	        vidWin.srcObject = stream; 
	      }
	    })
	    .catch(e => {
	      $('#remote-media').html('<div class="empty_state"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M3.27,2L2,3.27L4.73,6H4A1,1 0 0,0 3,7V17A1,1 0 0,0 4,18H16C16.2,18 16.39,17.92 16.54,17.82L19.73,21L21,19.73M21,6.5L17,10.5V7A1,1 0 0,0 16,6H9.82L21,17.18V6.5Z" fill="currentColor"></path></svg> getUserMedia Error: '+e+'</div>');
	    });
	} 
var agoraAppId = '<?php echo $agoraAppID;?>'; // set app id
var channelName = "stream_<?php echo $uid;?>_"+rand; // set channel name

// create client instance
var client = AgoraRTC.createClient({mode: 'live', codec: 'vp8'}); // h264 better detail at a higher motion
var mainStreamId; // reference to main stream
 
var cameraVideoProfile = '720p_6'; // 960 × 720 @ 30fps  & 750kbs

// keep track of streams
var localStreams = {
  uid: rand,
  camera: {
    camId: '',
    micId: '',
    stream: {}
  }
};

// keep track of devices
var devices = {
  cameras: [],
  mics: []
}

var externalBroadcastUrl = '';

// default config for rtmp
var defaultConfigRTMP = {
  width: 640,
  height: 360,
  videoBitrate: 400,
  videoFramerate: 15,
  lowLatency: false,
  audioSampleRate: 48000,
  audioBitrate: 48,
  audioChannels: 1,
  videoGop: 30,
  videoCodecProfile: 100,
  userCount: 0,
  userConfigExtraInfo: {},
  backgroundColor: 0x000000,
  transcodingUsers: [],
};

// set log level:
// -- .DEBUG for dev 
// -- .NONE for prod
AgoraRTC.Logger.setLogLevel(AgoraRTC.Logger.DEBUG); 

// init Agora SDK
function startAgoraBroadcast() {
	client.init(agoraAppId, function () {
	  console.log('AgoraRTC client initialized');
	  joinChannel(); // join channel upon successfull init
	}, function (err) {
	  console.log('[ERROR] : AgoraRTC client init failed', err);
	});
}


// client callbacks
client.on('stream-published', function (evt) {
  console.log('Publish local stream successfully');
});

// when a remote stream is added
client.on('stream-added', function (evt) {
  console.log('new stream added: ' + evt.stream.getId());
});

client.on('stream-removed', function (evt) {
  var stream = evt.stream;
  stream.stop(); // stop the stream
  stream.close(); // clean up and close the camera stream
  console.log("Remote stream is removed " + stream.getId());
});

//live transcoding events..
client.on('liveStreamingStarted', function (evt) {
  console.log("Live streaming started");
}); 

client.on('liveStreamingFailed', function (evt) {
  console.log("Live streaming failed");
}); 

client.on('liveStreamingStopped', function (evt) {
  console.log("Live streaming stopped");
});

client.on('liveTranscodingUpdated', function (evt) {
  console.log("Live streaming updated");
}); 

// ingested live stream 
client.on('streamInjectedStatus', function (evt) {
  console.log("Injected Steram Status Updated");
  console.log(JSON.stringify(evt));
}); 

// when a remote stream leaves the channel
client.on('peer-leave', function(evt) {
  console.log('Remote stream has left the channel: ' + evt.stream.getId());
});

// show mute icon whenever a remote has muted their mic
client.on('mute-audio', function (evt) {
  console.log('Mute Audio for: ' + evt.uid);
});

client.on('unmute-audio', function (evt) {
  console.log('Unmute Audio for: ' + evt.uid);
});

// show user icon whenever a remote has disabled their video
client.on('mute-video', function (evt) {
  console.log('Mute Video for: ' + evt.uid);
});

client.on('unmute-video', function (evt) {
  console.log('Unmute Video for: ' + evt.uid);
});

// join a channel
function joinChannel() {
  var token = generateToken();
  var userID = 0; // set to null to auto generate uid on successfull connection
  
  // set the role
  client.setClientRole('host', function() {
    console.log('Client role set as host.');
  }, function(e) {
    console.log('setClientRole failed', e);
  });
  
  
  // client.join(token, 'allThingsRTCLiveStream', 0, function(uid) {
  client.join(token, channelName, userID, function(uid) { 
      createCameraStream(uid, {});
      localStreams.uid = uid; // keep track of the stream uid  
      console.log('User ' + uid + ' joined channel successfully');
      $('#main_live_video').html('')
	  $('#publishBtn').removeAttr('disabled');
      $('#publishBtn').text("Lütfen Bekleyin");
      $('#publishBtn').hide();
      $('.end_vdo_call').show(); 
	  
		var type ='live';		  
		var data = 'f='+type+'&stream_name='+channelName;		  
		$.ajax({
            type: "POST",
            url: requestUrl + "requests/activity",
            dataType: "json",
            data: data,
            cache: false,
            beforeSend: function() {
				
            },
            success: function(response) {
		    var vid = response.post_id;  
		      $('#live_post_id').val(vid);
			  OwnerMessage(vid); 
			  startLiveComment();
			  $(".lvSetting , .liv_counter , .comment_wall").show();
		}
	    }); 
  }, function(err) {
      console.log('[ERROR] : join channel failed', err);
  });
}

// video streams for channel
function createCameraStream(uid, deviceIds) {
  console.log('Creating stream with sources: ' + JSON.stringify(deviceIds));

  var localStream = AgoraRTC.createStream({
    streamID: uid,
    audio: true,
    video: true,
    screen: false
  });
  localStream.setVideoProfile(cameraVideoProfile);

  // The user has granted access to the camera and mic.
  localStream.on("accessAllowed", function() {
    if(devices.cameras.length === 0 && devices.mics.length === 0) {
      console.log('[DEBUG] : checking for cameras & mics');
      getCameraDevices();
      getMicDevices();
    }
    console.log("accessAllowed");
  });
  // The user has denied access to the camera and mic.
  localStream.on("accessDenied", function() {
    console.log("accessDenied");
  });

  localStream.init(function() {
    console.log('getUserMedia successfully');
    $('#main_live_video').html('')
    localStream.play('main_live_video'); // play the local stream on the main div
    // publish local stream

    client.publish(localStream, function (err) {
      console.log('[ERROR] : publish local stream error: ' + err);
    });

    localStreams.camera.stream = localStream; // keep track of the camera stream for later
  }, function (err) {
    console.log('[ERROR] : getUserMedia failed', err);
  });
}

// use tokens for added security
function generateToken() {
  return null; // TODO: add a token generation
}
</script> 
<script>
  window.onbeforeunload = function() {
  DeleteLive();
 }
function startLiveComment(){
var main_live = setInterval(function(){ 
/*if ($('#live_post_id').val) { 
   clearInterval(main_live);
} */
	var type ='live_comment';		   
if ($('#live_post_id').val() && $('.eo2As').length > 0) {
	
	var liveVideo = $("#live_post_id").val(); 
      
	var lastCom = $(".eo2As:last").attr("id");
	if(lastCom.length == 0){
	    var lastCom = '';
	}
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
}, 3100);
} 
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
					$(".sendLiveLike").unbind('click');
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
					      $("#main_live_video").removeClass().addClass("filtvid " + livesFilter);
					}
				 }
		  }
	}); 
}
}, 3000); 

var main_onStatus = setInterval(function(){ 
if ($('#live_post_id').length == 0) {
    clearInterval(main_onStatus);
}
var type ='ups';	  
if ($('#live_post_id').val() != 0) {
	var liveVideo = $("#live_post_id").val();
	  
	var data = 'f='+type+'&idc='+liveVideo;
     $.ajax({
		  type: 'POST',
		  url: requestUrl + 'contents/live_video_comment', 
		  data: data,
		  cache: false,
		  beforeSend: function() {   },
		  success: function(response) { 
			 
		  }
	}); 
}
}, 50000);

function OwnerMessage(post_id){
	var type ='live_comment_own';
	var data = 'f='+type+'&idc='+post_id;
     $.ajax({
		  type: 'POST',
		  url: requestUrl + 'contents/live_video_comment', 
		  data: data,
		  cache: false,
		  beforeSend: function() {   },
		  success: function(response) { 
				 $(".all_live_comments").html(response);
		  }
	}); 
}
function DeleteLive() {
  post_id = $('#live_post_id').val();
  $.post(requestUrl + "requessts/activity?f=live&s=delete", {post_id: post_id}, function(data, textStatus, xhr) {});
}



navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia;
if (!navigator.getUserMedia) {
  $('#remote-media h3').text('Sorry, WebRTC is not available in your browser.');
}




function getMedia() {
  return new Promise((resolve, reject) => { 

    let constraints = {audio: true, video: true};
    navigator.mediaDevices.getUserMedia(constraints)
      .then(str => {
        resolve(str);
		$('#remote-media h3').addClass('hidden');
        $('#remote-media .liv_vid_cont .filtvid').html('<div style="width: 100%; height: 100vh; position: relative; background-color: black; overflow: hidden;"><video  id="basic-stream" class="hidden videostream" style="width: 100%; height: 100vh; position: relative; transform: rotateY(180deg); object-fit: cover;" autoplay="" muted="" playsinline=""></video></div>');
      }).catch(err => {
      $('#remote-media h3').text('Could not get Media: '+err);
      reject(err);
    })
  });
}

if (navigator.getUserMedia) {
  ready();
}

$('body').on('input','.live_comment_m', function(){
    if ($(this).val().length > 1) {
		$(".sendLiveComment").show();  
	} else {
        $(".sendLiveComment").hide(); 
    }
});
$(document).ready(function(){ 
    setInterval(function () {
        var checkLikeSum = $(".goLiveContainer").attr("id");
        if(checkLikeSum !=  0){
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
$(window).bind("beforeunload", function() { 
    return alertMe(); 
});

function alertMe(){
var type = 'disableLive';
    var liveVideo = $("#live_post_id").val(); 
	var data = 'f='+type+'&idc='+liveVideo;		  
	  $.ajax({
            type: "POST",
            url: requestUrl + "requests/activity", 
            data: data,
			async : false,
            cache: false,
            beforeSend: function() { 
            },
            success: function(response) { 
			
		  }
	}); 
}
$("body").on("click",".lvSetting", function(){
    $(".lvSettingsContainer").show();
});
$("body").on("click",".closeLset", function(){
    $(".lvStreamingWrapper").addClass('outstreraml');
	setTimeout(function () {
      $(".lvSettingsContainer").hide();
	  $(".lvStreamingWrapper").removeClass("outstreraml");
    }, 900);
});
// Change Notifications
$("body").on("click",".notChangeLive", function(){
   var type = $(this).attr("post-type");
   var type_two = $("#live_post_id").val();
   var post_note = $(this).attr("post-not");
   var notChange = $(this).val();   
	   var dataNot = 'f='+type+'&liveStream='+type_two+'&notit='+encodeURIComponent(notChange);
	   $.ajax({
		  type: 'POST',
		  url: requestUrl + 'requests/activity', 
		  dataType: "json",
		  data: dataNot,
		  cache: false,
		  beforeSend: function() {
			  $("#"+post_note+"a").after('<span class="preloadCom" style="margin-top: -40px;"><span class="progress"><span class="indeterminate"></span></span></span>'); 
		  },
		  success: function(response) {  
				   $(".preloadCom").remove();    
					if(notChange == '0'){
					   $("#"+post_note).val('1');
					}
					if(notChange == '1'){
					   $("#"+post_note).val('0');
					}  
				var responseNote = response.note;
				M.toast({html: responseNote}); 
		  }
		});  
});
$("body").on("click",".v_filter_item", function(){
	var type = 'livfilt';
   var filter = $(this).attr("id");
   var type_two = $("#live_post_id").val();
   $("#main_live_video").removeClass().addClass("filtvid " + filter);
   var data = 'f='+type+'&fil='+filter+'&liveStream='+type_two;
   $.ajax({
		type: "POST",
		url: requestUrl + "requests/activity", 
		data: data,
		async : false,
		cache: false,
		beforeSend: function() { 
		},
		success: function(response) { 
		
	  }
	}); 
});

});
</script>
<?php }?>
</body>
</html>