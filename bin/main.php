#!/usr/bin/env php
<?php
/**
 * site — автоматизация управления сайтами.
 *
 * @copyright 2017, Михаил Красильников <m.krasilnikov@yandex.ru>
 * @author    Михаил Красильников <m.krasilnikov@yandex.ru>
 *
 * @license   http://opensource.org/licenses/MIT MIT
 */
declare(strict_types=1);

require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/src/config.php';

(new \DobroSite\Site\Application())->run();
