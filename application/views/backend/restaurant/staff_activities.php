<div class="row">
	<div class="col-md-7">
		<div class="card">
			<div class="card-header space-between flex-sm-column">
				<h4 class="card-title"><?= lang('staff_activities');?></h4>
				<div class="filterAreas">
					<form action="" method="get">						
						<div class="filterContent">
							<div class="input-group date">
								<input type="text" name="daterange" class="form-control dateranges" value="<?= isset($_GET['daterange'])?daterange($_GET['daterange']):'';?>" autocomplete="off"> 
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
							</div>
							<button type="submit" class="btn btn-secondary"><i class="icofont-filter"></i> <?= lang('filter');?></button>
						</div>
					</form>
				</div>		
			</div>
			<!-- /.box-header -->
			<div class="card-body">
				<div class="upcoming_events">
					<div class="table-responsive">
						<table class="table table-condensed table-striped data_tables">
							<thead>
								<tr>
									<th><?= !empty(lang('sl'))?lang('sl'):"Sl";?></th>
									<th><?= lang('order_id');?></th>
									<th><?= lang('order_type');?></th>
									<th><?= lang('action');?></th>
									<th><?= lang('date');?></th>
								</tr>
							</thead>
							<tbody>
								<?php $i=1; foreach ($staff_list as $row): ?>
									<tr>
										<td><?= $i;?></td>
										<td>#<a href="<?= base_url("admin/order-details/{$row->uid}");?>" target="_blank"><?= $row->uid;?></a></td>
										<td><?= order_type($row->order_type)?></td>
										<td>
											<?php 

												if($row->staff_action=='create_order'):
													echo lang('order').' '.lang('create');
												elseif($row->staff_action=='accept'): 
													echo lang('order').' '.lang('accept');
												elseif($row->staff_action=='complete'):
													echo lang('order').' '.lang('complete');
												 elseif($row->staff_action=='reject'):
													echo lang('order').' '.lang('reject');
												 endif;
											 ?>
										</td>

										<td>	
											<?php 
											if($row->staff_action=='create_order'):
												echo full_date($row->created_at);
											elseif($row->staff_action=='accept'): 
												echo full_date($row->accept_time);
											elseif($row->staff_action=='complete'):
												echo full_date($row->completed_time);
											 elseif($row->staff_action=='reject'):
												echo full_date($row->cancel_time);
											 endif;?>

										</td>
									</tr>
								<?php $i++; endforeach ?>
							</tbody>
						</table>
					</div>
				</div>	
			</div><!-- /.box-body -->
		</div>
	</div>

	<div class="col-md-4 col-lg-3 col-sm-4">
		<div class="card">
			<div class="card-body">
				<div class="card-profile">
					<img src="<?= avatar($staff_info->thumb,'profile');?>" alt="">
				</div>
				<div class="card-details">
					<h4><?= $staff_info->name;?></h4>
					<p><?= $staff_info->uid;?></p>
					<?php $order = $this->admin_m->get_my_staff_info($staff_info->id); ?>
					<ul>
						<li><?= lang('order').' '.lang('create');?>: <?= $order->create_order??0;?></li>
						<li><?= lang('order').' '.lang('complete');?>: <?= $order->complete??0;?></li>
						<li><?= lang('order').' '.lang('reject');?>: <?= $order->reject??0;?></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	
</div>

