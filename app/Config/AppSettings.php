<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class AppSettings extends BaseConfig
{

	// ------------------------------------------------------
	// Informações básicas
	// ------------------------------------------------------


	/*
		Estrutura da Pasta

			instituicoes
				documentacao
				eventos
					grupos
						participantes
						jurados
						coreografias
							musicas
		
	*/




	// ------------------------------------------------------
	// Não alterar estas funcoes abaixo
	// -----------------------------------------------------
	

	public $encryption_hashkey = '$2y$10$hqG1ZogNOo3OSlArQAdYIO1fV0hdAY9nH04fKB640/8AjKcwpWMo.';


	public function getGeneros()
	{
		$cfg_array = [
			'M' =>  ['value' => 'M', 'label' => 'Masculino'],
			'F' =>  ['value' => 'F', 'label' => 'Feminino'],
			'X'	=>  ['value' => 'X', 'label' => 'Prefiro não informar'],
			'T'	=>  ['value' => 'T', 'label' => 'Trans'],
		];
		return $cfg_array;
	}
	public function getFormaCobrancaTipo()
	{
		$cfg_array = [
			'monetaria' =>  ['value' => 'monetaria', 'label' => 'Monetária'],
			'doacao' =>  ['value' => 'doacao', 'label' => 'Doação'],
		];
		return $cfg_array;
	}
	public function getFormaCobranca()
	{
		$cfg_array = [
			'por_participante' =>  ['value' => 'por_participante', 'label' => 'Por participantes'],
			'por_coreografia' =>  ['value' => 'por_coreografia', 'label' => 'Por coreografias'],
			//'taxa_unica_participante' =>  ['value' => 'taxa_unica_participante', 'label' => 'Taxa única por participante'],
			//'doacao' =>  ['value' => 'doacao', 'label' => 'Doação'],
		];
		return $cfg_array;
	}

	public function getTipoCobranca()
	{
		$cfg_array = [
			'deposito_conta' =>  ['value' => 'deposito_conta', 'label' => 'Depósito em conta'],
			//'pix' =>  ['value' => 'por_participante', 'label' => 'Pix'],
			'mercado_pago' =>  ['value' => 'mercado_pago', 'label' => 'Mercado Pago'],
			'doacao' =>  ['value' => 'doacao', 'label' => 'Doação'],
		];
		return $cfg_array;
	}
	
	public function getDoacaoTipoEntrega()
	{
		$cfg_array = [
			'credenciamento' => 'Entrega da doação no credenciamento',
			'datas' => 'Prazo das entrega da doação',
		];
		return $cfg_array;
	}	

	public function getTipoCobrancaDoacoes()
	{
		$cfg_array = [
			"doacoes-por-participantes" => "Por Participantes",
			"doacoes-por-coreografias" => "Por Coreografias",
		];
		return $cfg_array;
	}


	public function getFormaCobrancaBilheteria()
	{
		$cfg_array = [
			'valor' =>  ['value' => 'valor', 'label' => 'Por Valores'],
			'doacao' =>  ['value' => 'doacao', 'label' => 'Por Doações'],
		];
		return $cfg_array;
	}


	public function getFieldsContrato()
	{
		$cfg_array = [
			'cad_nome' => 'Nome Completo',
			//'cad_nome_social' => 'Nome Social',
			'cad_email' => 'E-mail',
			'cad_documento' => 'CPF',
			'cad_dte_nascto' => 'Data de Nascimento',
			'cad_estado' => 'Estado',
			'cad_cidade' => 'Cidade',
			'partc_telefone' => 'Telefone',
			'gene_titulo' => 'Gênero',
			'func_titulo' => 'Função',
			'event_titulo' => 'Nome do Evento',
			'grp_titulo' => 'Nome do Grupo',
		];
		return $cfg_array;
	}


}
