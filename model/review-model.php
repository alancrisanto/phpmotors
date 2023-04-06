<?php

/*
 * Reviews Model.
 */

function addReview($reviewText, $invId, $clientId)
{
    $db = phpmotorsConnect();
    $sql = 'INSERT INTO reviews (reviewText, invId, clientId) VALUES (:reviewText, :invId, :clientId)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

function getInventoryReviews($invId){
    $db = phpmotorsConnect();
    $sql = 'SELECT r.reviewId, r.reviewText, r.reviewDate, r.invId, r.clientId, c.clientFirstname, c.clientLastname FROM reviews r INNER JOIN clients c ON c.clientId = r.clientId WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $reviewList = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviewList;
}

function getClientReviews($clientId){
    $db = phpmotorsConnect();
    $sql = 'SELECT reviewId, reviewText, reviewDate, invId, clientId FROM reviews WHERE clientId = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $reviewList = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviewList;
}

function getReview($reviewId){
    $db = phpmotorsConnect();
    $sql = 'SELECT r.reviewId, r.reviewText, r.reviewDate, r.invId, r.clientId, c.clientFirstname, c.clientLastname FROM reviews r INNER JOIN clients c ON c.clientId = r.clientId WHERE r.reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $review = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $review;
}

function updateReview($reviewText, $reviewId, $reviewDate){
    $db = phpmotorsConnect();
    $sql = 'UPDATE reviews SET reviewText = :reviewText, reviewDate = :reviewDate WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->bindValue(':reviewDate', $reviewDate, PDO::PARAM_STR);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}


function deleteReview($reviewId) {
    $db = phpmotorsConnect();
    $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

?>