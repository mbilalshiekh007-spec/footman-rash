<?php
// mb vc element
vc_map(array(
    'name' => 'MB Contact Form',
    'base' => 'mb_contact_form',
    'description' => 'MB Contact Form.',
    'category' => 'MB Elements',
    'params' => array(
        array(
            'type' => 'textfield',
            'admin_label' => true,
            'heading' => 'Contact Form 7 ID',
            'description' => 'Enter Contact Form 7 ID',
            'param_name' => 'mb_contact_form_cf_id',
        ),
        array(
            'type' => 'colorpicker',
            'admin_label' => true,
            'heading' => 'Background Color',
            'description' => 'Outer background color of the section',
            'param_name' => 'mb_contact_form_background_color',
        ),
        array(
            'type' => 'colorpicker',
            'admin_label' => true,
            'heading' => 'Box Color',
            'description' => 'Inner box background color around the form',
            'param_name' => 'mb_contact_form_box_color',
        ),     
    )
));
    
// mb vc shortcode
add_shortcode('mb_contact_form', 'mb_contact_form');
function mb_contact_form($atts, $content) {
    extract(shortcode_atts(array(   
        'mb_contact_form_cf_id' => '',
        'mb_contact_form_background_color' => '',
        'mb_contact_form_box_color' => '',
    ), $atts));
    
    $unique_id = 'mb-contact-form-' . uniqid();
    $html = '';
    
    if ($mb_contact_form_background_color || $mb_contact_form_box_color) {
        $html .= '<style>';
        if ($mb_contact_form_background_color) {
            $html .= '#'.$unique_id.' { background-color: '.$mb_contact_form_background_color.' !important; }';
        }
        if ($mb_contact_form_box_color) {
            $html .= '#'.$unique_id.' .mb-form-inner-box { background-color: '.$mb_contact_form_box_color.' !important; border-top-left-radius: 0 !important; border-top-right-radius: 0 !important; border-bottom-left-radius: 1rem !important; border-bottom-right-radius: 1rem !important; }';
        }
        $html .= '</style>';
    }

    // Notice the added margin-top: -30px here to force it upward
    $html .= '
    <section class="pb-5" id="'.$unique_id.'" style="margin-top: -30px !important; position: relative; z-index: 5;">
        <div class="container px-5">
            <!-- Contact form-->
            <div class="mb-form-inner-box bg-light pb-5 pt-5 px-4 px-md-5 mb-5" style="border-top-left-radius: 0; border-top-right-radius: 0; border-bottom-left-radius: 1rem; border-bottom-right-radius: 1rem;">                        
                <div class="row gx-5 justify-content-center">
                    <div class="col-lg-8 col-xl-6">
                    '.do_shortcode('[contact-form-7 id="'.$mb_contact_form_cf_id.'"]').'
                    </div>
                </div>
            </div>
        </div>
    </section>
    ';
    
    return $html;
}