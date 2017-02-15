<?php

/**
 * @author Eddie BARRACO <eddie.barraco@idci-consulting.fr>
 */

namespace Tms\Bundle\LikeBundle\Manager;

use Tms\Bundle\LikeBundle\Entity\UriLike;
use Tms\Bundle\LikeBundle\Event\UriLikeEvent;
use Tms\Bundle\LikeBundle\Event\UriLikeEvents;

/**
 * UriLikeManager
 */
class UriLikeManager extends AbstractManager
{
    /**
     * {@inheritdoc}
     */
    public function getEntityClass()
    {
        return "TmsLikeBundle:UriLike";
    }

    /**
     * {@inheritdoc}
     */
    public function add($entity)
    {
        $this->getEventDispatcher()->dispatch(
            UriLikeEvents::PRE_CREATE,
            new UriLikeEvent($entity)
        );
        parent::add($entity);
        $this->getEventDispatcher()->dispatch(
            UriLikeEvents::POST_CREATE,
            new UriLikeEvent($entity)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function update($entity)
    {
        $this->getEventDispatcher()->dispatch(
            UriLikeEvents::PRE_UPDATE,
            new UriLikeEvent($entity)
        );
        parent::update($entity);
        $this->getEventDispatcher()->dispatch(
            UriLikeEvents::POST_UPDATE,
            new UriLikeEvent($entity)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function delete($entity)
    {
        $this->getEventDispatcher()->dispatch(
            UriLikeEvents::PRE_DELETE,
            new UriLikeEvent($entity)
        );
        parent::delete($entity);
        $this->getEventDispatcher()->dispatch(
            UriLikeEvents::POST_DELETE,
            new UriLikeEvent($entity)
        );
    }
}
