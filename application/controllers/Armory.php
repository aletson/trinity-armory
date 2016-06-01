<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Armory extends CI_Controller {

    protected $data;
    public function __construct() {
        parent::__construct();
        $this->data = new stdClass;
        $this->load->model('Characters_model', 'Characters');
        $this->load->model('Armory_model', 'Armory');
        $this->load->model('World_model', 'World');
        $this->load->helper('url');
        $this->data->action = $this->router->method;
        $this->load->view('common/header', $this->data);
    }

    public function index()
    {
        $this->data->characters = $this->Characters->getCharacters();
        foreach($this->data->characters as $thisCharacter) {
             //echo ($thisCharacter->gender == 0 ? 'Male' : 'Female') . ' ';
             $thisCharacter->raceName = $this->Armory->getRaceNameByID($thisCharacter->race);
             $thisCharacter->className = $this->Armory->getClassNameByID($thisCharacter->class);
            $characterIcon = 'images/portraits';
            if($thisCharacter->level < 60) {
                $characterIcon .= '/wow-default';
            } elseif($thisCharacter->level < 70) {
                $characterIcon .= '/wow';
            } elseif ($thisCharacter->level < 80) {
                $characterIcon .= '/wow-70';
            } else {
                $characterIcon .= '/wow-80';
            }
            $characterIcon .= '/' . $thisCharacter->gender . '-' . $thisCharacter->race . '-' . $thisCharacter->class . '.gif';
            $thisCharacter->characterIcon = $characterIcon;
            $thisCharacter->specIcon = 'images/spells_abilities';
        }
        $this->load->view('armory/index', $this->data);
    }

    public function characterOverview($characterName) {
        //TODO roll in dungeon progression & handle sockets/enchants
        $characterGuid = $this->Characters->getCharacterGuidByName($characterName);
        $this->data->characterDisplayData = $this->Characters->getCharacterDisplayData($characterGuid);
        $this->data->characterDisplayData->characterName = ucfirst($characterName);
        $this->data->characterDisplayData->raceName = $this->Armory->getRaceNameByID($this->data->characterDisplayData->race);
        $this->data->characterDisplayData->className = $this->Armory->getClassNameByID($this->data->characterDisplayData->class);
        $this->data->characterDisplayData->characterIcon = 'images/portraits';
        $this->data->characterDisplayData->specIcon = 'images/spells_abilities';
        $this->data->gear = $this->Characters->getGear($characterGuid);
        $this->data->sumItemLevel = 0;
        $this->data->itemCount = 0;
        //TODO pull all talents from character talents and count talent by tree
        //$specDetails = $this->armory->getTalentIconByClassSpec($thischaracter->class, $thisCharacter->spec);
        //$this->data->characterDisplayData->specIcon .= $specDetails->icon;
        //$this->data->characterDisplayData->specName = $specDetails->name;

        foreach($this->data->gear as $thisGear) {
            $enchantments = explode(' ', $thisGear->enchantments);
            //0 = permanent enchant? , sockets ???
            $gearInfo = $this->World->getAdditionalItemInfoByID($thisGear->itemEntry);
            $thisGear->name = $gearInfo->name;
            $thisGear->itemLevel = $gearInfo->ItemLevel;
            $thisGear->displayID = $gearInfo->displayid;
            $thisGear->icon = $this->Armory->getItemIconByDisplayID($thisGear->displayID);
            if($thisGear->slot != 19) {
                $this->data->sumItemLevel += $thisGear->itemLevel;
                $this->data->itemCount++;
            }
            $thisGear->slotName = $this->Armory->getSlotNameByID($thisGear->slot);
            $thisGear->displayOrder = $this->Armory->getSlotDisplayOrder($thisGear->slot);

        }
        $this->load->view('armory/sidebar', $this->data->characterDisplayData);
        $this->load->view('armory/characterOverview', $this->data);
    }

    public function characterReputation($characterName) {
        $characterGuid = $this->Characters->getCharacterGuidByName($characterName);
        $this->data->characterDisplayData = $this->Characters->getCharacterDisplayData($characterGuid);
        $this->data->characterDisplayData->characterName = ucfirst($characterName);
        $this->data->characterDisplayData->raceName = $this->Armory->getRaceNameByID($this->data->characterDisplayData->race);
        $this->data->characterDisplayData->className = $this->Armory->getClassNameByID($this->data->characterDisplayData->class);
        $this->data->characterDisplayData->characterIcon = 'images/portraits';
        $this->data->characterDisplayData->specIcon = 'images/spells_abilities';

        $this->data->reputations = $this->Characters->getReputations($characterGuid);
        foreach ($this->data->reputations as $thisReputation) {
            $thisReputation->name = $this->Armory->getFactionByID($thisReputation->faction);
            if ($thisReputation->standing > 42999) { //sons of hodir (faction 1119) for example.
                $thisReputation->standing -= 42000;
            }
            //0 is neutral zero
            if($thisReputation->standing < -6000) {
                $thisReputation->barClass = 'danger';
                $thisReputation->standingName = 'Hated';
                $thisReputation->calcStanding = $thisReputation->standing + 42000;
                $thisReputation->maxStanding = 36000;
            } elseif ($thisReputation->standing < -3000) {
                $thisReputation->barClass = 'danger';
                $thisReputation->standingName = 'Hostile';
                $thisReputation->calcStanding = $thisReputation->standing + 6000;
                $thisReputation->maxStanding = 3000;
            } elseif ($thisReputation->standing < 0) {
                $thisReputation->barClass = 'warning';
                $thisReputation->standingName = 'Unfriendly';
                $thisReputation->calcStanding = $thisReputation->standing + 3000;
                $thisReputation->maxStanding = 3000;
            } elseif ($thisReputation->standing < 3000) {
                $thisReputation->barClass = 'warning';
                $thisReputation->standingName = 'Neutral';
                $thisReputation->calcStanding = $thisReputation->standing;
                $thisReputation->maxStanding = 3000;
            } elseif ($thisReputation->standing < 9000) {
                $thisReputation->standingName = 'Friendly';
                $thisReputation->barClass = 'success';
                $thisReputation->calcStanding = $thisReputation->standing - 3000;
                $thisReputation->maxStanding = 6000;
            } elseif ($thisReputation->standing < 21000) {
                $thisReputation->standingName = 'Honored';
                $thisReputation->barClass = 'success';
                $thisReputation->calcStanding = $thisReputation->standing - 9000;
                $thisReputation->maxStanding = 12000;
            } elseif ($thisReputation->standing < 42000) {
                $thisReputation->standingName = 'Revered';
                $thisReputation->barClass = 'info';
                $thisReputation->calcStanding = $thisReputation->standing - 21000;
                $thisReputation->maxStanding = 21000;
            } else {
                $thisReputation->standingName = 'Exalted';
                $thisReputation->barClass = 'info';
                $thisReputation->calcStanding = $thisReputation->standing - 42000;
                if ($thisReputation->standing > 999) {
                    $thisReputation->calcStanding = 999;
                }
                $thisReputation->maxStanding = 999;
            }
        }
        usort($this->data->reputations, function($a, $b) {
            return $b->standing - $a->standing;
        });
        $this->load->view('armory/sidebar', $this->data->characterDisplayData);
        $this->load->view('armory/characterReputations', $this->data);

    }

    public function characterAchievements($characterName) {
        $this->load->view('armory/sidebar', $this->data->characterDisplayData);
    }

    public function characterTalents($characterName) {
        $characterGuid = $this->Characters->getCharacterGuidByName($characterName);
        $this->data->characterDisplayData = $this->Characters->getCharacterDisplayData($characterGuid);
        $this->data->characterDisplayData->characterName = ucfirst($characterName);
        $this->data->characterDisplayData->raceName = $this->Armory->getRaceNameByID($this->data->characterDisplayData->race);
        $this->data->characterDisplayData->className = $this->Armory->getClassNameByID($this->data->characterDisplayData->class);
        $this->data->characterDisplayData->characterIcon = 'images/portraits';
        $this->data->characterDisplayData->specIcon = 'images/spells_abilities';
        $this->data->specs = $this->Armory->getSpecs($this->data->characterDisplayData->class);
        foreach($this->data->specs as $thisSpec) {
            $this->data->talents[$thisSpec->id] = $this->Armory->getTalentsBySpecID($thisSpec->id); //has Row, Col positioning.
        }
        $this->data->characterTalents = $this->Characters->getCharacterTalents($characterGuid); //This does not return all ranks, just highest rank learned by spell ID. Must match spellID against talents[$spec]->Rank_1, etc.
        $this->load->view('armory/sidebar', $this->data->characterDisplayData);
        $this->load->view('armory/characterTalents', $this->data);
    }
}
