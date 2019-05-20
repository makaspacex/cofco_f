<?php
return [
  [
    'title' => '数据分析',
    'icon' => 'aicon ai-shezhi',
    'module' => 'cofco',
    'url' => 'cofco',
    'param' => '',
    'target' => '_self',
    'debug' => 0,
    'system' => 0,
    'nav' => 1,
    'sort' => 200,
    'childs' => [
      [
        'title' => '期刊管理API',
        'icon' => '',
        'module' => 'cofco',
        'url' => 'cofco/journal/index',
        'param' => '',
        'target' => '_self',
        'debug' => 0,
        'system' => 0,
        'nav' => 0,
        'sort' => 0,
        'childs' => [
          [
            'title' => '期刊信息同步',
            'icon' => '',
            'module' => 'cofco',
            'url' => 'cofco/journal/sync_info',
            'param' => '',
            'target' => '_self',
            'debug' => 0,
            'system' => 0,
            'nav' => 0,
            'sort' => 0,
          ],
        ],
      ],
      [
        'title' => '上传管理',
        'icon' => 'typcn typcn-cloud-storage',
        'module' => 'cofco',
        'url' => 'cofco',
        'param' => '',
        'target' => '_self',
        'debug' => 0,
        'system' => 0,
        'nav' => 1,
        'sort' => 2,
        'childs' => [
          [
            'title' => '爬虫关键词',
            'icon' => 'aicon ai-icon-test',
            'module' => 'cofco',
            'url' => 'cofco/keyword/index',
            'param' => '',
            'target' => '_self',
            'debug' => 0,
            'system' => 1,
            'nav' => 1,
            'sort' => 5,
            'childs' => [
              [
                'title' => '状态设置',
                'icon' => 'typcn typcn-adjust-contrast',
                'module' => 'cofco',
                'url' => 'cofco/keyword/setstatus',
                'param' => '',
                'target' => '_self',
                'debug' => 0,
                'system' => 1,
                'nav' => 0,
                'sort' => 0,
              ],
              [
                'title' => '关键词添加',
                'icon' => 'aicon ai-tianjia',
                'module' => 'cofco',
                'url' => 'cofco/spider/keywords_add',
                'param' => '',
                'target' => '_self',
                'debug' => 0,
                'system' => 1,
                'nav' => 0,
                'sort' => 0,
              ],
              [
                'title' => '关键词修改',
                'icon' => 'aicon ai-success',
                'module' => 'cofco',
                'url' => 'cofco/spider/keywords_edit',
                'param' => '',
                'target' => '_self',
                'debug' => 0,
                'system' => 0,
                'nav' => 1,
                'sort' => 0,
              ],
              [
                'title' => '关键词删除',
                'icon' => 'aicon ai-cha',
                'module' => 'cofco',
                'url' => 'cofco/keyword/kwdel',
                'param' => '',
                'target' => '_self',
                'debug' => 0,
                'system' => 1,
                'nav' => 0,
                'sort' => 0,
              ],
              [
                'title' => '【弹框】关键词选择',
                'icon' => 'aicon ai-quanping',
                'module' => 'cofco',
                'url' => 'cofco/labeldata/keywords_pop',
                'param' => '',
                'target' => '_self',
                'debug' => 0,
                'system' => 0,
                'nav' => 1,
                'sort' => 0,
              ],
              [
                'title' => '添加Pubmed关键词',
                'icon' => 'aicon ai-systemmenu',
                'module' => 'cofco',
                'url' => 'cofco/keyword/addpubmedkw',
                'param' => '',
                'target' => '_self',
                'debug' => 0,
                'system' => 0,
                'nav' => 1,
                'sort' => 0,
              ],
              [
                'title' => '添加Science关键词',
                'icon' => 'aicon ai-xitonggongneng',
                'module' => 'cofco',
                'url' => 'cofco/keyword/addsciencekw',
                'param' => '',
                'target' => '_self',
                'debug' => 0,
                'system' => 0,
                'nav' => 1,
                'sort' => 0,
              ],
              [
                'title' => '关键词列表',
                'icon' => '',
                'module' => 'cofco',
                'url' => 'cofco/keyword/data',
                'param' => '',
                'target' => '_self',
                'debug' => 0,
                'system' => 0,
                'nav' => 0,
                'sort' => 0,
              ],
            ],
          ],
          [
            'title' => '标签列表',
            'icon' => 'aicon ai-caidan',
            'module' => 'cofco',
            'url' => 'cofco/labeldata/levellabel',
            'param' => '',
            'target' => '_self',
            'debug' => 0,
            'system' => 1,
            'nav' => 1,
            'sort' => 6,
            'childs' => [
              [
                'title' => '标签添加',
                'icon' => 'aicon ai-tianjia',
                'module' => 'cofco',
                'url' => 'cofco/labeldata/levellabel_add',
                'param' => '',
                'target' => '_self',
                'debug' => 0,
                'system' => 0,
                'nav' => 1,
                'sort' => 0,
              ],
              [
                'title' => '标签状态',
                'icon' => 'aicon ai-systemmenu',
                'module' => 'cofco',
                'url' => 'cofco/labeldata/status',
                'param' => '',
                'target' => '_self',
                'debug' => 0,
                'system' => 0,
                'nav' => 0,
                'sort' => 0,
              ],
              [
                'title' => '标签修改',
                'icon' => 'aicon ai-qiyong',
                'module' => 'cofco',
                'url' => 'cofco/labeldata/levellabel_edit',
                'param' => '',
                'target' => '_self',
                'debug' => 0,
                'system' => 0,
                'nav' => 1,
                'sort' => 0,
              ],
              [
                'title' => '标签删除',
                'icon' => 'aicon ai-cha',
                'module' => 'cofco',
                'url' => 'cofco/labeldata/levellabel_del',
                'param' => '',
                'target' => '_self',
                'debug' => 0,
                'system' => 0,
                'nav' => 1,
                'sort' => 0,
              ],
              [
                'title' => '【弹框】打标签',
                'icon' => 'aicon ai-caidan',
                'module' => 'cofco',
                'url' => 'cofco/labeldata/levelpop',
                'param' => '',
                'target' => '_self',
                'debug' => 0,
                'system' => 0,
                'nav' => 0,
                'sort' => 0,
              ],
            ],
          ],
          [
            'title' => '文献上传',
            'icon' => 'aicon ai-huiyuanliebiao',
            'module' => 'cofco',
            'url' => 'cofco/upload/index',
            'param' => '',
            'target' => '_self',
            'debug' => 0,
            'system' => 1,
            'nav' => 1,
            'sort' => 20,
            'childs' => [
              [
                'title' => '辅助添加',
                'icon' => 'aicon ai-tianjia',
                'module' => 'cofco',
                'url' => 'cofco/upload/assist',
                'param' => '',
                'target' => '_self',
                'debug' => 0,
                'system' => 0,
                'nav' => 0,
                'sort' => 0,
              ],
              [
                'title' => '人工输入',
                'icon' => '',
                'module' => 'cofco',
                'url' => 'cofco/upload/manual',
                'param' => '',
                'target' => '_self',
                'debug' => 0,
                'system' => 0,
                'nav' => 1,
                'sort' => 0,
              ],
              [
                'title' => '爬虫输入',
                'icon' => 'aicon ai-qiyong',
                'module' => 'cofco',
                'url' => 'cofco/upload/spider',
                'param' => '',
                'target' => '_self',
                'debug' => 0,
                'system' => 0,
                'nav' => 1,
                'sort' => 0,
              ],
              [
                'title' => '新建爬虫',
                'icon' => '',
                'module' => 'cofco',
                'url' => 'cofco/upload/add',
                'param' => '',
                'target' => '_self',
                'debug' => 0,
                'system' => 0,
                'nav' => 1,
                'sort' => 0,
              ],
              [
                'title' => '爬虫日志',
                'icon' => '',
                'module' => 'cofco',
                'url' => 'cofco/upload/viewlog',
                'param' => '',
                'target' => '_self',
                'debug' => 0,
                'system' => 1,
                'nav' => 0,
                'sort' => 0,
              ],
            ],
          ],
        ],
      ],
      [
        'title' => '任务管理',
        'icon' => 'typcn typcn-anchor-outline',
        'module' => 'cofco',
        'url' => 'cofco/task/index',
        'param' => '',
        'target' => '_self',
        'debug' => 0,
        'system' => 1,
        'nav' => 1,
        'sort' => 3,
        'childs' => [
          [
            'title' => '任务分配',
            'icon' => 'aicon ai-doubleleft',
            'module' => 'cofco',
            'url' => 'cofco/task/distribution',
            'param' => '',
            'target' => '_self',
            'debug' => 0,
            'system' => 1,
            'nav' => 1,
            'sort' => 0,
          ],
          [
            'title' => '任务进度',
            'icon' => 'typcn typcn-pi-outline',
            'module' => 'cofco',
            'url' => 'cofco/task/progress',
            'param' => '',
            'target' => '_self',
            'debug' => 0,
            'system' => 1,
            'nav' => 1,
            'sort' => 0,
          ],
        ],
      ],
      [
        'title' => '文章管理API',
        'icon' => '',
        'module' => 'cofco',
        'url' => 'cofco/article/index',
        'param' => '',
        'target' => '_self',
        'debug' => 0,
        'system' => 0,
        'nav' => 0,
        'sort' => 4,
        'childs' => [
          [
            'title' => '文章搜索',
            'icon' => '',
            'module' => 'cofco',
            'url' => 'cofco/article/search',
            'param' => '',
            'target' => '_self',
            'debug' => 0,
            'system' => 0,
            'nav' => 0,
            'sort' => 0,
          ],
          [
            'title' => '文章删除',
            'icon' => '',
            'module' => 'cofco',
            'url' => 'cofco/article/del',
            'param' => '',
            'target' => '_self',
            'debug' => 0,
            'system' => 0,
            'nav' => 0,
            'sort' => 0,
          ],
          [
            'title' => '文章状态设置',
            'icon' => '',
            'module' => 'cofco',
            'url' => 'cofco/article/setstatus',
            'param' => '',
            'target' => '_self',
            'debug' => 0,
            'system' => 0,
            'nav' => 0,
            'sort' => 0,
          ],
          [
            'title' => '文章编辑',
            'icon' => '',
            'module' => 'cofco',
            'url' => 'cofco/article/edit',
            'param' => '',
            'target' => '_self',
            'debug' => 0,
            'system' => 0,
            'nav' => 0,
            'sort' => 0,
          ],
          [
            'title' => '文章查看',
            'icon' => '',
            'module' => 'cofco',
            'url' => 'cofco/article/view',
            'param' => '',
            'target' => '_self',
            'debug' => 0,
            'system' => 0,
            'nav' => 0,
            'sort' => 0,
          ],
          [
            'title' => '导出Excel',
            'icon' => '',
            'module' => 'cofco',
            'url' => 'cofco/article/exportexcel',
            'param' => '',
            'target' => '_self',
            'debug' => 0,
            'system' => 1,
            'nav' => 0,
            'sort' => 0,
          ],
        ],
      ],
      [
        'title' => '我的任务',
        'icon' => 'aicon ai-caidan',
        'module' => 'cofco',
        'url' => 'cofco',
        'param' => '',
        'target' => '_self',
        'debug' => 0,
        'system' => 1,
        'nav' => 1,
        'sort' => 5,
        'childs' => [
          [
            'title' => '文献初审',
            'icon' => 'aicon ai-systemmenu',
            'module' => 'cofco',
            'url' => 'cofco/task/auditor',
            'param' => '',
            'target' => '_self',
            'debug' => 0,
            'system' => 1,
            'nav' => 1,
            'sort' => 25,
          ],
          [
            'title' => '文献标注',
            'icon' => 'aicon ai-clear',
            'module' => 'cofco',
            'url' => 'cofco/task/labelor',
            'param' => '',
            'target' => '_self',
            'debug' => 0,
            'system' => 1,
            'nav' => 1,
            'sort' => 30,
          ],
          [
            'title' => '文献终审',
            'icon' => 'aicon ai-caidan',
            'module' => 'cofco',
            'url' => 'cofco/task/final_auditor',
            'param' => '',
            'target' => '_self',
            'debug' => 0,
            'system' => 1,
            'nav' => 1,
            'sort' => 35,
          ],
        ],
      ],
      [
        'title' => '辅助功能',
        'icon' => 'aicon ai-huiyuanliebiao',
        'module' => 'cofco',
        'url' => 'cofco/assistant/index',
        'param' => '',
        'target' => '_self',
        'debug' => 0,
        'system' => 1,
        'nav' => 1,
        'sort' => 6,
        'childs' => [
          [
            'title' => '文献输出',
            'icon' => 'aicon ai-daoru',
            'module' => 'cofco',
            'url' => 'cofco/assistant/output',
            'param' => '',
            'target' => '_self',
            'debug' => 0,
            'system' => 1,
            'nav' => 1,
            'sort' => 1,
          ],
          [
            'title' => '黑名单',
            'icon' => 'typcn typcn-warning',
            'module' => 'cofco',
            'url' => 'cofco/assistant/blacklist',
            'param' => '',
            'target' => '_self',
            'debug' => 0,
            'system' => 1,
            'nav' => 1,
            'sort' => 2,
          ],
          [
            'title' => '回收站',
            'icon' => 'typcn typcn-archive',
            'module' => 'cofco',
            'url' => 'cofco/assistant/deletedlist',
            'param' => '',
            'target' => '_self',
            'debug' => 0,
            'system' => 1,
            'nav' => 1,
            'sort' => 3,
          ],
        ],
      ],
      [
        'title' => '证据分析',
        'icon' => 'aicon ai-systemmenu',
        'module' => 'cofco',
        'url' => 'cofco/zhengju',
        'param' => '',
        'target' => '_self',
        'debug' => 0,
        'system' => 1,
        'nav' => 1,
        'sort' => 15,
        'childs' => [
          [
            'title' => '权重法',
            'icon' => 'typcn typcn-calculator',
            'module' => 'cofco',
            'url' => 'cofco/statistic/count',
            'param' => '',
            'target' => '_self',
            'debug' => 0,
            'system' => 1,
            'nav' => 1,
            'sort' => 0,
          ],
          [
            'title' => '选择数据（原料）',
            'icon' => '',
            'module' => 'cofco',
            'url' => 'cofco/statistic/levelpop1',
            'param' => '',
            'target' => '_self',
            'debug' => 0,
            'system' => 0,
            'nav' => 0,
            'sort' => 0,
          ],
          [
            'title' => '数据选择（健康）',
            'icon' => '',
            'module' => 'cofco',
            'url' => 'cofco/statistic/levelpop2',
            'param' => '',
            'target' => '_self',
            'debug' => 0,
            'system' => 0,
            'nav' => 0,
            'sort' => 0,
          ],
        ],
      ],
    ],
  ],
];
