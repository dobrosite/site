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

namespace DobroSite\Site;

use DobroSite\Site\Command\SitesCommand;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Приложение.
 */
class Application extends \Symfony\Component\Console\Application
{
    /**
     * Контейнер зависимостей.
     *
     * @var ContainerInterface
     */
    private $container;

    /**
     * Создаёт новый экземпляр приложения.
     *
     * @throws \LogicException
     * @throws \Symfony\Component\Console\Exception\LogicException
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException
     */
    public function __construct()
    {
        parent::__construct('Site management tool', '@package_version@');

        $this->loadContainer();
        $this->detectLocale();
        $this->add(new SitesCommand($this->container));
    }

    /**
     * Загружает контейнер зависимостей.
     *
     * @throws \LogicException
     */
    private function loadContainer()
    {
        if (!file_exists(DIC_DUMP_FILE)) {
            throw new \LogicException('Dependency Injection container not found');
        }

        /** @noinspection PhpIncludeInspection */
        require_once DIC_DUMP_FILE;
        /** @noinspection PhpUndefinedClassInspection */
        $this->container = new \ProjectServiceContainer();
    }

    /**
     * Определяет текущую локаль.
     *
     * И настраивает переводчик.
     *
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException
     */
    private function detectLocale()
    {
        $localeString = getenv('LANG') . ';' . setlocale(LC_ALL, 0);
        if (preg_match('/[a-z]{2}_[A-Z]{2}/', $localeString, $matches) > 0) {
            $this->container->get('translator')->setLocale($matches[0]);
        }
    }
}
