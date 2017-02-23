<?php

namespace Tms\Bundle\LikeBundle\Controller\Rest;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Util\Codes;
use JMS\Serializer\SerializationContext;
use Tms\Bundle\RestBundle\Formatter\AbstractHypermediaFormatter;
use Tms\Bundle\LikeBundle\Entity\UrlLike;
use Tms\Bundle\LikeBundle\Form\UrlLikeType;

/**
 * UrlLike API REST controller
 *
 * @author:  Eddie BARRACO <eddie.barraco@idci-consulting.fr>
 * @license: GPL
 */
class ApiUrlLikeController extends FOSRestController
{
    /**
     * [GET] /urllikes
     * Retrieve a set of urllikes
     *
     * @QueryParam(name="url", nullable=true, description="(optional) Url")
     * @QueryParam(name="user_id", nullable=true, description="(optional) User id")
     * @QueryParam(name="host", nullable=true, description="(optional) Host")
     * @QueryParam(name="limit", requirements="^\d+$", default=20, strict=true, nullable=true, description="(optional) Limit")
     * @QueryParam(name="offset", requirements="^\d+$", strict=true, nullable=true, description="(optional) Offset")
     * @QueryParam(name="page", requirements="^\d+$", strict=true, nullable=true, description="(optional) Page number")
     * @QueryParam(name="sort", array=true, nullable=true, description="(optional) Sort")
     *
     * @param string  $url
     * @param string  $user_id
     * @param string  $host
     * @param integer $limit
     * @param integer $offset
     * @param integer $page
     * @param array   $sort
     */
    public function getUrllikesAction(
        $url = null,
        $user_id = null,
        $host = null,
        $limit = null,
        $offset = null,
        $page = null,
        $sort = null
    ) {
        $view = $this->view(
            $this
                ->get('tms_rest.formatter.factory')
                ->create(
                    'orm_collection',
                    $this->getRequest()->get('_route'),
                    $this->getRequest()->getRequestFormat()
                )
                ->setObjectManager(
                    $this->get('doctrine.orm.entity_manager'),
                    $this
                        ->get('tms_like.manager.url_like')
                        ->getEntityClass()
                )
                ->setCriteria(array(
                    'url'    => $url,
                    'userId' => $user_id,
                    'host'   => $host
                ))
                ->setExtraQuery(array(
                    'url'     => $url,
                    'user_id' => $user_id,
                    'host'    => $host
                ))
                ->setSort($sort)
                ->setLimit($limit)
                ->setOffset($offset)
                ->setPage($page)
                ->format(),
            Codes::HTTP_OK
        );

        $serializationContext = SerializationContext::create()
            ->setGroups(array(
                AbstractHypermediaFormatter::SERIALIZER_CONTEXT_GROUP_COLLECTION
            ))
        ;
        $view->setSerializationContext($serializationContext);

        return $this->handleView($view);
    }

    /**
     * [GET] /urllikes/{id}
     * Retrieve an urllike
     *
     * @Route(requirements={"id" = "^[a-zA-Z0-9_-]+$"})
     *
     * @param string  $id
     */
    public function getUrllikeAction($id)
    {
        try {
            $view = $this->view(
                $this
                    ->get('tms_rest.formatter.factory')
                    ->create(
                        'item',
                        $this->getRequest()->get('_route'),
                        $this->getRequest()->getRequestFormat(),
                        array('id' => $id)
                    )
                    ->setObjectManager(
                        $this->get('doctrine.orm.entity_manager'),
                        $this
                            ->get('tms_like.manager.url_like')
                            ->getEntityClass()
                    )
                    ->format(),
                Codes::HTTP_OK
            );

            $serializationContext = SerializationContext::create()
                ->setGroups(array(
                    AbstractHypermediaFormatter::SERIALIZER_CONTEXT_GROUP_ITEM
                ));

            $view->setSerializationContext($serializationContext);

            return $this->handleView($view);
        } catch (NotFoundHttpException $e) {
            return $this->handleView(
                $this->view(
                    array(),
                    $e->getStatusCode()
                )
            );
        }
    }

    /**
     * [POST] /urllikes
     * Create a urllike
     */
    public function postUrllikeAction(Request $request)
    {
        $urlLike = new UrlLike();
        $form = $this->createForm(UrlLikeType::class, $urlLike, array(
            'csrf_protection' => false,
        ));

        $data = $request->request->all();

        $form->submit($data);

        if ($form->isValid()) {
            try {
                $this
                    ->get('tms_like.manager.url_like')
                    ->add($urlLike);

                $view = $this->view(
                    $this
                        ->get('tms_rest.formatter.factory')
                        ->create(
                            'item',
                            $this->getRequest()->get('_route'),
                            $this->getRequest()->getRequestFormat(),
                            array('id' => $urlLike->getId())
                        )
                        ->setObjectManager(
                            $this->get('doctrine.orm.entity_manager'),
                            $this
                                ->get('tms_like.manager.url_like')
                                ->getEntityClass()
                        )
                        ->format(),
                    Codes::HTTP_CREATED
                );

                $serializationContext = SerializationContext::create()
                    ->setGroups(array(
                        AbstractHypermediaFormatter::SERIALIZER_CONTEXT_GROUP_ITEM
                    ))
                ;
                $view->setSerializationContext($serializationContext);

                return $this->handleView($view);
            } catch (UniqueConstraintViolationException $e) {
                $view = $this->view(
                    array('error' => $e->getMessage()),
                    Codes::HTTP_CONFLICT
                );

                return $this->handleView($view);
            } catch (\Exception $e) {
                $view = $this->view(
                    array('error' => $e->getMessage()),
                    Codes::HTTP_INTERNAL_SERVER_ERROR
                );

                return $this->handleView($view);
            }
        } else {
            $errors = array();

            foreach ($form->getErrors() as $key => $error) {
                $errors[] = $error->getMessage();
            }

            $view = $this->view(
                array('errors' => $errors),
                Codes::HTTP_BAD_REQUEST
            );

            return $this->handleView($view);
        }
    }

    /**
     * [DELETE] /urllike/{id}
     * Remove an url like
     *
     * @Route(requirements={"id" = "^\d+$"})
     *
     * @param integer $id
     */
    public function deleteUrllikeAction($id)
    {
        $entity = $this->get('tms_like.manager.url_like')->findOneById($id);
        if (!$entity) {
            $view = $this->view(array(), Codes::HTTP_NOT_FOUND);

            return $this->handleView($view);
        }

        $this->get('tms_like.manager.url_like')->delete($entity);
        $view = $this->view(array(), Codes::HTTP_NO_CONTENT);

        return $this->handleView($view);
    }
}
