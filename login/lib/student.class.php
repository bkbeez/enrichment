<?php
/**
 * Student Class
 */
class Student extends Database {
    /**
     * Init
     */
    protected $database = 'registration';
    protected $host = RG_HOST;
    protected $user = RG_USER;
    protected $pass = RG_PASS;

    /**
     * Create
     * @param  sql, parameters
     * @return boolean
     */
    static function create($sql, $parameters=array(), $init=null){
        return Database::create($sql, array("host"=>(new Student())->host, "dbname"=>(new Student())->database, "username"=>(new Student())->user, "password"=>(new Student())->pass), $parameters);
    }

    /**
     * Create Last Insert Id
     *
     * @return string
     */
    static function createLastInsertId($sql, $parameters=array(), $init=null){
        return Database::createLastInsertId($sql, array("host"=>(new Student())->host, "dbname"=>(new Student())->database, "username"=>(new Student())->user, "password"=>(new Student())->pass), $parameters);
    }

    /**
     * Update
     * @param  sql, parameters
     * @return boolean
     */
    static function update($sql, $parameters=array(), $init=null){
        return Database::update($sql, array("host"=>(new Student())->host, "dbname"=>(new Student())->database, "username"=>(new Student())->user, "password"=>(new Student())->pass), $parameters);
    }

    /**
     * Delete
     * @param  sql, parameters
     * @return boolean
     */
    static function delete($sql, $parameters=array(), $init=null){
        return Database::delete($sql, array("host"=>(new Student())->host, "dbname"=>(new Student())->database, "username"=>(new Student())->user, "password"=>(new Student())->pass), $parameters);
    }

    /**
     * One
     * @param  sql, parameters
     * @return array
     */
    static function one($sql, $parameters=array(), $init=null){
        $result = Database::query($sql, array("host"=>(new Student())->host, "dbname"=>(new Student())->database, "username"=>(new Student())->user, "password"=>(new Student())->pass), $parameters);
        return ( isset($result[0]) ? $result[0] : null );
    }

    /**
     * Sql
     * @param  sql, parameters
     * @return array
     */
    static function sql($sql, $parameters=array(), $init=null){
        return Database::query($sql, array("host"=>(new Student())->host, "dbname"=>(new Student())->database, "username"=>(new Student())->user, "password"=>(new Student())->pass), $parameters);
    }

}
?>