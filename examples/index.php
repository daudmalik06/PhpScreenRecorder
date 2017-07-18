<?php
/**
 * Created by PhpStorm.
 * User: dawood.ikhlaq
 * Date: 7/17/2017
 * Time: 12:44
 */

include "../vendor/autoload.php";

use dawood\PhpScreenRecorder\ScreenRecorder;




$screenRecorder=new ScreenRecorder();
$screenRecorder->setScreenSizeToCapture(1920,1080);

$screenRecorder->startRecording(__DIR__.DIRECTORY_SEPARATOR.'myVideo');
sleep(5+2);
$screenRecorder->stopRecording();


print "video is saved at :\"".$screenRecorder->getVideo().'"'.PHP_EOL;