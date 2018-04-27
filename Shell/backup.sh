#!/bin/sh
 
instances=$(aws ec2 describe-instances --filters Name=tag-key,Values=backup --query 'Reservations[*].Instances[*].[InstanceId,to_string(Tags[?Key==`backup`].Value),to_string(Tags[?Key==`Name`].Value)]' --output text | tr -d "[" | tr -d "]" | tr -d "\"" | awk '{print $1","$2","$3}')
 
for instance in $instances
do
  parts=$(echo $instance | sed -e "s/,/ /g")
  columns=($parts)
  instance_id=${columns[0]}
  name=${columns[2]}
  aws ec2 create-image --instance-id $instance_id --no-reboot --name ${name}_`date +"%Y%m%d%H%M%S"`
done
