<?php
global $settings;

$url = $_SERVER['REQUEST_URI'];

    $url_components = parse_url($url);

    $get_nama = $this->input->get('nama', TRUE);


    if(!empty($get_nama)){

        $nama_undangan = str_replace('-', ' ', $get_nama);

    }

if(!isset($wedding_id)) return false;

$gallery = $this->Common_model->commonQuery("select wg1.image_name as org,wg2.image_name as med,wg1.image_path
from wedding_gallery wg1 INNER JOIN wedding_gallery wg2 on wg2.parent_image_id = wg1.image_id and wg2.image_type = 'medium' WHERE wg1.image_type='original'
and wg2.wedding_id=$wedding_id ");


$kutipan_ourlove = $this->Common_model->commonQuery("select * from wedding_kutipan Where wedding_id = $wedding_id AND place LIKE '%our-love%' ")->row_array();

$kutipan_filterig = $this->Common_model->commonQuery("select * from wedding_kutipan Where wedding_id = $wedding_id AND place LIKE '%filter-ig%' ")->row_array();

$kutipan_weeding_gifts = $this->Common_model->commonQuery("select * from wedding_kutipan Where wedding_id = $wedding_id AND place LIKE '%wedding-gifts%' ")->row_array();

$akad = $this->Common_model->commonQuery("select * from wedding_event Where wedding_user_id = $wedding_user_id AND event_place LIKE '%akad%' ")->row_array();

$resepsi = $this->Common_model->commonQuery("select * from wedding_event Where wedding_user_id = $wedding_user_id AND event_place LIKE '%resepsi%' ")->row_array();



$img_our_love1 = $this->Common_model->commonQuery("select * from wedding_slider Where wedding_user_id = $wedding_user_id AND wedding_id = $wedding_id AND place LIKE '%our-love%' order by img_order asc ")->row_array();

$img_our_love2 = $this->Common_model->commonQuery("select * from wedding_slider Where wedding_user_id = $wedding_user_id AND wedding_id = $wedding_id AND place LIKE '%our-love%' order by img_order desc ")->row_array();


$img_filterig1 = $this->Common_model->commonQuery("select * from wedding_slider Where wedding_user_id = $wedding_user_id AND wedding_id = $wedding_id AND place LIKE '%filter-ig%' order by img_order asc ")->row_array();

$img_filterig2 = $this->Common_model->commonQuery("select * from wedding_slider Where wedding_user_id = $wedding_user_id AND wedding_id = $wedding_id AND place LIKE '%filter-ig%' order by img_order desc ")->row_array();


$wedding_gifts1 = $this->Common_model->commonQuery("select * from wedding_slider Where wedding_user_id = $wedding_user_id AND wedding_id = $wedding_id AND place LIKE '%wedding-gifts%' order by img_order asc ")->row_array();

$wedding_gifts2 = $this->Common_model->commonQuery("select * from wedding_slider Where wedding_user_id = $wedding_user_id AND wedding_id = $wedding_id AND place LIKE '%wedding-gifts%' order by img_order desc ")->row_array();


$rek_bank = $this->Common_model->commonQuery("select * from wedding_bank_gift Where wedding_user_id = $wedding_user_id ")->result_array();


$youtube_embed = $this->Common_model->commonQuery("select * from wedding_utility Where wedding_user_id = $wedding_user_id AND nama ='youtube' ")->row_array();

$audio_embed = $this->Common_model->commonQuery("select * from wedding_utility Where wedding_user_id = $wedding_user_id AND nama ='audio' ")->row_array();

$filter_ig_embed = $this->Common_model->commonQuery("select * from wedding_utility Where wedding_user_id = $wedding_user_id AND nama ='filter_ig' ")->row_array();


$comment_id = $this->Common_model->commonQuery("select * from wedding_comment Where wedding_user_id = $wedding_user_id ")->row_array();



?>


                <!-- Akad -->
                <section data-dce-background-color="#8D6E63" class="elementor-section elementor-top-section elementor-element elementor-element-659fea43 elementor-section-full_width elementor-section-height-default elementor-section-height-default wdp-sticky-section-no" data-id="659fea43" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;_ha_eqh_enable&quot;:false}">
                    <div class="elementor-container elementor-column-gap-no">
                        <div class="elementor-row">
                            <div data-dce-background-color="#FFFFFF" class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-3731950b wdp-sticky-section-no" data-id="3731950b" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-element-560b75fb wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-image" data-id="560b75fb" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="image.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-image">
                                                    <img decoding="async" fetchpriority="high" width="1065" height="1600" src="<?php echo str_replace('/', '\\/', base_url().'uploads/event/'.$akad['event_image']) ?>" class="attachment-full size-full wp-image-99782" alt="" srcset="<?php echo str_replace('/', '\\/', base_url().'uploads/event/'.$akad['event_image']) ?> 1065w, <?php echo str_replace('/', '\\/', base_url().'uploads/event/'.$akad['event_image']) ?> 200w, <?php echo str_replace('/', '\\/', base_url().'uploads/event/'.$akad['event_image']) ?> 682w, <?php echo str_replace('/', '\\/', base_url().'uploads/event/'.$akad['event_image']) ?> 768w, <?php echo str_replace('/', '\\/', base_url().'uploads/event/'.$akad['event_image']) ?> 1022w" sizes="(max-width: 1065px) 100vw, 1065px">
                                                </div>
                                            </div>
                                        </div>
                                        <section data-dce-background-color="#A1887F" class="elementor-section elementor-inner-section elementor-element elementor-element-41a2b65d elementor-section-boxed elementor-section-height-default elementor-section-height-default wdp-sticky-section-no" data-id="41a2b65d" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;_ha_eqh_enable&quot;:false}">
                                            <div class="elementor-container elementor-column-gap-default">
                                                <div class="elementor-row">
                                                    <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-186466b wdp-sticky-section-no" data-id="186466b" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                                        <div class="elementor-column-wrap elementor-element-populated">
                                                            <div class="elementor-widget-wrap">
                                                                <div class="elementor-element elementor-element-50dbc3b0 e-transform wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="50dbc3b0" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_transform_rotateZ_effect_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:-90,&quot;sizes&quot;:[]},&quot;_transform_rotateZ_effect&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:-90,&quot;sizes&quot;:[]},&quot;_transform_rotateZ_effect_tablet&quot;:{&quot;unit&quot;:&quot;deg&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]}}" data-widget_type="heading.default">
                                                                    <div class="elementor-widget-container">
                                                                        <h2 class="elementor-heading-title elementor-size-default">Nikah</h2>
                                                                    </div>
                                                                </div>
                                                                <div class="elementor-element elementor-element-2a21772f e-transform wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="2a21772f" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_transform_rotateZ_effect_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:-90,&quot;sizes&quot;:[]},&quot;_transform_rotateZ_effect&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:-90,&quot;sizes&quot;:[]},&quot;_transform_rotateZ_effect_tablet&quot;:{&quot;unit&quot;:&quot;deg&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]}}" data-widget_type="heading.default">
                                                                    <div class="elementor-widget-container">
                                                                        <h2 class="elementor-heading-title elementor-size-default">Akad</h2>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-6d694152 wdp-sticky-section-no" data-id="6d694152" data-element_type="column">
                                                        <div class="elementor-column-wrap elementor-element-populated">
                                                            <div class="elementor-widget-wrap">
                                                                <div class="elementor-element elementor-element-5caa01b5 wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="5caa01b5" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                                                    <div class="elementor-widget-container">
                                                                        <h2 class="elementor-heading-title elementor-size-default"><?php echo tanggal(date('D',$akad['event_date'])) ?></h2>
                                                                    </div>
                                                                </div>
                                                                <div class="elementor-element elementor-element-7dc54eaf wdp-sticky-section-no elementor-widget elementor-widget-counter" data-id="7dc54eaf" data-element_type="widget" data-widget_type="counter.default">
                                                                    <div class="elementor-widget-container">
                                                                        <div class="elementor-counter">
                                                                            <div class="elementor-counter-number-wrapper">
                                                                                <span class="elementor-counter-number-prefix"></span>
                                                                                <span class="elementor-counter-number" data-duration="2000" data-to-value="<?php echo date('d',$akad['event_date']) ?>" data-from-value="30" data-delimiter=",">30</span>
                                                                                <span class="elementor-counter-number-suffix"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="elementor-element elementor-element-1860bbf0 wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="1860bbf0" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                                                    <div class="elementor-widget-container">
                                                                        <h2 class="elementor-heading-title elementor-size-default"> <?php echo date('M',$akad['event_date']); ?> <?php echo date('Y',$akad['event_date']); ?></h2>
                                                                    </div>
                                                                </div>
                                                                <div class="elementor-element elementor-element-1c029d7a wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="1c029d7a" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                                                    <div class="elementor-widget-container">
                                                                        <h2 class="elementor-heading-title elementor-size-default">
                                                                        Pukul <?php echo date("h:i ", strtotime($akad['event_time'])) ?> WIB s/d  <?php echo $akad['event_time_end'] ?> WIB</h2>
                                                                    </div>
                                                                </div>
                                                                <div class="elementor-element elementor-element-bf5db wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="bf5db" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                                                    <div class="elementor-widget-container">
                                                                        <h2 class="elementor-heading-title elementor-size-default">
                                                                                <?php echo $akad['event_venue'] ?>
                                                                        </h2>
                                                                    </div>
                                                                </div>
                                                                <div data-dce-background-color="#FFFFFF00" class="elementor-element elementor-element-35a0031a elementor-mobile-align-center elementor-align-center wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-button" data-id="35a0031a" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="button.default">
                                                                    <div class="elementor-widget-container">
                                                                        <div class="elementor-button-wrapper">
                                                                            <a href="<?php echo $akad['openstreetmap_embed_code'] ?>" class="elementor-button-link elementor-button elementor-size-sm" role="button">
                                                                                <span class="elementor-button-content-wrapper">
                                                                                    <span class="elementor-button-icon elementor-align-icon-left">
                                                                                        <i aria-hidden="true" class="fas fa-map-marker-alt"></i>
                                                                                    </span>
                                                                                    <span class="elementor-button-text">Open Maps</span>
                                                                                </span>
                                                                            </a>
                                                                        </div>
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

                
                <!-- Our Love -->
                <section class="elementor-section elementor-top-section elementor-element elementor-element-42fde6de elementor-section-full_width elementor-section-height-min-height elementor-section-height-default elementor-section-items-middle wdp-sticky-section-no" data-id="42fde6de" data-element_type="section" 
                    data-settings="{&quot;background_background&quot;:&quot;slideshow&quot;,&quot;background_slideshow_gallery&quot;:[{&quot;id&quot;:99794,&quot;url&quot;:&quot;<?php echo base_url('uploads/slider/').$img_our_love1['slide_img'] ?>&quot;},{&quot;id&quot;:99795,&quot;url&quot;:&quot;<?php echo base_url('uploads/slider/').$img_our_love2['slide_img'] ?>&quot;}],&quot;background_slideshow_slide_duration&quot;:1000,&quot;background_slideshow_transition_duration&quot;:2000,&quot;background_slideshow_loop&quot;:&quot;yes&quot;,&quot;background_slideshow_slide_transition&quot;:&quot;fade&quot;,&quot;_ha_eqh_enable&quot;:false}">
                    <div class="elementor-container elementor-column-gap-no">
                        <div class="elementor-row">
                            <div data-dce-background-color="#0201011C" class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-417edc10 wdp-sticky-section-no" data-id="417edc10" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-element-1ca5eb9d wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="1ca5eb9d" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                            <div class="elementor-widget-container">
                                                <h2 class="elementor-heading-title elementor-size-default">Our Love</h2>
                                            </div>
                                        </div>
                                        <div class="elementor-element elementor-element-4859dfbe wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="4859dfbe" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                            <div class="elementor-widget-container">
                                                <h2 class="elementor-heading-title elementor-size-default">
                                                    <?php echo $kutipan_ourlove['kutipan']; ?>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>



                <!-- Counter Mid -->
                <section class="elementor-section elementor-top-section elementor-element elementor-element-4b6bc56a elementor-section-full_width elementor-section-height-min-height elementor-hidden-desktop elementor-hidden-tablet elementor-hidden-mobile elementor-section-height-default elementor-section-items-middle wdp-sticky-section-no" data-id="4b6bc56a" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;slideshow&quot;,&quot;background_slideshow_gallery&quot;:[{&quot;id&quot;:&quot;790&quot;,&quot;url&quot;:&quot;https:\/\/ts-invitation.com\/wp-content\/uploads\/2023\/05\/rose-sage-11.jpg&quot;},{&quot;id&quot;:&quot;791&quot;,&quot;url&quot;:&quot;https:\/\/ts-invitation.com\/wp-content\/uploads\/2023\/05\/rose-sage-36.jpg&quot;},{&quot;id&quot;:&quot;792&quot;,&quot;url&quot;:&quot;https:\/\/ts-invitation.com\/wp-content\/uploads\/2023\/05\/rose-sage-14.jpg&quot;}],&quot;background_slideshow_slide_duration&quot;:1000,&quot;background_slideshow_transition_duration&quot;:2000,&quot;background_slideshow_loop&quot;:&quot;yes&quot;,&quot;background_slideshow_slide_transition&quot;:&quot;fade&quot;,&quot;_ha_eqh_enable&quot;:false}">
                    <div class="elementor-container elementor-column-gap-no">
                        <div class="elementor-row">
                            <div data-dce-background-color="#0201013D" class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-2fb477cd wdp-sticky-section-no" data-id="2fb477cd" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-element-772846c6 wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="772846c6" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                            <div class="elementor-widget-container">
                                                <h2 class="elementor-heading-title elementor-size-default">From this time</h2>
                                            </div>
                                        </div>
                                        <div class="elementor-element elementor-element-3f76f083 wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="3f76f083" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                            <div class="elementor-widget-container">
                                                <h2 class="elementor-heading-title elementor-size-default">You are the one</h2>
                                            </div>
                                        </div>
                                        <div class="elementor-element elementor-element-35af9619 wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-weddingpress-countdown" data-id="35af9619" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="weddingpress-countdown.default">
                                            <div class="elementor-widget-container">
                                                <div class="wpkoi-elements-countdown-wrapper">
                                                    <div class="wpkoi-elements-countdown-container wpkoi-elements-countdown-label-block ">
                                                        <ul id="wpkoi-elements-countdown-35af9619" class="wpkoi-elements-countdown-items" data-date="Mar 02 2024 11:00:00">
                                                            <li class="wpkoi-elements-countdown-item">
                                                                <div class="wpkoi-elements-countdown-days">
                                                                    <span data-days class="wpkoi-elements-countdown-digits">00</span>
                                                                    <span class="wpkoi-elements-countdown-label">Days</span>
                                                                </div>
                                                            </li>
                                                            <li class="wpkoi-elements-countdown-item">
                                                                <div class="wpkoi-elements-countdown-hours">
                                                                    <span data-hours class="wpkoi-elements-countdown-digits">00</span>
                                                                    <span class="wpkoi-elements-countdown-label">Hours</span>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                                <script type="text/javascript">
                                                    jQuery(document).ready(function($) {
                                                        'use strict';
                                                        $("#wpkoi-elements-countdown-35af9619").countdown();
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                        <div class="elementor-element elementor-element-3ac23a1f wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-weddingpress-countdown" data-id="3ac23a1f" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="weddingpress-countdown.default">
                                            <div class="elementor-widget-container">
                                                <div class="wpkoi-elements-countdown-wrapper">
                                                    <div class="wpkoi-elements-countdown-container wpkoi-elements-countdown-label-block ">
                                                        <ul id="wpkoi-elements-countdown-3ac23a1f" class="wpkoi-elements-countdown-items" data-date="Mar 02 2024 11:00:00">
                                                            <li class="wpkoi-elements-countdown-item">
                                                                <div class="wpkoi-elements-countdown-minutes">
                                                                    <span data-minutes class="wpkoi-elements-countdown-digits">00</span>
                                                                    <span class="wpkoi-elements-countdown-label">Minutes</span>
                                                                </div>
                                                            </li>
                                                            <li class="wpkoi-elements-countdown-item">
                                                                <div class="wpkoi-elements-countdown-seconds">
                                                                    <span data-seconds class="wpkoi-elements-countdown-digits">00</span>
                                                                    <span class="wpkoi-elements-countdown-label">Seconds</span>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                                <script type="text/javascript">
                                                    jQuery(document).ready(function($) {
                                                        'use strict';
                                                        $("#wpkoi-elements-countdown-3ac23a1f").countdown();
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>



                <!-- Resepsi -->
                <section data-dce-background-color="#8D6E63" class="elementor-section elementor-top-section elementor-element elementor-element-4b41f167 elementor-section-height-min-height elementor-section-full_width elementor-section-height-default elementor-section-items-middle wdp-sticky-section-no" data-id="4b41f167" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;_ha_eqh_enable&quot;:false}">
                    <div class="elementor-container elementor-column-gap-no">
                        <div class="elementor-row">
                            <div data-dce-background-color="#FFFFFF" class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-480e2f1e wdp-sticky-section-no" data-id="480e2f1e" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-element-bb889ba wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-image" data-id="bb889ba" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="image.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-image">
                                                    <img decoding="async" fetchpriority="high" width="1065" height="1600" src="<?php echo str_replace('/', '\\/', base_url().'uploads/event/'.$resepsi['event_image']) ?>" class="attachment-full size-full wp-image-99782" alt="" srcset="<?php echo str_replace('/', '\\/', base_url().'uploads/event/'.$resepsi['event_image']) ?> 1065w, <?php echo str_replace('/', '\\/', base_url().'uploads/event/'.$resepsi['event_image']) ?> 200w, <?php echo str_replace('/', '\\/', base_url().'uploads/event/'.$resepsi['event_image']) ?> 682w, <?php echo str_replace('/', '\\/', base_url().'uploads/event/'.$resepsi['event_image']) ?> 768w, <?php echo str_replace('/', '\\/', base_url().'uploads/event/'.$resepsi['event_image']) ?> 1022w" sizes="(max-width: 1065px) 100vw, 1065px">
                                                </div>
                                            </div>
                                        </div>
                                        <section data-dce-background-color="#A1887F" class="elementor-section elementor-inner-section elementor-element elementor-element-23cf9972 elementor-section-boxed elementor-section-height-default elementor-section-height-default wdp-sticky-section-no" data-id="23cf9972" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;_ha_eqh_enable&quot;:false}">
                                            <div class="elementor-container elementor-column-gap-default">
                                                <div class="elementor-row">
                                                    <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-2547bb81 wdp-sticky-section-no" data-id="2547bb81" data-element_type="column">
                                                        <div class="elementor-column-wrap elementor-element-populated">
                                                            <div class="elementor-widget-wrap">
                                                                <div class="elementor-element elementor-element-19e5f8de wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="19e5f8de" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                                                    <div class="elementor-widget-container">
                                                                        <h2 class="elementor-heading-title elementor-size-default"> <?php echo tanggal(date('D',$resepsi['event_date'])) ?> </h2>
                                                                    </div>
                                                                </div>
                                                                <div class="elementor-element elementor-element-77b2b702 wdp-sticky-section-no elementor-widget elementor-widget-counter" data-id="77b2b702" data-element_type="widget" data-widget_type="counter.default">
                                                                    <div class="elementor-widget-container">
                                                                        <div class="elementor-counter">
                                                                            <div class="elementor-counter-number-wrapper">
                                                                                <span class="elementor-counter-number-prefix"></span>
                                                                                <span class="elementor-counter-number" data-duration="2000" data-to-value="<?php echo date('d',$resepsi['event_date']) ?>" data-from-value="30" data-delimiter=",">30</span>
                                                                                <span class="elementor-counter-number-suffix"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="elementor-element elementor-element-87251e7 wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="87251e7" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                                                    <div class="elementor-widget-container">
                                                                        <h2 class="elementor-heading-title elementor-size-default"><?php echo date('M',$resepsi['event_date']); ?> <?php echo date('Y',$resepsi['event_date']); ?></h2>
                                                                    </div>
                                                                </div>
                                                                <div class="elementor-element elementor-element-42c5373d wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="42c5373d" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                                                    <div class="elementor-widget-container">
                                                                        <h2 class="elementor-heading-title elementor-size-default">
                                                                       Pukul <?php echo date("h:i ", strtotime($resepsi['event_time'])) ?> WIB s/d  <?php echo $resepsi['event_time_end'] ?> </h2>
                                                                    </div>
                                                                </div>
                                                                <div class="elementor-element elementor-element-98f5c6b wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="98f5c6b" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                                                    <div class="elementor-widget-container">
                                                                        <h2 class="elementor-heading-title elementor-size-default">
                                                                            <?php echo $resepsi['event_venue'] ?>
                                                                        </h2>
                                                                    </div>
                                                                </div>
                                                                <div data-dce-background-color="#FFFFFF00" class="elementor-element elementor-element-5cc7bb4 elementor-mobile-align-center elementor-align-center wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-button" data-id="5cc7bb4" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="button.default">
                                                                    <div class="elementor-widget-container">
                                                                        <div class="elementor-button-wrapper">
                                                                            <a href="<?php echo $resepsi['openstreetmap_embed_code'] ?>" class="elementor-button-link elementor-button elementor-size-sm" role="button">
                                                                                <span class="elementor-button-content-wrapper">
                                                                                    <span class="elementor-button-icon elementor-align-icon-left">
                                                                                        <i aria-hidden="true" class="fas fa-map-marker-alt"></i>
                                                                                    </span>
                                                                                    <span class="elementor-button-text">Open Maps</span>
                                                                                </span>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-697ff626 wdp-sticky-section-no" data-id="697ff626" data-element_type="column">
                                                        <div class="elementor-column-wrap elementor-element-populated">
                                                            <div class="elementor-widget-wrap">
                                                                <div class="elementor-element elementor-element-326c8cd6 e-transform wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="326c8cd6" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_transform_rotateZ_effect_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:-90,&quot;sizes&quot;:[]},&quot;_transform_rotateZ_effect&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:-90,&quot;sizes&quot;:[]},&quot;_transform_rotateZ_effect_tablet&quot;:{&quot;unit&quot;:&quot;deg&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]}}" data-widget_type="heading.default">
                                                                    <div class="elementor-widget-container">
                                                                        <h2 class="elementor-heading-title elementor-size-default">Resepsi</h2>
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


                <!-- Filter Ig  -->
                <section class="elementor-section elementor-top-section elementor-element elementor-element-433073e elementor-section-full_width elementor-section-height-min-height elementor-section-height-default elementor-section-items-middle wdp-sticky-section-no" data-id="433073e"
                    data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;slideshow&quot;,&quot;background_slideshow_gallery&quot;:[{&quot;id&quot;:99790,&quot;url&quot;:&quot;<?php echo base_url('uploads/slider/').$img_filterig1['slide_img'] ?>&quot;},{&quot;id&quot;:99788,&quot;url&quot;:&quot;<?php echo base_url('uploads/slider/').$img_filterig2['slide_img'] ?>&quot;}],&quot;background_slideshow_slide_duration&quot;:1000,&quot;background_slideshow_transition_duration&quot;:2000,&quot;background_slideshow_loop&quot;:&quot;yes&quot;,&quot;background_slideshow_slide_transition&quot;:&quot;fade&quot;,&quot;_ha_eqh_enable&quot;:false}">
                    <div class="elementor-container elementor-column-gap-no">
                        <div class="elementor-row">
                            <div data-dce-background-color="#02010154" class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-ef2e126 wdp-sticky-section-no" data-id="ef2e126" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-element-f19fa2b wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="f19fa2b" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                            <div class="elementor-widget-container">
                                                <h2 class="elementor-heading-title elementor-size-default">Filter Instagram</h2>
                                            </div>
                                        </div>
                                        <div class="elementor-element elementor-element-f12971d wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="f12971d" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                            <div class="elementor-widget-container">
                                                <h2 class="elementor-heading-title elementor-size-default">
                                                    <?php echo $kutipan_filterig['kutipan'] ?>
                                                </h2>
                                            </div>
                                        </div>
                                        <!-- <div class="elementor-element elementor-element-8a861ce wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="8a861ce" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                            <div class="elementor-widget-container">
                                                <h2 class="elementor-heading-title elementor-size-default">#tags</h2>
                                            </div>
                                        </div> -->
                                        <div data-dce-background-color="#00000054" class="elementor-element elementor-element-4fac669 elementor-mobile-align-center elementor-align-center wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-button" data-id="4fac669" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="button.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-button-wrapper">
                                                    <a href="<?php echo $filter_ig_embed['konten'] ?>" target="_blank" class="elementor-button-link elementor-button elementor-size-sm" role="button">
                                                        <span class="elementor-button-content-wrapper">
                                                            <span class="elementor-button-icon elementor-align-icon-left">
                                                                <i aria-hidden="true" class="fab fa-instagram"></i>
                                                            </span>
                                                            <span class="elementor-button-text">USE FILTER</span>
                                                        </span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>


                <!-- Gift -->
                <section data-dce-background-color="#A1887F" class="elementor-section elementor-top-section elementor-element elementor-element-6dad1dd2 elementor-section-boxed elementor-section-height-default elementor-section-height-default wdp-sticky-section-no" data-id="6dad1dd2" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;_ha_eqh_enable&quot;:false}">
                    <div class="elementor-container elementor-column-gap-no">
                        <div class="elementor-row">
                            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-1b9c5a2 wdp-sticky-section-no" data-id="1b9c5a2" data-element_type="column">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-element-40c32a wdp-sticky-section-no elementor-widget elementor-widget-heading" data-id="40c32a" data-element_type="widget" data-widget_type="heading.default">
                                            <div class="elementor-widget-container">
                                                <h2 class="elementor-heading-title elementor-size-default">WEDDING</h2>
                                            </div>
                                        </div>
                                        <div class="elementor-element elementor-element-4f8be063 wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="4f8be063" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                            <div class="elementor-widget-container">
                                                <h2 class="elementor-heading-title elementor-size-default">Gift</h2>
                                            </div>
                                        </div>
                                        <div class="elementor-element elementor-element-5fd57602 wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="5fd57602" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                            <div class="elementor-widget-container">
                                                <h2 class="elementor-heading-title elementor-size-default">
                                                    <?php echo $kutipan_weeding_gifts['kutipan']; ?>
                                                </h2>
                                            </div>
                                        </div>
                                        <section class="elementor-section elementor-inner-section elementor-element elementor-element-6e37313e elementor-section-boxed elementor-section-height-default elementor-section-height-default wdp-sticky-section-no" data-id="6e37313e" data-element_type="section" data-settings="{&quot;_ha_eqh_enable&quot;:false}">
                                            <div class="elementor-container elementor-column-gap-default">
                                                <div class="elementor-row">
                            
                                                    <div data-dce-background-color="#FFFFFF" class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-5eee1e5f wdp-sticky-section-no" data-id="5eee1e5f" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                                        <div class="elementor-column-wrap elementor-element-populated">
                                                            <div class="elementor-widget-wrap">
                                                            
                                                                <section data-dce-background-color="#FFFFFF" class="elementor-section elementor-inner-section elementor-element elementor-element-5fadb40d elementor-section-boxed elementor-section-height-default elementor-section-height-default wdp-sticky-section-no" data-id="5fadb40d" data-element_type="section" data-settings="{&quot;_ha_eqh_enable&quot;:false}">
                                                                    <div class="elementor-container elementor-column-gap-default">
                                                                        <div class="elementor-row">
                                                                            <div data-dce-background-color="#FFFFFFD9" class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-501cc221 wdp-sticky-section-no" data-id="501cc221" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                                                                <div class="elementor-column-wrap elementor-element-populated">
                                                                                    <div class="elementor-widget-wrap">

                                                                                    <?php foreach($rek_bank as $k=>$v) { ?>
                                                                                        
                                                                                        <?php if($v['bank'] != 'GIFT') {  ?>

                                                                                        <div class="elementor-element elementor-element-23e32790 wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-image" data-id="23e32790" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="image.default">
                                                                                            <div class="elementor-widget-container">
                                                                                                <div class="elementor-image">
                                                                                                    <img width="45%" height="auto" src="<?php echo base_url('uploads/') ?>bca.svg" class="attachment-full size-full wp-image-719" alt="" loading="lazy"/>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="elementor-element elementor-element-3a76b80a wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="3a76b80a" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                                                                            <div class="elementor-widget-container">
                                                                                                <h5 class="" style="text-align:center;">
                                                                                                    <?php echo $v['no_rek'] ?> <br> a.n. <?php echo $v['nama'] ?>
                                                                                                </h5>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div data-dce-background-color="#777777" class="elementor-element elementor-element-289a6beb elementor-mobile-align-center elementor-align-center wdp-sticky-section-no elementor-widget elementor-widget-dce-copy-to-clipboard" data-id="289a6beb" data-element_type="widget" data-widget_type="dce-copy-to-clipboard.default">
                                                                                            <div class="elementor-widget-container">
                                                                                                <div class="dce-clipboard-wrapper dce-clipboard-wrapper-text">
                                                                                                    <div>
                                                                                                        <button class="elementor-button elementor-size-sm" type="button" id="dce-clipboard-btn-<?php echo $v['no_rek'] ?>" data-clipboard-target="#dce-clipboard-value-<?php echo $v['no_rek'] ?>">
                                                                                                            <span class="elementor-button-content-wrapper dce-flexbox">
                                                                                                                <span class="elementor-button-icon elementor-align-icon-left">
                                                                                                                    <i aria-hidden="true" class="far fa-copy"></i>
                                                                                                                </span>
                                                                                                                <span class="elementor-button-text">Copy</span>
                                                                                                            </span>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                    <input class="elementor-size-sm dce-clipboard-value elementor-field-textual dce-offscreen dce-form-control" id="dce-clipboard-value-<?php echo $v['no_rek'] ?>" aria-hidden="true" type="text" value="<?php echo $v['no_rek'] ?>">
                                                                                                </div>
                                                                                                <script>
                                                                                                    jQuery(function() {
                                                                                                        var clipboard_<?php echo $v['no_rek'] ?> = new ClipboardJS('#dce-clipboard-btn-<?php echo $v['no_rek'] ?>');
                                                                                                        clipboard_<?php echo $v['no_rek'] ?>.on('success', function(e) {
                                                                                                            jQuery('#dce-clipboard-btn-<?php echo $v['no_rek'] ?>').html('Copied!');
                                                                                                            return false;
                                                                                                        });
                                                                                                        clipboard_<?php echo $v['no_rek'] ?>.on('error', function(e) {
                                                                                                            console.log(e);
                                                                                                        });
                                                                                                    });
                                                                                                </script>
                                                                                            </div>
                                                                                        </div>

                                                                                        <br><br>
                                                                                        <?php } else {?>

                                                                                        <br><br><hr>

                                                                                        <div class="elementor-element elementor-element-23e32790 wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-image" data-id="23e32790" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="image.default">
                                                                                            <div class="elementor-widget-container">
                                                                                                <h4 class="" style="text-align:center;">
                                                                                                    Pengiriman Kado
                                                                                                </h4>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="elementor-element elementor-element-3a76b80a wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="3a76b80a" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                                                                            <div class="elementor-widget-container">
                                                                                                <h6 class="" style="text-align:center;">
                                                                                                    <?php echo $v['nama'] ?> <br> <?php echo $v['alamat'] ?>
                                                                                                </h6>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div data-dce-background-color="#777777" class="elementor-element elementor-element-289a6beb elementor-mobile-align-center elementor-align-center wdp-sticky-section-no elementor-widget elementor-widget-dce-copy-to-clipboard" data-id="289a6beb" data-element_type="widget" data-widget_type="dce-copy-to-clipboard.default">
                                                                                            <div class="elementor-widget-container">
                                                                                                <div class="dce-clipboard-wrapper dce-clipboard-wrapper-text">
                                                                                                    <div>
                                                                                                        <button class="elementor-button elementor-size-sm" type="button" id="dce-clipboard-btn-<?php echo $v['id_bank'] ?>" data-clipboard-target="#dce-clipboard-value-<?php echo $v['id_bank'] ?>">
                                                                                                            <span class="elementor-button-content-wrapper dce-flexbox">
                                                                                                                <span class="elementor-button-icon elementor-align-icon-left">
                                                                                                                    <i aria-hidden="true" class="far fa-copy"></i>
                                                                                                                </span>
                                                                                                                <span class="elementor-button-text">Copy</span>
                                                                                                            </span>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                    <input class="elementor-size-sm dce-clipboard-value elementor-field-textual dce-offscreen dce-form-control" id="dce-clipboard-value-<?php echo $v['id_bank'] ?>" aria-hidden="true" type="text" value="<?php echo $v['alamat'] ?>">
                                                                                                </div>
                                                                                                <script>
                                                                                                    jQuery(function() {
                                                                                                        var clipboard_<?php echo $v['id_bank'] ?> = new ClipboardJS('#dce-clipboard-btn-<?php echo $v['id_bank'] ?>');
                                                                                                        clipboard_<?php echo $v['id_bank'] ?>.on('success', function(e) {
                                                                                                            jQuery('#dce-clipboard-btn-<?php echo $v['id_bank'] ?>').html('Copied!');
                                                                                                            return false;
                                                                                                        });
                                                                                                        clipboard_<?php echo $v['id_bank'] ?>.on('error', function(e) {
                                                                                                            console.log(e);
                                                                                                        });
                                                                                                    });
                                                                                                </script>
                                                                                            </div>
                                                                                        </div>

                                                                                        <br><br>


                                                                                    <?php } } ?>





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

                                        
                                        <div class="elementor-element elementor-element-68b46168 wdp-sticky-section-no elementor-widget elementor-widget-spacer" data-id="68b46168" data-element_type="widget" data-widget_type="spacer.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-spacer">
                                                    <div class="elementor-spacer-inner"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <section data-dce-background-color="#FFFFFF" class="elementor-section elementor-inner-section elementor-element elementor-element-463a6d92 elementor-section-boxed elementor-section-height-default elementor-section-height-default wdp-sticky-section-no" data-id="463a6d92" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;_ha_eqh_enable&quot;:false}">
                                            <div class="elementor-container elementor-column-gap-default">
                                                <div class="elementor-row">
                                                    <div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-27240b87 wdp-sticky-section-no" data-id="27240b87" data-element_type="column">
                                                        <div class="elementor-column-wrap elementor-element-populated">
                                                            <div class="elementor-widget-wrap">
                                                                <div class="elementor-element elementor-element-622c52f9 wdp-sticky-section-no elementor-widget elementor-widget-heading" data-id="622c52f9" data-element_type="widget" data-widget_type="heading.default">
                                                                    <div class="elementor-widget-container">
                                                                        <h2 class="elementor-heading-title elementor-size-default">RSVP</h2>
                                                                    </div>
                                                                </div>
                                                                <div class="elementor-element elementor-element-5dbfb20 wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="5dbfb20" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                                                    <div class="elementor-widget-container">
                                                                        <h2 class="elementor-heading-title elementor-size-default">Dimohon untuk mengisi konfirmasi kehadiran di bawah ini.</h2>
                                                                    </div>
                                                                </div>
                                                                <div class="elementor-element elementor-element-69a3be2c fluentform-widget-submit-button-center fluent-form-widget-step-header-yes fluent-form-widget-step-progressbar-yes fluentform-widget-submit-button-custom wdp-sticky-section-no elementor-widget elementor-widget-fluent-form-widget" data-id="69a3be2c" data-element_type="widget" data-widget_type="fluent-form-widget.default">
                                                                    <div class="elementor-widget-container">
                                                                        <div class="fluentform-widget-wrapper fluentform-widget-custom-radio-checkbox fluentform-widget-align-default">
                                                                            <div class='fluentform fluentform_wrapper_1359'>




                                                                                 <?php if(isset($_SESSION['msg']) && !empty($_SESSION['msg']))
                                                                                    {
                                                                                        echo $_SESSION['msg'];
                                                                                        unset($_SESSION['msg']);
                                                                                    }
                                                                            ?>
                                                                            
                                                                                <?php 
                                                                                    $attributes = array('method'=>'post', 'class' => 'frm-fluent-form  ff-el-form-top ');		 			
                                                                                    echo form_open('ajax/guestbooks',$attributes); ?>
                                                                                        <input type="hidden"  name="wedding_user_id" value="<?php echo $wedding_user_id ?>"/>

                                                                                        <div class=" ff-field_container ff-name-field-wrapper">
                                                                                            <div class='ff-t-container'>
                                                                                                <div class='ff-t-cell '>
                                                                                                    <div class='ff-el-group  ff-el-form-top'>
                                                                                                        <div class="ff-el-input--label ff-el-is-required asterisk-right">
                                                                                                            <label for='ff_1359_names_first_name_' aria-label="Nama">Nama</label>
                                                                                                        </div>
                                                                                                        <div class='ff-el-input--content'>
                                                                                                            <input type="text" name="nama" value="<?php if(!empty($nama_undangan)) {?> <?php echo strtoupper($nama_undangan) ?> <?php } ?>" class="ff-el-form-control" placeholder="<?php if(!empty($nama_undangan)) {?> &quot;<?php echo strtoupper($nama_undangan) ?>&quot; <?php } ?>" aria-invalid="false" aria-required=false>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class='ff-el-group'>
                                                                                            <div class="ff-el-input--label ff-el-is-required asterisk-right">
                                                                                                <label for='ff_1359_dropdown' aria-label="Konfirmasi Kehadiran">Konfirmasi Kehadiran</label>
                                                                                            </div>
                                                                                            <div class='ff-el-input--content'>
                                                                                                <select name="dropdown"  class="ff-el-form-control" data-name="dropdown" data-calc_value="0" aria-invalid="false" aria-required=true>
                                                                                                    <option value="">- Select -</option>
                                                                                                    <option value="Hadir">Hadir</option>
                                                                                                    <option value="Tidak Hadir">Tidak Hadir</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class='ff-el-group ff-text-left ff_submit_btn_wrapper'>
                                                                                            <button name="submit" type="submit" class="ff-btn  ff-btn-md ff_btn_style">Submit Form</button>
                                                                                        </div>
                                                                                </form>





                                                                                <div id='fluentform_1359_errors' class='ff-errors-in-stack ff_form_instance_1359_1 ff-form-loading_errors ff_form_instance_1359_1_errors'></div>
                                                                            </div>
                                                                        </div>
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


                


                <!-- Gallery -->
                <section data-dce-background-color="#EFEBE9" class="elementor-section elementor-top-section elementor-element elementor-element-69af4a69 elementor-section-height-min-height elementor-section-boxed elementor-section-height-default elementor-section-items-middle wdp-sticky-section-no" data-id="69af4a69" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;_ha_eqh_enable&quot;:false}">
                    <div class="elementor-container elementor-column-gap-default">
                        <div class="elementor-row">
                            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-4eb2f073 wdp-sticky-section-no" data-id="4eb2f073" data-element_type="column">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-element-31f64135 wdp-sticky-section-no elementor-widget elementor-widget-heading" data-id="31f64135" data-element_type="widget" data-widget_type="heading.default">
                                            <div class="elementor-widget-container">
                                                <h2 class="elementor-heading-title elementor-size-default">BEST</h2>
                                            </div>
                                        </div>
                                        <div class="elementor-element elementor-element-6b95ab76 wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="6b95ab76" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                            <div class="elementor-widget-container">
                                                <h2 class="elementor-heading-title elementor-size-default">Moment</h2>
                                            </div>
                                        </div>

                                        <!-- Embed Youtube -->
                                        <!--<div class="elementor-element elementor-element-fa2b3fe wdp-sticky-section-no elementor-widget elementor-widget-video" data-id="fa2b3fe" data-element_type="widget" data-settings="{&quot;youtube_url&quot;:&quot;<?php echo $youtube_embed['konten'] ?>&quot;,&quot;video_type&quot;:&quot;youtube&quot;,&quot;controls&quot;:&quot;yes&quot;}" data-widget_type="video.default">-->
                                        <!--    <div class="elementor-widget-container">-->
                                        <!--        <div class="elementor-wrapper elementor-open-inline">-->
                                        <!--            <div class="elementor-video"></div>-->
                                        <!--        </div>-->
                                        <!--    </div>-->
                                        <!--</div>-->

                                        <!-- List Gallery -->
                                        <div class="elementor-element elementor-element-555e5eeb pp-ins-normal wdp-sticky-section-no elementor-widget elementor-widget-pp-image-gallery" data-id="555e5eeb" data-element_type="widget" data-widget_type="pp-image-gallery.default">
                                            <div class="elementor-widget-container">
                                                <div class="pp-image-gallery-container" data-settings="{&quot;tilt_enable&quot;:&quot;no&quot;,&quot;layout&quot;:&quot;justified&quot;,&quot;image_spacing&quot;:10,&quot;row_height&quot;:206,&quot;last_row&quot;:&quot;justify&quot;,&quot;post_id&quot;:99779,&quot;template_id&quot;:99779,&quot;widget_id&quot;:&quot;555e5eeb&quot;}">
                                                    <div class="pp-image-gallery-wrapper">
                                                        <div class="pp-image-gallery pp-elementor-grid pp-image-gallery-justified" id="pp-image-gallery-555e5eeb">



                                                        <?php
                                                            foreach($gallery->result() as $rw){
                                                                $thumb_img_name = $myHelpers->global_lib->get_image_type($rw->image_path, $rw->org);
                                                        ?>

                                                            <?php if(!empty($thumb_img_name)){ ?>

                                                            <div class="pp-grid-item-wrap pp-group-1" data-item-id="555e5eeb">
                                                                <div class="pp-grid-item pp-image">
                                                                    <div class="pp-image-gallery-thumbnail-wrap pp-ins-filter-hover">
                                                                        <a data-elementor-open-lightbox="default" data-elementor-lightbox-slideshow="555e5eeb" class="elementor-clickable pp-image-gallery-item-link"
                                                                            href="<?php echo base_url().$rw->image_path.$thumb_img_name; ?>"></a>
                                                                        <div class="pp-ins-filter-target pp-image-gallery-thumbnail">
                                                                            <img decoding="async" class="pp-gallery-slide-image" src="<?php echo base_url().$rw->image_path.$thumb_img_name; ?>" alt="" data-no-lazy="1"/>
                                                                        </div>
                                                                        <div class="pp-image-overlay pp-media-overlay"></div>
                                                                        <div class="pp-gallery-image-content pp-media-content"></div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <?php } ?>

                                                        <?php } ?>




                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>



                <!-- Covid Info -->
                <!-- <section data-dce-background-color="#8D6E63" class="elementor-section elementor-top-section elementor-element elementor-element-17788797 elementor-section-full_width elementor-section-height-default elementor-section-height-default wdp-sticky-section-no" data-id="17788797" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;_ha_eqh_enable&quot;:false}">
                    <div class="elementor-container elementor-column-gap-no">
                        <div class="elementor-row">
                            <div data-dce-background-color="#FFFFFF" class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-5eee1e5f wdp-sticky-section-no" data-id="5eee1e5f" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                        <section class="elementor-section elementor-inner-section elementor-element elementor-element-5fadb40d elementor-section-boxed elementor-section-height-default elementor-section-height-default wdp-sticky-section-no" data-id="5fadb40d" data-element_type="section" data-settings="{&quot;_ha_eqh_enable&quot;:false}">
                                            <div class="elementor-container elementor-column-gap-default">
                                                <div class="elementor-row">
                                                    <div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-afebdd5 wdp-sticky-section-no" data-id="afebdd5" data-element_type="column">
                                                        <div class="elementor-column-wrap elementor-element-populated">
                                                            <div class="elementor-widget-wrap">
                                                                <div class="elementor-element elementor-element-3bdf6058 wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="3bdf6058" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;zoomIn&quot;,&quot;_animation_mobile&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                                                    <div class="elementor-widget-container">
                                                                        <h2 class="elementor-heading-title elementor-size-default">Health Protocol</h2>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <section class="elementor-section elementor-inner-section elementor-element elementor-element-76b24cb8 elementor-section-boxed elementor-section-height-default elementor-section-height-default wdp-sticky-section-no elementor-invisible" data-id="76b24cb8" data-element_type="section" data-settings="{&quot;animation&quot;:&quot;fadeInUp&quot;,&quot;_ha_eqh_enable&quot;:false}">
                                            <div class="elementor-container elementor-column-gap-default">
                                                <div class="elementor-row">
                                                    <div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-62ab8ab2 wdp-sticky-section-no" data-id="62ab8ab2" data-element_type="column">
                                                        <div class="elementor-column-wrap elementor-element-populated">
                                                            <div class="elementor-widget-wrap">
                                                                <div class="elementor-element elementor-element-44ca7aba wdp-sticky-section-no elementor-widget elementor-widget-heading" data-id="44ca7aba" data-element_type="widget" data-widget_type="heading.default">
                                                                    <div class="elementor-widget-container">
                                                                        <h2 class="elementor-heading-title elementor-size-default">For the safety and comfort of all guests. We respectfully request 
                                                                            you to follow the health protocols during the wedding in order to 
                                                                            avoid the transmition of covid-19</h2>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <section class="elementor-section elementor-inner-section elementor-element elementor-element-6afc09ca elementor-section-content-middle elementor-section-boxed elementor-section-height-default elementor-section-height-default wdp-sticky-section-no elementor-invisible" data-id="6afc09ca" data-element_type="section" data-settings="{&quot;animation&quot;:&quot;zoomIn&quot;,&quot;_ha_eqh_enable&quot;:false}">
                                            <div class="elementor-container elementor-column-gap-default">
                                                <div class="elementor-row">
                                                    <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-1d048c31 wdp-sticky-section-no" data-id="1d048c31" data-element_type="column">
                                                        <div class="elementor-column-wrap elementor-element-populated">
                                                            <div class="elementor-widget-wrap">
                                                                <div class="elementor-element elementor-element-de9d87c wdp-sticky-section-no elementor-widget elementor-widget-image" data-id="de9d87c" data-element_type="widget" data-widget_type="image.default">
                                                                    <div class="elementor-widget-container">
                                                                        <div class="elementor-image">
                                                                            <figure class="wp-caption">
                                                                                <img decoding="async" loading="lazy" width="200" height="200" src="https://ts-invitation.com/uploads/2023/04/04-15-1.png" class="attachment-large size-large wp-image-194" alt="" srcset="https://ts-invitation.com/uploads/2023/04/04-15-1.png 200w, https://ts-invitation.com/uploads/2023/04/04-15-1-150x150.png 150w" sizes="(max-width: 200px) 100vw, 200px"/>
                                                                                <figcaption class="widget-image-caption wp-caption-text">Wear mask</figcaption>
                                                                            </figure>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-2827df99 wdp-sticky-section-no" data-id="2827df99" data-element_type="column">
                                                        <div class="elementor-column-wrap elementor-element-populated">
                                                            <div class="elementor-widget-wrap">
                                                                <div class="elementor-element elementor-element-5a325fe9 wdp-sticky-section-no elementor-widget elementor-widget-image" data-id="5a325fe9" data-element_type="widget" data-widget_type="image.default">
                                                                    <div class="elementor-widget-container">
                                                                        <div class="elementor-image">
                                                                            <figure class="wp-caption">
                                                                                <img decoding="async" loading="lazy" width="200" height="200" src="https://ts-invitation.com/uploads/2023/04/01-14-1-1.png" class="attachment-large size-large wp-image-195" alt="" srcset="https://ts-invitation.com/uploads/2023/04/01-14-1-1.png 200w, https://ts-invitation.com/uploads/2023/04/01-14-1-1-150x150.png 150w" sizes="(max-width: 200px) 100vw, 200px"/>
                                                                                <figcaption class="widget-image-caption wp-caption-text">Wash your hand</figcaption>
                                                                            </figure>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-1b8c21df wdp-sticky-section-no" data-id="1b8c21df" data-element_type="column">
                                                        <div class="elementor-column-wrap elementor-element-populated">
                                                            <div class="elementor-widget-wrap">
                                                                <div class="elementor-element elementor-element-54c88cf2 wdp-sticky-section-no elementor-widget elementor-widget-image" data-id="54c88cf2" data-element_type="widget" data-widget_type="image.default">
                                                                    <div class="elementor-widget-container">
                                                                        <div class="elementor-image">
                                                                            <figure class="wp-caption">
                                                                                <img decoding="async" loading="lazy" width="200" height="200" src="https://ts-invitation.com/uploads/2023/04/06-3-1.png" class="attachment-large size-large wp-image-196" alt="" srcset="https://ts-invitation.com/uploads/2023/04/06-3-1.png 200w, https://ts-invitation.com/uploads/2023/04/06-3-1-150x150.png 150w" sizes="(max-width: 200px) 100vw, 200px"/>
                                                                                <figcaption class="widget-image-caption wp-caption-text">Physical distancing</figcaption>
                                                                            </figure>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-556ed4fb wdp-sticky-section-no" data-id="556ed4fb" data-element_type="column">
                                                        <div class="elementor-column-wrap elementor-element-populated">
                                                            <div class="elementor-widget-wrap">
                                                                <div class="elementor-element elementor-element-51a5a39d wdp-sticky-section-no elementor-widget elementor-widget-image" data-id="51a5a39d" data-element_type="widget" data-widget_type="image.default">
                                                                    <div class="elementor-widget-container">
                                                                        <div class="elementor-image">
                                                                            <figure class="wp-caption">
                                                                                <img decoding="async" loading="lazy" width="200" height="200" src="https://ts-invitation.com/uploads/2023/04/02-15-1-1.png" class="attachment-large size-large wp-image-197" alt="" srcset="https://ts-invitation.com/uploads/2023/04/02-15-1-1.png 200w, https://ts-invitation.com/uploads/2023/04/02-15-1-1-150x150.png 150w" sizes="(max-width: 200px) 100vw, 200px"/>
                                                                                <figcaption class="widget-image-caption wp-caption-text">Use handsanitizer</figcaption>
                                                                            </figure>
                                                                        </div>
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
                </section> -->

                <!-- Ucapan -->
                <section data-dce-background-color="#D7CCC8" class="elementor-section elementor-top-section elementor-element elementor-element-3bbae63a elementor-section-full_width elementor-section-height-default elementor-section-height-default wdp-sticky-section-no" data-id="3bbae63a" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;_ha_eqh_enable&quot;:false}">
                    <div class="elementor-container elementor-column-gap-no">
                        <div class="elementor-row">
                            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-4efc26cd wdp-sticky-section-no" data-id="4efc26cd" data-element_type="column">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                        <!-- <div class="elementor-element elementor-element-2eaa46a2 wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-image" data-id="2eaa46a2" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="image.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-image">
                                                <img decoding="async" width="1065" height="1600" src="https://ts-invitation.com/wp-content/uploads/2023/08/HILDA-GUI11.jpg" class="attachment-full size-full wp-image-99791" alt="" srcset="https://ts-invitation.com/wp-content/uploads/2023/08/HILDA-GUI11.jpg 1065w, https://ts-invitation.com/wp-content/uploads/2023/08/HILDA-GUI11-200x300.jpg 200w, https://ts-invitation.com/wp-content/uploads/2023/08/HILDA-GUI11-682x1024.jpg 682w, https://ts-invitation.com/wp-content/uploads/2023/08/HILDA-GUI11-768x1154.jpg 768w, https://ts-invitation.com/wp-content/uploads/2023/08/HILDA-GUI11-1022x1536.jpg 1022w" sizes="(max-width: 1065px) 100vw, 1065px">                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="elementor-element elementor-element-66db6653 wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="66db6653" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                            <div class="elementor-widget-container">
                                                <h2 class="elementor-heading-title elementor-size-default">Kebahagiaan dan kegembiraan kami akan semakin lengkap dengan kehadiran dan doa restu Anda</h2>
                                            </div>
                                        </div>
                                        <div class="elementor-element elementor-element-14d734f4 wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="14d734f4" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;zoomIn&quot;,&quot;_animation_mobile&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                            <div class="elementor-widget-container">
                                                <h2 class="elementor-heading-title elementor-size-default">Join with us</h2>
                                            </div>
                                        </div>
                                        <div class="elementor-element elementor-element-40182c3b wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="40182c3b" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                            <div class="elementor-widget-container">
                                                <h2 class="elementor-heading-title elementor-size-default">Berikan ucapan dan doa untuk kami</h2>
                                            </div>
                                        </div>
                                        

                                        <div class="elementor-section elementor-inner-section elementor-element elementor-element-463a6d92 elementor-section-boxed elementor-section-height-default elementor-section-height-default wdp-sticky-section-no">
                                            <div class="elementor-element elementor-element-40182c3b wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="40182c3b" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                                <div class="elementor-widget-container">
                                                <style>
                                            .commonninja-ribbon-link{
                                                diplay: hidden !important;
                                                visibility: hidden !important;
                                            }
                                        </style>
                                                    <script src="https://cdn.commoninja.com/sdk/latest/commonninja.js" defer></script>
                                                    <div class="commonninja_component pid-<?php echo $comment_id['comment_id'] ?>"></div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                



                <!-- Slider Footer -->
                <section data-dce-background-overlay-color="#02010100" class="elementor-section elementor-top-section elementor-element elementor-element-782b42cd elementor-section-height-min-height elementor-section-items-bottom elementor-section-boxed elementor-section-height-default wdp-sticky-section-no" data-id="782b42cd" data-element_type="section" 
                data-settings="{&quot;background_background&quot;:&quot;slideshow&quot;,&quot;background_slideshow_gallery&quot;:[{&quot;id&quot;:99784,&quot;url&quot;:&quot;<?php echo base_url('uploads/slider/').$wedding_gifts1['slide_img'] ?>&quot;},{&quot;id&quot;:99792,&quot;url&quot;:&quot;<?php echo base_url('uploads/slider/').$wedding_gifts2['slide_img'] ?>&quot;}],&quot;background_slideshow_slide_duration&quot;:2000,&quot;background_slideshow_transition_duration&quot;:2000,&quot;background_slideshow_loop&quot;:&quot;yes&quot;,&quot;background_slideshow_slide_transition&quot;:&quot;fade&quot;,&quot;_ha_eqh_enable&quot;:false}">
                    <div class="elementor-background-overlay"></div>
                    <div class="elementor-container elementor-column-gap-default">
                        <div class="elementor-row">
                            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-63fb1c50 wdp-sticky-section-no" data-id="63fb1c50" data-element_type="column">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-element-79ed6021 wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="79ed6021" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                            <div class="elementor-widget-container">
                                                <h2 class="elementor-heading-title elementor-size-default">With Love</h2>
                                            </div>
                                        </div>
                                        <div class="elementor-element elementor-element-54716d77 elementor-widget-divider--view-line_icon elementor-view-default elementor-widget-divider--element-align-center wdp-sticky-section-no elementor-widget elementor-widget-divider" data-id="54716d77" data-element_type="widget" data-widget_type="divider.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-divider">
                                                    <span class="elementor-divider-separator">
                                                        <div class="elementor-icon elementor-divider__element">
                                                            <i aria-hidden="true" class="fas fa-heart"></i>
                                                        </div>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="elementor-element elementor-element-3df1065 wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="3df1065" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                            <div class="elementor-widget-container">
                                                <h2 class="elementor-heading-title elementor-size-default"><?php echo $info->wedding_title ?></h2>
                                            </div>
                                        </div>
                                        <div class="elementor-element elementor-element-a152833 wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="a152833" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                            <div class="elementor-widget-container">
                                                <h2 class="elementor-heading-title elementor-size-default"></h2>
                                            </div>
                                        </div>
                                        <div class="elementor-element elementor-element-7f9e3ea8 wdp-sticky-section-no elementor-widget elementor-widget-spacer" data-id="7f9e3ea8" data-element_type="widget" data-widget_type="spacer.default">
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



                <!-- Footer Info -->
                <section class="elementor-section elementor-top-section elementor-element elementor-element-51b6b6b elementor-section-boxed elementor-section-height-default elementor-section-height-default wdp-sticky-section-no" data-id="51b6b6b" data-element_type="section" data-settings="{&quot;_ha_eqh_enable&quot;:false}">
                    <div class="elementor-container elementor-column-gap-default">
                        <div class="elementor-row">
                            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-23b39d8a wdp-sticky-section-no" data-id="23b39d8a" data-element_type="column">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-element-2ca5ae6d wdp-sticky-section-no elementor-widget elementor-widget-image" data-id="2ca5ae6d" data-element_type="widget" data-widget_type="image.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-image">
                                                    <img decoding="async" loading="lazy" width="1600" height="1600"
                                                    src="<?php echo base_url('uploads/') ?>kayoxlv.JPG" class="attachment-full size-full wp-image-46" alt=""
                                                    sizes="(max-width: 1600px) 100vw, 1600px"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="elementor-element elementor-element-43fc9cee wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="43fc9cee" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                            <div class="elementor-widget-container">
                                                <h2 class="elementor-heading-title elementor-size-default">© Copyright 2023 Kayo XLV All Rights Reserved</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>



                <!-- Audio Autoplay -->
                <section class="elementor-section elementor-top-section elementor-element elementor-element-7b257d67 elementor-section-boxed elementor-section-height-default elementor-section-height-default wdp-sticky-section-no" data-id="7b257d67" data-element_type="section" data-settings="{&quot;_ha_eqh_enable&quot;:false}">
                    <div class="elementor-container elementor-column-gap-default">
                        <div class="elementor-row">
                            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-2154aa87 wdp-sticky-section-no" data-id="2154aa87" data-element_type="column">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap">


                                        <section data-dce-background-color="#02010100" class="elementor-section elementor-inner-section elementor-element elementor-element-12ad93fb wdp-sticky-section-yes elementor-section-boxed elementor-section-height-default elementor-section-height-default wdp-sticky-section-positon-bottom" data-id="12ad93fb" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;_ha_eqh_enable&quot;:false}">
                                            <div class="elementor-container elementor-column-gap-default">
                                                <div class="elementor-row">
                                                    <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-5d818d3e wdp-sticky-section-no" data-id="5d818d3e" data-element_type="column">
                                                        <div class="elementor-column-wrap elementor-element-populated">
                                                            <div class="elementor-widget-wrap">
                                                                <div class="elementor-element elementor-element-6013c92e elementor-view-default elementor-widget elementor-widget-weddingpress-audio" data-id="6013c92e" data-element_type="widget" data-widget_type="weddingpress-audio.default">
                                                                    <div class="elementor-widget-container">
                                                                        <script>
                                                                            var settingAutoplay = 'yes';
                                                                            window.settingAutoplay = settingAutoplay === 'disable' ? false : true;
                                                                        </script>

                                                                        <div id="audio-container" class="audio-box">
                                                                            <audio id="song" loop>
                                                                                <source src="<?php echo base_url('uploads/audio/'.$audio_embed['konten']) ?>" type="audio/mp3">
                                                                            </audio>

                                                                            <div class="elementor-icon-wrapper show-icon-music" id="unmute-sound" style="display:none;" >
                                                                                <div class="elementor-icon">
                                                                                    <i aria-hidden="true" class="fas fa-music"></i>
                                                                                </div>
                                                                            </div>

                                                                            <div class="elementor-icon-wrapper hide-icon-music" id="mute-sound" >
                                                                                <div class="elementor-icon">
                                                                                    <i aria-hidden="true" class="fa fa-stop-circle"></i>
                                                                                </div>
                                                                            </div>

                                                                            

                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-1ebc371b wdp-sticky-section-no" data-id="1ebc371b" data-element_type="column">
                                                        <div class="elementor-column-wrap">
                                                            <div class="elementor-widget-wrap"></div>
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
