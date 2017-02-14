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

use DobroSite\Site\DataType\DomainName;
use DobroSite\Site\Exception\RuntimeException;
use DobroSite\Site\WebServer\VirtualHost as VirtualHostInterface;

/**
 * Виртуальный хост Apache.
 *
 * @since 0.1
 */
class VirtualHost implements VirtualHostInterface
{
    /**
     * Конфигурация Apache.
     *
     * @var Config
     */
    private $config;

    /**
     * Полный путь к файлу виртуального хоста.
     *
     * @var string
     */
    private $filename;

    /**
     * Кэш содержимого файла хоста.
     *
     * @var string|null
     */
    private $contents = null;

    /**
     * Создаёт виртуальный хост.
     *
     * @param Config $config   Конфигурация Apache.
     * @param string $filename Полный путь к файлу виртуального хоста.
     *
     * @since 0.1
     */
    public function __construct(Config $config, string $filename)
    {
        $this->config = $config;
        $this->filename = $filename;
    }

    /**
     * Возвращает главное доменное имя.
     *
     * @return DomainName
     *
     * @throws \DobroSite\Site\Exception\RuntimeException
     *
     * @since 0.1
     */
    public function getDomainName(): DomainName
    {
        // TODO Вынести в класс-парсер.
        if (!preg_match('/ServerName\s+(\S+)/i', $this->getContents(), $match)) {
            throw new RuntimeException(
                sprintf('ServerName directive not found in "%s"', $this->filename)
            );
        }
        $value = $match[1];
        if (preg_match('/^\$\{(\S+)\}$/', $value, $match)) {
            $var = $match[1];
            if (!preg_match('/Define\s+' . $var . '\s+(\S+)/i', $this->getContents(), $match)) {
                throw new RuntimeException(
                    sprintf('Variable "%s" not found in "%s"', $var, $this->filename)
                );
            }
            $value = $match[1];
        }

        return new DomainName($value);
    }

    /**
     * Возвращает содержимое файла виртуального хоста.
     *
     * @return string
     */
    private function getContents()
    {
        if (null === $this->contents) {
            $this->contents = file_get_contents($this->filename);
        }

        return $this->contents;
    }
}
