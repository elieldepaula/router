<?php

namespace Elieldepaula\Router;


class Router
{

    private $server;

    function __construct()
    {

    }

    public function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
    }

    public function getBrowser()
    {
        if (strpos($this->server['HTTP_USER_AGENT'], 'Opera') || strpos($this->server['HTTP_USER_AGENT'], 'OPR/')) {
            return 'Opera';
        } elseif (strpos($this->server['HTTP_USER_AGENT'], 'Edge')) {
            return 'Edge';
        } elseif (strpos($this->server['HTTP_USER_AGENT'], 'Chrome')) {
            return 'Chrome';
        } elseif (strpos($this->server['HTTP_USER_AGENT'], 'Safari')) {
            return 'Safari';
        } elseif (strpos($this->server['HTTP_USER_AGENT'], 'Firefox')) {
            return 'Firefox';
        } elseif (strpos($this->server['HTTP_USER_AGENT'], 'MSIE') || strpos($this->server['HTTP_USER_AGENT'], 'Trident/7')) {
            return 'Internet Explorer';
        }
        return 'unknown';
    }

    public function getPlatform()
    {
        if (preg_match('/linux/i', $this->server['HTTP_USER_AGENT'])) {
            return 'linux';
        } elseif (preg_match('/macintosh|mac os x/i', $this->server['HTTP_USER_AGENT'])) {
            return 'mac';
        } elseif (preg_match('/windows|win32/i', $this->server['HTTP_USER_AGENT'])) {
            return 'windows';
        }
        return 'unknown';
    }

    public function getIp()
    {
        if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        } elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } elseif (isset($_SERVER["HTTP_X_FORWARDED"])) {
            $ip = $_SERVER["HTTP_X_FORWARDED"];
        } elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])) {
            $ip = $_SERVER["HTTP_FORWARDED_FOR"];
        } elseif (isset($_SERVER["HTTP_FORWARDED"])) {
            $ip = $_SERVER["HTTP_FORWARDED"];
        } elseif (isset($_SERVER["REMOTE_ADDR"])) {
            $ip = $_SERVER["REMOTE_ADDR"];
        } else {
            $ip = getenv("REMOTE_ADDR");
        }

        if(strpos($ip, ',') !== false){
            $ip = explode(',', $ip)[0];
        }

        if (!filter_var($ip, FILTER_VALIDATE_IP)) {
            return 'unknown';
        }

        return $ip;
    }

    public function isMobile()
    {
        $aMobileUA = array(
            '/iphone/i' => 'iPhone',
            '/ipod/i' => 'iPod',
            '/ipad/i' => 'iPad',
            '/android/i' => 'Android',
            '/blackberry/i' => 'BlackBerry',
            '/webos/i' => 'Mobile'
        );

        // Return true if mobile User Agent is detected.
        foreach ($aMobileUA as $sMobileKey => $sMobileOS) {
            if (preg_match($sMobileKey, $_SERVER['HTTP_USER_AGENT'])) {
                return true;
            }
        }
        // Otherwise, return false.
        return false;
    }

    // ...

}