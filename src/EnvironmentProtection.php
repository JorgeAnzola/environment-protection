<?php
/**
 * Environment protection plugin for Craft CMS 3.x
 *
 * Protects your different environments with an access password.
 *
 * @link      github.com/jorgeanzola
 * @copyright Copyright (c) 2019 Jorge Anzola
 */

namespace jorgeanzola\environmentprotection;

use craft\web\View;
use jorgeanzola\environmentprotection\services\Protector as ProtectorService;
use jorgeanzola\environmentprotection\models\Settings;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;

use yii\base\Event;

/**
 * Class EnvironmentProtection
 *
 * @author    Jorge Anzola
 * @package   EnvironmentProtection
 * @since     1.0.0
 *
 * @property  ProtectorService $protector
 */
class EnvironmentProtection extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var EnvironmentProtection
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '1.0.0';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        self::$plugin = $this;

        $settings = $this->getSettings();

        $isConsoleRequest = Craft::$app->getRequest()->getIsConsoleRequest();

        if (! $isConsoleRequest && $settings->protected) {
        	if (! $this->protector->canIAccess()) {
				if ($redirectUrl = $settings->redirectUrl) {
					header('Location: ' . $redirectUrl, true, 302);
					exit;
				} else if ($template = $settings->template) {

					$oldMode = Craft::$app->view->getTemplateMode();
					Craft::$app->view->setTemplateMode(View::TEMPLATE_MODE_SITE);
					$html = Craft::$app->view->renderTemplate($template);
					Craft::$app->view->setTemplateMode($oldMode);
					echo $html;
					Craft::$app->end();

				} else {

					$message = Craft::t(
						'environment-protection',
						'This website is protected.'
					);

					exit($message);
				}
			}

        	return $this->protector->saveMyCookie();
		}

        Craft::info(
            Craft::t(
                'environment-protection',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    protected function createSettingsModel()
    {
        return new Settings();
    }
}
