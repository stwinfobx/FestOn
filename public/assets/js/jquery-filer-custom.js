$(document).ready(function(){

	//Example 2
	$("#filer_input2").filer({
		limit: null,
		maxSize: null,
		extensions: null,
		changeInput: '<div class="jFiler-input-dragDrop">\
			<div class="jFiler-input-inner jFiler-input-flex">\
				<div class="jFiler-input-item">\
					<div class="jFiler-input-icon" style="display:none !important;">\
						<i class="icon-jfi-cloud-up-o"></i>\
					</div>\
					<div class="jFiler-input-text">\
						<h3>Arraste e solte os arquivos aqui</h3>\
					</div>\
				</div>\
				<div class="jFiler-input-item">\
					<div class="jFiler-input-text">\
						<span style="display:inline-block; margin: 15px 0">ou</span>\
					</div>\
				</div>\
				<div class="jFiler-input-item">\
					<a class="jFiler-input-choose-btn blue">Selecionar os arquivos</a>\
				</div>\
			</div>\
		</div>',
		showThumbs: true,
		theme: "dragdropbox",
		templates: {
			box: '<div class="jFiler-items-list jFiler-items-grid grid-tile-wrapper"></div>',
			item: '<div class="jFiler-item grid-tile-item">\
						<div class="jFiler-item-container">\
							<div class="jFiler-item-inner">\
								<div class="jFiler-item-thumb">\
									<div class="jFiler-item-status"></div>\
									<div class="jFiler-item-thumb-overlay">\
										<div class="jFiler-item-info">\
											<div style="display:table-cell;vertical-align: middle;">\
												<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name}}</b></span>\
												<span class="jFiler-item-others">{{fi-size2}}</span>\
											</div>\
										</div>\
									</div>\
									{{fi-image}}\
								</div>\
								<div class="jFiler-item-assets jFiler-row">\
									<ul class="list-inline pull-left">\
										<li>{{fi-progressBar}}</li>\
									</ul>\
									<ul class="list-inline pull-right">\
										<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
									</ul>\
								</div>\
							</div>\
						</div>\
					</div>',
			itemAppend: '<div class="jFiler-item grid-tile-item">\
							<div class="jFiler-item-container">\
								<div class="jFiler-item-inner">\
									<div class="jFiler-item-thumb">\
										<div class="jFiler-item-status"></div>\
										<div class="jFiler-item-thumb-overlay">\
											<div class="jFiler-item-info">\
												<div style="display:table-cell;vertical-align: middle;">\
													<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name}}</b></span>\
													<span class="jFiler-item-others">{{fi-size2}}</span>\
												</div>\
											</div>\
										</div>\
										{{fi-image}}\
									</div>\
									<div class="jFiler-item-assets jFiler-row">\
										<ul class="list-inline pull-left">\
											<li><span class="jFiler-item-others">{{fi-icon}}</span></li>\
										</ul>\
										<ul class="list-inline pull-right">\
											<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
										</ul>\
									</div>\
								</div>\
							</div>\
						</div>',
			progressBar: '<div class="bar"></div>',
			itemAppendToEnd: false,
			canvasImage: true,
			removeConfirmation: true,
			_selectors: {
				list: '.jFiler-items-list',
				item: '.jFiler-item',
				progressBar: '.bar',
				remove: '.jFiler-item-trash-action'
			}
		},
		dragDrop: {
			dragEnter: null,
			dragLeave: null,
			drop: null,
			dragContainer: null,
		},
		//uploadFile: {
		//	url: "./php/ajax_upload_file.php",
		//	data: null,
		//	type: 'POST',
		//	enctype: 'multipart/form-data',
		//	synchron: true,
		//	beforeSend: function(){},
		//	success: function(data, itemEl, listEl, boxEl, newInputEl, inputEl, id){
		//		var parent = itemEl.find(".jFiler-jProgressBar").parent(),
		//			new_file_name = JSON.parse(data),
		//			filerKit = inputEl.prop("jFiler");

        //		filerKit.files_list[id].name = new_file_name;

		//		itemEl.find(".jFiler-jProgressBar").fadeOut("slow", function(){
		//			$("<div class=\"jFiler-item-others text-success\"><i class=\"icon-jfi-check-circle\"></i> Success</div>").hide().appendTo(parent).fadeIn("slow");
		//		});
		//	},
		//	error: function(el){
		//		var parent = el.find(".jFiler-jProgressBar").parent();
		//		el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
		//			$("<div class=\"jFiler-item-others text-error\"><i class=\"icon-jfi-minus-circle\"></i> Error</div>").hide().appendTo(parent).fadeIn("slow");
		//		});
		//	},
		//	statusCode: null,
		//	onProgress: null,
		//	onComplete: null
		//},
		files: null,
		addMore: true,
		allowDuplicates: true,
		clipBoardPaste: true,
		excludeName: null,
		beforeRender: null,
		afterRender: null,
		beforeShow: null,
		beforeSelect: null,
		onSelect: null,
		afterShow: null,
		onRemove: function(itemEl, file, id, listEl, boxEl, newInputEl, inputEl){




			var filerKit = inputEl.prop("jFiler");
		        //file_name = filerKit.files_list[id].name;

			var file_name = filerKit.files_list[id].file.name;
			console.log('file_name: ', file_name);

			//return false;


		    //$.post('./php/ajax_remove_file.php', {file: file_name});
		},
		onEmpty: null,
		options: null,
		dialogs: {
			alert: function(text) {
				return alert(text);
			},
			confirm: function (text, callback) {

				Swal.fire({
					title: 'Atenção!',
					icon: 'warning',
					html:
						'Você está prestes a excluir este registro. <br />' +
						'Esta ação não poderá ser revertida.',
					showCancelButton: true,
					cancelButtonColor: "#AAAAAA",
					confirmButtonColor: "#E96565",
					//confirmButtonColor: '$danger',
					//cancelButtonColor: '$success',
					confirmButtonText: 'Apagar',
					cancelButtonText: 'Cancelar',
					reverseButtons: true
				}).then(function(result) {
					if (result.value) {
						// ------------------------------------------------------
						callback();
						// ------------------------------------------------------
					}
				});

				
				
				//let cfmParam = { texto: text };
				//let rt = fct_confirmacao( cfmParam );
				//console.log( rt );

				//var filerKit = inputEl.prop("jFiler"),
				//	file_name = filerKit.files_list[id].name;

				//console.log('file_name', file_name);

				
				//confirm(text) ? callback() : null;
			}
		},
		captions: {
			button: "Escolha os arquivos",
			feedback: "Escolha os arquivos para Upload",
			feedback2: "arquivos selecionados",
			drop: "Solte os arquivos para Upload",
			removeConfirmation: "Tem certeza que deseja remover este arquivo?",
			errors: {
				filesLimit: "Only {{fi-limit}} files are allowed to be uploaded.",
				filesType: "Only Images are allowed to be uploaded.",
				filesSize: "{{fi-name}} is too large! Please upload file up to {{fi-maxSize}} MB.",
				filesSizeAll: "Files you've choosed are too large! Please upload files up to {{fi-maxSize}} MB."
			}
		}
	});


	// Exemplo de Arquivo Musica
	$("#filer_input_unico").filer({
		limit: 1,
		maxSize: null,
		extensions: null,
		changeInput: '<div class="jFiler-input-dragDrop fileUnico ">\
			<div class="jFiler-input-inner jFiler-input-flex">\
				<div class="jFiler-input-item">\
					<div class="jFiler-input-icon" style="display:none !important;">\
						<i class="icon-jfi-cloud-up-o"></i>\
					</div>\
					<div class="jFiler-input-text">\
						<h3>Arraste e solte o arquivo aqui</h3>\
					</div>\
				</div>\
				<div class="jFiler-input-item">\
					<div class="jFiler-input-text">\
						<span style="display:inline-block; margin: 15px 0">ou</span>\
					</div>\
				</div>\
				<div class="jFiler-input-item">\
					<a class="jFiler-input-choose-btn blue">Selecione o arquivo</a>\
				</div>\
			</div>\
		</div>',
		showThumbs: true,
		theme: "dragdropbox",
		templates: {
			box: '<div class="jFiler-items-list jFiler-items-grid grid-tile-wrapper fileUnico"></div>',
			item: '<div class="jFiler-item grid-tile-item">\
						<div class="jFiler-item-container">\
							<div class="jFiler-item-inner">\
								<div class="jFiler-item-thumb">\
									<div class="jFiler-item-status"></div>\
									<div class="jFiler-item-thumb-overlay">\
										<div class="jFiler-item-info">\
											<div style="display:table-cell;vertical-align: middle;">\
												<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name}}</b></span>\
												<span class="jFiler-item-others">{{fi-size2}}</span>\
											</div>\
										</div>\
									</div>\
									{{fi-image}}\
								</div>\
								<div class="jFiler-item-assets jFiler-row">\
									<div class="tempo_da_musica"></div>\
									<ul class="list-inline pull-left">\
										<li>{{fi-progressBar}}</li>\
									</ul>\
									<ul class="list-inline pull-right">\
										<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
									</ul>\
								</div>\
							</div>\
						</div>\
					</div>',
			itemAppend: '<div class="jFiler-item grid-tile-item">\
							<div class="jFiler-item-container">\
								<div class="jFiler-item-inner">\
									<div class="jFiler-item-thumb">\
										<div class="jFiler-item-status"></div>\
										<div class="jFiler-item-thumb-overlay">\
											<div class="jFiler-item-info">\
												<div style="display:table-cell;vertical-align: middle;">\
													<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name}}</b></span>\
													<span class="jFiler-item-others">{{fi-size2}}</span>\
												</div>\
											</div>\
										</div>\
										{{fi-image}}\
									</div>\
									<div class="jFiler-item-assets jFiler-row">\
										<ul class="list-inline pull-left">\
											<li><span class="jFiler-item-others">{{fi-icon}}</span></li>\
										</ul>\
										<ul class="list-inline pull-right">\
											<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
										</ul>\
									</div>\
								</div>\
							</div>\
						</div>',
			progressBar: '<div class="bar"></div>',
			itemAppendToEnd: false,
			canvasImage: true,
			removeConfirmation: true,
			_selectors: {
				list: '.jFiler-items-list',
				item: '.jFiler-item',
				progressBar: '.bar',
				remove: '.jFiler-item-trash-action'
			}
		},
		dragDrop: {
			dragEnter: null,
			dragLeave: null,
			drop: null,
			dragContainer: null,
		},
		//uploadFile: {
		//	url: "./php/ajax_upload_file.php",
		//	data: null,
		//	type: 'POST',
		//	enctype: 'multipart/form-data',
		//	synchron: true,
		//	beforeSend: function(){},
		//	success: function(data, itemEl, listEl, boxEl, newInputEl, inputEl, id){
		//		var parent = itemEl.find(".jFiler-jProgressBar").parent(),
		//			new_file_name = JSON.parse(data),
		//			filerKit = inputEl.prop("jFiler");

        //		filerKit.files_list[id].name = new_file_name;

		//		itemEl.find(".jFiler-jProgressBar").fadeOut("slow", function(){
		//			$("<div class=\"jFiler-item-others text-success\"><i class=\"icon-jfi-check-circle\"></i> Success</div>").hide().appendTo(parent).fadeIn("slow");
		//		});
		//	},
		//	error: function(el){
		//		var parent = el.find(".jFiler-jProgressBar").parent();
		//		el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
		//			$("<div class=\"jFiler-item-others text-error\"><i class=\"icon-jfi-minus-circle\"></i> Error</div>").hide().appendTo(parent).fadeIn("slow");
		//		});
		//	},
		//	statusCode: null,
		//	onProgress: null,
		//	onComplete: null
		//},
		files: null,
		addMore: false,
		allowDuplicates: true,
		clipBoardPaste: true,
		excludeName: null,
		beforeRender: null,
		afterRender: null,
		beforeShow: null,
		beforeSelect: function(itemEl, f_l, f_p, f_o, f_s){
			//var filerKit = inputEl.prop("jFiler");
			//file_name = filerKit.files_list[id].name;
			//console.log( f_l );
			//console.log( f_p );
			//console.log( f_o );
			var tempoTotal = 0;

			//console.log('length:', itemEl.length );
			var quantidadeDeArquivos = itemEl.length;
			for (var i = 0; i < quantidadeDeArquivos; i++) {
				var esteArquivo = itemEl[i];
				fileB = URL.createObjectURL(esteArquivo);
				var audioElement2 = new Audio(fileB);
				audioElement2.setAttribute('src', fileB);
				audioElement2.onloadedmetadata = function(e) {
					tempoTotal = tempoTotal + parseInt(this.duration);
					//$("#musicas").html("Músicas Carregadas: " + quantidadeDeArquivos + " (Tempo Total: " + converterParaMinutosESegundos(tempoTotal) + ")");
					$("#tempo_musica").val(converterParaMinutosESegundos(tempoTotal));
					//alert("loadedmetadata" + tempoTotal);
					//console.log( converterParaMinutosESegundos(tempoTotal) );
				}
			}

			f_o.hide();
			//console.log( f_s );

			//var quantidadeDeArquivos = this.files.length;
			//for (var i = 0; i < quantidadeDeArquivos; i++) {
			//	var esteArquivo = this.files[i];
			//	fileB = URL.createObjectURL(esteArquivo);

			//	var audioElement2 = new Audio(fileB);
			//	audioElement2.setAttribute('src', fileB);
			//	audioElement2.onloadedmetadata = function(e) {
			//		tempoTotal = tempoTotal + parseInt(this.duration);
			//		//$("#musicas").html("Músicas Carregadas: " + quantidadeDeArquivos + " (Tempo Total: " + converterParaMinutosESegundos(tempoTotal) + ")");
			//		$("#musicas").html("Tempo: " + converterParaMinutosESegundos(tempoTotal));
			//	//alert("loadedmetadata" + tempoTotal);
			//	}
			//}
			//tempoTotal = 0;



			return true
		},
		onSelect: null,
		//onSelect: function(itemEl, f_i, f_l, f_p, f_o, f_s){
		//	//f.files[i], f._itFc.html, l, p, o, s

		//	console.log('length:', itemEl.length );
		//},
		afterShow: null,
		onRemove: function(itemEl, file, id, listEl, boxEl, newInputEl, inputEl){

			var filerKit = inputEl.prop("jFiler");
		        //file_name = filerKit.files_list[id].name;

			var file_name = filerKit.files_list[id].file.name;
			console.log('file_name: ', file_name);

			boxEl.find('.jFiler-input-dragDrop').show();
			
			console.log( id );
			console.log( listEl );
			console.log( boxEl );

			//return false;
		    //$.post('./php/ajax_remove_file.php', {file: file_name});
		},
		onEmpty: null,
		options: null,
		dialogs: {
			alert: function(text) {
				return alert(text);
			},
			confirm: function (text, callback) {

				Swal.fire({
					title: 'Atenção!',
					icon: 'warning',
					html:
						'Você está prestes a excluir este registro. <br />' +
						'Esta ação não poderá ser revertida.',
					showCancelButton: true,
					cancelButtonColor: "#AAAAAA",
					confirmButtonColor: "#E96565",
					//confirmButtonColor: '$danger',
					//cancelButtonColor: '$success',
					confirmButtonText: 'Apagar',
					cancelButtonText: 'Cancelar',
					reverseButtons: true
				}).then(function(result) {
					if (result.value) {
						
						// ------------------------------------------------------
						callback();
						// ------------------------------------------------------
					}
				});

				
				
				//let cfmParam = { texto: text };
				//let rt = fct_confirmacao( cfmParam );
				//console.log( rt );

				//var filerKit = inputEl.prop("jFiler"),
				//	file_name = filerKit.files_list[id].name;

				//console.log('file_name', file_name);

				
				//confirm(text) ? callback() : null;
			}
		},
		captions: {
			button: "Escolha o arquivo",
			feedback: "Escolha o arquivo para Upload",
			feedback2: "arquivo selecionado",
			drop: "Solte os arquivo para Upload",
			removeConfirmation: "Tem certeza que deseja remover este arquivo?",
			errors: {
				filesLimit: "Only {{fi-limit}} files are allowed to be uploaded.",
				filesType: "Only Images are allowed to be uploaded.",
				filesSize: "{{fi-name}} is too large! Please upload file up to {{fi-maxSize}} MB.",
				filesSizeAll: "Files you've choosed are too large! Please upload files up to {{fi-maxSize}} MB."
			}
		}
	});



	// Exemplo de Arquivo Single Photo
	$("#filer_input_photos_single").filer({
		limit: 1,
		maxSize: null,
		extensions: null,
		changeInput: '<div class="jFiler-input-dragDrop fileUnico ">\
			<div class="jFiler-input-inner jFiler-input-flex">\
				<div class="jFiler-input-item">\
					<div class="jFiler-input-icon" style="display:none !important;">\
						<i class="icon-jfi-cloud-up-o"></i>\
					</div>\
					<div class="jFiler-input-text">\
						<h3>Arraste e solte <br>o arquivo aqui</h3>\
					</div>\
				</div>\
				<div class="jFiler-input-item">\
					<div class="jFiler-input-text">\
						<span style="display:inline-block; margin: 15px 0">ou</span>\
					</div>\
				</div>\
				<div class="jFiler-input-item">\
					<a class="jFiler-input-choose-btn blue">Selecione o arquivo</a>\
				</div>\
			</div>\
		</div>',
		showThumbs: true,
		theme: "dragdropbox",
		templates: {
			box: '<div class="jFiler-items-list jFiler-items-grid grid-tile-wrapper fileUnico"></div>',
			item: '<div class="jFiler-item grid-tile-item">\
						<div class="jFiler-item-container">\
							<div class="jFiler-item-inner">\
								<div class="jFiler-item-thumb">\
									<div class="jFiler-item-status"></div>\
									<div class="jFiler-item-thumb-overlay">\
										<div class="jFiler-item-info">\
											<div style="display:table-cell;vertical-align: middle;">\
												<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name}}</b></span>\
												<span class="jFiler-item-others">{{fi-size2}}</span>\
											</div>\
										</div>\
									</div>\
									{{fi-image}}\
								</div>\
								<div class="jFiler-item-assets jFiler-row">\
									<ul class="list-inline pull-left">\
										<li>{{fi-progressBar}}</li>\
									</ul>\
									<ul class="list-inline pull-right">\
										<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
									</ul>\
								</div>\
							</div>\
						</div>\
					</div>',
			itemAppend: '<div class="jFiler-item grid-tile-item">\
							<div class="jFiler-item-container">\
								<div class="jFiler-item-inner">\
									<div class="jFiler-item-thumb">\
										<div class="jFiler-item-status"></div>\
										<div class="jFiler-item-thumb-overlay">\
											<div class="jFiler-item-info">\
												<div style="display:table-cell;vertical-align: middle;">\
													<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name}}</b></span>\
													<span class="jFiler-item-others">{{fi-size2}}</span>\
												</div>\
											</div>\
										</div>\
										{{fi-image}}\
									</div>\
									<div class="jFiler-item-assets jFiler-row">\
										<ul class="list-inline pull-left">\
											<li><span class="jFiler-item-others">{{fi-icon}}</span></li>\
										</ul>\
										<ul class="list-inline pull-right">\
											<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
										</ul>\
									</div>\
								</div>\
							</div>\
						</div>',
			progressBar: '<div class="bar"></div>',
			itemAppendToEnd: false,
			canvasImage: true,
			removeConfirmation: true,
			_selectors: {
				list: '.jFiler-items-list',
				item: '.jFiler-item',
				progressBar: '.bar',
				remove: '.jFiler-item-trash-action'
			}
		},
		dragDrop: {
			dragEnter: null,
			dragLeave: null,
			drop: null,
			dragContainer: null,
		},
		//uploadFile: {
		//	url: "./php/ajax_upload_file.php",
		//	data: null,
		//	type: 'POST',
		//	enctype: 'multipart/form-data',
		//	synchron: true,
		//	beforeSend: function(){},
		//	success: function(data, itemEl, listEl, boxEl, newInputEl, inputEl, id){
		//		var parent = itemEl.find(".jFiler-jProgressBar").parent(),
		//			new_file_name = JSON.parse(data),
		//			filerKit = inputEl.prop("jFiler");

        //		filerKit.files_list[id].name = new_file_name;

		//		itemEl.find(".jFiler-jProgressBar").fadeOut("slow", function(){
		//			$("<div class=\"jFiler-item-others text-success\"><i class=\"icon-jfi-check-circle\"></i> Success</div>").hide().appendTo(parent).fadeIn("slow");
		//		});
		//	},
		//	error: function(el){
		//		var parent = el.find(".jFiler-jProgressBar").parent();
		//		el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
		//			$("<div class=\"jFiler-item-others text-error\"><i class=\"icon-jfi-minus-circle\"></i> Error</div>").hide().appendTo(parent).fadeIn("slow");
		//		});
		//	},
		//	statusCode: null,
		//	onProgress: null,
		//	onComplete: null
		//},
		files: null,
		addMore: false,
		allowDuplicates: true,
		clipBoardPaste: true,
		excludeName: null,
		beforeRender: null,
		afterRender: null,
		beforeShow: null,
		beforeSelect: function(itemEl, f_l, f_p, f_o, f_s){
			//var filerKit = inputEl.prop("jFiler");
			//file_name = filerKit.files_list[id].name;
			//console.log( f_l );
			//console.log( f_p );
			//console.log( f_o );
			f_o.hide();
			//console.log( f_s );

			return true
		},
		onSelect: null,
		//onSelect: function(itemEl, f_i, f_l, f_p, f_o, f_s){
		//	//f.files[i], f._itFc.html, l, p, o, s

		//	console.log('length:', itemEl.length );
		//},
		afterShow: null,
		onRemove: function(itemEl, file, id, listEl, boxEl, newInputEl, inputEl){

			var filerKit = inputEl.prop("jFiler");
		        //file_name = filerKit.files_list[id].name;

			var file_name = filerKit.files_list[id].file.name;
			console.log('file_name: ', file_name);

			boxEl.find('.jFiler-input-dragDrop').show();
			
			console.log( id );
			console.log( listEl );
			console.log( boxEl );

			//return false;
		    //$.post('./php/ajax_remove_file.php', {file: file_name});
		},
		onEmpty: null,
		options: null,
		dialogs: {
			alert: function(text) {
				return alert(text);
			},
			confirm: function (text, callback) {

				Swal.fire({
					title: 'Atenção!',
					icon: 'warning',
					html:
						'Você está prestes a excluir este registro. <br />' +
						'Esta ação não poderá ser revertida.',
					showCancelButton: true,
					cancelButtonColor: "#AAAAAA",
					confirmButtonColor: "#E96565",
					//confirmButtonColor: '$danger',
					//cancelButtonColor: '$success',
					confirmButtonText: 'Apagar',
					cancelButtonText: 'Cancelar',
					reverseButtons: true
				}).then(function(result) {
					if (result.value) {
						
						// ------------------------------------------------------
						callback();
						// ------------------------------------------------------
					}
				});

				
				
				//let cfmParam = { texto: text };
				//let rt = fct_confirmacao( cfmParam );
				//console.log( rt );

				//var filerKit = inputEl.prop("jFiler"),
				//	file_name = filerKit.files_list[id].name;

				//console.log('file_name', file_name);

				
				//confirm(text) ? callback() : null;
			}
		},
		captions: {
			button: "Escolha o arquivo",
			feedback: "Escolha o arquivo para Upload",
			feedback2: "arquivo selecionado",
			drop: "Solte os arquivo para Upload",
			removeConfirmation: "Tem certeza que deseja remover este arquivo?",
			errors: {
				filesLimit: "Only {{fi-limit}} files are allowed to be uploaded.",
				filesType: "Only Images are allowed to be uploaded.",
				filesSize: "{{fi-name}} is too large! Please upload file up to {{fi-maxSize}} MB.",
				filesSizeAll: "Files you've choosed are too large! Please upload files up to {{fi-maxSize}} MB."
			}
		}
	});


	// Exemplo de Arquivo Single Photo
	$(".filer_input_photos_single").filer({
		limit: 1,
		maxSize: null,
		extensions: null,
		changeInput: '<div class="jFiler-input-dragDrop fileUnico ">\
			<div class="jFiler-input-inner jFiler-input-flex">\
				<div class="jFiler-input-item">\
					<div class="jFiler-input-icon" style="display:none !important;">\
						<i class="icon-jfi-cloud-up-o"></i>\
					</div>\
					<div class="jFiler-input-text">\
						<h3>Arraste e solte <br>o arquivo aqui</h3>\
					</div>\
				</div>\
				<div class="jFiler-input-item">\
					<div class="jFiler-input-text">\
						<span style="display:inline-block; margin: 15px 0">ou</span>\
					</div>\
				</div>\
				<div class="jFiler-input-item">\
					<a class="jFiler-input-choose-btn blue">Selecione o arquivo</a>\
				</div>\
			</div>\
		</div>',
		showThumbs: true,
		theme: "dragdropbox",
		templates: {
			box: '<div class="jFiler-items-list jFiler-items-grid grid-tile-wrapper fileUnico"></div>',
			item: '<div class="jFiler-item grid-tile-item">\
						<div class="jFiler-item-container">\
							<div class="jFiler-item-inner">\
								<div class="jFiler-item-thumb">\
									<div class="jFiler-item-status"></div>\
									<div class="jFiler-item-thumb-overlay">\
										<div class="jFiler-item-info">\
											<div style="display:table-cell;vertical-align: middle;">\
												<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name}}</b></span>\
												<span class="jFiler-item-others">{{fi-size2}}</span>\
											</div>\
										</div>\
									</div>\
									{{fi-image}}\
								</div>\
								<div class="jFiler-item-assets jFiler-row">\
									<ul class="list-inline pull-left">\
										<li>{{fi-progressBar}}</li>\
									</ul>\
									<ul class="list-inline pull-right">\
										<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
									</ul>\
								</div>\
							</div>\
						</div>\
					</div>',
			itemAppend: '<div class="jFiler-item grid-tile-item">\
							<div class="jFiler-item-container">\
								<div class="jFiler-item-inner">\
									<div class="jFiler-item-thumb">\
										<div class="jFiler-item-status"></div>\
										<div class="jFiler-item-thumb-overlay">\
											<div class="jFiler-item-info">\
												<div style="display:table-cell;vertical-align: middle;">\
													<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name}}</b></span>\
													<span class="jFiler-item-others">{{fi-size2}}</span>\
												</div>\
											</div>\
										</div>\
										{{fi-image}}\
									</div>\
									<div class="jFiler-item-assets jFiler-row">\
										<ul class="list-inline pull-left">\
											<li><span class="jFiler-item-others">{{fi-icon}}</span></li>\
										</ul>\
										<ul class="list-inline pull-right">\
											<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
										</ul>\
									</div>\
								</div>\
							</div>\
						</div>',
			progressBar: '<div class="bar"></div>',
			itemAppendToEnd: false,
			canvasImage: true,
			removeConfirmation: true,
			_selectors: {
				list: '.jFiler-items-list',
				item: '.jFiler-item',
				progressBar: '.bar',
				remove: '.jFiler-item-trash-action'
			}
		},
		dragDrop: {
			dragEnter: null,
			dragLeave: null,
			drop: null,
			dragContainer: null,
		},
		//uploadFile: {
		//	url: "./php/ajax_upload_file.php",
		//	data: null,
		//	type: 'POST',
		//	enctype: 'multipart/form-data',
		//	synchron: true,
		//	beforeSend: function(){},
		//	success: function(data, itemEl, listEl, boxEl, newInputEl, inputEl, id){
		//		var parent = itemEl.find(".jFiler-jProgressBar").parent(),
		//			new_file_name = JSON.parse(data),
		//			filerKit = inputEl.prop("jFiler");

        //		filerKit.files_list[id].name = new_file_name;

		//		itemEl.find(".jFiler-jProgressBar").fadeOut("slow", function(){
		//			$("<div class=\"jFiler-item-others text-success\"><i class=\"icon-jfi-check-circle\"></i> Success</div>").hide().appendTo(parent).fadeIn("slow");
		//		});
		//	},
		//	error: function(el){
		//		var parent = el.find(".jFiler-jProgressBar").parent();
		//		el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
		//			$("<div class=\"jFiler-item-others text-error\"><i class=\"icon-jfi-minus-circle\"></i> Error</div>").hide().appendTo(parent).fadeIn("slow");
		//		});
		//	},
		//	statusCode: null,
		//	onProgress: null,
		//	onComplete: null
		//},
		files: null,
		addMore: false,
		allowDuplicates: true,
		clipBoardPaste: true,
		excludeName: null,
		beforeRender: null,
		afterRender: null,
		beforeShow: null,
		beforeSelect: function(itemEl, f_l, f_p, f_o, f_s){
			//var filerKit = inputEl.prop("jFiler");
			//file_name = filerKit.files_list[id].name;
			//console.log( f_l );
			//console.log( f_p );
			//console.log( f_o );
			f_o.hide();
			//console.log( f_s );

			return true
		},
		onSelect: null,
		//onSelect: function(itemEl, f_i, f_l, f_p, f_o, f_s){
		//	//f.files[i], f._itFc.html, l, p, o, s

		//	console.log('length:', itemEl.length );
		//},
		afterShow: null,
		onRemove: function(itemEl, file, id, listEl, boxEl, newInputEl, inputEl){

			var filerKit = inputEl.prop("jFiler");
		        //file_name = filerKit.files_list[id].name;

			var file_name = filerKit.files_list[id].file.name;
			console.log('file_name: ', file_name);

			boxEl.find('.jFiler-input-dragDrop').show();
			
			console.log( id );
			console.log( listEl );
			console.log( boxEl );

			//return false;
		    //$.post('./php/ajax_remove_file.php', {file: file_name});
		},
		onEmpty: null,
		options: null,
		dialogs: {
			alert: function(text) {
				return alert(text);
			},
			confirm: function (text, callback) {

				Swal.fire({
					title: 'Atenção!',
					icon: 'warning',
					html:
						'Você está prestes a excluir este registro. <br />' +
						'Esta ação não poderá ser revertida.',
					showCancelButton: true,
					cancelButtonColor: "#AAAAAA",
					confirmButtonColor: "#E96565",
					//confirmButtonColor: '$danger',
					//cancelButtonColor: '$success',
					confirmButtonText: 'Apagar',
					cancelButtonText: 'Cancelar',
					reverseButtons: true
				}).then(function(result) {
					if (result.value) {
						
						// ------------------------------------------------------
						callback();
						// ------------------------------------------------------
					}
				});

				
				
				//let cfmParam = { texto: text };
				//let rt = fct_confirmacao( cfmParam );
				//console.log( rt );

				//var filerKit = inputEl.prop("jFiler"),
				//	file_name = filerKit.files_list[id].name;

				//console.log('file_name', file_name);

				
				//confirm(text) ? callback() : null;
			}
		},
		captions: {
			button: "Escolha o arquivo",
			feedback: "Escolha o arquivo para Upload",
			feedback2: "arquivo selecionado",
			drop: "Solte os arquivo para Upload",
			removeConfirmation: "Tem certeza que deseja remover este arquivo?",
			errors: {
				filesLimit: "Only {{fi-limit}} files are allowed to be uploaded.",
				filesType: "Only Images are allowed to be uploaded.",
				filesSize: "{{fi-name}} is too large! Please upload file up to {{fi-maxSize}} MB.",
				filesSizeAll: "Files you've choosed are too large! Please upload files up to {{fi-maxSize}} MB."
			}
		}
	});


})
