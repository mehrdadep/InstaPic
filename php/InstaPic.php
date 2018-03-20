<?php

/**
 * Created by PhpStorm.
 * User: MehrdadEP
 * Date: 3/20/2018
 * Time: 3:16 PM
 */

/**
 * Class InstaPic
 * get instagram profile picture with username or url in two size: 150x150 (small)
 * or 1080x1080 (large)
 */
class InstaPic
{
    /**
     * @param arg : username or url
     * @return: the url of the large instagram profile picture
     */
    function getLargePhoto($arg)
    {
        if (strpos($arg, "https://www.instagram.com/") !== false)
            return $this->getLargePhotoWithUrl($arg);
        return $this->getLargePhotoWithUsername($arg);
    }

    /**
     * @param arg : username or url
     * @return: the url of the small instagram profile picture
     */
    function getSmallPhoto($arg)
    {
        if (strpos($arg, "https://www.instagram.com/") !== false)
            return $this->getSmallPhotoWithUrl($arg);
        return $this->getSmallPhotoWithUsername($arg);
    }

    /**
     * @param url
     * @return: the content of the url
     */
    private function getFromURL($url)
    {
        $contents = '';
        try {
            if (strpos($url, "https://www.instagram.com/") !== false) {
                $c = curl_init();
                $useragent = 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17';
                $timeout = 1500;
                curl_setopt($c, CURLOPT_URL, $url);
                curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($c, CURLOPT_USERAGENT, $useragent);
                curl_setopt($c, CURLOPT_AUTOREFERER, true);
                curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($c, CURLOPT_VERBOSE, 1);
                $data = curl_exec($c);
                curl_close($c);
                $contents = new DOMDocument;
                $contents->preserveWhiteSpace = false;
                $contents->loadHTML($data);
            } else
                return null;
        } catch (Exception $e) {
            echo $e->getMessage();
            return null;
        } finally {
            return $contents;
        }
    }

    /**
     * @param username : username of instagram account
     * @return: small profile picture url if exist otherwise null
     */
    private function getSmallPhotoWithUsername($username)
    {

        $small = '';
        try {
            $url = 'https://www.instagram.com/' . $username;
            $html = $this->getFromURL($url);
            if (!is_null($html)) {
                $xpath = new DOMXpath($html);
                $small = $xpath->query('//meta[@property="og:image"]//@content')[0]->nodeValue;
            }
        } catch (OutOfBoundsException $ex) {
            echo 'Username or account not found';
            return null;
        } catch (Exception $e) {
            echo $e->getMessage();
            return null;
        } finally {
            return $small;
        }
    }

    /**
     * @param url : url of instagram account
     * @return: small profile picture url if exist otherwise null
     */
    private function getSmallPhotoWithUrl($url)
    {
        $small = '';
        try {
            $html = $this->getFromURL($url);
            if (!is_null($html)) {
                $xpath = new DOMXpath($html);
                $small = $xpath->query('//meta[@property="og:image"]//@content')[0]->nodeValue;
            }
        } catch (OutOfBoundsException $ex) {
            echo 'Username or account not found';
            return null;
        } catch (Exception $e) {
            echo $e->getMessage();
            return null;
        } finally {
            return $small;
        }
    }

    /**
     * @param url : url of instagram account
     * @return: large profile picture url if exist otherwise null
     */
    private function getLargePhotoWithUrl($url)
    {
        $large = '';
        try {
            $html = $this->getFromURL($url);
            if (!is_null($html)) {
                $xpath = new DOMXpath($html);
                $small = $xpath->query('//meta[@property="og:image"]//@content')[0]->nodeValue;
                if (strpos($small, 's150x150') !== false) {
                    $large = str_replace('vp/', '', $small);
                    $large = str_replace('s150x150', 's1080x1080', $large);
                }
                else
                    echo 'Large size not available';
            }
        } catch (OutOfBoundsException $ex) {
            echo 'Username or account not found';
            return null;
        } catch (Exception $e) {
            echo $e->getMessage();
            return null;
        } finally {
            return $large;
        }
    }

    /**
     * @param username : username of instagram account
     * @return: large profile picture url if exist otherwise None
     */
    private function getLargePhotoWithUsername($username)
    {
        $large = '';
        try {
            $url = 'https://www.instagram.com/' . $username;
            $html = $this->getFromURL($url);
            if (!is_null($html)) {
                $xpath = new DOMXpath($html);
                $small = $xpath->query('//meta[@property="og:image"]//@content')[0]->nodeValue;
                if (strpos($small, 's150x150') !== false) {
                    $large = str_replace('vp/', '', $small);
                    $large = str_replace('s150x150', 's1080x1080', $large);
                }
                else
                    echo 'Large size not available';
            }
        } catch (OutOfBoundsException $ex) {
            echo 'Username or account not found';
            return null;
        } catch (Exception $e) {
            echo $e->getMessage();
            return null;
        } finally {
            return $large;
        }

    }
}