<?php

namespace Hultberg\Mexifest\Tests;

use Hultberg\Mexifest\Parser;
use Hultberg\Mexifest\WebpackManifestParser;
use Hultberg\Mexifest\ManifestInvalidException;
use Hultberg\Mexifest\ManifestFileNotFoundException;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local;
use PHPUnit\Framework\TestCase;

class WebpackParserTest extends TestCase
{
    public function testParsing()
    {
        $parser = new WebpackManifestParser(new Filesystem(new Local(__DIR__)), '/manifest.json');
        $assets = $parser->parse();

        // Example manifest contains one font, but
        // only the javascript and stylesheet file is expected to be included atm.
        $this->assertCount(2, $assets);

        // Check for the correct filename.
        $this->assertSame('app.js', $assets[0][0]);
        $this->assertSame('app.css', $assets[1][0]);
    }

    public function testBadManifest()
    {
        $this->expectException(ManifestInvalidException::class);

        $parser = new WebpackManifestParser(new Filesystem(new Local(__DIR__)), '/bad_manifest.json');
        $parser->parse();
    }

    public function testManifestNotFound()
    {
        $this->expectException(ManifestFileNotFoundException::class);

        $parser = new WebpackManifestParser(new Filesystem(new Local(__DIR__)), '/WHAT_manifest.json');
        $parser->parse();
    }
}
