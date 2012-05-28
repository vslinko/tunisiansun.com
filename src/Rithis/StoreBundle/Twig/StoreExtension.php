<?php

namespace Rithis\StoreBundle\Twig;

use Twig_Extension;
use Twig_Function_Method;

class StoreExtension extends Twig_Extension
{
    private $assetUrlPattern;

    public function __construct($assetUrlPattern)
    {
        $this->assetUrlPattern = $assetUrlPattern;
    }

    public function getFunctions()
    {
        return array(
            'rithis_store_asset_url' => new Twig_Function_Method($this, 'getAssetUrl'),
        );
    }

    public function getAssetUrl($key)
    {
        return sprintf($this->assetUrlPattern, $key);
    }

    public function getName()
    {
        return 'rithis_store';
    }
}
