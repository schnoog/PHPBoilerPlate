<?php
//`user_settingkeys` (`id`, `usersetting_key`, `usersetting_desc`, `usersetting_default`,
// `usersetting_typevaliparameter`, `usersetting_required`, `usersetting_preset`)

//user_settings
//id	userid	settingkey	settingval	settingset
class Usersettings
{
    public $settings = array();
    public $presets = array();
    public $userid = 0;
    public $item;
    public $lastset = "";
    public $bolIsParsedIn = false;
    
    private $key;
    public function __construct($Userid=0)
    {
        if ($Userid!=0) {
            $this->userid = $Userid;
        }
        $this->loadPresets();
    }

    


    public function loadPresets()
    {
        $res = DB::query("Select *, usersetting_default as value from user_settingkeys");
        unset($this->presets);
        for ($x = 0;$x < count($res);$x++) {
            $item = $res[$x];
            $this->presets[$item['id']] = $item;
        }
    }

    public function parseUserIn()
    {
        if (count($this->presets)<1) {
            $this->loadPresets();
        }
        unset($this->settings);
        $this->settings = $this->presets;
        $this->bolIsParsedIn = true;
        if ($this->userid == 0) {
            return true;
        }
        $res = DB::query("Select * from user_settings WHERE userid = %i", $this->userid);
        for ($x = 0;$x < count($res);$x++) {
            $this->settings[$res[$x]['settingkey']]['value'] = $res[$x]['settingval'];
            $this->settings[$res[$x]['settingkey']]['settingset'] = $res[$x]['settingset'];
        }
    }

    public function saveUserSettingIfValid($SettingKey, $SettingValue)
    {
        if ($this->userid == 0) {
            return false;
        }
        if (count($this->presets)<1) {
            $this->loadPresets();
        }
        $preset = $this->presets[$SettingKey];
        if (strlen($preset['usersetting_typevaliparameter'])>0) {
            $this->item = array();
            $this->item['tocheck']= $SettingValue;
            $tmp = validateInput($this->item, 'tocheck', 'tocheck', $preset['usersetting_typevaliparameter']);
            if (!$tmp) {
                return false;
            }
        }
        if ((strlen($preset['usersetting_preset'])>0) && $preset['usersetting_limittopreset'] == 1) {
            $availsets = presetrequest($preset['usersetting_preset']);
            $isin = false;
            foreach ($availsets as $key => $value) {
                if (!is_numeric($key)) {
                    if ($key == $SettingValue) {
                        $isin = true;
                    }
                }
                if ($value == $SettingValue) {
                    $isin = true;
                }
            }
            if (!$isin) {
                error_log("not in list");
                return false;
            }
        }
        //save to db here!
        $res = DB::query('Select * from user_settings WHERE userid = %i and	settingkey = %i', $this->userid, $SettingKey);
        if (DB::count() == 0) {
            $sql = "Insert into user_settings (settingval,settingset,userid ,settingkey) VALUES (%s,%i,%s,%i)";
        } else {
            $sql = "UPDATE user_settings SET settingval = %s ,settingset = %i WHERE userid = %i AND settingkey = %i";
        }
        $this->lastset = $SettingValue;
        DB::query($sql, $SettingValue, time(), $this->userid, $SettingKey);
        $this->bolIsParsedIn = false;
        return true;
    }

    
    public function getLastSet()
    {
        return $this->lastset;
    }

    public function getSettings($limitid=0)
    {
        if (!$this->bolIsParsedIn) {
            $this->parseUserIn();
        }
        if ($limitid == 0) {
            return $this->settings;
        }
        $tmp[$limitid] = $this->settings[$limitid];
        return $tmp;
    }
    public function getPresets()
    {
        return $this->presets;
    }

    public function getSingleSetting($SettingKey)
    {
        if (count($this->presets)<1) {
            $this->loadPresets();
        }
        if (!$this->bolIsParsedIn) {
            $this->parseUserIn();
        }
        foreach ($this->settings as $key => $sett) {
            if ($sett['usersetting_key'] == $SettingKey) {
                if (isset($sett['value'])) {
                    return $sett['value'];
                }
            }
        }
        return "";
    }
}
