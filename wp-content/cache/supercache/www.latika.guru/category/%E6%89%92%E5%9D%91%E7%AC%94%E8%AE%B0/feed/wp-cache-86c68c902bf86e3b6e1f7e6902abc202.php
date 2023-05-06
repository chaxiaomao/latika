<?php die(); ?><?xml version="1.0" encoding="UTF-8"?><rss version="2.0"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:atom="http://www.w3.org/2005/Atom"
	xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
	xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
	>

<channel>
	<title>扒坑笔记归档 - Latika Blog</title>
	<atom:link href="https://www.latika.guru/category/%E6%89%92%E5%9D%91%E7%AC%94%E8%AE%B0/feed/" rel="self" type="application/rss+xml" />
	<link>https://www.latika.guru/category/扒坑笔记/</link>
	<description>No toxic place</description>
	<lastBuildDate>Wed, 26 Apr 2023 12:51:07 +0000</lastBuildDate>
	<language>zh-CN</language>
	<sy:updatePeriod>
	hourly	</sy:updatePeriod>
	<sy:updateFrequency>
	1	</sy:updateFrequency>
	<generator>https://wordpress.org/?v=6.2</generator>
	<item>
		<title>对公众平台发送给公众账号的消息加解密PHP示例代码</title>
		<link>https://www.latika.guru/%e5%af%b9%e5%85%ac%e4%bc%97%e5%b9%b3%e5%8f%b0%e5%8f%91%e9%80%81%e7%bb%99%e5%85%ac%e4%bc%97%e8%b4%a6%e5%8f%b7%e7%9a%84%e6%b6%88%e6%81%af%e5%8a%a0%e8%a7%a3%e5%af%86%e7%a4%ba%e4%be%8b%e4%bb%a3%e7%a0%81/</link>
					<comments>https://www.latika.guru/%e5%af%b9%e5%85%ac%e4%bc%97%e5%b9%b3%e5%8f%b0%e5%8f%91%e9%80%81%e7%bb%99%e5%85%ac%e4%bc%97%e8%b4%a6%e5%8f%b7%e7%9a%84%e6%b6%88%e6%81%af%e5%8a%a0%e8%a7%a3%e5%af%86%e7%a4%ba%e4%be%8b%e4%bb%a3%e7%a0%81/#respond</comments>
		
		<dc:creator><![CDATA[Eden]]></dc:creator>
		<pubDate>Tue, 25 Apr 2023 04:26:13 +0000</pubDate>
				<category><![CDATA[扒坑笔记]]></category>
		<category><![CDATA[PHP]]></category>
		<guid isPermaLink="false">http://blog.local/?p=118</guid>

					<description><![CDATA[<p>验证票据（component_verify_ticket），在第三方平台创建审核通过后，微信服务器会向其 ”授&#8230; <a class="more-link" href="https://www.latika.guru/%e5%af%b9%e5%85%ac%e4%bc%97%e5%b9%b3%e5%8f%b0%e5%8f%91%e9%80%81%e7%bb%99%e5%85%ac%e4%bc%97%e8%b4%a6%e5%8f%b7%e7%9a%84%e6%b6%88%e6%81%af%e5%8a%a0%e8%a7%a3%e5%af%86%e7%a4%ba%e4%be%8b%e4%bb%a3%e7%a0%81/">继续阅读<span class="screen-reader-text">对公众平台发送给公众账号的消息加解密PHP示例代码</span></a></p>
<p><a rel="nofollow" href="https://www.latika.guru/%e5%af%b9%e5%85%ac%e4%bc%97%e5%b9%b3%e5%8f%b0%e5%8f%91%e9%80%81%e7%bb%99%e5%85%ac%e4%bc%97%e8%b4%a6%e5%8f%b7%e7%9a%84%e6%b6%88%e6%81%af%e5%8a%a0%e8%a7%a3%e5%af%86%e7%a4%ba%e4%be%8b%e4%bb%a3%e7%a0%81/">对公众平台发送给公众账号的消息加解密PHP示例代码</a>最先出现在<a rel="nofollow" href="https://www.latika.guru">Latika Blog</a>。</p>
]]></description>
										<content:encoded><![CDATA[<p>验证票据（component_verify_ticket），在第三方平台创建审核通过后，微信服务器会向其 ”授权事件接收URL” 每隔 10 分钟以 <code>POST</code> 的方式推送 component_verify_ticket。</p>
<p>这东西就是第三方服务商（就是自己）给商户（甲方）代开发小程序时候很重要的参数，基本上其他API都需要这个票据作为参数，但是微信开发者平台文档给的PHP例子在PHP5.6之后已经过时，官方声明mcrypt_generic/mcrypt_encrypt作为加密解密验证身份是不适合且不安全，已弃用，项目环境是PHP7.3，改用OpenSSL避免报错缺少这两个库。</p>
<h3>WxBizMsgCrypt.php</h3>
<pre class="EnlighterJSRAW" data-enlighter-language="php">&lt;?php

/**
 * 对公众平台发送给公众账号的消息加解密示例代码.
 *
 * @copyright Copyright (c) 1998-2014 Tencent Inc.
 */

include_once 'PKcs7Encoder.php';

/**
 * 1.第三方回复加密消息给公众平台；
 * 2.第三方收到公众平台发送的消息，验证消息的安全性，并对消息进行解密。
 */
class WXBizMsgCrypt
{
    private $token;
    private $encodingAesKey;
    private $appId;

    /**
     * 构造函数
     * @param $token string 公众平台上，开发者设置的token
     * @param $encodingAesKey string 公众平台上，开发者设置的EncodingAESKey
     * @param $appId string 公众平台的appId
     */
    public function __construct($token, $encodingAesKey, $appId)
    {
        $this-&gt;token = $token;
        $this-&gt;encodingAesKey = $encodingAesKey;
        $this-&gt;appId = $appId;
    }

    /**
     * 将公众平台回复用户的消息加密打包.
     * &lt;ol&gt;
     *    &lt;li&gt;对要发送的消息进行AES-CBC加密&lt;/li&gt;
     *    &lt;li&gt;生成安全签名&lt;/li&gt;
     *    &lt;li&gt;将消息密文和安全签名打包成xml格式&lt;/li&gt;
     * &lt;/ol&gt;
     *
     * @param $replyMsg string 公众平台待回复用户的消息，xml格式的字符串
     * @param $timeStamp string 时间戳，可以自己生成，也可以用URL参数的timestamp
     * @param $nonce string 随机串，可以自己生成，也可以用URL参数的nonce
     * @param &amp;$encryptMsg string 加密后的可以直接回复用户的密文，包括msg_signature, timestamp, nonce, encrypt的xml格式的字符串,
     *                      当return返回0时有效
     *
     * @return int 成功0，失败返回对应的错误码
     */
    public function encryptMsg($replyMsg, $timeStamp, $nonce, &amp;$encryptMsg)
    {
        $pc = new Prpcrypt($this-&gt;encodingAesKey);

        //加密
        $array = $pc-&gt;encrypt($replyMsg, $this-&gt;appId);
        $ret = $array[0];
        if ($ret != 0) {
            return $ret;
        }

        if ($timeStamp == null) {
            $timeStamp = time();
        }
        $encrypt = $array[1];

        //生成安全签名
        $sha1 = new SHA1;
        $array = $sha1-&gt;getSHA1($this-&gt;token, $timeStamp, $nonce, $encrypt);
        $ret = $array[0];
        if ($ret != 0) {
            return $ret;
        }
        $signature = $array[1];

        //生成发送的xml
        $xmlparse = new XMLParse;
        $encryptMsg = $xmlparse-&gt;generate($encrypt, $signature, $timeStamp, $nonce);
        return ErrorCode::$OK;
    }


    /**
     * 检验消息的真实性，并且获取解密后的明文.
     * &lt;ol&gt;
     *    &lt;li&gt;利用收到的密文生成安全签名，进行签名验证&lt;/li&gt;
     *    &lt;li&gt;若验证通过，则提取xml中的加密消息&lt;/li&gt;
     *    &lt;li&gt;对消息进行解密&lt;/li&gt;
     * &lt;/ol&gt;
     *
     * @param $msgSignature string 签名串，对应URL参数的msg_signature
     * @param $timestamp string 时间戳 对应URL参数的timestamp
     * @param $nonce string 随机串，对应URL参数的nonce
     * @param $postData string 密文，对应POST请求的数据
     * @param &amp;$msg string 解密后的原文，当return返回0时有效
     *
     * @return int 成功0，失败返回对应的错误码
     */
    public function decryptMsg($msgSignature, $timestamp = null, $nonce, $postData, &amp;$msg)
    {
        if (strlen($this-&gt;encodingAesKey) != 43) {
            return ErrorCode::$IllegalAesKey;
        }

        $pc = new Prpcrypt($this-&gt;encodingAesKey);

        //提取密文
        $xmlparse = new XMLParse;
        $array = $xmlparse-&gt;extract($postData);
        $ret = $array[0];

        if ($ret != 0) {
            return $ret;
        }

        if ($timestamp == null) {
            $timestamp = time();
        }

        $encrypt = $array[1];
        $touser_name = $array[2];

        //验证安全签名
        $sha1 = new SHA1;
        $array = $sha1-&gt;getSHA1($this-&gt;token, $timestamp, $nonce, $encrypt);
        $ret = $array[0];

        if ($ret != 0) {
            return $ret;
        }

        $signature = $array[1];
        if ($signature != $msgSignature) {
            return ErrorCode::$ValidateSignatureError;
        }

        $result = $pc-&gt;decrypt($encrypt, $this-&gt;appId);
        if ($result[0] != 0) {
            return $result[0];
        }
        $msg = $result[1];

        return ErrorCode::$OK;
    }

}

</pre>
<h3>PKCS7Encoder.php</h3>
<pre class="EnlighterJSRAW" data-enlighter-language="php">&lt;?php

/**
 * PKCS7Encoder class
 *
 * 提供基于PKCS7算法的加解密接口.
 */
class PKCS7Encoder
{
    public static $block_size = 32;

    /**
     * 对需要加密的明文进行填充补位
     * @param $text 需要进行填充补位操作的明文
     * @return 补齐明文字符串
     */
    function encode($text)
    {
        $block_size = PKCS7Encoder::$block_size;
        $text_length = strlen($text);
        //计算需要填充的位数
        $amount_to_pad = PKCS7Encoder::$block_size - ($text_length % PKCS7Encoder::$block_size);
        if ($amount_to_pad == 0) {
            $amount_to_pad = PKCS7Encoder::block_size;
        }
        //获得补位所用的字符
        $pad_chr = chr($amount_to_pad);
        $tmp = "";
        for ($index = 0; $index &lt; $amount_to_pad; $index++) {
            $tmp .= $pad_chr;
        }
        return $text . $tmp;
    }

    /**
     * 对解密后的明文进行补位删除
     * @param decrypted 解密后的明文
     * @return 删除填充补位后的明文
     */
    function decode($text)
    {

        $pad = ord(substr($text, -1));
        if ($pad &lt; 1 || $pad &gt; 32) {
            $pad = 0;
        }
        return substr($text, 0, (strlen($text) - $pad));
    }

}

/**
 * Prpcrypt class
 *
 * 提供接收和推送给公众平台消息的加解密接口.
 */
class Prpcrypt
{
    public $key;

    function __construct($k)
    {
        $this-&gt;key = base64_decode($k . "=");
    }

    public function encrypt($text, $appid)
    {
        try {
            $key = $this-&gt;key;
            $random = $this-&gt;getRandomStr();
            $text = $random.pack('N', strlen($text).$text.$appid);
            $padAmount = 32 - (strlen($text) % 32);
            $padAmount = 0 !== $padAmount ? $padAmount : 32;
            $padChr = chr($padAmount);
            $tmp = '';
            for ($index = 0; $index &lt; $padAmount; ++$index) {
                $tmp .= $padChr;
            }
            $text = $text.$tmp;
            $iv = substr($key, 0, 16);
            $encrypted = openssl_encrypt($text, 'aes-256-cbc', $key, OPENSSL_RAW_DATA | OPENSSL_NO_PADDING, $iv);
            return array(ErrorCode::$OK, base64_encode($encrypted));
        } catch (\Exception $e) {
            return array(ErrorCode::$EncryptAESError, null);
        }
    }
    

    /**
     * 对密文进行解密
     * @param string $encrypted 需要解密的密文
     * @return string 解密得到的明文
     */
    public function decrypt($encrypted, $appid)
    {

        try {
            $key = $this-&gt;key;
            $ciphertext = base64_decode($encrypted, true);
            $iv = substr($key, 0, 16);
            $decrypted = openssl_decrypt($ciphertext, 'aes-256-cbc', $key, OPENSSL_RAW_DATA | OPENSSL_NO_PADDING, $iv);
        } catch (\Exception $e) {
            return array(ErrorCode::$DecryptAESError, null);
        }


        try {
            //去除补位字符
            $pkc_encoder = new PKCS7Encoder;
            $result = $pkc_encoder-&gt;decode($decrypted);
            //去除16位随机字符串,网络字节序和AppId
            if (strlen($result) &lt; 16)
                return "";
            $content = substr($result, 16, strlen($result));
            $len_list = unpack("N", substr($content, 0, 4));
            $xml_len = $len_list[1];
            $xml_content = substr($content, 4, $xml_len);
            $from_appid = substr($content, $xml_len + 4);
        } catch (\Exception $e) {
            //print $e;
            return array(ErrorCode::$IllegalBuffer, null);
        }
        if ($from_appid != $appid)
            return array(ErrorCode::$ValidateAppidError, null);
        return array(0, $xml_content);

    }


    /**
     * 随机生成16位字符串
     * @return string 生成的字符串
     */
    function getRandomStr()
    {

        $str = "";
        $str_pol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $max = strlen($str_pol) - 1;
        for ($i = 0; $i &lt; 16; $i++) {
            $str .= $str_pol[mt_rand(0, $max)];
        }
        return $str;
    }

}

?&gt;</pre>
<h3>SHA1.php</h3>
<pre class="EnlighterJSRAW" data-enlighter-language="generic">&lt;?php


/**
 * SHA1 class
 *
 * 计算公众平台的消息签名接口.
 */
class SHA1
{
    /**
     * 用SHA1算法生成安全签名
     * @param string $token 票据
     * @param string $timestamp 时间戳
     * @param string $nonce 随机字符串
     * @param string $encrypt 密文消息
     */
    public function getSHA1($token, $timestamp, $nonce, $encrypt_msg)
    {
        //排序
        try {
            $array = array($encrypt_msg, $token, $timestamp, $nonce);
            sort($array, SORT_STRING);
            $str = implode($array);
            return array(ErrorCode::$OK, sha1($str));
        } catch (Exception $e) {
            //print $e . "\n";
            return array(ErrorCode::$ComputeSignatureError, null);
        }
    }

}


?&gt;</pre>
<h3>XMLParse.php</h3>
<pre class="EnlighterJSRAW" data-enlighter-language="generic">&lt;?php

use \DOMDocument;

/**
 * XMLParse class
 *
 * 提供提取消息格式中的密文及生成回复消息格式的接口.
 */
class XMLParse
{

    /**
     * 提取出xml数据包中的加密消息
     * @param string $xmltext 待提取的xml字符串
     * @return string 提取出的加密消息字符串
     */
    public function extract($xmltext)
    {
        libxml_disable_entity_loader(true);
        try {
            $xml = new DOMDocument();
            $xml-&gt;loadXML($xmltext);
            $array_e = $xml-&gt;getElementsByTagName('Encrypt');
            $array_a = $xml-&gt;getElementsByTagName('AppId');
            $encrypt = $array_e-&gt;item(0)-&gt;nodeValue;
            $tousername = $array_a-&gt;item(0)-&gt;nodeValue;
            return array(0, $encrypt, $tousername);
        } catch (Exception $e) {
            //print $e . "\n";
            return array(ErrorCode::$ParseXmlError, null, null);
        }
    }

    /**
     * 生成xml消息
     * @param string $encrypt 加密后的消息密文
     * @param string $signature 安全签名
     * @param string $timestamp 时间戳
     * @param string $nonce 随机字符串
     */
    public function generate($encrypt, $signature, $timestamp, $nonce)
    {
        $format = "&lt;xml&gt;
&lt;Encrypt&gt;&lt;![CDATA[%s]]&gt;&lt;/Encrypt&gt;
&lt;MsgSignature&gt;&lt;![CDATA[%s]]&gt;&lt;/MsgSignature&gt;
&lt;TimeStamp&gt;%s&lt;/TimeStamp&gt;
&lt;Nonce&gt;&lt;![CDATA[%s]]&gt;&lt;/Nonce&gt;
&lt;/xml&gt;";
        return sprintf($format, $encrypt, $signature, $timestamp, $nonce);
    }

}


?&gt;</pre>
<h3>ErrorCode.php</h3>
<pre class="EnlighterJSRAW" data-enlighter-language="generic">&lt;?php
/**
 * error code 说明.
 * &lt;ul&gt;
 *    &lt;li&gt;-40001: 签名验证错误&lt;/li&gt;
 *    &lt;li&gt;-40002: xml解析失败&lt;/li&gt;
 *    &lt;li&gt;-40003: sha加密生成签名失败&lt;/li&gt;
 *    &lt;li&gt;-40004: encodingAesKey 非法&lt;/li&gt;
 *    &lt;li&gt;-40005: appid 校验错误&lt;/li&gt;
 *    &lt;li&gt;-40006: aes 加密失败&lt;/li&gt;
 *    &lt;li&gt;-40007: aes 解密失败&lt;/li&gt;
 *    &lt;li&gt;-40008: 解密后得到的buffer非法&lt;/li&gt;
 *    &lt;li&gt;-40009: base64加密失败&lt;/li&gt;
 *    &lt;li&gt;-40010: base64解密失败&lt;/li&gt;
 *    &lt;li&gt;-40011: 生成xml失败&lt;/li&gt;
 * &lt;/ul&gt;
 */
class ErrorCode
{
    public static $OK = 0;
    public static $ValidateSignatureError = -40001;
    public static $ParseXmlError = -40002;
    public static $ComputeSignatureError = -40003;
    public static $IllegalAesKey = -40004;
    public static $ValidateAppidError = -40005;
    public static $EncryptAESError = -40006;
    public static $DecryptAESError = -40007;
    public static $IllegalBuffer = -40008;
    public static $EncodeBase64Error = -40009;
    public static $DecodeBase64Error = -40010;
    public static $GenReturnXmlError = -40011;
}

?&gt;</pre>
<h3>Demo</h3>
<pre class="EnlighterJSRAW" data-enlighter-language="generic">&lt;?php

include_once "WxBizMsgCrypt.php";

define("TOKEN", "xxx");
define("AppID", "wx2xxxx");
define("AppSecret", "xxda9eeaf636c041edbeb028dbxxxxxx");
define("EncodingAESKey", "xx9f1e7787c9cde4911f8f9c9c08a554e6c16xxxxxx");

$timestamp  = $_GET['timestamp'];
$nonce = $_GET["nonce"];
$msg_signature  = $_GET['msg_signature'];
$encrypt_type = (isset($_GET['encrypt_type']) &amp;&amp; ($_GET['encrypt_type'] == 'aes')) ? "aes" : "raw";
$postStr = file_get_contents('php://input');

print_r('解密前:' . $postStr);
if ($encrypt_type == 'aes') {
    $pc = new WxBizMsgCrypt(TOKEN, EncodingAESKey, AppID);
    $decryptMsg = "";
    $errCode = $pc-&gt;DecryptMsg($msg_signature, $timestamp, $nonce, $postStr, $decryptMsg);
    $postStr = $decryptMsg;
    print_r('解密后:' . $postStr);
}

$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
print_r('解密后XML String:' . json_encode($postObj));</pre>
<p>&nbsp;</p>
<p>引用参考：<a href="https://paragonie.com/blog/2015/05/if-you-re-typing-word-mcrypt-into-your-code-you-re-doing-it-wrong" target="_blank" rel="noopener">https://paragonie.com/blog/2015/05/if-you-re-typing-word-mcrypt-into-your-code-you-re-doing-it-wrong</a></p>
<div id="gtx-trans" style="position: absolute; left: 30px; top: 7946.11px;">
<div class="gtx-trans-icon"></div>
</div>
<p><a rel="nofollow" href="https://www.latika.guru/%e5%af%b9%e5%85%ac%e4%bc%97%e5%b9%b3%e5%8f%b0%e5%8f%91%e9%80%81%e7%bb%99%e5%85%ac%e4%bc%97%e8%b4%a6%e5%8f%b7%e7%9a%84%e6%b6%88%e6%81%af%e5%8a%a0%e8%a7%a3%e5%af%86%e7%a4%ba%e4%be%8b%e4%bb%a3%e7%a0%81/">对公众平台发送给公众账号的消息加解密PHP示例代码</a>最先出现在<a rel="nofollow" href="https://www.latika.guru">Latika Blog</a>。</p>
]]></content:encoded>
					
					<wfw:commentRss>https://www.latika.guru/%e5%af%b9%e5%85%ac%e4%bc%97%e5%b9%b3%e5%8f%b0%e5%8f%91%e9%80%81%e7%bb%99%e5%85%ac%e4%bc%97%e8%b4%a6%e5%8f%b7%e7%9a%84%e6%b6%88%e6%81%af%e5%8a%a0%e8%a7%a3%e5%af%86%e7%a4%ba%e4%be%8b%e4%bb%a3%e7%a0%81/feed/</wfw:commentRss>
			<slash:comments>0</slash:comments>
		
		
			</item>
	</channel>
</rss>
