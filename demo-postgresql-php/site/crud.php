<?php
function create($table, $data) {
    global $pdo;
    try {
        $columns = implode(", ", array_keys($data));
        $values = ":" . implode(", :", array_keys($data));

        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        $stmt = $pdo->prepare($sql);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        return "Erreur lors de la création : " . $e->getMessage();
    }
}

function read($table, $id) {
    global $pdo;
    try {
        $sql = "SELECT * FROM $table WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return "Erreur lors de la lecture : " . $e->getMessage();
    }
}

function update($table, $id, $data) {
    global $pdo;
    try {
        $set = "";
        foreach ($data as $key => $value) {
            $set .= "$key=:$key, ";
        }
        $set = rtrim($set, ", ");
        
        $sql = "UPDATE $table SET $set WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id", $id);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        return "Erreur lors de la mise à jour : " . $e->getMessage();
    }
}

function delete($table, $id) {
    global $pdo;
    try {
        $sql = "DELETE FROM $table WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        return "Erreur lors de la suppression : " . $e->getMessage();
    }
}
