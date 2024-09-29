<?php

/** @noinspection PhpPluralMixedCanBeReplacedWithArrayInspection */

declare(strict_types=1);

namespace ModernBx\Tests\Url;

use ModernBx\Url\Url;

use PHPUnit\Framework\TestCase;

class UrlTest extends TestCase
{
    /**
     * @return array<mixed>
     */
    public function caseProviderValidValue(): array
    {
        return [
            [
                "https://domain.tld:8080/path/to/page",
                [
                    "getScheme" => "https",
                    "getHost" => "domain.tld",
                    "getPath" => "/path/to/page",
                    "getPort" => 8080,
                    "getPathSegments" => ["path", "to", "page"],
                    "toString" => "https://domain.tld:8080/path/to/page",
                    "__toString" => "https://domain.tld:8080/path/to/page",
                ]
            ],
        ];
    }

    /**
     * @dataProvider caseProviderValidValue
     * @param string $input
     * @param array<string, string|int> $parts
     */
    public function testValidOptions(string $input, array $parts): void
    {
        $url = Url::create($input);

        foreach ($parts as $method => $part) {
            $this->assertSame($url->{$method}(), $part);
        }
    }
}
