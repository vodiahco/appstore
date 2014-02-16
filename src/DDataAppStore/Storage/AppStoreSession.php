<?php

namespace DDataAppStore\Storage;
use DDataAppStore\Base\StorageInterface;
use DDataAppStore\Entity\AppStore;
use Zend\Session\Container as SessionContainer;
use Zend\Session\ManagerInterface as SessionManager;
use DDataAppStore\Base\StorageEntityInterface;
use Zend\Authentication\AuthenticationService;
/**
 * Description of AppStoreSession
 *
 * @author victor
 */
class AppStoreSession implements StorageInterface{
    
    
    
    
   /**
     * Default session namespace
     */
    const NAMESPACE_DEFAULT = 'Ddata_App_Store';

    /**
     * Default session object member name
     */
    const MEMBER_DEFAULT = 'appStore';

    /**
     * Object to proxy $_SESSION storage
     *
     * 
     */
    protected $session;
    
    
    /**
     * Session namespace
     *
     * @var mixed
     */
    protected $namespace = self::NAMESPACE_DEFAULT;

    /**
     * Session object member
     *
     * @var mixed
     */
    protected $member = self::MEMBER_DEFAULT;

   
    
    function __construct($namespace=null, $member=null,StorageEntityInterface $appStore=null,SessionManager $manager = null) {
        if(null!==$namespace)
        $this->namespace = $namespace;
        
        if(null!==$member)
        $this->member = $member;
        
        $this->session   = new SessionContainer($this->namespace, $manager);
        
        if(null==$this->session->{$this->member})
        {
         $appStore= ($appStore instanceof StorageEntityInterface)?$appStore: new AppStore();
        $this->session->{$this->member}= $appStore;
        }
    }

    
    
   
    

    /**
     * @return  void 
     */
    public function clear() {
      unset($this->session->{$this->member});   
    }

    /**
     * tests if session is set
     * @return boolean
     */
    public function isEmpty() {
      return !isset($this->session->{$this->member});  
    }

    /**
     * return the Appstore object
     * @return \DDataAppStore\Base\StorageEntityInterface
     */
    public function read() {
        return $this->session->{$this->member};
    }

    /**
     * writes a value to the Appstore object
     * it maps the array key to an object property
     * throw an exception if property does not exist.
     * @param array $contents
     * @throws \Exception
     */
    public function write($contents) {
        if(!is_array($contents)|| empty($contents))
           throw new \Exception("Not a valid array");
        $appStore=$this->session->{$this->member};
        if(!$appStore instanceof AppStore)
            throw new \Exception("Storage entity must be instance of ".  get_class(new AppStore));
        foreach($contents as $key=>$value)
        {
            if(!property_exists($appStore, $key))
                      throw new \Exception(get_class($appStore)." does not have $key a property");
        $appStore->$key = $value;
        }
    }
    
    /**
     * sets the AppStore object
     * this method overwrites the entire object
     * @param \DDataAppStore\Base\StorageEntityInterface $appStore
     */
    public function set(StorageEntityInterface $appStore) {
        $this->session->{$this->member}=$appStore;
    }

}
