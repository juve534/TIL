package main

import "fmt"

func do(i interface{}) {
	// アサーションで引数iの型を取得
	switch v := i.(type) {
	// 引数がint型のとき
	case int:
		fmt.Printf("Twice %v is %v\n", v, v*2)
	// 引数がstring型のとき
	case string:
		fmt.Printf("%q is %v bytes long\n", v, len(v))
	default:
		fmt.Printf("I don't know about type %T!\n", v)
	}
}

func main() {
	do(21)
	do("hello")
	do(true)
}