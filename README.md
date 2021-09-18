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
