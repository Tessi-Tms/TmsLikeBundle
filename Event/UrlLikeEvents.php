<?php

/**
 * @author Eddie BARRACO <eddie.barraco@idci-consulting.fr>
 */

namespace Tms\Bundle\LikeBundle\Event;

/**
 * UrlLikeEvents
 */
final class UrlLikeEvents
{
    /**
     * @var string
     */
    const PRE_CREATE =  'tms_operation.urlLike.pre_create';
    const POST_CREATE = 'tms_operation.urlLike.post_create';
    const PRE_UPDATE =  'tms_operation.urlLike.pre_update';
    const POST_UPDATE = 'tms_operation.urlLike.post_update';
    const PRE_DELETE =  'tms_operation.urlLike.pre_delete';
    const POST_DELETE = 'tms_operation.urlLike.post_delete';
}
