# Message Queue Notifier

This is a Laravel based service that receives messages from a queue (Redis), sends notifications via different channels like email, SMS, Slack etc.

## Features

- Receive messages from Redis queue
- Messages contain channel, type and body
- Support for email, SMS, Slack, Teams, webhooks and more channels
- Retry failed notifications up to 3 times
- CLI command to test sending sample messages

## Usage

1. Clone the repo
2. Configure .env with queue driver and channel credentials
3. `composer install`
4. `php artisan migrate`
5. `php artisan queue:work --queue=<channel>` to start listener
6. `php artisan app:test-message-command {channel} {type} {body} {receiver} {action?}` to send test notification

## Configuration

The following services need to be configured:

- Queue driver (Redis)
- Notification channels
    - email
    - nexmo
    - slack

See `.env.example` for required env variables.
