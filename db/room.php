<?php

	class room {
		public $server = 'localhost';
		public $user = 'root';
		public $passwd = 'root';
		public $db = 'room';

		public function __construct(){
		    $this->dbCon = new mysqli($this->server, $this->user, $this->passwd, $this->db);
		}

		public function __destruct(){
      
  		}

		function select(){
			
			$myQuery = "SELECT * FROM room;";
			$results = $this->dbCon->query($myQuery);
			$dataresult = array();
			if ($results->num_rows > 0) {
				while($row = $results->fetch_assoc()) {
					$dataresult[] = [ 
					    'id' => $row["id"],
					    'name' => $row["name"],
					    'price' => $row["price"],
					    'status' => $row["status"]
				    ];
				}

			} 
			return $dataresult;
		}

		function find($id){
			$stmt = $this->dbCon->prepare("SELECT * FROM room WHERE id = ?");
			$stmt->bind_param("i",$id);
			$stmt->execute();
			$stmt->bind_result($id, $name, $price, $status);
			$data = array();
			while ($stmt->fetch()) {
				$data = ['id'=>$id, 'name'=>$name, 'price'=>$price,'status'=>$status];
			}
			return $data;
		}

		function filter($data){
			$filterdata = array();
			if(!empty($data['price']) && !is_null($data['status'])) {
				$stmt = $this->dbCon->prepare("SELECT * FROM room WHERE price = ? AND status = ?");
				$stmt->bind_param("di",$data['price'],$data['status']);
			} else if(empty($data['price']) && !is_null($data['status'])) {
				$stmt = $this->dbCon->prepare("SELECT * FROM room WHERE status = ?");
				$stmt->bind_param("i",$data['status']);
			} else if(!empty($data['price']) && is_null($data['status'])) {
				$stmt = $this->dbCon->prepare("SELECT * FROM room WHERE price = ?");
				$stmt->bind_param("d",$data['price']);
			} else { return $filterdata;}
			$stmt->execute();
			$stmt->bind_result($id, $name, $price, $status);
			
			while ($stmt->fetch()) {
				$filterdata[] = [ 
					    'id' => $id,
					    'name' => $name,
					    'price' => $price,
					    'status' => $status
				    ];
			}
			return $filterdata;
		}

		function add($data){
			$stmt = $this->dbCon->prepare("INSERT INTO room(name, price,status) values(?,?,?)");
			$stmt->bind_param("sdi",$data['name'],$data['price'],$data['status']);
			$stmt->execute();
		}

		function delete($id){
			$stmt = $this->dbCon->prepare("DELETE FROM room WHERE id = ?");
			$stmt->bind_param("i",$id);
			$stmt->execute();
		}

		function update($data){
			$stmt = $this->dbCon->prepare("UPDATE room SET name=?, price=?,status=? WHERE id=?");
			$stmt->bind_param("sdii",$data['name'],$data['price'],$data['status'],$data['id']);
			$stmt->execute();
		}
	}
?>
