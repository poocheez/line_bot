<?php
include 'vendor/autolod.php';

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('SMYNoJUaCeRSLcQNK2pYwx1IvTrHhxh4mIQL/tweCR8/4hMuiB72A7XDp6mMDWLQoCL45e1uOmdy4zrUza0B1i20us0ITw7B/+CvixgEX6p6Kzgne9C0NlqbFqDGw71dgB6ywQNX/PQiUpVUPYXXNgdB04t89/1O/w1cDnyilFU=');
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => 'https://api.line.me/v2/bot/message/reply']);
$response = $bot->replyText('<reply token>', 'hello!');

?>