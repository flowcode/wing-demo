<?php

namespace flowcode\aire\service;

use flowcode\aire\dao\TagDao;
use flowcode\aire\domain\Tag;

/**
 * Description of TagService
 *
 * @author juanma
 */
class TagService {
    private $tagDao;
    
    public function __construct() {
        $this->tagDao = new TagDao();
    }
    
    public function findAll(){
        return $this->tagDao->findAll();
    }
    
    public function save(Tag $tag){
        return $this->tagDao->save($tag);
    }
    
    public function delete(Tag $tag){
        $this->tagDao->delete($tag);
    }
    
    
    public function findById($id){
        return $this->tagDao->findById($id);
    }
    
    /**
     * Find all tags by filter.
     * @return \flowcode\wing\utils\Pager. 
     */
    public function findByFilter($filter = null, $page = 1) {
        $pager = $this->tagDao->findByFilter($filter, $page);
        return $pager;
    }
    
    
}

?>
