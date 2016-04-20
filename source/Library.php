<?php
/**
 * 2007-2016 [PagSeguro Internet Ltda.]
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @author    PagSeguro Internet Ltda.
 * @copyright 2007-2016 PagSeguro Internet Ltda.
 * @license   http://www.apache.org/licenses/LICENSE-2.0
 *
 */

namespace PagSeguro;

use PagSeguro\Helpers\Validate;
use PagSeguro\Resources\Framework\ContentManagementSystems;
use PagSeguro\Resources\Framework\Language;
use PagSeguro\Resources\Framework\Module;

/**
 * Class Library
 * @package PagSeguro
 */
class Library
{

    /**
     *
     */
    const VERSION = "3.0.1";
    /**
     * @var
     */
    static private $module;

    /**
     * @throws \Exception
     */
    final public static function initialize()
    {
        //Basic configuration
        define('BP', __DIR__);
        define('CONFIG_PATH', BP. "/Configuration/");
        define('CONFIG', CONFIG_PATH."Properties/Conf.xml");
        define('RESOURCES', CONFIG_PATH."Properties/Resources.xml");
        //Validates for cUrl and SimpleXml.
        self::validate();
    }

    /**
     * @return bool
     * @throws \Exception
     */
    final public static function validate()
    {
        try {
            Validate::cUrl();
            Validate::simpleXml();
            return true;
        } catch (\Exception $exception) {
            throw new \Exception(
                "PagSeguro Library PHP component exception",
                ['PSLE'],
                $exception
            );
        }
    }

    /**
     * @return string
     */
    final public static function libraryVersion()
    {
        return self::VERSION;
    }

    /**
     * @return string
     */
    final public static function phpVersion()
    {
        return (new Language)->getRelease();
    }

    /**
     * @return Module
     */
    public static function moduleVersion()
    {
        if (is_null(self::$module)) {
            return self::$module = new Module();
        }
        return self::$module;
    }

    /**
     * @return ContentManagementSystems
     */
    public static function cmsVersion()
    {
        if (is_null(self::$module)) {
            return self::$module = new ContentManagementSystems();
        }
        return self::$module;
    }
}
