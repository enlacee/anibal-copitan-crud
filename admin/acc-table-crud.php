<?php

class Acc_Table_Crud {

	private $name;

	private static $instance;

	public static function getInstance()
	{
		 if (!isset(self::$instance)) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	* construct
	*/
	public function __construct()
	{
		global $wpdb;
		$this->name = $wpdb->prefix . 'anibal_copitan_crud';
	}

	public function getName()
	{
		return $this->name;
	}

	/**
	* Crear tabla
	* return Void
	*/
	public function install()
	{
		global $wpdb;

		$charset_collate = $wpdb->get_charset_collate();
		$sql = "CREATE TABLE {$this->getName()} (
			id bigint(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
			nombre varchar(50) DEFAULT NULL,
			apellido varchar(50) DEFAULT NULL,
			sexo int(1) DEFAULT 1 NOT NULL,
			create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
			create_update datetime DEFAULT '0000-00-00 00:00:00' NOT NULL
		) $charset_collate;";

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
	}

	/*
	* return void
	*/
	public function uninstall()
	{
		global $wpdb;
		$wpdb->query("DROP TABLE {$this->getName()}");
	}

	/*
	* Agregar registros de prueba
	* return void
	*/
	public function install_data()
	{
		global $wpdb;

		$wpdb->insert($this->getName(), array(
				'nombre' => 'Pepe Lucho',
				'apellido' => 'Rios Solis',
				'sexo' => '1'
			)
		);
		$wpdb->insert($this->getName(), array(
				'nombre' => 'Juana Rosa',
				'apellido' => 'Gonzales Rollals',
				'sexo' => '0'
			)
		);
		$wpdb->insert($this->getName(), array(
				'nombre' => 'Pedro Joel',
				'apellido' => 'Jara Rosales',
				'sexo' => '1'
			)
		);
		$wpdb->insert($this->getName(), array(
				'nombre' => 'Laura Flor',
				'apellido' => 'Duna Manciapo',
				'sexo' => '0'
			)
		);
		$wpdb->insert($this->getName(), array(
				'nombre' => 'Carlos',
				'apellido' => 'Panto Dalas',
				'sexo' => '1'
			)
		);
	}

	/**
	* Registrar
	* @param Int|False
	*/
	public function insert($items)
	{
		global $wpdb;
		$table = $this->getName();
		$rs = false;

		$rs = $wpdb->insert(
			$table,
			array(
				'nombre'	=> $items['nombre'],
				'apellido'	=> $items['apellido'],
				'sexo'		=> $items['sexo']
			),
			array('%s', '%s', '%s')
		);

		return $rs;
	}

	/**
	* Registrar
	* @param Int|False
	*/
	public function update($items)
	{
		global $wpdb;
		$table = $this->getName();
		$rs = false;

		$rs = $wpdb->update(
			$table,
			array(
				'nombre'	=> $items['nombre'],
				'apellido'	=> $items['apellido'],
				'sexo'		=> $items['sexo']
			),
			array('id' => $items['id'])
		);

		return $rs;
	}

	/**
	* Registrar
	* @param Int|False
	*/
	public function delete($id)
	{
		global $wpdb;
		$table = $this->getName();
		$rs = false;

		$rs = $wpdb->delete($table, array('id' => $id));

		return $rs;
	}

	/**
	* Registrar
	* @param Int|False
	*/
	public function getAll()
	{
		global $wpdb;
		$table = $this->getName();
		$rs = false;

		$rs = $result = $wpdb->get_results("SELECT * FROM $table LIMIT 100");

		return $rs;
	}
}
