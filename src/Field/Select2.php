<?php
namespace W4dev\Wpform\Field;

class Select2 extends Field
{
	public function __construct($data = [])
    {
		$data['type'] = 'select2';
		parent::__construct($data);
	}
	public function get_html($form)
    {
		$data = $this->data;
		if (isset($data['multiple']) && $data['multiple']) {
			if (! isset($data['input_attrs'])) {
				$data['input_attrs'] = [];
			}
			$data['input_attrs']['multiple'] = 'multiple';
		}

		$select2 = [];
		if (! empty($data['select2'])) {
			$select2 = $data['select2'];
		}
		if (! isset($select2['placeholder'])) {
			$select2['placeholder'] = __('Select an item');
		}
		$select2['allowclear'] = true;
		if (! empty($select2['data'])) {
			$select2['src'] = site_url('/wp-json/w4dev_wpform/v2/'. $select2['data']);
		}
		if (! empty($data['value'])) {
			$select2['value'] = $data['value'];
		}
<<<<<<< HEAD
		if (! isset($select2['minimumInputLength'])) {
			/* if data is being fetched from source, minumum 2 character input needed by default */
			if (! empty($select2['src'])) {
				$select2['minimumInputLength'] = 2;
			} else {
				$select2['minimumInputLength'] = 0;
			}
		}
=======
>>>>>>> origin/master

		if (! isset($data['input_attrs'])) {
			$data['input_attrs'] = [];
		}
		$data['input_attrs']['data-s2'] = json_encode($select2);

		$data = $this->sanitize_data($data);
		##echo '<pre>';
		#print_r($data);
		#die();

		extract($data);

		$html = $before;

		if ($field_wrap){
			$html .= sprintf('<div class="%1$s"%2$s>', $this->form_pitc_class('wf-field-wrap', $id, $type, $class), $attr);
		}

		$html .= $field_before;
			// label
			$html .= $label_wrap_before;
			$html .= $this->form_field_label($data);

			// description
			if (! empty($desc)){
				$html .= sprintf('<div class="%1$s">%2$s</div>', $this->form_pitc_class('wf-field-desc-wrap', $id, $type), $desc);
			}

			// input
			$html .= $input_wrap_before;
			if ($input_wrap){
				$html .= sprintf('<div class="%1$s %2$s"%3$s>', $this->form_pitc_class('wf-field-input-wrap', $id, $type), $input_wrap_class, $input_wrap_attr);
			}
			$html .= $input_before;
			$html .= sprintf(
				'<select class="%1$s %5$s" id="%2$s" name="%3$s"%4$s>', 
				$this->form_pitc_class('wf-field', $id, $type), 
				$id, 
				$name, 
				$input_attr, 
				$input_class 
			);

			foreach ($choices as $key => $label) {
				if (empty($label)){
					continue;
				}
				elseif (is_array($label) && isset($label['optgroup_open'])) {
					$html .= $label['optgroup_open'];
					continue;
				}
				elseif (is_array($label) && isset($label['optgroup_close'])) {
					$html .= $label['optgroup_close'];
					continue;
				}

				$child_input_attr = '';
				$child_input_class = '';
				$_label = $label;

				if (is_array($_label) && isset($_label['child_input_before'])) {
					$html .= $_label['child_input_before'];
				}

				if (isset($label->id) && isset($label->name)){
					$key = $label->id;
					$label = $label->name;
				}
				elseif ($label instanceof WF_Data){
					$key = $label->get_id();
					$label = $label->get_name();
				}
				elseif (isset($label['key']) && isset($label['name'])){
					$key = $label['key'];
					$label = $label['name'];
					$child_input_attr = isset($_label['input_attr']) ? $_label['input_attr'] : '';
					$child_input_class = isset($_label['input_class']) ? $_label['input_class'] : '';
				}
				elseif (is_array($label)) {
					$child_input_attr = isset($label['attr']) ? $label['attr'] : '';
					$label = $l['label'];
				}

				$selected = esc_attr($value) == esc_attr($key) ? ' selected="selected"' : '';
				$html .= sprintf(
					'<option value="%1$s"%2$s class="%4$s" %5$s>%3$s</option>', 
					$key, $selected, $label, $child_input_class, $child_input_attr
				);

				if (is_array($_label) && isset($_label['child_input_after'])) {
					$html .= $_label['child_input_after'];
				}
			}

			$html .= '</select>';
			$html .= $input_after;
			if ($input_wrap){
				$html .= '</div>';
			}

		$html .= $field_after;
		
		if (isset($desc_after)){
			if (! empty($desc_after)){
				$html .= sprintf('<div class="%1$s">%2$s</div>', $this->form_pitc_class('wf-field-desc-after-wrap', $id, $type), $desc_after);
			}
		}

		if ($field_wrap){
			$html .= '</div>';
		}

		return $html;
	}
}

?>