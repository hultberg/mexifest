<?php

namespace Hultberg\Mexifest;

interface Parser
{
    const ASSET_JS = 'js';
    const ASSET_CSS = 'css';

    /**
     * Run the parser.
     *
     * @return array
     */
    public function parse(): array;
}
