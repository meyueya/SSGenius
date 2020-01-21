<?php

/**
 * Instagram APIs library
 *
 * @author khanhkid@vinareseach.net
 * @since 20180306 9:40
 */
//https://github.com/facebook/php-graph-sdk
// require 'vendor/autoload.php';
class Helper_GraphAPI
{
    /*
     * Create an array of the urls to be used in api calls
     * The urls contain conversion specifications that will be replaced by sprintf in the functions
     * @var string
     */
    protected $app_id = '177087713398265';
    public $app_secret = "fa41517e01f08bb85f077270f3de3a01";
    protected $_api_urls = array(
        'url' => 'https://graph.facebook.com/v5.0/',
        'access_token_long_time' => '/oauth/access_token?',
        'access_token_redeeming' => '/oauth/client_code?',
        'information_user' => '/me',
        'information_page' => '/me?fields=subscribed_apps,instagram_business_account{name,username,biography,followers_count,follows_count,media_count,profile_picture_url,website}',
        'associate_app_page' => '/%s/subscribed_apps',
        // 'get_data_media' => '%s?fields=media{is_comment_enabled,media_type,media_url,permalink,shortcode,caption,like_count,timestamp,user,username,comments_count,comments{text,timestamp,like_count,replies}}',
        // -- integracion nueva
        // 'get_data_media' => '%s/media?fields=is_comment_enabled,media_type,media_url,permalink,shortcode,caption,like_count,timestamp,user,username,comments_count,comments{text,timestamp,like_count,replies},insights.metric(engagement,impressions,reach,saved)&limit=500&debug=false',
        'get_data_media' => '%s/media?fields=is_comment_enabled,media_type,media_url,permalink,shortcode,caption,like_count,timestamp,user,username,comments_count,comments.limit(500){text,timestamp,like_count,replies}&limit=500',
        'get_page_details' => '%s/fields=subscribed_apps,{name,username,biography,followers_count,follows_count,media_count,profile_picture_url,website}',
        'get_data_insights' => '%s/insights?metric=engagement,impressions,reach,saved',
        'get_data_mention' => '%s?fields=mentioned_media.media_id(%s){caption,media_type,media_url,owner,timestamp,username,permalink,children{media_url}}',
        'get_data_mention_comments' => '%s?fields=mentioned_media.media_id(%s){username,comments{username,timestamp,text,id,replies{username,text}}}&access_token=%s',
        'comment_mention' => '%s/mentions',
    );

    public function graphapi_contruct()
    {
        $fb = new \Facebook\Facebook([
            'app_id' => "177087713398265",
            'app_secret' => "fa41517e01f08bb85f077270f3de3a01",
            'default_graph_version' => 'v5.0',
            //'default_access_token' => $params['access_token'], // optional
        ]);
        return $fb;
    }

    public function explainData($response)
    {

        switch ($response->getHttpStatusCode()) {
            case 400:
                $data = $response->getResponseData();
                break;
            default:
                $data = $response->getDecodedBody();
                break;
        }
        return $data;
    }

    public function get_long_access_token($params)
    {

        $arrParams = array("grant_type=fb_exchange_token", "client_id=177087713398265", "client_secret=fa41517e01f08bb85f077270f3de3a01", "fb_exchange_token=" . $params['access_token']);
        // echo '<pre>',var_dump($arrParams),'</pre>';die();
        $response = self::_callAPI(
            $this->_api_urls['access_token_long_time'] . implode("&", $arrParams),
            $params['access_token']
        );
        // return self::explainData($response);
        return self::explainData($response);
    }

    public function get_infomation_user($params)
    {
        $response = self::_callAPI(
            $this->_api_urls['information_user'],
            $params['access_token']
        );
        return self::explainData($response);
    }

    // GraphAPI return data through webhook 
    public function get_infomation_media($params)
    {
        $url = sprintf($this->_api_urls['get_data_media'], $params['instagram_id']);
        $response = self::_callAPI(
            $url,
            $params['access_token']
        );
        return self::explainData($response);
    }

    public function get_infomation_insights($params)
    {
        $url = sprintf($this->_api_urls['get_data_insights'], $params['media_id']);
        $response = self::_callAPI(
            $url,
            $params['access_token']
        );
        return self::explainData($response);
    }
    public function get_infomation_mention_media($params)
    {
        $url = sprintf($this->_api_urls['get_data_mention'], $params['instagram_id'], $params['media_id']);
        $response = self::_callAPI(
            $url,
            $params['access_token']
        );
        return self::explainData($response);
    }
    public function get_infomation_mention_comment($params)
    {
        $url = $this->_api_urls['url'] . sprintf($this->_api_urls['get_data_mention_comments'], $params['instagram_id'], $params['media_id'], $params['access_token']);
        return $url;
    }

    public function get_infomation_pageDetail($params)
    {
        // = sprintf($this->_api_urls['information_page']);
        $response = self::_callAPI(
            $this->_api_urls['information_page'],
            $params['access_token']
        );
        return self::explainData($response);
    }

    public function get_comment_mention($params)
    {
        $url = sprintf($this->_api_urls['comment_mention'], $params['instagram_id']);
        $response = self::_callAPI(
            $url,
            $params['access_token'],
            2,
            $params
        );
        return self::explainData($response);
    }

    // Type : 1-> Get, 2 Post
    public function _callAPI($url, $accessToken = "", $type = 1, $arrParams = array())
    {
        $fb = self::graphapi_contruct();
        $error = "";
        try {
            switch ($type) {
                case 2:
                    $response = $fb->post($url, $arrParams, $accessToken);
                    break;
                case 3:
                    $response = $fb->delete($url, $arrParams, $accessToken);
                    break;
                default:
                    $response = $fb->get($url, $accessToken);
                    break;
            }
        } catch (\Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            $error = 'Graph returned an error: ' . $e->getMessage();
            $response = $e;
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            $error = 'Facebook SDK returned an error: ' . $e->getMessage();
            $response = $e;
        }
        return $response;
    }
}
