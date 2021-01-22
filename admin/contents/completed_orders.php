<div class="page_title bold"><?php echo $page_Lang['manage_new_orders'][$dataUserPageLanguage];?></div>
<div class="global_right_wrapper">
   <div class="global_box_container_users">
         
        <div class="divTableBody newboys" style="display:none;"></div>
           <div class="divTableBody old_Key" id="moreType" data-type="user_langs"> 
                 <div class="earnings_statistics">
                 <div class="declined_paymnt_table">
 <?php  
$limit = '15';
$countSql = "SELECT COUNT(payment_id) FROM dot_payments WHERE payment_type = 'pb' ";  
$tot_result = mysqli_query($db, $countSql);   
$row = mysqli_fetch_row($tot_result);  
$total_records = $row[0];  
$total_pages = ceil($total_records / $limit);
 
//for first time load data
if (isset($_GET["page-id"])) { $pagep  = $_GET["page-id"]; } else { $pagep=1; };  
$start_from = ($pagep-1) * $limit;  
$sql = "SELECT cart_id, user_id_fk, purchase_status, product_owner_id,order_status, customer_fullname, product_id_fk,customer_address, customer_phone, customer_country, customer_city,  customer_state,customer_post_code, customer_personal_id_or_passport_id, cargo_campany, cargo_tracking_number, time, cargo_delivery_status FROM  dot_user_cart WHERE purchase_status IN('0','1','2') ORDER BY cart_id ASC LIMIT $start_from, $limit";  
$rs_result = mysqli_query($db, $sql); 
?>
<table class="striped highlight">
    <thead>
      <tr>
        <th>ID</th>
        <th><?php echo $page_Lang['product_owner'][$dataUserPageLanguage];?></th>  
        <th><?php echo $page_Lang['product_buyer'][$dataUserPageLanguage];?></th>
        <th>Time</th>
        <th >Cargo Staus</th>
        <th>Paymen Status</th> 
        <th>Action</th> 
      </tr>
    </thead>  

<tbody id="target-content">
<?php  
while ($row = mysqli_fetch_assoc($rs_result)) {

       $orderID = $row['cart_id'];
	   $orderUserID = $row['user_id_fk'];
	   $oderedUserID = $row['product_owner_id'];
	   $paymentOption = $row['payment_option'];
	   $orderStatus = $row['purchase_status'];
	   $orderTime = $row['time'];
	   $orderCargoStattus = $row['order_status'];
	   $ordereProductID = $row['product_id_fk']; 
	   $orderCustomerAvatar = $Dot->Dot_UserAvatar($orderUserID, $base_url);
	   $orderAuthorAvatar = $Dot->Dot_UserAvatar($oderedUserID, $base_url); 
       $message_time=date("c", $orderTime); 
	   if($orderCargoStattus == 0){
	      $cargoStatus = '<span class="calculatedd" style="text-align:left !important; color:#e65100 !important;">Not Delivered To Cargo</span>';
	   }else if($orderCargoStattus == 1){
	      $cargoStatus = '<span class="calculatedd" style="text-align:left !important; color:#43a047 !important;">It was delivered to cargo.</span>';
	   } else if($orderCargoStattus == 2){
	      $cargoStatus = '<span class="calculatedd" style="text-align:left !important; color:#1e88e5 !important;">Sales completed</span>';
	   } 
	   if($orderStatus == 0){
	        $csorderStatus = $Dot->Dot_SelectedMenuIcon('shopping_cart');
			$paymentStatBuyer = $csorderStatus.' '.$page_Lang['product_is_in_user_cart'][$dataUserPageLanguage];
			$DeleteCartBtn = 'deleteOrderFromCart';
			$ordereProductID = $orrderID;
	   }else if($orderStatus == 1){ 
			 $csorderStatus = $Dot->Dot_SelectedMenuIcon('earnings');
			 $paymentStatBuyer = $csorderStatus.' '.$page_Lang['payment_was_made_online'][$dataUserPageLanguage];
			 $DeleteCartBtn = 'deleteOrder';
		} else if($orderStatus == 2){ 
			$csorderStatus = $Dot->Dot_SelectedMenuIcon('pay_at_the_door');
			$paymentStatBuyer = $csorderStatus.' '.$page_Lang['buyer_payment_status'][$dataUserPageLanguage];
			$DeleteCartBtn = 'deleteOrder';
		}   
		$paymentIDF = $Dot->Dot_GetPaymentIDFromCartID($orderID);
		$detailsBtn ='';
		if($paymentIDF){
		   $detailsBtn = '<div class="btn waves-effect waves-light blue ordDetails" data-type="ordDetails" data-id="'.$ordereProductID.'" data-ui="'.$orderUserID.'" data-or="'.$paymentIDF.'"><div class="tableincontainer" style="text-align:center;font-size:13px;">'.$page_Lang['general_details'][$dataUserPageLanguage].'</div></div>';
		}
?>  
<tr class="langCur olds body<?php echo $orderID;?>" id="post_<?php echo $orderID;?>" data-last="<?php echo $orderID;?>">  
  <td class="bold_td"><?php echo $orderID; ?></td>  
  <td id="user<?php echo $orderID; ?>" data-id="<?php echo $orderID;?>">
     <div class="tableincontainer">
          <div class="publicher_avatar">
              <img src="<?php echo $orderAuthorAvatar;?>" class="a0uk">
          </div>
          <div class="publicher_name truncate"><a href="<?php echo $base_url.'profile/'.$Dot->Dot_GetUserName($oderedUserID);?>"><?php echo $Dot->Dot_UserFullName($oderedUserID);?></a></div>
      </div>
  </td>
  <td id="user<?php echo $orderID; ?>" data-id="<?php echo $orderID;?>">
     <div class="tableincontainer">
          <div class="publicher_avatar">
              <img src="<?php echo $orderCustomerAvatar;?>" class="a0uk">
          </div>
          <div class="publicher_name truncate"><a href="<?php echo $base_url.'profile/'.$Dot->Dot_GetUserName($orderUserID);?>"><?php echo $Dot->Dot_UserFullName($orderUserID);?></a></div>
      </div>
  </td>  
  <td>
     <div class="see_time timeago" title="<?php echo $message_time;?>"></div>
  </td>
  <td> 
     <div class="see_post" id="amount_<?php echo $orderID;?>"><?php echo $cargoStatus;?></div>
  </td>
  <td class="sam_<?php echo $orderUserID;?>"> 
        <div class="see_post" style="display:block;"><?php echo $paymentStatBuyer;?></div> 
  </td>     
  <td class="copyUrl froz"> 
       <?php echo $detailsBtn;?>
      <div class="btn waves-effect waves-light red <?php echo $DeleteCartBtn;?>" style="margin-left:10px;" id="<?php echo $ordereProductID;?>" data-type="<?php echo $DeleteCartBtn;?>"><div class="tableincontainer" style="text-align:center;font-size:13px;"><?php echo $page_Lang['delete'][$dataUserPageLanguage];?></div></div> 
  </td>
</tr>     
<?php  } ?>
</tbody> 
</table>  
<?php if (ceil($total_records / $limit) > 0): ?>
<ul class="pagination">
	<?php if ($pagep > 1): ?>
	<li class="prev waves-effect"><a href="<?php echo $base_url;?>dashboard/manage_boosts?page-id=<?php echo $pagep-1 ?>">Prev</a></li>
	<?php endif; ?>

	<?php if ($pagep > 3): ?>
	<li class="start waves-effect"><a href="<?php echo $base_url;?>dashboard/manage_boosts?page-id=1">1</a></li>
	<li class="dots">...</li>
	<?php endif; ?>

	<?php if ($pagep-2 > 0): ?><li class="page waves-effect"><a href="<?php echo $base_url;?>dashboard/manage_boosts?page-id=<?php echo $pagep-2; ?>"><?php echo $pagep-2; ?></a></li><?php endif; ?>
	<?php if ($pagep-1 > 0): ?><li class="page waves-effect"><a href="<?php echo $base_url;?>dashboard/manage_boosts?page-id=<?php echo $pagep-1; ?>"><?php echo $pagep-1; ?></a></li><?php endif; ?>

	<li class="currentpage active waves-effect"><a href="<?php echo $base_url;?>dashboard/manage_boosts?page-id=<?php echo $pagep; ?>"><?php echo $pagep; ?></a></li>

	<?php if ($pagep+1 < ceil($total_records / $limit)+1): ?><li class="page waves-effect"><a href="<?php echo $base_url;?>dashboard/manage_boosts?page-id=<?php echo $pagep+1; ?>"><?php echo $pagep+1; ?></a></li><?php endif; ?>
	<?php if ($pagep+2 < ceil($total_records / $limit)+1): ?><li class="page waves-effect"><a href="<?php echo $base_url;?>dashboard/manage_boosts?page-id=<?php echo $pagep+2; ?>"><?php echo $pagep+2; ?></a></li><?php endif; ?>

	<?php if ($pagep < ceil($total_records / $limit)-2): ?>
	<li class="dots">...</li>
	<li class="end waves-effect"><a href="<?php echo $base_url;?>dashboard/manage_boosts?page-id=<?php echo ceil($total_records / $limit); ?>"><?php echo ceil($total_records / $limit); ?></a></li>
	<?php endif; ?>

	<?php if ($pagep < ceil($total_records / $limit)): ?>
	<li class="next waves-effect"><a href="<?php echo $base_url;?>dashboard/manage_boosts?page-id=<?php echo $pagep+1; ?>">Next</a></li>
	<?php endif; ?>
</ul>
<?php endif; ?>                
                 
                 </div>
                 </div>
            </div>
        </div>   
</div> 
<script type="text/javascript">
  $(document).ready(function(){
       $("body").on("click",".boostdele", function(){
	        var type = $(this).attr("data-type");
			var pointID = $(this).attr("id"); 
			var data = 'f='+type+'&boostid='+pointID;
			$.ajax({
				   type: 'POST',
				   url: requestUrl + 'admin/requests/request',
				   dataType: "json", 
				   data: data, 
				   beforeSend: function(){
					  $("#target-content").before('<span class="progress_blue" id="ccm"><span class="indeterminate"></span></span>');
				   },
				   success: function(response){ 
						$('#ccm').remove(); 
							    if(response){
								     var success = response.point_deleted;
									 var paymenticon = response.pay_ok; 
									 if(success == 1){
								          M.toast({html: paymenticon, classes: 'warning'}); 
										  $("#post_"+pointID).slideUp("slow").promise().done(function() { $(this).remove(); });
									 }else {
										   M.toast({html: paymenticon, classes: 'warning'});   
									 }
								}  
				   }
			   });
	   });
   });
</script>
<div class="no_post_can_show">
    <div class="no_post_from">
         <div class="no_available">This post is no longer available.</div>
    </div>
</div>