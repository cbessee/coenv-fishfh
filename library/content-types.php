<?php
function coenv_base_post_types_init() {
  register_post_type( 'coenv_base_faculty',
    array(
      'labels' => array(    
      'name' => __( 'Faculty' ),
      'singular_name' => __( 'Faculty' ),
      'add_new_item' => __( 'Add New Faculty' ),
      ),
    'public' => true,
    'has_archive' => true,
    'show_ui' => true
    )
  );
}

add_action( 'init', 'coenv_base_post_types_init' );

/*
 * Add fields to faculty post type
 */

function coenv_base_fields_faculty_init() {
  if(function_exists("register_field_group"))
  {
    register_field_group(array (
      'id' => 'acf_faculty',
      'title' => 'Faculty',
      'fields' => array (
        array (
          'key' => 'field_54063e56876ac',
          'label' => 'Faculty name',
          'name' => 'name',
          'type' => 'repeater',
          'sub_fields' => array (
            array (
              'key' => 'field_54063e66876ad',
              'label' => 'First name',
              'name' => 'first_name',
              'type' => 'text',
              'required' => 1,
              'column_width' => 33,
              'default_value' => '',
              'placeholder' => '',
              'prepend' => '',
              'append' => '',
              'formatting' => 'none',
              'maxlength' => '',
            ),
            array (
              'key' => 'field_54063e75876ae',
              'label' => 'Middle name/initial',
              'name' => 'middle_name_initial',
              'type' => 'text',
              'column_width' => 33,
              'default_value' => '',
              'placeholder' => '',
              'prepend' => '',
              'append' => '',
              'formatting' => 'none',
              'maxlength' => '',
            ),
            array (
              'key' => 'field_54063e86876af',
              'label' => 'Last name',
              'name' => 'last_name',
              'type' => 'text',
              'required' => 1,
              'column_width' => 33,
              'default_value' => '',
              'placeholder' => '',
              'prepend' => '',
              'append' => '',
              'formatting' => 'none',
              'maxlength' => '',
            ),
          ),
          'row_min' => 1,
          'row_limit' => 1,
          'layout' => 'table',
          'button_label' => 'Add Row',
        ),
        array (
          'key' => 'field_54065029d2d56',
          'label' => 'Email address',
          'name' => 'email_address',
          'type' => 'email',
          'instructions' => 'e.g., someone@uw.edu',
          'required' => 1,
          'default_value' => '',
          'placeholder' => '',
          'prepend' => '',
          'append' => '',
        ),
        array (
          'key' => 'field_54065047d2d57',
          'label' => 'Phone number',
          'name' => 'phone_number',
          'type' => 'text',
          'instructions' => 'e.g., (206) 999-9999',
          'required' => 1,
          'default_value' => '',
          'placeholder' => '',
          'prepend' => '',
          'append' => '',
          'formatting' => 'none',
          'maxlength' => '',
        ),
        array (
          'key' => 'field_5406508d17264',
          'label' => 'Building',
          'name' => 'building',
          'type' => 'taxonomy',
          'instructions' => 'Select the primary building for this faculty member.',
          'taxonomy' => 'buildings',
          'field_type' => 'select',
          'allow_null' => 0,
          'load_save_terms' => 1,
          'return_format' => 'id',
          'multiple' => 0,
        ),
        array (
          'key' => 'field_540650c317265',
          'label' => 'Room number',
          'name' => 'room_number',
          'type' => 'text',
          'instructions' => 'Enter the primary room number for this faculty member.',
          'default_value' => '',
          'placeholder' => '',
          'prepend' => '',
          'append' => '',
          'formatting' => 'none',
          'maxlength' => '',
        ),
        array (
          'key' => 'field_5406515faaaf7',
          'label' => 'Website URL',
          'name' => 'website_url',
          'type' => 'text',
          'instructions' => 'Enter the full url of the faculty member\'s website (e.g., http://depts.washington.edu/facultyname).',
          'default_value' => '',
          'placeholder' => '',
          'prepend' => '',
          'append' => '',
          'formatting' => 'none',
          'maxlength' => '',
        ),
        array (
          'key' => 'field_5406519be18db',
          'label' => 'SciVal URL',
          'name' => 'scival_url',
          'type' => 'text',
          'instructions' => 'Enter the full url of the faculty member\'s SciVal page (e.g., http://www.experts.scival.com/uwashington/expert.asp?n=First+M.+Last&u_id=999).',
          'default_value' => '',
          'placeholder' => '',
          'prepend' => '',
          'append' => '',
          'formatting' => 'none',
          'maxlength' => '',
        ),
        array (
          'key' => 'field_540651c1f518f',
          'label' => 'Twitter URL',
          'name' => 'twitter_url',
          'type' => 'text',
          'instructions' => 'Enter the full url of the faculty member\'s Twitter page (e.g., http://twitter.com/faculty_id).',
          'default_value' => '',
          'placeholder' => '',
          'prepend' => '',
          'append' => '',
          'formatting' => 'none',
          'maxlength' => '',
        ),
        array (
          'key' => 'field_540651f36cbcb',
          'label' => 'Selected publications',
          'name' => 'selected_publications',
          'type' => 'repeater',
          'instructions' => 'Enter each of the faculty member\'s publications. Use a consistent format.',
          'sub_fields' => array (
            array (
              'key' => 'field_540652446cbcc',
              'label' => 'Publication',
              'name' => 'publication',
              'type' => 'textarea',
              'instructions' => 'Enter a single publication. To add more, click "Add publication".',
              'column_width' => 100,
              'default_value' => '',
              'placeholder' => '',
              'maxlength' => '',
              'rows' => '',
              'formatting' => 'br',
            ),
          ),
          'row_min' => '1',
          'row_limit' => '',
          'layout' => 'table',
          'button_label' => 'Add publication',
        ),
      ),
      'location' => array (
        array (
          array (
            'param' => 'post_type',
            'operator' => '==',
            'value' => 'coenv_base_faculty',
            'order_no' => 0,
            'group_no' => 0,
          ),
        ),
      ),
      'options' => array (
        'position' => 'normal',
        'layout' => 'no_box',
        'hide_on_screen' => array (
        ),
      ),
      'menu_order' => 0,
    ));
  }
}
add_action('acf/register_fields', 'coenv_base_fields_faculty_init');