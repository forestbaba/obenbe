<div class="page_title bold"><?php echo $page_Lang['live_streamings_features'][$dataUserPageLanguage];?></div>
<div class="global_right_wrapper">
   <div class="global_box_container_w bgc">
      <div class="general_settings_header_title"><?php echo $page_Lang['live_streamings_statuses'][$dataUserPageLanguage];?></div>
         <div class="row-box-container">
                      <!---->
                       <span class="setting-box" id="lvwdth"> 
                          <span class="setSettingBoxInfoNoteBold"><?php echo $page_Lang['live_streaming_video_size'][$dataUserPageLanguage];?></span>
                           <span class="setSettingBoxText">
                             <div class="column_set_input_box">
                                 <div class="mailTypebox liveStreamWith" id="psl_1" data-val="1">
                                    <?php echo $liveStreamingVideoWithStatus == '1' ? "<div class='usingtype'  id='psl_1'></div>":""; ?> 
                                      <span class="setSettinginputTitle"><?php echo $page_Lang['in_the_middle'][$dataUserPageLanguage];?></span>
                                      <div class="mailTypeBoxContainer liveMiddle"></div>
                                 </div>
                                 <div class="mailTypebox liveStreamWith" id="psl_0" data-val="0">
                                 <?php echo $liveStreamingVideoWithStatus == '0' ? "<div class='usingtype' id='psl_0'></div>":""; ?> 
                                     <span class="setSettinginputTitle"><?php echo $page_Lang['full_page'][$dataUserPageLanguage];?></span>
                                      <div class="mailTypeBoxContainer liveFull"></div>
                                 </div>
                             </div>
                           </span>  
                       </span>
                       <!----> 
         </div> 
         <!---->
        <div class="general_settings_header_title_second">Agora API Settings</div>
        <!---->
        <!---->
        <div class="row-box-container" id="agora">
                <!---->
                <span class="setting-box">
                   <span class="setSettingBox">
                      <div class="ckbx-style-14">
                          <input type="checkbox" id="agoramode" class="gstf" name="agoramode" <?php echo $agoreStatus == '1' ? "checked='checked'":""; echo $agoreStatus == '0' ? "value='1'":"value='0'";?>><label for="agoramode"></label>
                      </div>
                   </span>
                   <span class="setSettingBoxText"><?php echo $page_Lang['agoramode'][$dataUserPageLanguage];?></span>
                   <span class="setSettingBoxInfoNote"><?php echo $page_Lang['agora_enable_disable_note'][$dataUserPageLanguage];?></span>
                 </span>
                <!---->
              <!---->
               <span class="setting-box"> 
                   <span class="setSettinginputTitle">Agora APP ID</span>  
                   <div class="column_set_input_box"><input type="text" class="column_inputField chng" id="agoraappid" placeholder="<?php echo $page_Lang['write_agora_app_id'][$dataUserPageLanguage];?>" value="<?php echo $agoraAppID;?>"></div>
               </span>
               <!---->
               <!---->
               <span class="setting-box"> 
                   <span class="setSettinginputTitle">Agora Customer ID</span>  
                   <div class="column_set_input_box"><input type="text" class="column_inputField chng" id="agoracustomerid" placeholder="<?php echo $page_Lang['write_agora_customer_id'][$dataUserPageLanguage];?>" value="<?php echo $agoraCustomerID;?>"></div>
               </span>
               <!---->
               <!---->
               <span class="setting-box"> 
                   <span class="setSettinginputTitle">Agora Certificate</span>  
                   <div class="column_set_input_box"><input type="text" class="column_inputField chng" id="agoracertificate" placeholder="<?php echo $page_Lang['write_agora_certificate'][$dataUserPageLanguage];?>" value="<?php echo $agoraCertificate;?>"></div>
               </span>
               <!----> 
               <!----> 
               <div class="setting-box">
                   <div class="column-set_input_box">
                       <div class="saveTheSettings btn waves-effect waves-light blue save_agora" data-type="agoreSet"><?php echo $page_Lang['save_news'][$dataUserPageLanguage];?></div>
                   </div>
               </div>
               <!----> 
        </div>
        <!---->
        <!---->
        <div class="general_settings_header_title_second">Amazon S3 Storage (To Save Live Videos On Amazon)</div>
        <!---->
        <!---->
        <div class="row-box-container" id="amazon">
              <!---->
                <span class="setting-box">
                   <span class="setSettingBox">
                      <div class="ckbx-style-14">
                          <input type="checkbox" id="amazonMode" class="gstf" name="amazonMode" <?php echo $amazonS3Status == '1' ? "checked='checked'":""; echo $amazonS3Status == '0' ? "value='1'":"value='0'";?>><label for="amazonMode"></label>
                      </div>
                   </span>
                   <span class="setSettingBoxText"><?php echo $page_Lang['amazon_save_mode'][$dataUserPageLanguage];?></span>
                   <span class="setSettingBoxInfoNote"><?php echo $page_Lang['amazon_save_mode_note'][$dataUserPageLanguage];?></span>
                 </span>
                <!---->
                   <!---->
                   <span class="setting-box"> 
                       <span class="setSettinginputTitle">Amazon Bucket Name</span>  
                       <div class="column_set_input_box"><input type="text" class="column_inputField chng" id="amazonbucketname" placeholder="<?php echo $page_Lang['write_amazon_s_name'][$dataUserPageLanguage];?>" value="<?php echo $amazonS3BucketName;?>"></div>
                   </span>
                   <!---->
                   <!---->
                   <span class="setting-box"> 
                       <span class="setSettinginputTitle">Amazon S3 Key</span>  
                       <div class="column_set_input_box"><input type="text" class="column_inputField chng" id="amazonskey" placeholder="<?php echo $page_Lang['write_amazon_s_key'][$dataUserPageLanguage];?>" value="<?php echo $amazonS3Key;?>"></div>
                   </span>
                   <!---->
                   <!---->
                   <span class="setting-box"> 
                       <span class="setSettinginputTitle">Amazon S3 Secret Key</span>  
                       <div class="column_set_input_box"><input type="text" class="column_inputField chng" id="amazonsskey" placeholder="<?php echo $page_Lang['write_amazon_ss_key'][$dataUserPageLanguage];?>" value="<?php echo $amazonS3SecretKey;?>"></div>
                   </span>
                   <!----> 
                   <!---->
                    <div class="setting-box-global" style="margin-top:10px;"> 
                         <span class="input-field col s12">
                            <select class="regions" id="regions"> 
                                  <option value="1" <?php echo $amazonS3Region == '1' ? "selected='selected'":"";?>>US East (N. Virginia)</option>
                                  <option value="2" <?php echo $amazonS3Region == '1' ? "selected='selected'":"";?>>US East (Ohio)</option>
                                  <option value="3" <?php echo $amazonS3Region == '1' ? "selected='selected'":"";?>>US West (N. California)</option>
                                  <option value="4" <?php echo $amazonS3Region == '1' ? "selected='selected'":"";?>>US West (Oregon)</option>
                                  <option value="5" <?php echo $amazonS3Region == '1' ? "selected='selected'":"";?>>Asia Pacific (Seoul)</option>
                                  <option value="6" <?php echo $amazonS3Region == '1' ? "selected='selected'":"";?>>Asia Pacific (Mumbai)</option>
                                  <option value="7" <?php echo $amazonS3Region == '1' ? "selected='selected'":"";?>>Asia Pacific (Singapore)</option>
                                  <option value="8" <?php echo $amazonS3Region == '1' ? "selected='selected'":"";?>>Asia Pacific (Sydney)</option>
                                  <option value="9" <?php echo $amazonS3Region == '1' ? "selected='selected'":"";?>>Asia Pacific (Tokyo)</option>
                                  <option value="10" <?php echo $amazonS3Region == '1' ? "selected='selected'":"";?>>Canada (Central)</option>
                                  <option value="11" <?php echo $amazonS3Region == '1' ? "selected='selected'":"";?>>EU (Frankfurt)</option>
                                  <option value="12" <?php echo $amazonS3Region == '1' ? "selected='selected'":"";?>>EU (Ireland)</option>
                                  <option value="13" <?php echo $amazonS3Region == '1' ? "selected='selected'":"";?>>EU (London)</option>
                                  <option value="14" <?php echo $amazonS3Region == '1' ? "selected='selected'":"";?>>South America (São Paulo)</option>
                            </select>
                            <label><?php echo $page_Lang['write_amazon_bucket_region'][$dataUserPageLanguage];?></label>
                          </span>
                    </div>
                    <!----> 
                     <!----> 
                       <div class="setting-box">
                           <div class="column-set_input_box">
                               <div class="saveTheSettings btn waves-effect waves-light blue amazonSet" data-type="amazonSet"><?php echo $page_Lang['save_news'][$dataUserPageLanguage];?></div>
                           </div>
                       </div>
                       <!----> 
        </div>
        <!---->
   </div>   
</div> 
<script type="text/javascript">
$(document).ready(function(){
$("body").on("click",".save_agora", function(){
	   var type = $(this).attr("data-type");
	   var agoraAppID = $("#agoraappid").val();
	   var agoraCustomerID = $("#agoracustomerid").val();
	   var agoraCertificate = $("#agoracertificate").val(); 
	   var data = 'f='+type+'&appid='+agoraAppID+'&customerid='+agoraCustomerID+'&certificate='+agoraCertificate;
	   $.ajax({
		  type: "POST",
		  url: requestUrl + 'admin/requests/request',
		  data: data,
		  cache: false,
		  beforeSend: function(){
			 $("#agora").append('<span class="preloadCom"><span class="progress"><span class="indeterminate"></span></span></span>');
		  },
		  success: function(response) {
			  $(".preloadCom").remove(); 
			  M.toast({html: response}); 
		  }
		});
});
$("body").on("click",".amazonSet", function(){
   var type = $(this).attr("data-type");
   var bucketName = $("#amazonbucketname").val();
   var amazonKey = $("#amazonskey").val();
   var amazonSKey = $("#amazonsskey").val();
   var amazonRegion = $("#regions").val();
   var data = 'f='+type+'&bucketName='+encodeURIComponent(bucketName)+'&amazonKey='+encodeURIComponent(amazonKey)+'&amazonskey='+encodeURIComponent(amazonSKey)+'&region='+amazonRegion;
   $.ajax({
		  type: "POST",
		  url: requestUrl + 'admin/requests/request',
		  data: data,
		  cache: false,
		  beforeSend: function(){
			 $("#amazon").append('<span class="preloadCom"><span class="progress"><span class="indeterminate"></span></span></span>');
		  },
		  success: function(response) {
			  $(".preloadCom").remove(); 
			  M.toast({html: response}); 
		  }
   });
});
});
</script>