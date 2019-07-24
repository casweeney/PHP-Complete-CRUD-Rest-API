<?php
	class Category{
		private $conn;

		public function __construct($db){
			$this->conn = $db;
		}


		//Start fetchCategories
		public function fetchCategories($post, $mobile){
			$sql = "SELECT name FROM categories";
			$result = $this->conn->prepare($sql);

			$result->execute();
			if($result->rowCount() > 0){
				$categories = $result->fetchAll(PDO::FETCH_ASSOC);
				echo json_encode(array('status'=>'success', 'categories'=>$categories));
				die;
			}else{
				echo json_encode(array('status'=>'success', 'categories'=>'empty'));
				die;
			}
		}
		//End fetchCategories



		//Start fetchSingleCategory
		public function fetchSingleCategory($post, $mobile){
			$id = $post['id'];

			$sql = "SELECT name FROM categories WHERE id = :id";
			$result = $this->conn->prepare($sql);
			$result->bindParam('id', $id, PDO::PARAM_INT);
			$result->execute();

			if($result->rowCount() > 0){
				$category = $result->fetchAll(PDO::FETCH_ASSOC);
				echo json_encode(array('status'=>'success', 'category'=>$category));
				die;
			}else{
				echo json_encode(array('status'=>'success', 'category'=>'empty'));
				die;
			}
		}
		//End fetchSingleCategory




		//Start updateCategory
		public function updateCategory($post, $mobile){
			$id = $post['id'];
			$name = $post['name'];

			$sql = "UPDATE categories SET name = :name WHERE id = :id";
			$result = $this->conn->prepare($sql);
			$result->bindParam('name', $name, PDO::PARAM_STR);
			$result->bindParam('id', $id, PDO::PARAM_INT);
			$result->execute();

			if($result){
				echo json_encode(array('status'=>'success', 'message'=>'updated'));
				die;
			}else{
				echo json_encode(array('status'=>'error', 'message'=>'something went wrong'));
				die;
			}
		}
		//End updateCategory




		//Start deleteCategory
		public function deleteCategory($post, $mobile){
			$id = $post['id'];

			$sql = "DELETE FROM categories WHERE id = :id";
			$result = $this->conn->prepare($sql);
			$result->bindParam('id', $id, PDO::PARAM_INT);
			$result->execute();

			if($result){
				echo json_encode(array('status'=>'success', 'message'=>'deleted'));
				die;
			}else{
				echo json_encode(array('status'=>'error', 'message'=>'something went wrong'));
				die;
			}
		}
		//End deleteCategory
	}
