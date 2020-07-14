<?php

class UrlUtil
{

    public static function pickUpUrl($referenceId)
    {
        return $GLOBALS[IdpConstants::IDP_ADAPTER_CONFIGURATION][IdpConstants::BASE_PF_URL] . IdpConstants::REF_ID_ADAPTER_PICKUP_ENDPOINT . "?REF=" . $referenceId;
    }

    public static function dropoffUrl()
    {
        return $GLOBALS[IdpConstants::IDP_ADAPTER_CONFIGURATION][IdpConstants::BASE_PF_URL] . IdpConstants::REF_ID_ADAPTER_DROPOFF_ENDPOINT;
    }

    public static function redirectUrl($resumePath, $referenceId)
    {
        return $GLOBALS[IdpConstants::IDP_ADAPTER_CONFIGURATION][IdpConstants::BASE_PF_URL] . $resumePath . "?REF=" . $referenceId . "&TargetResource="
                            . urlencode($GLOBALS[IdpConstants::IDP_ADAPTER_CONFIGURATION][IdpConstants::TARGET_URL]);
    }

    public static function configureUrl()
    {
        $url = explode("?", $_SERVER['REQUEST_URI']);
        return self::currentHttp() . $_SERVER['HTTP_HOST'] . $url[0] . "?action=configure";
    }

    public static function resumeUrl()
    {
        $url = explode("?", $_SERVER['REQUEST_URI']);
        return self::currentHttp() . $_SERVER['HTTP_HOST'] . $url[0] . "?action=resume";
    }

    public static function ssoUrl()
    {
        return $GLOBALS[IdpConstants::IDP_ADAPTER_CONFIGURATION][IdpConstants::BASE_PF_URL] . IdpConstants::START_SP_SSO_ENDPOINT
                    . "?PartnerIdpId=" . $GLOBALS[IdpConstants::IDP_ADAPTER_CONFIGURATION][IdpConstants::PARTNET_ENTITY_ID]; 
    }

    public static function loginUrl()
    {
        $url = explode("?", $_SERVER['REQUEST_URI']);
        return self::currentHttp() . $_SERVER['HTTP_HOST'] . $url[0] . "?action=login";
    }

    private static function currentHttp()
    {
        return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://");
    }
}