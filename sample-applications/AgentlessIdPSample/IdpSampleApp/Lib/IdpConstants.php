<?php

class IdpConstants 
{
    const APP_CONTROLLER = "AppController";

    const CONFIGURE = 'configure';
    const CONFIGURE_CONTROLLER = 'ConfigurationController';
    const CONFIGURE_VIEW = 'Configuration';
    
    const DROPOFF = 'dropoff';
    const DROPOFF_CONTROLLER = "DropoffController";
    const DROPOFF_VIEW = "Dropoff";

    const ERROR_VIEW = "Error";
    const ERROR_MESSAGE = "ErrorMsg";
    
    const LOGIN = 'login';
    const LOGIN_CONTROLLER = 'LoginController';
    const LOGIN_VIEW = "Login";

    const LOGOUT = 'logout';
    const LOGOUT_CONTROLLER = 'LogoutController';
    const LOGOUT_VIEW = 'Logout';

    const RESUME = 'resume';
    const RESUME_CONTROLLER = 'ResumeController';

    //ViewData KEYS
    const REF_ID = "REF";
    const RESPONSE_DATA = "responseData";
    const RESPONSE_HEADERS = "responseHeaders";
    const USER_SESSION_DATA = "userData";
    const RESUME_PATH = "resumePath";

    //POST KEYS
    const USERNAME = 'username';
    const PASSWORD = 'password';
    const SUBJECT = 'subject';
    const AUTHN_INST = 'authnInst';

    //HTTP request constants
    const HTTP_RESPONSE_CODE = "httpResponseCode";
    const PING_ADAPTER_ID_HEADER = 'ping.instanceId';
    const PING_POST_REF_ID_KEY = "REF";
    const REF_ID_ADAPTER_PICKUP_ENDPOINT = "/ext/ref/pickup";
    const REF_ID_ADAPTER_DROPOFF_ENDPOINT = "/ext/ref/dropoff";
    const START_SP_SSO_ENDPOINT = "/sp/startSSO.ping";

    const IDP_ADAPTER_CONFIGURATION_FILE = 'idp-adapter-configuration.ini';
    const IDP_ADAPTER_CONFIGURATION = 'idpAdapterConfiguration';
    //adapter config keys
    const BASE_PF_URL = "basePfUrl";
    const ADAPTER_USERNAME = 'username';
    const ADAPTER_PASSPHRASE = 'passphrase';
    const ADAPTER_ID = 'adapterId';
    const TARGET_URL = 'targetURL';
    const PARTNET_ENTITY_ID = 'partnerEntityId';
}
