<?php
// mb vc element
vc_map(array(
    'name' => 'MB Heading',
    'base' => 'mb_heading',
    'description' => 'Heading.',
    'category' => 'MB Elements',
    'params' => array(
        array(
            'type' => 'textfield',
            'admin_label' => true,
            'heading' => 'Icon',
            'description' => 'https://icons.getbootstrap.com/',
            'param_name' => 'mb_heading_icon',
        ),
        array(
            'type' => 'checkbox',
            'admin_label' => true,
            'heading' => 'Rounded corners?',
            'description' => 'Rounded corners',
            'param_name' => 'mb_heading_rounded_corners',
            'value' => array('Yes' => 1)
        ),
        array(
            'type' => 'textfield',
            'admin_label' => true,
            'heading' => 'Heading',
            'description' => 'Heading',
            'param_name' => 'mb_heading_heading',
        ),
        array(
            'type' => 'textfield',
            'admin_label' => true,
            'heading' => 'Subheading',
            'description' => 'Subheading',
            'param_name' => 'mb_heading_subheading',
        ),
        array(
            'type' => 'colorpicker',
            'admin_label' => true,
            'heading' => 'Background Color',
            'description' => 'Outer background color of the section',
            'param_name' => 'mb_heading_background_color',
        ),
        array(
            'type' => 'colorpicker',
            'admin_label' => true,
            'heading' => 'Box Color',
            'description' => 'Inner rounded box background color',
            'param_name' => 'mb_heading_box_color',
        ),     
    )
));
    
// mb vc shortcode
add_shortcode('mb_heading', 'mb_heading');
function mb_heading($atts, $content) {
    extract(shortcode_atts(array(   
        'mb_heading_icon' => '',
        'mb_heading_rounded_corners' => '',
        'mb_heading_heading' => '',
        'mb_heading_subheading' => '',
        'mb_heading_background_color' => '',
        'mb_heading_box_color' => '',
    ), $atts));
    
    $unique_id = 'mb-heading-' . uniqid();
    $html = '';
    
    if ($mb_heading_background_color || $mb_heading_box_color) {
        $html .= '<style>';
        if ($mb_heading_background_color) {
            $html .= '#'.$unique_id.' { background-color: '.$mb_heading_background_color.' !important; }';
        }
        if ($mb_heading_box_color) {
            $html .= '#'.$unique_id.' .mb-heading-inner-box { background-color: '.$mb_heading_box_color.' !important; border-top-left-radius: 1rem !important; border-top-right-radius: 1rem !important; border-bottom-left-radius: 0 !important; border-bottom-right-radius: 0 !important; }';
        }
        $html .= '</style>';
    }

    $bg_class = ($mb_heading_rounded_corners || $mb_heading_background_color) ? '' : ' bg-light';

    $html .= '
    <section class="'.$bg_class.' pt-5" id="'.$unique_id.'">
        <div class="container px-5'.($mb_heading_rounded_corners ? '' : ' mt-5').'">
            '.($mb_heading_rounded_corners ? '<div class="mb-heading-inner-box bg-light py-5 px-4 px-md-5" style="border-top-left-radius: 1rem; border-top-right-radius: 1rem; border-bottom-left-radius: 0; border-bottom-right-radius: 0;">' : '').'
            <div class="text-center">
                '.($mb_heading_icon ? '<div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi '.$mb_heading_icon.'"></i></div>' : '').'
                <h1 class="fw-bolder">'.$mb_heading_heading.'</h1>
                <p class="lead fw-normal text-muted mb-0">'.$mb_heading_subheading.'</p>
            </div>
            '.($mb_heading_rounded_corners ? '</div>' : '').'
        </div>
    </section>
    ';
    
    return $html;
}