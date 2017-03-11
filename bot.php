<?php
define("CHANNEL_TOKEN", 'SMYNoJUaCeRSLcQNK2pYwx1IvTrHhxh4mIQL/tweCR8/4hMuiB72A7XDp6mMDWLQoCL45e1uOmdy4zrUza0B1i20us0ITw7B/+CvixgEX6p6Kzgne9C0NlqbFqDGw71dgB6ywQNX/PQiUpVUPYXXNgdB04t89/1O/w1cDnyilFU=');
define("CHANNEL_SECRET", 'b41689685c7ba1f9c06cf19f91153138');

require __DIR__."/../vendor/autoload.php";

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('CHANNEL_TOKEN');
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '<CHANNEL_SECRET']);

$content = file_get_contents('php://input');
$events = json_decode($content, true);
if (!is_null($events['events'])) {
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			$text = $event['message']['text'];
			$replyToken = $event['replyToken'];

			$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($text);
			$response = $bot->replyMessage($replyToken, $textMessageBuilder);
		}
}
?>