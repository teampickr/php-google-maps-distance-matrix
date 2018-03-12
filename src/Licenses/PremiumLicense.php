<?php

namespace TeamPickr\DistanceMatrix\Licenses;

use TeamPickr\DistanceMatrix\Contracts\LicenseContract;

class PremiumLicense implements LicenseContract
{
    /**
     * @var string
     */
    protected $key;

    /**
     * PremiumLicense constructor.
     *
     * @param string $encryptedKey
     */
    public function __construct(string $encryptedKey)
    {
        $this->key = $encryptedKey;
    }

    /**
     * @return string
     */
    private function getDecodedKey()
    {
        return base64_decode(strtr($this->key, '-_,', '+/='));
    }

    /**
     * @param $url
     *
     * @return string
     */
    public function getQueryStringParameters($url)
    {
        return strtr(base64_encode(hash_hmac('sha1', $url, $this->getDecodedKey(), true)), '+/=', '-_,');
    }
}