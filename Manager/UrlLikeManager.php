<?php

/**
 * @author Eddie BARRACO <eddie.barraco@idci-consulting.fr>
 */

namespace Tms\Bundle\LikeBundle\Manager;

use Tms\Bundle\LikeBundle\Entity\UrlLike;
use Tms\Bundle\LikeBundle\Event\UrlLikeEvent;
use Tms\Bundle\LikeBundle\Event\UrlLikeEvents;

/**
 * UrlLikeManager
 */
class UrlLikeManager extends AbstractManager
{
    /**
     * {@inheritdoc}
     */
    public function getEntityClass()
    {
        return "TmsLikeBundle:UrlLike";
    }

    /**
     * {@inheritdoc}
     */
    public function add($entity)
    {
        $this->getEventDispatcher()->dispatch(
            UrlLikeEvents::PRE_CREATE,
            new UrlLikeEvent($entity)
        );
        parent::add($entity);
        $this->getEventDispatcher()->dispatch(
            UrlLikeEvents::POST_CREATE,
            new UrlLikeEvent($entity)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function update($entity)
    {
        $this->getEventDispatcher()->dispatch(
            UrlLikeEvents::PRE_UPDATE,
            new UrlLikeEvent($entity)
        );
        parent::update($entity);
        $this->getEventDispatcher()->dispatch(
            UrlLikeEvents::POST_UPDATE,
            new UrlLikeEvent($entity)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function delete($entity)
    {
        $this->getEventDispatcher()->dispatch(
            UrlLikeEvents::PRE_DELETE,
            new UrlLikeEvent($entity)
        );
        parent::delete($entity);
        $this->getEventDispatcher()->dispatch(
            UrlLikeEvents::POST_DELETE,
            new UrlLikeEvent($entity)
        );
    }
}
