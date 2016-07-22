<?php

class qa_next_prev_qinc_options {

	function allow_template($template)
	{
		return ($template!='admin');
	}

	function option_default($option) {

		switch($option) {

			case 'button_style_qinc':
				return 'blue';

			case 'previous_label_qinc':
				return '&larr; Prev. Qn. in Cat.';

			case 'next_label_qinc':
				return 'Next Qn. in Cat. &rarr;';

			default:
				return null;

		}	

	}
	
	function admin_form(&$qa_content)
	{

		$ok = null;
		if (qa_clicked('np_qinc_save_button')) {
			
			qa_opt('show_on_top_qinc',(bool)qa_post_text('show_on_top_qinc'));
			qa_opt('show_on_bottom_qinc',(bool)qa_post_text('show_on_bottom_qinc'));
			qa_opt('button_style_qinc', qa_post_text('button_style_qinc'));
			qa_opt('previous_label_qinc', qa_post_text('previous_label_qinc'));
			qa_opt('next_label_qinc', qa_post_text('next_label_qinc'));
			
			
			$ok = qa_lang('admin/options_saved');
		}
		else if (qa_clicked('np_qinc_reset_button')) {
			foreach($_POST as $i => $v) {
				$def = $this->option_default($i);
				if($def !== null) qa_opt($i,$def);
			}
			$ok = qa_lang('admin/options_reset');
		}			
		

		$fields = array();

		$button_style = array(

			'theme'			=>	'theme',
			'grey'			=>	'grey',
			'blue' 			=> 	'blue',
			'red' 			=> 	'red',
			'orange'		=>	'orange',
			'green' 		=> 	'green',
			'yellow' 		=> 	'yellow',
			'black' 		=> 	'black',
			'clean' 		=> 	'clean',
			'radius' 		=> 	'radius',
			'round' 		=> 	'round',
			'glossy-blue' 	=> 	'glossy-blue',
			'glossy-green' 	=> 	'glossy-green',
			'glossy-red' 	=> 	'glossy-red',
			'glossy-black' 	=> 	'glossy-black'			
		);

		$fields[] = array(
			'label' => 'Show on top',
			'tags' => 'NAME="show_on_top_qinc"',
			'value' => qa_opt('show_on_top_qinc'),
			'type' => 'checkbox',
		);

		$fields[] = array(
			'label' => 'Show on bottom',
			'tags' => 'NAME="show_on_bottom_qinc"',
			'value' => qa_opt('show_on_bottom_qinc'),
			'type' => 'checkbox',
		);
			
		$fields[] = array(
			'label' => 'Button Style',
			'tags' => 'NAME="button_style_qinc" title="how long you want to show slide"',
			'id' => 'button_style_qinc',
			'type' => 'select',
			'options' => $button_style,
			'value' => qa_opt('button_style_qinc'),
		);

		$fields[] = array(
			'id' => 'previous_label_qinc',
			'label' => 'Previous label',
			'type' => 'text',
			'value' => qa_opt('previous_label_qinc'),
			'tags' => 'NAME="previous_label_qinc"',
		);

		$fields[] = array(
			'id' => 'next_label_qinc',
			'label' => 'Next label',
			'type' => 'text',
			'value' => qa_opt('next_label_qinc'),
			'tags' => 'NAME="next_label_qinc"',
		);

		$fields[] = array(
			'type' => 'blank',
		);

		return array(
			'ok' => ($ok && !isset($error)) ? $ok : null,
			
			'fields' => $fields,
			
			'buttons' => array(
				array(
				'label' => qa_lang_html('main/save_button'),
				'tags' => 'NAME="np_qinc_save_button"',
				),
				array(
				'label' => qa_lang_html('admin/reset_options_button'),
				'tags' => 'NAME="np_qinc_reset_button"',
				),
			),
		);
	}

}
