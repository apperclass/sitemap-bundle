# Apperclass Sitemap Bundle

[![Build Status](https://travis-ci.org/apperclass/sitemap-bundle.svg)](https://travis-ci.org/apperclass/sitemap-bundle)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/apperclass/sitemap-bundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/apperclass/sitemap-bundle/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/apperclass/sitemap-bundle/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/apperclass/sitemap-bundle/?branch=master)


Apperclass Sitemap Bundle create a beautiful sitemap parsing your entities. It's easy to extend and customize. 

```shell
php app/console apperclass:generate:sitemap
```

## Load the entities you need with a custom entity provider

```xml
    <parameters>
        <parameter key="apperclass_sitemap.sitemap_entities_provider.class">MyProject\Sitemap\SitemapEntitiesProvider</parameter>
    </parameters>
```

For example you can load all your entities from an EntityRepository.

```php
<?php

namespace Truelab\Humanitas\CoreBundle\Sitemap\Sitemap;
use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapEntitiesProviderInterface;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManager;
use Truelab\Humanitas\CoreBundle\Entity\Disease;

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
        $repository = $this->entityManager->getRepository('MyProject\Entity\MyEntity');
        $results = $repository->findAll();

        return $entities;
    }
}
```


##  Create your own sitemap url provider

Create a tagged service to transform your object in a SitemapUrl 

```xml
    <service id="my_project.my_custom_sitemap_url_provider" class="MyProject\Sitemap\MyEntitySitemapUrlProvider">
        <argument type="service" id="router" />
        <tag name="apperclass_sitemap.sitemap_url_provider" />
    </service>
```

Implements SitemapUrlProviderInterface as you need

```php
<?php

namespace MyProject\Sitemap;

use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapEntitiesProviderInterface;
use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapUrl;
use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapUrlProviderInterface;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class MyEntitySitemapUrlProvider implements SitemapUrlProviderInterface
{

    protected $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * @param mixed $object
     *
     * @return bool
     */
    public function supportsObject($object)
    {
        if ($object instanceof MyEntity) {
            return true;
        }

        return false;
    }

    /**
     * @param mixed $object
     *
     * @return SitemapUrl
     */
    public function getSitemapUrl($object)
    {
        $sitemapUrl = new SitemapUrl();
        $url = $this->router->generate('my_route', array('slug' => $object->getSlug()));
        $sitemapUrl->setLoc($url);

        return $sitemapUrl;
    }
}
```


## Run the command

Run the command to save an xml in your webroot. Use --dump to see the output. 

```shell
php app/console apperclass:sitemap:generate
```

## Configuration reference

```yaml

apperclass_sitemap:
    path: %kernel.root_dir%/../web/sitemap.xml

```



