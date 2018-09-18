# Go言語学習メモ
## Go言語とは
Go言語は2009年にGoogleによって作られたオープンソースの静的言語で、Linux・Mac・WindowsやAndroidで動作します。最近ではGoogle App Engineで使うこともできます。

golang.jpの解説によると次のような特徴があります。

* シンプルな言語である。
* コンパイル・実行速度が早い。
* 安全性が高い。
* 同期処理が容易に行える。
* なにより楽しい。
* オープンソースである。

## Basic
### ループ文について
PHPにあるwhile文はfor文の記載方法を変えることで実装する

```
普通のfor文
for i = 0; i < 100; i++ {
}

while文相当の処理
for i < 100 {
}

無限ループ
for {
}
```

if文もfor文も()不要

### if文
if文のステートメントの中で宣言した変数はif文中とelse文中のみ有効

```
if v := math.Pow(x, n); v < lim {
  return v ←有効
}
rerurn v ←無効
```

演習
```
package main

import (
    "fmt"
)

func Sqrt(x float64) float64 {
    z := float64(1)
    for i := 0; i < 10; i++ {
        z -= (z * z - x) / (2 * z)
    }
    return z
}

func main() {
    fmt.Println(Sqrt(5))
}
```

### switch文
PHPと違って、caseの後は自動でbreakされる。
breakされたくない場合は、fallthroughを最後に入れる。
```
switch os := runtime.GOOS; os {
case "darwin":
  fmt.Println("OS X.")
case "linux":
  fmt.Println("Linux.")
  fallthrough
default:
  // freebsd, openbsd,
  // plan9, windows...
  fmt.Printf("%s.", os)
}
```

### Defer
Deferは受け取った関数の実行を、呼び出し元の関数の終わり(returnする)まで遅延させるステートメント。下の例の場合は、hello出力後にworldが出力される。

```
package main

import "fmt"

func main() {
    defer fmt.Println("world")

    fmt.Println("hello")
}
```

複数の関数を渡した場合は、新しい値から順に吐き出される。（LIFO）
下記の例の場合は、9から順に吐き出される。

```
func main() {
    fmt.Println("counting")

    for i := 0; i < 10; i++ {
        defer fmt.Println(i)
    }

    fmt.Println("done")
}
```

### ポインタ
Go言語はPHPと違ってポインタを扱う。
ポインタは変数の前に&をつけることで引き出せる。
変数 T のポインタは、 *T 型で、ゼロ値は nil です。

※ポインタは変数のメモリアドレスのこと

```
p = &i
```

C言語とは異なり、ポインタ演算はありません。

### Structs
structsはフィールドの集まりです。
structのフィールドは、ドット( . )を用いてアクセスします。

```
package main

import "fmt"

type Vertex struct {
    X int
    Y int
}

func main() {
    fmt.Println(Vertex{1, 2})
}

v := Vertex{1, 2}
v.X = 4
```

structのフィールドなポインタを用いてアクセスもできる。

```
(*p).X = 1e9
p.X = 1e9
```

### Structリテラル
structリテラルは、フィールドの値を列挙することで新しいstructの初期値の割り当てを示しています。

```
var (
    v1 = Vertex{1, 2}  // 初期値
    v2 = Vertex{X: 1}  // X:1でxを1で初期化。Yは0の状態
    v3 = Vertex{}      // X:0 と Y:0の扱いなのでどちらも0
    p  = &Vertex{1, 2} // has type *Vertex
)
```

### Arrays
[n]T 型は、型 T の n 個の変数の配列( array )を表します。
長さは型の一部になるので固定長です。

```
var a [10]int
var a [2]string
```

### Slices
固定長のArraysに対して、可変長なのがSlices。

```
a[lo: hi]  // 配列またはスライスa の lo から、hi-1までのスライスを返す

func main() {
    primes := [6]int{2, 3, 5, 7, 11, 13} // primesという配列に6要素追加

    var s []int = primes[1:4]
    fmt.Println(s)
}
```
スライスのリテラルは長さのない配列になる。
スライスするときは、それらの既定値を代わりに使用することで上限または下限を省略することができる。
既定値は下限が 0 で上限はスライスの長さ。

```
func main() {
    s := []int{2, 3, 5, 7, 11, 13}

  // sの1から3(4-1)を取得する
    s = s[1:4]
    fmt.Println(s) // 3, 5, 7

  // sの0から1(2-1)を取得する
    s = s[:2]
    fmt.Println(s) // 3, 5

  // sの1から2(4-1)を取得する
    s = s[1:] // 5
    fmt.Println(s)
}
```

スライスは長さ( length )と容量(　capacity )の両方を持っています。
スライスの長さは、それに含まれる要素の数です。
スライスの容量は、スライスの最初の要素から数えて、元となる配列の要素数です。
スライス s の長さと容量は len(s) と cap(s) という式を使用して得ることができます。

```
func main() {
    data := []int{2, 3, 5, 7, 11, 13}
    printSlice(data)

    // dataの0　から0の要素を取得
    data = data[:0]
    printSlice(data) // dataの長さは0, キャパシティはもとの長さで6

    // dataの0　から4の要素を取得
    data = data[:4]
    printSlice(data) // dataの長さは4, キャパシティはもとの長さで6

    // dataの02から0, 1の要素を削除
    data = data[2:]
    printSlice(data)

    data = data[:10]
    printSlice(data)
}

func printSlice(s []int) {
    fmt.Printf("len=%d cap=%d %v\n", len(s), cap(s), s)
}
```

実行結果
```
len=6 cap=6 [2 3 5 7 11 13]
len=0 cap=6 []
len=4 cap=6 [2 3 5 7]
len=2 cap=4 [5 7]
panic: runtime error: slice bounds out of range

goroutine 1 [running]:
main.main()
    /tmp/sandbox688921209/main.go:21 +0x120
```

スライスのゼロ値は nil です。
nil スライスは 0 の長さと容量を持っており、何の元となる配列も持っていません。

スライスは、組み込みの make 関数を使用して作成することができます。
これは、動的サイズの配列を作成する方法です。

make 関数はゼロ化された配列を割り当て、その配列を指すスライスを返します。
```
a := make([]int, 5)  // len(a)=5
```

make の3番目の引数に、スライスの容量( capacity )を指定できます。 cap(b) で、スライスの容量を返します:
```
make([]int, 0, 5)
```

スライスへ新しい要素を追加するには、Goの組み込みの append を使います。
```
// nilのスライスを作成
s = append(s, 0)

// スライスに１を追加
s = append(s, 1)

// スライスに2,3,4を追加
s = append(s, 2, 3, 4)
```

## Range
for ループに利用する range は、スライスや、マップ(map)をひとつずつ反復処理するために使う。

スライスをrangeで繰り返す場合、rangeは反復毎に2つの変数を返します。
1つ目の変数はインデックス(index)で、2つ目はインデックスの場所の要素のコピー。

```
// iにはkey、vにはvalue
func main() {
    for i, v := range pow {
        fmt.Printf("2**%d = %d\n", i, v)
    }
}
```

keyは不要な場合は _ に代入して切り捨てできる。

```
func main() {
    // 空配列の作成
    pow := make([]int, 10)

    // valueは不要なので省略
    for i := range pow {
        pow[i] = 1 << uint(i) // == 2**i
    }

    // keyは不要なので _ に代入して切捨て
    for _, value := range pow {
        fmt.Printf("%d\n", value)
    }
}
```

### Exercise: Slices
Pic 関数を実装してみましょう。 このプログラムを実行すると、生成した画像が下に表示されるはずです。 この関数は、長さ dy のsliceに、各要素が8bitのunsigned int型で長さ dx のsliceを割り当てたものを返すように実装する必要があります。 画像は、整数値をグレースケール(実際はブルースケール)として解釈したものです。

生成する画像は、好きに選んでください。例えば、面白い関数に、 (x+y)/2 、 x*y 、o x^y などがあります。

```
package main

import "golang.org/x/tour/pic"

func Pic(dx, dy int) [][]uint8 {
    ret := make([][]uint8, dy)
    for i := 0; i < dy; i++ {
        ret[i] = make([]uint8, dx)
        for j := 0; j < dx; j++ {
            //ret[i][j] = uint8((j ^ i) * (j + i) / 2)
            //ret[i][j] =  uint8((i + j) / 2)
            ret[i][j] =  uint8((i * j))
        }
    }
    return ret
}

func main() {
    pic.Show(Pic)
}
```

## Maps
map はキーと値とを関連付けます(マップします)。

マップのゼロ値は nil です。 nil マップはキーを持っておらず、またキーを追加することもできません。
make 関数は指定された型の、初期化され使用できるようにしたマップを返します。
mapに渡すトップレベルの型が単純な型名である場合は、リテラルの要素から推定できますので、その型名を省略することができます。
map m の操作を見ていきましょう。

m へ要素(elem)の挿入や更新:

```
m[key] = elem
要素の取得:elem = m[key]
要素の削除:delete(m, key)
```
キーに対する要素が存在するかどうかは、2つの目の値で確認します
```
elem, ok = m[key]
```
もし、 m に key があれば、変数 ok は true となり、存在しなければ、 ok は false となります。

### Exercise: Maps
WordCount 関数を実装してみましょう。string s で渡される文章の、各単語の出現回数のmapを返す必要があります。 wc.Test 関数は、引数に渡した関数に対しテストスイートを実行し、成功か失敗かを結果に表示します。

strings.Fields で、何かヒントを得ることができるはずです。

Note: このテストスイートで何を入力とし、何を期待しているかについては、golang.org/x/tour/wc]を見てみてください。

exercise-maps.go
```
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
```

### Function values
関数も変数です。他の変数のように関数を渡すことができます。

関数値( function value )は、関数の引数に取ることもできますし、戻り値としても利用できます。
関数の入れ子もできる。
```
func main() {
    hypot := func(x, y float64) float64 {
        return math.Sqrt(x*x + y*y)
    }
    fmt.Println(hypot(5, 12))

    fmt.Println(compute(hypot))
    fmt.Println(compute(math.Pow))
}
```

## Function closures
Goの関数は クロージャ( closure ) です。 クロージャは、それ自身の外部から変数を参照する関数値です。 この関数は、参照された変数へアクセスして変えることができ、その意味では、その関数は変数へ"バインド"( bind )されています。

例えば、 adder 関数はクロージャを返しています。 各クロージャは、それ自身の sum 変数へバインドされます。

```
func adder() func(int) int {
    sum := 0
    return func(x int) int {
        sum += x
        return sum
    }
}

func main() {
    pos, neg := adder(), adder()
    for i := 0; i < 10; i++ {
        fmt.Println(
            pos(i),
            neg(-2*i),
        )
    }
}
```

### Exercise: Fibonacci closure
関数を用いた面白い例を見てみましょう。

fibonacci (フィボナッチ)関数を実装しましょう。この関数は、連続するフィボナッチ数(0, 1, 1, 2, 3, 5, ...)を返す関数(クロージャ)を返します。

exercise-fibonacci-closure.go
```
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
```

## Methods
Goには、クラス( class )のしくみはありませんが、型にメソッド( method )を定義できます。
メソッドは、特別なレシーバ( receiver )引数を関数に取ります。
レシーバは、 func キーワードとメソッド名の間に自身の引数リストで表現します。
この例では、 Abs メソッドは v という名前の Vertex 型のレシーバを持つことを意味しています。

```
package main

import (
    "fmt"
    "math"
)

// struct設定
type Vertex struct {
    X, Y float64
}

// mainのvを受け取る
// vにはX=3, Y=4が格納される
/*
* func Abs(v Vertex) float64 {
* これでも表現できる
*/
func (v Vertex) Abs() float64 {
    return math.Sqrt(v.X*v.X + v.Y*v.Y)
}

func main() {
    v := Vertex{3, 4}
    fmt.Println(v.Abs())
}
```

例で上げたstructの型だけではなく、任意の型(type)にもメソッドを宣言できます。

レシーバを伴うメソッドの宣言は、レシーバ型が同じパッケージにある必要があります。 他のパッケージに定義している型に対して、レシーバを伴うメソッドを宣言できません （組み込みの int などの型も同様です）。

### Pointer receivers
ポインタレシーバでメソッドを宣言できます。

ポインタレシーバを持つメソッド(ここでは Scale )は、レシーバが指す変数を変更できます。 レシーバ自身を更新することが多いため、変数レシーバよりもポインタレシーバの方が一般的です。

Scale の宣言(line 16)から * を消し、プログラムの振る舞いがどう変わるのかを確認してみましょう。

```
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
```

メソッドがポインタレシーバである場合、呼び出し時に、変数、または、ポインタのいずれかのレシーバとして取ることができる。
引数がポインタの場合はポインタを渡さないとエラーになる。

### Choosing a value or pointer receiver
ポインタレシーバを使う2つの理由があります。
1. メソッドがレシーバが指す先の変数を変更するためです。
2. ふたつに、メソッドの呼び出し毎に変数のコピーを避けるためです。 例えば、レシーバが大きな構造体である場合に効率的です。

PHPで例えると、
大きな配列の中身を操作するためにメンバ変数に格納して操作用メソッド内で呼び出す
→引数として渡すとメモリ消費が倍になる

```
package main

import (
    "fmt"
    "math"
)

type Vertex struct {
    X, Y float64
}

func (v *Vertex) Scale(f float64) {
    v.X = v.X * f
    v.Y = v.Y * f
}

func (v *Vertex) Abs() float64 {
    return math.Sqrt(v.X*v.X + v.Y*v.Y)
}

func main() {
    v := &Vertex{3, 4}
    fmt.Printf("Before scaling: %+v, Abs: %v\n", v, v.Abs())
    v.Scale(5)
    fmt.Printf("After scaling: %+v, Abs: %v\n", v, v.Abs())
}
```

### Interfaces
interface(インタフェース)型は、メソッドのシグニチャの集まりで定義します。
そのメソッドの集まりを実装した値を、interface型の変数へ持たせることができます。

Interfaces_are_implemented_implicitly.go
```
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
```

### Interface values with nil underlying values
インターフェース自体の中にある具体的な値が nil の場合、メソッドは nil をレシーバーとして呼び出されます。

いくつかの言語ではこれは null ポインター例外を引き起こしますが、Go では nil をレシーバーとして呼び出されても適切に処理するメソッドを記述するのが一般的です。

具体的な値が nil でないインターフェースの値は、それ自体が nil ではないことに注意してください。
また、nil インターフェースの値は、値も具体的な型も保持しません。

呼び出す 具体的な メソッドを示す型がインターフェースのタプル内に存在しないため、 nil インターフェースのメソッドを呼び出すと、ランタイムエラーになります。

```
func (t *T) M() {
  // この条件を外すとランタイムエラーになる
    if t == nil {
        fmt.Println("<nil>")
        return
    }
    fmt.Println(t.S)
}
```

### The empty interface
ゼロ個のメソッドを指定されたインターフェース型は、 空のインターフェース と呼ばれます:

interface{}
空のインターフェースは、任意の型の値を保持できます。 (全ての型は、少なくともゼロ個のメソッドを実装しています。)

空のインターフェースは、未知の型の値を扱うコードで使用されます。 例えば、 fmt.Print は interface{} 型の任意の数の引数を受け取ります。

empty-interface.go
```
package main

import "fmt"

func main() {
  // 空のインタフェース定義
    var i interface{}

  // 空なのでnilが表示される
    describe(i)

  // 42とintが表示される
    i = 42
    describe(i)

  // helloとstringが表示される
    i = "hello"
    describe(i)
}

func describe(i interface{}) {
    fmt.Printf("(%v, %T)\n", i, i)
}
```
### Type assertions
型アサーション は、インターフェースの値の基になる具体的な値を利用する手段を提供します。

```
t := i.(T)
```
この文は、インターフェースの値 i が具体的な型 T を保持し、基になる T の値を変数 t に代入することを主張します。

i が T を保持していない場合、この文は panic を引き起こします。
インターフェースの値が特定の型を保持しているかどうかを テスト するために、型アサーションは2つの値(基になる値とアサーションが成功したかどうかを報告するブール値)を返すことができます。

```
t, ok := i.(T)
```
i が T を保持していれば、 t は基になる値になり、 ok は真(true)になります。

そうでなければ、 ok は偽(false)になり、 t は型 T のゼロ値になり panic は起きません。

この構文と map から読み取る構文との類似点に注意してください。
type-assertions.go
```
package main

import "fmt"

func main() {
    var i interface{} = "hello"

    s := i.(string)
    fmt.Println(s)

    // stringかどうか検査
    s, ok := i.(string)
    fmt.Println(s, ok)

    // floatかどうか検査
    f, ok := i.(float64)
    fmt.Println(f, ok)

    // floatは
    f = i.(float64) // panic
    fmt.Println(f)
}
```

### Type switches
型switch はいくつかの型アサーションを直列に使用できる構造です。

型switchは通常のswitch文と似ていますが、型switchのcaseは型(値ではない)を指定し、それらの値は指定されたインターフェースの値が保持する値の型と比較されます。

type-switches.go
```
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
```
型switchの宣言は、型アサーション i.(T) と同じ構文を持ちますが、特定の型 T はキーワード type に置き換えられます。

このswitch文は、インターフェースの値 i が 型 T または S の値を保持するかどうかをテストします。 T および S の各caseにおいて、変数 v はそれぞれ 型 T または S であり、 i によって保持される値を保持します。 defaultの場合(一致するものがない場合)、変数 v は同じインターフェース型で値は i となります。