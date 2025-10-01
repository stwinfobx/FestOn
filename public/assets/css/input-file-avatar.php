		
	<?php 
		$label_text = (isset($label_text) ? $label_text : '');	// 'input_file_value';
		$input_file_name = (isset($input_file_name) ? $input_file_name : '');
		$input_file_value = (isset($input_file_value) ? $input_file_value : '');
		$input_file_view = (isset($input_file_view) ? $input_file_view : '');

		$larg = 'width: 100%;';
		if( !empty($input_file_value) ){ $larg = 'width: calc(100% - 35px);'; }

		$mr_image_remove = (!empty($input_file_value) ? 'active' : '');
	?>
	<div class="form-group mb-3">
		<div class="mb-1 text-center">
			<label class="form-label"><?php echo( $label_text ); ?></label>
			<!-- <div class="form-label"><?php echo( $input_file_view ); ?></div> -->
		</div>
		<div class="boxAbsAvatar mr-image-input">
			<label for="<?php echo( $input_file_name ); ?>" style="display: block; width: 100%;">
			<div class="d-flex flex-column justify-content-center align-items-center">
				<?php if( !empty($input_file_value) ){ ?>
					<div class="bg-img-avatar full photo image-input-wrapper" style="background-image: url('<?php echo( $input_file_view ); ?>'); filter: grayscale(0);"></div>
				<?php }else{ ?>
					<div class="bg-img-avatar full photo image-input-wrapper" style="background-image: url('assets/media/icon-profile2.png'); filter: grayscale(1);"></div>
				<?php } ?>
				<!--
				<div v-else="">
					<div v-if="fields.grp_file_logotipo" class="bg-img-avatar full photo" v-bind:style="{ 'background-image': 'url('+ urlPost +'/renderimage/view_avatar/'+ fields.grp_file_logotipo + ')' }"></div>
					<div v-else="" class="bg-img-avatar full photo" style="background-image: url('assets/media/icon-profile2.png'); filter: grayscale(1);"></div>
				</div>
				-->
				<div class="d-none">
					<input type="file" class="mr-image-file" name="<?php echo( $input_file_name ); ?>" id="<?php echo( $input_file_name ); ?>" ref="<?php echo( $input_file_name ); ?>" />
				</div>
			</div>
			</label>
			<div class="mr-image-remove <?php echo( $mr_image_remove ); ?>">
				<a href="javascript:;" class="icon-avatar-delete" data-mr-image-input-action="remove"><i class="far fa-trash-alt"></i></a>
			</div>
		</div>
	</div>

	<!--
	<div class="form-group">
		<div class="">
			<label class="form-label"><?php echo( $label_text ); ?></label>
		</div>
		<div class="d-flex align-items-center">
			<label for="<?php echo( $input_file_name ); ?>" style="display: block; <?php echo( $larg ); ?>">
				<div class="d-flex align-items-center form-control" style="height: 100%;">
					<div style="border-right: 1.5px solid #000 !important; padding-right: 0.5rem !important;"><i class="fas fa-file-upload" style="color: #000;"></i></div>
					<div style="padding-left: 0.5rem !important; color: gray; overflow: hidden;">
						<?php if( !empty($input_file_value) ){ ?>
						<span style="text-wrap: nowrap; font-size: .85rem;" class="">
							<?php echo( $input_file_value ); ?>
						</span>
						<?php }else{ ?>
						<span style="text-wrap: nowrap; font-size: .85rem;" class="">
							Nenhum arquivo escolhido
						</span>
						<?php } ?>
					</div>
					<div class="d-none">
						<input type="file" name="<?php echo( $input_file_name ); ?>" id="<?php echo( $input_file_name ); ?>" ref="fileInputDocCPF" style="display: none;" />
					</div>
				</div>
			</label>
			<a href="javascript:;" class="icon-file-delete">
				<i class="far fa-trash-alt"></i>
			</a>
		</div>
	</div>
	-->
