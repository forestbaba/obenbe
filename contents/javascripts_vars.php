<script type="text/javascript" src="<?php echo $base_url;?>js/readmore.js "></script>  
<script type="text/javascript">
var requestUrl =   "<?php echo $base_url;?>"; 
var sureWanttoDeleteThisComment =  "<?php echo preg_replace('/\r|\n/', '',$page_Lang['delete_comment_sure'][$dataUserPageLanguage]);?>";
var sureWanttoDeleteThisPost = "<?php echo preg_replace('/\r|\n/', '',$page_Lang['sure_want_to_delete_this_post'][$dataUserPageLanguage]);?>"; 
var roger =  "<?php echo preg_replace('/\r|\n/', '',$page_Lang['roger_ok'][$dataUserPageLanguage]);?>";
var reportSendedText =  "<?php echo preg_replace('/\r|\n/', '',$page_Lang['report_already_sended'][$dataUserPageLanguage]);?>";
var cancel =  "<?php echo preg_replace('/\r|\n/', '',$page_Lang['cancel'][$dataUserPageLanguage]);?>";
var sure =  "<?php echo preg_replace('/\r|\n/', '',$page_Lang['sure_delete'][$dataUserPageLanguage]);?>"; 
var ForgotChooseReportType =  "<?php echo preg_replace('/\r|\n/', '',$page_Lang['forgot_report_type'][$dataUserPageLanguage]);?>"; 
var selectedNightMode =  "<?php echo preg_replace('/\r|\n/', '',$page_Lang['night_mode'][$dataUserPageLanguage]);?>";
var selectedDayMode =  "<?php echo preg_replace('/\r|\n/', '',$page_Lang['day_mode'][$dataUserPageLanguage]);?>";
var visitLinkText =  "<?php echo preg_replace('/\r|\n/', '',$page_Lang['visit_story_profile'][$dataUserPageLanguage]);?>"; 
var disableComment =  "<?php echo preg_replace('/\r|\n/', '',$page_Lang['disable_comment_feature'][$dataUserPageLanguage]);?>";
var enableComment =  "<?php echo preg_replace('/\r|\n/', '',$page_Lang['enable_comment_feature'][$dataUserPageLanguage]);?>";
var minAmonth =  "<?php echo preg_replace('/\r|\n/', '',$page_Lang['amonth_least'][$dataUserPageLanguage]);?> <?php echo $minMonth.$scurrency;?>";
var wrongfe =  "<?php echo preg_replace('/\r|\n/', '',$page_Lang['wrong_fee'][$dataUserPageLanguage]);?>";
var adsSuccess =  "<?php echo preg_replace('/\r|\n/', '',$page_Lang['ad_created_success_wait_mail'][$dataUserPageLanguage]);?>";
var noenoughCredit =  "<?php echo preg_replace('/\r|\n/', '',$page_Lang['no_credit_enough'][$dataUserPageLanguage]);?>";
var noenoughbudget =  "<?php echo preg_replace('/\r|\n/', '',$page_Lang['no_credit_budget'][$dataUserPageLanguage]);?>";
var ShowImagesA =  "<?php echo preg_replace('/\r|\n/', '',$page_Lang['show_hide_image'][$dataUserPageLanguage]);?>";
var HideImagesA =  "<?php echo preg_replace('/\r|\n/', '',$page_Lang['show_hide_image_hide'][$dataUserPageLanguage]);?>";
var ChoseSelfTime =  "<?php echo preg_replace('/\r|\n/', '',$page_Lang['choose_self_destruct_time'][$dataUserPageLanguage]);?>";
var selfSecond =  "<?php echo preg_replace('/\r|\n/', '',$page_Lang['self_second'][$dataUserPageLanguage]);?>";
var selfMinute =  "<?php echo preg_replace('/\r|\n/', '',$page_Lang['self_minute'][$dataUserPageLanguage]);?>";   
var seenItAll = "<?php echo preg_replace('/\r|\n/', '',$page_Lang['seen_it_all'][$dataUserPageLanguage]);?>";
var seeProduct = "<?php echo preg_replace('/\r|\n/', '',$page_Lang['show_product'][$dataUserPageLanguage]);?>";
var hideProduct = "<?php echo preg_replace('/\r|\n/', '',$page_Lang['hide_product'][$dataUserPageLanguage]);?>"; 
function noteStory(){ 
   M.toast({html: '<?php echo $page_Lang['story_shared_sucs'][$dataUserPageLanguage];?>'});
} 
$(function() {
    //caches a jQuery object containing the header element
    var headera = $(".header_container");
	var headerIn = $(".header_in");
	var headerLogo = $(".aU2HW");
	var headerMenu = $(".headerMenu");
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();

        if (scroll >= 77) {  
            headera.addClass("aUCRo");
			headerIn.addClass("buoMu");
			headerLogo.addClass("topico");
			headerMenu.addClass("top_menu");
        } else {
            headera.removeClass("aUCRo");
			headerIn.removeClass("buoMu");
			headerLogo.removeClass("topico");
			headerMenu.removeClass("top_menu");   
        }
    });
}); 
$(document).ready(function(){
$(".swiper-container").livequery(function() {
    var swiper = new Swiper(this, {
      slidesPerView: 4,
      spaceBetween: 5,
      // init: false,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
        640: {
          slidesPerView: 3,
          spaceBetween: 5,
        },
        768: {
          slidesPerView: 4,
          spaceBetween: 5,
        },
        1024: {
          slidesPerView: 5,
          spaceBetween: 5,
        },
      }
    });
 }); 
}); 
</script>
<script type="text/javascript">
function testTheiaStickySidebars() {
    var me = {};
    me.scrollTopStep = 1;
    me.currentScrollTop = 0;
    me.values = null;

    window.scrollTo(0, 1);
    window.scrollTo(0, 0);

    $(window).scroll(function(me) {
        return function(event) {
            var newValues = [];
            
            // Get sidebar offsets.
            $('.theiaStickySidebar').each(function() {
                newValues.push($(this).offset().top);
            });
            
            if (me.values != null) {
                var ok = true;
                
                for (var j = 0; j < newValues.length; j++) {
                    var diff = Math.abs(newValues[j] - me.values[j]);
                    if (diff > 1) {
                        ok = false;
                        
                        console.log('Offset difference for sidebar #' + (j + 1) + ' is ' + diff + 'px');
                        
                        // Highlight sidebar.
                        $($('.theiaStickySidebar')[j]).css('background', 'yellow');
                    }
                }
                
                if (ok == false) {                    
                    // Stop test.
                    $(this).unbind(event);
                    
                    alert('Bummer. Offset difference is bigger than 1px for some sidebars, which will be highlighted in yellow. Check the logs. Aborting.');
                    
                    return;
                }
            }
            
            me.values = newValues;
            
            // Scroll to bottom. We don't cache ($(document).height() - $(window).height()) since it may change (e.g. after images are loaded).
            if (me.currentScrollTop < ($(document).height() - $(window).height()) && me.scrollTopStep == 1) {
                me.currentScrollTop += me.scrollTopStep;
                window.scrollTo(0, me.currentScrollTop);
            }
            // Then back up.
            else if (me.currentScrollTop > 0) {
                me.scrollTopStep = -1;
                me.currentScrollTop += me.scrollTopStep;
                window.scrollTo(0, me.currentScrollTop);
            }
            // Then stop.
            else {                    
                $(this).unbind(event);
                
                alert("Great success!");
            }
        };
    }(me));
}
	$(document).ready(function() {
		if($(window).width() > 915){
		  $('.theiaSidebar')
			.theiaStickySidebar({
				additionalMarginTop: 30
	      });
		}
	});
$(window).resize(function() {
  if($(window).width() < 915){
      $(".COOzN").removeClass('theiaSidebar');
	  $(".COOzN , .theiaStickySidebar").removeAttr('style');
  }else{
      $(".COOzN").addClass('theiaSidebar');
  } 
});
</script>
<?php if($page == 'newsfeed' || $page = 'profile'){?> 
<script type="text/javascript" src="<?php echo $base_url;?>js/bfaf/images-compare.js"></script> 
<script type="text/javascript" src="<?php echo $base_url;?>js/bfaf/hammer.min.js"></script> 
<script type="text/javascript">     
   $(document).ready(function(){
	 $(".js-img-compare").livequery(function() {
		var imagesCompareElement = $(this).imagesCompare();  
	  });  
   });
</script>
<?php }?>
