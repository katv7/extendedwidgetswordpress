<?php

namespace ElementorNewAddonElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use WP_Query;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * 
 *
 * 
 *
 * @since 1.0.0
 */
class accordionmanager_widget extends Widget_Base{

  

  public function get_name(){
    return 'accordionpostss';
  }

  public function get_title(){
    return 'EWK Post Accordion';
  }

  public function get_icon(){
    return 'fa fa-caret-down';
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
      

    $this->add_responsive_control(
      'show_image',
      [
        'label' => __( 'Show Featured Image', 'plugin-domain' ),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => __( 'Show', 'your-plugin' ),
        'label_off' => __( 'Hide', 'your-plugin' ),
        'return_value' => 'true',
        'default' => 'true',
      ]
    );

         $this->add_responsive_control(
              'exc_length',
              [
                'label' => __( 'Content Length', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'default'    => [
                        'size' => 90,
                        'unit' => '%',
                    ],
                'range'      => [
                        '%' => [
                            'min'  => 10,
                            'max'  => 120,
                            'step' => 10,
                        ]],

                
              ]
            );

         $this->add_responsive_control(
              'post_disp',
              [
                'label' => __( 'No. of Post to display', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'default'    => [
                        'size' => 3,
                        'unit' => '%',
                    ],
                'range'      => [
                        '%' => [
                            'min'  => 2,
                            'max'  => 10,
                            'step' => 1,
                        ]],

                
              ]
            );
         
           $this->add_responsive_control(
              'panel_widths',
              [
                'label' => __( 'Panel Width px', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default'    => [
                        'size' => 500,
                        'unit' => 'px',
                    ],
                'range'      => [
                        'px' => [
                            'min'  => 300,
                            'max'  => 800,
                            'step' => 50,
                        ]],

                'selectors'  => [
                        '{{WRAPPER}} .twrapper' => 'width: {{SIZE}}{{UNIT}};',
                    ],
              ]
            );





    $this->end_controls_section();

     $this->start_controls_section(
      'style_content',
      [
        'label' => 'Style',
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

               $this->add_control(
      'titles_background',
      [
        'label' => __( 'Title Background Color', 'plugin-domain' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => 'steelblue',
        'selectors' => [
          
          '{{WRAPPER}} .twrapper .accordionwrap .headercontent' => 'background-color: {{VALUE}};',
          #'{{WRAPPER}} nav.cotains>a.active' => 'color: {{value}};',
        ],
        
        
      ]
    );

                        $this->add_control(
      'titles_bottom',
      [
        'label' => __( 'Title Border Color', 'plugin-domain' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#050505',
        'selectors' => [
          
          '{{WRAPPER}} .twrapper .accordionwrap .headercontent' => 'border-bottom: 2px solid {{VALUE}};',
          #'{{WRAPPER}} nav.cotains>a.active' => 'color: {{value}};',
        ],
        
        
      ]
    );


                        $this->add_control(
      'titles_colors',
      [
        'label' => __( 'Title Color', 'plugin-domain' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#FBFBFB',
        'selectors' => [
          
          '{{WRAPPER}} .twrapper .accordionwrap .headercontent' => 'color: {{VALUE}};',
          #'{{WRAPPER}} nav.cotains>a.active' => 'color: {{value}};',
        ],
        
        
      ]
    );


                       $this->add_control(
      'titles_colors_border_hover',
      [
        'label' => __( 'Title Hover Border Color', 'plugin-domain' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#FBFBFB',
        'selectors' => [
          
          '{{WRAPPER}} .twrapper .accordionwrap .headercontent:hover' => 'border-bottom: 2px solid {{VALUE}};',
          #'{{WRAPPER}} nav.cotains>a.active' => 'color: {{value}};',
        ],
        
        
      ]
    );


                        $this->add_control(
      'the_activeborder_colors',
      [
        'label' => __( 'Active Border Color', 'plugin-domain' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#FFF900',
        'selectors' => [
          
          '{{WRAPPER}} .twrapper .accordionwrap .headercontent.active' => 'border-bottom: 4px solid {{VALUE}};',
        ],
        
        
      ]
    );



            $this->add_control(
      'hrdivider',
      [
        'type' => \Elementor\Controls_Manager::DIVIDER,
      ]
    );



                        $this->add_control(
      'the_content_colors_background',
      [
        'label' => __( 'Content Background Color', 'plugin-domain' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#050505',
        'selectors' => [
          
          '{{WRAPPER}} .twrapper .accordionwrap .panelcontents' => 'background-color: {{VALUE}};',
          #'{{WRAPPER}} nav.cotains>a.active' => 'color: {{value}};',
        ],
        
        
      ]
    );
   
      $this->add_group_control(
             \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'the_content_typography',
                    'label' => __( 'Content Typography', 'plugin-domain' ),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .twrapper .accordionwrap .panelcontents p',
                  ]
                );

                         $this->add_control(
      'the_content_colors',
      [
        'label' => __( 'Content Color', 'plugin-domain' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#FBFBFB',
        'selectors' => [
          
          '{{WRAPPER}} .twrapper .accordionwrap .panelcontents' => 'color: {{VALUE}};',
          #'{{WRAPPER}} nav.cotains>a.active' => 'color: {{value}};',
        ],
        
        
      ]
    );














    $this->end_controls_section();
  }

    

  protected function render(){
    $settings = $this->get_settings_for_display();



    ?>
            <script type="text/javascript">
                jQuery(document).ready(function(){

                jQuery('.headercontent').click(function(){
                  jQuery('.headercontent').removeClass('active');
                  jQuery(this).addClass("active");
                });
              }
              )
            


            </script>

    <?php
         $pnumber = $settings['post_disp']['size'];
    $loop = new WP_Query(array('post_type'=>'post','posts_per_page'=> $pnumber));

     ?>
    <div class = "twrapper">
      <?php
   
    while($loop->have_posts()):$loop->the_post();

    

     ?>
     
        <div class="accordionwrap">
            <div class="headercontent">
              <?php the_title();   ?>
      
            </div>

          <div class="panelcontents">

            <p> 
              <?php  $content = wp_strip_all_tags(get_the_content());
                       $number = $settings['exc_length']['size']; 
                          echo mb_strimwidth($content, 0,  $number , '...');  ?>
                  <a class = "forhover" href="<?php the_permalink() ?>">Read more  </a>

               
             </p>
              <?php if($settings["show_image"]==="true"){

                ?>

                <p>
               <?php if ( has_post_thumbnail() ) {
                       the_post_thumbnail('thumbnail');
                    }

                ?>

            </p><?php

              }     ?>
            
             
        
           </div>
       </div>
 
  

    <?php       
            
        endwhile;
        ?>
        </div>
          <?php
    
    wp_reset_postdata();




   

  


   















    
  }

  
}




