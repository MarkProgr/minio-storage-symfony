## What is this
Reusable uploader service for Symfony with Minio as a storage (could be extended if needed).

## How to use
Defined docker compose file with two minio-related services (one for minio, the second one to create default bucket).

Also needs a package to install with receipts:

```
composer require aws/aws-sdk-php-symfony
```
It will install aws devkit and make an aws yaml `(config/packages/aws.yaml)` file to configure your s3 client.
