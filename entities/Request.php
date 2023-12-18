<?php

class Request implements JsonSerializable 
{
    // Properties
    private $id;
    private $dni;
    private $name;
    private $surname;
    private $birthdate;
    private $group;
    private $phone;
    private $email;
    private $address;
    private $photo;
    private $convocatory_id;

    // Constructor
    public function __construct($id=null, $dni, $name, $surname, $birthdate, $group, $phone, $email, $address, $photo, $convocatory_id) {
        $this->setId($id);
        $this->setDni($dni);
        $this->setName($name);
        $this->setSurname($surname);
        $this->setBirthdate($birthdate);
        $this->setGroup($group);
        $this->setPhone($phone);
        $this->setEmail($email);
        $this->setAddress($address);
        $this->setPhoto($photo);
        $this->setConvocatory_id($convocatory_id);
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

    public function getGroup() {
        return $this->group;
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
    
    public function getPhoto() {
        return $this->photo;
    }

    public function getConvocatory_id() {
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

    private function setGroup($group) {
        $this->group = $group;
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

    private function setPhoto($photo) {
        $this->photo = $photo;
    }

    private function setConvocatory_id($convocatory_id) {
        $this->convocatory_id = $convocatory_id;
    }

    // Methods
    public function __toString() {
        return sprintf(
            "Request ID: %s<br>· DNI: %s<br>· Name: %s<br>· Surname: %s<br>· Birthdate: %s<br>· Group: %s<br>· Phone: %s<br>· Email: %s<br>· Address: %s<br>· Photo: %s<br>· Convocatory ID: %s<br>",
            $this->getId(),
            $this->getDni(),
            $this->getName(),
            $this->getSurname(),
            $this->getBirthdate(),
            $this->getGroup(),
            $this->getPhone(),
            $this->getEmail(),
            $this->getAddress(),
            $this->getPhoto(),
            $this->getConvocatory_id()
        );
    }

    public function myToString() {
        return sprintf(
            "DNI: %s<br>· Name: %s<br>· Surname: %s<br>· Birthdate: %s<br>· Group: %s<br>· Phone: %s<br>· Email: %s<br>· Address: %s<br>· Convocatory ID: %s<br>",
            $this->getDni(),
            $this->getName(),
            $this->getSurname(),
            $this->getBirthdate(),
            $this->getGroup(),
            $this->getPhone(),
            $this->getEmail(),
            $this->getAddress(),
            $this->getConvocatory_id()
        );
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }
}