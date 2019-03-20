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
 * @property \Doctrine\ORM\EntityManagerInterface $inst Instance of {@see \Doctrine\ORM\EntityManagerInterface}
 */
class BaseEntityManager extends \amylian\yii\doctrine\base\BaseDoctrineComponent implements \Doctrine\ORM\EntityManagerInterface
{
    use \amylian\yii\base\common\InstanceWrapperTrait;
    
    /**
     * @var string|\amylian\yii\doctrine\common\EventManager
     */
    public $eventManager = \amylian\yii\doctrine\common\BaseEventManagerInterface::class;

    /**
     *
     * @var string|BaseConfiguration
     */
    public $configuration = \amylian\yii\doctrine\common\BaseConfigurationInterface::class;
    
    /**
     * Returns the wrapped Doctrine EntityManager Instance
     * 
     * @return \Doctrine\ORM\EntityManagerInterface|null
     */
    public function getInst(): ?\Doctrine\ORM\EntityManagerInterface
    {
        return parent::getInst();
    }
    
    /**
     * {@inheritDoc}
     * @return void
     */
    
    public function beginTransaction(): void
    {
        $this->getInst()->beginTransaction();
    }

    /**
     * {@inheritDoc}
     * @return void
     */
    public function clear($objectName = null): void
    {
        $this->getInst()->clear($objectName = null);
    }

    /**
     * {@inheritDoc}
     * @return void
     */
    public function close(): void
    {
        $this->getInst()->close();
    }

    /**
     * {@inheritDoc}
     * @return void
     */
    public function commit(): void
    {
        $this->getInst()->close();
    }

    /**
     * {@inheritDoc}
     * @param type $object
     * @return bool
     */
    public function contains($object): bool
    {
        return $this->getInst()->contains($object);
    }

    /**
     * {@inheritDoc}
     * @param type $entity
     * @param type $deep
     * @return object
     */
    public function copy($entity, $deep = false): object
    {
        return $this->getInst()->copy($entity, $deep);
    }

    /**
     * {@inheritDoc}
     * @param type $name
     * @return \Doctrine\ORM\NativeQuery
     */
    public function createNamedNativeQuery($name): \Doctrine\ORM\NativeQuery
    {
        return $this->getInst()->createNamedNativeQuery($name);
    }

    /**
     * {@inheritDoc}
     * @param type $name
     * @return \Doctrine\ORM\Query
     */
    public function createNamedQuery($name): \Doctrine\ORM\Query
    {
        return $this->createNamedQuery()->createNamedNativeQuery($name);
    }

    /**
     * {@inheritDoc}
     * @param type $sql
     * @param \Doctrine\ORM\Query\ResultSetMapping $rsm
     * @return \Doctrine\ORM\NativeQuery
     */
    public function createNativeQuery($sql, \Doctrine\ORM\Query\ResultSetMapping $rsm): \Doctrine\ORM\NativeQuery
    {
        return $this->getInst()->createNativeQuery($sql, $rsm);
    }

    /**
     * {@inheritDoc}
     * @param type $dql
     * @return \Doctrine\ORM\Query
     */
    public function createQuery($dql = ''): \Doctrine\ORM\Query
    {
        return $this->getInst()->createQuery($dql);
    }

    /**
     * {@inheritDoc}
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function createQueryBuilder(): \Doctrine\ORM\QueryBuilder
    {
        return $this->getInst()->createQueryBuilder();
    }

    /**
     * {@inheritDoc}
     * @param type $object
     * @return void
     */
    public function detach($object): void
    {
        $this->getInst()->detach($object);
    }

    /**
     * {@inheritDoc}
     * @param type $className
     * @param type $id
     */
    public function find($className, $id)
    {
        return $this->getInst()->find($className, $id);
    }

    /**
     * {@inheritDoc}
     * @return void
     */
    public function flush(): void
    {
        $this->getInst()->flush();
    }

    /**
     * {@inheritDoc}
     * @return type
     */
    public function getCache()
    {
        return $this->getInst()->getCache();
    }

    /**
     * {@inheritDoc}
     * @param type $className
     * @return \Doctrine\Common\Persistence\Mapping\ClassMetadata
     */
    public function getClassMetadata($className): \Doctrine\Common\Persistence\Mapping\ClassMetadata
    {
        return $this->getInst()->getClassMetadata($className);
    }

    /**
     * @return \Doctrine\ORM\Configuration
     */
    public function getConfiguration(): Configuration
    {
        return $this->configuration;
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function getEventManager(): \Doctrine\Common\EventManager
    {
        return $this->eventManager;
    }

    public function getExpressionBuilder(): \Doctrine\ORM\Query\Expr
    {
        return $this->getInst()->getExpressionBuilder();
    }

    /**
     * {@inheritDoc}
     * @return \Doctrine\ORM\Query\FilterCollection
     */
    public function getFilters(): \Doctrine\ORM\Query\FilterCollection
    {
        return $this->getInst()->getFilters();
    }

    /**
     * {@inheritDoc}
     * @param type $hydrationMode
     * @return \Doctrine\ORM\Internal\Hydration\AbstractHydrator
     */
    public function getHydrator($hydrationMode): \Doctrine\ORM\Internal\Hydration\AbstractHydrator
    {
        return $this->getInst()->getHydrator($hydrationMode);
    }

    /**
     * {@inheritDoc}
     * @return \Doctrine\Common\Persistence\Mapping\ClassMetadataFactory
     */
    public function getMetadataFactory(): \Doctrine\Common\Persistence\Mapping\ClassMetadataFactory
    {
        return $this->getInst()->getMetadataFactory();
    }

    /**
     * {@inheritDoc}
     * @param type $entityName
     * @param type $identifier
     */
    public function getPartialReference($entityName, $identifier)
    {
    }

    public function getProxyFactory(): \Doctrine\ORM\Proxy\ProxyFactory
    {
        
    }

    public function getReference($entityName, $id)
    {
        
    }

    public function getRepository($className): \Doctrine\Common\Persistence\ObjectRepository
    {
        
    }

    public function getUnitOfWork(): \Doctrine\ORM\UnitOfWork
    {
        
    }

    public function hasFilters(): boolean
    {
        
    }

    public function initializeObject($obj): void
    {
        
    }

    public function isFiltersStateClean(): boolean
    {
        
    }

    public function isOpen(): bool
    {
        
    }

    public function lock($entity, $lockMode, $lockVersion = null): void
    {
        
    }

    public function merge($object): object
    {
        
    }

    public function newHydrator($hydrationMode): \Doctrine\ORM\Internal\Hydration\AbstractHydrator
    {
        
    }

    public function persist($object): void
    {
        
    }

    public function refresh($object): void
    {
        
    }

    public function remove($object): void
    {
        
    }

    public function rollback(): void
    {
        
    }

    public function transactional($func)
    {
        
    }

    /**
     * 
     */
    public function getWrappedInst()
    {
    }

}
