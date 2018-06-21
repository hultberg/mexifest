<?php

namespace Hultberg\Mexifest;

/**
 * Simple holder for assets.
 */
class AssetManager
{
    /**
     * @var array
     */
    protected $assets;

    /**
     * @param array $assets Parsed assets.
     */
    public function __construct(array $assets = [])
    {
        $this->setAssets($assets);
    }

    /**
     * Set the asset for this manager.
     *
     * @param array $assets
     */
    public function setAssets(array $assets)
    {
        $this->assets = $assets;
    }

    public function findAll(): array
    {
        $assets = [];

        foreach ($this->assets as $fileName => list($filePath)) {
            $assets[$fileName] = $filePath;
        }

        return $assets;
    }

    public function findByExtension(string $ext): array
    {
        $foundAssets = [];

        foreach ($this->assets as list($fileName, $filePath, $fileExt)) {
            if ($fileExt === $ext) {
                $foundAssets[] = [$fileName, $filePath];
            }
        }

        return $foundAssets;
    }

    public function findByName(string $name): array
    {
        $foundAssets = [];

        foreach ($this->assets as list($fileName, $filePath)) {
            if ($fileName === $name) {
                $foundAssets[] = [$fileName, $filePath];
            }
        }

        return $foundAssets;
    }
}
