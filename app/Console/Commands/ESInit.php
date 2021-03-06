<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;

class ESInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'es:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '测试ES';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $client = new Client();
        // 创建模版
        $url = config('scout.elasticsearch.hosts')[0] . '/_template/tmp';
        $client->put($url, [
            'json' => [
                'template' => config('scout.elasticsearch.index'),
                'settings' => [
                    'number_of_shards' => 1
                ],
                'mappings' => [
                    '_default_' => [
                        '_all' => [
                            'enabled' => true
                        ],
                        'dynamic_templates' => [
                            [
                                'strings' => [
                                    'match_mapping_type' => 'string',
                                    'mapping' => [
                                        'type' => 'text',
                                        'analyzer' => 'ik_smart',
                                        'ignore_above' => 256,
                                        'fields' => [
                                            'keyword' => [
                                                'type' => 'keyword'
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]);

        $url = config('scout.elasticsearch.hosts')[0] . '/' . config('scout.elasticsearch.index');
        $client->put($url, [
            'json' => [
                'settings' => [
                    'refresh_interval' => '5s',
                    'number_of_shards' => 1,
                    'number_of_replicas' => 0,
                ],
                'mappings' => [
                    '_default_' => [
                        '_all' => [
                            'enabled' => false
                        ]
                    ]
                ]
            ]
        ]);
        //创建template
//        $client = new Client();
//        $url = config('scout.elasticsearch.hosts')[0] . '/_template/tmp';
//        $client->delete($url);
//        $params = [
//            'json' => [
//                'template' => config('scout.elasticsearch.index'),
//            ],
//            'mappings' => [
//                '_default_' => [
//                    'dynamic_templates' => [
//                        [
//                            'strings' => [
//                                'match_mapping_type' => 'string',
//                                'mapping' => [
//                                    'type' => 'text',
//                                    'analyzer' => 'ik_smart',
//                                    'fields' => [
//                                        'keyword' => [
//                                            'type' => 'keyword'
//                                        ]
//                                    ]
//                                ]
//                            ]
//                        ]
//                    ]
//                ]
//            ]
//        ];
//        $client->put($url, $params);
//        $this->info("============= 创建模板成功 =============");
//
//        // 创建index
//        $url = config('scout.elasticsearch.hosts')[0] . '/' . config('scout.elasticsearch.index');
//        $client->delete($url);
//        $params = [
//            'json' => [
//                'settings' => [
//                    'refresh_interval' => '5s',
//                    'number_of_shards' => 1,
//                    'number_of_replicas' => 0,
//                ],
//                'mappings' => [
//                    '_default_' => [
//                        '_all' => [
//                            'enabled' => false
//                        ]
//                    ]
//                ]
//            ]
//        ];
//        $client->put($url, $params);
//        $this->info("============= 创建索引成功 =============");
    }
}
