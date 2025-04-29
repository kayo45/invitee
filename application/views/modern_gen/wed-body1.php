<?php
global $settings;

if(!isset($wedding_id)) return false;

$gallery = $this->Common_model->commonQuery("select wg1.image_name as org,wg2.image_name as med,wg1.image_path
from wedding_gallery wg1 INNER JOIN wedding_gallery wg2 on wg2.parent_image_id = wg1.image_id and wg2.image_type = 'medium' WHERE wg1.image_type='original'
and wg2.wedding_id=$wedding_id ");

$kutipan_opening = $this->Common_model->commonQuery("select * from wedding_kutipan Where wedding_id = $wedding_id AND place LIKE '%opening%' ")->row_array();

$youtube_embed = $this->Common_model->commonQuery("select * from wedding_utility Where wedding_user_id = $wedding_user_id AND nama ='youtube' ")->row_array();


?>



    <!-- Greetings-->

        <section data-dce-background-color="#8D6E63" class="elementor-section elementor-top-section elementor-element elementor-element-310c5f27 elementor-section-full_width animated-slow elementor-section-height-min-height elementor-section-height-default elementor-section-items-middle wdp-sticky-section-no" data-id="310c5f27" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;animation&quot;:&quot;none&quot;,&quot;_ha_eqh_enable&quot;:false}">
            <div class="elementor-container elementor-column-gap-no">
                <div class="elementor-row">
                    <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-690ebbd5 wdp-sticky-section-no" data-id="690ebbd5" data-element_type="column">
                        <div class="elementor-column-wrap elementor-element-populated">
                            <div class="elementor-widget-wrap">
                                <div class="elementor-element elementor-element-98b3442 wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="98b3442" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                    <div class="elementor-widget-container">
                                        <h2 class="elementor-heading-title elementor-size-default">
                                            <?php echo $kutipan_opening['kutipan'] ?>
                                        </h2>
                                    </div>
                                </div>
                                

                                <!-- Embed Youtube -->
                                <!--<div class="elementor-element elementor-element-5e738c9 wdp-sticky-section-no elementor-widget elementor-widget-video" data-id="5e738c9" data-element_type="widget" data-settings="{&quot;youtube_url&quot;:&quot;<?php echo $youtube_embed['konten'] ?>&quot;,&quot;autoplay&quot;:&quot;yes&quot;,&quot;play_on_mobile&quot;:&quot;yes&quot;,&quot;mute&quot;:&quot;yes&quot;,&quot;loop&quot;:&quot;yes&quot;,&quot;video_type&quot;:&quot;youtube&quot;,&quot;controls&quot;:&quot;yes&quot;}" data-widget_type="video.default">-->
                                <!--    <div class="elementor-widget-container">-->
                                <!--        <div class="elementor-wrapper elementor-open-inline">-->
                                <!--            <div class="elementor-video"></div>-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</div>-->

                                <!-- Slider Gallery -->
                                <div class="elementor-element elementor-element-5068c971 wdp-sticky-section-no elementor-widget elementor-widget-image-carousel" data-id="5068c971" data-element_type="widget" data-settings="{&quot;slides_to_show&quot;:&quot;4&quot;,&quot;slides_to_show_mobile&quot;:&quot;3&quot;,&quot;autoplay_speed&quot;:1000,&quot;speed&quot;:6000,&quot;image_spacing_custom&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:5,&quot;sizes&quot;:[]},&quot;slides_to_scroll_mobile&quot;:&quot;2&quot;,&quot;navigation&quot;:&quot;none&quot;,&quot;autoplay&quot;:&quot;yes&quot;,&quot;pause_on_hover&quot;:&quot;yes&quot;,&quot;pause_on_interaction&quot;:&quot;yes&quot;,&quot;infinite&quot;:&quot;yes&quot;,&quot;image_spacing_custom_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;image_spacing_custom_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]}}" data-widget_type="image-carousel.default">
                                    <div class="elementor-widget-container">
                                        <div class="elementor-image-carousel-wrapper swiper-container" dir="ltr">
                                            <div class="elementor-image-carousel swiper-wrapper">
                                            <?php
                                                foreach($gallery->result() as $rw){
                                                    $thumb_img_name = $myHelpers->global_lib->get_image_type($rw->image_path, $rw->org);
                                            ?>

                                            <?php if(!empty($thumb_img_name)){ ?>
                                                <div class="swiper-slide" >
                                                    <figure class="swiper-slide-inner">
                                                        <img width="400" height="400" decoding="async" class="swiper-slide-image" 
                                                        src="<?php echo base_url().$rw->image_path.$thumb_img_name; ?>" alt="<?php echo $thumb_img_name ?>"/>
                                                    </figure>
                                                </div>
                                                <?php } ?>

                                            <?php } ?>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-14de85b3 wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="14de85b3" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                    <div class="elementor-widget-container">
                                        <h2 class="elementor-heading-title elementor-size-default">Kedua Mempelai</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <!--//END Greetings-->




    <!--Couple Info-->

        <section data-dce-background-color="#313131" class="elementor-section elementor-top-section elementor-element elementor-element-1351661a elementor-section-full_width elementor-section-height-default elementor-section-height-default wdp-sticky-section-no" data-id="1351661a" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;_ha_eqh_enable&quot;:false}">
            <div class="elementor-background-overlay"></div>
            <div class="elementor-container elementor-column-gap-no">
                <div class="elementor-row">
                    <div data-dce-background-color="#FFFFFF" class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-dca6378 wdp-sticky-section-no" data-id="dca6378" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                        <div class="elementor-column-wrap elementor-element-populated">
                            <div class="elementor-widget-wrap">
                                <div class="elementor-element elementor-element-55fa08e4 wdp-sticky-section-no elementor-widget elementor-widget-spacer" data-id="55fa08e4" data-element_type="widget" data-widget_type="spacer.default">
                                    <div class="elementor-widget-container">
                                        <div class="elementor-spacer">
                                            <div class="elementor-spacer-inner"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-2cf3264f e-transform wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="2cf3264f" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_transform_rotateZ_effect_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:-90,&quot;sizes&quot;:[]},&quot;_transform_rotateZ_effect&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:-90,&quot;sizes&quot;:[]},&quot;_transform_rotateZ_effect_tablet&quot;:{&quot;unit&quot;:&quot;deg&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]}}" data-widget_type="heading.default">
                                    <div class="elementor-widget-container">
                                        <h2 class="elementor-heading-title elementor-size-default">Bride</h2>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-736a7576 wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="736a7576" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                    <div class="elementor-widget-container">
                                        <h2 class="elementor-heading-title elementor-size-default">The</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-66997293 wdp-sticky-section-no" data-id="66997293" data-element_type="column"
                    data-settings="{&quot;background_background&quot;:&quot;slideshow&quot;,&quot;background_slideshow_gallery&quot;:[{&quot;id&quot;:12,&quot;url&quot;:&quot;<?php echo str_replace('/', '\\/', base_url().'uploads/weddings/'.$couple->row()->bride_photo) ?>&quot;},{&quot;id&quot;:56,&quot;url&quot;:&quot;<?php echo str_replace('/', '\\/', base_url().'uploads/weddings/'.$couple->row()->bride_photo_bg) ?>&quot;}],&quot;background_slideshow_slide_duration&quot;:0,&quot;background_slideshow_slide_transition&quot;:&quot;slide_right&quot;,&quot;background_slideshow_transition_duration&quot;:8000,&quot;background_slideshow_loop&quot;:&quot;yes&quot;}">
                        <div class="elementor-column-wrap elementor-element-populated">
                            <div class="elementor-widget-wrap">
                                <div class="elementor-element elementor-element-5efcb30b wdp-sticky-section-no elementor-widget elementor-widget-spacer" data-id="5efcb30b" data-element_type="widget" data-widget_type="spacer.default">
                                    <div class="elementor-widget-container">
                                        <div class="elementor-spacer">
                                            <div class="elementor-spacer-inner"></div>
                                        </div>
                                    </div>
                                </div>
                                <section data-dce-background-color="#0E090933" class="elementor-section elementor-inner-section elementor-element elementor-element-188a5b23 elementor-section-full_width elementor-section-height-default elementor-section-height-default wdp-sticky-section-no" data-id="188a5b23" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;_ha_eqh_enable&quot;:false}">
                                    <div class="elementor-container elementor-column-gap-no">
                                        <div class="elementor-row">
                                            <div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-3f7bf8c5 wdp-sticky-section-no" data-id="3f7bf8c5" data-element_type="column">
                                                <div class="elementor-column-wrap elementor-element-populated">
                                                    <div class="elementor-widget-wrap">
                                                        <div class="elementor-element elementor-element-5a471fc3 wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="5a471fc3" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                                            <div class="elementor-widget-container">
                                                                <h2 class="elementor-heading-title elementor-size-default">  <?php echo $couple->row()->bride_name ?></h2>
                                                            </div>
                                                        </div>
                                                        <div class="elementor-element elementor-element-85e636c elementor-mobile-align-right elementor-icon-list--layout-traditional elementor-list-item-link-full_width wdp-sticky-section-no elementor-widget elementor-widget-icon-list" data-id="85e636c" data-element_type="widget" data-widget_type="icon-list.default">
                                                            <div class="elementor-widget-container">
                                                                <ul class="elementor-icon-list-items">
                                                                <?php $data = json_decode($couple->row()->bride_social_links);
                                                                    foreach($data as $key=>$value){ ?>
                                                                    <li class="elementor-icon-list-item">
                                                                            <?php if(!empty($value)){ ?>
                                                                            <a href="https://<?php echo $key; ?>.com/<?php echo $value; ?>/">
                                                                                <span class="elementor-icon-list-icon">
                                                                                    <i aria-hidden="true" class="fab fa-<?php echo $key; ?>"></i>
                                                                                </span>
                                                                                <span class="elementor-icon-list-text">@<?php echo $value; ?></span>
                                                                            </a>
                                                                        <?php } ?>
                                                                    </li>
                                                                    <?php } ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="elementor-element elementor-element-73b5ae82 wdp-sticky-section-no elementor-widget elementor-widget-heading" data-id="73b5ae82" data-element_type="widget" data-widget_type="heading.default">
                                                            <div class="elementor-widget-container">
                                                                <h2 class="elementor-heading-title elementor-size-default"><?php echo $couple->row()->bride_name ?></h2>
                                                            </div>
                                                        </div>
                                                        <div class="elementor-element elementor-element-15b4513c wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="15b4513c" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                                            <div class="elementor-widget-container">
                                                                <h2 class="elementor-heading-title elementor-size-default">
                                                                    <?php echo $couple->row()->bride_short_description ?>

                                                                </h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section data-dce-background-color="#8D6E63" class="elementor-section elementor-top-section elementor-element elementor-element-59b71fed elementor-section-height-min-height elementor-section-boxed elementor-section-height-default elementor-section-items-middle wdp-sticky-section-no" data-id="59b71fed" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;_ha_eqh_enable&quot;:false}">
            <div class="elementor-container elementor-column-gap-default">
                <div class="elementor-row">
                    <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-6a3ccd05 wdp-sticky-section-no" data-id="6a3ccd05" data-element_type="column">
                        <div class="elementor-column-wrap elementor-element-populated">
                            <div class="elementor-widget-wrap">
                                <div class="elementor-element elementor-element-5526a05f wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="5526a05f" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                    <div class="elementor-widget-container">
                                        <h2 class="elementor-heading-title elementor-size-default">I choose you</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section data-dce-background-color="#E3FCBF" class="elementor-section elementor-top-section elementor-element elementor-element-7bd3385 elementor-section-full_width elementor-section-height-default elementor-section-height-default wdp-sticky-section-no" data-id="7bd3385" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;_ha_eqh_enable&quot;:false}">
            <div class="elementor-background-overlay"></div>
            <div class="elementor-container elementor-column-gap-no">
                <div class="elementor-row">
                    <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-36dd1671 wdp-sticky-section-no" data-id="36dd1671" data-element_type="column" 
                        data-settings="{&quot;background_background&quot;:&quot;slideshow&quot;,&quot;background_slideshow_gallery&quot;:[{&quot;id&quot;:12,&quot;url&quot;:&quot;<?php echo str_replace('/', '\\/', base_url().'uploads/weddings/'.$couple->row()->groom_photo) ?>&quot;},{&quot;id&quot;:56,&quot;url&quot;:&quot;<?php echo str_replace('/', '\\/', base_url().'uploads/weddings/'.$couple->row()->groom_photo_bg) ?>&quot;}],&quot;background_slideshow_slide_duration&quot;:0,&quot;background_slideshow_slide_transition&quot;:&quot;slide_right&quot;,&quot;background_slideshow_transition_duration&quot;:8000,&quot;background_slideshow_loop&quot;:&quot;yes&quot;}">
                        <div class="elementor-column-wrap elementor-element-populated">
                            <div class="elementor-widget-wrap">
                                <div class="elementor-element elementor-element-7b15863b wdp-sticky-section-no elementor-widget elementor-widget-spacer" data-id="7b15863b" data-element_type="widget" data-widget_type="spacer.default">
                                    <div class="elementor-widget-container">
                                        <div class="elementor-spacer">
                                            <div class="elementor-spacer-inner"></div>
                                        </div>
                                    </div>
                                </div>
                                <section data-dce-background-color="#0E090933" class="elementor-section elementor-inner-section elementor-element elementor-element-708ecd0c elementor-section-full_width elementor-section-height-default elementor-section-height-default wdp-sticky-section-no" data-id="708ecd0c" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;_ha_eqh_enable&quot;:false}">
                                    <div class="elementor-container elementor-column-gap-no">
                                        <div class="elementor-row">
                                            <div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-1ece98ff wdp-sticky-section-no" data-id="1ece98ff" data-element_type="column">
                                                <div class="elementor-column-wrap elementor-element-populated">
                                                    <div class="elementor-widget-wrap">
                                                        <div class="elementor-element elementor-element-7100999b wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="7100999b" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                                            <div class="elementor-widget-container">
                                                                <h2 class="elementor-heading-title elementor-size-default"> <?php echo $couple->row()->groom_name ?></h2>
                                                            </div>
                                                        </div>
                                                        <div class="elementor-element elementor-element-d606483 elementor-mobile-align-left elementor-icon-list--layout-traditional elementor-list-item-link-full_width wdp-sticky-section-no elementor-widget elementor-widget-icon-list" data-id="d606483" data-element_type="widget" data-widget_type="icon-list.default">
                                                            <div class="elementor-widget-container">
                                                                <ul class="elementor-icon-list-items">
                                                                    <?php $data = json_decode($couple->row()->groom_social_links);
                                                                    foreach($data as $key=>$value){ ?>
                                                                    <li class="elementor-icon-list-item">

                                                                            <?php if(!empty($value)){ ?>
                                                                            <a href="https://<?php echo $key; ?>.com/<?php echo $value; ?>/">
                                                                                <span class="elementor-icon-list-icon">
                                                                                    <i aria-hidden="true" class="fab fa-<?php echo $key; ?>"></i>
                                                                                </span>
                                                                                <span class="elementor-icon-list-text">@<?php echo $value; ?></span>
                                                                            </a>
                                                                        <?php }?>
                                                                    </li>
                                                                    <?php } ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="elementor-element elementor-element-422f2580 wdp-sticky-section-no elementor-widget elementor-widget-heading" data-id="422f2580" data-element_type="widget" data-widget_type="heading.default">
                                                            <div class="elementor-widget-container">
                                                                <h2 class="elementor-heading-title elementor-size-default"> <?php echo $couple->row()->groom_name ?></h2>
                                                            </div>
                                                        </div>
                                                        <div class="elementor-element elementor-element-4afe74f0 wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="4afe74f0" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                                            <div class="elementor-widget-container">
                                                                <h2 class="elementor-heading-title elementor-size-default">
                                                                    <?php echo $couple->row()->groom_short_description ?>
                                                                </h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                    <div data-dce-background-color="#FFFFFF" class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-87bd471 wdp-sticky-section-no" data-id="87bd471" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                        <div class="elementor-column-wrap elementor-element-populated">
                            <div class="elementor-widget-wrap">
                                <div class="elementor-element elementor-element-bf2623e wdp-sticky-section-no elementor-widget elementor-widget-spacer" data-id="bf2623e" data-element_type="widget" data-widget_type="spacer.default">
                                    <div class="elementor-widget-container">
                                        <div class="elementor-spacer">
                                            <div class="elementor-spacer-inner"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-18aa3392 e-transform wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="18aa3392" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_transform_rotateZ_effect_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:-90,&quot;sizes&quot;:[]},&quot;_transform_rotateZ_effect&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:-90,&quot;sizes&quot;:[]},&quot;_transform_rotateZ_effect_tablet&quot;:{&quot;unit&quot;:&quot;deg&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]}}" data-widget_type="heading.default">
                                    <div class="elementor-widget-container">
                                        <h2 class="elementor-heading-title elementor-size-default">Groom</h2>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-6b9f57e wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="6b9f57e" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                    <div class="elementor-widget-container">
                                        <h2 class="elementor-heading-title elementor-size-default">The</h2>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-74304030 wdp-sticky-section-no elementor-widget elementor-widget-spacer" data-id="74304030" data-element_type="widget" data-widget_type="spacer.default">
                                    <div class="elementor-widget-container">
                                        <div class="elementor-spacer">
                                            <div class="elementor-spacer-inner"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <!--//END Couple Info-->
