<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileTypeValidatorService
{
    public function isValidVideo(UploadedFile $file): bool
    {
        $mimeType = $file->getClientMimeType();
        return in_array($mimeType, ['video/mp4']);
    }

    public function isValidDoc(UploadedFile $file): bool
    {
        $mimeType = $file->getClientMimeType();
        return in_array($mimeType, ['application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']);
    }

    public function isValidPdf(UploadedFile $file): bool
    {
        $mimeType = $file->getClientMimeType();
        return in_array($mimeType, ['application/pdf']);
    }

    public function isValidPpt(UploadedFile $file): bool
    {
        $mimeType = $file->getClientMimeType();
        return in_array($mimeType, ['application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation']);
    }

    public function isValidXls(UploadedFile $file): bool
    {
        $mimeType = $file->getClientMimeType();
        return in_array($mimeType, ['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']);
    }
}
