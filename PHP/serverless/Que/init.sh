#/bin/sh

set -a
source .env
set +a

echo "実行環境を指定してください（指定がなければコンテナ上になります）"
echo -n 'environment: '
read environment

if [[ -n "${environment}" ]];then
  ENVIRONMENT=${environment}
else
  ENVIRONMENT="docker-compose exec app"
fi

$ENVIRONMENT serverless config credentials --provider aws --key $aws_access_key_id --secret $aws_secret_access_key