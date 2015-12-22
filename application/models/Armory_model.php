<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Armory_model extends CI_Model
{

    protected $armory;
    public function __construct()
    {
        parent::__construct();
        $this->armory = $this->load->database('armory', TRUE);
    }

    public function getEnchantTextById($enchantmentID) {
        return $this->armory->select('text_en_gb')
            ->from('armory_enchantments')
            ->where('id', $enchantmentID)
            ->get()->result();
    }

    public function getClassNameByID($classID) {
        return $this->armory->select('name_en_gb as name')
            ->from('armory_classes')
            ->where('id', $classID)
            ->get()->row()
            ->name;
    }

    public function getRaceNameByID($raceID) {
        return $this->armory->select('name_en_gb as name')
            ->from('armory_races')
            ->where('id', $raceID)
            ->get()->row()
            ->name;
    }

    public function getProfessionNameByID($professionID) {
        return $this->armory->select('name_en_gb as name')
            ->from('armory_professions')
            ->where('id', $professionID)
            ->get()->row()
            ->name;
    }

    public function getFactionNameAndDescByID($factionID) {
        return $this->armory->select('name_en_gb as name, description_en_gb as desc')
            ->from('armory_factions')
            ->where('id', $factionID)
            ->get()->row();
    }

    public function getSlotNameByID($slotID) {
        return $this->armory->select('name_en_gb as name')
            ->from('armory_slots')
            ->where('id', $slotID)
            ->get()->row()
            ->name;
    }

    public function getItemIconByDisplayID($itemID) {
        return $this->armory->select('icon')
            ->from('armory_icons')
            ->where('displayid', $itemID)
            ->get()->row()
            ->icon;
    }

    public function getTalentIconByClassSpec($classID, $specID) {
        return $this->armory->select('icon, name_en_gb as name')
            ->from('armory_talent_icons')
            ->where('class', $classID)
            ->where('spec', $specID)
            ->get()->row();
    }

    public function getFactionByID($factionID) {
        return $this->armory->select('name_en_gb as name')
            ->from('armory_faction')
            ->where('id', $factionID)
            ->get()->row()
            ->name;
    }

    public function getSlotDisplayOrder($slotID) {
        return $this->armory->select('display_order')
            ->from('armory_slots_order')
            ->where('id', $slotID)
            ->get()->row()
            ->display_order;
    }

}