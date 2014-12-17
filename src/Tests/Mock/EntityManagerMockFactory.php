<?php

namespace Apperclass\Bundle\SitemapBundle\Tests\Mock;

class EntityManagerMockFactory extends AbstractMockFactory
{

    public function getMock()
    {
        $entityManagerMockBuilder = $this->test->getMockBuilder('Doctrine\ORM\EntityManager');

        $entityManagerMock = $entityManagerMockBuilder
            ->disableOriginalConstructor()
            ->getMock();

        $classMetadataMock = $this->test
            ->getMockBuilder('\Doctrine\ORM\Mapping\ClassMetadataFactory')
            ->disableOriginalConstructor()
            ->getMock();

        $entityRepositoryMock = $this->test
            ->getMockBuilder('\Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->getMock();

        $reflectionClassMock = $this->test
            ->getMockBuilder('\ReflectionClass')
            ->disableOriginalConstructor()
            ->getMock();

        $metadataMock = $this->test
            ->getMockBuilder('\Doctrine\ORM\Mapping\ClassMetadata')
            ->disableOriginalConstructor()
            ->getMock()
            ;

        $entityRepositoryMock->method('findAll')->willReturn(array('obj1','obj2','obj3'));
        $classMetadataMock->method('getAllMetadata')->willReturn(array($metadataMock));
        $entityManagerMock->method('getMetadataFactory')->willReturn($classMetadataMock);
        $entityManagerMock->method('getRepository')->willReturn($entityRepositoryMock);
        $metadataMock->method('getReflectionClass')->willReturn($reflectionClassMock);
        $reflectionClassMock->method('getName')->willReturn('MyClassName');

        return $entityManagerMock;
    }
}