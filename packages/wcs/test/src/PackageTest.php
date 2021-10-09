<?php
/**
 * FileName: PackageTest.php
 * Description: 填写该类功能描述
 * @author: 翁昌水
 * @Create Date: 2021/10/08 19:19
 * @version v1.0
 */


namespace Wcs\test;


use Illuminate\Config\Repository;
use Illuminate\Session\SessionManager;

class PackageTest
{
    /**
     * @var SessionManager
     */
    protected $session;
    /**
     * @var Repository
     */
    protected $config;

    /**
     * Packagetest constructor.
     * @param SessionManager $session
     * @param Repository $config
     */
    public function __construct(SessionManager $session, Repository $config)
    {
        $this->session = $session;
        $this->config = $config;
    }

    /**
     * @param string $msg
     * @return string
     */
    public function test_rtn($msg = '')
    {
        $config_arr = $this->config->get('packagetest.options');
        return $msg . ' <strong>from your custom develop package!</strong>>';
    }
}
