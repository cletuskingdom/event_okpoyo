<?php require_once('../config.php'); ?>

<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
<?php require_once('inc/header.php') ?>

  	<body class="hold-transition layout-top-nav" >
		<div class="wrapper">
			<?php require_once('inc/topBarNav.php') ?>
			<?php 
				// $page = isset($_GET['page']) ? $_GET['page'] : 'home';  
			?>

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper" style="min-height: 567.854px;">
				<!-- Main content -->
				<div class="container main-container h-100">
					<?php 
						// if(!file_exists($page.".php") && !is_dir($page)){
						// 	include '404.html';
						// }else{
						// 	if(is_dir($page))
						// 		include $page.'/index.php';
						// 	else
						// 		include $page.'.php';
						// }
					?>
				</div>

				<div class="col-md-10 offset-md-1 pt-5">
					<div class="card card-outline card-primary">
						<div class="card-header">
							<div class="card-tools">
								<!-- <a class="btn btn-block btn-sm btn-default btn-flat border-primary new_audience" href="javascript:void(0)"><i class="fa fa-plus"></i> Add New</a> -->
								<button class="btn my-4 text-right btn-sm btn-default btn-flat border-primary new_audience"
									onclick="new_audience()">
									Register for an event
								</button>
							</div>
						</div>
						
						<div class="card-body">
							<table class="table tabe-hover table-bordered" id="list">
								<thead>
									<tr>
										<th class="text-center">#</th>
										<th>Event</th>
										<th>Name</th>
										<th>Details</th>
										<th>Remarks</th>
										<th>Action</th>
									</tr>
								</thead>

								<tbody>
									<?php
										$i = 1;
										$username = $_SESSION['userdata']['username'];
										$qry = $conn->query("SELECT * from event_audience INNER JOIN event_list on event_audience.event_id=event_list.id and event_audience.name='$username'");
										while($row = $qry->fetch_assoc()):
									?>
									<tr>
										<th class="text-center"><?php echo $i++ ?></th>
										<td><b><?php echo ucwords($row['title']) ?></b></td>
										<td><b><?php echo ucwords($row['name']) ?></b> <span><a href="javascript:void(0)" class="view_data" data-id="<?php echo $row['id'] ?>"><span class="fa fa-qrcode"></span></a></span></td>
										<td>
											<small><b>Email:</b> <?php echo $row['email'] ?></small><br>
											<small><b>Contact #:</b> <?php echo $row['contact'] ?></small>
										</td>
										<td><b><?php echo ($row['remarks']) ?></b></td>
										<td class="text-center">
											<div class="btn-group">
												<a href="javascript:void(0)" data-id='<?php echo $row['id'] ?>' class="btn btn-primary btn-flat manage_audience">
													<i class="fas fa-edit"></i>
												</a>

												<button type="button" class="btn btn-danger btn-flat delete_audience" data-id="<?php echo $row['id'] ?>">
													<i class="fas fa-trash"></i>
												</button>
											</div>
										</td>
									</tr>
									<?php endwhile; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- /.content -->

				<div class="modal fade" id="confirm_modal" role='dialog'>
					<div class="modal-dialog modal-md modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Confirmation</h5>
							</div>

							<div class="modal-body">
								<div id="delete_content"></div>
							</div>

							<div class="modal-footer">
								<button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>

				<div class="modal fade" id="uni_modal" role='dialog'>
					<div class="modal-dialog modal-md modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
							<h5 class="modal-title"></h5>
						</div>

						<div class="modal-body">
						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						</div>
					</div>
				</div>
			</div>

			<div class="modal fade" id="uni_modal_right" role='dialog'>
				<div class="modal-dialog modal-full-height  modal-md" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title"></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span class="fa fa-arrow-right"></span>
							</button>
						</div>
						<div class="modal-body">
						</div>
					</div>
				</div>
			</div>

			<div class="modal fade" id="viewer_modal" role='dialog'>
				<div class="modal-dialog modal-md" role="document">
					<div class="modal-content">
						<button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
						<img src="" alt="">
					</div>
				</div>
			</div>
		</div>

		<!-- /.content-wrapper -->
		<?php require_once('./inc/footer.php') ?>
		<script>
			$(document).ready(function(){
				$('.new_audience').click(function(){
					uni_modal("New Audience","./../admin/audience/manage.php");
				});

				$('.view_data').click(function(){
					uni_modal("QR", "./../admin/audience/view.php?id="+$(this).attr('data-id'));
				});

				$('.delete_audience').click(function(){
					_conf("Are you sure to delete this audience?","delete_audience",[$(this).attr('data-id')])
				})
				$('#list').dataTable();
			});
			function delete_audience($id){
				start_loader()
				$.ajax({
					url:_base_url_+'classes/Master.php?f=delete_audience',
					method:'POST',
					data:{id:$id},
					dataType:"json",
					error:err=>{
						alert_toast("An error occured");
						end_loader()
					},
					success:function(resp){
						if(resp.status=="success"){
							location.reload()
						}else{
							alert_toast("Deleting Data Failed");
						}
						end_loader()
					}
				})
			}
		</script>
		<?php if($_settings->chk_flashdata('success')): ?>
			<script>
				alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
			</script>
		<?php endif;?>
  	</body>
</html>
