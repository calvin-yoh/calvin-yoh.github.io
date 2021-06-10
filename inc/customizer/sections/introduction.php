<?php
/**
 * Introduction Section options
 *
 * @package Theme Palace
 * @subpackage Myself
 * @since Myself 1.0.0
 */

// Add Introduction section
$wp_customize->add_section( 'myself_introduction_section', array(
	'title'             => esc_html__( 'Introduction','myself' ),
	'description'       => esc_html__( 'Introduction Section options.', 'myself' ),
	'panel'             => 'myself_front_page_panel',
) );

// Introduction content enable control and setting
$wp_customize->add_setting( 'myself_theme_options[introduction_section_enable]', array(
	'default'			=> 	$options['introduction_section_enable'],
	'sanitize_callback' => 'myself_sanitize_switch_control',
) );

$wp_customize->add_control( new Myself_Switch_Control( $wp_customize, 'myself_theme_options[introduction_section_enable]', array(
	'label'             => esc_html__( 'Introduction Section Enable', 'myself' ),
	'section'           => 'myself_introduction_section',
	'on_off_label' 		=> myself_switch_options(),
) ) );

// introduction pages drop down chooser control and setting
$wp_customize->add_setting( 'myself_theme_options[introduction_content_page]', array(
	'sanitize_callback' => 'myself_sanitize_page',
) );

$wp_customize->add_control( new Myself_Dropdown_Chooser( $wp_customize, 'myself_theme_options[introduction_content_page]', array(
	'label'             => esc_html__( 'Select Page', 'myself' ),
	'section'           => 'myself_introduction_section',
	'choices'			=> myself_page_choices(),
	'active_callback'	=> 'myself_is_introduction_section_enable',
) ) );

// introduction btn title setting and control
$wp_customize->add_setting( 'myself_theme_options[introduction_btn_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['introduction_btn_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'myself_theme_options[introduction_btn_title]', array(
	'label'           	=> esc_html__( 'Button Label', 'myself' ),
	'section'        	=> 'myself_introduction_section',
	'active_callback' 	=> 'myself_is_introduction_section_enable',
	'type'				=> 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'myself_theme_options[introduction_btn_title]', array(
		'selector'            => '#introduction-section a.btn-1',
		'settings'            => 'myself_theme_options[introduction_btn_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'myself_introduction_btn_title_partial',
    ) );
}
