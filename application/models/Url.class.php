<?php
/**
 * Description of Url
 *
 * @author Hait
 */
class Url {
    
    private $urlArguments;
    
    public
    function setUrlArguments($urlArguments) {
        $this->urlArguments = $urlArguments;
    }
    
    public
    function parserUrl() 
    {
        try 
        {
            $uri = (($uri = prepareRequestUri()) && !empty($uri)) 
                ? prepareRequestUri() : throwException('URI doesn\'t be null ! A problem has occured.');
            $url = (($url = prepareBaseUrl()) && !empty($url)) 
                ? prepareBaseUrl() : throwException('URL doesn\'t be null ! A problem has occured.');

            $uriFiltered = str_replace($url, '', $uri);
            $uriArgs = explode('/', $uriFiltered);

            (is_array($uriArgs)) ? cleanArray($uriArgs, '') : throwException('URL arguments doesn\'t be null !');

            return $uriArgs;

        } catch (Exception $e) {
            print $e->getMessage();
        }
    }
    
    public 
    static function getBaseUrl() {
        return str_replace(prepareRequestUri(), '', currentURL()).prepareBaseUrl();
    }
}

?>
