-- 文字列出力
message = "hello world"
print(message)

-- 多重代入
x, y = 10, 15
print(x, y)

-- 数値
x = 10 + 10
print(x)

x = 10.5 * 4.2
print(x)

x = 10 % 3
print(x)

x = 2 ^ 3
print(x)

-- 文字列
s = "123\n456"
print(s)

print([["123\n456"]])

-- テーブル(配列/連想配列)
a = {23, 234, "hello"}
print(a[2])
print(#a)

user = {name = "test", score = 120}
print(user["name"])
print(user.score)