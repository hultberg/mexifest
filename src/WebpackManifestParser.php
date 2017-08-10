<?php

namespace Hultberg\Mexifest;

use League\Flysystem\FileNotFoundException;
use League\Flysystem\Filesystem;

/**
 * Parses a webpack manifest.json generated file.
 *
 * Expects json format like:
 * {
 *    "app.js": "../js/app.aisdf8asdi8fadf.js"
 * }
 *
 * and parses it into php format:
 * [
 *    "app.js" => "../js/app.aisdf8asdi8fadf.js",
 * ]
 *
 * It also checks the filename extension to only fetch assets like js and css.
 */
class WebpackManifestParser implements Parser
{
    protected $fs;
    protected $file;

    public function __construct(Filesystem $fs, string $file)
    {
        $this->fs = $fs;
        $this->file = $file;
    }

    /**
     * @inheritDoc
     */
    public function parse(): array
    {
        try {
            $content = $this->fs->read($this->file);
        } catch (FileNotFoundException $e) {
            throw new ManifestFileNotFoundException($this->file . ' was not found with the provided filesystem.');
        }

        $manifest = json_decode($content, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new ManifestInvalidException('Failed to parse ' . $this->file . ', error found. ' . json_last_error_msg());
        }

        $assets = [];

        foreach ($manifest as $fileName => $filePath) {
            $ext = pathinfo($filePath, PATHINFO_EXTENSION);

            switch ($ext) {
                case Parser::ASSET_JS:
                case Parser::ASSET_CSS:
                    $assets[$ext][$fileName] = $filePath;
                    break;
            }
        }

        return $assets;
    }
}
