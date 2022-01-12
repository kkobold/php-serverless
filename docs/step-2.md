# step-2

#### ovreview
On this step we will do the minimum requirement to load the php to lambda using [Bref](https://bref.sh/) and [serverless framework](https://www.serverless.com/framework/) and deploy the solution using httpApi on Api Gateway

### Step Instructions 

 

Initialize Bref 

``php vendor/bin/bref init -n``

edit ``serverless.yml`` and on the first line change the name of your service from ``app`` to something personal eg. 
``kkobold``. Use only letters lowercase and dash (don't start with dash).

Add the following lines after service. The custom section can hold some variables for later use. 

``serverless.yml``
````
service: YOUR-SERVICE-NAME

custom:
    name: ${self:service}
    stage: ${opt:stage, 'dev'}
````



Make your first deploy

``serverless deploy`` If you are not using your default AWS profile add ``--profile PROFILENAME``


After the deployment you will receive a URL with your AWS API gateway endpoint. Open it, and it will show you the
result of the index.php file. 

Open [https://console.aws.amazon.com/apigateway/main/apis?region=us-east-1](https://console.aws.amazon.com/apigateway/main/apis?region=us-east-1) to check your api gateway. 





move to [step-3](https://github.com/kkobold/php-serverless/blob/main/docs/step-3.md)