<?php namespace Models\Classes;

class Queries
{
    public static function getUserInsertQuery(): string
    {
        return "INSERT INTO \"user\" (firstname, lastname, username, email, phone, password, secret, authentication) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    }

    public static function getUsernameExistQuery(): string
    {
        return "SELECT username 
                FROM \"user\" 
                WHERE username = ?";
    }

    public static function getUserByUsernameQuery(): string
    {
        return "SELECT * 
                FROM \"user\" 
                WHERE username = ?";
    }

    public static function getUserByIdQuery(): string
    {
        return "SELECT * 
                FROM \"user\" 
                WHERE id = ?";
    }

    public static function getTokenInsertQuery(): string
    {
        return "INSERT INTO token (id_user, value, device, time) 
                VALUES (?, ?, ?, ?)";
    }

    public static function getTokenDeleteQuery(): string
    {
        return "DELETE FROM token
                WHERE id_user = ?";
    }

    public static function getTokenExistQuery(): string
    {
        return "SELECT *
                FROM token
                WHERE value = ?";
    }

    public static function getUserIdByToken(): string
    {
        return "SELECT id_user
                FROM token
                WHERE value = ?";
    }

    public static function getTokensByIdQuery(): string
    {
        return "SELECT *
                FROM token
                WHERE id_user = ?";
    }

    public static function getUserUpdateQuery(): string
    {
        return "UPDATE \"user\"
                SET firstname = ?, lastname = ?, username = ?, email = ?, phone = ?, authentication = ?
                WHERE id = ?";
    }

    public static function getAllServiceQuery(): string
    {
        return "SELECT *
                FROM service";
    }

    public static function getUserServicesQuery(): string
    {
        return "SELECT *
                FROM service_user
                JOIN service s on service_user.id_service = s.id_service
                WHERE id_user = ?";
    }

    public static function getServiceByNameQuery(): string
    {
        return "SELECT *
                FROM service
                WHERE name = ?";
    }

    public static function getServiceUserInsertQuery(): string
    {
        return "INSERT INTO service_user
                VALUES (?, ?, ?, ?)";
    }

    public static function getInsertLogQuery(): string
    {
        return "INSERT INTO log 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
    }

    public static function getServiceUserDeleteQuery(): string
    {
        return "DELETE FROM service_user 
                WHERE id_user = ? 
                AND id_service = ?";
    }

    public static function getAccordingIdForServiceQuery(): string
    {
        return "SELECT s.id_service
                FROM service AS s
                JOIN service_user su on s.id_service = su.id_service
                WHERE s.id_service = su.id_service
                AND s.name = ?";
    }

    public static function getUpdateServiceUserQuery(): string
    {
        return "UPDATE service_user
                SET username = ?, password = ?
                WHERE id_user = ?
                AND id_service = ?";
    }

    public static function getAllUserServicesQuery(): string
    {
        return "SELECT *
                FROM service_user
                WHERE id_user = ?";
    }

    public static function updatePasswordQuery(): string
    {
        return "UPDATE \"user\"
                SET password = ?
                WHERE id = ?";
    }

    public static function getSMSTokenInsertQuery(): string
    {
        return "INSERT INTO sms_token 
                VALUES (?, ?)";
    }

    public static function getSMSTokenExistQuery(): string
    {
        return "SELECT * 
                FROM sms_token
                WHERE value = ?";
    }

    public static function getDeleteSMSTokenQuery(): string
    {
        return "DELETE FROM sms_token 
                WHERE value = ?";
    }

    public static function getInsertEmailQuery(): string
    {
        return "INSERT INTO email_token 
                VALUES (?, ?)";
    }

    public static function getEmailTokenByValue(): string
    {
        return "SELECT * 
                FROM email_token 
                WHERE value = ?";
    }

    public static function getDeleteEmailTokenQuery(): string
    {
        return "DELETE FROM email_token 
                WHERE value = ?";
    }
}
