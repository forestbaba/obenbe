<div class="currentLiveVideosWrapper">
<div class="liveRoomTitle">
<div class="roomsL"><?php echo $page_Lang['live_broadcasts'][$dataUserPageLanguage];?></div>
<a href="<?php echo $base_url;?>mylive"><?php echo $page_Lang['create_a_live_stream'][$dataUserPageLanguage];?></a>
</div>
<div class="allLivVideos">
<?php include("live_video_list.php");?>
</div>
</div>