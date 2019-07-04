<?php
class DB{
    private static $_instance = null;
    private $_pdo, $_query, $_error = false, $_results, $_count = 0;

    public function error(){
        return $this->_error;
    }
    public function all(){
        return $this->_results;
    }
    public function first(){
        return $this->all()[0];
    }
    public function count(){
        return $this->_count;
    }
    public static function toJSON($object){
        return json_encode($object);
    }
    /*
    *   Private constructor is accessed only with the static method getInstance().
    *   When we call DB class the script goes to public function getInstance() and 
    *   sets $instance variable to the instance of connection. This way if we try 
    *   to connect again the $instance is already set.
    *   @param: no parameters
    *   @return: void
    */
    private function __construct(){
        try{
            $this->_pdo = new PDO("mysql:host=" . Config::get('mysql/host') . ";dbname=" . Config::get('mysql/dbname') ."", Config::get('mysql/username'), Config::get('mysql/password'));
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
    /**
     *      Sets the _instance variable to the new instance of the DB object.
     *      @param: no parameters
     *      @return self::$_instance
     */
    public static function getInstance(){
        if(!isset(self::$_instance)){
            self::$_instance = new DB();
        }
        return self::$_instance;
    }
    /**
     *      Prepares the query statement and queries the database.
     *      @param: $sql - prepared query statement
     *      @param: $params - parameters for the prepared query
     *      @return DB bool
     */
    public function query($sql, $params = array()){
        $this->_error = false;
        $this->_query = $this->_pdo->prepare($sql);
        if(count($params)){
            $paramIndex = 1;
            foreach($params as $param){
                $this->_query->bindParam($paramIndex, $param);
                $paramIndex++;
            }
        }
        if($this->_query->execute($params)){
            $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
            $this->_count = $this->_query->rowCount();
            if($this->_results){
                $this->_error = false;
            }else{
                $this->_error = true;
            }
        }else{
            $this->_error = true;
        }
        return $this;
    }
    public function runSQL($sql, $params = array()){
        $this->_error = false;
        $this->_query = $this->_pdo->prepare($sql);
        if(count($params)){
            $paramIndex = 1;
            foreach($params as $param){
                $this->_query->bindParam($paramIndex, $param);
                $paramIndex++;
            }
        }
        if($this->_query->execute($params)){
            $this->_error = false;
            return true;
        }else{
            $this->_error = true;
        }
        return $this;
    }
    /**
     *      action function is a helper function for preparing the query statmenent 
     *      in which you can define the parameters of a query with WHERE SQL ketword
     *      @param: $action - which type of action you want to perform on a database(SELECT, DELETE)
     *      @param: $table - name of the table in the database
     *      @param: $where String[] array with three strings defining the where clause of a query. [field, operator, value]
     *      @return boolean
     */
    private function action($action, $table, $where = array()){
        if(count($where) == 3){
            $operators = array('=', '<', '>', '<=', '>=', '!=');
            $field      = $where[0];
            $operator   = $where[1];
            $value      = $where[2];

            if(in_array($operator, $operators)){
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
                $this->query($sql, array($value));
                return $this;
            }
        }
    }
    public function get($table, $where = array()){
        return $this->action('SELECT *', $table, $where);
    }
    public function delete($table, $where){
        return $this->action('DELETE', $table, $where);
    }

    public function delete_by_id($table, $id){
        if(Session::exists('user')){
            try{
                $primary_key = "tables/{$table}/primary_key";
                self::getInstance()->delete($table, array(Config::get($primary_key), '=', $id));
                Redirect::to('students');
            }catch(PDOException $exception){
                echo $exception->getMessage();
            }
        }else{
            Redirect::to('login');
        }
    }

    public function insert($table, $fields = array()){
        if(count($fields)){
            $keys = array_keys($fields);
            $values = null;
            $fieldsCounter = 1;
            foreach($fields as $field){
                $values .= '?';
                if($fieldsCounter < count($fields)){
                    $values .= ', ';
                }
                $fieldsCounter++;
            }
            $sql = "INSERT INTO {$table} (`" . implode('`, `', $keys) . "`) VALUES ({$values})";
            if($this->query($sql, array_values($fields))->error()){
                return true;
            }else{
                echo "Not inserted";
            }
        }
        return false;
    }
    public function update($table, $id, $fields){
        $counter = 1;
        $set = '';
        foreach($fields as $data => $value){
            $set .= "{$data}=?";
            if($counter < count($fields)){
                $set .= ', ';
            }
            $counter++;
        }
        $sql = "UPDATE {$table} SET {$set}WHERE id = {$id}";
        if(!$this->runSQL($sql, array_values($fields))->error()){
            return true;
        }else{
            echo "Did not update";
        }

    }

}