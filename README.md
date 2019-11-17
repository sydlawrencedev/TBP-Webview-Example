# Simple Webview example

This is just a simple example to show how you can call a webview within a bot, obtain who the user is using the webview, and then also save the responses back in the bot platform as attributes

## Data flow

1) Person responds via webview which needs to be hosted on your infrastructure
2) Webview posts data to your infrastructure
3) Person tells bot that they've done it
4) TBP posts webhook to your infrastructure to check data was received
5) Your infrastructure responds to the webhook with the correct response and setting the data as attributes for the person using the bot
6) TBP then has the responses as attributes

## Troubleshooting

- Facebook aggresively caches the contents on the webview
- A webview has to be accessed via https for the messenger extensions to work
- The domain must be whitelisted
- The correct app id needs to be used
- Make sure your webhook response is setting the attribute using '$name', rather than just 'name'
- Escape the $ using \$ in any PHP


