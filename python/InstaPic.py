# Author: MehrdadEP

from lxml import etree
import requests

class InstaPic(object):

    def getLargePhoto(self, arg):
        """
        :param arg: username or url
        :return: the url of the large instagram profile picture
        """
        if "https://www.instagram.com/" in arg:
            return self.__getLargePhotoWithUrl(arg)
        return self.__getLargePhotoWithUsername(arg)

    def getSmallPhoto(self, arg):
        """
        :param arg: username or url
        :return: the url of the small instagram profile picture
        """
        if "https://www.instagram.com/" in arg:
            return self.__getSmallPhotoWithUrl(arg)
        return self.__getSmallPhotoWithUsername(arg)

    def __getFromURL(self,url):
        """
        :return: the content of the url
        """
        contents = ''
        try:
            if 'instagram.com' in url:
                contents = requests.get(url).content
            else:
                return None
        except Exception as e:
            print(e)
            return None
        finally:
           return contents

    def __getSmallPhotoWithUsername(self,username):
        """

        :param username: username of instagram account
        :return: small profile picture url if exist otherwise None
        """
        small = ''
        try:
            url = 'https://www.instagram.com/'+username
            html = self.__getFromURL(url)
            if (html is not None):
                tree = tree = etree.HTML(html)
                small = tree.xpath('//meta[@property="og:image"]')[0].get('content')
        except IndexError:
            print('Username or account not found')
        except Exception as e:
            print(e)
            return None
        finally:
            return small

    def __getSmallPhotoWithUrl(self,url):
        """

        :param url: url of instagram account
        :return: small profile picture url if exist otherwise None
        """
        small = ''
        try:
            html = self.__getFromURL(url)
            if (html is not None):
                tree = tree = etree.HTML(html)
                small = tree.xpath('//meta[@property="og:image"]')[0].get('content')
        except IndexError:
            print('Username or account not found')
        except Exception as e:
            print(e)
            return None
        finally:
            return small

    def __getLargePhotoWithUrl(self,url):
        """

        :param url: url of instagram account
        :return: large profile picture url if exist otherwise None
        """
        large = ''
        try:
            html = self.__getFromURL(url)
            if (html is not None):
                tree = tree = etree.HTML(html)
                small = tree.xpath('//meta[@property="og:image"]')[0].get('content')
                large = small.replace('vp/','').replace('s150x150','s1080x1080')
        except IndexError:
            print('Username or account not found')
        except Exception as e:
            print(e)
            return None
        finally:
            return large

    def __getLargePhotoWithUsername(self, username):
        """

        :param username: username of instagram account
        :return: large profile picture url if exist otherwise None
        """
        large = ''
        try:
            url = 'https://www.instagram.com/'+username
            html = self.__getFromURL(url)
            if (html is not None):
                tree = tree = etree.HTML(html)
                small = tree.xpath('//meta[@property="og:image"]')[0].get('content')
                large = small.replace('vp/','').replace('s150x150','s1080x1080')
        except IndexError:
            print('Username or account not found')
        except Exception as e:
            print(e)
            return None
        finally:
            return large

