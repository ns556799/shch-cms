<?php

//see:
// /framework/conf/ConfigureFromEnv.php
// http://doc.silverstripe.org/framework/en/topics/environment-management
/*
if(getenv('SERVER_DEVELOPMENT')){
	require_once('_ss_environment.DEV.php');
}else{
	require_once('_ss_environment.LIVE.php');
};*/

require_once('_ss_environment.DEV.php');
