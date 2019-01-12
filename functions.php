<?php 

$db = mysqli_connect('localhost', 'root', '', 'uzduotis');

class Medis {     
    public function getList(){
        global $db;

        $query = "SELECT elementas.pavadinimas, (COUNT(parent.pavadinimas) - 1) AS level FROM korys AS elementas,
        korys AS parent WHERE elementas.lft BETWEEN parent.lft AND parent.rgt GROUP BY elementas.pavadinimas ORDER BY elementas.lft";

        $result = mysqli_query($db, $query);

        $tree = array();
        while($row = mysqli_fetch_assoc($result)) {
            $tree[] = $row;
        }

        $result = '';
        $dabLevel = -1;
        while (!empty($tree)) {
            $dabElemen = array_shift($tree);
  
            if ($dabElemen['level'] > $dabLevel) {   
                $result .= '<ul>';
            }
  
            if ($dabElemen['level'] < $dabLevel) {    
                $result .= str_repeat('</ul>', $dabLevel - $dabElemen['level']);
            }
  
            $result .= '<li>' . $dabElemen['pavadinimas'] . '</li>';  
            $dabLevel = $dabElemen['level'];
  
            if (empty($tree)) {    
                $result .= str_repeat('</ul>', $dabLevel + 1);
            }
        }
        print $result;
    }
    
    public function getDepth(){
        global $db;
		$query = "SELECT elementas.pavadinimas, (COUNT(parent.pavadinimas) - 1) AS level FROM korys AS elementas,
        korys AS parent WHERE elementas.lft BETWEEN parent.lft AND parent.rgt GROUP BY elementas.pavadinimas ORDER BY elementas.lft";
        $result = mysqli_query($db, $query);        
		$numRows = $result->num_rows;
		if($numRows > 0){
			while($row = $result->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}				
    }   
    
    public function showResult(){
		$datas2 = $this->getDepth();
		foreach($datas2 as $data){						
            echo print_r($data)."<br>";            		
		}
	}
} 
?>