<?php

class solr_model extends CI_Model {

    function getDashboardData(){
        $solr_conf = $this->config->item('solr_news');
        
        $today = date("Ymd");
        $query = 'pub_day:'.$today;
        $inputArr = array('with_pic' => 1);
        $facetArr = array('media');

        //call methods  
        $this->solr_url->get_base_url($solr_conf);
        $this->solr_url->getQuery($query, $inputArr);
        $this->solr_url->getSort('pubDate', 'desc');
        $this->solr_url->getFacet($facetArr, 1, NULL, 300);
        
        //create URL now!!
        $url = $this->solr_url->echo_solr_url('json', "0", "10");        
        
        //Parse json object
        $solr = solrResult_json_parser($url, $facetArr);

        //get count value
        $data['total'] = $solr['count'];
        
        //get results
        $data['last_news'] = $solr['results'];//json object
        
        //get facet 
        $facet = $solr['facet'];//array()               
        arsort($facet['media']);
        $data['per_media'] = $facet['media'];
        
//        $this->mith_func->debugVar($data['last_news']);
        
        return $data;
    }
}