PHP Screen Recorder
===============

A slim php wrapper around [ffmpeg](https://ffmpeg.org/) to record screen,best for recording your 
acceptance test using selenium, easy to use and clean OOP interface. 


## History
i had give a task to make **acceptance test suite** but also to record the videos of those
tests , i was using **selenium** to do that task and for video i was not able to find
any elegant solution that's why i created this library.


## Usage 

it's so easy to use this library,  
You have to call the method   `startRecording` when you want to start the recording 
then this library will start the recording in the background
and when you done your task you can call `stopRecording` to stop the recording .

## Installation
it's so easy to install this library  
Install the package through [composer](http://getcomposer.org):

```
composer require dawood/phpscreenrecorder
```
*that's it you're done nothing else to install* 



## Examples
There is an examples provided in examples folder too

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

The `ffmpeg` shell command accepts different types of options:
for complete list of options you can visit 
http://ffmpeg.org/ffmpeg.html

 

### Wrapper Methods


 * `setOptions` accepts the options in array you can provide any option in following way.
 ```php                 
       $options['-show_region'=>'1']
       $screenRecorder->setOptions($options);
 ```
 > Note: you have to write complete option including "-" ,  
 i had to do this way because there are some options which need "-" this and some which not 
 so it's difficult to know for which option i have to set that
 that's why you have to provide complete option.

* `setScreenSizeToCapture` screen size to capture it accepts two arguments first width and second height.


* `startRecording` call this method when you have already set all the desired options,  
                this will start recording the screen. It accepts two optional arguments first the desired 
                location to save the video file and second the number of seconds to sleep after starting the process
                this is useful cause ffmpeg takes 1-2 seconds to start the recording default value for this is 2 seconds
                you can change it according to your need,
* `stopRecording` this will stop recording the screen.
it take one optional argument ,the number of seconds to sleep after starting the process
                                                                      this is useful cause ffmpeg takes 1-2 seconds to start the recording

* `getVideo` returns the saved video file.

* `setBinary` for this library you don't need any binary file it comes with everything.  
but in any case you need to use some other binary you can provide it using this method.  

* `getCommandToRun` returns the generated command that will be executed by library ,  
this is useful to check how you have set the options or to debug.  


* `getOptions` returns array of all the set options.

* `getBinary` returns the currently set binary file i.e ffmpeg.




## License 
The **PHP Screen Recorder** is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Contribution
Thanks to all of the contributors ,
fork this repository and send me a pull request

## Author
Dawood Ikhlaq and Open source community
