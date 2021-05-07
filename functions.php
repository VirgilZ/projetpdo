<?php
function addUser($pdo, $first_name, $last_name, $birth_date)
{
    $sql = "INSERT INTO `users`(`first_name`,`last_name`,`birth_date`) VALUES (:first_name, :last_name, :birth_date)";

    $req = $pdo->prepare($sql);
    $req->bindValue(':first_name', $first_name, PDO::PARAM_STR);
    $req->bindValue(':last_name', $last_name, PDO::PARAM_STR);
    $req->bindValue(':birth_date', $birth_date, PDO::PARAM_STR);

    try {
        $req->execute();
        return $req->rowCount();
    } catch (PDOException $e) {
        var_dump($e->getMessage());
        return false;
    }
}
function liste_utilisateur($pdo)
{
    $sql = "SELECT 
    users.`user_id`,
    `last_name`,
    `first_name`,
    `inc_amount`,
    `exp_amount`,
    `inc_id`,
    `exp_id`
FROM 
    `users`
LEFT JOIN `incomes` ON `incomes`.`user_id` = `users`.`user_id`
LEFT JOIN `expenses` ON `expenses`.`user_id` = `users`.`user_id`";

    $req = $pdo->query($sql);

    $users = $req->fetchALL(PDO::FETCH_ASSOC);
    return $users;
}
function categorie($pdo) {
    $sql = "SELECT * FROM incomes_categories";
    $req = $pdo->query($sql);

    return $req->fetchAll(PDO::FETCH_ASSOC);
}
function categorie_spent($pdo) {
    $sql = "SELECT * FROM expenses";
    $req = $pdo->query($sql);

    return $req->fetchAll(PDO::FETCH_ASSOC);
}
function add_money($pdo, $inc_amount, $inc_receipt_date, $inc_cat_id, $user_id)
{
    $sql = "INSERT INTO `incomes`(`inc_amount`, `inc_receipt_date`, `inc_cat_id`, `user_id`) VALUES (:inc_amount, :inc_receipt_date, :inc_cat_id, :user_id )";

    $req = $pdo->prepare($sql);

    $req->bindValue(':inc_amount', $inc_amount, PDO::PARAM_STR);
    $req->bindValue(':inc_receipt_date', $inc_receipt_date, PDO::PARAM_STR);
    $req->bindValue(':inc_cat_id', $inc_cat_id, PDO::PARAM_INT);
    $req->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    

    try {

        $req-> execute();

        return $req->rowCount();
    } catch(PDOException $e) {
        var_dump($e->getMessage());
        return false;
    }
}
function money_spent($pdo, $exp_amount, $exp_date, $exp_label, $user_id)
{
    $sql = "INSERT INTO `expenses`(`exp_amount`, `exp_date`, `exp_label`, `user_id`) VALUES (:exp_amount, :exp_date, :exp_label, :user_id )";

    $req = $pdo->prepare($sql);

    $req->bindValue(':exp_amount', $exp_amount, PDO::PARAM_STR);
    $req->bindValue(':exp_date', $exp_date, PDO::PARAM_STR);
    $req->bindValue(':exp_label', $exp_label, PDO::PARAM_INT);
    $req->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    

    try {

        $req-> execute();

        return $req->rowCount();
    } catch(PDOException $e) {
        
        return false;
    }
}
function need_money($pdo)
{
    $sql = "SELECT `user_id`, `first_name`, `last_name`, `birth_date` FROM `users`";
    $req = $pdo->query($sql);

    $users = $req->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}

function updateUser($pdo, $user_id, $first_name, $last_name, $birth_date){
    $sql = "UPDATE users SET first_name = :first_name, last_name = :last_name, birth_date = :birth_date WHERE user_id = :user_id";

    $req = $pdo->prepare($sql);
    $req->bindValue(':user_id', $user_id, PDO::PARAM_STR);
    $req->bindValue(':first_name', $first_name, PDO::PARAM_STR);
    $req->bindValue(':last_name', $last_name, PDO::PARAM_STR);
    $req->bindValue(':birth_date', $birth_date, PDO::PARAM_STR);

    try {
        // exécuter la requête
        $req->execute();
        // renvoie le nombre d'enregistrement créé.
        return $req->rowCount();
    }catch(PDOException $e){
        return false;
    }
}
function user_details($pdo, $user_id) {
    $sql = "SELECT first_name, last_name, birth_date FROM users WHERE user_id = :user_id";

    $req = $pdo->prepare($sql);
    $req->bindValue(':user_id', $user_id,  PDO::PARAM_INT);

    try {
        // exécuter la requête
        $req->execute();
        // renvoie le nombre d'enregistrement créé.
        return $req->fetch(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        return false;
    }
}
function updateUsermoney($pdo, $inc_id, $inc_receipt_date, $inc_amount ){
    $sql = "UPDATE incomes SET inc_receipt_date = :inc_receipt_date, inc_amount = :inc_amount WHERE inc_id = :inc_id";

    $req = $pdo->prepare($sql);
    $req->bindValue(':inc_id', $inc_id, PDO::PARAM_STR);
    $req->bindValue(':inc_amount', $inc_amount, PDO::PARAM_STR);
    $req->bindValue(':inc_receipt_date', $inc_receipt_date, PDO::PARAM_STR);


    try {
        // exécuter la requête
        $req->execute();
        // renvoie le nombre d'enregistrement créé.
        return $req->rowCount();
    }catch(PDOException $e){
        return false;
    }
}
function inc_details($pdo, $inc_id) {
    $sql = "SELECT inc_id, inc_amount, inc_receipt_date , inc_cat_id FROM incomes WHERE inc_id = :inc_id";

    $req = $pdo->prepare($sql);
    $req->bindValue(':inc_id', $inc_id,  PDO::PARAM_INT);

    try {
        // exécuter la requête
        $req->execute();
        // renvoie le nombre d'enregistrement créé.
        return $req->fetch(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        return false;
    }
}
function exp_details($pdo, $exp_id) {
    $sql = "SELECT exp_id, exp_date, exp_amount , exp_label FROM expenses WHERE exp_id = :exp_id";

    $req = $pdo->prepare($sql);
    $req->bindValue(':exp_id', $exp_id,  PDO::PARAM_INT);

    try {
        // exécuter la requête
        $req->execute();
        // renvoie le nombre d'enregistrement créé.
        return $req->fetch(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        return false;
    }
}
function updateUsermoneyexp($pdo, $exp_id, $exp_date, $exp_amount ){
    $sql = "UPDATE expenses SET exp_date = :exp_date, exp_amount = :exp_amount WHERE exp_id = :exp_id";

    $req = $pdo->prepare($sql);
    $req->bindValue(':exp_id', $exp_id, PDO::PARAM_STR);
    $req->bindValue(':exp_amount', $exp_amount, PDO::PARAM_STR);
    $req->bindValue(':exp_date', $exp_date, PDO::PARAM_STR);


    try {
        // exécuter la requête
        $req->execute();
        // renvoie le nombre d'enregistrement créé.
        return $req->rowCount();
    }catch(PDOException $e){
        return false;
    }
}
?>