<?php
class Cookie {



    /**
     * @var  integer  Number of seconds before the cookie expires
     */
    public static $expiration = 0;


    /**
     * Gets the value cookie.
     *
     * @param   string  $key        cookie name
     * @param   mixed   $default    default value to return
     * @return  string
     */
    public function get($key, $default = NULL)
    {

        if ( ! isset($_COOKIE[$key]))
        {

            return $default;
        }


        $cookie = $_COOKIE[$key];


        return $cookie;
    }

    /**
     * Gets the all cookie.
     *
     * @param   mixed   $default    default value to return
     * @return  array
     */

    public  function all($default = NULL)
    {
        if (!isset($_COOKIE))
        {
            return $default;
        }
        return $_COOKIE;

    }

    /**
     * Sets a signed cookie.
     *
     * @param   string  $name       name of cookie
     * @param   string  $value      value of cookie
     * @param   integer $time   lifetime in seconds
     */
    public static function set($name, $value, $time = NULL)
    {
        if ($time === NULL)
        {
            $time = Cookie::$expiration;
        }

        if ($time !== 0)
        {
            $time += time();
        }


        return static::setCookie($name, $value, $time);
    }

    /**
     *
     * @param string  $name
     * @param string  $value
     * @param integer $expire
     */
    protected static function setCookie($name, $value, $expire)
    {
        return setcookie($name, $value, $expire);
    }

}
