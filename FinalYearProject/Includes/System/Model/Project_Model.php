<?php

/**
 * Description of Project_Model
 *
 * @author James
 */
class Project_Model extends Validator_Model
    {

    private
            $proj_id;
    private
            $acc_id;
    private
            $proj_nm;
    private
            $proj_descr;
    private $estimate;

    /*
     * construct new project object
     */

    public
            function __construct($row)
        {
//$this->acc_id = Account_Model::getUser($row->acc_id);
        $this->proj_id = $row->proj_id;
        $this->proj_nm = $row->proj_nm;
        $this->proj_descr = $row->proj_descr;
        $this->estimate = ProjectEstimation_Model::getEstimationId($row->proj_id);
        }

    public
            function proj_id()
        {
        return $this->proj_id;
        }

    public
            function acc_id()
        {
        return $this->acc_id;
        }

    public
            function proj_nm()
        {
        return $this->proj_nm;
        }

    public
            function proj_descr()
        {
        return $this->proj_descr;
        }

    public function estimation()
        {
        return $this->estimate;
        }

    /*
     * Function to get a project given its id.
     * @param integer proj_id
     * @return object project
     */

    public static
            function getProject($proj_id)
        {
        $db = new Database();
        $db->connect();

        $query = "SELECT DISTINCT proj_id, proj_nm, proj_descr"
                . " FROM project WHERE proj_id='$proj_id'";

        if ($db->querySuccess($query))
            {
            $qResult = mysql_query($query);
            $row = mysql_fetch_object($qResult);
            $project = new Project_Model($row);
// var_dump('vardump db:' .$db);
            /* @var $result type */
            } else
            {
            var_dump($project);
            die("object is false");
            }
        $db->close();
        return $project;
        }

    public static
            function getAllUserProj($acc_id)
        {
        $db = new Database();
        $db->connect();

        $query = "SELECT PR.proj_id, PR.proj_nm, PR.proj_descr"
                . " FROM PROJECT PR"
                . " WHERE PR.proj_id IN"
                . " (SELECT PROJ_ID FROM USER_PROJECT UP"
                . " WHERE UP.user_id='" . $acc_id . "')";

        $result = mysql_query($query) or die("error: " . mysql_error());

        $projects = array();
        while ($row = mysql_fetch_object($result))
            {
            array_push($projects, new Project_Model($row));
            }
        $db->close();
        return $projects;
        }

    public static function deleteProject($proj_id)
        {
        $db = new Database();
        $db->connect();
//Archive project
        $archiveQuery = "INSERT INTO archived_project"
                . " SELECT proj_id, proj_nm, proj_descr"
                . " FROM projects"
                . " WHERE proj_id='" . $proj_id . "'";
        $archiveResult = mysql_query($archiveQuery);


//Delete project from projects
        $query = "DELETE FROM projects where proj_id='" . $proj_id . "'";
        $result = mysql_query($query);

        if ($db->querySuccess($archiveResult) && $db->querySuccess($result))
            {
            $del = true;
            } else
            {
            $del = false;
            }
        $db->close();
        return $del;
        }

    public static function addProject($fields)
        {

        $db = new Database();
        $db->connect();
        $db->filterParameters($fields);
//This will be a multi-dimensional array due to the checkbox field.
        $proj_nm = $fields['pName'];
        $htmlDescr = $fields['pDescr'];
        $proj_descr = Validator_Model::htmlChar($htmlDescr);

        $arrayError = array(
//Project name validation
//String length needs to be between 1 and 30
            array(Validator_Model::variableCheck($proj_nm, 'string', 30)),
            //Project description validation
//string length needs to be between 1 and 200
            array(Validator_Model::variableCheck($proj_descr, 'string', 200)),
                //Project start date errors
//Project deadline date errors
        );


        if (sizeof($arrayError) === 0)
            {
            $projInsert = "BEGIN;"
                    //Insert into project table
                    . "INSERT INTO  `fyp`.`project` ("
                    . " `proj_id` ,"
                    . " `proj_nm` ,"
                    . " `proj_descr`"
                    . ") VALUES ("
                    . "NULL,"
                    . " '" . $proj_nm . "',"
                    . " '" . $proj_descr . "');"
                    //Insert new project into user_project table
                    . " INSERT INTO `fyp`.`user_project` ("
                    . " `proj_id` , "
                    . " `user_id`)"
                    . " VALUES ("
                    . " LAST_INSERT_ID(),"
                    . " `" . $_SESSION['user']->userId() . "`);"
                    . "COMMIT;"
            ;

            $result = mysql_query($projInsert);
            if (!$db->querySuccess($result))
                {
                echo "Error inserting data into database."
                . "MYSQL Error: " . mysql_error();
                }
            }
        }

    }
