# Apperclass Sitemap Bundle

[![Build Status](https://travis-ci.org/apperclass/sitemap-bundle.svg)](https://travis-ci.org/apperclass/sitemap-bundle)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/apperclass/sitemap-bundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/apperclass/sitemap-bundle/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/apperclass/sitemap-bundle/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/apperclass/sitemap-bundle/?branch=master)


Apperclass Sitemap Bundle help you to create a sitemap for your site. It's easy to extend and customize.


##  Create your own sitemap url provider

Create a tagged service to populate the sitemap

```xml
    <service id="my_project.my_custom_sitemap_url_provider" class="MyProject\Sitemap\MySitemapUrlProvider">
        <tag name="apperclass_sitemap.sitemap_url_provider" />
    </service>
```

Implements SitemapUrlProviderInterface as you need.

```php
<?php

namespace MyProject\Sitemap;

use Apperclass\Bundle\SitemapBundle\Sitemap\Model\SitemapInterface;
use Apperclass\Bundle\SitemapBundle\Sitemap\Model\SitemapUrl;
use Apperclass\Bundle\SitemapBundle\Sitemap\Provider\SitemapUrlProviderInterface;

class MySitemapUrlProvider implements SitemapUrlProviderInterface
{

    /**
     * @param SitemapInterface $sitemap
     * @return void
     */
    public function populate(SitemapInterface $sitemap)
    {
        $sitemapUrl = new SitemapUrl();
        $url = 'http://www.mysite.com';
        $sitemapUrl->setLoc($url);

        $sitemap->add($url);
    }
}
```

This example of SitemapUrlProvider is trivial but it's a service so you can inject all you need to
populate the sitemap.


## Run the command

Run the command to write a file in a available format. Use --dump to see the output.

```shell
php app/console apperclass:sitemap:generate [--path[="..."]] [--format[="..."]] [--dump]
```

* You can specify in which format you want the sitemap by using ```--format``` option. (default: xml)
* You can specify the path to the output as an absolute path by using ```--path``` option. (default: apperclass_sitemap.path)

## Configuration reference

```yaml

apperclass_sitemap:
    path: %kernel.root_dir%/../web/sitemap.xml

```

### Add a custom encoder (available format)

You can add a custom encoder/format by implementing a SitemapEncoderInterface:

```php
<?php

namespace MyProject\Sitemap;

use Apperclass\Bundle\SitemapBundle\Sitemap\Encoder\SitemapEncoderInterface;

class MyFormatEncoder implements SitemapEncoderInterface
{
    /**
     * @param SitemapInterface $sitemap
     * @return string $string
     */
    public function encode(SitemapInterface $sitemap)
    {
        // ... encoding logic;
        return $string;
    }

    public function getFormat()
    {
        return 'my-format';
    }
}
```

register this class as a tagged service:

```xml
<service id="my_project.sitemap_my_format_encoder" class="MyProject\Sitemap\MyFormatEncoder">
    <tag name="apperclass_sitemap.sitemap_encoder" />
</service>
```

and you are done. Now you can use the new format with the generate command.

```shell
php app/console apperclass:sitemap:generate --format="my-format" --path="/my-project/sitemap.my-format"
```



