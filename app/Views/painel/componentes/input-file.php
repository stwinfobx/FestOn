		
	<?php 
		$label_text = (isset($label_text) ? $label_text : '');	// 'input_file_value';
		$input_file_name = (isset($input_file_name) ? $input_file_name : '');
		$input_file_value = (isset($input_file_value) ? $input_file_value : '');

		//$box_input_file = (isset($box_input_file) ? $box_input_file : '');	
		//$input_file_remove = (isset($input_file_remove) ? $input_file_remove : '');	// 'file_logotipo_black_remove';
		//$input_file_edit = (isset($input_file_edit) ? $input_file_edit : '');		// 'file_logotipo_black_remove';
	
		$larg = 'width: 100%;';
		if( !empty($input_file_value) ){ $larg = 'width: calc(100% - 35px);'; }
	?>														

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
						<input type="file" name="<?php echo( $input_file_name ); ?>" id="<?php echo( $input_file_name ); ?>" ref="fileInputDocCPF" @change="pickFile($event, 'fileInputDocCPF', 'previewDocCPF', 'imageDocCPF', 'insti_file_doc_cpf')" style="display: none;" />
					</div>
				</div>
			</label>
			<a href="javascript:;" class="icon-file-delete">
				<i class="far fa-trash-alt"></i>
			</a>
		</div>
	</div>

