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
 * Интерфейс к веб-серверу.
 */
interface WebServer
{
    /**
     * Возвращает настройки сервера.
     *
     * @return Config
     */
    public function getConfig(): Config;
}
