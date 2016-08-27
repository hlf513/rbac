<?php
namespace PhpRbac;

use \Jf;

/**
 * @file
 * Provides NIST Level 2 Standard Role Based Access Control functionality
 *
 * @defgroup phprbac Rbac Functionality
 * @{
 * Documentation for all PhpRbac related functionality.
 */
class Rbac
{
	/**
	 * Rbac constructor.
	 *
	 * @param string | array | \PDO | \mysqli $dbOption
	 * 1. unit_test
	 * 2. db配置参数数组
	 * 3. pdo/mysqli的数据库对象
	 * @param string $tablePrefix 只有在$dbOption是对象时才需要
	 *
	 * @throws \Exception
	 */
	public function __construct($dbOption, $tablePrefix = '')
	{
		if (is_string($dbOption) && $dbOption === 'unit_test') {
			require_once dirname(dirname(__DIR__)) . '/tests/database/database.config';
		}

		// 每次都会新建一个数据库连接
		if (is_array($dbOption)) {
			/**
			 * 'host'=>'localhost',
			 * 'user'=>'',
			 * 'pass'=>'',
			 * 'dbname'=>'',
			 * 'adapter'=>'pdo_mysql|mysqli|pdo_sqlite',
			 * 'tablePrefix'=>'phprbac_'
			 */
			// extract db config variable
			extract($dbOption);
			if (empty($host) || empty($user) || empty($pass) || empty($dbname) || empty($adapter) || empty($tablePrefix)) {
				throw new \Exception('dbOption param is wrong');
			}
		}

		require_once 'core/lib/Jf.php';

		// 若是可用的数据库对象,则复用数据库连接
		if (is_object($dbOption) && ($dbOption instanceof \mysqli || $dbOption instanceof \PDO)) {
			Jf::$Db = $dbOption;
			if (empty($tablePrefix)) {
				throw new \Exception('tablePredix param cannot be empty');
			}
		}
		if (Jf::$Db === null) {
			require_once __DIR__ . "/core/setup.php";
		}

		$this->Permissions = Jf::$Rbac->Permissions;
		$this->Roles = Jf::$Rbac->Roles;
		$this->Users = Jf::$Rbac->Users;
	}

    public function assign($role, $permission)
    {
        return Jf::$Rbac->assign($role, $permission);
    }

    public function check($permission, $user_id)
    {
        return Jf::$Rbac->check($permission, $user_id);
    }

    public function enforce($permission, $user_id)
    {
        return Jf::$Rbac->enforce($permission, $user_id);
    }

    public function reset($ensure = false)
    {
        return Jf::$Rbac->reset($ensure);
    }

    public function tablePrefix()
    {
        return Jf::$Rbac->tablePrefix();
    }
}

/** @} */ // End group phprbac */
