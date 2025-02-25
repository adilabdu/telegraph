---
title: 'Telegram API calls'
menuTitle: 'Telegram API calls'
description: ''
category: 'Features'
fullscreen: false 
position: 36
---

## botInfo

retrieves Bot data from Telegram APIs

```php
Telegraph::botInfo()->send();

/*
id: xxxxx
is_bot: true
first_name: telegraph-test
username: my_test_bot
can_join_groups: true
can_read_all_group_messages: false
supports_inline_queries: false
*/
```

## botInfo

retrieves the bot data from Telegram APIs

```php
Telegram::bot($telegraphBot)->botInfo()->send();
```

## botUpdates

retrieves the bot updates from Telegram APIs

```php
Telegram::bot($telegraphBot)->botUpdates()->send();
```

<alert type="alert">Manual updates polling is not available if a webhook is set up for the bot. Webhook should be remove first using its [deleteWebhook](webhooks/deleting-webhooks) methods</alert>

## chatAction

Tells the chat users that something is happening on the bot's side. The status is set for up to 5 seconds or when a new message is received from the bot.

<img src="screenshots/chat-action.png" />

```php
Telegram::chatAction(ChatActions::TYPING)->send();
```

## deleteMessage

deletes a message

```php
Telegram::deleteMessage($messageId)->send();
```

## deleteKeyboard

removes a message keyboard (see [keyboards](features/keyboards) for details)

```php
Telegram::deleteKeyboard($messageId)->send();
```

## document

sends a document

```php
Telegram::document($documentPath)->send();
```

## getWebhookDebugInfo

retrieves webhook debug data for the active bot

```php
$response = Telegram::getWebhookDebugInfo()->send();
```

## markdown

compose a new telegram message (parsed as markdown)

```php
Telegraph::markdown('*hello* world')->send();
```

## message

compose a new telegram message (will use the default parse mode set up in `config/telegraph.php`)

```php
Telegraph::message('hello')->send();
```

## html

compose a new telegram message (parsed as html)

```php
Telegraph::html('<b>hello</b> world')->send();
```

## registerBotCommands

register commands in Telegram Bot in order to display them to the user when the "/" key is pressed

```php
Telegram::registerBotCommands([
    'command1' => 'command 1 description',
    'command2' => 'command 2 description'
])->send();
```

## registerWebhook

register a webhook for the active bot

```php
Telegram::registerWebhook()->send();
```

## replaceKeyboard

replace a message keyboard (see [keyboards](features/keyboards) for details)

```php
Telegram::replaceKeyboard(
    $messageId, 
    Keyboard::make()->buttons([
        Button::make('open')->url('https://test.dev')
    ])
)->send();
```

## replyWebhook

replies to a webhook callback

```php
Telegram::replyWebhook($callbackQueryId, 'message received')->send();
```

## unregisterBotCommands

resets Telegram Bot registered commands

```php
Telegram::unregisterBotCommands()->send();
```
