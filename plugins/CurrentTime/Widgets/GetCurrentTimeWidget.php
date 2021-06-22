<?php
/**
 * Matomo - free/libre analytics platform
 *
 * @link https://matomo.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\CurrentTime\Widgets;

use Piwik\Option;
use Piwik\Piwik;
use Piwik\Widget\Widget;
use Piwik\Widget\WidgetConfig;
use Piwik\View;
use \Piwik\Plugins\LanguagesManager\API as LanguagesManager;

/**
 * This class allows you to add your own widget to the Piwik platform. In case you want to remove widgets from another
 * plugin please have a look at the "configureWidgetsList()" method.
 * To configure a widget simply call the corresponding methods as described in the API-Reference:
 * http://developer.piwik.org/api-reference/Piwik/Plugin\Widget
 */
class GetCurrentTimeWidget extends Widget
{
    public static function configure(WidgetConfig $config)
    {
        /**
         * Set the category the widget belongs to. You can reuse any existing widget category or define
         * your own category.
         */
        $config->setCategoryId('Visitors');

        /**
         * Set the name of the widget belongs to.
         */
        $config->setName('Current time');

        /**
         * Set the order of the widget. The lower the number, the earlier the widget will be listed within a category.
         */
        $config->setOrder(99);
    }

    /**
     * This method renders the widget. It's on you how to generate the content of the widget.
     * As long as you return a string everything is fine. You can use for instance a "Piwik\View" to render a
     * twig template. In such a case don't forget to create a twig template (eg. myViewTemplate.twig) in the
     * "templates" directory of your plugin.
     *
     * @return string
     */
    public function render()
    {
        $current = Piwik::getCurrentUserLogin();

        return $this->renderTemplate('index', array(
            'timezone' => Option::get('SitesManager_DefaultTimezone'),
            'language' => LanguagesManager::getInstance()->getLanguageForUser($current),
            'use_12_hour' => LanguagesManager::getInstance()->uses12HourClockForUser($current),
        ));
    }
}
