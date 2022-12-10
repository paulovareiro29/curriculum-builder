<?php
include_once "{$_SERVER['DOCUMENT_ROOT']}/{$_ENV['SRC_DIR']}" . '/database/database.php';

class Curriculum extends Database
{
    public $id;
    public $user_id;
    public $name;
    public $person_name;
    public $role;
    public $avatar;
    public $summary;
    public $is_public;
    public $profile_header;
    public $info_header;
    public $skills_header;
    public $education_header;
    public $experience_header;
    public $views;

    public function __construct($id = null)
    {
        $this->id = $id;
    }

    public function create()
    {
        $sql = "INSERT INTO curriculum (user_id, name, description, avatar) VALUES (?,?,?,?)";

        $this->connect();
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->user_id, $this->name, $this->description, $this->avatar]);
        $this->close();

        if ($stmt->rowCount() > 0) return true;
        return false;
    }

    public function get()
    {
        $sql = "SELECT * FROM curriculum WHERE deleted_at IS NULL AND id = :id";

        $this->connect();
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $this->id]);
        $result = $stmt->fetch();
        $this->close();

        if (!$result) return null;
        return $result;
    }

    public static function index()
    {
        $sql = "SELECT * FROM curriculum WHERE deleted_at IS NULL AND is_public = 1";

        $db = new Database();
        $db->connect();

        $result = $db->conn->query($sql)->fetchAll();
        $db->close();

        return $result;
    }

    public static function indexByUser($id)
    {
        $sql = "SELECT * FROM curriculum WHERE deleted_at IS NULL AND user_id = :id";

        $db = new Database();
        $db->connect();

        $stmt = $db->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetchAll();
        $db->close();

        return $result;
    }

    public static function indexManagers($id)
    {
        $sql = "SELECT user.id, user.username, user.created_at, user.updated_at FROM user, manager WHERE manager.curriculum_id = :id AND manager.user_id = user.id";

        $db = new Database();
        $db->connect();

        $stmt = $db->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetchAll();
        $db->close();

        return $result;
    }

    public static function indexByManager($id)
    {
        $sql = "SELECT curriculum.* FROM curriculum, manager WHERE manager.user_id = :id AND manager.curriculum_id = curriculum.id";

        $db = new Database();
        $db->connect();

        $stmt = $db->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetchAll();
        $db->close();

        return $result;
    }

    public function softdelete()
    {
        if (!isset($this->id)) return false;

        $sql = "UPDATE curriculum SET deleted_at = now(), avatar = NULL WHERE id = :id";

        $this->connect();
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $this->id]);
        $this->close();

        if ($stmt->rowCount() > 0) return true;
        return false;
    }

    public function delete()
    {
        if (!isset($this->id)) return false;

        $sql = "DELETE FROM curriculum WHERE id = :id";

        $this->connect();
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $this->id]);
        $this->close();

        if ($stmt->rowCount() > 0) return true;
        return false;
    }

    public function update()
    {
        $data = [
            'name' => $this->name,
            'person_name' => $this->person_name,
            'description' => $this->description,
            'role' => $this->role,
            'avatar' => $this->avatar,
            'summary' => $this->summary,
            'is_public' => $this->is_public,
            'profile_header' => $this->profile_header,
            'info_header' => $this->info_header,
            'skills_header' => $this->skills_header,
            'education_header' => $this->education_header,
            'experience_header' => $this->experience_header,
            'id' => $this->id,
        ];

        $sql = "UPDATE curriculum SET 
                name = :name,
                description = :description,
                person_name = :person_name,
                role = :role,
                avatar = :avatar,
                summary = :summary,
                is_public = :is_public,
                profile_header = :profile_header,
                info_header = :info_header,
                skills_header = :skills_header,
                education_header = :education_header,
                experience_header = :experience_header
                WHERE id = :id";


        $this->connect();
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
        $this->close();

        if ($stmt->rowCount() > 0) return true;
        return false;
    }

    public function viewed()
    {
        $sql = "UPDATE curriculum SET views = views + 1 WHERE id = :id";

        $this->connect();
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $this->id]);
        $this->close();

        if ($stmt->rowCount() > 0) return true;
        return false;
    }

    public static function deleteAllManagers($id)
    {
        $sql = "DELETE FROM manager WHERE curriculum_id = :id";

        $db = new Database();
        $db->connect();

        $stmt = $db->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $db->close();

        if ($stmt->rowCount() > 0) return true;
        return false;
    }

    public function addManager($id)
    {
        $sql = "INSERT INTO manager (curriculum_id,  user_id) VALUES (?,?)";

        $this->connect();
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->id, $id]);
        $this->close();

        if ($stmt->rowCount() > 0) return true;
        return false;
    }
}
