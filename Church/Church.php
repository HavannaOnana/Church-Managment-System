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

    //deleting a 

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
                    <form method="POST" action="updateMember.php" style="display:inline;">
                        <input type="hidden" name="id" value="' . $member['ID'] . '">
                        <button type="submit">Update</button>
                    </form>
                    <form method="POST" action="deleteMember.php" style="display:inline;">
                        <input type="hidden" name="id" value="' . $member['ID'] . '">
                        <button type="submit" onclick="return confirm(\'Are you sure you want to delete this member?\');">Delete</button>
                    </form>
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