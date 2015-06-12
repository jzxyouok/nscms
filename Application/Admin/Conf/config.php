<?php
return array(
	//'配置项'=>'配置值'
        'UPLOAD_CONFIG' => array(
                // banner图上传配置
                'banner' => array(
                        'maxSize'       =>  3145728, //上传的文件大小限制 (0-不做限制)
                        'exts'          =>  array('jpg', 'gif', 'png', 'jpeg'), //允许上传的文件后缀
                        'subName'       =>  '', //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
                        'rootPath'      =>  './Uploads/', //保存根路径
                        'savePath'      =>  'banner/', //保存路径
                ),

                // 编辑器图片上传配置
                 'editor' => array(
                        'maxSize'       =>  3145728, //上传的文件大小限制 (0-不做限制)
                        'exts'          =>  array('jpg', 'gif', 'png', 'jpeg'), //允许上传的文件后缀
                        'subName'       =>  array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
                        'rootPath'      =>  './Uploads/', //保存根路径
                        'savePath'      =>  'editorImage/', //保存路径
                ),

                 // 文章缩略图上传配置
                 'thumb' => array(
                        'maxSize'       =>  3145728, //上传的文件大小限制 (0-不做限制)
                        'exts'          =>  array('jpg', 'gif', 'png', 'jpeg'), //允许上传的文件后缀
                        'subName'       =>  array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
                        'rootPath'      =>  './Uploads/', //保存根路径
                        'savePath'      =>  'thumb/', //保存路径
                ),
        ),      
);