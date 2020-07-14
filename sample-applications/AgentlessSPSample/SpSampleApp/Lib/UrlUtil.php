<?php

class UrlUtil
{

    public static function pickUpUrl($refereceId)
    {
        return $GLOBALS[SpConstants::SP_ADAPTER_CONFIGURATION][SpConstants::BASE_PF_URL] . SpConstants::REF_ID_ADAPTER_PICKUP_ENDPOINT . "?REF=" . $refereceId;
    }

    public static function ssoUrl()
    {
        return $GLOBALS[SpConstants::SP_ADAPTER_CONFIGURATION][SpConstants::BASE_PF_URL] . SpConstants::START_SP_SSO_ENDPOINT 
                     . "?PartnerSpId=" . $GLOBALS[SpConstants::SP_ADAPTER_CONFIGURATION][SpConstants::PARTNET_ENTITY_ID];

    }

    public static function applicationSsoUrl()
    {
        $url = explode("?", $_SERVER['REQUEST_URI']);
        return self::currentHttp() . $_SERVER['HTTP_HOST'] . $url[0];
    }

    public static function configureUrl()
    {
        $url = explode("?", $_SERVER['REQUEST_URI']);
        return self::currentHttp() . $_SERVER['HTTP_HOST'] . $url[0] . "?action=configure";
    }

    public static function sloUrl()
    {
        return $GLOBALS[SpConstants::SP_ADAPTER_CONFIGURATION][SpConstants::BASE_PF_URL] . SpConstants::START_SP_SLO_ENDPOINT . "?TargetResource="
                            . urlencode($GLOBALS[SpConstants::SP_ADAPTER_CONFIGURATION][SpConstants::TARGET_URL] . "/?action=loggedout" );
    }

    public static function redirectUrl($resumePath, $refereceId)
    {
        return $GLOBALS[SpConstants::SP_ADAPTER_CONFIGURATION][SpConstants::BASE_PF_URL] . $resumePath . "?REF=" . $refereceId;
    }

    private static function currentHttp()
    {
        return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://");
    }
}