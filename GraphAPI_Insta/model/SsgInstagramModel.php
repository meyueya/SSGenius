<?php
require_once __DIR__ . './../config/db.php'; // Conexión

class SsgInstagramModel
{
    public function __construct()
    { }

    // -- Save Instragram Page

    public function saveInstagramPage($param)
    {
        try {
            $dbh = Database::getInstance();
            // --
            $sql = "INSERT INTO ssg_instagram_pages 
                (
                    id_instagram_page, 
                    id_facebook_page, 
                    name, 
                    username, 
                    biography, 
                    followers_count, 
                    follows_count, 
                    media_count,
                    profile_picture_url, 
                    website, 
                    token, 
                    token_lifetime, 
                    timestamp
                ) 
                VALUES 
                (
                    :id_instagram_page, 
                    :id_facebook_page, 
                    :name, 
                    :username, 
                    :biography, 
                    :followers_count, 
                    :follows_count, 
                    :media_count, 
                    :profile_picture_url, 
                    :website, 
                    :token, 
                    :token_lifetime, 
                    :timestamp
                ) ";
            // --
            $sth = $dbh->prepare($sql);
            $sth->bindParam(':id_instagram_page', $param['id_instagram_page']);
            $sth->bindParam(':id_facebook_page', $param['id_facebook_page']);
            $sth->bindParam(':name', $param['name']);
            $sth->bindParam(':username', $param['username']);
            $sth->bindParam(':biography', $param['biography']);
            $sth->bindParam(':followers_count', $param['followers_count']);
            $sth->bindParam(':follows_count', $param['follows_count']);
            $sth->bindParam(':media_count', $param['media_count']);
            $sth->bindParam(':profile_picture_url', $param['profile_picture_url']);
            $sth->bindParam(':website', $param['website']);
            $sth->bindParam(':token', $param['token']);
            $sth->bindParam(':token_lifetime', $param['token_lifetime']);
            $sth->bindParam(':timestamp', $param['timestamp']);
            $sth->execute();
            $count = $sth->rowCount();
            return $count;
        } catch (PDOException $e) {
            die('Fallo en query: ' . __METHOD__ . " - " . $e->getMessage());
        }
    }

    // -- Save Instagram media
    public function saveInstagramMedia($param)
    {
        try {
            $dbh = Database::getInstance();
            // --
            $sql = "INSERT INTO ssg_instagram_media
            (
                id_instagram_media, 
                id_instagram_page, 
                is_comment_enabled, 
                caption, 
                media_type, 
                media_url, 
                permalink, 
                shortcode,
                username, 
                like_count, 
                comments_count,
                engagement,
                impressions,
                reach,
                saved,
                timestamp
            ) 
            VALUES 
            (
                :id_instagram_media, 
                :id_instagram_page, 
                :is_comment_enabled, 
                :caption, 
                :media_type, 
                :media_url, 
                :permalink, 
                :shortcode, 
                :username, 
                :like_count, 
                :comments_count, 
                :engagement, 
                :impressions, 
                :reach, 
                :saved, 
                :timestamp
            ) ";
            // --
            $sth = $dbh->prepare($sql);
            $sth->bindParam(':id_instagram_media', $param['id_instagram_media']);
            $sth->bindParam(':id_instagram_page', $param['id_instagram_page']);
            $sth->bindParam(':is_comment_enabled', $param['is_comment_enabled']);
            $sth->bindParam(':caption', $param['caption']);
            $sth->bindParam(':media_type', $param['media_type']);
            $sth->bindParam(':media_url', $param['media_url']);
            $sth->bindParam(':permalink', $param['permalink']);
            $sth->bindParam(':shortcode', $param['shortcode']);
            $sth->bindParam(':username', $param['username']);
            $sth->bindParam(':like_count', $param['like_count']);
            $sth->bindParam(':comments_count', $param['comments_count']);
            $sth->bindParam(':engagement', $param['engagement']);
            $sth->bindParam(':impressions', $param['impressions']);
            $sth->bindParam(':reach', $param['reach']);
            $sth->bindParam(':saved', $param['saved']);
            $sth->bindParam(':timestamp', $param['timestamp']);
            $sth->execute();
            $count = $sth->rowCount();
            return $count;
        } catch (PDOException $e) {
            die('Fallo en query: ' . __METHOD__ . " - " . $e->getMessage());
        }
    }
    // -- Save Instagram media
    public function saveInstagramMediaComments($param)
    {
        try {
            $dbh = Database::getInstance();
            // --
            $sql = "INSERT INTO ssg_instagram_comments
            (
                id_instagram_comment, 
                id_instagram_media, 
                text, 
                like_count, 
                timestamp,
                replies
            ) 
            VALUES 
            (
                :id_instagram_comment, 
                :id_instagram_media, 
                :text, 
                :like_count, 
                :timestamp, 
                :replies
            ) ";
            // --
            $sth = $dbh->prepare($sql);
            $sth->bindParam(':id_instagram_comment', $param['id_instagram_comment']);
            $sth->bindParam(':id_instagram_media', $param['id_instagram_media']);
            $sth->bindParam(':text', $param['text']);
            $sth->bindParam(':like_count', $param['like_count']);
            $sth->bindParam(':timestamp', $param['timestamp']);
            $sth->bindParam(':replies', $param['replies']);
            $sth->execute();
            $count = $sth->rowCount();
            return $count;
        } catch (PDOException $e) {
            die('Fallo en query: ' . __METHOD__ . " - " . $e->getMessage());
        }
    }
}
