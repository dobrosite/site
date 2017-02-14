<?php
/**
 * site — автоматизация управления сайтами.
 *
 * @copyright 2017, Михаил Красильников <m.krasilnikov@yandex.ru>
 * @author    Михаил Красильников <m.krasilnikov@yandex.ru>
 *
 * @license   http://opensource.org/licenses/MIT MIT
 */
//TODO declare(strict_types=1);

namespace DobroSite\Site\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Основной класс команд.
 */
abstract class AbstractCommand extends Command
{
    /**
     * Успешное завершение программы.
     */
    const EXIT_SUCCESS = 0;

    /**
     * Завершение с ошибкой.
     */
    const EXIT_FAILURE = 127;

    /**
     * Контейнер зависимостей.
     *
     * @var ContainerInterface
     */
    protected $container;

    /**
     * Создаёт команду.
     *
     * @param ContainerInterface $container
     *
     * @throws \Symfony\Component\Console\Exception\LogicException
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        parent::__construct();
    }

    /**
     * Sets the description for the command.
     *
     * @param string $description The description for the command
     *
     * @return $this
     *
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException
     */
    public function setDescription($description)
    {
        $description = $this->get('translator')->trans($description);

        parent::setDescription($description);

        return $this;
    }

    /**
     * Adds an argument.
     *
     * @param string $name        The argument name
     * @param int    $mode        The argument mode: InputArgument::REQUIRED or
     *                            InputArgument::OPTIONAL
     * @param string $description A description text
     * @param mixed  $default     The default value (for InputArgument::OPTIONAL mode only)
     *
     * @return $this
     *
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException
     */
    public function addArgument($name, $mode = null, $description = '', $default = null)
    {
        $description = $this->get('translator')->trans($description);

        parent::addArgument(
            $name,
            $mode,
            $description,
            $default
        );

        return $this;
    }

    /**
     * Настраивает команду.
     *
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException
     */
    protected function configure()
    {
        parent::configure();
        if (preg_match('/\\\\(\w+)Command$/', get_class($this), $matches) > 0) {
            $parts = preg_split('/(?=[A-Z])/', $matches[1]);
            array_shift($parts);
            $this->setName(strtolower(implode(':', $parts)));
        }
    }

    /**
     * Возвращает службу из контейнера.
     *
     * @param string $serviceId
     *
     * @return object
     *
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException
     */
    protected function get($serviceId)
    {
        return $this->container->get($serviceId);
    }
}
