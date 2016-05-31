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

    public function getSpecs($classID) {
        return $this->armory->select('tt.id, tt.name_en_gb as name, tt.tab_number, ti.icon')
            ->from('armory_talenttab tt')
            ->where('tt.refmask_chrclasses', pow(2, ($classID - 1))) //Seriously?
            ->join('armory_talent_icons ti', 'tt.refmask_chrclasses = POW(2, ti.class - 1) AND tt.tab_number = ti.spec')
            ->order_by('tt.tab_number')
            ->get()->result();
    }

    public function getTalentsBySpecID($specID) {
        return $this->armory->select('t.*') //, i.icon
            ->from('armory_talents t')
            ->where('TalentTab', $specID)
            ->join('armory_spell s', 't.Rank_1 = s.id')
            //The spell ID's, icons, etc are in talent_xml/talent-tree-classid-en_us.xml. Needs to be converted to MySQL.
            ->get()->result();
    }

}