<?php
/**
 * Environment protection plugin for Craft CMS 3.x
 *
 * Protects your different environments with an access password.
 *
 * @link      github.com/jorgeanzola
 * @copyright Copyright (c) 2019 Jorge Anzola
 */

namespace jorgeanzola\environmentprotection\services;

use jorgeanzola\environmentprotection\EnvironmentProtection;

use Craft;
use craft\base\Component;

/**
 * @author    Jorge Anzola
 * @package   EnvironmentProtection
 * @since     1.0.0
 */
class Protector extends Component
{
    // Public Methods
    // =========================================================================

    /*
     * @return mixed
     */
    public function canIAccess(): bool
    {
    	return ($this->doIHaveACorrectAccessPassword() || $this->isMyIpWhitelisted());
    }

	protected function isMyIpWhitelisted(): bool
	{
		return in_array($this->getMyIp(), $this->getIpWhitelist());
    }

	protected function doIHaveACorrectAccessPassword(): bool
	{
		if (($givenAccessPassword = Craft::$app->getRequest()->get('access_password')) && ($accessPassword = $this->getSettings()->accessPassword)) {
			return  ($accessPassword && $givenAccessPassword && $accessPassword == $givenAccessPassword);
		}
		
		return false;
    }

	protected function getSettings()
    {
		return EnvironmentProtection::$plugin->getSettings();
    }

	protected function getIpWhitelist(): array
	{
		return $this->getSettings()->ipWhitelist;
    }

	protected function getMyIp(): string
	{
		if (isset($_SERVER['HTTP_CLIENT_IP'])) {
			return $_SERVER['HTTP_CLIENT_IP'];
		} elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			return $_SERVER['HTTP_X_FORWARDED_FOR'];
		} elseif (isset($_SERVER['HTTP_X_FORWARDED'])) {
			return $_SERVER['HTTP_X_FORWARDED'];
		} elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
			return $_SERVER['HTTP_FORWARDED_FOR'];
		} elseif (isset($_SERVER['HTTP_FORWARDED'])) {
			return $_SERVER['HTTP_FORWARDED'];
		} elseif (isset($_SERVER['REMOTE_ADDR'])) {
			return $_SERVER['REMOTE_ADDR'];
		} else {
			return false;
		}
	}
}
