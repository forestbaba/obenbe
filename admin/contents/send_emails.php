<div class="page_title bold"><?php echo $page_Lang['send_emails'][$dataUserPageLanguage]; ?></div>
<!--Create Announcement STARTED-->
<div class="global_right_wrapper">
   <div class="global_box_container_w bgc">
        <div class="general_settings_header_title"><?php echo $page_Lang['send_email_to_users'][$dataUserPageLanguage];?></div>
        <div class="row-box-container" id="set_profile">  
               <!---->
               <span class="setting-box"> 
                   <span class="setSettinginputTitle"><?php echo $page_Lang['send_email_subject'][$dataUserPageLanguage];?></span>  
                   <div class="column_set_input_box"><input type="text" class="column_inputField chng" id="emailSubject" placeholder="<?php echo $page_Lang['write_a_email_subject'][$dataUserPageLanguage];?>"></div>
               </span>
               <!----> 
               <!---->
               <span class="setting-box"> 
                   <span class="setSettinginputTitle"><?php echo $page_Lang['message_html_allowed'][$dataUserPageLanguage];?></span>  
                   <div class="column_set_input_box"><textarea class="column_textarea chng" id="emailMessage" style="overflow: hidden; word-wrap: break-word; resize: none; height: 86px;"></textarea></div>
               </span>
               <!----> 
              <!---->
                <div class="setting-box-global" style="margin-top:20px;">
                     <span class="input-field col s12">
                        <select class="sendEmailTo" id="sendemailto"> 
                          <option value="for_a_week" selected="selected"><?php echo $page_Lang['who_did_not_login_for_a_week'][$dataUserPageLanguage];?></option>
                          <option value="for_a_month"><?php echo $page_Lang['who_did_not_login_for_a_month'][$dataUserPageLanguage];?></option>
                          <option value="for_a_tree_month"><?php echo $page_Lang['who_did_not_login_for_a_tree_month'][$dataUserPageLanguage];?></option>
                          <option value="for_a_six_month"><?php echo $page_Lang['who_did_not_login_for_a_six_month'][$dataUserPageLanguage];?></option>
                          <option value="for_a_nine_month"><?php echo $page_Lang['who_did_not_login_for_a_nine_month'][$dataUserPageLanguage];?></option>
                          <option value="for_a_year"><?php echo $page_Lang['who_did_not_login_for_a_year'][$dataUserPageLanguage];?></option>
                          <option value="for_a_active"><?php echo $page_Lang['activated_emails'][$dataUserPageLanguage];?></option>
                          <option value="for_a_inactive"><?php echo $page_Lang['inactivated_emails'][$dataUserPageLanguage];?></option>
                          <option value="for_a_all"><?php echo $page_Lang['all_data_users'][$dataUserPageLanguage];?></option>
                          <option value="for_a_pro_members"><?php echo $page_Lang['all_pr_users'][$dataUserPageLanguage];?></option>
                          <option value="for_a_normal_members"><?php echo $page_Lang['all_normal_users'][$dataUserPageLanguage];?></option>
                          <option value="for_a_online"><?php echo $page_Lang['all_online_users'][$dataUserPageLanguage];?></option>
                          <option value="for_a_offline"><?php echo $page_Lang['all_offline_users'][$dataUserPageLanguage];?></option>
                          <option value="test_email">Test Mail (The message will sent to Test Email only)</option>
                        </select> 
                      </span>
                </div>
                <!---->
               <!----> 
               <div class="setting-box">
                   <div class="column-set_input_box">
                       <div class="saveTheSettings btn waves-effect waves-light blue sendTheEmail"  data-type="send_emails"><?php echo $page_Lang['share_new_announcement'][$dataUserPageLanguage];?></div>
                   </div>
               </div>
               <!----> 
        </div> 
   </div>
</div> 
<!--Create announcement FINISSHED--> 
<script type="text/javascript">
$(document).ready(function(){
	function AutoTiseTextArea(){
     autosize(document.querySelectorAll('textarea'));
   }
   AutoTiseTextArea();
   $("body").on("click",".sendTheEmail", function(){
	    var type = 'send_emails';
		var announcementType = $("#sendemailto").val();
		var announceTitle = $("#emailSubject").val();
		var announceText = $("#emailMessage").val();
		var data = 'f='+type+'&post_type_email='+announcementType+'&subject='+announceTitle+'&emessage='+announceText;
		$.ajax({
			type: 'POST',
			url: requestUrl + "admin/requests/request",
			data: data,
			cache: false,
			beforeSend: function() { $("#set_profile").append('<span class="preloadCom"><span class="progress"><span class="indeterminate"></span></span></span>'); },
			success: function(response) {   
				$(".preloadCom").remove();  
				M.toast({html: response});  
			}
		 });
    });
});
</script>