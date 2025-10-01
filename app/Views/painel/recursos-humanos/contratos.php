<?php 
	$this->extend('painel/templates/template_painel');
	$this->section('content'); 
?>

	<div class="box-breadcrumb">
		<div class="row">
			<div class="col-12">
				<h2 class="page-title">Recursos Humanos</h2>
			</div>
		</div>
	</div>

	<div id="app">
		<div class="row align-items-start">
			<div class="col-12 col-md-12">

				<div class="row align-items-start">
					<div class="col-12 col-md-12">

						<div class="card card-default">
							<div class="card-header-box">
								<div class="row align-items-center">
									<div class="col-12 col-md-6">
										<!-- <h4 class="card-title">Histórico</h4> -->
									</div>
									<div class="col-12 col-md-6">

										<div class="d-flex justify-content-end">
											<div style="margin-left: 5px;"><a href="<?php echo(painel_url('autorizacoes/form')); ?>" class="btn btn-sm btn-primary">Novo Registro</a></div>
										</div>

									</div>
								</div>
							</div>
							<div class="card-body" style="padding: 1rem 0;">

								<div class="box-content">
									<div class="row">
										<div class="col-3">
											<ul id="fields">
												<li>Evento</li>
												<li>Nome</li>
												<li>Email</li>
												<li>CPF</li>
												<li>Telefone</li>
											</ul>


											<div class="mt-5">
												<button id="getContentBtn">Obter Conteúdo</button>
											</div>
										</div>
										<div class="col-9">
											<div class="card card-template">
												<div class="card-body" style="padding: 1rem !important;">
													<div id="kt_docs_ckeditor_classic" class="kt_docs_tinymce_basic" contenteditable="true">
														<p>Nome: </p>
														<p>CPF: </p>
														<p>
															Este contrato é celebrado entre a Empresa ABC, doravante denominada Contratante, e o Sr. João Silva, doravante denominado Contratado. O presente contrato tem por objeto a prestação de serviços de consultoria em tecnologia da informação, conforme as condições estabelecidas a seguir.
														</p>

														<p>Nome: </p>

														<p>
															O Contratado se compromete a realizar todas as atividades descritas no escopo do projeto, que incluem, mas não se limitam a, análise de sistemas, desenvolvimento de software e suporte técnico. O Contratante se obriga a fornecer todas as informações e recursos necessários para a execução dos serviços.
														</p>
														<p>
															Este contrato terá vigência de 12 (doze) meses, a partir da data de sua assinatura, podendo ser renovado por igual período mediante acordo entre as partes. Em caso de descumprimento de qualquer cláusula, a parte prejudicada poderá rescindir o contrato, mediante notificação por escrito com antecedência mínima de 30 (trinta) dias.
														</p>
													</div>
												</div>
											</div>

											<div class="mt-5">
												<textarea id="contentHTML" class="form-control" rows="8"></textarea>
											</div>

											<div class="mt-5">
												<div id="contentVIEW"></div>
											</div>

											<div class="d-none">
														<p>Nome Nome </span>:&nbsp; Completo do Usuário&nbsp;</p>
														<p>CPF:&nbsp;&nbsp;<span class="highlight">CPF<span class="remove-btn"> x</span></span></p>
														<p>
															Este contrato é celebrado entre a Empresa ABC, doravante denominada Contratante, e o Sr. João Silva, doravante denominado Contratado. O presente contrato tem por objeto a prestação de serviços de consultoria em tecnologia da informação, conforme as condições estabelecidas a seguir.
														</p>

														<p>Evento:&nbsp;&nbsp;<span class="highlight">Evento<span class="remove-btn"> x</span></span></p>

														<p>
															O Contratado se compromete a realizar todas as atividades descritas no escopo do projeto, que incluem, mas não se limitam a, análise de sistemas, desenvolvimento de software e suporte técnico. O Contratante se obriga a fornecer todas as informações e recursos necessários para a execução dos serviços.
														</p>
														<p>
															Este contrato terá vigência de 12 (doze) meses, a partir da data de sua assinatura, podendo ser renovado por igual período mediante acordo entre as partes. Em caso de descumprimento de qualquer cláusula, a parte prejudicada poderá rescindir o contrato, mediante notificação por escrito com antecedência mínima de 30 (trinta) dias.
														</p>
											</div>


										</div>
									</div>
								</div>

							</div>
						</div>

					</div>
				</div>


			</div>
		</div>
	</div>



<?php
	$this->endSection('content'); 
?>

<?php $time = time(); ?>
<?php $this->section('headers'); ?>

	<style>
		.highlight {
			background-color: #cfcfcf;
			border: 1px solid #e4e4e4;
			padding: 3px 6px;
			border-radius: 4px;
			color: white;
			font-weight: normal;
			margin: 0 6px;
		}
		.remove-btn {
			cursor: pointer;
			color: black;
			font-weight: bold;
			margin-left: 5px;
		}
		#fields li {
			z-index: 999;
			cursor: move;
			margin-bottom: 5px;
			padding: 5px;
			border: 1px solid #000;
		}
		.box-content {
			padding: 20px;
		}
		.row {
			display: flex;
		}
		.col-3 {
			flex: 1;
		}
		.col-9 {
			flex: 3;
		}
	</style>

<?php $this->endSection('headers'); ?>

<?php $this->section('scripts'); ?>

	<link href="assets/plugins/DataTables/DataTables-1.13.4/css/jquery.dataTables.css" rel="stylesheet">
	<link href="assets/plugins/DataTables/DataTables-1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">

	<script src="assets/plugins/DataTables/DataTables-1.13.4/js/jquery.dataTables.js"></script>
	<script src="assets/plugins/DataTables/DataTables-1.13.4/js/dataTables.bootstrap5.min.js"></script>

	<!-- Sweet Alert -->
	<link href="assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
	<script src="assets/plugins/sweet-alert2/sweetalert2.min.js"></script>

	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
	
	
	<!-- <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script> -->

	<!-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->

	<!-- <script src="assets/plugins/tinymce/tinymce.bundle.js"></script> -->
	<!-- <script src="assets/js/tinymce/basic.js"></script> -->

	<!-- <script src="http://localhost/Poravo/metronic-admin-full-version-8.0.25/html/theme/demo11/dist/assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js"></script> -->
	<!-- <script src="http://localhost/Poravo/metronic-admin-full-version-8.0.25/html/theme/demo11/dist/assets/plugins/custom/ckeditor/ckeditor-inline.bundle.js"></script> -->
	<!-- <script src="http://localhost/Poravo/metronic-admin-full-version-8.0.25/html/theme/demo11/dist/assets/plugins/custom/ckeditor/ckeditor-document.bundle.js"></script> -->
	<!-- <script src="http://localhost/Poravo/metronic-admin-full-version-8.0.25/html/theme/demo11/dist/assets/js/custom/documentation/editors/ckeditor/classic.js"></script> -->

	<!-- <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" /> -->
	<!-- <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script> -->


	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/trumbowyg.min.js" integrity="sha512-YJgZG+6o3xSc0k5wv774GS+W1gx0vuSI/kr0E0UylL/Qg/noNspPtYwHPN9q6n59CTR/uhgXfjDXLTRI+uIryg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/trumbowyg.min.css"> -->
	

	<!-- https://jqueryte.com/demos -->


	<!-- https://xdsoft.net/jodit/ -->
	<!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jodit/4.2.27/jodit.min.css" /> -->
	<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jodit/4.2.27/jodit.min.js"></script> -->

	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/9000.0.1/prism.min.js"></script> -->
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/9000.0.1/themes/prism.min.css" /> -->


	<!-- https://alex-d.github.io/Trumbowyg/documentation/#installation -->
	<script src="assets/plugins/trumbowyg/dist/trumbowyg.min.js"></script>
	<link rel="stylesheet" href="assets/plugins/trumbowyg/dist/ui/trumbowyg.min.css">

	<script>
		//const editor = Jodit.make('#kt_docs_ckeditor_classic');

		$(function() {
			// Torna os itens da lista arrastáveis
			$("#fields li").draggable({
				helper: "clone"
			});

			// Torna o conteúdo dropável
			$("#kt_docs_ckeditor_classic").droppable({
				accept: "#fields li",
				drop: function(event, ui) {
					const droppedText = ui.helper.text();
					const range = getCaretRange();
					if (range) {
						highlightText(range, droppedText);
					}
				}
			});

			// Função para obter o intervalo de seleção do caret
			function getCaretRange() {
				const selection = window.getSelection();
				if (selection.rangeCount > 0) {
					return selection.getRangeAt(0);
				}
				return null;
			}

			// Função para adicionar o elemento de destaque
			function highlightText(range, text) {
				const span = document.createElement('span');
				span.classList.add('highlight');
				span.textContent = text;

				const removeBtn = document.createElement('span');
				removeBtn.textContent = ' x';
				removeBtn.classList.add('remove-btn');
				removeBtn.onclick = () => {
					span.remove();
				};

				span.appendChild(removeBtn);
				range.deleteContents();
				range.insertNode(span);
			}

			//$("#getContentBtn").click(function() {
			//	const contentHtml = $("#content").html();
			//	$("#contentHTML").val(contentHtml);
			//	//console.log(contentHtml); // Exibir no console
			//	//alert(contentHtml); // Exibir em um alerta
			//});
			
			$(document).on('click', '#getContentBtn', function () {
				//let contentHtml = $("#content").html();
				let contentHtml = $("#kt_docs_ckeditor_classic").html();
				$("#contentHTML").val(contentHtml);
				
				$("#contentVIEW").html(contentHtml);
			});
			
			$("#getContentBtn_old").click(function() {
				const contentHtml = $("#content").html();
				//const contentHtml = $("#kt_docs_ckeditor_classic").html();
				//const contentHtml = CKEDITOR.instances.kt_docs_ckeditor_classic.getData(); // ckEditor
				//const contentHtml = tinymce.get('content').getContent();
				$("#contentHTML").val(contentHtml);
				//console.log(contentHtml); // Exibir no console
				//alert(contentHtml); // Exibir em um alerta
			});

			// Inicializa o CKEditor no elemento #content
			//ClassicEditor.create(document.querySelector("#kt_docs_ckeditor_classic"));
			//InlineEditor.create(document.querySelector("#kt_docs_ckeditor_classic"));
			//DecoupledEditor.create(document.querySelector("#kt_docs_ckeditor_classic"));

			
			//CKEDITOR.replace('kt_docs_ckeditor_classic', {
			//	removeButtons: 'PasteFromWord'
			//});

			//const quill = new Quill('#kt_docs_ckeditor_classic', {
			//	theme: 'snow'
			//});

			$('#kt_docs_ckeditor_classic').trumbowyg();


			

			// Inicializa o TinyMCE no elemento #content
			//tinymce.init({
			//	selector: '#content',
			//	menubar: false,
			//	plugins: 'link code',
			//	toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | code',
			//	setup: function (editor) {
			//		editor.on('change', function () {
			//			editor.save();
			//		});
			//	}
			//});
		});
	</script>


	<script>
		//let LIST_PRODUTOS = [];
		//let LIST_STATUS = [];
	</script>

	<!-- VueJs -->
	<!-- <script src="assets/vue/vue.min.js"></script> -->
	<!-- <script src="assets/vue/axios.min.js"></script> -->
	<!-- <script src="assets/vue/carrinho.js"></script> -->


	<script>
		let LIST_CATEGORIA = [];
	</script>

	<script>
		//function converterData(data) {
		//	var partes = data.split("/");
		//	var dataFormatada = partes[2] + "-" + partes[1] + "-" + partes[0];
		//	return dataFormatada;
		//}

		//var dataBrasileira = "18/05/2023";
		//var dataAmericana = converterData(dataBrasileira);
		//console.log(dataAmericana); // Saída: 2023-05-18
		$(document).ready(function () {
			
			$(document).on('click', '.cmdFiltrar', function (e) {
				e.preventDefault();

				let $bsc_vendedor = $("#bsc_vendedor").val();
				let $bsc_cliente = $("#bsc_cliente").val();
				let $bsc_data_inicial = $("#bsc_data_inicial").val();
				let $bsc_data_final = $("#bsc_data_final").val();
				let $bsc_status = $("#bsc_status").val();

				let $url = '';
				if( $bsc_vendedor.length > 0 )	{ $url = $url +'/vendedor:'+ $bsc_vendedor; }
				if( $bsc_cliente.length > 0 )	{ $url = $url +'/cliente:'+ $bsc_cliente; }
				if( $bsc_data_inicial.length > 0 )	{ $url = $url +'/data_inicial:'+ ($bsc_data_inicial); }
				if( $bsc_data_final.length > 0 )	{ $url = $url +'/data_final:'+ ($bsc_data_final); }
				if( $bsc_status.length > 0 )	{ $url = $url +'/status:'+ $bsc_status; }

				//console.log( painel_url  +'historico/filtrar'+ $url );
				window.location.href = painel_url  +'historico/filtrar'+ $url;
				return false;
			});
			$(document).on('click', '.cmdUpdateStatus', function (e) {
				e.preventDefault();

				let $this = $(this);
				let $codigo = $this.data( "codigo" );
				let $msg = $( ".msg-email" );

				Swal.fire({
					title: 'Atenção!',
					icon: 'warning',
					html:
						'Confirme a alteração de status deste pedido.',
					type: 'warning',
					showCancelButton: true,
					cancelButtonColor: "#AAAAAA",
					confirmButtonColor: "#3c973e",
					//confirmButtonColor: '$danger',
					//cancelButtonColor: '$success',
					confirmButtonText: 'Sim! Confirmo.',
					cancelButtonText: 'Cancelar',
					reverseButtons: true
				}).then(function(result) {
					if (result.value) {
						// ------------------------------------------------------
						let $formData = {
							venda_id: $codigo
						};

						$msg.html('Aguarde. Estamos processando').show();
						$.ajax({
							url: painel_url  +'pedidos/ajaxform/ALTERAR-STATUS',
							method:"POST",
							type: "POST",
							dataType: "json",
							data: $formData,
							crossDomain: true,
							beforeSend: function(response) {
								console.log('1 beforeSend');
								console.log(response);
							},
							complete: function(response) { 
								//console.log('3 complete');
								//console.log(response);
							},
							success:function(response){
								console.log('2 success');
								console.log(response);
								$msg.html(response.error_msg).show();
							},
							error: function (jqXHR, textStatus, errorThrown) {
							}
						});
						// ------------------------------------------------------
					}
				});
			});
			$(document).on('click', '.cmdArquivarRegistro', function (e) {
				e.preventDefault();
				let $this = $(this);
				let $codigo = $this.data( "codigo" );
				let $row = $this.closest( ".trRow" );

				Swal.fire({
					title: 'Atenção!',
					icon: 'warning',
					html:
						'Confirme o arquivamento deste pedido.',
					type: 'warning',
					showCancelButton: true,
					cancelButtonColor: "#AAAAAA",
					confirmButtonColor: "#3c973e",
					//confirmButtonColor: '$danger',
					//cancelButtonColor: '$success',
					confirmButtonText: 'Sim! Confirmo.',
					cancelButtonText: 'Cancelar',
					reverseButtons: true
				}).then(function(result) {
					if (result.value) {
						// ------------------------------------------------------
						let $formData = {
							codigo: $codigo
						};

						$.ajax({
							url: painel_url  +'historico/ajaxform/ARQUIVAR-REGISTRO',
							method:"POST",
							type: "POST",
							dataType: "json",
							data: $formData,
							crossDomain: true,
							beforeSend: function(response) {
								console.log('1 beforeSend');
								console.log(response);
							},
							complete: function(response) { 
								console.log('3 complete');
								console.log(response);
							},
							success:function(response){
								console.log('2 success');
								console.log(response);
								$row.remove();
							},
							error: function (jqXHR, textStatus, errorThrown) {
								console.log('4 error');
								console.log(errorThrown);
							}
						});
						// ------------------------------------------------------
					}
				});
			});
			$(document).on('click', '.cmdExcluirRegistro', function (e) {
				e.preventDefault();
				let $this = $(this);
				let $hashkey = $this.data( "codigo" );
				let $row = $this.closest( ".trRow" );

				Swal.fire({
					title: 'Atenção!',
					icon: 'warning',
					html:
						'Você está prestes a excluir este registros. <br>'+
						'Esta ação não poderá ser revertida.<br>'+
						'Deseja continuar assim mesmo?',
					type: 'warning',
					showCancelButton: true,
					cancelButtonColor: "#AAAAAA",
					confirmButtonColor: "#3c973e",
					//confirmButtonColor: '$danger',
					//cancelButtonColor: '$success',
					confirmButtonText: 'Sim! Desejo Excluir',
					cancelButtonText: 'Cancelar',
					reverseButtons: true
				}).then(function(result) {
					if (result.value) {
						// ------------------------------------------------------
						let $formData = {
							autz_hashkey: $hashkey
						};

						$.ajax({
							url: painel_url  +'categorias/ajaxform/EXCLUIR-REGISTRO',
							method:"POST",
							type: "POST",
							dataType: "json",
							data: $formData,
							crossDomain: true,
							beforeSend: function(response) {
								console.log('1 beforeSend');
								console.log(response);
							},
							complete: function(response) { 
								console.log('3 complete');
								console.log(response);
							},
							success:function(response){
								console.log('2 success');
								console.log(response);
								$row.remove();
							},
							error: function (jqXHR, textStatus, errorThrown) {
								console.log('4 error');
								console.log(errorThrown);
							}
						});
						// ------------------------------------------------------
					}
				});
			});

			var table = $('#example2').DataTable({
				"pageLength": 100,
				order: [[ 0, "desc" ]],
				responsive: true,
				searching: false,
				paging: true,
				pagingType: "full_numbers",
				fixedHeader: {
					header: true,
					footer: false
				},
				"language": {
					"search": "Procurar",
					"lengthMenu": "Mostrar _MENU_ registro por página",
					"zeroRecords": "Nothing found - sorry",
					"info": "Monstrando _PAGE_ de _PAGES_",
					"infoEmpty": "Sem registros disponíveis",
					"infoFiltered": "(filtered from _MAX_ total records)",
					"oPaginate": {
						"sNext": "Próximo",
						"sPrevious": "Anterior",
						"sFirst": "Primeiro",
						"sLast": "Último"
					},
				}
			});
			//new $.fn.dataTable.FixedHeader( table );
		});
	</script>


<?php $this->endSection('scripts'); ?>