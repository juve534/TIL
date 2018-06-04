/**
 * A Tour Of GoのExercise: Fibonacci closure
 */
package main

import "fmt"

/*
 * i=0のとき、 a=0, b=1
 * i=1のとき、 a=1, b=2
 * i=2のとき、 a=2, b=3
 */
func fibonacci() func() int {
  a := 0
  b := 1
  return func() int {
    a, b = b, a+b
    return a
  }
}

func main() {
  f := fibonacci()
  for i := 0; i < 10; i++ {
    fmt.Println(f())
  }
}