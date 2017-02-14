<?php

namespace Tms\Bundle\LikeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * UriLike
 *
 * @ORM\Table(
 *     name="uri_like",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="uri_like_unique", columns={"uri_like", "user_id"})}
 * )
 * @ORM\Entity(repositoryClass="Tms\Bundle\LikeBundle\Entity\Repository\UriLikeRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class UriLike
{

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="uri_like")
     */
    private $uriLike;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="user_id")
     */
    private $userId;

    /**
     * @var \datetime
     *
     * @ORM\Column(type="datetime", name="created_at")
     */
    private $createdAt;

    /**
     * @ORM\PrePersist()
     */
    public function onCreate()
    {
        $now = new \DateTime("now");
        $this->setCreatedAt($now);
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set uriLike
     *
     * @param string $uriLike
     *
     * @return UriLike
     */
    public function setUriLike($uriLike)
    {
        $this->uriLike = $uriLike;

        return $this;
    }

    /**
     * Get uriLike
     *
     * @return string
     */
    public function getUriLike()
    {
        return $this->uriLike;
    }

    /**
     * Set userId
     *
     * @param string $userId
     *
     * @return UriLike
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return UriLike
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
