<?php

namespace Fls\Macros\Macros\UploadedFile\Exceptions;

class UploadedFileException extends \Exception
{
    /**
     * @param string $fileName
     * @return self
     */
    public static function uploadFailed(string $fileName): self
    {
        $message = __('Failed to upload document - :fileName. Please try again - or reach to support', [
            'fileName' => $fileName,
        ]);

        return new self($message);
    }
}
