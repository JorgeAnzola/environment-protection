# Environment protection plugin for Craft CMS 3.x

Protects your different environments with an access password.

![Screenshot](resources/img/plugin-logo.png)

## Requirements

This plugin requires Craft CMS 3.0.0-beta.23 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require jorgeanzola/environment-protection

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Environment protection.

## Configuring Environment protection

Create a `environment-protection.php` file in the config folder of your folder.

if the file contains `redirectUrl`, this will be used instead of the template.

```
'protected' => true,
'redirectUrl' => 'https://your-production-website.com/',
'accessPassword' => env('ACCESS_PASSWORD'),
'cookieDuration' => 86400,
'template' => 'protected.twig',
'ipWhitelist' => [
	'::1',
	'127.0.0.1'
],
```

## Environment protection Roadmap

Some things to do, and ideas for potential features:

Brought to you by [Jorge Anzola](github.com/jorgeanzola)
