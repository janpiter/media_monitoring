<?php

class solr_model extends CI_Model {

    function getNewsToday(){
        $solr_conf = $this->config->item('solr_news');
        
        $today = date("Ymd");
        $query = 'pub_day:'.$today;
        $inputArr = array();
        $facetArr = array('pub_hour', 'media');

        //call methods  
        $this->solr_url->get_base_url($solr_conf);
        $this->solr_url->getQuery($query, $inputArr);
        $this->solr_url->getSort('pubDate', 'desc');
        $this->solr_url->getFacet($facetArr, 1, NULL, 300);
        
        //create URL now!!
        $url = $this->solr_url->echo_solr_url('json', "0", "1");        
        
        //Parse json object
        $solr = solrResult_json_parser($url, $facetArr);

        //get count value
        $data['total'] = $solr['count'];
        
        //get results
        $data['last_news'] = $solr['results'][0];//json object
        
        //get facet 
        $facet = $solr['facet'];//array()               
        $data['per_hour'] = $facet['pub_hour'];
        arsort($facet['media']);
        $data['per_media'] = $facet['media'];
        
//        $this->mith_func->debugVar($data['last_news']);
        
        return $data;
    }
}