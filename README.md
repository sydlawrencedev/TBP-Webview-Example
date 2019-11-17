# Simple Webview example

This is just a simple example to show how you can call a webview within a bot, obtain who the user is using the webview, and then also save the responses back in the bot platform as attributes

<img src="/screenshots/webview.gif?raw=true" width="200px" alt="Webviews in Workplace by Facebook bots powered by The Bot Platform">


## Step by step

1) Upload this code to an https domain such as `https://example.com/webview/`
2) Create a new bot on the bot platform
3) Create a success message and an error message, note down the message ids and change them in the code for `https://example.com/webview/webhook.php`
4) Create new attributes in the bot platform, `switch` & `text`
5) Whitelist your domain on the bot platform
6) Create a message on the bot platform that has a button that opens the url `https://example.com/webview/index.html`
7) Create a message on the bot platform which has a webhook part calling `https://example.com/webview/webhook.php`
8) Create a message after the webhook part that uses the variables `{{$switch}}` & `{{$text}}`

## Data flow

1) Person responds via webview which needs to be hosted on your infrastructure
2) Webview posts data to your infrastructure
3) Person tells bot that they've done it
4) TBP posts webhook to your infrastructure to check data was received
5) Your infrastructure responds to the webhook with the correct response and setting the data as attributes for the person using the bot
6) TBP then has the responses as attributes to be used within messages

## Troubleshooting

- Facebook aggresively caches the contents on the webview
- A webview has to be accessed via https for the messenger extensions to work
- The domain must be whitelisted
- The correct app id needs to be used
- Make sure your webhook response is setting the attribute using '$name', rather than just 'name'
- Escape the $ using \$ in any PHP


