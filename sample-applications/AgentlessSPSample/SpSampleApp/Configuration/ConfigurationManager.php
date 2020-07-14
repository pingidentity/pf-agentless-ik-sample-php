<?php

class ConfigurationManager
{
    public function loadConfiguration()
    {
        $GLOBALS['spAdapterConfiguration'] = parse_ini_file(CONFIGURATION . SpConstants::SP_ADAPTER_CONFIGURATION_FILE, true);
    }

    public function saveConfiguration($configuration)
    {
        $res = array();
        array_push($res, "; SP adapter configuration for the SP Sample");
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

        file_put_contents(CONFIGURATION . SpConstants::SP_ADAPTER_CONFIGURATION_FILE, implode("\r\n", $res));

    }

    private function validateConfiguration($key, $value)
    {
        switch($key)
        {
            case SpConstants::BASE_PF_URL:
                return !(filter_var($value, FILTER_VALIDATE_URL) === FALSE);
            case SpConstants::ADAPTER_USERNAME:
                return !empty($value);
            case SpConstants::ADAPTER_PASSPHRASE:
                return !empty($value);
            case SpConstants::ADAPTER_ID:
                return !empty($value);
            case SpConstants::TARGET_URL:
                return !(filter_var($value, FILTER_VALIDATE_URL) === FALSE);
            case SpConstants::PARTNET_ENTITY_ID:
                return !empty($value);
        }
    }
}