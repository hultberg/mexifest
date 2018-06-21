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

        $this->assertCount(1, $am->findByExtension('js'));
        $this->assertCount(1, $am->findByExtension('css'));
        $this->assertCount(2, $am->findAll());
        $this->assertCount(1, $am->findByName('app.js'));
    }
}
