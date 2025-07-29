<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Custom_m extends CI_Model {
	public function __construct(){
		// parent::__construct();
		$this->db->query("SET sql_mode = ''");
	}

public function insert_features($user_id){
	$fetaures = $this->default_m->select('feature_list');
	$check_feature = $this->default_m->select_all_by_user_id($user_id,'subscribe_features');

	if(count($check_feature) == 0){
		foreach ($fetaures as $key => $row) {
			$data =  array(
				'feature_id' => $row['id'],
				'user_id' => $user_id,
				'status' => 1,
				'created_at' => d_time(),
			);
			$this->default_m->insert($data,'subscribe_features');
		}

	}elseif(count($check_feature) == count($fetaures)){
		return true;
	}elseif(count($check_feature) < count($fetaures)){
		
		foreach ($fetaures as $key => $row) {
			$feature_id = $this->admin_m->get_users_active_features($row['id'],$user_id);
			
			if($feature_id['feature_id']!=$row['id']){
				$data =  array(
					'feature_id' => $row['id'],
					'user_id' => $user_id,
					'status' => 1,
					'created_at' => d_time(),
				);
				$this->default_m->insert($data,'subscribe_features');
			}
			
		}
	}
	
	return true;
}

public function transfer_data($old_table,$new_table,$type)
{

	$new_table_data = $this->admin_m->select($new_table);
	if(sizeof($new_table_data) == 0 || empty($new_table_data)):
		$old_table_data = $this->admin_m->select($old_table);
		$language_list = $this->admin_m->select('languages');
		if(isset($old_table_data) && sizeof($old_table_data) > 0):
			foreach ($old_table_data as $key => $data1) {
				$data[] = [
					'id' => $data1['id'],
					'shop_id' => $data1['shop_id'],
					'user_id' => $data1['user_id'],
					'language' => st()->language,
					'created_at' => $data1['created_at'],
					'is_special' => $data1['is_special'],
				];
				$updateData = [
					'uid' => uid(),
					$type => $data1['id'],
					'language' => st()->language,
				];
				$this->admin_m->update($updateData, $data1['id'], $old_table);
			}
			$this->admin_m->insert_all($data, $new_table);
		endif;
	endif;

	return true;


	

}

public function get_data($data,$lang)
{
	$dt =  array_merge($lang,$data);

	return $dt;
	
}
	

}
