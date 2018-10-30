<?php
require_once('Parametrs.php');
class Response extends Parametrs{


    // HTTP status codes and messages
    public static $messages = array(
        // Informational 1xx
        100 => 'Continue',
        101 => 'Switching Protocols',

        // Success 2xx
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',

        // Redirection 3xx
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found', // 1.1
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        // 306 is deprecated but reserved
        307 => 'Temporary Redirect',

        // Client Error 4xx
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',

        // Server Error 5xx
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        509 => 'Bandwidth Limit Exceeded'
    );

    /**
     * @var  integer     The response http status
     */
    public $status = 200;


    /**
     * @var  string      The response body
     */
    public $body = '';
    /**
     * @var  array       Cookies to be returned in the response
     */
    public $cookies = array();



    /**
     * Sets up the response object
     *
     * @param   array $config Setup the response object
     * @return  void
     */
    public function __construct(array $config = array())
    {

        foreach ($config as $key => $value)
        {
            if (property_exists($this, $key))
            {
                if ($key == '_header')
                {
                    $this->headers($value);
                }
                else
                {
                    $this->$key = $value;
                }
            }
        }
    }


    /**
     * Gets or sets the body of the response
     *
     * @return  mixed
     */
    public function body($content = NULL)
    {
        if ($content === NULL)
            return $this->body;
        $this->body = (string) $content;
        return $this;
    }



    /**
     * Sets or gets the HTTP status from this response.
     *
     * @param   integer  $status Status to set to this response
     * @return  mixed
     */
    public function status($status = NULL)
    {
        return $this->status;
    }


    /**
     * Set and get cookies values for this response.
     *
     * @return  string
     * @return  void
     * @return  [Response]
     */
    public function cookie($key = NULL, $value = NULL)
    {

        $this->cookies = new Cookie();
            Cookie::set($key, $value);
            if ( ! is_array($value))
            {
                $value = array(
                    'value' => $value,
                    'expiration' => Cookie::$expiration
                );
            }
            elseif ( ! isset($value['expiration']))
            {
                $value['expiration'] = Cookie::$expiration;
            }

        return $this;
    }
}