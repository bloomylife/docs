<?php
/**
 * Created by PhpStorm.
 * User: zhangxitao
 * Date: 14-9-6
 * Time: 上午8:13
 */
include_once 'lib.class.php';
class html {
    public $m;
    //访问的文档菜单值
    public $menu;
    //文档数据
    public $docs;
    //配置事项
    public $docsConfig;
    //是否有其他模型下的文件
    public $hasOtherModule = false;
    //统一CONFIG配置
    public static $commonDataConfig = array();

    public function __construct($m, $menu, $docs, $docsConfig) {
        $this->m = $m;
        $this->menu = $menu;
        $this->docs = $docs;
        $this->docsConfig = $docsConfig;
        lib::resolveMethod($this->m, $this->menu);
        if ($this->m != $m) $this->hasOtherModule = true;
    }

    /**
     * 根据调用的item显示对应html
     * @param $item
     * @param $arguments
     * @return bool|string
     */
    public function __call($item, $arguments) {
        $itemsConfig = $this->docsConfig['items'];
        if (!array_key_exists($item, $itemsConfig)) {
            return false;
        }

        $configs = $itemsConfig[$item];
        return $this->getHtml($item, $configs, $this->docs);
    }

    /**
     * 根据类型获取数据
     * @param $item
     * @param $configs
     * @param $docs
     * @param string $defaultShowType
     * @param int $isChild
     * @return string
     */
    private function getHtml($item, $configs, $docs, $defaultShowType = '', $isChild = 0) {
        $html = '';
        if (array_key_exists($item, $docs)) {
            // show header
            $html .= $this->header($item, $configs['name'], $isChild);
            $showType = array_key_exists('showType', $configs) ? $configs['showType'] : $defaultShowType;

            if (array_key_exists('child', $configs) && is_array($docs[$item])) {
                foreach ($configs['child'] as $key => $val) {
                    // show child header
                    $html .= $this->getHtml($key, $val, $docs[$item], $showType, 1);
                }
            } else {
                $html .= $this->showByType($showType, $docs[$item]);
            }
        } else {
            $html .= $this->showByType($defaultShowType, $docs[$item]);
        }

        return $html;
    }

    /**
     * 根据显示类型返回html
     * @param $showType
     * @param $datas
     * @return string
     */
    private function showByType($showType, $datas) {
        $html = '';
        switch ($showType) {
            case 'code':
                $html .= $this->codeHtml($datas);
                break;
            case 'table':
                $html .= $this->tableHtml($datas);
                break;
            case 'p':
            default:
                $html .= $this->pHtml($datas);
                break;
        }

        return $html;
    }

    /**
     * 显示item头html
     * @param $item
     * @param $itemValue
     * @return string
     */
    private function header($item, $itemValue, $isChild = 0) {
        if ($isChild){
            return '<h4>'.$itemValue.'</h4>';
        } else {
            $menus = $this->hasOtherModule ? $this->m.'-'.$this->menu : $this->menu;
            return '<h3 id="'.$menus.'-'.$item.'">'. $itemValue .'</h3>';
        }
    }

    /**
     * 显示code代码
     * @param $html
     * @return string
     */
    private function codeHtml($datas) {
        $html = '';
        if (is_array($datas)) {
            foreach($datas as $data) {
                $html .= '<div class="highlight"><pre><code class="html">'.$this->dataHandler($data).'</code></pre></div>';
            }
        } else {
            $html .= '<div class="highlight"><pre><code class="html">'.$this->dataHandler($datas).'</code></pre></div>';
        }
        return $html;
    }

    private function pHtml($datas) {
        $html = is_array($datas) ? implode('\n', $datas) : $datas;
        return '<p>'.$this->dataHandler($html).'</p>';
    }

    /**
     * 表格数据显示
     * @param $datas
     * @return string
     */
    private function tableHtml($datas) {
        $html = '<div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead><tr class="text-nowrap">';

        $tables = $this->tableHandler($datas);

        $html .= $tables['theads'] .'</thead><tbody>';
        $html .= $tables['tbodys'] .'</tbody></table></div>';

        return $html;
    }

    private function tableHandler($datas, $level = 0, $colName = '#LIST#') {
        $columnsConfig = $this->docsConfig['tableColumns'];

        $theads = $tbodys = '';
        $isThead = true;

        if ($level) {
            $cn = $colName != '#LIST#' ? $colName : 'LIST';
            if ($level > 1) {
                $cn = str_repeat('&nbsp;', 4*($level-1)) .'-&gt; '. $cn;
            }
            $tbodys = '<tr><th colspan="'.count($columnsConfig).'">'. $cn .'</th></tr>';
        }

        foreach ($datas as $data) {
            if (!is_array($data)) break;

            $columns = array_keys($data);
            if (count($columns) == 0) break;

            $tb = '';
            foreach ($columns as $col) {
                if (array_key_exists($col, $columnsConfig)) {
                    if ($isThead && !$level) {
                        $theads .= '<th>'.$columnsConfig[$col].'</th>';
                    }

                    $nowrap = $col=='parameter'||$col=='name' ? ' class="text-nowrap"' : '';
                    $subFlag = $level && $col=='parameter' ? str_repeat('&nbsp;', 4*$level).'-&gt; ' : '';
                    $tb .= '<td'.$nowrap.'>'.$subFlag.$this->dataHandler($data[$col]).'</td>';
                } elseif (is_array($data[$col])) {
                    $res = $this->tableHandler($data[$col], $level+1 , $col);
                    $theads .= $res['theads'];
                    $tbodys .= $res['tbodys'];
                }
            }
            $isThead = false;
            if ($tb) $tbodys .= '<tr>'. $tb .'</tr>';
        }
        return array('theads' => $theads, 'tbodys' => $tbodys);
    }

    /**
     * 数据处理
     * @param $data
     * @return mixed
     */
    private function dataHandler($data) {
        $rtn = '';
        if (is_array($data)) {
            foreach ($data as $da) {
                $rtn .= $this->dataHandler($da);
            }
        } else {
            if (substr($data, 0, 1) == '#' && $data[strlen($data)-1] == '#') {
                $dt = substr($data, 1, -1);
                if ($dt == 'CONFIG') {
                    $desc =  lib::getConfig($this->m);
                    if (array_key_exists($this->menu, $desc)) {
                        $rtn = $this->arrayToString(self::$commonDataConfig);
                        foreach($desc[$this->menu] as $kk => $v) {
                            $rtn .= $this->code($kk, 'code-small') .'：'. $v . '\n';
                        }
                    } else {
                        $rtn .= $this->alertInfo('Method',  $this->code($this->m.'->'.$this->menu) .' 不存在!');
                    }
                } elseif ($dt == 'LIST') {

                } elseif (count(explode('.', $dt)) == 2) {
                    $dtArr = explode('.', $dt);
                    $formatArr = explode('/', $this->docs['supportedFormat']);
                    if (in_array(strtolower($dtArr[1]), array_map('strtolower', $formatArr))) {
                        $rtn .= lib::getFileByType($this->m, $dt);
                    }
                } else {
                    $rtn .= $dt;
                }
            } else {
                $rtn .= $data;
            }
        }

        return str_replace('\n', '<br />', $rtn);
    }

    /**
     * @param $code
     * @return string
     */
    public function code($code, $class = '') {
        return '<code class="'.$class.'">'. $code . '</code>';
    }

    private function alertInfo($header, $info) {
        return '<div class="alert alert-danger alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">关闭</span></button>
      <strong>'.$header.'：</strong>'. $info .'</div>';
    }

    private function arrayToString($array) {
        $rtn = "";
        if (!empty($array)) {
            foreach($array as $kk => $v) {
                $rtn .= $this->code($kk, 'code-small') .'：'. $v . '\n';
            }
        }

        return $rtn;
    }

}