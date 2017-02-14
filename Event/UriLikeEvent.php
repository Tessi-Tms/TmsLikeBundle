<?php

namespace Tms\Bundle\LikeBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Tms\Bundle\LikeBundle\Entity\UriLike;

/**
 * UriLikeEvent
 */
class UriLikeEvent extends Event
{
    protected $uriLike;

    /**
     * Constructor
     *
     * @param UriLike $uriLike
     */
    public function __construct(UriLike $uriLike)
    {
        $this->uriLike = $uriLike;
    }

    /**
     * Get Object
     *
     * @return UriLike
     */
    public function getUriLike()
    {
        return $this->uriLike;
    }
}
