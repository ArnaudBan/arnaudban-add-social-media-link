# goliath-add-social-media-link

WordPress plugin to add the social media link

## Use

```php
if( function_exists( 'asml_social_media_menu' ) ){
    asml_social_media_menu();
}
```

## Filter the supported social media

```php
add_filter('asml_supported_social_media', function(){
  return array('twitter-alt','facebook','instagram');
});
```
