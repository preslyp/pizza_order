<?php
/**
 * Created by PhpStorm.
 * User: pancho
 * Date: 7/5/17
 * Time: 3:39 PM
 */

namespace Pizza\Model;

class AbstractDBquery
{
    private $db;

    public function __construct()
    {
        try {

            $this->db = DBConnection::getDb();

        } catch (\Exception $e) {

            echo 'Message: ' . $e->getMessage();

        }

    }

    protected function fetchAll($sql)
    {
        try {

            $pstmt = $this->db->query($sql);
            return $pstmt->fetchAll(\PDO::FETCH_ASSOC);

        } catch ( \PDOException $e ) {

            throw new \PDOException ( "!!!Something went wrong, please try again later!" );
        }

    }

    protected function fetch($sql, array $bindParams = [], $return = true)
    {
        try {
            $pstmt = $this->db->prepare($sql);
            $pstmt->execute($bindParams);
            if ($return) {
                return $pstmt->fetch(\PDO::FETCH_ASSOC);
            }
        } catch ( \PDOException $e ) {

            throw new \PDOException ( "Something went wrong, please try again later!" );
        }
    }

    protected function fetchAllParams($sql, array $bindParams = [], $return = true)
    {
        try {
            $pstmt = $this->db->prepare($sql);
            $pstmt->execute($bindParams);
            if ($return) {
                return $pstmt->fetchAll(\PDO::FETCH_ASSOC);
            }
        } catch ( \PDOException $e ) {

            throw new \PDOException ( "Something went wrong, please try again later!" );
        }
    }

    protected function exec($sql, array $bindParams = [], $return = true)
    {
        try {
            $pstmt = $this->db->prepare($sql);
            $result = $pstmt->execute($bindParams);
            if ($return) {
                return $result;
            }
        } catch ( \PDOException $e ) {

            throw new \PDOException ( "Something went wrong, please try again later!" );
        }
    }

}

