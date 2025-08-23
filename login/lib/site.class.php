<?php
/**
 * Site Class
 */
class Site extends Database {
    /**
     * Init
     */
    protected $database = 'enrichment_edu';

    /**
     * Create
     * @param  sql, parameters
     * @return boolean
     */
    static function create($sql, $parameters=array(), $init=null){
        return Database::create($sql, array("dbname"=>(new Site())->database), $parameters);
    }

    /**
     * Create Last Insert Id
     *
     * @return string
     */
    static function createLastInsertId($sql, $parameters=array(), $init=null){
        return Database::createLastInsertId($sql, array("dbname"=>(new Site())->database), $parameters);
    }

    /**
     * Update
     * @param  sql, parameters
     * @return boolean
     */
    static function update($sql, $parameters=array(), $init=null){
        return Database::update($sql, array("dbname"=>(new Site())->database), $parameters);
    }

    /**
     * Delete
     * @param  sql, parameters
     * @return boolean
     */
    static function delete($sql, $parameters=array(), $init=null){
        return Database::delete($sql, array("dbname"=>(new Site())->database), $parameters);
    }

    /**
     * One
     * @param  sql, parameters
     * @return array
     */
    static function one($sql, $parameters=array(), $init=null){
        $result = Database::query($sql, array("dbname"=>(new Site())->database), $parameters);
        return ( isset($result[0]) ? $result[0] : null );
    }

    /**
     * Sql
     * @param  sql, parameters
     * @return array
     */
    static function sql($sql, $parameters=array(), $init=null){
        return Database::query($sql, array("dbname"=>(new Site())->database), $parameters);
    }

}
?>