<?php
require_once('Parametrs.php');
class Request extends  Parametrs{


    /**
     * @var  string  method: GET, POST, PUT, DELETE, HEAD, etc
     */
    public $method = 'GET';


    /**
     * @var  string the body
     */
    public $body;


    /**
     * @var array    query parameters
     */
    public $get = array();

    /**
     * @var array    post parameters
     */
    public $post = array();

    /**
     * @var array    cookies to send with the request
     */
    public $cookies = array();



    public function __construct()
    {

    }

    /**
     * Gets or sets the HTTP method.
     *
     * @param   string   $method  Method to use for this request
     * @return  mixed
     */
    public function method($method = NULL)
    {
        if ($method === NULL)
        {
            // Act as a getter
            return $this->method;
        }

        // Act as a setter
        $this->method = strtoupper($method);

        return $this;
    }



    /**
     * Set and get cookies values for this request.
     *
     * @param   mixed    $key    Cookie name, or array of cookie values
     * @param   string   $value  Value to set to cookie
     * @return  string
     * @return  mixed
     */
    public function cookie($key = NULL, $value = NULL)
    {
        if (is_array($key))
        {
            $this->cookies = $key;

            return $this;
        }

        $this->cookies[$key] = (string) $value;

        return $this;
    }

    /**
     * Gets or sets the HTTP body of the request.
     *
     * @param   string  $content Content to set to the object
     * @return  mixed
     */
    public function body($content = NULL)
    {
        if ($content === NULL)
        {
            // Act as a getter
            return $this->body;
        }

        // Act as a setter
        $this->body = $content;

        return $this;
    }


    /**
     * Gets or sets HTTP query string.
     *
     * @param   mixed   $key    Key
     * @param   string  $value  Value to set to a key
     * @return  mixed
     */
    public function query($key = NULL, $value = NULL)
    {
        if (is_array($key))
        {
            $this->get = $key;

            return $this;
        }

        $this->get[$key] = $value;

        return $this;
    }

    /**
     * Gets or sets HTTP POST parameters to the request.
     *
     * @param   mixed  $key
     * @param   string $value  Value
     * @return  mixed
     */
    public function post($key = NULL, $value = NULL)
    {

        if (is_array($key))
        {
            $this->post = $key;

            return $this;
        }

        $this->post[$key] = $value;

        return $this;
    }

}