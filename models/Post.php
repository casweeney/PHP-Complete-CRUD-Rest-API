<?php
	class Post{
		private $conn;

		//DB Constructor
		public function __construct($db){
			$this->conn = $db;
		}

		//Start fetchPost
		public function fetchPost($post, $mobile) {
			$sql = 'SELECT c.name AS category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at
                FROM
                    posts p 
                LEFT JOIN
                    categories c ON p.category_id = c.id
                ORDER BY
                    p.created_at DESC';

            $result = $this->conn->prepare($sql);
            $result->execute();

            if($result->rowCount() > 0){
            	$posts = $result->fetchAll(PDO::FETCH_ASSOC);
            	echo json_encode(array('status'=>'success', 'posts'=>$posts));
            	die;
            }else{
            	echo json_encode(array('status'=>'success', 'posts'=>'empty'));
            	die;
            }

		}
		//End fetchPost





		//Start fetchSinglePost
		public function fetchSinglePost($post, $mobile) {
			$id = $post['id'];

			$sql = 'SELECT c.name AS category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at
                FROM
                    posts p 
                LEFT JOIN
                    categories c ON p.category_id = c.id 
                WHERE p.id = :id';

        	$result = $this->conn->prepare($sql);

        	$result->bindParam('id', $id);
        	$result->execute();

        	if($result->rowCount() > 0){
        		$post = $result->fetchAll(PDO::FETCH_ASSOC);
        		echo json_encode(array('status'=>'success', 'post'=>$post));
        		die;
        	}else{
        		echo json_encode(array('status'=>'success', 'post'=>'empty'));
        		die;
        	}
		}
		//End fetchSinglePost





		//Start makePost
		public function makePost($post, $mobile){

			$category_id = $post['category_id'];
			$title = $post['title'];
			$body = $post['body'];
			$author = $post['author'];

			$sql = 'INSERT INTO posts(category_id, title, body, author) VALUES(:category_id, :title, :body, :author)';
			$result = $this->conn->prepare($sql);
			$result->bindParam('category_id', $category_id);
			$result->bindParam('title', $title);
			$result->bindParam('body', $body);
			$result->bindParam('author', $author);
			$result->execute();

			if($result){
				echo "success";
			}else{
				echo "Error";
			}
		}
		//End makePost



		//Start updatePost
		public function updatePost($post, $mobile){
			$id = $post['id'];
			$category_id = $post['category_id'];
			$title = $post['title'];
			$body = $post['body'];
			$author = $post['author'];

			$sql = "UPDATE posts SET category_id = :category_id, title = :title, body = :body, author = :author WHERE id = :id";
			$result = $this->conn->prepare($sql);

			$result->bindParam('category_id', $category_id, PDO::PARAM_INT);
			$result->bindParam('title', $title, PDO::PARAM_STR);
			$result->bindParam('body', $body, PDO::PARAM_STR);
			$result->bindParam('author', $author, PDO::PARAM_STR);
			$result->bindParam('id', $id, PDO::PARAM_INT);
			$result->execute();

			if($result){
				echo json_encode(array('status'=>'success', 'message'=>'Updated'));
				die;
			}else{
				echo json_encode(array('status'=>'error', 'message'=>'Something went wrong'));
				die;
			}
		}
		//End updatePost



		
		//Start deletePost
		public function deletePost($post, $mobile){
			$id = $post['id'];

			$sql = "DELETE FROM posts WHERE id = :id";
			$result = $this->conn->prepare($sql);
			$result->bindParam('id', $id, PDO::PARAM_INT);
			$result->execute();

			if($result){
				echo json_encode(array('status'=>'success', 'message'=>'Deleted'));
				die;
			}else{
				echo json_encode(array('status'=>'error', 'message'=>'Something went wrong'));
				die;
			}
		}
		//End deletePost

	}