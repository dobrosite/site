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
use DobroSite\Site\WebServer\WebServer as WebServerInterface;

/**
 * Интерфейс к веб-серверу Apache.
 *
 * @since 0.1
 */
class WebServer implements WebServerInterface
{
    /**
     * Корневая папка Apache.
     *
     * @var string
     */
    private $rootDir;

    /**
     * Путь к доступным сайтам относительно $rootDir.
     *
     * @var string
     */
    private $sitesAvailable;

    /**
     * Путь к включённым сайтам относительно $rootDir.
     *
     * @var string
     */
    private $sitesEnabled;

    /**
     * Создаёт новый интерфейс к веб-серверу.
     *
     * @param string $rootDir        Корневая папка Apache.
     * @param string $sitesAvailable Путь к доступным сайтам относительно $rootDir.
     * @param string $sitesEnabled   Путь к включённым сайтам относительно $rootDir.
     *
     * @since 0.1
     */
    public function __construct(string $rootDir, string $sitesAvailable, string $sitesEnabled)
    {
        $this->rootDir = rtrim($rootDir, DIRECTORY_SEPARATOR);
        $this->sitesAvailable = DIRECTORY_SEPARATOR . trim($sitesAvailable, DIRECTORY_SEPARATOR);
        $this->sitesEnabled = DIRECTORY_SEPARATOR . trim($sitesEnabled, DIRECTORY_SEPARATOR);
    }

    /**
     * Возвращает настройки сервера.
     *
     * @return ConfigInterface
     *
     * @since 0.1
     */
    public function getConfig(): ConfigInterface
    {
        return new Config($this);
    }

    /**
     * Возвращает путь к корневой папка Apache.
     *
     * @return string
     *
     * @since 0.1
     */
    public function getRootDir(): string
    {
        return $this->rootDir;
    }

    /**
     * Возвращает путь к доступным сайтам относительно $rootDir.
     *
     * @return string
     *
     * @since 0.1
     */
    public function getSitesAvailable(): string
    {
        return $this->sitesAvailable;
    }

    /**
     * Возвращает путь к включённым сайтам относительно $rootDir.
     *
     * @return string
     *
     * @since 0.1
     */
    public function getSitesEnabled(): string
    {
        return $this->sitesEnabled;
    }
}
