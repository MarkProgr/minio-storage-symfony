<?php

namespace App\Uploader\FileUploader;

interface FileUploader
{
    /**
     * Uploads given file to storage.
     *
     * Returns a path to file.
     */
    public function upload(string $resourceName, string $uploadedContent): string;
}
