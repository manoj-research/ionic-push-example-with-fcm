# Ionic App work with FCM

Instructions to use Ionic Push Firebase Cloud Messaging:

* git clone https://github.com/mugan86/ionic-push-example-with-fcm.git
* npm install
* ionic platform add android 
**(At the moment it is not available for iOS (In the future YES))**

## Install all plugins:

Add next command to install ALL plugins to this project:
sudo cordova plugin add cordova-plugin-whitelist cordova-plugin-console cordova-plugin-statusbar cordova-plugin-device ionic-plugin-keyboard cordova-plugin-splashscreen cordova-plugin-fcm

## Project using this plugins:

* FCM: cordova-plugin-fcm
* Whitelist: cordova-plugin-whitelist 
* Console: cordova-plugin-console 
* Status bar: cordova-plugin-statusbar 
* Device: cordova-plugin-device 
* Keyboard: ionic-plugin-keyboard 
* Splash Screen: cordova-plugin-splashscreen

## After installed 

After following the instructions to add all the necessary plugins, we must add our file `google-services.json` (taking into account that if we do not change the name of the package in `config.xml` **MUST BE** `anartzmuxika.firebasegcmexample`. We replace it at the root of the project, compile the Android version, import it into Android Studio and run it for use on our Android device.

Open log application and find **"TOKEN (COPY AND USE in server-fcm/message.php file):"** followeb by a token and copy to use.

When initializing a message will appear as an alert showing us our ID of the device that we have to obtain and use it in line 26 of the file `message.php` within the files of the directory `server-fcm`.

**Do not forget to add your KEY API on line 11** that is obtained in the Firebase console following the instructions described in the README of the following project: https://github.com/mugan86/angularjs-firebase-push-to-android

### Use reference with steps needed to configure firebase on Android in:
https://firebase.google.com/docs/android/setup