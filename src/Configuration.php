<?php

/*
 * Copyright 2018 Andreas Prucha, Abexto - Helicon Software Development.
 */

namespace amylian\yii\doctrine\orm;

/**
 * Description of Configuration
 *
 * @author Andreas Prucha, Abexto - Helicon Software Development
 */
class Configuration extends \Doctrine\ORM\Configuration implements
\amylian\yii\doctrine\base\common\ConfigurableDoctrineInterface
{

    use \amylian\yii\doctrine\base\common\ConfigurableDoctrineTrait;
    use \amylian\yii\doctrine\dbal\ConfigurationTrait {
        \amylian\yii\doctrine\dbal\ConfigurationTrait::getDefaultConfigurationArray as getDefaultDbalConfigurationArray;
    }

    public function __construct(array $configArray = [])
    {
        $this->assignConfigurationAttributesFromArray($this->mergeDefaultConfigurationArray($configArray));
    }

    public function getDefaultConfigurationArray(): array
    {
        return \yii\helpers\ArrayHelper::merge($this->getDefaultDbalConfigurationArray(),
                        [
                            'proxyDir' => '@runtime/amylian/doctrine/proxies',
                            'proxyNamespace' => '\\runtime\\amylian\\doctrine\\proxy',
                            'metadataCacheImpl' => \yii\di\Instance::of(Consts::DEFAULT_CACHE),
                            'queryCacheImpl' => \yii\di\Instance::of(Consts::DEFAULT_CACHE)
        ]);
    }

    /**
     * {@inheritDoc}
     * NOTE: Yii Aliases can be used.
     * @param string $dir
     */
    public function setProxyDir($dir)
    {
        parent::setProxyDir(\Yii::getAlias($dir));
    }

}
