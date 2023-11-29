<?php
//main model class

class Model extends Database
{

    protected $table = "";

    //to insert into databse
    public function insert($data)
    {

        //remove unwanted fields
        if (!empty($this->allowedColumns)) {

            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);

        $query = "INSERT INTO " . $this->table;
        $query .= "(" . implode(",", $keys) . ") values (:" . implode(",:", $keys) . ")";

        //we can call query qithout creating new database instance since we inherit 
        // this class from database class
        $this->query($query, $data);
        show($query);
        show($data);
    }

    //inner join
    //$tables- array of table names that need to be joined with $this->table
    //$joinCOnditions = array of join conditions for each join
    //$data = conditions for where clauses
    //$selectColumns= columns that they need. SHoould not be ambiguous =  ['lastName','user.userID']
    //NOTE: Where clause is expanaded in here. not using key value pairs for PDO using $key=:$key. 
    // There for no need to send the $data to PDO
    public function innerJoin($tables = [], $joinConditions = [], $data = [], $selectColumns = ['*'])
    {
        if (count($tables) < 1 && count($tables) == count($joinConditions)) {
            return false; // Need atleast one more table than $this->table to use innerjoin
        }

        $query = "SELECT " . implode(", ", $selectColumns) . " FROM " . $this->table;
        //adding inner joins
        for ($i = 0; $i < count($tables); $i++) {

            $query = $query . " INNER JOIN " . $tables[$i] . " ON ";

            //adding join condition if mentioned, else add default
            $query = $query . $joinConditions[$i] . " ";
        }

        //adding where conditions
        if (!empty($data)) {
            $keys = array_keys($data);
            $query = $query . "WHERE ";
            foreach ($keys as $key) {
                $query .= $key . "=" . $data[$key] . " && ";
            }

            //remove the additional '&&' 
            $query = trim($query, "&& ");
        }
        // show($query);
        // show($data);
        // die;

        //since $data for where clause is expanded in here, no need to send the data to PDO
        //didnt use $key:=$key
        $res = $this->query($query, $data = []);

        if (is_array($res)) {
            return $res;
        } else return false;
    }

    //left outer join
    public function leftOuterJoin($tables = [], $joinConditions = [], $data = [], $selectColumns = ['*'])
    {
        if (count($tables) < 1 || count($tables) !== count($joinConditions)) {
            return false; // Need equal number of tables and join conditions for outer join
        }

        $query = "SELECT " . implode(", ", $selectColumns) . " FROM " . $this->table;

        // adding outer joins
        for ($i = 0; $i < count($tables); $i++) {
            $query .= " LEFT OUTER JOIN " . $tables[$i] . " ON ";
            $query .= $joinConditions[$i] . " ";
        }

        //adding where conditions
        if (!empty($data)) {
            $keys = array_keys($data);
            $query = $query . "WHERE ";
            foreach ($keys as $key) {
                $query .= $key . "=" . $data[$key] . " && ";
            }

            //remove the additional '&&' 
            $query = trim($query, "&& ");
        }
        // show($query);
        // show($data);
        // die;

        //since $data for where clause is expanded in here, no need to send the data to PDO
        //didnt use $key:=$key
        $res = $this->query($query, $data = []);

        if (is_array($res)) {
            return $res;
        } else return false;
    }


    //update
    public function update($data, $id)
    {

        //remove unwanted fields
        if (!empty($this->allowedColumns)) {

            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);

        $query = "update " . $this->table . " set ";

        foreach ($keys as $key) {
            $query .= $key . "=:" . $key . ",";
        }
        $query = trim($query, ",");
        $query .= " WHERE " . $this->primaryKey . "=:id";

        //adding id into the array before executing 
        $data['id'] = $id;
        // show($query);
        // die;
        // show($query);
        // show($data);
        // die;
        //we can call query qithout creating new database instance since we inherit 
        // this class from database class
        $this->query($query, $data);
        // show($query);
        // show($data);
    }

    //delete form database
    public function delete(int $id): bool
    {
        $query = "DELETE FROM " . $this->table . " WHERE " . $this->primaryKey . "=:id limit 1";
        $this->query($query, ['id' => $id]);
        return true;
    }


    //to check and get from databse 'where' as arry of objects
    public function where($data)
    {

        $keys = array_keys($data);

        $query = "SELECT * FROM " . $this->table . " WHERE ";

        foreach ($keys as $key) {
            $query .= $key . "=:" . $key . " && ";
        }

        //remove the additional '&&' 
        $query = trim($query, "&& ");

        //we can call query qithout creating new database instance since we inherit 
        // this class from database class
        $res = $this->query($query, $data);
        // show($query);
        // show($data);

        if (is_array($res)) {
            return $res;
        } else return false;
    }

    //get all rows 
    public function getAll()
    {

        $query = "SELECT * FROM " . $this->table;

        $res = $this->query($query);

        if (is_array($res)) {
            return $res;
        } else return false;
    }
    //to check and get first record that find from databse (returns 1 object)
    public function first($data)
    {

        $keys = array_keys($data);

        $query = "SELECT * FROM " . $this->table . " WHERE ";

        foreach ($keys as $key) {
            $query .= $key . "=:" . $key . " && ";
        }

        //remove the additional '&&' 
        $query = trim($query, "&& ");
        $query .= " ORDER BY " . $this->primaryKey . " DESC LIMIT 1"; //get the first latest record from 

        //we can call query qithout creating new database instance since we inherit 
        // this class from database class
        $res = $this->query($query, $data);
        // show($query);
        // show($data);


        if (is_array($res)) {
            return $res[0]; //returning only first element of the array (an obj)
        } else return false;
    }

    //a custom function to get first record from a table which pass as a parameter
    public function getFirstCustom($table, $data, $orderByField = '')
    {

        $keys = array_keys($data);

        $query = "SELECT * FROM " . $table . " WHERE ";

        foreach ($keys as $key) {
            $query .= $key . "=:" . $key . " && ";
        }

        //remove the additional '&&' 
        $query = trim($query, "&& ");
        if ($orderByField !== '') $query .= " ORDER BY " . $orderByField . " DESC LIMIT 1"; //get the first latest record from  ordered by the given field

        //we can call query qithout creating new database instance since we inherit 
        // this class from database class
        $res = $this->query($query, $data);
        // show($query);
        // show($data);


        if (is_array($res)) {
            return $res[0]; //returning only first element of the array (an obj)
        } else return false;
    }

    //to check and get from databse 'where' as arry of objects for a given table
    public function customWhere($table, $data)
    {

        $keys = array_keys($data);

        $query = "SELECT * FROM " . $table . " WHERE ";

        foreach ($keys as $key) {
            $query .= $key . "=:" . $key . " && ";
        }

        //remove the additional '&&' 
        $query = trim($query, "&& ");

        //we can call query qithout creating new database instance since we inherit 
        // this class from database class
        $res = $this->query($query, $data);
        // show($query);
        // show($data);

        if (is_array($res)) {
            return $res;
        } else return false;
    }
}
