package main

import (
  "fmt"
  "golang.org/x/tour/wc"
  "strings"
)

func WordCount(s string) map[string]int {
  // ここでインプットを分割し、マップ化
  sf := strings.Fields(s)

  // マップの3番目の値が出力される Go!
  fmt.Println(sf[3])
  // マップの要素数をカウント
  num := len(sf)
  // マップ作成
  ret := make(map[string]int)

  /*
   * インプットを分割したmapをループさせ、
   * アウトプットのmapのキーに文字を格納する。
   * valueは数値
   */
  for i := 0; i < num; i++ {
    (ret[sf[i]])++
    fmt.Println(sf[i])
    fmt.Println(ret)
  }

  return ret
}

func main() {
  wc.Test(WordCount)
}