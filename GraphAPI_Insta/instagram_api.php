<?php

/**
 * Instagram APIs library
 *
 * Credentials must be supplied through environment variables.
 */
class Helper_GraphAPI
{
    protected $app_id;
    public $app_secret;

    protected $_api_urls = array(
        'url' => 'https://graph.facebook.com/v5.0/',
        'access_token_long_time' => '/oauth/access_token?',
        'access_token_redeeming' => '/oauth/client_code?',
        'information_user' => '/me',
        'information_page' => '/me?fields=subscribed_apps,instagram_business_account{name,username,biography,followers_count,follows_count,media_count,profile_picture_url,website}',
        'associate_app_page' => '/%s/subscribed_apps',
        'get_data_media' => '%s/media?fields=is_comment_enabled,media_type,media_url,permalink,shortcode,caption,like_count,timestamp,user,username,comments_count,comments.limit(500){text,timestamp,like_count,replies}&limit=500',
        'get_page_details' => '%s/fields=subscribed_apps,{name,username,biography,followers_count,follows_count,media_count,profile_picture_url,website}',
        'get_data_insights' => '%s/insights?metric=engagement,impressions,reach,saved',
        'get_data_mention' => '%s?fields=mentioned_media.media_id(%s){caption,media_type,media_url,owner,timestamp,username,permalink,children{media_url}}',
        'get_data_mention_comments' => '%s?fields=mentioned_media.media_id(%s){username,comments{username,timestamp,text,id,replies{username,text}}}&access_token=%s',
        'comment_mention' => '%s/mentions',
    );

    public function __construct()
    {
        $this->app_id = $this->requiredEnvironmentValue('FACEBOOK_APP_ID');
        $this->app_secret = $this->requiredEnvironmentValue('FACEBOOK_APP_SECRET');
    }

    private function requiredEnvironmentValue($name)
    {
        $value = getenv($name);
        if ($value === false || $value === '') {
            throw new RuntimeException('Missing required environment variable: ' . $name);
        }
        return $value;
    }

    public function graphapi_contruct()
    {
        return new \Facebook\Facebook(array(
            'app_id' => $this->app_id,
            'app_secret' => $this->app_secret,
            'default_graph_version' => 'v5.0',
        ));
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
        $arrParams = array(
            'grant_type=fb_exchange_token',
            'client_id=' . rawurlencode($this->app_id),
            'client_secret=' . rawurlencode($this->app_secret),
            'fb_exchange_token=' . rawurlencode($params['access_token'])
        );
        $response = self::_callAPI(
            $this->_api_urls['access_token_long_time'] . implode('&', $arrParams),
            $params['access_token']
        );
        return self::explainData($response);
    }

    public function get_infomation_user($params)
    {
        $response = self::_callAPI($this->_api_urls['information_user'], $params['access_token']);
        return self::explainData($response);
    }

    public function get_infomation_media($params)
    {
        $url = sprintf($this->_api_urls['get_data_media'], $params['instagram_id']);
        $response = self::_callAPI($url, $params['access_token']);
        return self::explainData($response);
    }

    public function get_infomation_insights($params)
    {
        $url = sprintf($this->_api_urls['get_data_insights'], $params['media_id']);
        $response = self::_callAPI($url, $params['access_token']);
        return self::explainData($response);
    }

    public function get_infomation_mention_media($params)
    {
        $url = sprintf($this->_api_urls['get_data_mention'], $params['instagram_id'], $params['media_id']);
        $response = self::_callAPI($url, $params['access_token']);
        return self::explainData($response);
    }

    public function get_infomation_mention_comment($params)
    {
        return $this->_api_urls['url'] . sprintf(
            $this->_api_urls['get_data_mention_comments'],
            $params['instagram_id'],
            $params['media_id'],
            $params['access_token']
        );
    }

    public function get_infomation_pageDetail($params)
    {
        $response = self::_callAPI($this->_api_urls['information_page'], $params['access_token']);
        return self::explainData($response);
    }

    public function get_comment_mention($params)
    {
        $url = sprintf($this->_api_urls['comment_mention'], $params['instagram_id']);
        $response = self::_callAPI($url, $params['access_token'], 2, $params);
        return self::explainData($response);
    }

    public function _callAPI($url, $accessToken = '', $type = 1, $arrParams = array())
    {
        $fb = self::graphapi_contruct();
        try {
            switch ($type) {
                case 2:
                    return $fb->post($url, $arrParams, $accessToken);
                case 3:
                    return $fb->delete($url, $arrParams, $accessToken);
                default:
                    return $fb->get($url, $accessToken);
            }
        } catch (\Facebook\Exceptions\FacebookResponseException $e) {
            return $e;
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            return $e;
        }
    }
}
