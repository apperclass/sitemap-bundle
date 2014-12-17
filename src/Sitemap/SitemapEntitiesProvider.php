<?php

namespace Apperclass\Bundle\SitemapBundle\Sitemap;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;

/**
 * Class SitemapEntitiesProvider
 * It loads all entities to generate the sitemap
 *
 * @package Apperclass\Bundle\SitemapBundle\Sitemap
 */
class SitemapEntitiesProvider implements SitemapEntitiesProviderInterface
{
    /** @var \Doctrine\ORM\EntityManager  */
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return array
     */
    public function getEntities()
    {
        $entities = array();
        $classNames = array();

        $allMetadata = $this->entityManager->getMetadataFactory()->getAllMetadata();
        /** @var ClassMetadata $metadata */
        foreach ($allMetadata as $metadata) {
            $classNames[] = $metadata->getReflectionClass()->getName();
        }

        foreach ($classNames as $className) {
            try{
                $repository = $this->entityManager->getRepository($className);
                $results = $repository->findAll();
                $entities = array_merge($entities, $results);
            } catch (\Exception $e) {

            }
        }

        return $entities;
    }
}