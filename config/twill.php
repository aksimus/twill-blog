<?php

return [
	'namespace' => 'App',
	'admin_app_path' => 'cms',
	'admin_route_name_prefix' => env('ADMIN_ROUTE_NAME_PREFIX', 'twill.'),

	'block_editor' => [
		'use_twill_blocks' => [],
		'crops' => [
			'highlight' => [
				'desktop' => [
					[
						'name' => 'desktop',
						'ratio' => 16 / 9,
					],
				],
				'mobile' => [
					[
						'name' => 'mobile',
						'ratio' => 1,
					],
				],
			],
		],
	],
];
