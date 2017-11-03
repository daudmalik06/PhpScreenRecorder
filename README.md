PHP Screen Recorder
===============

A lightweight php wrapper around [ffmpeg](https://ffmpeg.org/) to record the screen, best for recording your 
acceptance tests using selenium, it's easy to use and clean OOP interface. 


## History
I was given a task to make an **acceptance test suite** which included recording videos of the
tests. I was using **selenium** for the task and for the video recording, however, I was unable to find
an elegant solution which is why i created this library.


## Usage 

One of the best features of this library is its ease of use.
  
The   `startRecording` method is called when the user wants to start the recording 
after which this library will start the video recording in the background.
When the user has completed their task they can call `stopRecording` to stop the recording .

## Installation
The library is easily installed as a package through [composer](http://getcomposer.org):

```
composer require dawood/phpscreenrecorder
```
*that's it, nothing else is required for the installation* 



## Examples
There are examples provided in examples folder as well.

Make sure, that you include the composer [autoloader](https://getcomposer.org/doc/01-basic-usage.md#autoloading)
somewhere in your codebase.


### Capture the screen

```php

include "../vendor/autoload.php";

use dawood\PhpScreenRecorder\ScreenRecorder;

$screenRecorder=new ScreenRecorder();
$screenRecorder->setScreenSizeToCapture(1920,1080);

$screenRecorder->startRecording(__DIR__.DIRECTORY_SEPARATOR.'myVideo');
sleep(5+2);//doing random stuff
//when done stop recording
$screenRecorder->stopRecording();

print "video is saved at :\"".$screenRecorder->getVideo().'"'.PHP_EOL;

```


### Selenium test example
```php

public function testLoginUserCorrectly()
{
    $this->screenRecorder->setScreenSizeToCapture(1920,1080);
    $this->screenRecorder->startRecording(__DIR__."/videos/loginCorrectly.flv",2);
    $loginInput = [
        'username' => 'test',
        'password' => 'password'
    ];
    $this->visit('/')
        ->submitForm("#loginform > form",$loginInput)
        ->wait(3)
        ->see("Logout")
        ->wait(2);
    $this->screenRecorder->stopRecording(0);

}

```

## Setting options

The `ffmpeg` shell command can accept different options:
for a complete list of options you can visit: 
http://ffmpeg.org/ffmpeg.html

 

### Wrapper Methods


 * `setOptions` accepts the options in the array. You can provide any option in following way:
 ```php                 
       $options['-show_region'=>'1']
       $screenRecorder->setOptions($options);
 ```
 > Note: you have to write complete option including "-" ,  
 i had to do this way because there are some options which need "-" this and some which not 
 so it's difficult to know for which option i have to set that
 that's why you have to provide complete option.

* `setScreenSizeToCapture` screen size to capture, it accepts two arguments the first being the width and other being the height.


* `startRecording` call this method after you have set all the desired options,  
                this will start the screen recording. The method accepts two optional arguments, firstly the desired 
                location to save the video file and secondly the number of seconds to sleep after starting the process.
                This is useful because ffmpeg takes 1-2 seconds to start the recording, the default value for this is 2 seconds.
                You can may change this according to your requirements.
* `stopRecording` this will stop the screen recording.
The method can also take one optional argument, the number of seconds to sleep after starting the process.
This is useful because ffmpeg takes 1-2 seconds to start the recording.

* `getVideo` returns the saved video file.

* `setBinary` for this library you do not require any binary as everything is already included, however, if you need to use any other binary you can provide it using this method.  

* `getCommandToRun` returns the generated command that will be executed by library.  
This is useful to check how you have set the options or to debug.  


* `getOptions` returns an array of all the set options.

* `getBinary` returns the currently set binary file i.e ffmpeg.




## License 
The **PHP Screen Recorder** is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Contribution
Thanks to all of the contributors ,
fork this repository and send me a pull request

## Author
Dawood Ikhlaq and Open source community
