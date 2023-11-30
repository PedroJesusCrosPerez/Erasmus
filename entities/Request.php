<?php

class Request implements JsonSerializable 
{
    // Properties
    private $id;
    private $dni;
    private $name;
    private $surname;
    private $birthdate;
    private $course;
    private $phone;
    private $email;
    private $address;
    private $convocatory_id;

    // Constructor
    public function __construct($id, $dni, $name, $surname, $birthdate, $course, $phone, $email, $address, $convocatory_id) {
        $this->setId($id);
        $this->setDni($dni);
        $this->setName($name);
        $this->setSurname($surname);
        $this->setBirthdate($birthdate);
        $this->setCourse($course);
        $this->setPhone($phone);
        $this->setEmail($email);
        $this->setAddress($address);
        $this->setConvocatoryId($convocatory_id);
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getDni() {
        return $this->dni;
    }

    public function getName() {
        return $this->name;
    }

    public function getSurname() {
        return $this->surname;
    }

    public function getBirthdate() {
        return $this->birthdate;
    }

    public function getCourse() {
        return $this->course;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getConvocatoryId() {
        return $this->convocatory_id;
    }

    // Setters
    private function setId($id) {
        $this->id = $id;
    }

    private function setDni($dni) {
        $this->dni = $dni;
    }

    private function setName($name) {
        $this->name = $name;
    }

    private function setSurname($surname) {
        $this->surname = $surname;
    }

    private function setBirthdate($birthdate) {
        $this->birthdate = $birthdate;
    }

    private function setCourse($course) {
        $this->course = $course;
    }

    private function setPhone($phone) {
        $this->phone = $phone;
    }

    private function setEmail($email) {
        $this->email = $email;
    }

    private function setAddress($address) {
        $this->address = $address;
    }

    private function setConvocatoryId($convocatory_id) {
        $this->convocatory_id = $convocatory_id;
    }

    // Methods
    public function __toString() {
        return sprintf(
            "Request ID: %d, Name: %s %s, Birthdate: %s, Course: %s, Email: %s",
            $this->getId(),
            $this->getName(),
            $this->getSurname(),
            $this->getBirthdate(),
            $this->getCourse(),
            $this->getEmail()
        );
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }
}