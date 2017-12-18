<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Form\Type\ProductType;
use AppBundle\Service\FileUploader;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/api")
 */
class ProductController extends FOSRestController
{
    /**
     * @Rest\Get("/products")
     */
    public function indexAction(Request $request)
    {
        $products = $this->getDoctrine()->getManager()->getRepository(Product::class)->findAll();

        return $products;
    }

    /**
     * @Rest\Get("/product/{id}")
     * @ParamConverter()
     */
    public function detailAction(Product $product)
    {
        return $product;
    }

    /**
     * @Rest\Post("/product")
     */
    public function postAction(Request $request)
    {
        $form = $this->createForm(ProductType::class);
        $form->submit($request->request->all());

        if (!$form->isValid()) {
            return $form;
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($form->getData());
        $entityManager->flush();

        return 'Producto creado correctamente.';
    }

    /**
     * @Rest\Put("/product/{id}")
     * @ParamConverter()
     */
    public function updateAction(Request $request, Product $product)
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->submit($request->request->all());

        if (!$form->isValid()) {
            return $form;
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($form->getData());
        $entityManager->flush();

        return 'Producto actualizado correctamente.';
    }

    /**
     * @Rest\Delete("/product/{id}")
     * @ParamConverter()
     */
    public function deleteAction(Product $product)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($product);
        $entityManager->flush();

        return 'Producto eliminado correctamente.';
    }

    /**
     * @Rest\Post("/product/upload-image")
     */
    public function uploadImageAction(Request $request)
    {
        $fileUploader = $this->get(FileUploader::class);

        $file = $request->files->get('image');
        $fileName = $fileUploader->upload($file);

        return $fileName;
    }
}
