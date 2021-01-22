<div class="page_title bold"><?php echo $page_Lang['manage_live_streamings'][$dataUserPageLanguage];?></div>
<div class="global_right_wrapper">
   <div class="global_box_container_users">
         
        <div class="divTableBody newboys" style="display:none;"></div>
           <div class="divTableBody old_Key" id="moreType" data-type="user_langs"> 
                 <div class="earnings_statistics">
                 <div class="declined_paymnt_table">
                 
 <?php  
$limit = '10';
$countSql = "SELECT COUNT(live_id) FROM dot_live WHERE live_status IN('0','1')";  
$tot_result = mysqli_query($db, $countSql);   
$row = mysqli_fetch_row($tot_result);  
$total_records = $row[0];  
$total_pages = ceil($total_records / $limit);

//for first time load data
if (isset($_GET["page-id"])) { $pagep  = $_GET["page-id"]; } else { $pagep=1; };  

$start_from = ($pagep-1) * $limit;  
$sql = "SELECT * FROM dot_live WHERE live_status IN('0','1') ORDER BY live_id ASC LIMIT $start_from, $limit";  
$rs_result = mysqli_query($db, $sql); 
?>
<table class="striped highlight">
    <thead>
      <tr>
        <th>Live ID</th>
        <th>Stream Name</th>   
        <th>Started At</th> 
        <th>Ended At</th>
        <th>Action</th> 
      </tr>
    </thead>  

<tbody id="target-content">
<?php  
while ($row = mysqli_fetch_assoc($rs_result)) {
	 $liveID = $row['live_id'];
	 $liveCreatorUserID = $row['live_uid_fk'];
	 $liveStartedAt = $row['started_at'];
	 $liveEndTime = $row['live_time']; 
	 $liveEndedStarted= 'Living';
	 if($liveEndTime < time() - 2){
	    $liveEndedStarted= '<div class="see_time timeago" title="'.date("c", $liveEndTime).'"></div>';
	 }
	 $liveStarteminStarted=date("c", $liveStartedAt);
	 $liveCreatorUserAvatar = $Dot->Dot_UserAvatar($liveCreatorUserID, $base_url);
	 $liveCreatorUserName = $Dot->Dot_GetUserName($liveCreatorUserID);
	 $liveCreatorUserFullName = $Dot->Dot_UserFullName($liveCreatorUserID);
?>  
<tr class="langCur olds body<?php echo $liveID;?>" id="post_<?php echo $liveID;?>" data-last="<?php echo $liveID;?>">  
  <td class="bold_td"><?php echo $liveID; ?></td>  
  <td id="user<?php echo $liveID; ?>">
     <div class="tableincontainer">
          <div class="publicher_avatar">
              <img src="<?php echo $liveCreatorUserAvatar;?>" class="a0uk">
          </div>
          <div class="publicher_name truncate"><a href="<?php echo $base_url.'profile/'.$liveCreatorUserName;?>"><?php echo $liveCreatorUserFullName;?></a></div>
      </div>
  </td>   
  <td>
     <div class="see_time timeago" title="<?php echo $liveStarteminStarted;?>"></div>
  </td> 
  <td>
     <?php echo $liveEndedStarted;?>
  </td>    
  <td class="copyUrl froz">  
      <div class="btn waves-effect waves-light red del_boradCast" style="margin-left:10px;" id="<?php echo $liveID;?>" data-type="deleteThisLiveStream"><div class="tableincontainer" style="text-align:center;font-size:13px;"><?php echo $page_Lang['delete'][$dataUserPageLanguage];?></div></div> 
  </td>
</tr>     
<?php  }; ?>
</tbody> 
</table>  
<?php if (ceil($total_records / $limit) > 0): ?>
<ul class="pagination">
	<?php if ($pagep > 1): ?>
	<li class="prev waves-effect"><a href="<?php echo $base_url;?>dashboard/live_streamings?page-id=<?php echo $pagep-1 ?>">Prev</a></li>
	<?php endif; ?>

	<?php if ($pagep > 3): ?>
	<li class="start waves-effect"><a href="<?php echo $base_url;?>dashboard/live_streamings?page-id=1">1</a></li>
	<li class="dots">...</li>
	<?php endif; ?>

	<?php if ($pagep-2 > 0): ?><li class="page waves-effect"><a href="<?php echo $base_url;?>dashboard/live_streamings?page-id=<?php echo $pagep-2; ?>"><?php echo $pagep-2; ?></a></li><?php endif; ?>
	<?php if ($pagep-1 > 0): ?><li class="page waves-effect"><a href="<?php echo $base_url;?>dashboard/live_streamings?page-id=<?php echo $pagep-1; ?>"><?php echo $pagep-1; ?></a></li><?php endif; ?>

	<li class="currentpage active waves-effect"><a href="<?php echo $base_url;?>dashboard/live_streamings?page-id=<?php echo $pagep; ?>"><?php echo $pagep; ?></a></li>

	<?php if ($pagep+1 < ceil($total_records / $limit)+1): ?><li class="page waves-effect"><a href="<?php echo $base_url;?>dashboard/live_streamings?page-id=<?php echo $pagep+1; ?>"><?php echo $pagep+1; ?></a></li><?php endif; ?>
	<?php if ($pagep+2 < ceil($total_records / $limit)+1): ?><li class="page waves-effect"><a href="<?php echo $base_url;?>dashboard/live_streamings?page-id=<?php echo $pagep+2; ?>"><?php echo $pagep+2; ?></a></li><?php endif; ?>

	<?php if ($pagep < ceil($total_records / $limit)-2): ?>
	<li class="dots">...</li>
	<li class="end waves-effect"><a href="<?php echo $base_url;?>dashboard/live_streamings?page-id=<?php echo ceil($total_records / $limit); ?>"><?php echo ceil($total_records / $limit); ?></a></li>
	<?php endif; ?>

	<?php if ($pagep < ceil($total_records / $limit)): ?>
	<li class="next waves-effect"><a href="<?php echo $base_url;?>dashboard/live_streamings?page-id=<?php echo $pagep+1; ?>">Next</a></li>
	<?php endif; ?>
</ul>
<?php endif; ?>                
                 
                 </div>
                 </div>
            </div>
        </div>   
</div> 
<script type="text/javascript">
$("body").on("click",".del_boradCast", function(){
   var type = $(this).attr("data-type");
   var livID = $(this).attr("id");
   var data = 'f='+type+'&lid='+livID;
   $.ajax({
	  type: 'POST',
	  url: requestUrl + "admin/requests/request",
      dataType: "json",
	  data: data,
	  cache: false,
	  beforeSend: function() { $("#set_profile").append('<span class="preloadCom"><span class="progress"><span class="indeterminate"></span></span></span>'); },
	  success: function(response) {   
		  $(".preloadCom").remove();  
		  var deStatus = response.deleted;
		  var deStatusNote = response.delete_not; 
		  if(deStatus == 1){ 
		      $(".body"+livID).remove();
		  }
		  M.toast({html: deStatusNote});   
	  }
    });
});
</script>