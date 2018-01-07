<?php




class clsNavBarConstruction
{
    public $navtree = array();
    public $navtypes = array();
    public $navitem = array();
    public $usermask = 0;
    public $realnav = true;
    
    public function __construct($userflags = 0, $bolGetRealNav = true)
    {
        $this->realnav = $bolGetRealNav;
        $this->loadNavFromDB();
        $this->usermask=$userflags;
    }
    
    public function refreshFromDB()
    {
        $this->loadNavFromDB();
    }
    
    public function getNavArray($bolActiveForCurrentUser = true)
    {
        return $this->navtree;
    }
    
    public function getNavTypesArray()
    {
        return $this->navtypes;
    }
 
    private function loadNavFromDB()
    {
        //$catch = false;
        $dump = DB::query('Select * from nav_types');
        for ($x=0;$x<count($dump);$x++) {
            $this->navtypes[$dump[$x]['id']] = $dump[$x];
        }
        $dump = DB::query('Select * from nav ORDER by nav_parentid ASC, nav_sort ASC');
        $this->navtree = $dump;
    }

    public function addNavItem($title)
    {
    }
    ///////
    
////
}
