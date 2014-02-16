
AppStoreSession
=====

The AppStore is a wrapper around the Zend framework Session container, it is designed to persist structured data in the session.
The Appstore manages an Entity (an implementation of DDataAppStore\Base\StorageEntityInterface ) in the session storage. 
Only properties defined in the DDataAppStore\Base\StorageEntityInterface class will be passed into the session entity object. It throws an exception if property does not exist.


## Requirements
The requirements of this module is listed in composer.json.
## Installation
1. require "DomainData/AppStore" : "dev-master", in your composer.json and run composer update
2. Enable the DDataAppStore module in config/application.config.php file


        "require": {
            "php": ">=5.3.3",
            "zendframework/zendframework": "2.2.*",
            "DomainData/AppStore" : "dev-master"

        },
        "repositories": [
            {
            "type":"vcs",
            "url": "https://github.com/vodiahco/appstore.git"
            }
        ]

## Usage in your controller. 

You can simple instantiate the AppStoreSession with the default options like this:
        $appStore= new AppStoreSession();
Or 
        $storeEntity= new \DDataAppStore\Entity\AppStore();
        $store= new AppStoreSession(“namespace”,”storage_name”,$storeEntity, $sessionManager);

You can use a custom session entity object that implements DDataAppStore\Base\StorageEntityInterface.
or extends the DDataAppStore\Base\AppStore.
        $newStoreEntity= new MyStorageEntity()
        $store= new AppStoreSession(“my_namespace”,”storage_name”,$newStoreEntity, $sessionManager);

        $store->read() // returns the (store entity object) $storeEntity.
        $store->write(array(“returnUrl”=>”site/profile”); it accepts an array and maps the array key to the entity property and assigns the array value to the property.
        $store->set($anotherStoreEntity) overwrites the entire entity object in the session.
        $store->clear() clears the session entity object;

        $entity=$store->read();
        $entity->returnUrl="site/newpage"; or $entity->setReturnUrl(“site/newpage”)




