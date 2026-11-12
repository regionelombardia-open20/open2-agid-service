<?php
/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\agid-service
 * @author    Aria S.p.A. <protocollo@pec.ariaspa.it>
 * @license   GNU General Public License v3.0 <https://www.gnu.org/licenses/gpl-3.0.html>
 * @link      https://www.ariaspa.it/
 *
 * This file is part of OPEN 2.0.
 *
 * OPEN 2.0 is free software: you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * OPEN 2.0 is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with OPEN 2.0. If not, see <https://www.gnu.org/licenses/>.
 */

namespace open20\agid\service;

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 *
 * @package    open20\agid\service
 * @category   CategoryName
 */
use open20\amos\core\interfaces\CmsModuleInterface;
use open20\amos\core\interfaces\SearchModuleInterface;
use open20\amos\core\module\AmosModule;
use open20\amos\core\module\ModuleInterface;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Class Module
 * @package open20\amos\organizzazioni
 */
class Module extends AmosModule implements ModuleInterface, SearchModuleInterface, CmsModuleInterface {

    public static $CONFIG_FOLDER = 'config';

    /**
     * @inheritdoc
     */
    public static function getModuleName() {
        return 'service';
    }

    public function getWidgetIcons() {
        return [];
    }

    public function getWidgetGraphics() {
        return [];
    }

    /**
     * Get default model classes
     */
    protected function getDefaultModels() {
        return [
            'AgidService' => __NAMESPACE__ . '\\' . 'models\AgidService',
            'AgidServiceSearch' => __NAMESPACE__ . '\\' . 'models\search\AgidServiceSearch',
        ];
    }

    /**
     *
     * @return string
     */
    public function getFrontEndMenu($dept = 1) {
        $menu = parent::getFrontEndMenu();
        $app = Yii::$app;
        if (!$app->user->isGuest && (\Yii::$app->user->can('AGIDSERVICE_READ')||\Yii::$app->user->can('REDACTOR_SERVICE'))) {
            $menu .= $this->addFrontEndMenu(Module::t('amosservice', '#menu_front_service'), Module::toUrlModule('/agid-service/index'), $dept);
        }
        return $menu;
    }

    // /**
    //  * @inheritdoc
    //  */
    public function init() {
        parent::init();

        //Configuration: merge default module configurations loaded from config.php with module configurations set by the application
        $config = require(__DIR__ . DIRECTORY_SEPARATOR . self::$CONFIG_FOLDER . DIRECTORY_SEPARATOR . 'config.php');
        Yii::configure($this, ArrayHelper::merge($config, $this));
    }

    public static function getModelClassName() {
        return Module::instance()->model('AgidService');
    }

    public static function getModelSearchClassName() {
        return Module::instance()->model('AgidServiceSearch');
    }

    public static function getModuleIconName() {
        return null;
    }

}
