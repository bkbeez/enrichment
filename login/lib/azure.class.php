<?php
/**
 * Azure Class
 */
class Azure {
    private $AZURE_APP_ID = AZURE_APP_ID;
    private $AZURE_APP_SECRET = AZURE_APP_SECRET;
    private $AZURE_AUTHORIZE_URL = AZURE_AUTHORIZE_URL;
    private $AZURE_TOKEN_URL = AZURE_TOKEN_URL;
    private $AZURE_BASICINFO_URL = AZURE_BASICINFO_URL;
    private $AZURE_CALLBACK_URL = null;
    private $AZURE_SCOPE = null;
    private $AZURE_STATE = null;

    function __construct($callback_url=null)
    {
        if($callback_url!==null) $this->AZURE_CALLBACK_URL = $callback_url;
    }

    function setCallbackUri($uri)
    {
        $this->AZURE_CALLBACK_URL = $uri;
    }

    function setScope($scope)
    {
        $this->AZURE_SCOPE = $scope;
    }

    function setState()
    {
        $this->AZURE_STATE = md5(uniqid(rand(), TRUE));
        return $this->AZURE_STATE;
    }

    function initAzure()
    {
        header("location: $this->AZURE_AUTHORIZE_URL?response_type=code&client_id=$this->AZURE_APP_ID&redirect_uri=$this->AZURE_CALLBACK_URL&scope=$this->AZURE_SCOPE&state=$this->AZURE_STATE");
        exit();
    }

    function getAccessTokenAuthCode($code)
    {
        $data = [
            'grant_type' => 'authorization_code',
            'client_id' => $this->AZURE_APP_ID,
            'client_secret' => $this->AZURE_APP_SECRET,
            'redirect_uri' => $this->AZURE_CALLBACK_URL,
            'scope' => $this->AZURE_SCOPE,
            'code' => $code
        ];
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->AZURE_TOKEN_URL);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); 
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); 
        curl_setopt($curl, CURLOPT_POST, 1); 
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);
        return json_decode($result);
    }

    function getAccessTokenClientCred()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->AZURE_TOKEN_URL);
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_USERPWD, $this->AZURE_APP_ID.":".$this->AZURE_APP_SECRET);
        curl_setopt($curl, CURLOPT_POSTFIELDS, "grant_type=client_credentials"."&scope=$this->AZURE_SCOPE");
        $result = curl_exec($curl);
        curl_close($curl);
        return json_decode($result);
    }

}
?>