<?php

namespace Spatie\MixedContentScanner;

use Spatie\Crawler\Url;
use Spatie\Crawler\CrawlObserver;

class MixedContentObserver implements CrawlObserver
{
    public function willCrawl(Url $url)
    {

    }

    public function hasBeenCrawled(Url $crawledUrl, $response, Url $foundOnUrl = null)
    {
        if (! $response) {
            $this->failedToCrawl($crawledUrl, $response);

            return;
        }

        $mixedContent = MixedContentExtractor::extract((string)$response->getBody(), $crawledUrl);

        if (! count($mixedContent)) {
            $this->noMixedContentFound($crawledUrl);

            return;
        }

        foreach ($mixedContent as $mixedContentItem) {
            $this->mixedContentFound($mixedContentItem);
        }
    }

    /** null|GuzzleHttp\Psr7\Response */
    public function failedToCrawl(Url $crawledUrl, $response)
    {
        dump($response);
    }

    public function mixedContentFound(MixedContent $mixedContent)
    {

    }

    public function noMixedContentFound(Url $crawledUrl)
    {

    }

    public function finishedCrawling()
    {

    }
}