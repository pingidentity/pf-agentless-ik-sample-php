<?php

class SpConstants
{
    const APP_CONTROLLER = "AppController";

    const CONFIGURE = 'configure';
    const CONFIGURE_CONTROLLER = 'ConfigurationController';
    const CONFIGURE_VIEW = 'Configuration';

    const ERROR_VIEW = "Error";
    const ERROR_MESSAGE = "ErrorMsg";
    
    const LOGGED_OUT = 'loggedout';
    const LOGGED_OUT_CONTROLLER = 'LoggedOutController';
    const LOGGED_OUT_VIEW = 'LoggedOut';

    const LOGOUT = 'logout';
    const LOGOUT_CONTROLLER = 'LogoutController';
    const LOGOUT_VIEW = 'Logout';

    const PICKUP_VIEW = 'Pickup';

    //ViewData KEYS
    const CURL_DATA = "curlData";
    const REF_ID = "REF";
    const RESPONSE_DATA = "responseData";
    const RESPONSE_HEADERS = "responseHeaders";
    const RESUME_PATH = "resumePath";

    //HTTP request constants
    const HTTP_RESPONSE_CODE = "httpResponseCode";
    const PING_ADAPTER_ID_HEADER = 'ping.instanceId';
    const REF_ID_ADAPTER_PICKUP_ENDPOINT = "/ext/ref/pickup";
    const START_SP_SLO_ENDPOINT = "/sp/startSLO.ping";
    const START_SP_SSO_ENDPOINT = "/sp/startSSO.ping";

    const SP_ADAPTER_CONFIGURATION_FILE = 'sp-adapter-configuration.ini';
    const SP_ADAPTER_CONFIGURATION = 'spAdapterConfiguration';
    //adapter config keys
    const BASE_PF_URL = "basePfUrl";
    const ADAPTER_USERNAME = 'username';
    const ADAPTER_PASSPHRASE = 'passphrase';
    const ADAPTER_ID = 'adapterId';
    const TARGET_URL = 'targetURL';
    const PARTNET_ENTITY_ID = 'partnerEntityId';

}