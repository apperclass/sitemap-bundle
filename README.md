# Apperclass Sitemap Bundle

[![Build Status](https://travis-ci.org/hal9087/sitemap-bundle.svg)](https://travis-ci.org/hal9087/sitemap-bundle)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/hal9087/sitemap-bundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/hal9087/sitemap-bundle/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/hal9087/sitemap-bundle/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/hal9087/sitemap-bundle/?branch=master)


Apperclass Sitemap Bundle create a beautiful sitemap parsing your entities. It's easy to extend and customize. 

```shell
php app/console apperclass:sitemap:generate
```


##  Create your own sitemap url provider

Create a tagged service to populate the sitemap as you want. Example:

```xml
    <service id="my_project.my_custom_sitemap_url_provider" class="MyProject\Sitemap\MyEntitySitemapUrlProvider">
        <argument type="service" id="router" />
        <argument type="service" id="my_project.repository.my_entity_repository" />
        <tag name="apperclass_sitemap.sitemap_url_provider" />
    </service>
```

Implements SitemapUrlProviderInterface as you need

```php
<?php

namespace MyProject\Sitemap;

use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapUrl;
use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapUrlProviderInterface;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use MyProject\Repository\MyEntityRepository;

class MyEntitySitemapUrlProvider implements SitemapUrlProviderInterface
{

    protected $router;

    protected $myEntityRepository;

    public function __construct(Router $router, MyEntityRepository $myEntityRepository)
    {
        $this->router = $router;
        $this->myEntityRepository = $myEntityRepository;
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

    /**
     * @param SitemapInterface
     */
    public function populate(SitemapInterface $sitemap)
    {
        $entities = $this->myEntityRepository->findAll();

        foreach($entities as $entity) {
            if($this->supportsObject($entity) {
                 $sitemap->add($this->getSitemapUrl($entity));
            }
        }
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



