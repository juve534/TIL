#/bin/sh

set -a
source .env
set +a

$1 serverless config credentials --provider aws --key $aws_access_key_id --secret $aws_secret_access_key