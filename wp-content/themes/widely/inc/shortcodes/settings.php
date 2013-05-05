<?php

 require( '../../../../../wp-load.php' );

 $shortcode = array(

'button' => array(
	'params' => array(
		'url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Button URL', tk_theme_name),
			'desc' => __('Add the button\'s url eg http://example.com', tk_theme_name)
		),
		'style' => array(
			'type' => 'select',
			'label' => __('Button\'s Style', tk_theme_name),
			'desc' => __('Select the button\'s style, ie the buttons colour', tk_theme_name),
			'options' => array(
				'yellow' => 'Yellow',
				'dark-gray' => 'Dark Grey',
				'green' => 'Green',
                                'light-blue' => 'Light Blue',
                                'dark-blue' => 'Dark Blue',
                                'pink' => 'Pink',
	
			)
		),
		'content' => array(
			'std' => 'Button Text',
			'type' => 'text',
			'label' => __('Button\'s Text', tk_theme_name),
			'desc' => __('Add the button\'s text', tk_theme_name),
		)
	),
	'shortcode' => '[button url="{{url}}" style="{{style}}"] {{content}} [/button]',
),

'list' => array(
	'params' => array(
		'style' => array(
			'type' => 'select',
			'label' => __('Type of list', tk_theme_name),
			'desc' => __('Select the list type', tk_theme_name),
			'options' => array(
				'list-img1' => 'Tick',
				'list-img2' => 'Dot',
				'list-img3' => 'Arrow',
				'list-img4' => 'Plus',
				'list-img5' => 'Minus'
			)
		),
		'content' => array(
			'std' => 'List Text',
			'type' => 'textarea',
			'label' => __('List Text', tk_theme_name),
			'desc' => __('Add the list text', tk_theme_name),
		)
	),
	'shortcode' => '[list style="{{style}}"] {{content}} [/list]',
),

'columns' => array(
		'params' => array(
			'column' => array(
				'type' => 'select',
				'label' => __('Column Type', tk_theme_name),
				'desc' => __('Select the type of the column.', tk_theme_name),
				'options' => array(
					'one_half' => 'One Half',
					'one_third' => 'One Third',
					'one_fourth' => 'One Fourth',
				)
			),
			'position' => array(
				'std' => 'last',
				'type' => 'select',
				'label' => __('Last Column', tk_theme_name),
				'desc' => __('Check this box if this column is last.', tk_theme_name),
				'options' => array(
					'' => 'Regular Column',
					'last' => 'Last Column',
				)
			),
			'content' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => __('Column Content', tk_theme_name),
				'desc' => __('Add the column content.', tk_theme_name),
			),
		),

		'shortcode' => '[{{column}} position="{{position}}"] {{content}} [/{{column}}] ',
	)
);
 
function create_shortcode($popup)
	{
        global $shortcode;

		if( isset( $shortcode ) && is_array( $shortcode ) )
		{
			$shortcode_param = $shortcode[$popup]['params'];
			$shortcode_code = $shortcode[$popup]['shortcode'];

			$shortcode_output = print_shortcode( "\n" . '<div id="old-shortcode" class="hidden">' . $shortcode_code . '</div>' );
			$shortcode_output = print_shortcode( "\n" . '<div id="shortcode-popup" class="hidden">' . $popup . '</div>' );


			foreach( $shortcode_param as $key => $param )
			{
				$key = 'shortcode_' . $key;

				$row_start  = '<tbody>' . "\n";
				$row_start .= '<tr style="height:40px;">' . "\n";
				$row_start .= '<th class="label" style="vertical-align:top;width: 98px;padding-top:10px"><span class="alignleft">' . $param['label'] . '</span></th>' . "\n";
				$row_start .= '<td class="field">' . "\n";

				$row_end	= '<span>' . $param['desc'] . '</span>' . "\n";
				$row_end   .= '</td>' . "\n";
				$row_end   .= '</tr>' . "\n";
				$row_end   .= '</tbody>' . "\n";

				switch( $param['type'] )
				{
					case 'text' :

						$output  = $row_start;
						$output .= '<input type="text" class="popup-input" name="' . $key . '" id="' . $key . '" value="' . $param['std'] . '" />' . "\n";
						$output .= $row_end;

						print_shortcode( $output );

						break;

					case 'textarea' :

						$output  = $row_start;
						$output .= '<textarea rows="10" style="width:100%" name="' . $key . '" id="' . $key . '" class="popup-input">' . $param['std'] . '</textarea>' . "\n";
						$output .= $row_end;

						print_shortcode( $output );

						break;

					case 'select' :

						$output  = $row_start;
						$output .= '<select name="' . $key . '" id="' . $key . '" class="popup-input">' . "\n";

						foreach( $param['options'] as $value => $option )
						{
							$output .= '<option value="' . $value . '">' . $option . '</option>' . "\n";
						}

						$output .= '</select>' . "\n";
						$output .= $row_end;

						print_shortcode( $output );

						break;

				}
			}

		}
	}

	function print_shortcode( $output )
	{
            global $shortcode_output;
		$shortcode_output = $shortcode_output. "\n" . $output;
	}
?>
