#!/usr/bin/env php
<?php
/**
 * site — автоматизация управления сайтами.
 *
 * Создаёт дамп контейнера зависимостей.
 *
 * @copyright 2017, Михаил Красильников <m.krasilnikov@yandex.ru>
 * @author    Михаил Красильников <m.krasilnikov@yandex.ru>
 *
 * @license   http://opensource.org/licenses/MIT MIT
 */
declare(strict_types=1);

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/src/config.php';

$container = new ContainerBuilder();
$loader = new XmlFileLoader($container, new FileLocator(dirname(__DIR__) . '/resources'));
$loader->load('services.xml');
$container->compile();

$dumper = new PhpDumper($container);
file_put_contents(DIC_DUMP_FILE, $dumper->dump());
