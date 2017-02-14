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

namespace DobroSite\Site\Tests\WebServer\Apache;

use DobroSite\Site\DataType\DomainName;
use DobroSite\Site\WebServer\Apache\Config;
use DobroSite\Site\WebServer\Apache\VirtualHost;
use PHPUnit\Framework\TestCase;

/**
 * Тесты класса DobroSite\Site\WebServer\Apache\VirtualHost.
 *
 * @covers \DobroSite\Site\WebServer\Apache\VirtualHost
 * @covers \DobroSite\Site\DataType\DomainName
 */
class VirtualHostTest extends TestCase
{
    public function testGetDomainName()
    {
        /** @var Config $config */
        $config = $this->createMock(Config::class);
        $vhost = new VirtualHost(
            $config,
            __DIR__ . '/fixtures/apache2/sites-available/example.com.conf'
        );
        $domain = $vhost->getDomainName();
        static::assertInstanceOf(DomainName::class, $domain);
        static::assertEquals('example.com', $domain);
    }
}
