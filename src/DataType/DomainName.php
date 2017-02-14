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

namespace DobroSite\Site\DataType;

/**
 * Доменное имя.
 *
 * @since 0.1
 */
class DomainName
{
    /**
     * Домены.
     *
     * @var string[]
     */
    private $domains;

    /**
     * Создаёт доменное имя.
     *
     * @param string $name
     *
     * @since 0.1
     */
    public function __construct(string $name)
    {
        $this->domains = explode('.', $name);
    }

    /**
     * Возвращает имя в виде строки.
     *
     * @return string
     *
     * @since 0.1
     */
    public function __toString()
    {
        return implode('.', $this->domains);
    }

    /**
     * Возвращает уровень доменного имени.
     *
     * @return int
     *
     * @since 0.1
     */
    public function getLevel(): int
    {
        return count($this->domains);
    }
}
