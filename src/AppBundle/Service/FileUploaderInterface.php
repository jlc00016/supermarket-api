<?php

namespace AppBundle\Service;


use Symfony\Component\HttpFoundation\File\UploadedFile;

interface FileUploaderInterface
{
    /**
     * @param UploadedFile $file
     * @return string
     */
    public function upload(UploadedFile $file);
}