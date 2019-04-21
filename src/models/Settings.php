<?php
/**
 * Environment protection plugin for Craft CMS 3.x
 *
 * Protects your different environments with an access password.
 *
 * @link      github.com/jorgeanzola
 * @copyright Copyright (c) 2019 Jorge Anzola
 */

namespace jorgeanzola\environmentprotection\models;

use jorgeanzola\environmentprotection\EnvironmentProtection;

use Craft;
use craft\base\Model;

/**
 * @author    Jorge Anzola
 * @package   EnvironmentProtection
 * @since     1.0.0
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * @var bool
     */
    public $protected = false;

    /**
     * @var string
     */
    public $redirectUrl;

    /**
     * @var string
     */
    public $accessPassword;

    /**
     * @var string
     */
    public $template;

    /**
     * @var array
     */
    public $ipWhitelist;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['protected'], 'bool'],
            [['redirectUrl', 'accessPassword', 'template'], 'string'],
            [['ipWhitelist'], 'array'],
			[['protected', 'accessPassword', 'ipWhitelis'], 'required']
        ];
    }
}
