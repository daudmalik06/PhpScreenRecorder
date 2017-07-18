<?php

use dawood\PhpScreenRecorder\ScreenRecorder;
use PHPUnit\Framework\TestCase;

class ScreenRecorderTestSuite extends TestCase
{
    public function testSetOptions()
    {
        $screenRecorder=new ScreenRecorder;
        $testOptions=[
            'testOption'=>'testValue'
        ];
        $screenRecorder->setOptions($testOptions);
        $this->assertArraySubset($testOptions,$screenRecorder->getOptions());
    }

    public function testSetScreenSizeToCapture()
    {
        $screenRecorder=new ScreenRecorder;
        $testOptions=[
            '-video_size'=>'200x300'
        ];
        $screenRecorder->setOptions($testOptions);
        $this->assertArraySubset($testOptions,$screenRecorder->getOptions());
    }

    public function testStartRecording()
    {
        $screenRecorder=new ScreenRecorder;
        $testOptions=[
            '-video_size'=>'200x300'
        ];
        $inputFile=__DIR__.DIRECTORY_SEPARATOR.'test.flv';
        $screenRecorder->setOptions($testOptions);
        $screenRecorder->startRecording($inputFile);
        sleep(1);
        $screenRecorder->stopRecording();
        $outputFile=$screenRecorder->getVideo();
        $this->deleteFileIfExist($outputFile);
        $this->assertEquals($inputFile,$outputFile);
    }

    public function testSetBinary()
    {
        $ffmpegFile=stristr(PHP_OS, 'win')?'ffmpegWindows.exe':'ffmpegLinux';
        $screenRecorder=new ScreenRecorder;
        $binaryFile=$screenRecorder->rootPath().DIRECTORY_SEPARATOR.'bin'.DIRECTORY_SEPARATOR.$ffmpegFile;
        $screenRecorder->setBinary($binaryFile);
        $this->assertEquals($binaryFile,$screenRecorder->getBinary());
    }


    private function deleteFileIfExist($file)
    {
        if(file_exists($file))
        {
            @unlink($file);
        }
    }
}