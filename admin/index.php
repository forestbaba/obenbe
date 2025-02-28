<?php
$page     = 'admin';
$pageMenu = 'menuhere';
include_once '../functions/inc.php';
if ($dataUserType != '1') {
	header("Location:".$base_url."sources/not-found.php");
}
include ("../contents/header.php");
include ("contents/active.php");
$getp                           = '';
if (isset($_GET['set'])) {$getp = isset($_GET['set'])?$_GET['set']:'';}
?>
<!--Admin CONTAINER STARTED-->
<div class="admin_container">
  <div class="admin_wrapper">
   <!--Left STARTED-->
   <div class="left_sidebar">
       <div class="global_box">
           <div class="global_box_in">
               <span class="_1qt3 _5l-3" id="js_3u">
                  <span>
                    <span class="_4ldz" style="height: 50px; width: 50px;">
                      <span class="_4ld-" style="height: 50px; width: 50px;">
                        <span class="_55lt" style="width: 50px; height: 50px;">
                          <img src="<?php echo $dataUserAvatar;?>" width="50" height="50" alt="" class="img_avatar">
                        </span>
                      </span>
                    </span>
                  </span>
                </span>
                <div class="admin_info">
                    <div class="admin_name bold"><?php echo $page_Lang['wellcome_admin'][$dataUserPageLanguage];
?>, <?php echo $dataUserFullName;
?></div>
                    <div class="admin_name"><?php echo $page_Lang['logged_in_as_admin'][$dataUserPageLanguage];?></div>
                </div>
            </div>
       </div>
       <!--DashBoard Menu STARTED-->
<?php echo $update;?>
       <div class="dash_menu_container">
            <div class="dash_menu_track bold">Menu</div>
            <div class="admin_menu_wrap">
                <ul class="collapsible">
                    <li <?php echo $dashClass;?>>
                      <a href="<?php echo $base_url;?>dashboard/dashboard"><div class="collapsible-header hvr-underline-from-center" id="dashboard"><span class="left_dash_icon"></span><?php echo $page_Lang['dashboard_admin'][$dataUserPageLanguage];
?></div> </a>
                    </li>
                    <li <?php echo $settingClass;?>>
                      <div class="collapsible-header hvr-underline-from-center" id="site-settings"><span class="left_set_icon"></span><?php echo $page_Lang['settings'][$dataUserPageLanguage];?></div>
                      <div class="collapsible-body">
                           <a href="<?php echo $base_url;?>dashboard/site-settings"><div class="leftMenuItem_ hvr-sweep-to-right" id="___site-settings"><span id="__site-settings" class=""></span><?php echo $page_Lang['site_settings'][$dataUserPageLanguage];
?></div></a>
                           <a href="<?php echo $base_url;?>dashboard/general-settings"><div class="leftMenuItem_ hvr-sweep-to-right" id="___general-settings"><span id="__general-settings" class=""></span><?php echo $page_Lang['website_general_settings'][$dataUserPageLanguage];
?></div></a>
                           <a href="<?php echo $base_url;?>dashboard/site-features"><div class="leftMenuItem_ hvr-sweep-to-right" id="___site-features"><span id="__site-features" class=""></span><?php echo $page_Lang['manage_website_features'][$dataUserPageLanguage];
?></div></a>
                           <a href="<?php echo $base_url;?>dashboard/manage-menu-icons"><div class="leftMenuItem_ hvr-sweep-to-right" id="___manage-menu-icons"><span id="__manage-menu-icons" class=""></span><?php echo $page_Lang['manage_menu_icons'][$dataUserPageLanguage];
?></div></a>
                           <a href="<?php echo $base_url;?>dashboard/payment-method-settings"><div class="leftMenuItem_ hvr-sweep-to-right" id="___payment-method-settings"><span id="__payment-method-settings" class=""></span><?php echo $page_Lang['payment_method_settings'][$dataUserPageLanguage];
?></div></a>
                      </div>
                    </li>
                    <li <?php echo $liveStreamingClass;?>>
                      <div class="collapsible-header hvr-underline-from-center" id="user-management"><div class="left_broadcasting_icon"></div><?php echo $page_Lang['live_streamings'][$dataUserPageLanguage];?></div>
                      <div class="collapsible-body">
                             <a href="<?php echo $base_url;?>dashboard/live_streamings_features"><div class="leftMenuItem_ hvr-sweep-to-right" id="___live_streamings_features"><span id="__live_streamings_features" class=""></span><?php echo $page_Lang['live_streamings_features'][$dataUserPageLanguage];
?></div></a>
                            <a href="<?php echo $base_url;?>dashboard/live_streamings"><div class="leftMenuItem_ hvr-sweep-to-right" id="___live_streamings"><span id="__live_streamings" class=""></span><?php echo $page_Lang['manage_live_streamings'][$dataUserPageLanguage];
?></div></a>
                      </div>
                    </li>
                    <li <?php echo $userClass;?>>
                      <div class="collapsible-header hvr-underline-from-center" id="user-management"><div class="left_user_icon"></div><?php echo $page_Lang['user_settings'][$dataUserPageLanguage];?></div>
                      <div class="collapsible-body">
                            <a href="<?php echo $base_url;?>dashboard/user-management"><div class="leftMenuItem_ hvr-sweep-to-right" id="___user-management"><span id="__user-management" class=""></span><?php echo $page_Lang['user_management'][$dataUserPageLanguage];
?></div></a>
                            <a href="<?php echo $base_url;?>dashboard/pro_user_management"><div class="leftMenuItem_ hvr-sweep-to-right" id="___pro_user_management"><span id="__pro_user_management" class=""></span><?php echo $page_Lang['manage_pro_members'][$dataUserPageLanguage];
?></div></a>
                            <a href="<?php echo $base_url;?>dashboard/verified_user_management"><div class="leftMenuItem_ hvr-sweep-to-right" id="___verified_user_management"><span id="__verified_user_management" class=""></span><?php echo $page_Lang['manage_verified_users'][$dataUserPageLanguage];
?></div></a>
                            <a href="<?php echo $base_url;?>dashboard/blocked-users"><div class="leftMenuItem_ hvr-sweep-to-right" id="___blocked-users"><span id="__blocked-users" class=""></span><?php echo $page_Lang['blocked_users'][$dataUserPageLanguage];
?></div></a>
                            <a href="<?php echo $base_url;?>dashboard/generate-fake-users"><div class="leftMenuItem_ hvr-sweep-to-right" id="___generate-fake-users"><span id="__generate-fake-users" class=""></span><?php echo $page_Lang['generate_fake_users'][$dataUserPageLanguage];
?></div></a>
                      </div>
                    </li>
                    <li <?php echo $orderClass;?>>
                      <div class="collapsible-header hvr-underline-from-center" id="user-management"><div class="left_order_icon"></div><?php echo $page_Lang['manage_orders'][$dataUserPageLanguage];?></div>
                      <div class="collapsible-body">
                            <a href="<?php echo $base_url;?>dashboard/manage_new_orders"><div class="leftMenuItem_ hvr-sweep-to-right" id="___manage_new_orders"><span id="__manage_new_orders" class=""></span><?php echo $page_Lang['completed_orders'][$dataUserPageLanguage];
?></div></a>
                            <a href="<?php echo $base_url;?>dashboard/completed_orders"><div class="leftMenuItem_ hvr-sweep-to-right" id="___completed_orders"><span id="__completed_orders" class=""></span><?php echo $page_Lang['manage_new_orders'][$dataUserPageLanguage];
?></div></a>
                      </div>
                    </li>
                    <li <?php echo $proClass;?>>
                      <div class="collapsible-header hvr-underline-from-center" id="site-settings"><span class="pro_system_icon"></span><?php echo $page_Lang['pro_system_management'][$dataUserPageLanguage];?></div>
                      <div class="collapsible-body">
                           <a href="<?php echo $base_url;?>dashboard/manage_pro_earnings"><div class="leftMenuItem_ hvr-sweep-to-right" id="___manage_pro_earnings"><span id="__manage_pro_earnings" class=""></span><?php echo $page_Lang['manage_pro_earnings'][$dataUserPageLanguage];
?></div></a>
                           <a href="<?php echo $base_url;?>dashboard/pro_list_packages"><div class="leftMenuItem_ hvr-sweep-to-right" id="___pro_list_packages"><span id="__pro_list_packages" class=""></span><?php echo $page_Lang['pro_packages_list'][$dataUserPageLanguage];
?></div></a>
                           <a href="<?php echo $base_url;?>dashboard/create_new_pro_package"><div class="leftMenuItem_ hvr-sweep-to-right" id="___create_new_pro_package"><span id="__create_new_pro_package" class=""></span><?php echo $page_Lang['create_new_pro_package'][$dataUserPageLanguage];
?></div></a>
                           <a href="<?php echo $base_url;?>dashboard/manage_pro_features"><div class="leftMenuItem_ hvr-sweep-to-right" id="___manage_pro_features"><span id="__manage_pro_features" class=""></span><?php echo $page_Lang['manage_pro_features'][$dataUserPageLanguage];
?></div></a>
                      </div>
                    </li>
                    <li <?php echo $pointClass;?>>
                      <div class="collapsible-header hvr-underline-from-center" id="site-settings"><span class="point_system_icon"></span><?php echo $page_Lang['manage_point_system'][$dataUserPageLanguage];?></div>
                      <div class="collapsible-body">
                           <a href="<?php echo $base_url;?>dashboard/point_settings"><div class="leftMenuItem_ hvr-sweep-to-right" id="___point_settings"><span id="__point_settings" class=""></span><?php echo $page_Lang['point_settings'][$dataUserPageLanguage];
?></div></a>
                      </div>
                    </li>
                    <li <?php echo $earnClass;?>>
                      <div class="collapsible-header hvr-underline-from-center" id="page-langauges"><span class="left_earn_icon"></span><?php echo $page_Lang['manage_withdrawals_and_earnings'][$dataUserPageLanguage];?></div>
                      <div class="collapsible-body">
                            <a href="<?php echo $base_url;?>dashboard/manage_earnings"><div class="leftMenuItem_ hvr-sweep-to-right" id="___manage_earnings"><span id="__manage_earnings" class=""></span><?php echo $page_Lang['manage_earnings'][$dataUserPageLanguage];
?></div></a>
                            <a href="<?php echo $base_url;?>dashboard/manage_withdrawals"><div class="leftMenuItem_ hvr-sweep-to-right" id="___manage_withdrawals"><span id="__manage_withdrawals" class=""></span><?php echo $page_Lang['manage_withdrawals'][$dataUserPageLanguage];
?></div></a>
                            <a href="<?php echo $base_url;?>dashboard/manage_points"><div class="leftMenuItem_ hvr-sweep-to-right" id="___manage_points"><span id="__manage_points" class=""></span><?php echo $page_Lang['manage_points'][$dataUserPageLanguage];
?></div></a>
                            <a href="<?php echo $base_url;?>dashboard/manage_boosts"><div class="leftMenuItem_ hvr-sweep-to-right" id="___manage_boosts"><span id="__manage_boosts" class=""></span><?php echo $page_Lang['manage_boosts'][$dataUserPageLanguage];
?></div></a>
                            <a href="<?php echo $base_url;?>dashboard/manage_theme_earnings"><div class="leftMenuItem_ hvr-sweep-to-right" id="___manage_theme_earnings"><span id="__manage_theme_earnings" class=""></span><?php echo $page_Lang['manage_theme_earnings'][$dataUserPageLanguage];
?></div></a>
                      </div>
                    </li>
                    <li <?php echo $featuresClass;?>>
                      <div class="collapsible-header hvr-underline-from-center" id="manage-fonts"><div class="left_features_icon"></div><?php echo $page_Lang['manage_features'][$dataUserPageLanguage];?></div>
                      <div class="collapsible-body">
                            <a href="<?php echo $base_url;?>dashboard/manage-fonts"><div class="leftMenuItem_ hvr-sweep-to-right" id="___manage-fonts"><span id="__manage-fonts" class=""></span><?php echo $page_Lang['manage_fonts'][$dataUserPageLanguage];
?></div></a>
                            <a href="<?php echo $base_url;?>dashboard/manage-colors"><div class="leftMenuItem_ hvr-sweep-to-right" id="___manage-colors"><span id="__manage-colors" class=""></span><?php echo $page_Lang['manage_colors'][$dataUserPageLanguage];
?></div></a>
                            <a href="<?php echo $base_url;?>dashboard/manage-event-categories"><div class="leftMenuItem_ hvr-sweep-to-right" id="___manage-event-categories"><span id="__manage-event-categories" class=""></span><?php echo $page_Lang['manage_event_categories'][$dataUserPageLanguage];
?></div></a>
                            <a href="<?php echo $base_url;?>dashboard/manage-event-covers"><div class="leftMenuItem_ hvr-sweep-to-right" id="___manage-event-covers"><span id="__manage-event-covers" class=""></span><?php echo $page_Lang['manage_event_covers'][$dataUserPageLanguage];
?></div></a>
                            <a href="<?php echo $base_url;?>dashboard/manage-social-share-buttons"><div class="leftMenuItem_ hvr-sweep-to-right" id="___manage-social-share-buttons"><span id="__manage-social-share-buttons" class=""></span><?php echo $page_Lang['manage_social_share_buttons'][$dataUserPageLanguage];
?></div></a>
                      </div>
                    </li>
                    <li <?php echo $cityCountryStateClass;?>>
                      <div class="collapsible-header hvr-underline-from-center" id="manage-fonts"><div class="left_cityStateCount_icon"></div><?php echo $page_Lang['manage_city_country_state'][$dataUserPageLanguage];?></div>
                      <div class="collapsible-body">
                            <a href="<?php echo $base_url;?>dashboard/manage_countries"><div class="leftMenuItem_ hvr-sweep-to-right" id="___manage_countries"><span id="__manage_countries" class=""></span><?php echo $page_Lang['manage_countries'][$dataUserPageLanguage];
?></div></a>
                            <a href="<?php echo $base_url;?>dashboard/manage_states"><div class="leftMenuItem_ hvr-sweep-to-right" id="___manage_states"><span id="__manage_states" class=""></span><?php echo $page_Lang['manage_states'][$dataUserPageLanguage];
?></div></a>
                            <a href="<?php echo $base_url;?>dashboard/manage_cities"><div class="leftMenuItem_ hvr-sweep-to-right" id="___manage_cities"><span id="__manage_cities" class=""></span><?php echo $page_Lang['manage_cities'][$dataUserPageLanguage];
?></div></a>
                      </div>
                    </li>
                    <li <?php echo $langClass;?>>
                      <div class="collapsible-header hvr-underline-from-center" id="page-langauges"><span class="left_lang_icon"></span><?php echo $page_Lang['page_langauges'][$dataUserPageLanguage];?></div>
                      <div class="collapsible-body">
                            <a href="<?php echo $base_url;?>dashboard/page-langauges"><div class="leftMenuItem_ hvr-sweep-to-right" id="___page-langauges"><span id="__page-langauges" class=""></span><?php echo $page_Lang['manage_languages'][$dataUserPageLanguage];
?></div></a>
                            <a href="<?php echo $base_url;?>dashboard/add-new-language-keys"><div class="leftMenuItem_ hvr-sweep-to-right" id="___add-new-language-keys"><span id="__add-new-language-keys" class=""></span><?php echo $page_Lang['add_new_language_and_keys'][$dataUserPageLanguage];
?></div></a>
                      </div>
                    </li>
                    <li <?php echo $postClass;?>>
                      <div class="collapsible-header hvr-underline-from-center" id="user-posts"><span class="left_posts_icon"></span><?php echo $page_Lang['user_posts'][$dataUserPageLanguage];?></div>
                      <div class="collapsible-body">
                            <a href="<?php echo $base_url;?>dashboard/user-posts"><div class="leftMenuItem_ hvr-sweep-to-right" id="___user-posts"><span id="__user-posts" class=""></span><?php echo $page_Lang['users_shared_posts'][$dataUserPageLanguage];
?></div></a>
                            <a href="<?php echo $base_url;?>dashboard/user-text-posts"><div class="leftMenuItem_ hvr-sweep-to-right" id="___user-text-posts"><span id="__user-text-posts" class=""></span><?php echo $page_Lang['user_text_posts'][$dataUserPageLanguage];
?></div></a>
                            <a href="<?php echo $base_url;?>dashboard/user-image-posts"><div class="leftMenuItem_ hvr-sweep-to-right" id="___user-image-posts"><span id="__user-image-posts" class=""></span><?php echo $page_Lang['user_image_posts'][$dataUserPageLanguage];
?></div></a>
                            <a href="<?php echo $base_url;?>dashboard/user-video-posts"><div class="leftMenuItem_ hvr-sweep-to-right" id="___user-video-posts"><span id="__user-video-posts" class=""></span><?php echo $page_Lang['user_video_posts'][$dataUserPageLanguage];
?></div></a>
                            <a href="<?php echo $base_url;?>dashboard/user-audio-posts"><div class="leftMenuItem_ hvr-sweep-to-right" id="___user-audio-posts"><span id="__user-audio-posts" class=""></span><?php echo $page_Lang['user_audio_posts'][$dataUserPageLanguage];
?></div></a>
                            <a href="<?php echo $base_url;?>dashboard/user-link-posts"><div class="leftMenuItem_ hvr-sweep-to-right" id="___user-link-posts"><span id="__user-link-posts" class=""></span><?php echo $page_Lang['user_link_posts'][$dataUserPageLanguage];
?></div></a>
                            <a href="<?php echo $base_url;?>dashboard/user-gif-posts"><div class="leftMenuItem_ hvr-sweep-to-right" id="___user-gif-posts"><span id="__user-gif-posts" class=""></span><?php echo $page_Lang['user_gif_posts'][$dataUserPageLanguage];
?></div></a>
                            <a href="<?php echo $base_url;?>dashboard/user-location-posts"><div class="leftMenuItem_ hvr-sweep-to-right" id="___user-location-posts"><span id="__user-location-posts" class=""></span><?php echo $page_Lang['user_location_posts'][$dataUserPageLanguage];
?></div></a>
                            <a href="<?php echo $base_url;?>dashboard/user-watermark-posts"><div class="leftMenuItem_ hvr-sweep-to-right" id="___user-watermark-posts"><span id="__user-watermark-posts" class=""></span><?php echo $page_Lang['user_watermark_posts'][$dataUserPageLanguage];
?></div></a>
                            <a href="<?php echo $base_url;?>dashboard/user-benchmark-posts"><div class="leftMenuItem_ hvr-sweep-to-right" id="___user-benchmark-posts"><span id="__user-benchmark-posts" class=""></span><?php echo $page_Lang['user_benchmark_posts'][$dataUserPageLanguage];
?></div></a>
                            <a href="<?php echo $base_url;?>dashboard/user-beforeafter-posts"><div class="leftMenuItem_ hvr-sweep-to-right" id="___user-beforeafter-posts"><span id="__user-beforeafter-posts" class=""></span><?php echo $page_Lang['user_beforeafter_posts'][$dataUserPageLanguage];
?></div></a>
                      </div>
                    </li>
                    <li <?php echo $reportClass;?>>
                      <div class="collapsible-header hvr-underline-from-center" id="post-reports"><span class="left_report_icon"></span><?php echo $page_Lang['reports_'][$dataUserPageLanguage];?></div>
                      <div class="collapsible-body">
                            <a href="<?php echo $base_url;?>dashboard/post-reports"><div class="leftMenuItem_ hvr-sweep-to-right" id="___post-reports"><span id="__post-reports" class=""></span><?php echo $page_Lang['post_reports'][$dataUserPageLanguage];
?></div></a>
                      </div>
                    </li>
                    <li <?php echo $pageClass;?>>
                      <div class="collapsible-header hvr-underline-from-center" id="left_pages_icon"><span class="left_pages_icon"></span><?php echo $page_Lang['manage_pages'][$dataUserPageLanguage];?></div>
                      <div class="collapsible-body">
                            <a href="<?php echo $base_url;?>dashboard/manage_about_us"><div class="leftMenuItem_ hvr-sweep-to-right" id="___manage_about_us"><span id="__manage_about_us" class=""></span><?php echo $page_Lang['manage_about_us_page'][$dataUserPageLanguage];
?></div></a>
                            <a href="<?php echo $base_url;?>dashboard/manage_privacy_policies"><div class="leftMenuItem_ hvr-sweep-to-right" id="___manage_privacy_policies"><span id="__manage_privacy_policies" class=""></span><?php echo $page_Lang['manage_privacy_policies'][$dataUserPageLanguage];
?></div></a>
                      </div>
                    </li>
                    <li <?php echo $emoticonsClass;?>>
                      <div class="collapsible-header hvr-underline-from-center" id="post-reports"><span class="left_fast_expressions_icon"></span><?php echo $page_Lang['fast_expressions'][$dataUserPageLanguage];?></div>
                      <div class="collapsible-body">
                            <a href="<?php echo $base_url;?>dashboard/manage-stickers"><div class="leftMenuItem_ hvr-sweep-to-right" id="___manage-stickers"><span id="__manage-stickers" class=""></span><?php echo $page_Lang['manage_stickers'][$dataUserPageLanguage];
?></div></a>
                            <a href="<?php echo $base_url;?>dashboard/manage-gifs"><div class="leftMenuItem_ hvr-sweep-to-right" id="___manage-gifs"><span id="__manage-gifs" class=""></span><?php echo $page_Lang['manage_gifs'][$dataUserPageLanguage];
?></div></a>
                            <a href="<?php echo $base_url;?>dashboard/manage-watermarks"><div class="leftMenuItem_ hvr-sweep-to-right" id="___manage-watermarks"><span id="__manage-watermarks" class=""></span><?php echo $page_Lang['manage_watermark'][$dataUserPageLanguage];
?></div></a>
                            <a href="<?php echo $base_url;?>dashboard/manage-feelings"><div class="leftMenuItem_ hvr-sweep-to-right" id="___manage-feelings"><span id="__manage-feelings" class=""></span><?php echo $page_Lang['manage_feelings'][$dataUserPageLanguage];
?></div></a>
                      </div>
                    </li>
                    <li <?php echo $marketClass;?>>
                      <div class="collapsible-header hvr-underline-from-center" id="post-reports"><span class="left_marketplace_icon"></span><?php echo $page_Lang['marketplaces_menu_title'][$dataUserPageLanguage];?></div>
                      <div class="collapsible-body">
                            <a href="<?php echo $base_url;?>dashboard/manage_market_features"><div class="leftMenuItem_ hvr-sweep-to-right" id="___manage_market_features"><span id="__manage_market_features" class=""></span><?php echo $page_Lang['manage_marketplace_features'][$dataUserPageLanguage];
?></div></a>
                            <a href="<?php echo $base_url;?>dashboard/manage_market_categories"><div class="leftMenuItem_ hvr-sweep-to-right" id="___manage_market_categories"><span id="__manage_market_categories" class=""></span><?php echo $page_Lang['manage_marketplace_categories'][$dataUserPageLanguage];
?></div></a>
                            <a href="<?php echo $base_url;?>dashboard/manage_market_slider_advertisements"><div class="leftMenuItem_ hvr-sweep-to-right" id="___manage_market_slider_advertisements"><span id="__manage_market_slider_advertisements" class=""></span><?php echo $page_Lang['manage_marketplace_slider_advertisements'][$dataUserPageLanguage];
?></div></a>
                            <a href="<?php echo $base_url;?>dashboard/manage_cargos"><div class="leftMenuItem_ hvr-sweep-to-right" id="___manage_cargos"><span id="__manage_cargos" class=""></span><?php echo $page_Lang['manage_cargos'][$dataUserPageLanguage];
?></div></a>
                      </div>
                    </li>
                    <li <?php echo $productClass;?>>
                      <div class="collapsible-header hvr-underline-from-center" id="post-reports"><span class="left_products_icon"></span><?php echo $page_Lang['manage_product_text'][$dataUserPageLanguage];?></div>
                      <div class="collapsible-body">
                            <a href="<?php echo $base_url;?>dashboard/manage_products"><div class="leftMenuItem_ hvr-sweep-to-right" id="___manage_products"><span id="__manage_products" class=""></span><?php echo $page_Lang['manage_products'][$dataUserPageLanguage];
?></div></a>
                            <a href="<?php echo $base_url;?>dashboard/manage_boosted_products"><div class="leftMenuItem_ hvr-sweep-to-right" id="___manage_boosted_products"><span id="__manage_boosted_products" class=""></span><?php echo $page_Lang['manage_boosted_products'][$dataUserPageLanguage];
?></div></a>
                      </div>
                    </li>
                    <li <?php echo $adsClass;?>>
                      <div class="collapsible-header hvr-underline-from-center" id="post-reports"><span class="left_ads_icon"></span><?php echo $page_Lang['advertisements'][$dataUserPageLanguage];?></div>
                      <div class="collapsible-body">
                            <a href="<?php echo $base_url;?>dashboard/ads-code-management"><div class="leftMenuItem_ hvr-sweep-to-right" id="___ads-code-management"><span id="__ads-code-management" class=""></span><?php echo $page_Lang['ads_codes_managements'][$dataUserPageLanguage];
?></div></a>
                            <a href="<?php echo $base_url;?>dashboard/advertisement-settings"><div class="leftMenuItem_ hvr-sweep-to-right" id="___advertisement-settings"><span id="__advertisement-settings" class=""></span><?php echo $page_Lang['advertisement_settings_a'][$dataUserPageLanguage];
?></div></a>
                            <a href="<?php echo $base_url;?>dashboard/createads"><div class="leftMenuItem_ hvr-sweep-to-right" id="___createads"><span id="__createads" class=""></span><?php echo $page_Lang['create_new_advertisement'][$dataUserPageLanguage];
?></div></a>
                            <a href="<?php echo $base_url;?>dashboard/manage-advertisements"><div class="leftMenuItem_ hvr-sweep-to-right" id="___manage-advertisements"><span id="__manage-advertisements" class=""></span><?php echo $page_Lang['manage_advertisements'][$dataUserPageLanguage];
?></div></a>
                      </div>
                    </li>
                    <li <?php echo $announce;?>>
                      <div class="collapsible-header hvr-underline-from-center" id="post-reports"><span class="announce_icon"></span><?php echo $page_Lang['interacting_with_members'][$dataUserPageLanguage];?></div>
                      <div class="collapsible-body">
                            <a href="<?php echo $base_url;?>dashboard/create_announcement"><div class="leftMenuItem_ hvr-sweep-to-right" id="___create_announcement"><span id="__create_announcement" class=""></span><?php echo $page_Lang['create_a_new_announcement'][$dataUserPageLanguage];
?></div></a>
                            <a href="<?php echo $base_url;?>dashboard/send_emails"><div class="leftMenuItem_ hvr-sweep-to-right" id="___send_emails"><span id="__send_emails" class=""></span><?php echo $page_Lang['send_emails'][$dataUserPageLanguage];
?></div></a>
                      </div>
                    </li>
                    <li <?php echo $themeClass;?>>
                      <div class="collapsible-header hvr-underline-from-center" id="wellcome-themes"><div class="left_themes_icon"></div><?php echo $page_Lang['script_themes'][$dataUserPageLanguage];?></div>
                      <div class="collapsible-body">
                            <a href="<?php echo $base_url;?>dashboard/wellcome-themes"><div class="leftMenuItem_ hvr-sweep-to-right" id="___wellcome-themes"><span id="__wellcome-themes" class=""></span><?php echo $page_Lang['wellcome_themes'][$dataUserPageLanguage];
?></div></a>
                            <a href="<?php echo $base_url;?>dashboard/market-themes"><div class="leftMenuItem_ hvr-sweep-to-right" id="___market-themes"><span id="__market-themes" class=""></span><?php echo $page_Lang['all_market_place_themes'][$dataUserPageLanguage];
?></div></a>
                      </div>
                    </li>
                </ul>
           </div>
           <div class="legal">
                <div class="copyright">
                    Copyright © <?php echo date("Y");
?>   <a href="javascript:void(0);"> <?php echo $dot_siteName;
?></a>.
                </div>
                <div class="version"><b>Version: </b> <?php echo $scriptVersion;?></div>
            </div>
       </div>
       <!--DashBoard Menu FINISHED-->
   </div>
   <!--Left FINISHED-->
   <!--Right Main STARTED-->
   <div class="right_main" id="adminPanel">
<?php
switch ($getp) {
	case 'dashboard':
		include ('contents/dashboard.php');
		break;
	case 'site-settings':
		include ('contents/site-settings.php');
		break;
	case 'general-settings':
		include ('contents/general-settings.php');
		break;
	case 'site-features':
		include ('contents/site-features.php');
		break;
	case 'user-management':
		include ('contents/user-management.php');
		break;
	case 'privacy_and_security':
		include ('contents/privacy_and_security.php');
		break;
	case 'blocked-users':
		include ('contents/blocked-users.php');
		break;
	case 'user-posts':
		include ('contents/user-posts.php');
		break;
	case 'post-reports':
		include ('contents/post-reports.php');
		break;
	case 'page-langauges':
		include ('contents/page-langauges.php');
		break;
	case 'wellcome-themes':
		include ('contents/wellcome-themes.php');
		break;
	case 'createads':
		include ('contents/createads.php');
		break;
	case 'manage-advertisements':
		include ('contents/manage-advertisements.php');
		break;
	case 'advertisement-settings':
		include ('contents/advertisement-settings.php');
		break;
	case 'manage-stickers':
		include ('contents/manage-stickers.php');
		break;
	case 'manage-gifs':
		include ('contents/manage-gifs.php');
		break;
	case 'manage-colors':
		include ('contents/manage-colors.php');
		break;
	case 'manage-fonts':
		include ('contents/manage-fonts.php');
		break;
	case 'manage-event-categories':
		include ('contents/manage-event-categories.php');
		break;
	case 'manage-event-covers':
		include ('contents/manage-event-covers.php');
		break;
	case 'add-new-language-keys':
		include ('contents/add-new-language-keys.php');
		break;
	case 'manage-watermarks':
		include ('contents/manage-watermarks.php');
		break;
	case 'user-text-posts':
		include ('contents/user-text-posts.php');
		break;
	case 'user-image-posts':
		include ('contents/user-image-posts.php');
		break;
	case 'user-video-posts':
		include ('contents/user-video-posts.php');
		break;
	case 'user-audio-posts':
		include ('contents/user-audio-posts.php');
		break;
	case 'user-link-posts':
		include ('contents/user-link-posts.php');
		break;
	case 'user-gif-posts':
		include ('contents/user-gif-posts.php');
		break;
	case 'user-location-posts':
		include ('contents/user-location-posts.php');
		break;
	case 'user-watermark-posts':
		include ('contents/user-watermark-posts.php');
		break;
	case 'user-benchmark-posts':
		include ('contents/user-benchmark-posts.php');
		break;
	case 'ads-code-management':
		include ('contents/ads-code-management.php');
		break;
	case 'manage-feelings':
		include ('contents/manage-feelings.php');
		break;
	case 'manage_products':
		include ('contents/manage_products.php');
		break;
	case 'manage_boosted_products':
		include ('contents/manage_boosted_products.php');
		break;
	case 'manage_market_features':
		include ('contents/manage_market_features.php');
		break;
	case 'manage_market_categories':
		include ('contents/manage_market_categories.php');
		break;
	case 'manage_market_slider_advertisements':
		include ('contents/manage_market_slider_advertisements.php');
		break;
	case 'manage-menu-icons':
		include ('contents/manage-menu-icons.php');
		break;
	case 'market-themes':
		include ('contents/market-themes.php');
		break;
	case 'payment-method-settings':
		include ('contents/payment-method-settings.php');
		break;
	case 'manage_privacy_policies':
		include ('contents/manage_privacy_policies.php');
		break;
	case 'manage_about_us':
		include ('contents/manage_about_us.php');
		break;
	case 'manage_earnings':
		include ('contents/manage_earnings.php');
		break;
	case 'manage_withdrawals':
		include ('contents/manage_withdrawals.php');
		break;
	case 'manage_points':
		include ('contents/manage_points.php');
		break;
	case 'manage_boosts':
		include ('contents/manage_boosts.php');
		break;
	case 'manage_theme_earnings':
		include ('contents/manage_theme_earnings.php');
		break;
	case 'pro_user_management':
		include ('contents/pro_user_management.php');
		break;
	case 'verified_user_management':
		include ('contents/verified_user_management.php');
		break;
	case 'pro_list_packages':
		include ('contents/pro_list_packages.php');
		break;
	case 'create_new_pro_package':
		include ('contents/create_new_pro_package.php');
		break;
	case 'manage_pro_features':
		include ('contents/manage_pro_features.php');
		break;
	case 'manage_pro_earnings':
		include ('contents/manage_pro_earnings.php');
		break;
	case 'point_settings':
		include ('contents/point_settings.php');
		break;
	case 'manage_cargos':
		include ('contents/manage_cargos.php');
		break;
	case 'create_announcement':
		include ('contents/create_announcement.php');
		break;
	case 'send_emails':
		include ('contents/send_emails.php');
		break;
	case 'manage_cities':
		include ('contents/manage_cities.php');
		break;
	case 'manage_countries':
		include ('contents/manage_countries.php');
		break;
	case 'manage_states':
		include ('contents/manage_states.php');
		break;
	case 'generate-fake-users':
		include ('contents/generate-fake-users.php');
		break;
	case 'user-beforeafter-posts':
		include ('contents/user-beforeafter-posts.php');
		break;
	case 'manage-social-share-buttons':
		include ('contents/manage-social-share-buttons.php');
		break;
	case 'manage_new_orders':
		include ('contents/manage_new_orders.php');
		break;
	case 'completed_orders':
		include ('contents/completed_orders.php');
		break;
	case 'live_streamings':
		include ('contents/live_streamings.php');
		break;
	case 'live_streamings_features':
		include ('contents/live_streamings_features.php');
		break;
	default:
		include ('contents/dashboard.php');
}
?>
</div>
   <!--Right Main FINISHED-->
   </div>
</div>
<!--Admin CONTAINER FINISHED-->
<?php
// Here is some javascript codes
include ("../contents/javascripts_vars.php");
?>
<script type="text/javascript">
//var sureWanttoBlockThisUser = '<?php echo $page_Lang['sure_want_to_block'][$dataUserPageLanguage];?>';
//var sureWanttoDeleteThisUser = '<?php echo $page_Lang['sure_delete_this_user'][$dataUserPageLanguage];?>';
//var sureWanttoRemoveBlock = '<?php echo $page_Lang['remove_block'][$dataUserPageLanguage];?>';
var delete_text = '<?php echo $page_Lang['delete_'][$dataUserPageLanguage];?>';
var been_checked = '<?php echo $page_Lang['mark_been_checked'][$dataUserPageLanguage];?>';
var reportNotChecked = '<?php echo $page_Lang['report_not_checked'][$dataUserPageLanguage];?>';
var reportChecked = '<?php echo $page_Lang['report_checked_yes'][$dataUserPageLanguage];?>';
var youseeAll = '<span class="seen_all"></span><?php echo $page_Lang['you_see_all'][$dataUserPageLanguage];?>';

var activeTheme = 'Activated';
var UseThisTheme = 'Use This Theme';
</script>
</body>
</html>