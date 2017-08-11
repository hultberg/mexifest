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

    public function getJavascripts(): array
    {
        return $this->assets[Parser::ASSET_JS] ?? [];
    }

    public function getStylesheets(): array
    {
        return $this->assets[Parser::ASSET_CSS] ?? [];
    }
}
