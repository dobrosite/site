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

namespace DobroSite\Site\WebServer;

/**
 * Настройки веб-сервера.
 */
interface Config
{
    /**
     * Возвращает виртуальные хосты.
     *
     * @return VirtualHost[]
     */
    public function getVirtualHosts();
}
