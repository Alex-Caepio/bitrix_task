<?php
namespace intec\core\web;

use intec\Core;
use intec\core\base\Component;
use intec\core\base\InvalidConfigException;

/**
 * Request represents a request that is handled by an [[Application]].
 *
 * For more details and usage information on Request, see the [guide article on requests](guide:runtime-requests).
 *
 * @property bool $isConsoleRequest The value indicating whether the current request is made via console.
 * @property string $scriptFile Entry script file path (processed w/ realpath()).
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class Request extends Component
{
    private $_cookies;
    private $_headers;

    public $parsers = [];

    public $methodParam = '_method';

    /**
     * Returns the header collection.
     * The header collection contains incoming HTTP headers.
     * @return HeaderCollection the header collection
     */
    public function getHeaders()
    {
        if ($this->_headers === null) {
            $this->_headers = new HeaderCollection();
            if (function_exists('getallheaders')) {
                $headers = getallheaders();
            } elseif (function_exists('http_get_request_headers')) {
                $headers = http_get_request_headers();
            } else {
                foreach ($_SERVER as $name => $value) {
                    if (strncmp($name, 'HTTP_', 5) === 0) {
                        $name = str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))));
                        $this->_headers->add($name, $value);
                    }
                }

                return $this->_headers;
            }
            foreach ($headers as $name => $value) {
                $this->_headers->add($name, $value);
            }
        }

        return $this->_headers;
    }

    /**
     * Returns the method of the current request (e.g. GET, POST, HEAD, PUT, PATCH, DELETE).
     * @return string request method, such as GET, POST, HEAD, PUT, PATCH, DELETE.
     * The value returned is turned into upper case.
     */
    public function getMethod()
    {
        if (isset($_POST[$this->methodParam])) {
            return strtoupper($_POST[$this->methodParam]);
        }

        if (isset($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'])) {
            return strtoupper($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE']);
        }

        if (isset($_SERVER['REQUEST_METHOD'])) {
            return strtoupper($_SERVER['REQUEST_METHOD']);
        }

        return 'GET';
    }

    /**
     * Returns whether this is a GET request.
     * @return bool whether this is a GET request.
     */
    public function getIsGet()
    {
        return $this->getMethod() === 'GET';
    }

    /**
     * Returns whether this is an OPTIONS request.
     * @return bool whether this is a OPTIONS request.
     */
    public function getIsOptions()
    {
        return $this->getMethod() === 'OPTIONS';
    }

    /**
     * Returns whether this is a HEAD request.
     * @return bool whether this is a HEAD request.
     */
    public function getIsHead()
    {
        return $this->getMethod() === 'HEAD';
    }

    /**
     * Returns whether this is a POST request.
     * @return bool whether this is a POST request.
     */
    public function getIsPost()
    {
        return $this->getMethod() === 'POST';
    }

    /**
     * Returns whether this is a DELETE request.
     * @return bool whether this is a DELETE request.
     */
    public function getIsDelete()
    {
        return $this->getMethod() === 'DELETE';
    }

    /**
     * Returns whether this is a PUT request.
     * @return bool whether this is a PUT request.
     */
    public function getIsPut()
    {
        return $this->getMethod() === 'PUT';
    }

    /**
     * Returns whether this is a PATCH request.
     * @return bool whether this is a PATCH request.
     */
    public function getIsPatch()
    {
        return $this->getMethod() === 'PATCH';
    }

    /**
     * Returns whether this is an AJAX (XMLHttpRequest) request.
     *
     * Note that jQuery doesn't set the header in case of cross domain
     * requests: https://stackoverflow.com/questions/8163703/cross-domain-ajax-doesnt-send-x-requested-with-header
     *
     * @return bool whether this is an AJAX (XMLHttpRequest) request.
     */
    public function getIsAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    /**
     * Returns whether this is a PJAX request
     * @return bool whether this is a PJAX request
     */
    public function getIsPjax()
    {
        return $this->getIsAjax() && !empty($_SERVER['HTTP_X_PJAX']);
    }

    /**
     * Returns whether this is an Adobe Flash or Flex request.
     * @return bool whether this is an Adobe Flash or Adobe Flex request.
     */
    public function getIsFlash()
    {
        return isset($_SERVER['HTTP_USER_AGENT']) &&
            (stripos($_SERVER['HTTP_USER_AGENT'], 'Shockwave') !== false || stripos($_SERVER['HTTP_USER_AGENT'], 'Flash') !== false);
    }

    private $_rawBody;

    /**
     * Returns the raw HTTP request body.
     * @return string the request body
     */
    public function getRawBody()
    {
        if ($this->_rawBody === null) {
            $this->_rawBody = file_get_contents('php://input');
        }

        return $this->_rawBody;
    }

    /**
     * Sets the raw HTTP request body, this method is mainly used by test scripts to simulate raw HTTP requests.
     * @param string $rawBody the request body
     */
    public function setRawBody($rawBody)
    {
        $this->_rawBody = $rawBody;
    }

    private $_bodyParams;

    /**
     * Returns the request parameters given in the request body.
     *
     * Request parameters are determined using the parsers configured in [[parsers]] property.
     * If no parsers are configured for the current [[contentType]] it uses the PHP function `mb_parse_str()`
     * to parse the [[rawBody|request body]].
     * @return array the request parameters given in the request body.
     * @throws InvalidConfigException if a registered parser does not implement the [[RequestParserInterface]].
     * @see getMethod()
     * @see getBodyParam()
     * @see setBodyParams()
     */
    public function getBodyParams()
    {
        if ($this->_bodyParams === null) {
            if (isset($_POST[$this->methodParam])) {
                $this->_bodyParams = $_POST;
                unset($this->_bodyParams[$this->methodParam]);
                return $this->_bodyParams;
            }

            $rawContentType = $this->getContentType();
            if (($pos = strpos($rawContentType, ';')) !== false) {
                // e.g. application/json; charset=UTF-8
                $contentType = substr($rawContentType, 0, $pos);
            } else {
                $contentType = $rawContentType;
            }

            if (isset($this->parsers[$contentType])) {
                $parser = Core::createObject($this->parsers[$contentType]);
                if (!($parser instanceof RequestParserInterface)) {
                    throw new InvalidConfigException("The '$contentType' request parser is invalid. It must implement the yii\\web\\RequestParserInterface.");
                }
                $this->_bodyParams = $parser->parse($this->getRawBody(), $rawContentType);
            } elseif (isset($this->parsers['*'])) {
                $parser = Core::createObject($this->parsers['*']);
                if (!($parser instanceof RequestParserInterface)) {
                    throw new InvalidConfigException("The fallback request parser is invalid. It must implement the yii\\web\\RequestParserInterface.");
                }
                $this->_bodyParams = $parser->parse($this->getRawBody(), $rawContentType);
            } elseif ($this->getMethod() === 'POST') {
                // PHP has already parsed the body so we have all params in $_POST
                $this->_bodyParams = $_POST;
            } else {
                $this->_bodyParams = [];
                mb_parse_str($this->getRawBody(), $this->_bodyParams);
            }
        }

        return $this->_bodyParams;
    }

    /**
     * Sets the request body parameters.
     * @param array $values the request body parameters (name-value pairs)
     * @see getBodyParam()
     * @see getBodyParams()
     */
    public function setBodyParams($values)
    {
        $this->_bodyParams = $values;
    }

    /**
     * Returns the named request body parameter value.
     * If the parameter does not exist, the second parameter passed to this method will be returned.
     * @param string $name the parameter name
     * @param mixed $defaultValue the default parameter value if the parameter does not exist.
     * @return mixed the parameter value
     * @see getBodyParams()
     * @see setBodyParams()
     */
    public function getBodyParam($name, $defaultValue = null)
    {
        $params = $this->getBodyParams();

        return isset($params[$name]) ? $params[$name] : $defaultValue;
    }

    /**
     * Returns POST parameter with a given name. If name isn't specified, returns an array of all POST parameters.
     *
     * @param string $name the parameter name
     * @param mixed $defaultValue the default parameter value if the parameter does not exist.
     * @return array|mixed
     */
    public function post($name = null, $defaultValue = null)
    {
        if ($name === null) {
            return $this->getBodyParams();
        } else {
            return $this->getBodyParam($name, $defaultValue);
        }
    }

    private $_queryParams;

    /**
     * Returns the request parameters given in the [[queryString]].
     *
     * This method will return the contents of `$_GET` if params where not explicitly set.
     * @return array the request GET parameter values.
     * @see setQueryParams()
     */
    public function getQueryParams()
    {
        if ($this->_queryParams === null) {
            return $_GET;
        }

        return $this->_queryParams;
    }

    /**
     * Sets the request [[queryString]] parameters.
     * @param array $values the request query parameters (name-value pairs)
     * @see getQueryParam()
     * @see getQueryParams()
     */
    public function setQueryParams($values)
    {
        $this->_queryParams = $values;
    }

    /**
     * Returns GET parameter with a given name. If name isn't specified, returns an array of all GET parameters.
     *
     * @param string $name the parameter name
     * @param mixed $defaultValue the default parameter value if the parameter does not exist.
     * @return array|mixed
     */
    public function get($name = null, $defaultValue = null)
    {
        if ($name === null) {
            return $this->getQueryParams();
        } else {
            return $this->getQueryParam($name, $defaultValue);
        }
    }

    /**
     * Returns the named GET parameter value.
     * If the GET parameter does not exist, the second parameter passed to this method will be returned.
     * @param string $name the GET parameter name.
     * @param mixed $defaultValue the default parameter value if the GET parameter does not exist.
     * @return mixed the GET parameter value
     * @see getBodyParam()
     */
    public function getQueryParam($name, $defaultValue = null)
    {
        $params = $this->getQueryParams();

        return isset($params[$name]) ? $params[$name] : $defaultValue;
    }

    private $_hostInfo;
    private $_hostName;

    /**
     * Returns the schema and host part of the current request URL.
     *
     * The returned URL does not have an ending slash.
     *
     * By default this value is based on the user request information. This method will
     * return the value of `$_SERVER['HTTP_HOST']` if it is available or `$_SERVER['SERVER_NAME']` if not.
     * You may want to check out the [PHP documentation](http://php.net/manual/en/reserved.variables.server.php)
     * for more information on these variables.
     *
     * You may explicitly specify it by setting the [[setHostInfo()|hostInfo]] property.
     *
     * > Warning: Dependent on the server configuration this information may not be
     * > reliable and [may be faked by the user sending the HTTP request](https://www.acunetix.com/vulnerabilities/web/host-header-attack).
     * > If the webserver is configured to serve the same site independent of the value of
     * > the `Host` header, this value is not reliable. In such situations you should either
     * > fix your webserver configuration or explicitly set the value by setting the [[setHostInfo()|hostInfo]] property.
     * > If you don't have access to the server configuration, you can setup [[\yii\filters\HostControl]] filter at
     * > application level in order to protect against such kind of attack.
     *
     * @property string|null schema and hostname part (with port number if needed) of the request URL
     * (e.g. `http://www.yiiframework.com`), null if can't be obtained from `$_SERVER` and wasn't set.
     * See [[getHostInfo()]] for security related notes on this property.
     * @return string|null schema and hostname part (with port number if needed) of the request URL
     * (e.g. `http://www.yiiframework.com`), null if can't be obtained from `$_SERVER` and wasn't set.
     * @see setHostInfo()
     */
    public function getHostInfo()
    {
        if ($this->_hostInfo === null) {
            $secure = $this->getIsSecureConnection();
            $http = $secure ? 'https' : 'http';
            if (isset($_SERVER['HTTP_HOST'])) {
                $this->_hostInfo = $http . '://' . $_SERVER['HTTP_HOST'];
            } elseif (isset($_SERVER['SERVER_NAME'])) {
                $this->_hostInfo = $http . '://' . $_SERVER['SERVER_NAME'];
                $port = $secure ? $this->getSecurePort() : $this->getPort();
                if (($port !== 80 && !$secure) || ($port !== 443 && $secure)) {
                    $this->_hostInfo .= ':' . $port;
                }
            }
        }

        return $this->_hostInfo;
    }

    /**
     * Sets the schema and host part of the application URL.
     * This setter is provided in case the schema and hostname cannot be determined
     * on certain Web servers.
     * @param string|null $value the schema and host part of the application URL. The trailing slashes will be removed.
     * @see getHostInfo() for security related notes on this property.
     */
    public function setHostInfo($value)
    {
        $this->_hostName = null;
        $this->_hostInfo = $value === null ? null : rtrim($value, '/');
    }

    /**
     * Returns the host part of the current request URL.
     * Value is calculated from current [[getHostInfo()|hostInfo]] property.
     *
     * > Warning: The content of this value may not be reliable, dependent on the server
     * > configuration. Please refer to [[getHostInfo()]] for more information.
     *
     * @return string|null hostname part of the request URL (e.g. `www.yiiframework.com`)
     * @see getHostInfo()
     * @since 2.0.10
     */
    public function getHostName()
    {
        if ($this->_hostName === null) {
            $this->_hostName = parse_url($this->getHostInfo(), PHP_URL_HOST);
        }

        return $this->_hostName;
    }

    private $_baseUrl;

    /**
     * Returns the relative URL for the application.
     * This is similar to [[scriptUrl]] except that it does not include the script file name,
     * and the ending slashes are removed.
     * @return string the relative URL for the application
     * @see setScriptUrl()
     */
    public function getBaseUrl()
    {
        if ($this->_baseUrl === null) {
            $this->_baseUrl = rtrim(dirname($this->getScriptUrl()), '\\/');
        }

        return $this->_baseUrl;
    }

    /**
     * Sets the relative URL for the application.
     * By default the URL is determined based on the entry script URL.
     * This setter is provided in case you want to change this behavior.
     * @param string $value the relative URL for the application
     */
    public function setBaseUrl($value)
    {
        $this->_baseUrl = $value;
    }

    private $_scriptUrl;

    /**
     * Returns the relative URL of the entry script.
     * The implementation of this method referenced Zend_Controller_Request_Http in Zend Framework.
     * @return string the relative URL of the entry script.
     * @throws InvalidConfigException if unable to determine the entry script URL
     */
    public function getScriptUrl()
    {
        if ($this->_scriptUrl === null) {
            $scriptFile = $this->getScriptFile();
            $scriptName = basename($scriptFile);
            if (isset($_SERVER['SCRIPT_NAME']) && basename($_SERVER['SCRIPT_NAME']) === $scriptName) {
                $this->_scriptUrl = $_SERVER['SCRIPT_NAME'];
            } elseif (isset($_SERVER['PHP_SELF']) && basename($_SERVER['PHP_SELF']) === $scriptName) {
                $this->_scriptUrl = $_SERVER['PHP_SELF'];
            } elseif (isset($_SERVER['ORIG_SCRIPT_NAME']) && basename($_SERVER['ORIG_SCRIPT_NAME']) === $scriptName) {
                $this->_scriptUrl = $_SERVER['ORIG_SCRIPT_NAME'];
            } elseif (isset($_SERVER['PHP_SELF']) && ($pos = strpos($_SERVER['PHP_SELF'], '/' . $scriptName)) !== false) {
                $this->_scriptUrl = substr($_SERVER['SCRIPT_NAME'], 0, $pos) . '/' . $scriptName;
            } elseif (!empty($_SERVER['DOCUMENT_ROOT']) && strpos($scriptFile, $_SERVER['DOCUMENT_ROOT']) === 0) {
                $this->_scriptUrl = str_replace('\\', '/', str_replace($_SERVER['DOCUMENT_ROOT'], '', $scriptFile));
            } else {
                throw new InvalidConfigException('Unable to determine the entry script URL.');
            }
        }

        return $this->_scriptUrl;
    }

    /**
     * Sets the relative URL for the application entry script.
     * This setter is provided in case the entry script URL cannot be determined
     * on certain Web servers.
     * @param string $value the relative URL for the application entry script.
     */
    public function setScriptUrl($value)
    {
        $this->_scriptUrl = $value === null ? null : '/' . trim($value, '/');
    }

    private $_scriptFile;

    /**
     * Returns the entry script file path.
     * The default implementation will simply return `$_SERVER['SCRIPT_FILENAME']`.
     * @return string the entry script file path
     * @throws InvalidConfigException
     */
    public function getScriptFile()
    {
        if (isset($this->_scriptFile)) {
            return $this->_scriptFile;
        } elseif (isset($_SERVER['SCRIPT_FILENAME'])) {
            return $_SERVER['SCRIPT_FILENAME'];
        } else {
            throw new InvalidConfigException('Unable to determine the entry script file path.');
        }
    }

    /**
     * Sets the entry script file path.
     * The entry script file path normally can be obtained from `$_SERVER['SCRIPT_FILENAME']`.
     * If your server configuration does not return the correct value, you may configure
     * this property to make it right.
     * @param string $value the entry script file path.
     */
    public function setScriptFile($value)
    {
        $this->_scriptFile = $value;
    }

    private $_pathInfo;

    /**
     * Returns the path info of the currently requested URL.
     * A path info refers to the part that is after the entry script and before the question mark (query string).
     * The starting and ending slashes are both removed.
     * @return string part of the request URL that is after the entry script and before the question mark.
     * Note, the returned path info is already URL-decoded.
     * @throws InvalidConfigException if the path info cannot be determined due to unexpected server configuration
     */
    public function getPathInfo()
    {
        if ($this->_pathInfo === null) {
            $this->_pathInfo = $this->resolvePathInfo();
        }

        return $this->_pathInfo;
    }

    /**
     * Sets the path info of the current request.
     * This method is mainly provided for testing purpose.
     * @param string $value the path info of the current request
     */
    public function setPathInfo($value)
    {
        $this->_pathInfo = $value === null ? null : ltrim($value, '/');
    }

    /**
     * Resolves the path info part of the currently requested URL.
     * A path info refers to the part that is after the entry script and before the question mark (query string).
     * The starting slashes are both removed (ending slashes will be kept).
     * @return string part of the request URL that is after the entry script and before the question mark.
     * Note, the returned path info is decoded.
     * @throws InvalidConfigException if the path info cannot be determined due to unexpected server configuration
     */
    protected function resolvePathInfo()
    {
        $pathInfo = $this->getUrl();

        if (($pos = strpos($pathInfo, '?')) !== false) {
            $pathInfo = substr($pathInfo, 0, $pos);
        }

        $pathInfo = urldecode($pathInfo);

        // try to encode in UTF8 if not so
        // http://w3.org/International/questions/qa-forms-utf-8.html
        if (!preg_match('%^(?:
            [\x09\x0A\x0D\x20-\x7E]              # ASCII
            | [\xC2-\xDF][\x80-\xBF]             # non-overlong 2-byte
            | \xE0[\xA0-\xBF][\x80-\xBF]         # excluding overlongs
            | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}  # straight 3-byte
            | \xED[\x80-\x9F][\x80-\xBF]         # excluding surrogates
            | \xF0[\x90-\xBF][\x80-\xBF]{2}      # planes 1-3
            | [\xF1-\xF3][\x80-\xBF]{3}          # planes 4-15
            | \xF4[\x80-\x8F][\x80-\xBF]{2}      # plane 16
            )*$%xs', $pathInfo)
        ) {
            $pathInfo = utf8_encode($pathInfo);
        }

        if (substr($pathInfo, 0, 1) === '/') {
            $pathInfo = substr($pathInfo, 1);
        }

        return (string) $pathInfo;
    }

    /**
     * Returns the currently requested absolute URL.
     * This is a shortcut to the concatenation of [[hostInfo]] and [[url]].
     * @return string the currently requested absolute URL.
     */
    public function getAbsoluteUrl()
    {
        return $this->getHostInfo() . $this->getUrl();
    }

    private $_url;

    /**
     * Returns the currently requested relative URL.
     * This refers to the portion of the URL that is after the [[hostInfo]] part.
     * It includes the [[queryString]] part if any.
     * @return string the currently requested relative URL. Note that the URI returned is URL-encoded.
     * @throws InvalidConfigException if the URL cannot be determined due to unusual server configuration
     */
    public function getUrl()
    {
        if ($this->_url === null) {
            $this->_url = $this->resolveRequestUri();
        }

        return $this->_url;
    }

    /**
     * Sets the currently requested relative URL.
     * The URI must refer to the portion that is after [[hostInfo]].
     * Note that the URI should be URL-encoded.
     * @param string $value the request URI to be set
     */
    public function setUrl($value)
    {
        $this->_url = $value;
    }

    /**
     * Resolves the request URI portion for the currently requested URL.
     * This refers to the portion that is after the [[hostInfo]] part. It includes the [[queryString]] part if any.
     * The implementation of this method referenced Zend_Controller_Request_Http in Zend Framework.
     * @return string|bool the request URI portion for the currently requested URL.
     * Note that the URI returned is URL-encoded.
     * @throws InvalidConfigException if the request URI cannot be determined due to unusual server configuration
     */
    protected function resolveRequestUri()
    {
        if (isset($_SERVER['HTTP_X_REWRITE_URL'])) { // IIS
            $requestUri = $_SERVER['HTTP_X_REWRITE_URL'];
        } elseif (isset($_SERVER['REQUEST_URI'])) {
            $requestUri = $_SERVER['REQUEST_URI'];
            if ($requestUri !== '' && $requestUri[0] !== '/') {
                $requestUri = preg_replace('/^(http|https):\/\/[^\/]+/i', '', $requestUri);
            }
        } elseif (isset($_SERVER['ORIG_PATH_INFO'])) { // IIS 5.0 CGI
            $requestUri = $_SERVER['ORIG_PATH_INFO'];
            if (!empty($_SERVER['QUERY_STRING'])) {
                $requestUri .= '?' . $_SERVER['QUERY_STRING'];
            }
        } else {
            throw new InvalidConfigException('Unable to determine the request URI.');
        }

        return $requestUri;
    }

    /**
     * Returns part of the request URL that is after the question mark.
     * @return string part of the request URL that is after the question mark
     */
    public function getQueryString()
    {
        return isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '';
    }

    /**
     * Return if the request is sent via secure channel (https).
     * @return bool if the request is sent via secure channel (https)
     */
    public function getIsSecureConnection()
    {
        return isset($_SERVER['HTTPS']) && (strcasecmp($_SERVER['HTTPS'], 'on') === 0 || $_SERVER['HTTPS'] == 1)
            || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strcasecmp($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') === 0;
    }

    /**
     * Returns the server name.
     * @return string server name, null if not available
     */
    public function getServerName()
    {
        return isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : null;
    }

    /**
     * Returns the server port number.
     * @return int|null server port number, null if not available
     */
    public function getServerPort()
    {
        return isset($_SERVER['SERVER_PORT']) ? (int) $_SERVER['SERVER_PORT'] : null;
    }

    /**
     * Returns the URL referrer.
     * @return string|null URL referrer, null if not available
     */
    public function getReferrer()
    {
        return isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;
    }

    /**
     * Returns the user agent.
     * @return string|null user agent, null if not available
     */
    public function getUserAgent()
    {
        return isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : null;
    }

    /**
     * Returns the user IP address.
     * @return string|null user IP address, null if not available
     */
    public function getUserIP()
    {
        return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null;
    }

    /**
     * Returns the user host name.
     * @return string|null user host name, null if not available
     */
    public function getUserHost()
    {
        return isset($_SERVER['REMOTE_HOST']) ? $_SERVER['REMOTE_HOST'] : null;
    }

    /**
     * @return string|null the username sent via HTTP authentication, null if the username is not given
     */
    public function getAuthUser()
    {
        return isset($_SERVER['PHP_AUTH_USER']) ? $_SERVER['PHP_AUTH_USER'] : null;
    }

    /**
     * @return string|null the password sent via HTTP authentication, null if the password is not given
     */
    public function getAuthPassword()
    {
        return isset($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : null;
    }

    private $_port;

    /**
     * Returns the port to use for insecure requests.
     * Defaults to 80, or the port specified by the server if the current
     * request is insecure.
     * @return int port number for insecure requests.
     * @see setPort()
     */
    public function getPort()
    {
        if ($this->_port === null) {
            $this->_port = !$this->getIsSecureConnection() && isset($_SERVER['SERVER_PORT']) ? (int) $_SERVER['SERVER_PORT'] : 80;
        }

        return $this->_port;
    }

    /**
     * Sets the port to use for insecure requests.
     * This setter is provided in case a custom port is necessary for certain
     * server configurations.
     * @param int $value port number.
     */
    public function setPort($value)
    {
        if ($value != $this->_port) {
            $this->_port = (int) $value;
            $this->_hostInfo = null;
        }
    }

    private $_securePort;

    /**
     * Returns the port to use for secure requests.
     * Defaults to 443, or the port specified by the server if the current
     * request is secure.
     * @return int port number for secure requests.
     * @see setSecurePort()
     */
    public function getSecurePort()
    {
        if ($this->_securePort === null) {
            $this->_securePort = $this->getIsSecureConnection() && isset($_SERVER['SERVER_PORT']) ? (int) $_SERVER['SERVER_PORT'] : 443;
        }

        return $this->_securePort;
    }

    /**
     * Sets the port to use for secure requests.
     * This setter is provided in case a custom port is necessary for certain
     * server configurations.
     * @param int $value port number.
     */
    public function setSecurePort($value)
    {
        if ($value != $this->_securePort) {
            $this->_securePort = (int) $value;
            $this->_hostInfo = null;
        }
    }

    private $_contentTypes;

    /**
     * Returns the content types acceptable by the end user.
     * This is determined by the `Accept` HTTP header. For example,
     *
     * ```php
     * $_SERVER['HTTP_ACCEPT'] = 'text/plain; q=0.5, application/json; version=1.0, application/xml; version=2.0;';
     * $types = $request->getAcceptableContentTypes();
     * print_r($types);
     * // displays:
     * // [
     * //     'application/json' => ['q' => 1, 'version' => '1.0'],
     * //      'application/xml' => ['q' => 1, 'version' => '2.0'],
     * //           'text/plain' => ['q' => 0.5],
     * // ]
     * ```
     *
     * @return array the content types ordered by the quality score. Types with the highest scores
     * will be returned first. The array keys are the content types, while the array values
     * are the corresponding quality score and other parameters as given in the header.
     */
    public function getAcceptableContentTypes()
    {
        if ($this->_contentTypes === null) {
            if (isset($_SERVER['HTTP_ACCEPT'])) {
                $this->_contentTypes = $this->parseAcceptHeader($_SERVER['HTTP_ACCEPT']);
            } else {
                $this->_contentTypes = [];
            }
        }

        return $this->_contentTypes;
    }

    /**
     * Sets the acceptable content types.
     * Please refer to [[getAcceptableContentTypes()]] on the format of the parameter.
     * @param array $value the content types that are acceptable by the end user. They should
     * be ordered by the preference level.
     * @see getAcceptableContentTypes()
     * @see parseAcceptHeader()
     */
    public function setAcceptableContentTypes($value)
    {
        $this->_contentTypes = $value;
    }

    /**
     * Returns request content-type
     * The Content-Type header field indicates the MIME type of the data
     * contained in [[getRawBody()]] or, in the case of the HEAD method, the
     * media type that would have been sent had the request been a GET.
     * For the MIME-types the user expects in response, see [[acceptableContentTypes]].
     * @return string request content-type. Null is returned if this information is not available.
     * @link http://www.w3.org/Protocols/rfc2616/rfc2616-sec14.html#sec14.17
     * HTTP 1.1 header field definitions
     */
    public function getContentType()
    {
        if (isset($_SERVER['CONTENT_TYPE'])) {
            return $_SERVER['CONTENT_TYPE'];
        } elseif (isset($_SERVER['HTTP_CONTENT_TYPE'])) {
            //fix bug https://bugs.php.net/bug.php?id=66606
            return $_SERVER['HTTP_CONTENT_TYPE'];
        }

        return null;
    }

    private $_languages;

    /**
     * Returns the languages acceptable by the end user.
     * This is determined by the `Accept-Language` HTTP header.
     * @return array the languages ordered by the preference level. The first element
     * represents the most preferred language.
     */
    public function getAcceptableLanguages()
    {
        if ($this->_languages === null) {
            if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
                $this->_languages = array_keys($this->parseAcceptHeader($_SERVER['HTTP_ACCEPT_LANGUAGE']));
            } else {
                $this->_languages = [];
            }
        }

        return $this->_languages;
    }

    /**
     * @param array $value the languages that are acceptable by the end user. They should
     * be ordered by the preference level.
     */
    public function setAcceptableLanguages($value)
    {
        $this->_languages = $value;
    }

    /**
     * Parses the given `Accept` (or `Accept-Language`) header.
     *
     * This method will return the acceptable values with their quality scores and the corresponding parameters
     * as specified in the given `Accept` header. The array keys of the return value are the acceptable values,
     * while the array values consisting of the corresponding quality scores and parameters. The acceptable
     * values with the highest quality scores will be returned first. For example,
     *
     * ```php
     * $header = 'text/plain; q=0.5, application/json; version=1.0, application/xml; version=2.0;';
     * $accepts = $request->parseAcceptHeader($header);
     * print_r($accepts);
     * // displays:
     * // [
     * //     'application/json' => ['q' => 1, 'version' => '1.0'],
     * //      'application/xml' => ['q' => 1, 'version' => '2.0'],
     * //           'text/plain' => ['q' => 0.5],
     * // ]
     * ```
     *
     * @param string $header the header to be parsed
     * @return array the acceptable values ordered by their quality score. The values with the highest scores
     * will be returned first.
     */
    public function parseAcceptHeader($header)
    {
        $accepts = [];
        foreach (explode(',', $header) as $i => $part) {
            $params = preg_split('/\s*;\s*/', trim($part), -1, PREG_SPLIT_NO_EMPTY);
            if (empty($params)) {
                continue;
            }
            $values = [
                'q' => [$i, array_shift($params), 1],
            ];
            foreach ($params as $param) {
                if (strpos($param, '=') !== false) {
                    list ($key, $value) = explode('=', $param, 2);
                    if ($key === 'q') {
                        $values['q'][2] = (double) $value;
                    } else {
                        $values[$key] = $value;
                    }
                } else {
                    $values[] = $param;
                }
            }
            $accepts[] = $values;
        }

        usort($accepts, function ($a, $b) {
            $a = $a['q']; // index, name, q
            $b = $b['q'];
            if ($a[2] > $b[2]) {
                return -1;
            } elseif ($a[2] < $b[2]) {
                return 1;
            } elseif ($a[1] === $b[1]) {
                return $a[0] > $b[0] ? 1 : -1;
            } elseif ($a[1] === '*/*') {
                return 1;
            } elseif ($b[1] === '*/*') {
                return -1;
            } else {
                $wa = $a[1][strlen($a[1]) - 1] === '*';
                $wb = $b[1][strlen($b[1]) - 1] === '*';
                if ($wa xor $wb) {
                    return $wa ? 1 : -1;
                } else {
                    return $a[0] > $b[0] ? 1 : -1;
                }
            }
        });

        $result = [];
        foreach ($accepts as $accept) {
            $name = $accept['q'][1];
            $accept['q'] = $accept['q'][2];
            $result[$name] = $accept;
        }

        return $result;
    }

    /**
     * Returns the user-preferred language that should be used by this application.
     * The language resolution is based on the user preferred languages and the languages
     * supported by the application. The method will try to find the best match.
     * @param array $languages a list of the languages supported by the application. If this is empty, the current
     * application language will be returned without further processing.
     * @return string the language that the application should use.
     */
    public function getPreferredLanguage(array $languages = [])
    {
        if (empty($languages)) {
            return Core::$app->language;
        }
        foreach ($this->getAcceptableLanguages() as $acceptableLanguage) {
            $acceptableLanguage = str_replace('_', '-', strtolower($acceptableLanguage));
            foreach ($languages as $language) {
                $normalizedLanguage = str_replace('_', '-', strtolower($language));

                if ($normalizedLanguage === $acceptableLanguage || // en-us==en-us
                    strpos($acceptableLanguage, $normalizedLanguage . '-') === 0 || // en==en-us
                    strpos($normalizedLanguage, $acceptableLanguage . '-') === 0) { // en-us==en

                    return $language;
                }
            }
        }

        return reset($languages);
    }

    /**
     * Gets the Etags.
     *
     * @return array The entity tags
     */
    public function getETags()
    {
        if (isset($_SERVER['HTTP_IF_NONE_MATCH'])) {
            return preg_split('/[\s,]+/', str_replace('-gzip', '', $_SERVER['HTTP_IF_NONE_MATCH']), -1, PREG_SPLIT_NO_EMPTY);
        } else {
            return [];
        }
    }

    /**
     * Returns the cookie collection.
     * Through the returned cookie collection, you may access a cookie using the following syntax:
     *
     * ```php
     * $cookie = $request->cookies['name']
     * if ($cookie !== null) {
     *     $value = $cookie->value;
     * }
     *
     * // alternatively
     * $value = $request->cookies->getValue('name');
     * ```
     *
     * @return CookieCollection the cookie collection.
     */
    public function getCookies()
    {
        if ($this->_cookies === null) {
            $this->_cookies = new CookieCollection($this->loadCookies(), [
                'readOnly' => true,
            ]);
        }

        return $this->_cookies;
    }

    /**
     * Converts `$_COOKIE` into an array of [[Cookie]].
     * @return array the cookies obtained from request
     * @throws InvalidConfigException if [[cookieValidationKey]] is not set when [[enableCookieValidation]] is true
     */
    protected function loadCookies()
    {
        $cookies = [];

        foreach ($_COOKIE as $name => $value) {
            $cookies[$name] = new Cookie([
                'name' => $name,
                'value' => $value,
                'expire' => null,
            ]);
        }

        return $cookies;
    }
}
