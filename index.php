<?php

    define('ROOT_PATH', dirname(__FILE__) . '/');

    $configContent = file_get_contents(ROOT_PATH . 'config.json');
    $config = json_decode($configContent);

    $requestedUrlPath = $_GET['path'];
    $requestedUrlPathSize = strlen($requestedUrlPath);
    
    if($requestedUrlPathSize === 0) {
        $requestedUrlPath = 'index';
    }

    $requestAccessMap = explode('/', $requestedUrlPath);
    $mainAccessArea = $config->{$requestAccessMap[0]};
    $currentRequestConfig = $mainAccessArea->{$requestAccessMap[1]};

    function generateScriptLocation($config) {
        return join('', [
            'mailto:' . $config->{'to'},
            '?subject=' . $config->{'subject'},
            '&body=' . $config->{'body'}
        ]);
    }

    echo '<script type="text/javascript">location.href="' . generateScriptLocation($currentRequestConfig) . '";</script>';
    
