<?php

namespace Hultberg\Mexifest\Tests;

use Hultberg\Mexifest\Parser;
use Hultberg\Mexifest\AssetManager;
use Hultberg\Mexifest\WebpackManifestParser;
use Hultberg\Mexifest\ManifestInvalidException;
use Hultberg\Mexifest\ManifestFileNotFoundException;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local;
use PHPUnit\Framework\TestCase;

class AssetManagerTest extends TestCase
{
    public function testManager()
    {
        $parser = new WebpackManifestParser(new Filesystem(new Local(__DIR__)), 'manifest.json');
        $am = new AssetManager($parser->parse());

        $this->assertCount(1, $am->getJavascripts());
        $this->assertCount(1, $am->getStylesheets());
    }
}
