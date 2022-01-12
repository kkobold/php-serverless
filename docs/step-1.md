# step-1

#### ovreview

Step one covers the creation and requirements for the project.

### Step Instructions

Initialize Project

``mkdir php-serverless``

``cd php-serverless``

``composer init``

Require Bref and Slim

``composer require bref/bref slim/slim slim/psr7 slim/http``

Install Serverless

``yarn global add serverless``

Create a .gitignore file with the following content

``.gitignore``

````
/vendor
/.serverless
/package.json
````

move to [step-2](https://github.com/kkobold/php-serverless/blob/main/docs/step-2.md)