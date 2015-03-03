<?php
/**
 * Repository class for posts
 *
 * @author Shitiz Garg
 * @copyright 2015 Shitiz Garg <mail@dragooon.net>
 * @license The MIT License
 */

namespace Dragooon\BlogBundle\Entity;

use Doctrine\ORM\EntityRepository;

class PostRepository extends EntityRepository
{
    /**
     * Returns the query builder for latest posts with authors
     *
     * @access public
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function createLatestQueryBuilder()
    {
        $query = $this->getEntityManager()->createQueryBuilder();
        $query
            ->select('Post')
            ->from('Dragooon\BlogBundle\Entity\Post', 'Post')
            ->innerJoin('Dragooon\BlogBundle\Entity\Author', 'Author')
            ->where('1=1')
            ->orderBy('Post.time', 'DESC');

        return $query;
    }

    /**
     * Returns latest (ordered by time) $limit posts
     *
     * @access public
     * @param int $limit
     * @return array
     */
    public function findLatest($limit)
    {
        $query = $this->createLatestQueryBuilder();
        $query->setFirstResult(0);
        $query->setMaxResults($limit);

        return $query->getQuery()->getResult();
    }

    /**
     * Creates a new post for the author
     *
     * @access public
     * @param Author $author
     * @param Category $category
     * @param string $title
     * @param string $content
     */
    public function create(Author $author, Category $category, $title, $content)
    {
        $post = new Post;
        $post->setAuthor($author->getId());
        $post->setCategory($category->getId());
        $post->setTitle($title);
        $post->setContent($content);

        $em = $this->getEntityManager();
        $em->persist($post);
        $em->flush();
    }
}