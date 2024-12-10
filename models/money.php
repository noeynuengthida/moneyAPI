<?php
class money
{
    private $connDB;

    public $message;

    public $moneyID;
    public $moneyDetail;
    public $moneyDate;
    public $moneyInOut;
    public $moneyType;
    public $userID;

    public function __construct($connectDB)
    {
        $this->connDB = $connectDB;
    }

    public function GetMoney($userID)
    {
        $query = "SELECT * FROM money_tb WHERE userID = :userID ORDER BY moneyDate DESC";

        $userID = intval(htmlspecialchars(strip_tags($userID)));

        $stmt = $this->connDB->prepare($query);

        $stmt->bindParam(':userID', $userID);

        $stmt->execute();

        return $stmt;
    }

    public function AddMoney($moneyDetail, $moneyDate, $moneyInOut, $moneyType, $userID)
    {
        $query = "
        INSERT INTO money_tb (moneyDetail, moneyDate, moneyInOut, moneyType, userID) 
        VALUES (:moneyDetail, :moneyDate, :moneyInOut, :moneyType, :userID)";

        $moneyDetail = htmlspecialchars(strip_tags($moneyDetail));
        $moneyDate = htmlspecialchars(strip_tags($moneyDate));
        $moneyInOut = htmlspecialchars(strip_tags($moneyInOut));
        $moneyType = intval(htmlspecialchars(strip_tags($moneyType)));
        $userID = intval(htmlspecialchars(strip_tags($userID)));

        $stmt = $this->connDB->prepare($query);

        $stmt->bindParam(':moneyDetail', $moneyDetail);
        $stmt->bindParam(':moneyDate', $moneyDate);
        $stmt->bindParam(':moneyInOut', $moneyInOut);
        $stmt->bindParam(':moneyType', $moneyType);
        $stmt->bindParam(':userID', $userID);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}