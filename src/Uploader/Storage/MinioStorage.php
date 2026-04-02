<?php

namespace App\Uploader\Storage;

use Aws\S3\S3Client;
use Exception;

final readonly class MinioStorage implements FileStorage
{
    public function __construct(
        private S3Client $client,
        private string $bucketName,
        private string $hostName,
    ) {
    }

    /**
     * @throws Exception
     */
    public function store(string $fileName, string $fileContent, ?int $attempts = 3): void
    {
        try {
            $this->client->putObject([
                'Bucket' => $this->bucketName,
                'Key' => $fileName,
                'Body' => $fileContent,
            ]);
        } catch (Exception $exception) {
            if ($attempts == ! 0) {
                $this->store($fileName, $fileContent, $attempts - 1);
            } else {
                throw $exception;
            }
        }
    }

    public function fetchOne(string $fileName): string
    {
        try {
            $command = $this->client->getCommand('GetObject', [
                'Bucket' => $this->bucketName,
                'Key' => $fileName,
            ]);
            $objectUri = $this->client->createPresignedRequest($command, '+7 days')->getUri();

            return sprintf(
                '%s://%s:%s%s',
                $objectUri->getScheme(),
                $this->hostName,
                $objectUri->getPort(),
                $objectUri->getPath(),
            );
        } catch (Exception $exception) {
            // Exception handling
        }
    }
}
