#!/bin/bash -ue

echo "利用するクレデンシャルを指定してください（指定がなければdefaultになります）"
echo -n 'profile: '
read profile

echo "AWS AccountIdを指定してください（ECRで使います）"
echo -n 'account_id: '
read account_id

if [[ -n "${profile}" ]];then
  PROFILE=${profile}
else
  PROFILE=default
fi

docker build -t php-lambda .
docker tag php-lambda:latest ${account_id}.dkr.ecr.ap-northeast-1.amazonaws.com/php-lambda
aws ecr get-login-password --profile=$PROFILE | docker login --username AWS --password-stdin ${account_id}.dkr.ecr.ap-northeast-1.amazonaws.com
docker push ${account_id}.dkr.ecr.ap-northeast-1.amazonaws.com/php-lambda:latest
