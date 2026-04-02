<?php

namespace App\Uploader\Storage;

interface FileStorage
{
    /**
     * Stores file with file name to concrete storage.
     */
    public function store(string $fileName, string $fileContent);

    /**
     * Fetches one file from storage.
     * Returns path to this file by file name.
     */
    public function fetchOne(string $fileName);
}
