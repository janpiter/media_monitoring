<?php

class Solr extends CI_Controller {

    public function __construct() {
        parent::__construct();
//        $this->load->library('solr_url');
//        $this->load->helper('solr_parser_helper');
    }
    
    public function index() {
        //variables
        $solr_conf = $this->config->item('solr_news');
//        $this->mith_func->debugVar($solr_conf);
        
        $query = '("bandung"+OR+"jakarta")';
        $inputArr = array('media' => 'detik' , 'pub_day' => '20140923');
        $facetArr = array('pub_hour');

        //call methods  
        $this->solr_url->get_base_url($solr_conf);
        $this->solr_url->getQuery($query, $inputArr);
        $this->solr_url->getSort('pubDate', 'desc');
        $this->solr_url->getFacet($facetArr);
//        $this->solr_url->getFQ(array('ESI_Fields14_S'=>'Engineering'));

        //create URL now!!
        $url = $this->solr_url->echo_solr_url('json', "0", "20"); //Query url created from solr_url.php class
        echo $url;
        
        //Parse json object
        $solr = solrResult_json_parser($url, $facetArr);

        //get count value
        $count = $solr['count'];
        
        //get results
        $results = $solr['results'];//json object
        
        //get facet 
        $facet = $solr['facet'];//array()       
        
        $this->mith_func->debugVar($facet);
    }

}
