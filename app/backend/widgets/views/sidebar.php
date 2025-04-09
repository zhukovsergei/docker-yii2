<?php
use yii\helpers\Url;
?>
<nav id="mainnav-container">
  <div id="mainnav">

    <!--Menu-->
    <!--================================-->
    <div id="mainnav-shortcut"></div>
    <div id="mainnav-menu-wrap">
      <div class="nano">
        <div class="nano-content">
          <ul id="mainnav-menu" class="list-group">

            <li class="list-header">Navigation</li>

            <li <?if(Yii::$app->controller->id == 'site'):?>class="active-link"<?endif;?>>
              <a href="/">
                <i class="fa fa-dashboard"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>

            <li <?if(Yii::$app->controller->id == 'news'):?>class="active-link"<?endif;?>>
              <a href="/news">
                <i class="fa fa-file-text"></i>
                <span class="menu-title">News</span>
              </a>
            </li>

            <li <?if(Yii::$app->controller->id == 'callback'):?>class="active-link"<?endif;?>>
              <a href="/callback">
                <i class="fa fa-phone"></i>
                <span class="menu-title">
                    <span class="menu-title">Callback me</span>
                  </span>
              </a>
            </li>

            <li <?if(Yii::$app->controller->id == 'articles'):?>class="active-link"<?endif;?>>
              <a href="/articles">
                <i class="fa fa-file-text-o"></i>
                <span class="menu-title">Articles</span>
              </a>
            </li>

            <li <?if(Yii::$app->controller->id == 'reviews'):?>class="active-link"<?endif;?>>
              <a href="/reviews">
                <i class="fa fa-commenting-o"></i>
                  <span class="menu-title">
                    <span class="menu-title">Reviews</span>
                    <?/*if(!empty($new_recs['recalls'])):*/?><!--
                      <span class="pull-right badge badge-success"><?/*=$new_recs['recalls']*/?></span>
                    --><?/*endif;*/?>
                  </span>
              </a>
            </li>

            <li <?if(Yii::$app->controller->id == 'directory'):?>class="active-link"<?endif;?>>
              <a href="/directory">
                <i class="fa fa-book"></i>
                <span class="menu-title">Book</span>
              </a>
            </li>

            <li <?if(Yii::$app->controller->id == 'faq'):?>class="active-link"<?endif;?>>
              <a href="/faq">
                <i class="fa fa-comments-o"></i>
                  <span class="menu-title">
                    <span class="menu-title">FAQ</span>
                    <?/*if(!empty($new_recs['faq'])):*/?><!--
                      <span class="pull-right badge badge-success"><?/*=$new_recs['faq']*/?></span>
                    --><?/*endif;*/?>
                  </span>
              </a>
            </li>

            <li <?if(Yii::$app->controller->id == 'gallery'):?>class="active-link"<?endif;?>>
              <a href="/gallery">
                <i class="fa fa-image"></i>
                  <span class="menu-title">
                    <span class="menu-title">Gallery</span>
                  </span>
              </a>
            </li>

            <li <?if(Yii::$app->controller->id == 'requests'):?>class="active-link"<?endif;?>>
              <a href="/requests">
                <i class="fa fa-copy"></i>
                  <span class="menu-title">
                    <span class="menu-title">Applications</span>
                  </span>
              </a>
            </li>

            <!--Menu list item-->
            <!--<li>
              <a href="/orders">
                <i class="fa fa-shopping-cart"></i>
                  <span class="menu-title">
                    <span class="menu-title">Заказы</span>
                  </span>
              </a>
            </li>-->

            <li class="list-divider"></li>

            <!--Category name-->
            <li class="list-header">Secondary navigation</li>

            <!--Menu list item-->
            <li <?if(Yii::$app->controller->id == 'pages'):?>class="active-link"<?endif;?>>
              <a href="#">
                <i class="fa fa-file-code-o"></i>
                <span class="menu-title">Static pages</span>
                <i class="arrow"></i>
              </a>

              <!--Submenu-->
              <ul class="collapse <?if(Yii::$app->controller->id == 'pages'):?>in<?endif;?>">
                <li <?if(Yii::$app->controller->id == 'pages' AND \Yii::$app->controller->action->id === 'add'):?>class="active-link"<?endif;?>><a href="/pages/add ">
                    <i class="fa fa-plus"></i><strong>Add page</strong></a></li>
                <li class="list-divider"></li>
                <li <?if(Yii::$app->controller->id == 'pages' AND Yii::$app->controller->action->id == 'index'):?>class="active-link"<?endif;?>><a href="/pages">
                    <i class="fa fa-list-ol"></i> <strong>All pages</strong></a></li>
                <li class="list-divider"></li>

                <?foreach($pages as $page):?>
                  <li><a href="<?=Url::to(['pages/update', 'id' => $page->id])?>"><?=$page->name?></a></li>
                <?endforeach;?>
              </ul>
            </li>

            <li class="list-divider"></li>

            <!--Category name-->
            <li class="list-header">Catalog</li>

            <!--Menu list item-->
            <li>
              <a href="#">
                <i class="fa fa-list"></i>
                <span class="menu-title">Catalog</span>
                <i class="fa arrow"></i>
              </a>

              <!--Submenu-->
              <ul class="collapse <?if(Yii::$app->controller->id == 'products'):?>in<?endif;?>">
                <li <?if(Yii::$app->controller->id == 'products' AND Yii::$app->controller->action->id == 'index'):?>class="active-link"<?endif;?>>
                  <a href="/products"> <i class="fa fa-list-ol"></i><strong>All Items</strong></a></li>
                <li class="list-divider"></li>

                <?/*foreach($productCategories as $productCategory):*/?><!--
                  <li <?/*if(Yii::app()->request->getParam('category_id') == $productCategory->id):*/?>class="active-link"<?/*endif;*/?> ><a href="/products?category_id=<?/*=$productCategory->id*/?>"><?/*=$productCategory->name*/?></a></li>
                --><?/*endforeach;*/?>
              </ul>
            </li>

            <!--Menu list item-->
            <li <?if(Yii::$app->controller->id == 'categories'):?>class="active-link"<?endif;?>>
              <a href="/categories">
                <i class="fa fa-list"></i>
                  <span class="menu-title">
                    Categories
                  </span>
              </a>
            </li>
            <li class="list-divider"></li>

            <!--Category name-->
            <li class="list-header">Configuration</li>

            <!--Menu list item-->
            <li <?if(Yii::$app->controller->id == 'users'):?>class="active-link"<?endif;?>>
              <a href="/users">
                <i class="fa fa-user"></i>
                  <span class="menu-title">
                    <span class="menu-title">Users </span></span>
              </a>
            </li>

            <li <?if(Yii::$app->controller->id == 'meta'):?>class="active-link"<?endif;?>>
              <a href="/meta">
                <i class="fa fa-sellsy"></i>
                <span class="menu-title">Meta</span>
              </a>
            </li>

            <!--Menu list item-->
            <li <?if(Yii::$app->controller->id == 'settings'):?>class="active-link"<?endif;?>>
              <a href="/settings">
                <i class="fa fa-cog"></i>
                <span class="menu-title">Settings</span>
              </a>
            </li>

          </ul>


          <!--Widget-->
          <!--================================-->
          <div class="mainnav-widget">

            <!-- Show the button on collapsed navigation -->
            <div class="show-small">
              <a href="#" data-toggle="menu-widget" data-target="#demo-wg-server">
                <i class="fa fa-desktop"></i>
              </a>
            </div>

            <!-- Hide the content on collapsed navigation -->
            <!--<div id="demo-wg-server" class="hide-small mainnav-widget-content">
              <ul class="list-group">
                <li class="list-header pad-no pad-ver">Продвижение сайта</li>
                <li class="mar-btm">
                  <span class="label label-primary pull-right">53%</span>

                  <p>SEO оптимизация</p>

                  <div class="progress progress-sm">
                    <div class="progress-bar progress-bar-primary" style="width: 53%;">
                      <span class="sr-only">53%</span>
                    </div>
                  </div>
                </li>
                <li class="mar-btm">
                  <span class="label label-purple pull-right">95%</span>

                  <p>Индексация сайта</p>

                  <div class="progress progress-sm">
                    <div class="progress-bar progress-bar-purple" style="width: 95%;">
                      <span class="sr-only">95%</span>
                    </div>
                  </div>
                </li>
                <li class="mar-btm">
                  <span class="label label-pink pull-right">15%</span>

                  <p>Ключевики в топ-10</p>

                  <div class="progress progress-sm">
                    <div class="progress-bar progress-bar-pink" style="width: 15%;">
                      <span class="sr-only">15%</span>
                    </div>
                  </div>
                </li>
                <li class="pad-ver"><a href="#" class="btn btn-success btn-bock">Подробнее</a></li>
              </ul>
            </div>-->
          </div>
          <!--================================-->
          <!--End widget-->

        </div>
      </div>
    </div>
    <!--================================-->
    <!--End menu-->

  </div>
</nav>