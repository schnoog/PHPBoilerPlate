<?php

/**
 * This is the main presetrequest function
 * It uses the "$request" String to get valid options (when required, for example language setting limitation on availables)
 * 
 * The request should consist of (I assume the function to call is getmylist)
 * a) >getmylist< one function name. The function will be called without parameter $x = getmylist()
 * b) >getmylist:onlynice< one fuction name and one parameter, delimited by :   $x= getmylist(onlynice)
 * c) >getmylist:onlynice:second:...:last< one fuction name and one parameter, delimited by :   $x= getmylist(onlynice, second,....,last)
 * d) >SETTINGS:langs:available< an array out of the main settings
 * or >SETTINGS:pages<     (if a return value is not an array, it will be intergated in one $x=array($y))
 * 
 * If the returned value is numeric, ensure that the value is NOT! only the array key!
 * 
 * Warning:
 * The function call is not secured by any white- or blacklist. Each function available in the php enviroment is callable
 * Therefore this section is limited to the adminroles.
 * 
 */
 
 function presetrequest($request){
    global $Settings;
    $retval = array();
    $res = "";
    if (strlen($request)< 1) return $retval;
    if (!strpos($request,":")){
        if (function_exists ($request)) $retval = call_user_func($request);
        return $retval;
    }
    if (strpos("x" .$request,"SETTINGS")>0){
        $set = explode(":",$request);
            $cnt = count($set);
            switch ($cnt){
                case "2":
                $res = $Settings[$set[1]];
                break;
                case "3":
                $res = $Settings[$set[1]][$set[2]];
                break;
                case "4":
                $res = $Settings[$set[1]][$set[2]][$set[3]];                
                break;
            }
        if(!is_array($res)) $res = array($res);
        return $res;        
    }
    
    //call_user_func_array(
    list($func,$paralist) =  explode(":",$request,2);
    if (strpos($paralist,":")>0){
        $paras = explode(":",$paralist);
        if (function_exists ($func)) $res = call_user_func_array($func,$paras);
    }else{
        if (function_exists ($func)) $res = call_user_func($func,$paralist);
    }

        if(!is_array($res)) $res = array($res);
        return $res;     
    //SETTINGS:langs:available
    //Function:paramater
    
        
    
}
