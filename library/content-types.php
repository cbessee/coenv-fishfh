<?php


/*
 * Register custom content types
 */

function coenv_base_post_types_init() {
  register_post_type( 'faculty',
    array(
      'labels' => array(    
      'name' => __( 'Faculty' ),
      'singular_name' => __( 'Faculty' ),
      'add_new_item' => __( 'Add New Faculty' ),
      ),
    'supports' => array( 'title', 'editor', 'thumbnail', 'revisions' ),
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
          'key' => 'field_54077e2cf5805',
          'label' => 'Phone numbers',
          'name' => 'phone_numbers',
          'type' => 'repeater',
          'instructions' => 'Please enter the phone number(s) for this faculty member. ',
          'sub_fields' => array (
            array (
              'key' => 'field_54077e6cf5806',
              'label' => 'Number',
              'name' => 'number',
              'type' => 'text',
              'instructions' => 'e.g., (206) 999-999',
              'column_width' => 100,
              'default_value' => '',
              'placeholder' => '',
              'prepend' => '',
              'append' => '',
              'formatting' => 'none',
              'maxlength' => '',
            ),
            array (
              'key' => 'field_54077e96f5807',
              'label' => 'Label',
              'name' => 'label',
              'type' => 'select',
              'instructions' => 'Please choose a label for this number',
              'column_width' => 100,
              'choices' => array (
                'office' => 'Office',
                'mobile' => 'Mobile',
                'fax' => 'Fax',
                'tty' => 'TTY',
                'other' => 'Other',
              ),
              'default_value' => '',
              'allow_null' => 1,
              'multiple' => 0,
            ),
            array (
              'key' => 'field_54077f8a57a5f',
              'label' => 'Other label',
              'name' => 'other_label',
              'type' => 'text',
              'instructions' => 'Please enter your custom label. The label must be 5 characters or less. All labels are wrapped in a parenthesis and converted to lowercase.',
              'conditional_logic' => array (
                'status' => 1,
                'rules' => array (
                  array (
                    'field' => 'field_54077e96f5807',
                    'operator' => '==',
                    'value' => 'other',
                  ),
                ),
                'allorany' => 'all',
              ),
              'column_width' => '',
              'default_value' => '',
              'placeholder' => '',
              'prepend' => '',
              'append' => '',
              'formatting' => 'none',
              'maxlength' => '',
            ),
          ),
          'row_min' => 1,
          'row_limit' => 4,
          'layout' => 'row',
          'button_label' => 'Add number',
        ),
        array (
          'key' => 'field_540652446cb99',
          'label' => 'Job Title',
          'name' => 'job_title',
          'type' => 'text',
          'instructions' => 'e.g., Professor, Associate Professor',
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
          'type' => 'select',
          'choices' => array (
            'RTB' => 'Benjamin Hall Interdisciplinary Research Building (RTB)',
            'BLD' => 'Bloedel Hall (BLD)',
            'FSH' => 'Fishery Sciences (FSH)',
            'FTR' => 'Fisheries Teaching and Research Building (FTR)',
            'FHL' => 'Friday Harbor Labs',
            'KIN' => 'Kincaid Hall (KIN)',
            'MAR' => 'Marine Studies Building (MAR)',
            'MSB' => 'Marine Sciences Building (MSB)',
          ),
          'instructions' => 'Select the primary building for this faculty member.',
          'default_value' => '',
          'allow_null' => 1,
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
        'key' => 'field_54078884fb956',
        'label' => 'Faculty type',
        'name' => 'faculty_type',
        'type' => 'select',
        'required' => 0,
        'choices' => array (
          'teaching-research' => 'Teaching and Research',
          'research-associates' => 'Research Associates (Post-Docs)',
          'adjunct' => 'Adjunct Faculty',
          'emeritus' => 'Emeritus/Retired Faculty',
        ),
        'default_value' => '',
        'allow_null' => 1,
        'multiple' => 0,
        ),
        array (
          'key' => 'field_5406519be18db',
          'label' => 'SciVal URL',
          'name' => 'scival_url',
          'type' => 'text',
          'instructions' => 'Enter the full url of the faculty member\'s SciVal page (e.g., http://www.experts.scival.com/uwashington/expert.asp?n=First+M.+Last&u_id=999).',
          'conditional_logic' => array (
                'status' => 1,
                'rules' => array (
                  array (
                    'field' => 'field_54078884fb956',
                    'operator' => '==',
                    'value' => 'teaching-research',
                  ),
                ),
                'allorany' => 'all',
              ),
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
          'conditional_logic' => array (
                'status' => 1,
                'rules' => array (
                  array (
                    'field' => 'field_54078884fb956',
                    'operator' => '==',
                    'value' => 'teaching-research',
                  ),
                ),
                'allorany' => 'all',
              ),
          'default_value' => '',
          'placeholder' => '',
          'prepend' => '',
          'append' => '',
          'formatting' => 'none',
          'maxlength' => '',
        ),
        array (
          'key' => 'field_540784eba0b3e',
          'label' => 'Faculty advising',
          'name' => 'available_for_advising',
          'type' => 'checkbox',
          'choices' => array (
            'yes' => 'This faculty member is available for advising.',
          ),
          'conditional_logic' => array (
                'status' => 1,
                'rules' => array (
                  array (
                    'field' => 'field_54078884fb956',
                    'operator' => '==',
                    'value' => 'teaching-research',
                  ),
                ),
                'allorany' => 'all',
              ),
          'default_value' => '',
          'layout' => 'horizontal',
        ),
        array (
          'key' => 'field_540651f36cbcb',
          'label' => 'Selected publications',
          'name' => 'selected_publications',
          'type' => 'repeater',
          'instructions' => 'Enter each of the faculty member\'s publications. Use a consistent format.',
          'conditional_logic' => array (
                'status' => 1,
                'rules' => array (
                  array (
                    'field' => 'field_54078884fb956',
                    'operator' => '==',
                    'value' => 'teaching-research',
                  ),
                ),
                'allorany' => 'all',
              ),
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
            'value' => 'faculty',
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