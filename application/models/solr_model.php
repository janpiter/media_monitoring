<?php

class solr_model extends CI_Model {
    
    /**
     * Get numcount, document, facet
     * @param string $query     : basic query (for detail query) ex. '"bandung" OR "jakarta"'
     * @param string $sort      : sort ex. 'pubDate desc, id asc'
     * @param int $offset       : default 0
     * @param int $limit        : default 10
     * @param array $queryAnd   : additional query operation AND
     * @param array $facet      : facet field ex.
     * @param array $adds       : facet.mincount, facet.offset, facet.limit, fq
     * @return array
     */
    function getDocument($query, $sort = NULL, $offset=0, $limit=10, 
            $queryAnd = array(), $facet = array(), $adds = array()) {
        
        $solr_conf = $this->config->item('solr_news');
        $this->solr_url->get_base_url($solr_conf);
        
        $this->solr_url->getQuery($query, $queryAnd);
        // SORT
        if ($sort) {
            $this->solr_url->getSort($sort);
        }

        $this->solr_url->getFacet($facet, $adds);
        
        //create URL now!!
        $url = $this->solr_url->generate_solr_url('json', $offset, $limit);

        //Parse json object
        $solr = solrResult_json_parser($url, $facet);
        
        return $solr;
    }
    
    
    /**
     * Get numcount
     * @param string $query     : basic query (for detail query) ex. '"bandung" OR "jakarta"'
     * @param array $queryAnd   : additional query operation AND
     * @return int
     */
    function getCount($query, $queryAnd = array()) {        
        $solr_conf = $this->config->item('solr_news');
        $this->solr_url->get_base_url($solr_conf);
        
        $this->solr_url->getQuery($query, $queryAnd);
        $url = $this->solr_url->generate_solr_url('json', 0, 1);

        //Parse json object
        $solr = solrResult_json_parser($url);
        
        return $solr['count'];
    }
    
    /**
     * Get numcount, facet
     * @param string $query     : basic query (for detail query) ex. '"bandung" OR "jakarta"'
     * @param array $queryAnd   : additional query operation AND
     * @param array $facet      : facet field ex.
     * @param array $adds       : facet.mincount, facet.offset, facet.limit, fq
     * @return array
     */
    function getFacet($query, $queryAnd = array(), $facet = array(), $adds = array()) {        
        $solr_conf = $this->config->item('solr_news');
        $this->solr_url->get_base_url($solr_conf);
        
        $this->solr_url->getQuery($query, $queryAnd);
        $this->solr_url->getFacet($facet, $adds);
        
        //create URL now!!
        $url = $this->solr_url->generate_solr_url('json', 0, 1);

        //Parse json object
        $solr = solrResult_json_parser($url, $facet);
        
        return array("count" => $solr['count'], "facet" => $solr['facet']);
    }
    
    
    function getDashboardData() {
        $today = date("Ymd");
        $query = 'pub_day:' . $today;
        $queryAnd = array('with_pic' => 1);
        $facet = array('media');
        $facetAdds = array('facet.mincount' => 1, 'facet.limit' => 300);
        
        $solr = $this->getDocument($query, "pubDate desc", 0, 10, $queryAnd, $facet, $facetAdds);
        
        //get count value
        $data['total'] = $solr['count'];

        //get results
        $data['last_news'] = $solr['results']; //json object
        //get facet 
        $facet = $solr['facet']; //array()               
        arsort($facet['media']);
        $data['per_media'] = $facet['media'];

//        $this->mith_func->debugVar($data['last_news']);

        return $data;
    }

}
