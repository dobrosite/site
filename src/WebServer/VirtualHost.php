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

use DobroSite\Site\DataType\DomainName;

/**
 * Виртуальный хост веб-сервера.
 *
 * @since 0.1
 */
interface VirtualHost
{
    /**
     * Возвращает главное доменное имя.
     *
     * @return DomainName
     *
     * @since 0.1
     */
    public function getDomainName(): DomainName;
}
