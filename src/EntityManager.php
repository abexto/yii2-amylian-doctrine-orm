<?php

/*
 * BSD 3-Clause License
 * 
 * Copyright (c) 2019, Abexto - Helicon Software Development / Amylian Project
 *  
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 * 
 * * Redistributions of source code must retain the above copyright notice, this
 *   list of conditions and the following disclaimer.
 * 
 * * Redistributions in binary form must reproduce the above copyright notice,
 *   this list of conditions and the following disclaimer in the documentation
 *   and/or other materials provided with the distribution.
 * 
 * * Neither the name of the copyright holder nor the names of its
 *   contributors may be used to endorse or promote products derived from
 *   this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
 * FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
 * DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
 * OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 * 
 */

namespace amylian\yii\doctrine\orm;

/**
 * Yii Doctrine ORM Entity Manager Component
 *
 * @author Andreas Prucha, Abexto - Helicon Software Development
 * 
 * @property \amylian\yii\doctrine\common\ConfigurableEventManagerInterface $eventManager}
 * @property \amylian\yii\doctrine\dbal\ConfigurableConnectionInterface $connection}
 * @property ConfigurableConfigurationInterface $configuration}
 */
class EntityManager extends \Doctrine\ORM\EntityManager implements ConfigurableEntityManagerInterface, 
        \amylian\yii\doctrine\base\common\ConfigurableDoctrineInterface
{
    use \amylian\yii\doctrine\base\common\ConfigurableDoctrineTrait;

    public function __construct(array $configArray = [])
    {
        $configArray = $this->mergeDefaultConfigurationArray($configArray);

        $configuration = \yii\di\Instance::ensure($configArray['configuration'], \Doctrine\ORM\Configuration::class);
        unset($configArray['configuration']);
        
        $eventManager = \yii\di\Instance::ensure($configArray['eventManager'], \Doctrine\Common\EventManager::class);
        unset($configArray['eventManager']);
        
        $connection = \yii\di\Instance::ensure($configArray['connection'], \amylian\yii\doctrine\dbal\Connection::class);
        unset($configArray['connection']);


        parent::__construct(
                $connection instanceof \amylian\yii\doctrine\dbal\ConfigurableConnectionInterface ?
                        $connection->getWrappedConnection() : $connection,
                $configuration,
                $eventManager);
        
       $this->assignConfigurationAttributesFromArray($configArray);
    }
    
    public function getDefaultConfigurationArray(): array
    {
        return [
                            'connection' => \yii\di\Instance::of(Consts::DEFAULT_CONNECTION),
                            'configuration' => \yii\di\Instance::of(Consts::DEFAULT_CONFIGURATION),
                            'eventManager' => \yii\di\Instance::of(Consts::DEFAULT_EVENT_MANAGER),
        ];
    }

}
