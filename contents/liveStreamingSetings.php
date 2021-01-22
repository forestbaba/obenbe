<div class="lvSettingsContainer">
    <div class="lvStreamingWrapper">
        <div class="globalBoxHeader"><?php echo $page_Lang['live_s_settings'][$dataUserPageLanguage];?> <div class="closeLset"><?php echo $Dot->Dot_SelectedMenuIcon('close_icons');?></div></div>
        <div class="lvSetC"> 
             <!---->
             <div class="lvSLctWrapper">
                <label for="liveComments">
                    <input type="checkbox" class="notChangeLive" post-type="securityLiveComment" post-not="liveComments" id="liveComments" value="0">
                    <span><?php echo $page_Lang['live_s_comment_status'][$dataUserPageLanguage];?></span>
                  </label>
             </div> 
             <!---->
             <!---->
             <div class="lvSLctWrapper">
                <label for="likeStatusl">
                    <input type="checkbox" class="notChangeLive" post-type="securityLiveLike" post-not="likeStatusl" id="likeStatusl" value="0">
                    <span><?php echo $page_Lang['live_s_like_status'][$dataUserPageLanguage];?></span>
                  </label>
             </div>
             <!---->
             <!---->
             <div class="lvSLctWrapper">
                <label for="donateStatusl">
                    <input type="checkbox" class="notChangeLive" post-type="securityDonatiion" post-not="donateStatusl" id="donateStatusl" value="0">
                    <span><?php echo $page_Lang['live_s_donation_status'][$dataUserPageLanguage];?></span>
                  </label>
             </div>
             <div class="lvtit"><?php echo $page_Lang['live_s_comission_note'][$dataUserPageLanguage];?></div>
             <!---->  
        </div>
        <!---->
         <div class="globalBoxHeader"><?php echo $page_Lang['live_s_video_filters'][$dataUserPageLanguage];?></div>
         <div class="lvSetC"> 
             <?php 
			 $filters = $Dot->Dot_Filters();
			 if($filters){
			    foreach($filters as $ff){
			         $filterID = $ff['id'];
					 $filterKey = $ff['fkey'];
				echo '
				<div class="v_filter_item" id="filter-'.$filterKey.'" data-filter="'.$filterKey.'">
					<div class="filter-'.$filterKey.'">
						<div class="v_filter" style="background-image:url('.$dataUserAvatar.');"></div>
					</div>
                 </div>
				';
				}
			 }
			 ?>
               
         </div>
        <!---->
    </div>
</div>