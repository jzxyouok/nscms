<?php
return array(

	// 设置默认的模板主题
    'DEFAULT_THEME'    =>    'home_default',
    'VIEW_PATH' => './Theme/',

    // 每页显示数量
    'PAGE_ROWS' => 2,

    // 实例化Page类参数
    'PAGE_CONFIG' => array(
        'header' => '<span class="rows">共 %TOTAL_ROW% 条记录</span>',
        'prev'   => '<<',
        'next'   => '>>',
        'first'  => '1...',
        'last'   => '...%TOTAL_PAGE%',
        'theme'  => '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%',
    ),
);