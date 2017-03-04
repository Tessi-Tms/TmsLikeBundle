<?php

/**
 * @author Eddie BARRACO <eddie.barraco@idci-consulting.fr>
 */

namespace Tms\Bundle\LikeBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Tms\Bundle\LikeBundle\Model\UrlLike;

/**
 * UrlLikeEvent
 */
class UrlLikeEvent extends Event
{
    protected $urlLike;

    /**
     * Constructor
     *
     * @param UrlLike $urlLike
     */
    public function __construct(UrlLike $urlLike)
    {
        $this->urlLike = $urlLike;
    }

    /**
     * Get Object
     *
     * @return UrlLike
     */
    public function getUrlLike()
    {
        return $this->urlLike;
    }
}
