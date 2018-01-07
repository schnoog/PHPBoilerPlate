<?php

//////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
function getFormvalidatorString($validationstring, $preset='', $onlypreset='')
{
    $vallist=array();
    $optlist=array();
    if (strlen($validationstring)<5) {
        return "";
    }
    $allvals = explode('|', $validationstring);
    for ($x = 0; $x < count($allvals);$x++) {
        $val = $allvals[$x];
        $r = $val;
        $rule_name = $r;
        $rule_params = [];

        // For each rule in the list, see if it has any parameters. Example: minlength[5].
        if (preg_match('/\[(.*?)\]/', $r, $matches)) {
            // This one has parameters. Split out the rule name from it's parameters.
            $rule_name = substr($r, 0, strpos($r, '['));
            // There may be more than one parameters.
            $rule_params = explode(',', $matches[1]);
        } elseif (preg_match('/\{(.*?)\}/', $r, $matches)) {
            // This one has an array parameter. Split out the rule name from it's parameters.
            $rule_name = substr($r, 0, strpos($r, '{'));
            // There may be more than one parameter.
            $rule_params = array(explode(',', $matches[1]));
        }
        $return[$rule_name] = $rule_params;
    }
  
    $lengthset = false;
    $voptlist['length']['min'] = 0;
    $voptlist['length']['max'] = 4096;
    $numberrangeset=false;
    $voptlist["number"]['min'] = -9007199254740990;
    $voptlist["number"]['max'] = 9007199254740990;

    foreach ($return as $key => $valueArr) {
        if (count($valueArr)> 0) {
            $value = $valueArr[0];
        }
        switch ($key) {
                case "required":
                    $vallist[]="required";
                break;
                case "minlength":
                    $vallist[]="length";
                    $lengthset=true;
                    $voptlist["length"]['min'] = $value; // 'data-validation-length="min'.$value.'"';
  
                    /*data-validation-length="min9999"*/
                break;
                case "maxlength":
                    $vallist[]="length";
                    $lengthset=true;
                    /*data-validation-length="max9999"*/
                    $voptlist["length"]['max'] = $value; //'data-validation-length="max'.$value.'"';
                break;
                case "exactlength":
                    $vallist[]="length";
                    $lengthset=true;
                    $voptlist["length"]['min'] = $value;
                    $voptlist["length"]['max'] = $value;
                    /*data-validation-length="9999-9999"*/
                break;
                case "float":
                    $vallist[]="number";
                    $optlist["number"] = 'data-validation-allowing="float"';
                    /*data-validation-allowing="float"*/
                break;
                case "numeric":
                    $vallist[]="number";
                break;
                case "integer":
                    $vallist[]="number";
                    $numberrangeset=true;
                      
                break;
                case "greaterthan":
                    $vallist[]="number";
                    $numberrangeset=true;
                    $voptlist["number"]['min'] = $value;
                    /*data-validation-allowing="range[9999,9007199254740991,negative]"*/
                break;
                case "lessthan":
                    $vallist[]="number";
                    $numberrangeset=true;
                    $voptlist["number"]['max']= $value;
                    /*data-validation-allowing="range[-9007199254740991,9999,negative]"*/
                break;
                case "alpha":
                    $vallist[]="custom";
                    $optlist['custom'] = 'data-validation-regexp="^([a-z, A-Z]+)$"';
                    /*data-validation-regexp="^([a-z, A-Z]+)$"*/
                break;
                case "alphanumeric":
                    $vallist[]="alphanumeric";
                break;
                case "email":
                    $vallist[]="email";
                break;
                case "url":
                    $vallist[]="url";
                break;
                case "startswith":
                    $vallist[]="custom";
                    $optlist['custom'] = 'data-validation-regexp="^'.$value.'"';
                    /*data-validation-regexp="^9999"*/
                break;
                case "endswith":
                    $vallist[]="custom";
                    $optlist['custom'] = 'data-validation-regexp="'.$value.'$"';
                    /*data-validation-regexp="9999$"*/
                break;
                case "contains":
                    $vallist[]="custom";
                    $optlist['custom'] = 'data-validation-regexp="'.$value.'"';
                    /*data-validation-regexp="9999"*/
                break;
                case "regex":
                    $vallist[]="custom";
                    $optlist['custom'] = 'data-validation-regexp="'.$value.'"';
                    /*data-validation-regexp="9999"*/
                break;
                case "date":
                    $vallist[]="date";
                    $optlist['date'] = 'data-validation-format="'.strtolower($value).'"';
                    /*data-validation-format="yyyymmdd" 9999 -> lcase 9999*/
                break;
            }
    }
    if (count($vallist)<1) {
        return "";
    }
    $sets = array_unique($vallist);
    $outt1 = ' data-validation="' . implode(" ", $sets) . '" ';
    if ($lengthset) {
        $optlist["length"] = 'data-validation-length="'.$voptlist['length']['min'].'-'.$voptlist['length']['max'].'"';
    }
    if ($numberrangeset) {
        $optlist["number"] = 'data-validation-allowing="range['.$voptlist["number"]['min'].','.$voptlist["number"]['max'].',negative]"';
    }
    foreach ($optlist as $key => $value) {
        $outt1 .= " " . $value;
    }
    return $outt1;
}
//////////////////////////////////////////////
function getFormvalidatorStringOLD($validationstring, $preset='', $onlypreset='')
{
    $vallist=array();
    $optlist=array();
    if (strlen($validationstring)<5) {
        return "";
    }
    $allvals = explode('|', $validationstring);
    for ($x = 0; $x < count($allvals);$x++) {
        $val = $allvals[$x];
        $r = $val;
        $rule_name = $r;
        $rule_params = [];

        // For each rule in the list, see if it has any parameters. Example: minlength[5].
        if (preg_match('/\[(.*?)\]/', $r, $matches)) {
            // This one has parameters. Split out the rule name from it's parameters.
            $rule_name = substr($r, 0, strpos($r, '['));
            // There may be more than one parameters.
            $rule_params = explode(',', $matches[1]);
        } elseif (preg_match('/\{(.*?)\}/', $r, $matches)) {
            // This one has an array parameter. Split out the rule name from it's parameters.
            $rule_name = substr($r, 0, strpos($r, '{'));
            // There may be more than one parameter.
            $rule_params = array(explode(',', $matches[1]));
        }
        $return[$rule_name] = $rule_params;
    }
  
    foreach ($return as $key => $valueArr) {
        if (count($valueArr)> 0) {
            $value = $valueArr[0];
        }
        switch ($key) {
                case "required":
                    $vallist[]="required";
                break;
                case "minlength":
                    $vallist[]="length";
                    $optlist["length"] = 'data-validation-length="min'.$value.'"';
                    /*data-validation-length="min9999"*/
                break;
                case "maxlength":
                    $vallist[]="length";
                    /*data-validation-length="max9999"*/
                    $optlist["length"] = 'data-validation-length="max'.$value.'"';
                break;
                case "float":
                    $vallist[]="number";
                    $optlist["number"] = 'data-validation-allowing="float"';
                    /*data-validation-allowing="float"*/
                break;
                case "numeric":
                    $vallist[]="number";
                break;
                case "integer":
                    $vallist[]="number";
                break;
                case "exactlength":
                    $vallist[]="length";
                    $optlist["length"] = 'data-validation-length="'.$value.'-'.$value.'"';
                    /*data-validation-length="9999-9999"*/
                break;
                case "greaterthan":
                    $vallist[]="number";
                    $optlist["number"] = 'data-validation-allowing="range['.$value.',9007199254740991,negative]"';
                    /*data-validation-allowing="range[9999,9007199254740991,negative]"*/
                break;
                case "lessthan":
                    $vallist[]="number";
                    $optlist["number"] = 'data-validation-allowing="range[9007199254740991,'.$value.',negative]"';
                    /*data-validation-allowing="range[-9007199254740991,9999,negative]"*/
                break;
                case "alpha":
                    $vallist[]="custom";
                    $optlist['custom'] = 'data-validation-regexp="^([a-z, A-Z]+)$"';
                    /*data-validation-regexp="^([a-z, A-Z]+)$"*/
                break;
                case "alphanumeric":
                    $vallist[]="alphanumeric";
                break;
                case "email":
                    $vallist[]="email";
                break;
                case "url":
                    $vallist[]="url";
                break;
                case "startswith":
                    $vallist[]="custom";
                    $optlist['custom'] = 'data-validation-regexp="^'.$value.'"';
                    /*data-validation-regexp="^9999"*/
                break;
                case "endswith":
                    $vallist[]="custom";
                    $optlist['custom'] = 'data-validation-regexp="'.$value.'$"';
                    /*data-validation-regexp="9999$"*/
                break;
                case "contains":
                    $vallist[]="custom";
                    $optlist['custom'] = 'data-validation-regexp="'.$value.'"';
                    /*data-validation-regexp="9999"*/
                break;
                case "regex":
                    $vallist[]="custom";
                    $optlist['custom'] = 'data-validation-regexp="'.$value.'"';
                    /*data-validation-regexp="9999"*/
                break;
                case "date":
                    $vallist[]="date";
                    $optlist['date'] = 'data-validation-format="'.strtolower($value).'"';
                    /*data-validation-format="yyyymmdd" 9999 -> lcase 9999*/
                break;
            }
    }
    if (count($vallist)<1) {
        return "";
    }
    $sets = array_unique($vallist);
    $outt1 = ' data-validation="' . implode(" ", $sets) . '" ';
    
    foreach ($optlist as $key => $value) {
        $outt1 .= " " . $value;
    }

    return $outt1;
}

////////////////////////////////////////////////
////////////////////////////////////////////////
function getBS4Control($presetstring, $controlid, $limittopreset, $value="", $valstring = "")
{
    $preset = presetrequest($presetstring);
    if ($limittopreset == 1) {
        if (count($preset) == 0) {
            return "";
        }
        $tmp ="<select class='form-control' name='".$controlid."' id='".$controlid."' ".$valstring." >";
        foreach ($preset as $prekey => $preval) {
            $sel = "";
            if ($prekey == $value) {
                $sel="selected='selected'";
            }
            if ($preval == $value) {
                $sel="selected='selected'";
            }
            if (strlen($value)<1) {
                $sel="";
            }
            if (is_numeric($prekey)) {
                $mk = $preval;
            } else {
                $mk = $prekey;
            }
            $tmp .= "<option value='".$mk."' ".$sel.">" . $preval . "</option>";
        }
        $tmp .= "</select>";
        return $tmp;
    } else {
        $tmp = "<input class='form-control' value='".$value."' type='text' list='".$controlid."X'  name='".$controlid."' id='".$controlid."'". $valstring . " >";
        $tmp .= "<datalist id='".$controlid."X'>";
        foreach ($preset as $prekey => $preval) {
            $mk = $prekey;
            if (is_numeric($prekey)) {
                $mk = $preval;
            }
            $tmp .= "<option value='".$mk."'>" . $preval . "</option>";
        }
        $tmp .= "</datalist>";
        return $tmp;
    }
}


/*
required:data-validation="required"
minlength:data-validation-length="min9999"
maxlength:data-validation-length="max9999"
numeric:data-validation="number"
float:data-validation="number" data-validation-allowing="float"
integer:data-validation="number"
exactlength:data-validation="length" data-validation-length="9999-9999"
greaterthan:data-validation="number" data-validation-allowing="range[9999;9007199254740991,negative]"
lessthan:data-validation="number" data-validation-allowing="range[-9007199254740991;9999],negative"
alpha:data-validation="custom" data-validation-regexp="^([a-z, A-Z]+)$"
alphanumeric:data-validation="alphanumeric"
email:data-validation="email"
url:data-validation="url"
startswith:data-validation="custom" data-validation-regexp="^9999"
endswith:data-validation="custom" data-validation-regexp="9999$"
contains::data-validation="custom" data-validation-regexp="9999"
regex:data-validation="custom" data-validation-regexp="9999"
date[YYYYMMDD]:data-validation="date" data-validation-format="yyyymmdd"  9999 -> lcase 9999

*/
