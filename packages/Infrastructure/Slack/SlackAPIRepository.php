<?php

declare(strict_types=1);

namespace packages\Infrastructure\Slack;

use Exception;
use GuzzleHttp\Client;
use packages\Domain\Domain\Slack\SlackAPIRepositoryInterface;

class SlackAPIRepository implements SlackAPIRepositoryInterface
{
    /**
     * chat.postMessage API のエンドポイント
     */
    private const CHAT_POST_MESSAGE = 'https://slack.com/api/chat.postMessage';

    /**
     * @var Client $client
     */
    private Client $client;

    /**
     * @param Client $client
     *
     * @return void
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Slackeへメッセージ送信
     *
     * @param string $message
     *
     * @return bool
     */
    public function postMessage(string $message): bool
    {
        $result = false;

        try {
            $response = $this->client->post(
                self::CHAT_POST_MESSAGE,
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . config('services.slack.bot_token'),
                        'Content-Type' => 'application/json;charset=utf-8',
                    ],
                    'json' => [
                        'channel' => config('services.slack.send_channel'),
                        'text' => config('services.slack.message_prefix') . $message,
                    ],
                ]
            );

            if ($response->getStatusCode() !== 200 || ! (json_decode($response->getBody()->getContents()))->ok) {
                $result = false;
            }

            $result = true;
        } catch (Exception $exception) {
            $result = false;
        }

        return $result;
    }
}
