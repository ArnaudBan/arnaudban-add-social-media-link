# Add social medial ink

WordPress plugin to add the social media menu links, and social media share links.

The share links don't load any external script and do not track user

## Social media menu links

### Use

```php
if( function_exists( 'ABSocialMediaLink\social_media_menu' ) ){
    ABSocialMediaLink\social_media_menu();
}
```

### Filter the supported social media menu links

```php
add_filter('ABSocialMediaLink/supported_social_media', function(){
  return array('twitter-alt','facebook','instagram');
});
```


## Social media share links


### Links to display

```php
add_filter('ABSocialMediaLink/post_type_to_share', function(){
  return [ 'twitter','facebook','reddit'];
});
```

### Posts type to share

```php
add_filter('ABSocialMediaLink/post_type_to_share', function(){
  return [ 'post','product'];
});
```

### Display html before share links

```php
add_filter('ABSocialMediaLink/before_links', function(){
  return '<h2>Partager :</h2>';
});
```

### Display html after share links

```php
add_filter('ABSocialMediaLink/after_links', function(){
  return '<p>Merci ;-)</p>';
});
```
