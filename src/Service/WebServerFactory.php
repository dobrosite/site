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

namespace DobroSite\Site\Service;

use DobroSite\Site\WebServer\WebServer;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Фабрика служб для работы с веб-сервером.
 */
class WebServerFactory
{
    /**
     * Контейнер зависимостей.
     *
     * @var ContainerInterface
     */
    private $container;

    /**
     * Создаёт фабрику.
     *
     * @param ContainerInterface $container Контейнер зависимостей.
     *
     * @since 0.1
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Создаёт интерфейс к веб-серверу.
     *
     * @return WebServer
     *
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException
     *
     * @since 0.1
     */
    public function create(): WebServer
    {
        return $this->container->get('webserver.apache');
    }
}
