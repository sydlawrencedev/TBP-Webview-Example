# Simple Webview example

This is just a simple example to show how you can call a webview within a bot, obtain who the user is using the webview, and then also save the responses back in the bot platform as attributes

## Troubleshooting

- Facebook aggresively caches the contents on the webview

- A webview has to be accessed via https for the messenger extensions to work

- The domain must be whitelisted

- Make sure your webhook response is setting the attribute using '$name', rather than just 'name'

- Escape the $ using \$ in PHP


