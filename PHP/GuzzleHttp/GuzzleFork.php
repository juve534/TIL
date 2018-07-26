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
     * @return bool
     */
    public function executeUrl(string $url) : bool
    {
        $response = $this->guzzle->get($url);
        return $this->isSuccessRequest($response);
    }

    /**
     * リストにあるURLを一気に実行する
     *
     * @param  array $urlList
     * @return bool
     */
    public function requestAsync(array $urlList) : bool
    {
        // Guzzleを使った非同期処理
        $promises = [];
        foreach ($urlList AS $url) {
            $promises[] = $this->guzzle->requestAsync('GET', $url);
        }
        $responses = \GuzzleHttp\Promise\all($promises)->wait();

        $errorList = [];
        foreach ($responses as $response) {
            if ($this->isSuccessRequest($response) === false) {
                throw new \Exception("Error : " . var_export($response, true));
            }
        }

        return true;
    }

    private function isSuccessRequest($response) : bool
    {
        return $response->getStatusCode() === 200;
    }
}
