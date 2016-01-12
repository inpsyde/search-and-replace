<?php

namespace Inpsyde\searchReplace\inc;

class DatabaseManager {

	/**
	 * @var \wpdb
	 * Wordpress Database Class
	 * some functions adapted from : https://github.com/ExpandedFronts/Better-Search-Replace/blob/master/includes/class-bsr-db.php
	 */
	private $wpdb;

	public function __construct() {

		global $wpdb;
		$this->wpdb = $wpdb;

	}

	/**
	 * Returns an array of tables in the database.
	 *
	 * if multisite && mainsite: all tables of the site
	 * if multisite && subsite: all tables of current blog
	 *
	 * @access public
	 * @return array
	 */
	public function get_tables() {

		if ( function_exists( 'is_multisite' ) && is_multisite() ) {

			if ( is_main_site() ) {
				$tables = $this->wpdb->get_col( "SHOW TABLES LIKE'" . $this->wpdb->base_prefix . "%'" );
			} else {
				$blog_id = get_current_blog_id();
				$tables  = $this->wpdb->get_col( "SHOW TABLES LIKE '" . $this->wpdb->base_prefix . absint( $blog_id ) . "\_%'" );
			}

		} else {
			$tables = $this->wpdb->get_col( "SHOW TABLES LIKE'" . $this->wpdb->base_prefix . "%'" );
		}

		return $tables;
	}

	/**
	 * Returns an array containing the size of each database table.
	 *
	 * @access public
	 * @return array
	 */
	public function get_sizes() {

		$sizes  = array();
		$tables = $this->wpdb->get_results( 'SHOW TABLE STATUS', ARRAY_A );

		if ( is_array( $tables ) && ! empty( $tables ) ) {

			foreach ( $tables as $table ) {
				$size                      = round( $table[ 'Data_length' ] / 1024, 2 );
				$sizes[ $table[ 'Name' ] ] = sprintf( __( '(%s KB)', 'insr' ), $size );
			}

		}

		return $sizes;
	}

	/**
	 * Returns the number of rows in a table.
	 *
	 * @access public
	 * @return int
	 */
	public function get_rows( $table ) {

		$table = esc_sql( $table );
		$rows  = $this->wpdb->get_var( "SELECT COUNT(*) FROM $table" );

		return $rows;
	}

	/**
	 * Gets the columns in a table.
	 *
	 * @access public
	 *
	 * @param  string $table The table to check.
	 *
	 * @return array 1st Element: Primary Key, 2nd Element All Columns
	 */
	public function get_columns( $table ) {

		$primary_key = NULL;
		$columns     = array();
		$fields      = $this->wpdb->get_results( 'DESCRIBE ' . $table );

		if ( is_array( $fields ) ) {
			foreach ( $fields as $column ) {
				$columns[] = $column->Field;
				if ( $column->Key == 'PRI' ) {
					$primary_key = $column->Field;
				}
			}
		}

		return array( $primary_key, $columns );
	}

	/**
	 * @param $table String The Table Name
	 * @param $start Int The start row
	 * @param $end   Int Number of Rows to be fetched
	 *
	 * @return array|null|object
	 */
	public function get_table_content( $table, $start, $end ) {

		$data = $this->wpdb->get_results( "SELECT * FROM $table LIMIT $start, $end", ARRAY_A );

		return $data;
	}

	public function update( $table, $update_sql, $where_sql ) {

		$sql    = 'UPDATE ' . $table . ' SET ' . implode( ', ', $update_sql ) .
		          ' WHERE ' . implode( ' AND ', array_filter( $where_sql ) );
		$result = $this->wpdb->query( $sql );

		return $result;

	}

	public function get_table_structure( $table ) {

		return $this->wpdb->get_results( "DESCRIBE $table" );
	}

	/**
	 * returns a SQL CREATE TABLE Steatment for the table provide in $table
	 *
	 * @param $table String The Name of the table we want to create the statement for.
	 *
	 * @return string
	 */
	public function get_create_table_statement( $table ) {

		return $this->wpdb->get_results( "SHOW CREATE TABLE $table", ARRAY_N );
	}

	public function flush() {

		$this->wpdb->flush();
	}

	public function get_base_prefix() {

		return $this->wpdb->base_prefix;
	}

	/**
	 * imports a sql file via mysqli
	 *
	 * @param  string   $sql
	 * @param \WP_Error $error
	 *
	 * @return int  Number of Sql queries made
	 */
	public function import_sql( $sql, $error ) {

		//connect via mysqli for easier db import
		$mysqli = new \mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );

		// Run the SQL
		$i = 0;
		if ( $mysqli->multi_query( $sql ) ) {
			do {
				$mysqli->next_result();

				$i ++;
			} while ( $mysqli->more_results() );
		}

		if ( $mysqli->errno ) {
			$error->add( 'sql_import_error', __( '<b>Mysqli Error:</b> ' . $mysqli->error, 'insr' ) );

			return - 1;

		}

		mysqli_close( $mysqli );

		return $i;

	}

}


