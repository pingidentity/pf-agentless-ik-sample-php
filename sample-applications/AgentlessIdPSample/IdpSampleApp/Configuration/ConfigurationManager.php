<?php

// loads app configuration according to idp-adapter-configuration.ini file for each request
// any changes to configuration through UI will invoke save and reload of app with new configuration

class ConfigurationManager
{
    public function loadConfiguration()
    {
        $GLOBALS['idpAdapterConfiguration'] = parse_ini_file(CONFIGURATION . IdpConstants::IDP_ADAPTER_CONFIGURATION_FILE, true);
    }

    public function saveConfiguration($configuration)
    {
        $res = array();
        array_push($res, "; IdP adapter configuration for the IdP Sample");
        array_push($res, "; For sample simplicity, configuration information in project");
        array_push($res, "; Never leave credentials in area accessible in production");

        foreach($configuration as $key => $val)
        {
            if ($key != "submit")
            {
                if (self::validateConfiguration($key, $val))
                {
                    $res[] = "$key=". $val;
                }
                else
                {
                    throw new Exception("Please check configuration of " . $key);
                }
            }
        }

        file_put_contents(CONFIGURATION . IdpConstants::IDP_ADAPTER_CONFIGURATION_FILE, implode("\r\n", $res));

    }

    private function validateConfiguration($key, $value)
    {
        switch($key)
        {
            case IdpConstants::BASE_PF_URL:
                return !(filter_var($value, FILTER_VALIDATE_URL) === FALSE);
            case IdpConstants::ADAPTER_USERNAME:
                return !empty($value);
            case IdpConstants::ADAPTER_PASSPHRASE:
                return !empty($value);
            case IdpConstants::ADAPTER_ID:
                return !empty($value);
            case IdpConstants::TARGET_URL:
                return !(filter_var($value, FILTER_VALIDATE_URL) === FALSE);
            case IdpConstants::PARTNET_ENTITY_ID:
                return !empty($value);
        }
    }
}