<?php

abstract class Parametrs
{
    /**
     * @var
     */
    public $header;

    /**
     *Get post, query or header by name
     *
     * @param string $name
     * @param array $array
     * @return string
     */

    public function getByName($name, $array)
    {
        if (array_key_exists($name, $array))
        {
            return $array[$name];
        }

    }

    /**
     *Headers
     *
     * @param mixed $key
     * @param string $value
     * @return mixed
     */
    public function headers($key = NULL, $value = NULL)
    {
        $this->header[$key] = $value;
        return $this;

    }

}