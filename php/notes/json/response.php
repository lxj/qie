<?php
function gbk2utf8($data)
{
    if (is_array($data))
    {
        return array_map('gbk2utf8', $data);
    }
    else if (is_object($data))
    {
        return array_map('gbk2utf8', get_object_vars($data));
    }
    return mb_convert_encoding($data, 'UTF-8', 'GBK');
}

class Response
{
    // CONTENT TYPE
    const JSON = 'application/json';
    const HTML = 'text/html';
    const JAVASCRIPT = 'text/javascript';
    const JS   = 'text/javascript';
    const TEXT = 'text/plain';
    const XML  = 'text/xml';

    static public $response_type = null;

    static public function JSON($code, $data = array(), $content_type = Response::JSON)
    {
        self::$response_type = Response::JSON;

		if($content_type!==null){
			header("Content-type: " . $content_type);
		}

        if (is_object($data))
            $data = get_object_vars($data);
        else if (! is_array($data))
            $data = array();

        $data['retCode'] = $code;
        return htmlspecialchars(json_encode(gbk2utf8($data)), ENT_NOQUOTES);
    }

    static public function HTML($code, $data = array(), $content_type = Response::JSON)
    {
        self::$response_type = Response::HTML;

        header("Content-type: " . $content_type);

        if (is_object($data))
            $data = get_object_vars($data);
        else if (! is_array($data))
            $data = array();

        $data['retCode'] = $code;
        return json_encode(gbk2utf8($data));
    }
}

?>