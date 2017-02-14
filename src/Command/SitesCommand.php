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

namespace DobroSite\Site\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Выводит список сайтов.
 */
class SitesCommand extends AbstractCommand
{
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
        $this
            ->setDescription('Lists sites');
    }

    /**
     * Выполняет команду.
     *
     * @param InputInterface  $input  Ввод.
     * @param OutputInterface $output Вывод.
     *
     * @return int
     *
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title($this->get('translator')->trans('Enabled sites'));

        $vhosts = $this->get('webserver')->getConfig()->getVirtualHosts();
        $domains = array();
        foreach ($vhosts as $vhost) {
            $domains[] = $vhost->getDomainName();
        }
        sort($domains);
        $io->listing($domains);

        return self::EXIT_SUCCESS;
    }
}
