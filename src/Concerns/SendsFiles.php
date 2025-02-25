<?php

/** @noinspection PhpUnnecessaryLocalVariableInspection */

/** @noinspection PhpUnhandledExceptionInspection */

namespace DefStudio\Telegraph\Concerns;

use DefStudio\Telegraph\DTO\Attachment;
use DefStudio\Telegraph\Exceptions\FileException;
use DefStudio\Telegraph\Telegraph;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

/**
 * @mixin Telegraph
 */
trait SendsFiles
{
    public function document(string $path, string $filename = null): Telegraph
    {
        $telegraph = clone $this;

        if (!File::exists($path)) {
            throw FileException::fileNotFound("Document", $path);
        }

        if (($size = $telegraph->fileSizeInMb($path)) > Telegraph::MAX_DOCUMENT_SIZE_IN_MB) {
            throw FileException::documentSizeExceeded($size);
        }

        $telegraph->endpoint = self::ENDPOINT_SEND_DOCUMENT;

        $telegraph->data['chat_id'] = $telegraph->getChat()->chat_id;

        $telegraph->files->put('document', new Attachment($path, $filename));

        return $telegraph;
    }

    public function withoutContentTypeDetection(): Telegraph
    {
        $telegraph = clone $this;

        $telegraph->data['disable_content_type_detection'] = 1;

        return $telegraph;
    }

    public function thumbnail(string $path): Telegraph
    {
        $telegraph = clone $this;

        if (!File::exists($path)) {
            throw FileException::fileNotFound("Thumbnail", $path);
        }

        if (($size = $telegraph->fileSizeInKb($path)) > Telegraph::MAX_THUMBNAIL_SIZE_IN_KB) {
            throw FileException::thumbnailSizeExceeded($size);
        }

        if (($height = $telegraph->imageHeight($path)) > Telegraph::MAX_THUMBNAIL_HEIGHT) {
            throw FileException::thumbnailHeightExceeded($height);
        }

        if (($width = $telegraph->imageWidth($path)) > Telegraph::MAX_THUMBNAIL_WIDTH) {
            throw FileException::thumbnailWidthExceeded($width);
        }

        if (!Str::of($ext = File::extension($path))->lower()->is('jpg')) {
            throw FileException::invalidThumbnailExtension($ext);
        }

        $telegraph->files->put('thumb', new Attachment($path));

        return $telegraph;
    }

    private function imageHeight(string $path): int
    {
        return $this->imageDimensions($path)[1];
    }

    private function imageWidth(string $path): int
    {
        return $this->imageDimensions($path)[0];
    }

    /**
     * @return int[]
     */
    private function imageDimensions(string $path): array
    {
        $sizes = getimagesize($path);

        if (!$sizes) {
            return [0, 0];
        }

        return $sizes;
    }

    private function fileSizeInMb(string $path): float
    {
        $sizeInMBytes = $this->fileSizeInKb($path) / 1024;

        return ceil($sizeInMBytes * 100) / 100;
    }

    private function fileSizeInKb(string $path): float
    {
        $sizeInBytes = File::size($path);
        $sizeInKBytes = $sizeInBytes / 1024;

        return ceil($sizeInKBytes * 100) / 100;
    }
}
