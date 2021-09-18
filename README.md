# MWPS WordPress Starter Theme
Wait Don't Copy Or Clone The Repository. If You Do this.This Theme Will Not Work. See The Installation.

## Requirement
1. Node
2. Npm
3. Composer
4. Gulp

## Installation.
1. First make a directory.
2. Then make a package.json file in that directory.
You Can Do This By Writing In Your CMD.
`npm init` OR `npm init -y`
3. Then run `npm i mwps-core --save-dev` in your cmd.
4. Into your theme dir make a folder named `mwps.config.js`
5. Copy and paste the bellow code in your mwps.config.js file
```
const MWPS = require('mwps-core');
MWPS({
    plugin: [
        
    ]
});
```
6. Then copy and replace the bellow section in your package.json
```
"scripts": {
    "build-mwps": "node mwps.config.js && composer install && composer dupp-autoload"
},
```
7. Now run `npm run build-mwps` in your cmd on your project location.

## Updating
1. Update mawp-core or mwps-plugin package in your package.json file.
2. Then run `npm i` in your cmd.
3. Then run `npm run build-mwps` in your cmd.
Now MWPS is updated. Enjoy it.

## Docs
MWPS is a starter wordpress theme. And its apis are very simple.
MWPS have some plugins that you can add. To add plugin you should see the mwps config part.

### MWPS Config
After genaration the full mwps started theme you will see a mwps.config.js in your root diractory. This is the file where you will your MWPS Theme.
At first you will see that file contents like this.
```
// mwps.config.js

const MWPS = require('mwps-core');
MWPS({
    plugin: [
        
    ]
});
```
Now you will want to know how does this works.

In this file you will see that there is a function class MWPS and the function is importing form mwps-core package.
So, the MWPS function add the base and the core things of your theme. All of you do will be done from here.
Already you will see that in the MWPS function there is a object. And the object have a propaty called plugins.
This is the array where you will add plugins in your mwps starter theme.

#### Adding Plugins
To add plugins you need to go in the mwps.config.js file. And the follow the instractions.

1. At first you need to install the plugin by npm. To do that you can do in your cmd. Here exampale plugin is mwps-tabs-component.
```
npm i mwps-tabs-component --save-dev
```
2. Then in the mwps.config.js file you need to import the plugin form node_modules. To do that you can do this.
```
// mwps.config.js

const MWPS = require('mwps-core');
const mwpsTabsComponent = require('mwps-tabs-component');
MWPS({
    plugin: [
        
    ]
});
```
3. Then you need to add that in your plugin array.
```
// mwps.config.js

const MWPS = require('mwps-core');
const mwpsTabsComponent = require('mwps-tabs-component');
MWPS({
    plugin: [
        mwpsTabsComponent
    ]
});
```
4. After doing this you need to run `npm run build-mwps` in your cmd.

###### Remember that if you change the mwps.config.js file you need to run `npm run build-mwps` in your cmd or the chenges will not be updated.
