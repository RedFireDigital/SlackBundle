# Slack Bundle for Symfony

[![Packagist](https://img.shields.io/packagist/l/doctrine/orm.svg)](https://packagist.org/packages/partfire/slack-bundle)
[![Twitter Follow](https://img.shields.io/twitter/follow/espadrine.svg?style=social&label=Follow)](https://twitter.com/partfire)

A set of Symfony services for use in your project to ease integration with Slack. 

This bundle depends upon the [official slack SDK PHP](https://github.com/threadmeup/slack-sdk).  

## Installation

Using composer you can simply require master for now until we have a stable release:

    $ composer require partfire/slack-bundle:dev-master
    
## Configuration

Add your details to your `app/config/parameters.yml` file.  For example:
```yaml
    slack_token: 123456789XXXXXXX
    slack_username: My-Website
    slack_team: My-Team
```

slack_username refers to the name that will appear in the channel.  Slack team is the team name when you created your team via Slack.

Also add to your `app/AppKernel.php` file:

```php
    new PartFire\SlackBundle\PartFireSlackBundle()
```

## Example Usage

### Send a Message from a controller

```php
    $userService = $this->container->get('part_fire_mango_pay.services.user');
    
    $this->container->get('part_fire_slack_service')->sendMessage(
        "This is an example message",
        'some-channel-name',
        ':muscle:'
    );
 ```
 
You can also use this service from any other class by simply injecting it if you are using the Symfony DI Container.
E.g. you can add the following to the services.yml for your custom class to inject the messaging service:

```yaml
    my_vendor_class_entry_name:
      class: MyVendor\MyBundle\MyClasses\MyClass
      arguments: ['@part_fire_slack_service']
```
 
## Service List

    part_fire_slack_service
    

### Contributing

Feel free to add more methods to the services etc and create a pull request.  I will merge them in if they follow the existing structure or you teach me a better way.
