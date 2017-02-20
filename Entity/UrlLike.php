<?php

/**
 * @author Eddie BARRACO <eddie.barraco@idci-consulting.fr>
 */

namespace Tms\Bundle\LikeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * UrlLike
 *
 * @ORM\Table(
 *     name="url_like",
 *     indexes={
 *         @ORM\Index(name="user_id", columns={"user_id"}),
 *         @ORM\Index(name="url", columns={"url"}),
 *         @ORM\Index(name="host", columns={"host"}),
 *         @ORM\Index(name="created_at", columns={"created_at"})
 *     },
 *     uniqueConstraints={@ORM\UniqueConstraint(name="url_like_unique", columns={"url", "user_id"})}
 * )
 * @ORM\Entity(repositoryClass="Tms\Bundle\LikeBundle\Entity\Repository\UrlLikeRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class UrlLike
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
     * @Assert\Url()
     * @ORM\Column(type="string", name="url")
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="user_id")
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="host")
     */
    private $host;

    /**
     * @var \datetime
     *
     * @ORM\Column(type="datetime", name="created_at")
     */
    private $createdAt;

    /**
     * To string.
     */
    public function __toString()
    {
        return sprintf('%s %s', $this->getUserId(), $this->getUrl());
    }

    /**
     * @ORM\PrePersist()
     */
    public function onCreate()
    {
        $now = new \DateTime("now");
        $this->setCreatedAt($now);
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function buildHost()
    {
        $host = parse_url($this->getUrl(), PHP_URL_HOST);
        $this->setHost($host);
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
     * Set url
     *
     * @param string $url
     *
     * @return Url
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set userId
     *
     * @param string $userId
     *
     * @return UrlLike
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
     * @return UrlLike
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Set host
     *
     * @param string $host
     *
     * @return UrlLike
     */
    public function setHost($host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * Get host
     *
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }
}
