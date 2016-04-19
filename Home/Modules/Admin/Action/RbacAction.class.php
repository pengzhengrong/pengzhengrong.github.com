<?php

Class RbacAction extends CommonAction {

	private static $version = '1.0';

	Public function index() {

	}

	Public function role () { 
		$rest = M('role')->select();
		$this->rest = node_merge( $rest );
		// p($this->rest); exit;
		$this->version = $version;
		$this->display();
	}

	Public function role_add () {
		$this->pid = I('pid',0,'intval');
		if( IS_POST ){
			$data = array(
				'name' => I('name'),
				'pid' => I('pid',0,'intval') ,
				'status' => 1,
				'remark' => I('remark')
				);
			$rest = M('role')->data( $data )->add();
			$rest || $this->error( 'add failed' );
			U('Admin/Rbac/role','','',true);
		}
		$this->display();
	}

	Public function role_delete() {
		$id = I('id' ,0 ,'intval');
		$rest = M('role')->delete( $id );
		$rest || $this->error("delete failed");
		$this->redirect( 'Admin/Rbac/role' );
	}

	Public function access () {
		$rest = M('role')->select();
		$this->rest = node_merge( $rest );
		// p( $rest ); exit;
		$this->display();
	}

	public function _before_access(){
		//@error_log("\n this is RbacAction._before_access method",3,'/tmp/pzrlog.log');
	}

	public function _after_access() {
		//@error_log("\n this is RbacAction._after_access method",3,'/tmp/pzrlog.log');
	}

	Public function access_add () {
		$role_id = I('role_id' , 0 ,'intval');
		$node_ids = I('node_id');
		// p( $node_id ); exit;
		// p( array_map( 'explode_arr' , $node_ids) ); exit;
		$temp = array_map( 'explode_arr', $node_ids);
		$values = array();
		foreach ($temp as $key => $value) {
			$values[] = "({$role_id},{$value[0]},{$value[1]})";
		}
		$sql = 'insert into '.C('DB_NAME').'.think_access(`role_id`,`node_id`,`level`) values'.implode(',', $values);
		// p($sql); exit;
		// p($role_id); die;
		M('access')->where( 'role_id='.$role_id)->delete();
		$rest = M('access')->query( $sql );
		// p( $rest );echo $rest; exit;
		// $rest || $this->error( 'INSERT FAILED' );
		// $this->success('INSERT SUCCESS' );
		$this->redirect( 'Admin/Rbac/access' );
	}

	Public function access_node() {
		$this->role_id = I('id',0,'intval');
		$access = M('access')->where('role_id='.$this->role_id)->getField( 'node_id',true );
		// p( $access); exit;
		$field = array('id','name','remark','pid','level');
		$rest = M('node')->field( $field )->select();
		$this->rest = node_merge( $rest , $access );
		// p( $this->rest ); exit;
		$this->display();
	}

	Public function node () {
		$field = array('id','name','remark','pid','level');
		$rest = M('node')->field( $field )->select();
		$this->rest = node_merge( $rest );
		// p( $this->rest ); exit;
		$this->display();
	}

	Public function node_add () {
		if( IS_POST ){
			// p( I('post.') ); exit;
			$data = array(
				'name' => I('name'),
				'remark' => I('remark'),
				'pid' => I('pid' , 0 ,'intval'),
				'level' => I('level' , 0 ,'intval'),
				'status' => 1
				);
			// p( $data ); exit;
			$rest = M('node')->data( $data)->add();
			$rest || $this->error( 'save failed' );
			U('Admin/Rbac/node','','',true);
		}
		$this->level = I('level',1,'intval');
		switch ( $this->level ) {
			case 2:
				$type = 'ACTION';
				break;
			case 3:
				$type = 'METHOD';
				break;
			default:
				$type = 'MODULE'; 
				break;
		}
		$this->type = $type;
		$this->pid = I('pid',0,'intval');
		$this->display();
	}

	Public function node_delete () {
		$rest = M('node')->delete(I('id',0,'intval'));
		$rest || $this->error( 'delete failed' );
		$this->redirect( 'Admin/Rbac/node' );
	}

	Public function user () {

	}





}


?>