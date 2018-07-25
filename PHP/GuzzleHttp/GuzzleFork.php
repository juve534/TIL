<?php
/**
 * GuzzleHttp\Clientをfork
 */
class GuzzleFork
{
    /**
     * @var Guzzle
     */
    private $guzzle;

    public function __construct($obj)
    {
        $this->guzzle = $obj;
    }

    /**
     * URLを単独で実行
     *
     * @param  string $url [URL]
     * @return object      [レスポンスオブジェクト]
     */
    public function executeUrl(string $url) : object
    {
        return $this->guzzle->get($url);
    }
}
