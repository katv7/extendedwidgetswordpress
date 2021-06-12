<?php

namespace ElementorNewAddonElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * 
 *
 * 
 *
 * @since 1.0.0
 */
class gaugechart_widgettwo extends Widget_Base{

  public function get_name(){
    return 'gaugecharttwo';
  }

  public function get_title(){
    return 'EWK Radial Gauge';
  }

  public function get_icon(){
    return 'fa fa-tachometer';
  }

  public function get_categories(){
    return ['general'];
  }

  protected function _register_controls(){

    $this->start_controls_section(
      'section_content',
      [
        'label' => 'Settings',
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control(
      'chart_id',
      [
        'label' => 'Chart ID',
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => 'first'
      ]
    );

     $this->add_responsive_control(
              'label_position',
              [
                'label' => __( 'Label Position', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                        'px' => [
                            'min'  => 0,
                            'max'  => 200,
                            'step' => 10,
                        ]],

                'selectors'  => [
                        '{{WRAPPER}} .subros' => 'bottom: {{SIZE}}{{UNIT}};',
                    ],
              ]
            );

     $this->add_control(
      'set_value',
      [
        'label' => 'Set Value',
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => '1400'
      ]
    );

      $this->add_control(
      'set_minvalue',
      [
        'label' => 'Min Value',
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => '0'
      ]
    );

        $this->add_control(
      'set_maxvalue',
      [
        'label' => 'Max Value',
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => '3000'
      ]
    );





      $this->add_control(
      'set_midcolor',
      [
        'label' => 'Mid Color',
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#FFFFFF',
      ]
    );

       $this->add_responsive_control(
              'gauge_angle',
              [
                'label' => __( 'Gauge Angle', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default'    => [
                        'size' => 0.1,
                        'unit' => 'px',
                    ],
                'range'      => [
                        'px' => [
                            'min'  => -0.5,
                            'max'  => 0.5,
                            'step' => 0.1,
                        ]],

                
              ]
            );
     

   


    

    $this->end_controls_section();

    
   

  }

    

  protected function render(){
    $settings = $this->get_settings_for_display();

    ?>
    <style type="text/css">
      .packmany{
        width: 100%;
        height: auto;
        padding:10px;
        text-align: center;

      }
      .subros{
        position: relative;
        bottom: 100px;
        text-align: center;
        font-size: 2em; 
        font-weight: bold;
        color: black; 
        font-family: 'Amaranth', sans-serif;
      }


    </style>

    

     <canvas id = "charts-<?php echo $settings['chart_id'];       ?>" class = "packmany" >  </canvas>
         <div id="previewchart-<?php echo $settings['chart_id'];       ?>" class="subros"></div>
         

         <script type="text/javascript">
          
          jQuery(document).ready(function(){
            var opts = {
            angle: <?php  echo $settings['gauge_angle']['size'];  ?>, // The span of the gauge arc
            lineWidth: 0.2, // The line thickness
            radiusScale: 1, // Relative radius
            pointer: {
              length: 0.59, // // Relative to gauge radius
              strokeWidth: 0.035, // The thickness
              color: '#000000' // Fill color
            },
            staticLabels: {
                      font: "12px sans-serif",  // Specifies font
                      labels: [<?php echo $settings['set_minvalue']; ?>,<?php echo $settings['set_value']; ?>,<?php echo $settings['set_maxvalue']; ?>],  // Print labels at these values
                      color: "#000000",  // Optional: Label text color
                      fractionDigits: 0  // Optional: Numerical precision. 0=round off.
                    },

            percentColors : [[0.0, "#a9d70b" ], [0.50, "<?php echo $settings['set_midcolor'];    ?>"], [1.0, "#ff0000"]],
            limitMax: false,     // If false, max value increases automatically if value > maxValue
            limitMin: false,     // If true, the min value of the gauge will be fixed
            colorStart: '#6FADCF',   // Colors
            colorStop: '#8FC0DA',    // just experiment with them
            strokeColor: '#E0E0E0',  // to see which ones work best for you
            generateGradient: true,
            highDpiSupport: true,     // High resolution support
            
          };
          var target = document.getElementById("charts-<?php echo $settings['chart_id'];       ?>"); // your canvas element
          var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
          gauge.maxValue = <?php echo json_encode($settings['set_maxvalue']); ?>; // set max gauge value
          gauge.setMinValue(<?php echo $settings['set_minvalue']; ?>);  // Prefer setter over gauge.minValue = 0
          gauge.animationSpeed = 60; // set animation speed (32 is default value)
          gauge.set(<?php echo json_encode($settings['set_value']);     ?>); // set actual value
          gauge.setTextField(document.getElementById("previewchart-<?php echo $settings['chart_id'];       ?>"));

                                    

         
          }
          )



         </script>













    <?php


   


    








    
  }

  
}




