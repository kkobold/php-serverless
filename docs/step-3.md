# step-3

#### ovreview

On this step we will explore S3 Event. 

### Step Instructions

First, lets create a bucket on serverless.yml

``mkdir resources``

and then we create file ``resources\s3.yml``. 

``resources\s3.yml``
````
Resources:
  s3UploadBucket:
    Type: 'AWS::S3::Bucket'
    Properties:
      BucketName: ${self:custom.name}-${self:custom.stage}-bucket
      NotificationConfiguration:
        EventBridgeConfiguration:
          EventBridgeEnabled: true
````          
And at the end of the ``serverless.yml`` we add

``serverless.yml``
````
resources:
    - ${file(resources/s3.yml)}
````

now, on the ``functions`` section of ``serverless.yml`` add the following function editing the ``bucket`` accordingly: 

````
    s3Function:
        handler: events/s3/fileUploaded.php
        description: 'A file was uploaded inside the upload directory'
        layers:
            - ${bref:layer.php-80}
        events:
            - s3:
                  bucket: ${self:custom.name}-${self:custom.stage}-bucket
                  event: s3:ObjectCreated:*
                  existing: true
                  rules:
                      - prefix: uploads/
                      - suffix: .csv                
````

and then we create the file ro process the event:

``mkdir -p events/s3``

``events/s3/fileUploaded.php``

````
<?php
require __DIR__ . '/../../vendor/autoload.php';

return function ($event, $context) {
    echo "Event: ". json_encode($event, true);
    echo "Context: ". json_encode($context, true);
};
````

run the deploy

``serverless deploy``

After the the deploy open AWS Console and go to you [bucket list](https://s3.console.aws.amazon.com/s3/home?region=us-east-1).

Select the project bucket, create a folder named ``uploads``.

Open the ``uploads`` folder and upload any file with the ``.csv`` extension

After the upload the ``s3Function`` will be invoked and the ``handler`` on ``events/s3/fileUploaded.php`` will be called.

Now go to the [cloudwatch log group](https://console.aws.amazon.com/cloudwatch/home?region=us-east-1#logsV2:log-groups) and find the relevant log. It will be named ``/aws/lambda/SERVICE-dev-s3Function`` 

There you will find the json encoded ``event`` and ``context``

move to [step-4](https://github.com/kkobold/php-serverless/blob/start-step-4/docs/step-4.md)