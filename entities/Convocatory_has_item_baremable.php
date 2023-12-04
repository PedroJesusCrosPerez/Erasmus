<?php

class Convocatory_has_item_baremable implements JsonSerializable {
    private $convocatory_id;
    private $item_baremable_id;
    private $required;
    private $min_value;
    private $max_value;

    public function __construct($convocatory_id, $item_baremable_id, $required, $min_value, $max_value) {
        $this->setConvocatory_id($convocatory_id);
        $this->setItem_baremable_id($item_baremable_id);
        $this->setRequired($required);
        $this->setMin_value($min_value);
        $this->setMax_value($max_value);
    }

    public function getConvocatory_id() {
        return $this->convocatory_id;
    }

    public function getItem_baremable_id() {
        return $this->item_baremable_id;
    }

    public function getRequired() {
        return $this->required;
    }

    public function getMin_value() {
        return $this->min_value;
    }

    public function getMax_value() {
        return $this->max_value;
    }

    private function setConvocatory_id($convocatory_id) {
        $this->convocatory_id = $convocatory_id;
    }

    private function setItem_baremable_id($item_baremable_id) {
        $this->item_baremable_id = $item_baremable_id;
    }

    private function setRequired($required) {
        $this->required = $required;
    }

    private function setMin_value($min_value) {
        $this->min_value = $min_value;
    }

    private function setMax_value($max_value) {
        $this->max_value = $max_value;
    }

    // Methods
    public function jsonSerialize() {
        return get_object_vars($this);
    }

    public function __toString() {
        return sprintf(
            "Convocatory_has_item_baremable - Convocatory ID: %d, Item Baremable ID: %d, Required: %d, Min Value: %d, Max Value: %d",
            $this->getConvocatory_id(),
            $this->getItem_baremable_id(),
            $this->getRequired(),
            $this->getMin_value(),
            $this->getMax_value()
        );
    }

}