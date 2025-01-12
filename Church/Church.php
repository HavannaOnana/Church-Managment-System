<?php

include_once "../includes/Database.php";


class Church{

    public $database;

    public function __construct(){
        $this->database = new Database();
    }

    public function AddMember($name,$age,$email,$phonenumber){
        $sql = "INSERT INTO members (name,age,email,phonenumber) VALUES(:name,:age,:email,:phonenumber)";
        $param = [
            ":name"=>$name,
            ":age"=>$age,
            ":email"=>$email,
            "phonenumber"=>$phonenumber
        ];
        return $this->database->run($sql,$param);
    }
    
    //selecting all the members
    public function SelectAllMembers(){
        $sql = "SELECT * FROM members";
        return $this->database->run($sql)->fetchAll();
    }

    //getting a member by id 
    public function GetMemberByID($ID){
        $sql = "SELECT * FROM members WHERE ID = :ID";
        $params = [":ID"=>$ID];
        return $this->database->run($sql,$params)->fetch(PDO::FETCH_ASSOC); ;
    }

    // updating a member
    public function updateMember($ID,$name,$age,$email,$phonenumber){
        $sql = "UPDATE members SET name = :name, age = :age, email = :email, phonenumber =:phonenumber WHERE ID = :ID";
        $param = [
            ":ID"=>$ID,
            ":name"=>$name,
            ":age"=>$age,
            ":email"=>$email,
            ":phonenumber"=>$phonenumber
        ];
        return $this->database->run($sql,$param);
    }

    //deleting a member
    public function deleteMember($ID){
         $sql = "DELETE * FROM members WHERE ID = :ID";
         $params = [":ID"=>$ID];
         return $this->database->run($sql,$params);
    }

  //rendering all the members
  public function renderMembers() {
    try {
        $members = $this->SelectAllMembers();

        // Check if the query returned a valid result
        if (!is_iterable($members)) {
            throw new Exception('Failed to fetch members. The result is not iterable.');
        }

        echo '<table border="1" cellpadding="10" cellspacing="0">';
        echo '<tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Actions</th>
              </tr>';
        foreach ($members as $member) {
            echo '<tr>';
            echo '<td>' . $member['ID'] . '</td>';
            echo '<td>' . htmlspecialchars($member['name']) . '</td>';
            echo '<td>' . htmlspecialchars($member['age']) . '</td>';
            echo '<td>' . htmlspecialchars($member['email']) . '</td>';
            echo '<td>' . htmlspecialchars($member['phonenumber']) . '</td>';

            echo '<td>
                    <a href="../Pages/editmember.php?id=' . $member["ID"] . '">Update</a> |
                    <a href="../Pages/delete.php?id=' . $member["ID"] . '">Delete</a>
                </td>';



            echo '</tr>';
        }

        // End table
        echo '</table>';
    } catch (Exception $e) {
        // Display the error message
        echo '<p style="color: red;">Error: ' . htmlspecialchars($e->getMessage()) . '</p>';
    }
}


}



?>