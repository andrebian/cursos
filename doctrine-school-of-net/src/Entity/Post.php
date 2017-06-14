<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Post
 * @package App\Entity
 *
 * @Entity
 * @Table(name="posts")
 */
class Post
{
    /**
     * @var int
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Column(type="string", length=100)
     */
    private $title;

    /**
     * @var string
     * @Column(type="text")
     */
    private $content;

    /**
     * @var ArrayCollection
     * @ManyToMany(targetEntity="App\Entity\Category")
     */
    private $categories;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Category
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param ArrayCollection $categories
     * @return Post
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
        return $this;
    }
}
