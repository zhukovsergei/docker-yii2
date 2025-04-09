<?php
$this->title = 'Control panel';

backend\assets\Dashboard::register($this);
use common\components\Adobe;
?>

<div id="content-container">

    <?=backend\widgets\Alert::widget()?>

    <div id="page-title">
        <h1 class="page-header text-overflow">Control panel <span class="pull-right">Today <?=\Yii::$app->formatter->asDate(new \DateTime(), 'full')?> &nbsp;&nbsp;&nbsp;&nbsp;</span></h1>
    </div>

    <!--      <a id="demo-toggle-aside" class="shortcut-grid" href="#">-->
    <!--        <i class="fa fa-magic"></i>-->
    <!--      </a>-->


    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
        <div class="row">
            <div class="col-lg-7">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Sale Statistics</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6 text-center">

                                <!--Chart placeholder -->
                                <div id="demo-morris-donut" class="morris-donut"></div>
                                <script>
                                    $(document).ready(function(){
                                        Morris.Donut({
                                            element: 'demo-morris-donut',
                                            data: [
                                                {label: "Paid", value: 2},
                                                {label: "Sold", value: 3},
                                                {label: "Reserved", value: 2}
                                            ],
                                            colors: [
                                                '#c686be',
                                                '#986291',
                                                '#ab6fa3'
                                            ],
                                            resize:true
                                        });
                                    });
                                </script>

                            </div>
                            <div class="col-lg-6">
                                <div class="pad-ver">
                                    <p class="text-lg">Visitors were ordered</p>
                                    <div class="progress progress-sm">
                                        <div role="progressbar" style="width: 11%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="15" class="progress-bar progress-bar-purple">
                                            <span class="sr-only">2%</span>
                                        </div>
                                    </div>
                                    <small class="text-muted">2% ordered</small>
                                </div>
                                <div class="pad-ver">
                                    <p class="text-lg">Orders paid for immediately</p>
                                    <div class="progress progress-sm">
                                        <div role="progressbar" style="width: 20%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" class="progress-bar progress-bar-success">
                                            <span class="sr-only">2%</span>
                                        </div>
                                    </div>
                                    <small class="text-muted">2% paid</small>
                                </div>

                                <hr>
                                <p class="text-muted">All statistics are generated from the beginning of the current day.</p>
                                <small class="text-muted"><em>Last update: <?=date('H:i, d F Y г.')?></em></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="col-lg-6 col-lg-6">
                    <div class="panel panel-dark panel-colorful">
                        <div class="panel-body text-center">
                            <p class="text-uppercase mar-btm text-sm">Visitors</p>
                            <i class="fa fa-users fa-5x"></i>
                            <hr>
                            <p class="h2 text-thin">2</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-lg-6">
                    <div class="panel panel-danger panel-colorful">
                        <div class="panel-body text-center">
                            <p class="text-uppercase mar-btm text-sm">New requests</p>
                            <i class="fa fa-comments-o fa-5x"></i>
                            <hr>
                            <p class="h2 text-thin">2</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-lg-6">
                    <div class="panel panel-primary panel-colorful">
                        <div class="panel-body text-center">
                            <p class="text-uppercase mar-btm text-sm">New orders</p>
                            <i class="fa fa-shopping-cart fa-5x"></i>
                            <hr>
                            <p class="h2 text-thin">1</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-lg-6">
                    <div class="panel panel-info panel-colorful">
                        <div class="panel-body text-center">
                            <p class="text-uppercase mar-btm text-sm">Paid online</p>
                            <i class="fa fa-rub fa-5x"></i>
                            <hr>
                            <p class="h2 text-thin">1</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-12">

                <!--Network Line Chart-->
                <!--===================================================-->
                <div id="demo-panel-network" class="panel">
                    <div class="panel-heading">
                        <div class="panel-control">
                            <button id="demo-panel-network-refresh" data-toggle="panel-overlay" data-target="#demo-panel-network" class="btn"><i class="fa fa-rotate-right"></i></button>
                        </div>
                        <h3 class="panel-title">Visitor Statistics</h3>
                    </div>

                    <!--Morris line chart placeholder-->
                    <div id="morris-chart-network" class="morris-full-content"></div>

                    <!--Chart information-->
                    <div class="panel-body bg-primary" style="position:relative;z-index:2">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-xs-8">

                                        <!--Server load stat-->
                                        <div class="pad-ver media">
                                            <div class="media-left">
                                                <span class="icon-wrap icon-wrap-xs">
                                                  <i class="fa fa-cloud fa-2x"></i>
                                                </span>
                                            </div>

                                            <div class="media-body">
                                                <?if(function_exists('sys_getloadavg')):?>
                                                    <p class="h3 text-thin media-heading"><?=sys_getloadavg()[0]?> %</p>
                                                    <small class="text-uppercase">Load on server</small>
                                                <?endif;?>

                                            </div>
                                        </div>

                                        <?if(function_exists('sys_getloadavg')):?>
                                            <!--Progress bar-->
                                            <div class="progress progress-xs progress-dark-base mar-no">
                                                <div class="progress-bar progress-bar-light" style="width: <?=round(sys_getloadavg()[0])?>%"></div>
                                            </div>
                                        <?endif;?>

                                    </div>
                                    <div class="col-xs-4">
                                        <!-- User Online -->
                                        <div class="text-center">
                                            <span class="text-3x text-thin">1</span>
                                            <p>online</p>
                                        </div>
                                    </div>
                                </div>

                                <!--Additional text-->
                                <div class="mar-ver">
                                    <small class="pad-btm"><em> * Statistics are taken for the last 24 hours and updated automatically every hour. <br><br></em></small>
                                </div>

                            </div>

                            <div class="col-lg-6">
                                <!-- List Group -->
                                <ul class="list-group bg-trans mar-no">
                                    <li class="list-group-item">
                                        <span class="badge badge-primary"><?=$hits?></span>
                                        Views for today
                                    </li>
                                    <li class="list-group-item">
                                        <span class="badge badge-primary"><?=$hosts?></span>
                                        Unique visitors today
                                    </li>
                                    <li class="list-group-item">
                                        <span class="badge badge-primary"><?=Yii::$app->userCounter->getYesterday()?></span>
                                        Unique visitors yesterday
                                    </li>
                                    <li class="list-group-item">
                                        <span class="badge badge-primary"><?=Yii::$app->userCounter->getTotal()?></span>
                                        Unique visitors in total
                                    </li>
                                    <li class="list-group-item">
                                        <span class="badge badge-primary"><?=Yii::$app->userCounter->getMaximal()?></span>
                                        Max online (<?=\Yii::$app->formatter->asDate(Yii::$app->userCounter->getMaximalTime())?>)
                                    </li>
                                    <!--<li class="list-group-item">
                                      <span class="badge badge-primary">11</span>
                                      Продаж за сегодня
                                    </li>
                                    <li class="list-group-item">
                                      <span class="badge badge-primary">30</span>
                                      Продаж за неделю
                                    </li>-->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!--===================================================-->
                <!--End network line chart-->
            </div>
        </div>

        <div class="row">
            <!--<div class="col-lg-4">
        <div class="panel panel-dark panel-colorful">
          <div class="panel-heading">
            <div class="panel-control">
              <button class="btn btn-default"><i class="fa fa-gear"></i></button>
            </div>
            <h3 class="panel-title">Не забыть</h3>
          </div>
          <div class="pad-ver">
            <ul class="list-group bg-trans list-todo mar-no">

              <?/*foreach($tasks as $task):*/?>
                <li class="list-group-item">
                  <label class="form-checkbox form-icon taskRow" data-id="<?/*=$task->id*/?>">
                    <input type="checkbox" <?/*if($task->finished):*/?> checked <?/*endif;*/?>>
                    <span><?/*=$task->name*/?></span>
                  </label>
                </li>
              <?/*endforeach;*/?>

            </ul>
          </div>
          <div class="input-group pad-all">
            <input type="text" class="form-control" placeholder="Новая задача" autocomplete="off">
              <span class="input-group-btn">
                <button type="button" class="btn btn-success"><i class="fa fa-plus"></i></button>
              </span>
          </div>
        </div>
      </div>-->
            <div class="col-lg-6">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Server Statistics</h3>
                    </div>
                    <div class="panel-body">
                        <li class="list-group-item">
                            <span class="badge"><?=phpversion();?></span>
                            Version PHP
                        </li>

                        <li class="list-group-item">
                            <span class="badge"><?=Yii::$app->db->driverName?></span>
                            Server DB
                        </li>
                        <li class="list-group-item">
                            <span class="badge"><?=Yii::$app->db->enableQueryCache ? 'On' : 'Off'?></span>
                            Caching requests
                        </li>
                        <li class="list-group-item">
                            <span class="badge"><?=Yii::$app->db->enableSchemaCache ? 'On' : 'Off'?></span>
                            Table caching
                        </li>
                        <li class="list-group-item">
                            <span class="badge"><?=Yii::$app->db->username?></span>
                            User
                        </li>
                        <li class="list-group-item">
                            <span class="badge"><?=Yii::$app->db->serverRetryInterval?></span>
                            Time to reconnect (s)
                        </li>
                        <li class="list-group-item">
                            <span class="badge"><?=Yii::$app->db->charset?></span>
                            Encoding
                        </li>

                        <!--                              <small class="text-muted"><em>--><?//=Yii::app()->db->connectionString?><!--</em></small>-->
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Database</h3>
                    </div>
                    <div class="panel-body">

                        <?foreach($resDBInfo as $info):?>
                            <li class="list-group-item">
                                <span class="badge badge-success"><?=$info['size']?> Mb</span>
                                DB: <?=$info['name']?>
                            </li>
                        <?endforeach;?>
                        <li class="list-group-item">
                            All users: <span class="badge badge-success"><?=$usersQt?></span>
                            <br/>
                            <small class="text-muted"><em>baned:</em> <b><?=$usersBanned?></b></small>
                            <br/>
                            <small class="text-muted"><em>admins:</em> <b><?=$usersAdmins?></b></small>

                        </li>
                        <li class="list-group-item">
                            All items: <span class="badge badge-success">1</span>
                            <br/>
                            <!--              <small class="text-muted"><em>текст</em></small>-->
                        </li>

                    </div>
                </div>
            </div>

        </div>


    </div>
    <!--===================================================-->
    <!--End page content-->
</div>