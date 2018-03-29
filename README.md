# laravel-plonk

Library for image management in Laravel 5

## Installation

Add the following to the `repositories` section of your composer.json

```
"repositories": [
    {
        "url": "https://github.com/Metrique/laravel-plonk",
        "type": "git"
    }
],
```

1. Add `"Metrique/laravel-plonk": "dev-master"` to the require section of your composer.json.
2. Add `Metrique\Plonk\PlonkServiceProvider::class,` to your list of service providers. in `config/app.php`.
3. `composer update`
4. `php artisan migrate`

### Config
You can publish the  `config/plonk.php` config file to your application config directory by running `php artisan vendor:publish --tag="laravel-plonk"`

### Migrations
laravel-building migrations will be automatically run when the `php artisan migrate` command is executed.

### Routes
laravel-plonk ships with a default set of resource controllers of which you can easily adjust the url 'prefix' for via the config file.

If you prefer more fine grained control then you may extend the `PlonkServiceProvider.php` file into your own application, and override the `bootRoutes` method.

### Views
If you wish to customise the views for your own application then you may extend the PlonkController and change the views properties to reflect your own views. Copying the default plonk views makes a good base for building on.

### Vue Component
Browse and select images via the the included vue component. Enable api routes to use.

#### Configuration
| Property                   | Type    | Default       | Description                                                        |
|----------------------------|---------|---------------|--------------------------------------------------------------------|
| apiPath                    | String  | /api/plonk    | The path to plonk's api.                                           |
| hashInputName              | String  | image         | The name of the input that holds the selected image plonk hash id. |
| hashInputValue             | String  |               | The default value for the hash input.                              |
| imagePath                  | String  |               | The image prefix path.                                             |
| modalTitle                 | String  | Image Library | The title of the image library modal.                              |
| openImageLibraryButtonText | String  | Select Image  | The button text that launches the image library.                   |
| previewImgSrc              | String  |               | The default src for the preview image.                             |
| removeImageButtonText      | String  | Remove Image  | The button text that removes an image.                             |
| showHashInput              | Boolean | false         | Display the selected image input.                                  |
| showPreviewImage           | Boolean | true          | Display a preview of the selected image.                           |
| showSearch                 | Boolean | true          | Allow the image library to be searched.                            |
