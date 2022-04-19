package main

import (
	"regexp"
	"testing"
)

func fizzbuzz(ut int64) string {
	var res string
	if ut%15 == 0 {
		res = "FizzBuzz"
	} else if ut%3 == 0 {
		res = "Fizz"
	} else if ut%5 == 0 {
		res = "Buzz"
	} else {
		res = "Not Fizz Buzz"
	}

	return res
}

func TestFb(t *testing.T) {
	list := []struct {
		ut       int64
		expected string
	}{
		{ut: 3, expected: "Fizz"},
		{ut: 10, expected: "Buzz"},
		{ut: 15, expected: "FizzBuzz"},
	}

	for _, l := range list {
		r := fizzbuzz(l.ut)
		if r != l.expected {
			t.Error("\n引数： ", l.ut, "\n実際： ", r, "\n理想： ", l.expected)
		}
	}
}

func FuzzFb(f *testing.F) {
	list := []struct {
		ut int64
	}{
		{ut: 3}, {ut: 10}, {ut: 15},
	}

	for _, l := range list {
		f.Add(l.ut)
	}

	f.Fuzz(func(t *testing.T, ut int64) {
		answer := fizzbuzz(ut)
		r := regexp.MustCompile(answer)
		if r.MatchString("Fizz") {
			return
		}
		if r.MatchString("Buzz") {
			return
		}
		if r.MatchString("FizzBuzz") {
			return
		}
		if r.MatchString("Not Fizz Buzz") {
			return
		}

		// どれにもマッチしない場合は想定外
		t.Errorf("👺fizzbuzz: %q", answer)
	})
}
