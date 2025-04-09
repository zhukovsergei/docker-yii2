<?php

use aiur\helpers\CurrentLanguageHelper;

?>
<header id="navbar">
    <div id="navbar-container" class="boxed">

        <!--Brand logo & name-->
        <!--================================-->
        <?= backend\widgets\Brand::widget()?>
        <!--================================-->
        <!--End brand logo & name-->


        <!--Navbar Dropdown-->
        <!--================================-->
        <div class="navbar-content clearfix">
            <ul class="nav navbar-top-links pull-left">

                <!--Navigation toogle button-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <li class="tgl-menu-btn">
                    <a class="mainnav-toggle" href="#">
                        <i class="fa fa-navicon fa-lg"></i>
                    </a>
                </li>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End Navigation toogle button-->


                <!--Messages Dropdown-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End message dropdown-->

                <!--Notification dropdown-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End notifications dropdown-->
            </ul>
            <ul class="nav navbar-top-links pull-right">

                <!--Language selector-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <li class="dropdown">

                    <a class="lang-selector dropdown-toggle" href="#" data-toggle="dropdown">

                        <span class="lang-selected">
                            <img class="lang-flag" src="/img/flags/<?= CurrentLanguageHelper::getIconName()?>" alt="<?= CurrentLanguageHelper::getLabel()?>">
                            <span class="lang-id"><?= CurrentLanguageHelper::getCodeName()?></span>
                            <span class="lang-name"><?= CurrentLanguageHelper::getLabel()?></span>
                      </span>

                    </a>

                    <!--Language selector menu-->
                    <ul class="head-list dropdown-menu">
                        <li>
                            <!--Germany-->
                            <a href="/site/change-lang/?lang=de">
                                <img class="lang-flag" src="/img/flags/germany.png" alt="Deutsch">
                                <span class="lang-id">De</span>
                                <span class="lang-name">Deutsch</span>
                            </a>
                        </li>
                        <li>
                            <!--France-->
                            <a href="/site/change-lang/?lang=fr">
                                <img class="lang-flag" src="/img/flags/france.png" alt="France">
                                <span class="lang-id">Fr</span>
                                <span class="lang-name">Fran&ccedil;ais</span>
                            </a>
                        </li>
                        <li>
                            <!--France-->
                            <a href="/site/change-lang/?lang=it">
                                <img class="lang-flag" src="/img/flags/italy.png" alt="Italian">
                                <span class="lang-id">It</span>
                                <span class="lang-name">Italian</span>
                            </a>
                        </li>
                        <li>
                            <!--France-->
                            <a href="/site/change-lang/?lang=en">
                                <img class="lang-flag" src="/img/flags/united-kingdom.png" alt="English">
                                <span class="lang-id">En</span>
                                <span class="lang-name">English</span>
                            </a>
                        </li>

                    </ul>
                </li>

                <!--User dropdown-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <li id="dropdown-user" class="dropdown">
                    <?if(Yii::$app->controller->id !== 'site'):?>
                        <a href="<?=\Yii::$app->request->getHostInfo()?>" class="dropdown-toggle text-right">
                            Dashboard [<i class="fa fa-arrow-down"></i>]
                        </a>
                    <?endif;?>

                    <a target="_blank" href="<?=str_replace('cp.', '', \Yii::$app->request->getHostInfo())?>" class="dropdown-toggle text-right">
                        Go to frontend [<i class="fa fa-arrow-right"></i>]
                    </a>

                    <a href="#" data-toggle="dropdown" class="dropdown-toggle text-right">
								<span class="pull-right">
									<img class="img-circle img-user media-object" src="/img/av1.png" alt="Profile Picture">
								</span>
                        <div class="username hidden-xs">
                            <?if(!\Yii::$app->getUser()->getIsGuest()):?>
                                <?=\Yii::$app->getUser()->getIdentity()->username?>
                            <?else:?>
                                admin
                            <?endif;?>
                        </div>
                    </a>


                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right with-arrow panel-default">
                        <!-- Dropdown heading  -->
                        <div class="pad-all bord-btm">
                            <p class="text-lg text-muted text-thin mar-btm">Welcome back <?if(!Yii::$app->getUser()->getIsGuest()):?><?=\Yii::$app->user->getIdentity()->username?> <?endif;?>!</p>
                        </div>


                        <!-- User dropdown menu -->
                        <ul class="head-list">
                            <li>
                                <a href="/settings">
                                    <i class="fa fa-gear fa-fw fa-lg"></i> Settings
                                </a>
                            </li>
                        </ul>

                        <!-- Dropdown footer -->
                        <div class="pad-all text-right">
                            <a href="/auth/logout" class="btn btn-primary">
                                <i class="fa fa-sign-out fa-fw"></i> Exit
                            </a>
                        </div>
                    </div>
                </li>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End user dropdown-->

            </ul>
        </div>
        <!--================================-->
        <!--End Navbar Dropdown-->

    </div>
</header>