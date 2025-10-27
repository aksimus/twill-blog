<?php

return [
	'namespace' => 'App',
	'admin_app_path' => 'cms',
	'admin_route_name_prefix' => env('ADMIN_ROUTE_NAME_PREFIX', 'twill.'),

	'block_editor' => [
		'use_twill_blocks' => [
			'you-tube-video',
			'text',
			'image',
			'contact-form',
			'opinion',
			'pros-cons',
			'faq',
		],
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
			'cover_image' => [
				'desktop' => [
					[
						'name' => 'desktop',
						'ratio' => 16 / 9,
					],
				],
				'mobile' => [
					[
						'name' => 'mobile',
						'ratio' => 16 / 9,
					],
				],
			],
			'avatar' => [
				'default' => [
					[
						'name' => 'default',
						'ratio' => 1,
					],
				],
			],
		],
	],
];
