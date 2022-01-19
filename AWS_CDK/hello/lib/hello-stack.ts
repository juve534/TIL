import { CfnOutput, Stack, StackProps } from 'aws-cdk-lib';
import { Construct } from 'constructs';
import { Vpc } from "aws-cdk-lib/aws-ec2";

export class HelloStack extends Stack {
  constructor(scope: Construct, id: string, props?: StackProps) {
    super(scope, id, props);

    const vpc = new Vpc(this, 'VPC', {
      maxAzs: 1,
    })

    new CfnOutput(this, 'Vpc', { value: vpc.vpcId })
    new CfnOutput(this, 'DefaultSG', { value: vpc.vpcDefaultSecurityGroup })
  }
}
