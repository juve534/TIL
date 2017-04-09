# 初めてHHVMでHackを動かそうとして躓いた事

下記コードが記載されたhello.hhを動かそうとした所、エラーが発生した。
```
<?hh
echo "hellow hack\n";
```


```
hhvm hello.hh

Fatal error: hello.hh appears to be a Hack file, but you do not appear to be running the Hack typechecker. See the documentation at http://docs.hhvm.com/hack/typechecker/setup for information on getting it running. You can also set `-d hhvm.hack.lang.look_for_typechecker=0` to disable this check (not recommended).
```

指定されたドキュメントを確認した所、最初に .hhconfig を作成してから実行する必要が有ることがわかった。
そのため、 .hhconfig を空で作成して再実行。
```
hhvm hello.hh
hellow hack
```

無事に実行できました。
