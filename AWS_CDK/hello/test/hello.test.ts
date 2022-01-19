import * as cdk from 'aws-cdk-lib';
import { Template } from 'aws-cdk-lib/assertions';
import * as Hello from '../lib/hello-stack';

test('VPCが作成されている', () => {
  const app = new cdk.App();
    // WHEN
  const stack = new Hello.HelloStack(app, 'MyTestStack');
    // THEN
  const template = Template.fromStack(stack);

  template.hasResourceProperties('AWS::EC2::VPC', {
      EnableDnsHostnames: true,
      EnableDnsSupport: true,
      InstanceTenancy: 'default',
      Tags: [
          {
              "Key": "Name",
              "Value": "MyTestStack/VPC"
          }
      ]
  });
});
