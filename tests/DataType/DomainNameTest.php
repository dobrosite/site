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

namespace DobroSite\Site\Tests\DataType;

use DobroSite\Site\DataType\DomainName;
use PHPUnit\Framework\TestCase;

/**
 * Тесты класса DobroSite\Site\DataType\DomainName.
 *
 * @covers \DobroSite\Site\DataType\DomainName
 */
class DomainNameTest extends TestCase
{
    /**
     * Проверяет главные возможности.
     */
    public function testBasics()
    {
        $name = new DomainName('foo.bar.baz');

        static::assertEquals('foo.bar.baz', $name);
        static::assertEquals(3, $name->getLevel());
    }
}
