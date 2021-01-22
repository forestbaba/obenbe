<div class="popupBack"></div>
<div class="uinfo_wrapper_ss uinfSlideInUp">
  <div class="inf_con_box">
   <div class="closeNewsinf"><?php echo $Dot->Dot_SelectedMenuIcon('close_icons');?></div> 
   <div class="orderDetailsTitle"><?php echo $page_Lang['order_details'][$dataUserPageLanguage];?></div>
   <div class="oinfAllContainer">
         <!---->
         <?php 
		    if($checkProductOrders){
			   foreach($checkProductOrders as $ordProd){
			        $orderPaymentID = $ordProd['payment_id'];
					$orderPaymentUserID = $ordProd['payment_user_id'];
					$orderPaymentPostID = $ordProd['payment_post_id'];
					$orderPaymentOwnerID = $ordProd['product_owner_id'];
					$orderPaymentOrderedKey = $ordProd['order_key'];
					$orderPaymentPaymentOption = $ordProd['payment_option'];
					$orderPaymentPaymentTime = $ordProd['payment_time'];
					$orderPaymentPaymentStatus = $ordProd['payment_status'];
					$orderPaymentAmount = $ordProd['amount'];
					$orderPaymentFee = $ordProd['fee'];
					$orderPaymentAdminEarning = $ordProd['admin_earning'];
					$orderPaymentUserEarning = $ordProd['user_earning']; 
					$orderedD = $Dot->Dot_ShowProductPost($orderPaymentPostID,$orderPaymentOwnerID);
					$orderedProductImage = $orderedD['product_images'];
					$orderedProductName = $orderedD['m_product_name'];
					$orderedProductCategory = $orderedD['product_category'];
					$orderedProductDiscountPrice = $orderedD['product_discount_price'];
					$orderedProductNormalPrice = $orderedD['product_normal_price'];
					$orderedProductCurrency = $orderedD['product_currency'];
					$orderedProductSlug = $orderedD['slug'];
					$oderedCardID = $ordProd['crtid'];
					$newdata=$Dot->Dot_GetUploadImageID($orderedProductImage); 
					if($newdata){
					  $final_imagea=$base_url."uploads/images/".$newdata['uploaded_image']; 
					} 
					if($orderedProductDiscountPrice){
						$data_differencePrice = $cartPostProductNormalPrice - $orderedProductDiscountPrice; 
						$data_percentage = 100 - (100 * $data_differencePrice ) / $orderedProductNormalPrice;  
						$data_dis_Percentage = '<div class="percentage"><div class="percentage_co"><div class="arrow_percentage">'.bcdiv($data_percentage, 1).'%</div></div></div>';
						$theCurrentPrice = $Dot->Dot_restyle_text($data_differencePrice). ' ' .$orderedProductCurrency;
						$theOldOne = '<div class="cart_price_old"><s>'. $Dot->Dot_restyle_text($orderedProductDiscountPrice). ' ' .$orderedProductCurrency.'</s></div>';
					}else{
						$data_dis_Percentage ='';
						$theCurrentPrice =  $Dot->Dot_restyle_text($orderedProductNormalPrice). ' ' .$orderedProductCurrency;
						$theOldOne='';
					} 
					$productOwnerUserFullName = $Dot->Dot_UserFullName($cartProductOwnerUserIDFk);
					$productOwnerUsername = $Dot->Dot_GetUserName($cartProductOwnerUserIDFk); 
					$theBuyerDetails = $Dot->Dot_UserOrderCartDetails($orderPaymentOwnerID,$oderedCardID); 
					
					$byCardID = $theBuyerDetails['cart_id'];
					$byCardPurchaseStatus = $theBuyerDetails['purchase_status'];
					$byCardproductOwnerID = $theBuyerDetails['product_owner_id'];
					$byCardOrderStatus = $theBuyerDetails['order_status'];
					$byCardCustomerFullName = $theBuyerDetails['customer_fullname'];
					$byCardProductID = $theBuyerDetails['product_id_fk'];
					$byCardCustomerAddress = $theBuyerDetails['customer_address'];
					$byCardCustomerPhoneNumber = $theBuyerDetails['customer_phone'];
					$byCardCustomerCountry = $theBuyerDetails['customer_country'];
					$byCardCustomerCity = $theBuyerDetails['customer_city'];
					$byCardCustomerState = $theBuyerDetails['customer_state'];
					$byCardCustomerPostCode = $theBuyerDetails['customer_post_code'];
					$byCardCustomerPersonalID = $theBuyerDetails['customer_personal_id_or_passport_id'];
					$byCardCargoCampany = $theBuyerDetails['cargo_campany'];
					$byCardCargoTrackingNumber = $theBuyerDetails['cargo_tracking_number'];
					$byCardCargoSendTime = $theBuyerDetails['time'];
					$byCardCargoDeliveryStatus = $theBuyerDetails['cargo_delivery_status'];
					if($byCardOrderStatus == 0){ 
						$orderStatus = $Dot->Dot_SelectedMenuIcon('waiting_seller_approve');
						$pss = $orderStatus.$page_Lang['waiting_approval_seller'][$dataUserPageLanguage];
					}else if($byCardOrderStatus == 1){
						$orderStatus = $Dot->Dot_SelectedMenuIcon('in_cargo');
						$pss = $orderStatus.$page_Lang['product_has_been_shipped_customer'][$dataUserPageLanguage];
					}else if($byCardOrderStatus == 2){
						$orderStatus = $Dot->Dot_SelectedMenuIcon('order_delivery');
						$pss = $orderStatus.$page_Lang['product_was_delivered'][$dataUserPageLanguage];
					} 
          ?> 
             <div class="orderedProductDetails">
                  <!---->
                  <div class="cart_product_box" id="cart_27">
                       <div class="cart_product_image" style="background-image:url('<?php echo $final_imagea;?>');">
                                <img src="<?php echo $final_imagea;?>" class="cart_product_imageimg">
                       </div>
                       <div class="cart_product_informations">
                              <div class="cart_product_title truncate"><?php echo $orderedProductName;?></div>
                              <div class="cart_product_category"><?php echo $page_Lang[$Dot->Dot_MarketProductPostCategory($orderedProductCategory)][$dataUserPageLanguage];?></div>
                              <div class="cart_product_price"><?php echo $theCurrentPrice.' '.$theOldOne;?></div>
                              <div class="cart_buttons">
                                   <div class="cart_btn_box_incoming hvr-shutter-out-vertical waves-effect waves-green"><a href="<?php echo $base_url.'mymarket/'.$orderedProductSlug;?>" target="_new">See Product</a></div>  
                              </div>
                       </div>
                       
                    </div>
                  <!---->
                  <div class="csp_center">
                         <div class="othrs"><span class=""><?php echo $page_Lang['product_shipping_status'][$dataUserPageLanguage];?></span> <?php echo $pss;?></div>
                         <div class="othrs add_infos" style="display:block;">
                                <div class="shopping_ui_title_ui"><?php echo $page_Lang['address_and_personal_informations'][$dataUserPageLanguage];?></div>
                                <div class="shopping_ui_box"><span class="nmsp"><?php echo $page_Lang['full_name'][$dataUserPageLanguage];?>: </span><?php echo $byCardCustomerFullName;?></div>
                                <div class="shopping_ui_box"><span class="nmsp"><?php echo $page_Lang['addressui'][$dataUserPageLanguage];?>: </span><?php echo $byCardCustomerAddress;?></div>
                                <div class="shopping_ui_box"><span class="nmsp"><?php echo $page_Lang['phone_number'][$dataUserPageLanguage];?>:   </span><span class="iti__flag iti__<?php echo strtolower($byCardCustomerCountry);?>"></span><?php echo $byCardCustomerPhoneNumber;?></div>
                                <div class="shopping_ui_box"><span class="nmsp"><?php echo $page_Lang['ui_country'][$dataUserPageLanguage];?>: </span><?php if($Dot->Dot_CountryName($byCardCustomerCountry)){echo $Dot->Dot_CountryName($byCardCustomerCountry);}else{echo '--';}?></div>
                                <div class="shopping_ui_box"><span class="nmsp"><?php echo $page_Lang['ui_city'][$dataUserPageLanguage];?>: </span><?php if($Dot->Dot_UserCity($byCardCustomerCity)){echo $Dot->Dot_UserCity($byCardCustomerCity);}else{echo '--';}?></div>
                                <div class="shopping_ui_box"><span class="nmsp"><?php echo $page_Lang['ui_state'][$dataUserPageLanguage];?>: </span><?php if($Dot->Dot_UserState($byCardCustomerState)){echo $Dot->Dot_UserState($byCardCustomerState);}else{echo '--';};?></div>
                                <div class="shopping_ui_box"><span class="nmsp"><?php echo $page_Lang['ui_postcode'][$dataUserPageLanguage];?>: </span><?php echo $byCardCustomerPostCode;?></div>
                                <div class="shopping_ui_box"><span class="nmsp"><?php echo $page_Lang['ui_personalid_passportid'][$dataUserPageLanguage];?>: </span><?php echo $byCardCustomerPersonalID;?></div>
                        </div>
                 </div> 
             
	      <?php }
			}
		 ?>
         <!---->
   </div>
   </div>
</div>