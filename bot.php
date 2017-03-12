<?php
define("CHANNEL_TOKEN", 'SMYNoJUaCeRSLcQNK2pYwx1IvTrHhxh4mIQL/tweCR8/4hMuiB72A7XDp6mMDWLQoCL45e1uOmdy4zrUza0B1i20us0ITw7B/+CvixgEX6p6Kzgne9C0NlqbFqDGw71dgB6ywQNX/PQiUpVUPYXXNgdB04t89/1O/w1cDnyilFU=');
define("CHANNEL_SECRET", 'b41689685c7ba1f9c06cf19f91153138');

require __DIR__."/vendor/autoload.php";

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(CHANNEL_TOKEN);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => CHANNEL_SECRET]);

$signature = $_SERVER["HTTP_".\LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];
$body = file_get_contents("php://input");

$events = $bot->parseEventRequest($body, $signature);

foreach ($events as $event) {
    error_log(print_r('===== Start =====', TRUE));
    if ($event instanceof \LINE\LINEBot\Event\MessageEvent\TextMessage) {
        $reply_token = $event->getReplyToken();
        $text = $event->getText();
        if (strpos(strtolower($text), 'start') !== false || strpos(strtolower($text), 'main') !== false) {
            $buttonTemplateBuilder = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder(
                'Main Menu', '#พี่หมีกล่าว...', 'https://dl.dropboxusercontent.com/u/76796733/teddiursa%20.png',
                [
                    //new \LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder('postback label', 'post=back'),
                    new \LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder('Order Product', 'Order Product'),
                    new \LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder('More Information', 'https://www.google.com'),
                ]
            );
            $templateMessageBuilder = new \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder('Main Menu', $buttonTemplateBuilder);
        }
        else {
            $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($text . "\r\n #พี่หมีกล่าว...");
        }
        $response = $bot->replyMessage($reply_token, $templateMessageBuilder);
        error_log(print_r($response->getHTTPStatus() . ' ' . $response->getRawBody(), TRUE));
	}
	elseif ($event instanceof \LINE\LINEBot\Event\MessageEvent\StickerMessage) {
        $reply_token = $event->getReplyToken();
        $stickerMessageBuilder = new \LINE\LINEBot\MessageBuilder\StickerMessageBuilder('1','1');
        $response = $bot->replyMessage($reply_token, $stickerMessageBuilder);
        error_log(print_r($response->getHTTPStatus() . ' ' . $response->getRawBody(), TRUE));
    }
    error_log(print_r('===== End =====', TRUE));
}