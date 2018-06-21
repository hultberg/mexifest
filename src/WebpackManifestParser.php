<?php

namespace Hultberg\Mexifest;

use League\Flysystem\FilesystemInterface;
use League\Flysystem\FileNotFoundException;

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
    /**
     * @var array
     */
    protected $supportedExts = [
        'png', 'jpeg', 'jpg', 'gif', 'svg', 'js', 'css'
    ];

    protected $fs;
    protected $file;

    public function __construct(FilesystemInterface $fs, string $file)
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

            if ($this->supportsExt($ext)) {
                $assets[] = [basename($fileName), $filePath, $ext];
            }
        }

        ksort($assets);

        return $assets;
    }

    private function supportsExt(string $ext): bool
    {
        return in_array($ext, $this->supportedExts, true);
    }
}
