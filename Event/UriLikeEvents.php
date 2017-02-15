<?php

/**
 * @author Eddie BARRACO <eddie.barraco@idci-consulting.fr>
 */

namespace Tms\Bundle\LikeBundle\Event;

/**
 * UriLikeEvents
 */
final class UriLikeEvents
{
    /**
     * @var string
     */
    const PRE_CREATE =  'tms_operation.uriLike.pre_create';
    const POST_CREATE = 'tms_operation.uriLike.post_create';
    const PRE_UPDATE =  'tms_operation.uriLike.pre_update';
    const POST_UPDATE = 'tms_operation.uriLike.post_update';
    const PRE_DELETE =  'tms_operation.uriLike.pre_delete';
    const POST_DELETE = 'tms_operation.uriLike.post_delete';
}
