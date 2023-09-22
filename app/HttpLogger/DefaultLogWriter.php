<?php

namespace App\HttpLogger;

use App\HttpLogger\Contracts\LogWriter;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class DefaultLogWriter implements LogWriter
{
    /**
     * Log the request
     *
     * @param Request $request
     */
    public function logRequest(Request $request)
    {
        $message = $this->formatMessage($this->getMessage($request));

        Log::channel('http-logger')->info($message);
    }

    /**
     * Get logging message
     *
     * @param Request $request
     *
     * @return array
     */
    public function getMessage(Request $request): array
    {
        $files = (new Collection(iterator_to_array($request->files)))
            ->map([$this, 'flatFiles'])
            ->flatten();

        return [
            'method' => strtoupper($request->getMethod()),
            'uri' => $request->getPathInfo(),
            'body' => $request->except(config('http-logger.except')),
            'headers' => $request->headers->all(),
            'files' => $files,
        ];
    }

    /**
     * Flat files subjected to the request
     *
     * @param $file
     *
     * @return array|string
     */
    public function flatFiles($file)
    {
        if ($file instanceof UploadedFile) {
            return $file->getClientOriginalName();
        }
        if (is_array($file)) {
            return array_map([$this, 'flatFiles'], $file);
        }

        return (string) $file;
    }

    /**
     * Format logging message
     *
     * @param array $message
     *
     * @return string
     */
    protected function formatMessage(array $message): string
    {
        $bodyAsJson = json_encode($message['body']);
        $headersAsJson = json_encode($message['headers']);
        $files = $message['files']->implode(',');
        return "{$message['method']} {$message['uri']} - Body: {$bodyAsJson} - Headers: {$headersAsJson} - Files: {$files}";
    }
}
