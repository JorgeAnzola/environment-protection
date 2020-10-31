<?php
/**
 * Environment protection plugin for Craft CMS 3.x
 *
 * Protects your different environments with an access password.
 *
 * @link      github.com/jorgeanzola
 * @copyright Copyright (c) 2019 Jorge Anzola
 */

namespace jorgeanzola\environmentprotection\assetbundles\EnvironmentProtection;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    Jorge Anzola
 * @package   EnvironmentProtection
 * @since     1.0.0
 */
class EnvironmentProtectionAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = "@jorgeanzola/environmentprotection/assetbundles/environmentprotection/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->js = [
            'js/EnvironmentProtection.js',
        ];

        $this->css = [
            'css/EnvironmentProtection.css',
        ];

        parent::init();
    }
}
