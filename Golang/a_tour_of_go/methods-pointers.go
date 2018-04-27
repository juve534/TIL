package main

import (
	"fmt"
	"math"
)

type Vertex struct {
	X, Y float64
}

func (v Vertex) Abs() float64 {
	return math.Sqrt(v.X*v.X + v.Y*v.Y)
}

/*
 * 渡された引数の値を引数倍する
 * ポインタ参照を外すと特にもとの引数に影響はなし
 */
func (v *Vertex) Scale(f float64) {
	fmt.Println(v)
	v.X = v.X * f
	v.Y = v.Y * f
	fmt.Println(v)
}

/*
 * ポインタ引数を受け取ることもできる
 */
func ScaleFunc(v *Vertex, f float64) {
	v.X = v.X * f
	v.Y = v.Y * f
}

func main() {
	v := Vertex{3, 4}
	v.Scale(10)
	fmt.Println(v)
	fmt.Println(v.Abs())
}