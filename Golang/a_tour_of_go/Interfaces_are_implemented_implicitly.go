package main

import "fmt"

type I interface {
	M()
}

type T struct {
	S string
}

// タイプTが interface Iを実装している
// 明示的に記載しなくもて表現可能
func (t T) M() {
	fmt.Println(t.S)
}

func main() {
	var i I = T{"hello"}
	i.M()
}