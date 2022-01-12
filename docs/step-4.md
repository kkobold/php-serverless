# step-4

#### ovreview

On this step we will explore the Eventbridge.

### Step Instructions


Go to the [AWS Console for EventBridge](https://console.aws.amazon.com/events/home?region=us-east-1#/eventbuses) and start the discovery on the default bus
Go to the [AWS Console S3](https://s3.console.aws.amazon.com/s3/home?region=us-east-1&region=us-east-1) select your bucket and go to ``properties``. On the ``Event notifications`` section enable ``Amazon EventBridge`` if not enabled. 


On the ``functions`` section of ``serverless.yml`` add the following function:

````
eventBridgeFunction:
        handler: events/s3/fileRemoved.php
        layers:
            - ${bref:layer.php-80}
        description: 'A file was removed from the bucket'
        events:
            - eventBridge:
                  enabled: true
                  pattern:
                      source:
                          - aws.s3
                      detail-type:
                          - "Object Deleted"
                      detail:
                          bucket:
                              name:
                                  - ${self:custom.name}-${self:custom.stage}-bucket         
````

and then we create the file to process the event:


``events/s3/fileRemoved.php``

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

Select the project bucket, and go to the ``uploads`` folder and remove the file uploaded on step 3.

After the removal the S3 will send and event to the event bridge.
This Event will carry teh pattern descrived on ``eventBridgeFunction``  so it will be triggered calling its ``handler`` on ``events/s3/fileRemoved.php``.

Go to the [cloudwatch log group](https://console.aws.amazon.com/cloudwatch/home?region=us-east-1#logsV2:log-groups) and find the relevant log. It will be named ``/aws/lambda/SERVICE-dev-eventBridgeFunction``

There you will find the json encoded ``event`` and ``context``