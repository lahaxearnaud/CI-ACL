<!DOCTYPE html><head>

<title>Droit</title>


<!-- Les fichiers css -->
<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" type="text/css" />

<!-- Les fichiers js -->
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>



<!-- pour les vieux navigateurs -->
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="html5shim.googlecode.com/svn/trunk/html5.js"></script>
	  <![endif]-->
	</head>
	<body id='body'>
		<div class="container">
			<h1>Les ACLs</h2>

				<?php 
				echo form_open('droit/addAction','class="form-inline"');

				$data = array(
					'name'        => 'nom',
					'id'          => 'nom',
					'maxlength'   => '100',
					'placeholder'=>'Nom de la route'
					);
				echo form_input($data);

				$data = array(
					'name'        => 'ctrl',
					'id'          => 'ctrl',
					'maxlength'   => '100',
					'placeholder'=>'Controleur'
					);
				echo form_input($data);

				$data = array(
					'name'        => 'ssctrl',
					'id'          => 'ssctrl',
					'maxlength'   => '100',
					'placeholder'=>'Fonction'
					);
					echo form_input($data);?>
					<input type="submit" name="submit" id="submit" value="Ajouter" class="btn btn-primary" />
					<?php
					echo form_close();
					?>
					<table class="table table-bordered table-condensed" style="background-color:white">
						<thead>
							<tr>
								<th>Droit</th>
								<?php foreach ($groups as $group) { ?>
								<th><?php echo $group->description; ?></th>
								<? } ?>
								<th>Public</th>
								<th>Supprimer</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($actions as $action) { ?>
							<tr>
								<td>
									<?php echo $action->description; ?><br/>
									<i><?php echo $action->path; ?></i>
								</td>
								<?php 
								foreach ($groups as $group) { ?>
								<td align="center">
									<?php 
									$check = false;
									if( isset($action->groups[$group->id]) ){
										$check = true;
									}
									$data = array(
										"value" => '1',
										"name" => 'droit',
										"data-group" => $group->id,
										"data-action" => $action->id,
										"class" => "droit",
										"checked"=>$check
										);
									echo form_checkbox($data);
									?>

								</td>
								<? } ?>
								<td>
									<?php
									$public = isset($action->groups[-1]);
									$data = array(
										"value" => '-1',
										"name" => 'droit',
										"data-action" => $action->id,
										"class" => "public",
										"checked"=>$public
										);
									echo form_checkbox($data);
									?>
								</td>
								<td>
									<?php echo form_open('droit/rmAction');
									echo form_hidden("id_action",$action->id);
									?>
									<button type="submit" name="submit" id="submit" onClick='return confirm("Supprimer la route ?")' class="btn btn-danger" >
										<i class="icon-trash"></i>
									</button>
									<?php
									echo form_close();
									?>
								</td>
							</tr>

							<?php } ?>
						</tbody>
					</table>

				</div>



				<script type="text/javascript">
				urlAjoutPerm = "<?php echo site_url('droit/addPerm');?>";
				urlRmPerm = "<?php echo site_url('droit/rmPerm');?>";
				$(function(){
					$(".droit").click(function(){
						url = urlRmPerm;
						if($(this).is(':checked')){
							url = urlAjoutPerm;
						}
						$.ajax({
							type: "POST",
							url: url,
							data: { 
								id_action :$(this).attr('data-action'),
								id_group:$(this).attr('data-group'),
							}
						});
					}); 


					$(".public").click(function(){
						url = urlRmPerm;
						if($(this).is(':checked')){
							url = urlAjoutPerm;
						}
						$.ajax({
							type: "POST",
							url: url,
							data: { 
								id_action :$(this).attr('data-action'),
								id_group:-1,
							}
						});
					}); 

				});

				</script>

			</body>
			</html>