<?php

namespace Component\Search;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class ElasticSearch
{
    /**
     * @var array
     */    
    protected $configuration = [];
    
    /**
     * @var LoggerInterface
     */
    protected $logger;
    
    /**
     *
     * @param array $configuration application
     * @param LoggerInterface $logger
     *
     */
    public function __construct($configuration, LoggerInterface $logger = null)
    {
        $this->configuration = $configuration;
        $this->logger = $logger;
    }
    
    /**
     *
     * @return array
     *
     */    
    protected function getHosts()
    {
        $hosts = [];
        foreach($this->configuration['clients'] as $host)
        {
            $hosts[] = $host['scheme'] . "://" .  $host['host'] . ":" . $host['port'];
        }
        return $hosts;
    }
    
    /**
     *
     * @return Elasticsearch\Client
     *
     */
    public function getInstance()
    {        
        $defaultHandler = ClientBuilder::defaultHandler(
            ['max_handles' => $this->configuration['max_handles']]
        );
        
        $client = ClientBuilder::create()
                    ->setHosts($this->getHosts())
                    ->setRetries($this->configuration['retries'])
                    ->setHandler($defaultHandler)
                    ->setLogger($this->logger)
                    ->build();
                    
        $response = $client->indices()->getMapping();
        
        //print_r($response); die;

        return $client;
    }
}