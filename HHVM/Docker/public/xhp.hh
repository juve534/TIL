<?hh //strict
require __DIR__ .'/vendor/hh_autoload.php';

<<__Entrypoint>>
function run():void {
    $user_name = 'Hack / XHP';
    echo <tt>Hello <strong>{$user_name}</strong></tt>;
}
