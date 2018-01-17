<?php

class Mailer
{
    private $to;
    private $object;
    private $template;
    private $data;
    private $headers;

    /**
     * Mailer constructor.
     * @param $to
     * @param $object
     * @param $template
     * @param $data
     */
    public function __construct($to, $object, $template, $data = null)
    {
        $this->to = $to;
        $this->object = $object;
        $this->setTemplate($template);
        $this->headers = "From \"FoodCMS\"<foodcms@foodcms.fr>\r\nMIME-Version:1.0\r\nContent-Type: text/html; charset=utf-8\r\nContent-Transfer-Encoding: 8bit\r\n";

        if (!is_null($data)) {
            $this->data = $data;
            $this->parseData();
        }
    }

    /**
     * @return null
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param null $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param mixed $to
     */
    public function setTo($to)
    {
        $this->to = $to;
    }

    /**
     * @return mixed
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * @param mixed $object
     */
    public function setObject($object)
    {
        $this->object = $object;
    }

    /**
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param mixed $template
     */
    public function setTemplate($template)
    {
        $this->template = file_get_contents("./templates/".$template.".mail.html");
    }

    public function parseData()
    {
        foreach ($this->data as $key => $value) {
            $this->template = str_replace('{{'.$key.'}}', $value, $this->template);
        }
    }

    public function send()
    {
        mail($this->to, $this->object, $this->template, $this->headers);
    }
}
