<?php 


    $url = $_SERVER['REQUEST_URI'];

    $url_components = parse_url($url);

    $get_nama = $this->input->get('nama', TRUE);


    if(!empty($get_nama)){

        $nama_undangan = str_replace('-', ' ', $get_nama);

    }


    $poto = base_url().'uploads/weddings/'.$couple->row()->bride_photo;

    $cover = str_replace('/', '\\/', $poto);

    $bride_photo = str_replace('/', '\\/', base_url().'uploads/weddings/'.$couple->row()->bride_photo);

    $groom_photo = str_replace('/', '\\/', base_url().'uploads/weddings/'.$couple->row()->groom_photo);

?>


<?php

// if(!isset($wedding_id)) return false;

$sliders = $this->Common_model->commonQuery("select * from wedding_slider Where wedding_id = $wedding_id ORDER BY img_order");

$cover = $this->Common_model->commonQuery("select * from wedding_slider where wedding_id = $wedding_id AND img_order='1' AND place='cover' ")->row_array();

$opening1 = $this->Common_model->commonQuery("select * from wedding_slider Where wedding_id = $wedding_id AND img_order='1' AND place='opening' ")->row_array();

$opening2 = $this->Common_model->commonQuery("select * from wedding_slider Where wedding_id = $wedding_id AND img_order='2' AND place='opening' ")->row_array();

$opening3 = $this->Common_model->commonQuery("select * from wedding_slider Where wedding_id = $wedding_id AND img_order='3' AND place='opening' ")->row_array();



$kutipan_cover = $this->Common_model->commonQuery("select * from wedding_kutipan Where wedding_id = $wedding_id AND place LIKE '%cover%' ")->row_array();


// tesx(date('d M Y',$info->wedding_date));

?>





    <!-- COVER -->

        <section data-dce-background-color="#FFFFFF" class="elementor-section elementor-top-section elementor-element elementor-element-53d0ebcf s_C elementor-section-full_width elementor-section-height-default elementor-section-height-default wdp-sticky-section-no" data-id="53d0ebcf" data-element_type="section" id="s_C"
            data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;_ha_eqh_enable&quot;:false}">
            <div class="elementor-container elementor-column-gap-no">
                <div class="elementor-row">
                    <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-40cd2b45 wdp-sticky-section-no" data-id="40cd2b45" data-element_type="column">
                        <div class="elementor-column-wrap elementor-element-populated">
                            <div class="elementor-widget-wrap">
                                    <section data-dce-background-overlay-color="#0000004A" class="elementor-section elementor-inner-section elementor-element elementor-element-6a7e5d6e elementor-section-full_width elementor-section-height-min-height elementor-section-content-middle elementor-section-height-default wdp-sticky-section-no" data-id="6a7e5d6e" data-element_type="section"
                                    data-settings="{&quot;background_background&quot;:&quot;slideshow&quot;,&quot;background_slideshow_gallery&quot;:[{&quot;id&quot;:1,&quot;url&quot;:&quot;<?php echo str_replace('/', '\\/', base_url().'uploads/slider/'.$cover['slide_img']) ?>&quot;}],&quot;background_slideshow_slide_duration&quot;:500,&quot;background_slideshow_transition_duration&quot;:1500,&quot;background_slideshow_loop&quot;:&quot;yes&quot;,&quot;background_slideshow_slide_transition&quot;:&quot;fade&quot;,&quot;_ha_eqh_enable&quot;:false}">
                                    <div class="elementor-background-overlay"></div>
                                    <div class="elementor-container elementor-column-gap-no">
                                        <div class="elementor-row">
                                            <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-64d27d56 animated-slow wdp-sticky-section-no" data-id="64d27d56" data-element_type="column" data-settings="{&quot;animation&quot;:&quot;none&quot;}">
                                                <div class="elementor-column-wrap elementor-element-populated">
                                                    <div class="elementor-widget-wrap">
                                                        <div class="elementor-element elementor-element-2ce1ae24 wdp-sticky-section-no elementor-widget elementor-widget-spacer" data-id="2ce1ae24" data-element_type="widget" data-widget_type="spacer.default">
                                                            <div class="elementor-widget-container">
                                                                <div class="elementor-spacer">
                                                                    <div class="elementor-spacer-inner"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-9fc6c6d wdp-sticky-section-no" data-id="9fc6c6d" data-element_type="column">
                                                <div class="elementor-column-wrap elementor-element-populated">
                                                    <div class="elementor-widget-wrap">
                                                        <div class="elementor-element elementor-element-78c3da9c wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="78c3da9c" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                                            <div class="elementor-widget-container">
                                                                <h2 class="elementor-heading-title elementor-size-default">The Wedding of</h2>
                                                            </div>
                                                        </div>
                                                        <div class="elementor-element elementor-element-25ccc26a animated-slow wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="25ccc26a" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                                            <div class="elementor-widget-container">
                                                                <h2 class="elementor-heading-title elementor-size-default"> <?php echo $info->wedding_title ?></h2>
                                                            </div>
                                                        </div>
                                                        <div class="elementor-element elementor-element-cff7dc5 wdp-sticky-section-no elementor-widget elementor-widget-spacer" data-id="cff7dc5" data-element_type="widget" data-widget_type="spacer.default">
                                                            <div class="elementor-widget-container">
                                                                <div class="elementor-spacer">
                                                                    <div class="elementor-spacer-inner"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="elementor-element elementor-element-4245d0f0 wdp-sticky-section-no elementor-widget elementor-widget-heading" data-id="4245d0f0" data-element_type="widget" data-widget_type="heading.default">
                                                            <div class="elementor-widget-container">
                                                                <h2 class="elementor-heading-title elementor-size-default">Kepada Yth.</h2>
                                                            </div>
                                                        </div>
                                                        <div class="elementor-element elementor-element-5cc943ac wdp-sticky-section-no elementor-widget elementor-widget-heading" data-id="5cc943ac" data-element_type="widget" data-widget_type="heading.default">
                                                            <div class="elementor-widget-container">
                                                                <h2 class="elementor-heading-title elementor-size-default"> <?php if(!empty($nama_undangan)) {?> &quot;<?php echo strtoupper($nama_undangan) ?>&quot; <?php } ?> </h2>
                                                            </div>
                                                        </div>
                                                        <div data-dce-background-color="#61CE7000" class="elementor-element elementor-element-68a4ed05 elementor-align-center b_c elementor-mobile-align-center wdp-sticky-section-no elementor-widget elementor-widget-button" data-id="68a4ed05" data-element_type="widget" data-widget_type="button.default">
                                                            <div class="elementor-widget-container">
                                                                <div class="elementor-button-wrapper">
                                                                    <a class="elementor-button elementor-size-sm" role="button" id="b_c">
                                                                        <span class="elementor-button-content-wrapper">
                                                                            <span class="elementor-button-icon elementor-align-icon-left">
                                                                                <i aria-hidden="true" class="far fa-envelope-open"></i>
                                                                            </span>
                                                                            <span class="elementor-button-text">Buka Undangan</span>
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

    <!--//END COVER -->


    <!-- Cover Pembukaan-->

        <section data-dce-background-overlay-color="#0000002B" class="elementor-section elementor-top-section elementor-element elementor-element-376ffa83 elementor-section-height-min-height elementor-section-full_width elementor-section-items-bottom elementor-section-height-default wdp-sticky-section-no" data-id="376ffa83" data-element_type="section" 
            data-settings="{&quot;background_background&quot;:&quot;slideshow&quot;,&quot;background_slideshow_gallery&quot;:[{&quot;id&quot;:99790,&quot;url&quot;:&quot;<?php echo str_replace('/', '\\/', base_url().'uploads/slider/'.$cover['slide_img']) ?>&quot;},{&quot;id&quot;:99791,&quot;url&quot;:&quot;<?php echo str_replace('/', '\\/', base_url().'uploads/slider/'.$opening1['slide_img']) ?>&quot;},{&quot;id&quot;:99792,&quot;url&quot;:&quot;<?php echo str_replace('/', '\\/', base_url().'uploads/slider/'.$opening2['slide_img']) ?>&quot;}],&quot;background_slideshow_slide_duration&quot;:1000,&quot;background_slideshow_transition_duration&quot;:2000,&quot;background_slideshow_loop&quot;:&quot;yes&quot;,&quot;background_slideshow_slide_transition&quot;:&quot;fade&quot;,&quot;_ha_eqh_enable&quot;:false}">
            <div class="elementor-background-overlay"></div>
            <div class="elementor-container elementor-column-gap-default">
                <div class="elementor-row">
                    <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-6ece48ae wdp-sticky-section-no" data-id="6ece48ae" data-element_type="column">
                        <div class="elementor-column-wrap elementor-element-populated">
                            <div class="elementor-widget-wrap">
                                <div class="elementor-element elementor-element-655750f9 wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="655750f9" data-element_type="widget"data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                    <div class="elementor-widget-container">
                                        <h2 class="elementor-heading-title elementor-size-default">We are getting married</h2>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-e8ec957 wdp-sticky-section-no elementor-widget elementor-widget-heading" data-id="e8ec957" data-element_type="widget" data-widget_type="heading.default">
                                    <div class="elementor-widget-container">
                                        <h2 class="elementor-heading-title elementor-size-default"><?php echo $info->wedding_title ?></h2>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-2a5f81bb wdp-sticky-section-no elementor-widget elementor-widget-spacer" data-id="2a5f81bb" data-element_type="widget" data-widget_type="spacer.default">
                                    <div class="elementor-widget-container">
                                        <div class="elementor-spacer">
                                            <div class="elementor-spacer-inner"></div>
                                        </div>
                                    </div>
                                </div>
                                <section class="elementor-section elementor-inner-section elementor-element elementor-element-23442556 elementor-section-boxed elementor-section-height-default elementor-section-height-default wdp-sticky-section-no" data-id="23442556" data-element_type="section"data-settings="{&quot;_ha_eqh_enable&quot;:false}">
                                    <div class="elementor-container elementor-column-gap-default">
                                        <div class="elementor-row">
                                            <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-2f5ca53 wdp-sticky-section-no" data-id="2f5ca53" data-element_type="column">
                                                <div class="elementor-column-wrap elementor-element-populated">
                                                    <div class="elementor-widget-wrap">
                                                        <div class="elementor-element elementor-element-3244ad2 elementor-countdown--label-block wdp-sticky-section-no elementor-widget elementor-widget-countdown" data-id="3244ad2" data-element_type="widget" data-widget_type="countdown.default">
                                                            <div class="elementor-widget-container">
                                                                <div class="elementor-countdown-wrapper" >
                                                                    <div class="elementor-countdown-item">
                                                                        <span style="display:none;" class="elementor-countdown-digits" id="demo"></span>
                                                                        <span class="elementor-countdown-digits" id="hari"></span>
                                                                        <span class="elementor-countdown-label">  Day <p id="hari"></p></span>
                                                                    </div>
                                                                    <div class="elementor-countdown-item">
                                                                        <span class="elementor-countdown-digits elementor-countdown-hours" id="jam"></span>
                                                                        <span class="elementor-countdown-label">Hours </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="elementor-element elementor-element-94bea71 elementor-countdown--label-block wdp-sticky-section-no elementor-widget elementor-widget-countdown" data-id="94bea71" data-element_type="widget" data-widget_type="countdown.default">
                                                            <div class="elementor-widget-container">
                                                                <div class="elementor-countdown-wrapper" >
                                                                    <div class="elementor-countdown-item">
                                                                        <span class="elementor-countdown-digits elementor-countdown-minutes" id="menit"></span>
                                                                        <span class="elementor-countdown-label">Minutes </span>
                                                                    </div>
                                                                    <div class="elementor-countdown-item">
                                                                        <span class="elementor-countdown-digits elementor-countdown-seconds" id="detik"></span>
                                                                        <span class="elementor-countdown-label">Seconds </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-4e35d07f wdp-sticky-section-no" data-id="4e35d07f" data-element_type="column">
                                                <div class="elementor-column-wrap elementor-element-populated">
                                                    <div class="elementor-widget-wrap">
                                                        <div class="elementor-element elementor-element-1edbd13b wdp-sticky-section-no elementor-widget elementor-widget-heading" data-id="1edbd13b" data-element_type="widget" data-widget_type="heading.default">
                                                            <div class="elementor-widget-container">
                                                                <h2 class="elementor-heading-title elementor-size-default"> <?php echo date('d M Y', $info->wedding_date); ?></h2>
                                                            </div>
                                                        </div>
                                                        <div data-dce-background-color="#E3CAA500" class="elementor-element elementor-element-733b2ed9 elementor-mobile-align-center elementor-align-center wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-button" data-id="733b2ed9" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="button.default">
                                                            <div class="elementor-widget-container">
                                                                <div class="elementor-button-wrapper">
                                                                <a href="https://www.google.com/calendar/render?action=TEMPLATE&#038;text=The%20Wedding%20of%20<?php echo str_replace('&', ' dan ', $info->wedding_title) ?>&#038;details&#038;dates=<?php echo date('Ymd', $info->wedding_date); ?>T110000/<?php echo date('Ymd', $info->wedding_date); ?>T130000&#038;location=https://maps.app.goo.gl/75wkFMbe3mVNFwot6?g_st=ic"
                                                                    class="elementor-button-link elementor-button elementor-size-sm" role="button">
                                                                        <span class="elementor-button-content-wrapper">
                                                                            <span class="elementor-button-icon elementor-align-icon-left">
                                                                                <i aria-hidden="true" class="far fa-calendar-alt"></i>
                                                                            </span>
                                                                            <span class="elementor-button-text">Save the Date</span>
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
                                <div class="elementor-element elementor-element-674d04f wdp-sticky-section-no elementor-invisible elementor-widget elementor-widget-heading" data-id="674d04f" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
                                    <div class="elementor-widget-container">
                                        <h2 class="elementor-heading-title elementor-size-default">
                                            <?php echo $kutipan_cover['kutipan'] ?>
                                        </h2>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-3823df4e wdp-sticky-section-no elementor-widget elementor-widget-spacer" data-id="3823df4e" data-element_type="widget" data-widget_type="spacer.default">
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

    <!--//END Cover Pembukaan-->


<script>
    // Set the date we're counting down to
    // var countDownDate = new Date("Oct 15, 2023 ").getTime();

    var countDownDate0 = '<?php echo date('d M Y',$info->wedding_date) ?>';

    var countDownDate = new Date(countDownDate0).getTime();


    // console.log(countDownDate);

    // Update the count down every 1 second
    var x = setInterval(function() {

    // Get today's date and time
    var now = new Date().getTime();

    // Find the distance between now and the count down date
    var distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Output the result in an element with id="demo"
    document.getElementById("demo").innerHTML = days + "d " + hours + "h "
    + minutes + "m " + seconds + "s ";

    document.getElementById("hari").innerHTML = days ;

    document.getElementById("jam").innerHTML = hours ;

    document.getElementById("menit").innerHTML = minutes ;

    document.getElementById("detik").innerHTML = seconds ;

    // If the count down is over, write some text
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "EXPIRED";
    }
    }, 1000);


</script>
