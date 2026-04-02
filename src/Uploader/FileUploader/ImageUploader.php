<?php

namespace App\Uploader\FileUploader;

use App\Uploader\Storage\FileStorage;
use DateTime;
use Throwable;

final readonly class ImageUploader implements FileUploader
{
    public function __construct(private FileStorage $fileStorage)
    {
    }

    public function upload(string $resourceName, string $uploadedContent): string
    {
        // Should be customized for exact business logics
        $extension = strrev(explode('.', strrev($resourceName))[0]);
        $fileName = sprintf('%s-%s.%s', md5($resourceName), new DateTime()->format('Y-m-d'), $extension);

        try {
            $this->fileStorage->store($fileName, $uploadedContent);
            return $this->fileStorage->fetchOne($fileName);
        } catch (Throwable $exception) {
            // Exception handling
        }
    }
}
