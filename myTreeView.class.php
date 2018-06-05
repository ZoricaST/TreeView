<?php
require('abstractTreeView.class.php');
/**
 * Implement your code here
 * Feel free to remove the echos :)
 */

class myTreeView extends abstractTreeView {
		public $allNodes = array();
		
        public function showCompleteTree() {
			
			$this->populateTree();
			$this->lang('eng');
			$this->arraySort();
			$this->presentTree('englishDiv','e');	
			$this->populateTree();
			$this->lang('eng');
			$this->lang('ger');
			$this->arraySort();
			$this->presentTree('germanDiv','d');			
		}
		
		public function showAjaxTree() {			
	
	
		}

		
		public function fetchAjaxTreeNode($entry_id) {
			include 'db_conn.php';			
			$sql = "SELECT entry_id, parent_entry_id FROM tree_entry WHERE  `parent_entry_id`='$entry_id'";				
				$result = $conn->query($sql);
				
				$i=0;
							if ($result->num_rows > 0) {
					// output data of each row hasChildren
					while($row = $result->fetch_assoc()) {
												
						$m=$row["entry_id"];
						//finde name
					
					$allNodes[$i]['id']=$m;
					$imeEng=$this->nameEng1($m);

					$allNodes[$i]['nameEng']=$imeEng;
					$imeGer=$this->nameGer($m);

					$allNodes[$i]['nameGer']=$imeGer;
					$dete=$this->hasChildren1($m);
					$allNodes[$i]['hasChildren']=$dete;
							
							++$i;}
							
foreach ($allNodes as $key => $row) {
    $id[$key]  = $row['id'];
    $nameEng[$key] = $row['nameEng'];
}
array_multisort($nameEng, SORT_ASC, $id, SORT_ASC, $allNodes);//in
for($x = 0; $x < $i; $x++) {
	if($allNodes[$x]['hasChildren']==0 ){echo '<a  href="#" class="withoutChild  collapsed"  >  ';
					echo '<i > <span class="E">'.$allNodes[$x]['nameEng'].'</span><span class="G"> '.$allNodes[$x]['nameGer'].'</span></i></a><br>';
					}
	else{ echo '<a  href="#'.$allNodes[$x]['id'].'" class="btn btn-light  collapsed" data-toggle="collapse" >';
	echo '<i onclick="showNode('.$allNodes[$x]['id'].')">  <span class="E">'.$allNodes[$x]['nameEng'].'</span><span class="G">'.$allNodes[$x]['nameGer'].'</span></i></a><br>';
echo '<div style=" padding-left: 35px;" id="'.$allNodes[$x]['id'].'"></div>';}
}

							}
		}
		
		public function nameGer($k)
  {include 'db_conn.php';
					$sql1 = "SELECT entry_id,name, lang FROM tree_entry_lang WHERE lang='ger' AND `entry_id`='$k'";
					$result = $conn->query($sql1); 
					if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        return  $Name= $row["name"];
    }
} else {
   return  $Name= $this->nameEng1($k);;
}			
		$conn->close();
  }

			public function hasChildren1($k) {
 $j=0;
			include 'db_conn.php';
				$sql = "SELECT entry_id, parent_entry_id FROM tree_entry WHERE  `parent_entry_id`='$k'";
				
				$result = $conn->query($sql);

					if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        ++$j;
    }
} else {
   
}
return $j;			
		$conn->close();
 
 }
  
			public function nameEng1($k)
  {
 include 'db_conn.php';

					$sql1 = "SELECT entry_id,name, lang FROM tree_entry_lang WHERE lang='eng' AND `entry_id`='$k'";
					$result = $conn->query($sql1); 
					if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {  
        return  $Name= $row["name"];
    }
} else {
    echo "0 results";
}			
		$conn->close();
  }	

public function populateTree(){
	
			include 'db_conn.php';
				$sql = "SELECT entry_id, parent_entry_id FROM tree_entry ORDER BY `parent_entry_id` ASC";
				$result = $conn->query($sql);
				$i=0;
				if ($result->num_rows > 0) {
					// output data of each row 
					while($row = $result->fetch_assoc()) {
						$nodes[$i][1]=$row["entry_id"];
						$nodes[$i][0]=$row["parent_entry_id"];$nodes[$i][2]=0;
						
					//  0 on the third place for a english name, later, in this place, an english name goes
						$nodes[$i][3]=0;++$i;}
				} else {
					echo "0 results";
				}
				$conn->close();
	$this->allNodes=$nodes;
	return $this->allNodes;
}			

			public function lang($lang){	
	include 'db_conn.php';
	$i=count($this->allNodes);
	$nodes=$this->allNodes;
					$sql1 = "SELECT entry_id,name, lang FROM tree_entry_lang  WHERE lang='$lang' ";
					$result = $conn->query($sql1);
					if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {
						$idLang=$row["entry_id"];
						$name=$row["name"];
						
						for ($r=0;$r<$i;++$r){if($nodes[$r][1]==$idLang){$nodes[$r][2]=$name; }}
														}					
					
												} else {echo "0 results";}

			$conn->close();
	
					return $this->allNodes=$nodes;
}

public function arraySort(){
	$i=count($this->allNodes);
	$nodes=$this->allNodes;
	for($x = 0; $x < $i; $x++) {
				$allNodesSort[$x]['parent']=$nodes[$x][0];$allNodesSort[$x]['id']=$nodes[$x][1];$allNodesSort[$x]['name2']=$nodes[$x][2];					
				}

				foreach ($allNodesSort as $key => $row) {
					     $parent[$key]  = $row['parent'];
						 $id[$key]  = $row['id'];
						 $name2[$key] = $row['name2'];
					                                   }
				
				array_multisort($name2, SORT_ASC, $allNodesSort);
				
				//back to $allNodes
				for($x = 0; $x < $i; $x++) {
				$nodes[$x][0]=$allNodesSort[$x]['parent'];$nodes[$x][1]=$allNodesSort[$x]['id'];$nodes[$x][2]=$allNodesSort[$x]['name2'];					
				}
			
					for($x = 0; $x < $i; $x++) {
						
						for($y = 0; $y < $i; $y++) {
						//Count how many children has 
						if($nodes[$x][1]==$nodes[$y ][0]){
												++$nodes[$x][3];
												array_push($nodes[$x],$nodes[$y ][1]);
												}	
													};						
										}
					$hasElements=$nodes[0][3]+3;
					
			return $this->allNodes=$nodes;
}

public function insertNode($father,$nodes,$letter){
	$hasAll=count($nodes);
	
	if($father->hasChildren>0){echo '<p><a href="#'.$letter.$father->id.'" class="btn btn-light collapsed" data-toggle="collapse" >'.$father->name.'</a></p>';
	echo '<div style=" padding-left: 35px;" class="list-group collapse" id="'.$letter.$father->id.'">';
	for($y = 0; $y <$father->hasChildren ; $y++){
		for($r = 0; $r <$hasAll ; $r++){if($father->child[$y]==$nodes[$r][1]){$thisId=$r;}}//find the child's id
		
		for($s = 0; $s <$nodes[$thisId][3]+4; $s++){
		$son= new MyNode($nodes[$thisId][0],$nodes[$thisId][1],$nodes[$thisId][2],$nodes[$thisId][3]+4);
		for($j = 4; $j <$son -> hasElements; $j++){$son ->child[$j-4]=$nodes[$thisId][$j];	}		
												}
												$this->insertNode($son,$nodes,$letter);
		
	}
	echo '</div>';}
	else {echo '<p><a  href="#" class="withoutChild  collapsed"  >'.$father->name.'</a></p>';	
				}
}//the end of the declaration function

public function presentTree($IdDiv,$letter){				
echo '<div id="'.$IdDiv.'">';				
				$i=count($this->allNodes);
$nodes=$this->allNodes;				
				
				for($x = 0; $x <$i ; $x++) {										
					if($nodes[$x][0]==0)
					{
					$first= new MyNode($nodes[$x][0],$nodes[$x][1],$nodes[$x][2],$nodes[$x][3]+4);
					
					for($y = 4; $y <$first -> hasElements; $y++){$first ->child[$y-4]=$nodes[$x][$y];}//make children
										$this->insertNode($first,$nodes,$letter);
					}			
											}
			echo '</div>';		
}

}
class MyNode
{
    public $name;
    public $parentNodeId;
    public $hasElements;
	public $hasChildren;
	 public $id;
	public $child = array();
	public $nesto = array();

    public function __construct($parentNodeId,$id,$name,$hasElements) {
		
		$this->parentNodeId =$parentNodeId;
		$this->id =$id;
		$this->name =$name;
		$this->hasElements =$hasElements;
		$this->hasChildren =$hasElements-4;
		
    }	
}
 
