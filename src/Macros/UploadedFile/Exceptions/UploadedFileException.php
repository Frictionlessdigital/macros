<?php

namespace Fls\Macros\Macros\UploadedFile\Exceptions;

class UploadedFileException extends \Exception
{
    /**
     * @param string $filename
     * @return static
     */
    public static function uploadFailed(string $fileName)
    {
        $message = __('Failed to upload document - :fileName. Please try again - or reach to support', [
            'fileName' => $fileName,
        ]);

        return new static($message);
    }
}
