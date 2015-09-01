<?php

    class User {

        private $user_name;
        private $user_buy_quantity;
        private $user_phone;
        private $user_email;
        private $activity_id;
        private $id;

        function __construct($user_name, $user_buy_quantity, $user_phone, $user_email, $activity_id, $id = null)
        {
            $this->user_name = $user_name;
            $this->user_buy_quantity = $user_buy_quantity;
            $this->user_phone = $user_phone;
            $this->user_email = $user_email;
            $this->activity_id = $activity_id;
            $this->id = $id;
        }

        function setUserName($new_user_name)
        {
            $this->user_name = (string)$new_user_name;
        }

        function getUserName()
        {
            return $this->user_name;
        }

        function setBuyQuantity($new_user_buy_quantity)
        {
            $this->user_buy_quantity = (int)$new_user_buy_quantity;
        }

        function getBuyQuantity()
        {
            return $this->user_buy_quantity;
        }

        function setUserPhone($new_user_phone)
        {
            $this->user_phone = (string)$new_user_phone;
        }

        function getUserPhone()
        {
            return $this->user_phone;
        }

        function setUserEmail($new_user_email)
        {
            $this->user_email = (string)$new_user_email;
        }

        function getUserEmail()
        {
            return $this->user_email;
        }

        function setActivityId($new_activity_id)
        {
            $this->activity_id = (string)$new_activity_id;
        }

        function getActivityId()
        {
            return $this->activity_id;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $user_name = $GLOBALS['DB']->exec("INSERT INTO users (user_name, user_buy_quantity, user_phone, user_email, activity_id) VALUES ('{$this->getUserName()}', {$this->getBuyQuantity()}, '{$this->getUserPhone()}', '{$this->getUserEmail()}', {$this->getActivityId()});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function update()
        {
            $GLOBALS['DB']->exec("UPDATE users SET user_name = '{$this->getUserName()}' WHERE id = {$this->getId()};");

        }

        function deleteOne()
        {
            $GLOBALS['DB']->exec("DELETE FROM users WHERE id = {$this->getId()};");
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM users;");
        }

        static function getAll()
        {
            $returned_users = $GLOBALS['DB']->query("SELECT * FROM users;");
            $users = array();
            foreach ($returned_users as $user)
            {
                $user_name = $user['user_name'];
                $user_buy_quantity = $user['user_buy_quantity'];
                $user_phone = $user['user_phone'];
                $user_email = $user['user_email'];
                $activity_id = $user['activity_id'];
                $id = $user['id'];
                $new_user = new User ($user_name, $user_buy_quantity, $user_phone, $user_email, $activity_id, $id);
                array_push($users, $new_user);
            }
            return $users;
        }

        static function find($searchId)
        {
            $returned_users = User::getAll();
            foreach($returned_users as $user){
                if ($searchId == $user->getId()){
                    return $user;
                }
            }
        }

    }

 ?>
