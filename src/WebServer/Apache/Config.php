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

namespace DobroSite\Site\WebServer\Apache;

use DobroSite\Site\WebServer\Config as ConfigInterface;

/**
 * Настройки Apache.
 *
 * @since 0.1
 */
class Config implements ConfigInterface
{
    /**
     * Сервер.
     *
     * @var WebServer
     */
    private $server;

    /**
     * Кэш виртуальных хостов.
     *
     * @var VirtualHost[]|null
     */
    private $virtualHosts = null;

    /**
     * Создаёт новое объектное представление конфигурации.
     *
     * @param WebServer $server
     *
     * @since 0.1
     */
    public function __construct(WebServer $server)
    {
        $this->server = $server;
    }

    /**
     * Возвращает виртуальные хосты.
     *
     * @return VirtualHost[]
     */
    public function getVirtualHosts(): array
    {
        if (null === $this->virtualHosts) {
            $this->virtualHosts = [];
            $path = $this->server->getRootDir() . $this->server->getSitesAvailable();
            $iterator = new \GlobIterator($path . DIRECTORY_SEPARATOR . '*.conf');
            foreach ($iterator as $file) {
                /** @var \SplFileInfo $file */
                $this->virtualHosts[] = new VirtualHost($this, $file->getPathname());
            }
        }

        return $this->virtualHosts;
    }
}
