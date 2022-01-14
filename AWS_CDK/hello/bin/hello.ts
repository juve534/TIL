#!/usr/bin/env node
import 'source-map-support/register';
import * as cdk from 'aws-cdk-lib';
import { HelloStack } from '../lib/hello-stack';

const app = new cdk.App();
new HelloStack(app, 'HelloStack', {
  tags: {
    Name: 'hello-stack'
  },
  env: {
    account: process.env.CDK_DEFAULT_ACCOUNT,
    region: process.env.CDK_DEFAULT_REGION
  },
});