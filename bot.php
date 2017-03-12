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
    if ($event instanceof \LINE\LINEBot\Event\MessageEvent\TextMessage) {
        $reply_token = $event->getReplyToken();
        $text = $event->getText();
		$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($text . "\r\n #พี่หมีกล่าว...");
		$templateBuilder = new \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder('Main Menu', new ButtonTemplateBuilder(
                    'button title',
                    'button button',
                    'https://example.com/thumbnail.jpg',
                    [
                        new PostbackTemplateActionBuilder('postback label', 'post=back'),
                        new MessageTemplateActionBuilder('message label', 'test message'),
                        new UriTemplateActionBuilder('uri label', 'https://example.com'),
                    ]
                )
			)

		$response = $bot->replyMessage($reply_token, $textMessageBuilder);
		echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
	}
}
?>