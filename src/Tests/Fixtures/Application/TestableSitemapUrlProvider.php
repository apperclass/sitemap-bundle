<?php
/**
 * @package Apperclass\Bundle\SitemapBundle\Tests\Fixtures\Application
 * @author Ruben Barilani <ruben.barilani.dev@gmail.com>
 * @date 22/12/14
 * @time 15:35
 * @license http://opensource.org/licenses/MIT MIT license 
 */

namespace Apperclass\Bundle\SitemapBundle\Tests\Fixtures\Application;


use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapInterface;
use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapUrl;
use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapUrlProviderInterface;

class TestableSitemapUrlProvider implements SitemapUrlProviderInterface{

    /**
     * @param mixed $object
     *
     * @return bool
     */
    public function supportsObject($object)
    {
        return true;
    }

    /**
     * @param mixed $object
     *
     * @return SitemapUrl
     */
    public function getSitemapUrl($object)
    {
        return new SitemapUrl();
    }

    /**
     * @param SitemapInterface $sitemap
     * @return void
     */
    public function populate(SitemapInterface $sitemap)
    {
        $post = new SitemapUrl();
        $post->setLoc('/posts/1');
        $post->setLastmod((new \DateTime())->format('Y-m-d'));
        $post->setPriority('0.5');

        $comment = new SitemapUrl();
        $comment->setLoc('/posts/1/comments/2');
        $comment->setLastmod((new \DateTime())->format('Y-m-d'));
        $comment->setPriority('0.5');

        $sitemap->add($post);
        $sitemap->add($comment);
    }
}

