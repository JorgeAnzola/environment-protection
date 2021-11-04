<?php
/**
 * Environment protection plugin for Craft CMS 3.x
 *
 * Protects your different environments with an access password.
 *
 * @link      github.com/jorgeanzola
 * @copyright Copyright (c) 2019 Jorge Anzola
 */

/**
 * Environment protection config.php
 *
 * This file exists only as a template for the Environment protection settings.
 * It does nothing on its own.
 *
 * Don't edit this file, instead copy it to 'craft/config' as 'environment-protection.php'
 * and make your changes there to override default settings.
 *
 * Once copied to 'craft/config', this file will be multi-environment aware as
 * well, so you can have different settings groups for each environment, just as
 * you do for 'general.php'
 */

return [

	'protected' => true,
	// 'redirectUrl' => 'https://your-production-website.com/',
	'accessPassword' => env('ACCESS_PASSWORD'),
	'template' => 'protected.twig',
    'cookieDuration' => 3600,
	'ipWhitelist' => [
		'::1',
		'127.0.0.1'
	],
];
