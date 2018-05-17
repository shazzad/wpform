<?php
namespace Wpform\Utils;

class Assets
{
	public static $assets = [
		[
			'id' => 'wf_datetimepicker', 
			'path' => 'datetimepicker.js',
			'dependencies' => [],
			'version' => 1.0,
			'type' => 'js'
		],
		[
			'id' => 'wf_conditional_logic', 
			'path' => 'conditional_logic.js',
			'dependencies' => [],
			'version' => 1.0,
			'type' => 'js'
		],
		[
			'id' => 'wf_form', 
			'path' => 'form.js',
			'dependencies' => [
				'wf_datetimepicker',
				'wf_conditional_logic'
			],
			'version' => 1.0,
			'type' => 'js'
		],
		[
			'id' => 'select2', 
			'path' => 'select2.min.js',
			'dependencies' => [],
			'version' => 1.0,
			'type' => 'js'
		],
		[
			'id' => 'wf_datetimepicker', 
			'path' => 'datetimepicker.css',
			'dependencies' => [],
			'version' => 1.0,
			'type' => 'css'
		],
		[
			'id' => 'wf_form', 
			'path' => 'form.css',
			'dependencies' => ['wf_datetimepicker'],
			'version' => 1.0,
			'type' => 'css'
		],
		[
			'id' => 'select2',
			'path' => 'select2.min.css',
			'dependencies' => [],
			'version' => 1.0,
			'type' => 'css'
		]
	];
}
