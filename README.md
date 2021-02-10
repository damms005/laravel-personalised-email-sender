# laravel-personalised-email-sender

![Art for laravel-personalised-email-sender](https://banners.beyondco.de/Laravel%20Personalised%20Email%20Sender.png?theme=light&packageManager=composer+require&packageName=damms005%2Flaravel-personalised-email-sender&pattern=plus&style=style_1&description=Quickly+send+customized+emails+from+Excel+or+CSV+files%3A+Vue+powered%21&md=1&showWatermark=1&fontSize=100px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg&widths=350)

Quickly send customised emails from Excel or CSV files: Vue powered! (an implementation of [vue-email-personaliser](https://github.com/damms005/vue-email-personaliser))

This sample Laravel project demonstrates how [vue-email-personaliser](https://github.com/damms005/vue-email-personaliser) can be implemented.

To publish the assets, run

```
php artisan vendor:publish --tag=laravel-personalised-email-sender
```

## Usage

This package registers an endpoint at `/laravel-personalised-email-sender` in your Laravel app. After publishing the assets as describe above, simply navigate to this endpoint to start customising your emails to personalize your recipients' experience!

You simply need to use {{moustache}} syntax (like in [Blade](https://laravel.com/docs/8.x/blade)) to customise the content of your mail. For more information on how the formatting works, visit the [underlying formatter](https://github.com/damms005/vue-email-personaliser).

## Todo

- Make README.md more informative by adding simple installation guide for a typical Laravel project, etc
- Add link to blog post with details on use-case
- Write feature tests
