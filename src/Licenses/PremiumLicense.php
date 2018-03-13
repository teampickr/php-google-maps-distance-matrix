<?php

namespace TeamPickr\DistanceMatrix\Licenses;

use GuzzleHttp\Psr7\Request;
use TeamPickr\DistanceMatrix\Contracts\LicenseContract;

class PremiumLicense implements LicenseContract
{
    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $clientId;

    /**
     * PremiumLicense constructor.
     *
     * @param string $clientId
     * @param string $encryptionKey
     */
    public function __construct(string $clientId, string $encryptionKey)
    {
        $this->key      = $encryptionKey;
        $this->clientId = $clientId;
    }

    /**
     * @return string
     */
    private function getDecodedKey()
    {
        return base64_decode(strtr($this->key, '-_,', '+/='));
    }

    /**
     * @param \GuzzleHttp\Psr7\Request $request
     *
     * @return string
     */
    protected function urlWithClientId(Request $request)
    {
        $uri = $request->getUri();

        return $uri->getPath() . "?" . $uri->getQuery() . "&client=" . $this->clientId;
    }

    /**
     * @param \GuzzleHttp\Psr7\Request $request
     *
     * @return string
     */
    protected function createSignature(Request $request)
    {
        return strtr(
            base64_encode(
                hash_hmac('sha1', $this->urlWithClientId($request), $this->getDecodedKey(), true)
            ),
            '+/=',
            '-_,'
        );
    }

    /**
     * @param \GuzzleHttp\Psr7\Request $request
     *
     * @return array
     */
    public function getQueryStringParameters(Request $request): array
    {
        return [
            'client'    => $this->clientId,
            'signature' => $this->createSignature($request),
        ];
    }
}